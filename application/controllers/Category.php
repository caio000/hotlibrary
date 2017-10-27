<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Essa classe possui todos os metodos relacionados a categoria.
 * @author Caio de Freitas Adriano
 * @since 2017/10/25
 */
class Category extends CI_Controller {

  /**
   * Exclui uma categoria do sistema
   * @author Caio de Freitas Adriano
   * @since 2017/10/26
   * @param INTEGER - ID da categoria
   * @return JSON - Retorna um objeto json com um atributo result (boolean) com
   * o valor true caso a categoria sejá "deletada".
   */
  public function delete ($id) {
    // pega os dados do usuário que vieram da requisição
    $token = getToken();
    $this->auth->setUserLevel($token[3]);
    $this->auth->setPagePermission([1,2]);
    // verifica se o usuário tem permissão para utilizar o serviço
    if (!$this->auth->hasPermission()) {
      header('HTTP/1.1 401 Unauthorized');
      exit();
    }

    $result = $this->Category_model->delete($id);

    $message = ($result) ? 'Deletou uma categoria' : "Ocorreu uma erro ao deletar a categoria";
    $log = createLog($token[0],$message);

    // gravar log no banco de dados
    $this->Log_model->insert($log);

    $response['result'] = $result;

    print(json_encode($response));
  }

  /**
   * Exibe todas as categoria cadastradas no sistema
   * @author Caio de Freitas Adriano
   * @since 2017/10/26
   * @return Json - retorna um array com todos os
   */
  public function getAll() {
    $categories = $this->Category_model->getAll();
    print(json_encode($categories));
  }

  /**
   * Cadastra uma nova categoria no sistema.
   * @author Caio de Freitas Adriano
   * @since 2017/10/25
   * @param Object - Objeto Category com os dados da categoria
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

    $post = file_get_contents('php://input');
    $category = json_decode($post);


    $result = $this->Category_model->insert($category);
    $msg = ($result) ? 'Cadastrou uma nova categoria' : 'Ocorreu um erro ao cadastrar uma categoria';
    $log = createLog($token[0],'Cadastrou uma nova categoria');
    $this->Log_model->insert($log);

    $response['result'] = $result;

    print(json_encode($response));
  }
}

?>
