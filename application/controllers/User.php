<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Essa classe contem todos as métodos relacionado ao usuário.
 * @author Caio de Freitas Adriano
 * @since 2017/07/20
 */
class User extends CI_Controller {

  /**
   * Cadastra um usuário no sistema.
   * @author Caio de Freitas
   * @since 2017/07/30
   * @param
   * @return
   */
  public function saveUser() {

    $this->load->model('User_model');
    $this->load->database();
    // pega os dados da requisição HTTP do angular
    $post = file_get_contents("php://input");
    // Transforma o objeto Json em um objeto PHP
    $User = json_decode($post);

    // Apartir desse ponto vamos fazer as manipuções necessárias nos dados
    // Deixando o nome do usuário em minusculo
    $User->name = strtolower($User->name);
    $User->email = strtolower($User->email);
    // Gera um hash na senha do usuário
    $User->password = hash('SHA512',$User->password);

    // Caso ocorra um problema na persistencia a requisição retorna com um erro 404
    if ( !$this->User_model->insert($User) )
      header('HTTP/1.1 500 Ocorreu um erro inesperado. Tente novamente ou entre em contato com o administrador do sistema');

  }

  /**
   * verifica se um usuário informado está cadastrado no sistema.
   * @author Caio de Freitas
   * @since 2017/08/02
   * @param null
   * @return STRING Json: Retorna um objeto json com os resultados.
   */
  public function validate () {

    $this->load->model(array('User_model'));
    $this->load->database();

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

    // Verifica se o usuário existe no banco de dados
    $user_array = get_object_vars($User);
    $result = $this->User_model->exist($user_array);

    echo json_encode($result);

  }
}


?>
