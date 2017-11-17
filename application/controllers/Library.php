<?php

/**
 * Essa classe contêm os serviços relacionados a biblioteca.
 * @author Caio de Freitas Adriano
 * @since 2017/11/4
 */
class Library extends CI_Controller {

  public function getNotification($id) {
    // pega os dados do usuário que vieram da requisição
    $token = getToken();
    $this->auth->setUserLevel($token[3]);
    $this->auth->setPagePermission([2]);
    // verifica se o usuário tem permissão para utilizar o serviço
    if (!$this->auth->hasPermission()) {
      header('HTTP/1.1 202 Unauthorized');
      exit();
    }
    $notifications = $this->Loan_model->notificationFrom($id);

    foreach ($notifications as $notification) {
      $notification->client = $this->Client_model->getById($notification->client);
      $notification->book = $this->Book_model->getById($notification->book);
    }

    print(json_encode($notifications));
  }

  /**
   * Remove um livro da biblioteca
   * @author Caio de Freitas Adriano
   * @since 2017/11/07
   * @param Int - ID do livro
   * @return Json - Retorna um json com os dados de resposta da requisição.
   */
  public function deleteBook($id) {
    // pega os dados do usuário que vieram da requisição
    $token = getToken();
    $this->auth->setUserLevel($token[3]);
    $this->auth->setPagePermission([2]);
    // verifica se o usuário tem permissão para utilizar o serviço
    if (!$this->auth->hasPermission()) {
      header('HTTP/1.1 401 Unauthorized');
      exit();
    }

    $result = $this->Library_model->deleteBook($token[0],$id);
    $responseMsg = ($result) ? 'Livro deletado com sucesso' : 'Ocorreu um erro ao deletar o livro';
    $logMsg = ($result) ? 'Deletou um livro da biblioteca' : 'Ocorreu um erro ao deletar um livro da biblioteca';

    $log = createLog($token[0],$logMsg);
    $this->Log_model->insert($log);

    $response['result'] = $result;
    $response['msg'] = $responseMsg;

    print(json_encode($response));
  }

  /**
   * adiciona livros para uma biblioteca.
   * @author Caio de Freitas Adriano
   * @since 2017/11/05
   * @param Array - Vetor com objetos Book
   * @return Json - Retorna os dados do resultado da requisição
   */
  public function addBooks() {
    // pega os dados do usuário que vieram da requisição
    $token = getToken();
    $this->auth->setUserLevel($token[3]);
    $this->auth->setPagePermission([1,2]);
    // verifica se o usuário tem permissão para utilizar o serviço
    if (!$this->auth->hasPermission()) {
      header('HTTP/1.1 401 Unauthorized');
      exit();
    }

    $post = file_get_contents("php://input");
    $data = json_decode($post);
    $library = $data->library;
    $books = $data->books;

    $this->db->trans_start();
    foreach ($books as $book) $this->Library_model->addBook($library->id,$book->id);
    $this->db->trans_complete();

    $result = $this->db->trans_status();
    $response['result'] = $result;

    $msg = ($result) ? 'Adicionou livro a biblioteca' : 'Ocorreu um erro ao adicionar livros a biblioteca';
    $log = createLog($token[0],$msg);
    $this->Log_model->insert($log);

    print(json_encode($response));

  }

  /**
   * Busca todos os dados da biblioteca.
   * @author Caio de Freitas Adriano
   * @since 2017/11/04
   * @param INT - ID da biblioteca.
   * @return Json - Retona todos os dados da biblioteca
   */
  function getById ($id) {

    // pega os dados do usuário que vieram da requisição
    $token = getToken();
    $this->auth->setUserLevel($token[3]);
    $this->auth->setPagePermission([1,2]);
    // verifica se o usuário tem permissão para utilizar o serviço
    if (($token[3] != 1 && $token[0] !== $id)) {
      header('HTTP/1.1 401 Unauthorized');
      exit();
    }

    $this->db->trans_start();
    $library = $this->User_model->getById($id);
    $library->Address = $this->Address_model->getById($library->Address);
    $library->Address->Zipcode = $this->Zipcode_model->getById($library->Address->Zipcode);
    $library->Address->Neighborhood = $this->Neighborhood_model->getById($library->Address->Neighborhood);
    $library->Address->City = $this->City_model->getById($library->Address->City);
    $library->Address->State = $this->State_model->getById($library->Address->State);
    $library->books = $this->Library_model->getBooks($library);
    $this->db->trans_complete();

    print(json_encode($library));
  }
}

?>
