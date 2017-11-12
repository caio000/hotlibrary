<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *
 */
class Login extends CI_Controller {

  /**
   * Verifica se o cliente informado existe no sistema
   * @author Caio de Freitas Adriano
   * @since 2017/11/11
   * @param Object - Objeto User com os dados do usuário
   * @return Json - Retorna um json com os dados do usuário, caso o mesmo exista
   * no sistema.
   */
  public function client () {
    $post = file_get_contents("php://input");
    $user = json_decode($post);

    // Verifica se os dados foram recebidos
    if ( empty($user) ) {
      header('HTTP/1.1 412 Parameters not received');
      exit();
    }

    // manipulações no objeto
    $user->password = hash('SHA512',$user->password);
    $user->isActive = true;
    $level = [3]; // login permitido apenas para clientes

    $user_array = [
      'email' => $user->email,
      'password' => $user->password
    ];
    $response['result'] = $this->User_model->exist($user_array,$level);

    if ($response['result']) {
      $log = createLog($response['result']->id,'Fez login');
      $this->Log_model->insert($log);
    }

    print(json_encode($response));
  }

  /**
   * verifica se um usuário informado está cadastrado no sistema.
   * @author Caio de Freitas
   * @since 2017/08/02
   * @param null
   * @return STRING Json: Retorna um objeto json com os resultados.
   */
  public function administration () {

    $this->load->model(array('User_model'));

    $post = file_get_contents('php://input');
    $User = json_decode($post);


    // Verifica se os dados foram recebidos
    if ( empty($User) ) {
      header('HTTP/1.1 412 Parameters not received');
      exit();
    }

    // Manipulações necessárias nos dados
    // coloca o email em minusculo
    $User->email = strtolower($User->email);
    // Gera um hash na senha do usuário
    $User->password = hash('SHA512',$User->password);
    // Adiciona o status do usuário com ativo (TRUE)
    $User->isActive = TRUE;
    // Adiciona os niveis permitidos para fazer login
    $level = array(1,2);

    // Verifica se o usuário existe no banco de dados
    $user_array = get_object_vars($User);
    $response['result'] = $this->User_model->exist($user_array,$level);

    if ( $response['result'] ) {
      // Pega o id do usuário que está fazendo o login.
      $idUser = $response['result']->id;
      $log = createLog($idUser,'Fez login');
      $this->Log_model->insert($log);
    }

    echo json_encode($response);

  }

}

?>
