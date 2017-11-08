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
   * Exibe os dados de um usuário expecifico do sistema.
   * @author Caio de Freitas Adriano
   * @since 2017/10/18
   * @param INT - Identificador do usuário
   * @return JSON - Retona os dados do usuário no formato json
   */
  public function getById ($id) {
    $user = $this->User_model->getById($id);
    $user->Address = $this->Address_model->getById($user->Address);
    $user->Address->Zipcode = $this->Zipcode_model->getById($user->Address->Zipcode);
    $user->Address->City = $this->City_model->getById($user->Address->City);
    $user->Address->Neighborhood = $this->Neighborhood_model->getById($user->Address->Neighborhood);
    $user->Address->State = $this->State_model->getById($user->Address->State);

    echo json_encode($user);
  }

  /**
   * Altera a senha do usuário.
   * @author Caio de Freitas
   * @since 2017/08/28
   */
  public function changePassword () {
    $post = file_get_contents("php://input");
    $user = json_decode($post);
    if (isset($user->token)) {
      $token = $user->token;
      unset($user->token); // Deleta o atributo token o objeto user.
    }

    // Gera um hash da nova senha
    $user->password = hash('SHA512',$user->password);

    // Atualiza os dados do usuário
    $response['result'] = $this->User_model->update($user);
    $response['user'] = $user;

    // gera o log
    $log = createLog($user->id,'Usuário alterou a senha');
    $this->Log_model->insert($log);

    // desativa o token
    if (isset($token)) $this->ForgotPassword_model->disable($token);
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

    $user = json_decode($post);

    $user->password = hash('SHA512',$user->password);

    $this->db->trans_start();
    $user->Address->city = $this->City_model->insert($user->Address->City);
    $user->Address->zipcode = $this->Zipcode_model->insert($user->Address->Zipcode);
    $user->Address->neighborhood = $this->Neighborhood_model->insert($user->Address->Neighborhood);
    $user->Address->state = $this->State_model->insert($user->Address->State);

    $user->address = $this->Address_model->insert($user->Address);
    $user->level = $user->Level->id;
    $this->User_model->insert($user);
    $user->id = $this->db->insert_id();
    $this->Library_model->insert($user);

    $this->db->trans_complete();

    if ( !$this->db->trans_status() ) {
      header('HTTP/1.1 500 Ocorreu um erro inesperado. Tente novamente ou entre em contato com o administrador do sistema');
      $log = createLog($token[0], 'Ocorreu um erro ao cadastrar um novo usuário');
      $this->Log_model->insert($log);
      exit();
    }

    $mail = $this->load->view('email/confirmRegistration',null,TRUE);
    $this->cronomail->setContent($mail);
    $this->cronomail->setSubject('Acesso ao sistema Hotlibrary');
    $this->cronomail->to($user->email,$user->name);

    $this->cronomail->send();

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

      $this->cronomail->setContent($html);
      $this->cronomail->setSubject('Hotlibrary - Esqueceu a senha');
      $this->cronomail->to($user->email,$user->name);
      $result = $this->cronomail->send();

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

  /**
   * Desativa um usuário no sistema
   * @author Caio de Freitas
   * @since 2017/10/09
   */
  public function block () {

    // pega os dados do usuário que vieram da requisição
    $token = getToken();
    $this->auth->setUserLevel($token[3]);
    $this->auth->setPagePermission([1]);
    // verifica se o usuário tem permissão para utilizar o serviço
    if (!$this->auth->hasPermission()) {
      header('HTTP/1.1 401 Unauthorized');
      exit();
    }

    $idUser = file_get_contents("php://input");

    $result = $this->User_model->setActive($idUser, FALSE);
    $response['result'] = $result;

    $msg = ($result) ? 'Fez o bloqueio de um usuário':'Ocorreu um erro ao bloquear um usuário';
    $log = createLog($token['id'],$msg);
    $this->Log_model->insert($log);

    echo json_encode($response);
  }

  /**
   * Ativa um usuário no sistema
   * @author Caio de Freitas
   * @since 2017/10/09
   */
  public function unlock () {

    // pega os dados do usuário que vieram da requisição
    $token = getToken();
    $this->auth->setUserLevel($token[3]);
    $this->auth->setPagePermission([1]);
    // verifica se o usuário tem permissão para utilizar o serviço
    if (!$this->auth->hasPermission()) {
      header('HTTP/1.1 401 Unauthorized');
      exit();
    }

    $idUser = file_get_contents("php://input");
    $result = $this->User_model->setActive($idUser, TRUE);
    $msg = ($result) ? 'Fez o desbloqueio de um usuário' : 'Ocorreu um erro ao desbloquear um usuário';
    $log = createLog($token[0],$msg);
    $this->Log_model->insert($log);
    $response['result'] = $result;

    echo json_encode($response);
  }

  /**
   * Edita os dados do usuário no sistema
   * @author Caio de Freitas Adriano
   * @since 2017/10/18
   */
  public function edit () {

    // pega os dados do usuário que vieram da requisição
    $token = getToken();
    $this->auth->setUserLevel($token[3]);
    $this->auth->setPagePermission([1,2]);
    // verifica se o usuário tem permissão para utilizar o serviço
    if (!$this->auth->hasPermission()) {
      header('HTTP/1.1 401 Unauthorized');
      exit();
    }

    $user = file_get_contents('php://input');
    $user = json_decode($user);

    $this->db->trans_start();
    $user->Address->neighborhood = $this->Neighborhood_model->insert($user->Address->Neighborhood);
    $user->Address->city = $this->City_model->insert($user->Address->City);
    $this->Address_model->update($user->Address);
    $this->User_model->update($user);
    $this->db->trans_complete();

    $result = $this->db->trans_status();
    $response['result'] = $result;

    $msg = ($result) ? 'Editou os dados do usuário':'Ocorreu um erro ao editar as dados de um usuário';
    $log = createLog($token[0],$msg);
    $this->Log_model->insert($log);

    print(json_encode($response));
  }


}


?>
