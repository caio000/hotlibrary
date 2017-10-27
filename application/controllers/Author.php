<?php defined('BASEPATH') OR exit('No direct script access allowed');
  /**
   *
   */
  class Author extends CI_Controller {

    /**
     * Cadastra um novo(a) autor(a) no sistema.
     * @author Caio de Freitas Adriano
     * @since 2017/10/27
     * @param Object - Objeto Category com os dados do autor(a)
     * @return json - Retorna json com o resultado da requisição.
     */
    public function save () {
      // pega os dados do usuário que vieram da requisição
      $token = getToken();
      $this->auth->setUserLevel($token[3]);
      $this->auth->setPagePermission([1,2]);
      // verifica se o usuário tem permissão para utilizar o serviço
      if (!$this->auth->hasPermission()) {
        header('HTTP/1.1 401 Unauthorized');
        exit();
      }

      // pega os dados do autor(a)
      $post = file_get_contents('php://input');
      $author = json_decode($post);

      $result = $this->Author_model->insert($author);
      $msg = ($result) ? 'Cadastrou um novo(a) autor(a)' : 'Ocorreu um erro ao cadastrar o(a) autor(a)';
      $log = createLog($token[0],$msg);
      $this->Log_model->insert($log);

      $response['result'] = $result;
      print(json_encode($response));
    }

    /**
     * Busca todos os autores cadastrados no sistema
     * @author Caio de Freitas Adriano
     * @since 2017/10/24
     * @return Json - retorna um json com todos os autores cadastrados
     */
    public function getAll () {
      $authors = $this->Author_model->getAll();

      print(json_encode($authors));
    }
  }


?>
