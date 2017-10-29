<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Essa classe possui todos os serviços relacionados a editoras.
 * @author Caio de Freitas Adriano
 * @since 2017/10/28
 */
class PublishingCompany extends CI_Controller {

  /**
   * Cadastra uma nova editora no sistema.
   * @author Caio de Freitas Adriano
   * @since 2017/10/28
   * @param Json - Objeto json com os dados da editora
   * @return Json - retorna um objeto json o resultado da requisição
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

    $post = file_get_contents("php://input");
    $publishingCompany = json_decode($post); // pega os dados que vieram do font-end

    // Faz os modificações necessárias no objeto
    $publishingCompany->name = strtolower($publishingCompany->name);

    // faz a persistencia da editora no banco
    $result = $this->PublishingCompany_model->insert($publishingCompany);
    $msg = ($result) ? 'Cadastrou uma editora' : 'Ocorreu um erro ao cadastrar uma editora';
    $log = createlog($token[0],$msg);
    $this->Log_model->insert($log);

    $response['result'] = $result;
    print(json_encode($response));
  }

  /**
   * Busca todas as editoras cadastradas no sistema.
   * @author Caio de Freitas Adriano
   * @since 2017/10/28
   * @return Json - retona um json com todas as editoras cadastradas no sistema.
   */
  public function getAll() {
    $publishingCompanies = $this->PublishingCompany_model->getAll();
    print(json_encode($publishingCompanies));
  }

  /**
   * Deleta uma editora do sisema
   * @author Caio de Freitas Adriano
   * @since 2017/10/28
   * @param INTEGER - id da editora
   * @return Json - Retorna um json o resultado da requisição
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

    $result = $this->PublishingCompany_model->delete($id);
    $msg = ($result) ? 'Deletou uma editora' : 'Ocorreu um erro ao deletar editora';
    $log = createlog($token[0],$msg);
    $this->Log_model->insert($log);

    $response['result'] = $result;
    print(json_encode($response));
  }
}

?>
