<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Essa classe contem todos as métodos relacionado ao usuário.
 * @author Caio de Freitas Adriano
 * @since 2017/07/20
 */
class User extends CI_Controller {

  function index() {
    $this->load->view("user/index");
  }
}


?>
