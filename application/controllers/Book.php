<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *
 */
class Book extends CI_Controller {

  /**
   * função para cadastrar um novo livro no sistema
   * @author Caio de Freitas Adriano
   * @since 2017/10/31
   * @param Object - Objeto Book com os dados do livro.
   * @return Json -
   */
  public function save () {

    $data = file_get_contents("php://input");
    print_r($data);
    // TODO: Criar funçõo para gravar os dados do livro
  }

  public function saveCover() {
    // pega os dados do usuário que vieram da requisição
    $token = getToken();
    $this->auth->setUserLevel($token[3]);
    $this->auth->setPagePermission([1,2]);
    // verifica se o usuário tem permissão para utilizar o serviço
    if (!$this->auth->hasPermission()) {
      header('HTTP/1.1 401 Unauthorized');
      exit();
    }

    // verifica se existe o diretorio "upload/books"
    // caso não exista, ele será criado.
    if (!file_exists('./upload/books')) mkdir('./upload/books',0777,true);

    // criando as configurações para o upload da imagem
    $config['upload_path']  = './upload/books'; // diretório de onde será gravado os dados.
    $config['allowed_types'] = 'jpg|png|jpeg';  // tipos de arquivos aceitos.
    $config['file_ext_tolower'] = true;         // a extenção dos arquivos será em minusculo
    $config['max_size'] = 2048;                 // tamanho máximo do arquivo 2048Kb (2Mb)
    $config['max_filename'] = 255;              // tamanho máximo do nome do arquivo

    // carrega a lib de upload
    $this->load->library('upload',$config);

    $result = $this->upload->do_upload('cover');
    $response['result'] = $result;
    $msg = ($result) ? 'Fez upload de uma capa de livro' : 'Ocorreu um erro ao carregar a capa de um livro';
    $log = createLog($token[0],$msg);
    $this->Log_model->insert($log);

    print(json_encode($response));
  }
}

?>
