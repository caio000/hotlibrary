<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *
 */
class Login extends CI_Controller {

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
