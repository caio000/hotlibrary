<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Essa classe contem todos as métodos relacionado ao usuário.
 * @author Caio de Freitas Adriano
 * @since 2017/07/20
 */
class User extends CI_Controller {

  /**
   * Exibe um json com todos os usuários cadastrados no sistema.
   * @author Caio de Freitas
   * @since 2017/09/11
   * @return Json com os dados dos usuários.
   */
  public function getAll() {
    $users = $this->User_model->getAll();
    echo json_encode($users);
  }

  /**
   * Altera a senha do usuário.
   * @author Caio de Freitas
   * @since 2017/08/28
   */
  public function changePassword () {
    $post = file_get_contents("php://input");
    $user = json_decode($post);
    $token = $user->token;
    unset($user->token); // Deleta o atributo token o objeto user.

    // Gera um hash da nova senha
    $user->password = hash('SHA512',$user->password);

    // Atualiza os dados do usuário
    $response['result'] = $this->User_model->update($user);

    // gera o log
    $log = createLog($user->id,'Usuário alterou a senha');
    $this->Log_model->insert($log);

    // desativa o token
    $this->ForgotPassword_model->disable($token);
    echo json_encode($response);
  }

  /**
   * Cadastra um usuário no sistema.
   * @author Caio de Freitas
   * @since 2017/07/30
   * @param objeto json com os dados do usuário
   * @return Retorna um boolean True caso o usuário sejá cadastrado com sucesso
   */
  public function saveUser() {

    // FIXME: fazer correções para persistir o usuário no banco de dados.
    // IDEA: tentar fazer um validação dos dados aqui no back-end

    // pega os dados do usuário que vieram da requisição
    $token = getToken();
    $this->auth->setUserLevel($token[3]);
    $this->auth->setPagePermission([1]);
    // verifica se o usuário tem permissão para utilizar o serviço
    if (!$this->auth->hasPermission()) {
      header('HTTP/1.1 401 Unauthorized');
      exit();
    }


    // pega os dados da requisição HTTP do angular
    $post = file_get_contents("php://input");
    // Transforma o objeto Json em um objeto PHP
    $User = json_decode($post);

    // Apartir desse ponto vamos fazer as manipulações necessárias nos dados
    // Deixando o nome do usuário em minusculo
    $User->name = strtolower($User->name);
    $User->email = strtolower($User->email);
    // Gera um hash na senha do usuário
    $User->password = hash('SHA512',$User->password);


    // Caso ocorra um problema na persistencia a requisição retorna com um erro 404
    if ( !$this->User_model->insert($User) ) {
      header('HTTP/1.1 500 Ocorreu um erro inesperado. Tente novamente ou entre em contato com o administrador do sistema');

      $log = createLog($token[0], 'Ocorreu um erro ao cadastrar um novo usuário');
      $this->Log_model->insert($log);
      exit();
    }

    $log = createLog($token[0], 'Novo usuário cadastrado no sistema');
    $this->Log_model->insert($log);
  }

  /**
   * Cria uma solicitação para alterar a senha do usuário.
   * @author Caio de Freitas
   * @since 2017/08/16
   */
  public function forgotPassword () {
    $request['email'] = file_get_contents('php://input');
    // Gerar um token para a troca de senha
    $request['token'] = hash('SHA256',uniqid(rand(),TRUE));
    // pega o horario atual e soma 30 minutos
    $request['datetime'] = date('Y-m-d H:i:s',strtotime('+30 minutes'));

    // verifica se a solicitação foi criada para enviar um email para o usuário
    // com um link da página para alteração da senha
    if ( $this->ForgotPassword_model->insert($request) ) {
      // busca o html do email
      $user = $this->User_model->getUserByEmail($request['email']);
      $token = $request['token'];
      $html = $this->load->view('email/forgotpassword',compact('user','token'),TRUE);

      $email = new PHPMailer;

      $email->isSMTP();
      $email->Host = 'smtp.gmail.com';
      $email->CharSet = 'UTF-8';
      $email->SMTPAuth = TRUE;
      $email->Username = 'cronodevcaragua@gmail.com';
      $email->Password = '#cronodev2017#';
      $email->SMTPSecure = 'tls';
      $email->Port = 587;

      $email->setFrom('cronodevcaragua@gmail.com','Equipe Cronodev');
      $email->addAddress($user->email,$user->name);
      $email->Subject = 'Email test';
      $email->isHTML(TRUE);
      $email->msgHTML($html);

      $result = $email->send();

      echo json_encode(compact('result'));
    }


  }

  /**
   * Verifica se o email informado está cadastrado no sistema.
   * @author Caio de Freitas
   * @since 2017/08/16
   * @param String $email: email informado;
   * @return Retorna um boolean true caso o email informado já esteja cadastrado
   * no sistema.
   */
  public function existEmail () {
    $email = file_get_contents('php://input');

    $response['result'] = $this->User_model->existEmail($email);
    echo json_encode($response);

  }
}


?>
