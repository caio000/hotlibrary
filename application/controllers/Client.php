<?php defined('BASEPATH') OR exit('No direct script access allowed');
  /**
   *
   */
  class Client extends CI_Controller {

    /**
     * Cria a solicitação de emprestimo no sistema.
     * @author Caio de Freitas Adriano
     * @since 2017/11/15
     */
    public function loan() {
      // pega os dados do usuário que vieram da requisição
      $token = getToken();
      $this->auth->setUserLevel($token[3]);
      $this->auth->setPagePermission([3]);
      // verifica se o usuário tem permissão para utilizar o serviço
      if (!$this->auth->hasPermission()) {
        header('HTTP/1.1 401 Unauthorized');
        exit();
      }
      // busca os dados do usuário
      $user = $this->Client_model->getById($token[0]);
      $user->address = $this->Address_model->getById($user->address);
      $user->address->City = $this->City_model->getById($user->address->City);

      // pega os parametros da requisição
      $post = file_get_contents("php://input");
      $loan = json_decode($post);

      // verifica se o cliente esta bloqueado para empréstimos
      if ($user->notLoan) {
        header('HTTP/1.1 202 Accepted');
        $log = createLog($user->id,"Ocorreu um erro ao solicitar empréstimo de um livro: cliente bloqueado para soliciar empréstimos");
        $this->Log_model->insert($log);
        $response['msg'] = "Você está bloqueado para solicitar emprestimos até " . $user->notLoan;
        exit(json_encode($response));
      }

      // verifica se o usuário não é da mesma cidade da biblioteca
      if ($loan->library->address->City->id !== $user->address->City->id) {
        header('HTTP/1.1 202 Accepted');
        $log = createLog($user->id,'Ocorreu um erro ao solicitar emprestimo de um livro: biblioteca não é da mesma cidade do cliente');
        $this->Log_model->insert($log);

        $response['msg'] = 'selecione uma biblioteca da sua cidade';
        exit(json_encode($response));
      }

      // verifica se o usuário possui mais de dois emprestimos em aberto
      if ($this->Loan_model->numOpenLoan($user) >= 2) {
        header("HTTP/1.1 202 Accepted");
        $log = createLog($user->id,'Ocorreu um erro ao solicitar emprestimo de um livro: possui dois emprestimos em aberto');
        $this->Log_model->insert($log);

        $response['msg'] = 'Não é possivel solicitar o emprestimo, pois existem 2 empréstimos em aberto';
        exit(json_encode($response));
      }

      // caso tenha chegue a esse ponto, já é possivel criar a solicitação de emprestimo
      $loanPersist = new stdClass();
      $loanPersist->library = $loan->library->id;
      $loanPersist->client = $user->id;
      $loanPersist->book = $loan->book->id;
      $result = $this->Loan_model->insert($loanPersist);

      $msg = ($result) ? 'Usuário solicitou empréstimo de um livro':'Ocorreu um erro ao solicitar um empréstimo de livro';
      $log = createLog($user->id,$msg);
      $this->Log_model->insert($log);

      $response['msg'] = 'Solicitação de empréstimo enviada com sucesso, aguarde a resposta da biblioteca';
      print(json_encode($response));

    }
  }

 ?>
