<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *
 */
class Token extends CI_Controller {

  /**
   * Valida o token para alterar a senha do usuário
   * @author Caio de Freitas
   * @since 2017/08/23
   * @param String token a ser validado
   * @return Caso o token sejá válido, é retornado o usuário que solicitou a
   * alteração da senha.
   */
  public function checkToken($token) {
    $isValid = $this->ForgotPassword_model->checkTokenValidation($token);

    if (!$isValid){
      header('HTTP/1.1 401 Unauthorized');
      exit();
    }

    $user = $this->ForgotPassword_model->getUserByToken($token);
    $user->token = $token;
    echo json_encode($user);
  }
}


?>
