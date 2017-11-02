<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Objeto com os serviços disponiveis para os usuários.
 * @author Caio de Freitas Adriano
 * @since 2017/11/02
 */
class Book extends CI_Controller {

  /**
   * função para cadastrar um novo livro no sistema
   * @author Caio de Freitas Adriano
   * @since 2017/10/31
   * @param Object - Objeto Book com os dados do livro.
   * @return Json - Retorna um json com o resultado da requisição.
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

    $data = file_get_contents("php://input");
    $book = json_decode($data);

    // Fazer todas as monipulações necessárias no objeto.
    $book->name = strtolower(trim($book->name));
    $book->publishDate = brToSqlDate($book->publishDate);
    $book->publishingCompany = $book->publishingCompany[0]->id;

    $this->db->trans_start();
    $this->Book_model->insert($book);
    $book->id = $this->db->insert_id();
    // adiciona os autores ao livro
    foreach ($book->authors as $author) $this->Book_model->setAuthor($book,$author);
    // adiciona as categorias ao livro
    foreach ($book->categories as $category) $this->Book_model->setCategory($book,$category);
    $this->db->trans_complete();

    $result = $this->db->trans_status();
    $msg = ($result) ? 'Cadastrou um livro' : 'Ocorreu um erro ao cadastrar um livro';
    $log = createLog($token[0],$msg);
    $this->Log_model->insert($log);

    $response['result'] = $result;
    print(json_encode($response));
  }

  /**
   * Faz o upload da imagem do capa do livro
   * @author Caio de Freitas Adriano
   * @since 2017/11/01
   * @param File - Recebe a imagem.
   * @return Json - retorna um json com o resultado da requisição
   */
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
    $config['overwrite'] = true;                // permite sobrescrever arquivos de mesmo nome

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
