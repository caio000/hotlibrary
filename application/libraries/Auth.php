<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Essa é uma classe para controlar as autorizações para acessar os serviços
 * da API.
 * @author Caio de Freitas
 * @since 2017/08/31
 */
class Auth {

  protected $CI;
  private $userLevel;
  private $pagePermission = [];

  function __construct() {
    $CI =& get_instance();
  }

  public function setUserLevel ($userLevel) {
    $this->userLevel = $userLevel;
  }

  public function setPagePermission ($pagePermission) {
    $this->pagePermission = $pagePermission;
  }

  /**
   * Verifica se o usuário logado tem permissão para acessar o serviço.
   * @author Caio de Freitas
   * @since 2017/08/31
   * @return Retorna um boolean true caso o usuário tenha permissão para acessar
   * o serviço.
   */
  public function hasPermission () {
    $result = FALSE;
    foreach ($this->pagePermission as $permission) {
      if ($permission == $this->userLevel) {
        $result = TRUE;
        break;
      }
    }
    return $result;
  }

}


 ?>
