<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Essa classe contem todos as métodos relacionado ao usuário.
 * @author Caio de Freitas Adriano
 * @since 2017/07/20
 */
class User extends CI_Controller {

  public function saveUser() {

    $this->load->model('User_model');
    $this->load->database();
    // pega os dados da requisição HTTP do angular
    $post = file_get_contents("php://input");
    // Transforma o objeto Json em um objeto PHP
    $User = json_decode($post);

    // Apartir desse ponto vamos fazer as manipuções necessárias nos dados
    // Deixando o nome do usuário em minisculo
    $User->name = strtolower($User->name);
    $User->password = hash('SHA512',$User->password);

    // Caso ocorra um problema na persistencia a requisição retorna com um erro 404
    if ( !$this->User_model->insert($User) )
      header('HTTP/1.1 404 Ocorreu um erro inesperado. Tente novamente ou entre em contato com o administrador do sistema');

  }
}


?>
