<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Objeto com os serviços disponiveis para os usuários.
 * @author Caio de Freitas Adriano
 * @since 2017/11/02
 */
class Book extends CI_Controller {

  /**
   * Edita os dados de um livro no sistema.
   * @author Caio de Freitas Adriano
   * @since 2017/11/07
   * @param Object - Objeto Book com os dados do livro
   * @return Json - retorna um json os dados da resposta da requisição
   */
  public function edit() {
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

    // manipulações no objeto book
    $book->name = strtolower(trim($book->name));
    $book->publishDate = brToSqlDate($book->publishDate);
    if ($book->publishingCompany) $book->publishingCompany = $book->publishingCompany[0]->id;
    $book->cover = filename($book->cover);

    $this->db->trans_start();
    $this->Book_model->update($book);
    $this->Book_model->clearCategory($book);
    // adiciona as categorias ao livro
    foreach ($book->categories as $category) $this->Book_model->setCategory($book,$category);
    $this->Book_model->clearAuthor($book);
    // adiciona os autores ao livro
    foreach ($book->authors as $author) $this->Book_model->setAuthor($book,$author);
    $this->db->trans_complete();

    $result = $this->db->trans_status();
    $responseMsg = ($result) ? 'Editou os dados do livro':'Ocorreu um erro ao editar os dados do livro';

    $log = createLog($token[0],$responseMsg);
    $this->Log_model->insert($log);

    $response['result'] = $result;
    $response['msg'] = $responseMsg;
    print(json_encode($response));

  }

  /**
   * deleta um livro do sistema
   * @author Caio de Freitas Adriano
   * @since 2017/11/06
   * @param Int - ID do livro
   * @return Json - retorna um json com o resultado da requisição
   */
  public function delete($id) {
    // pega os dados do usuário que vieram da requisição
    $token = getToken();
    $this->auth->setUserLevel($token[3]);
    $this->auth->setPagePermission([1]);
    // verifica se o usuário tem permissão para utilizar o serviço
    if (!$this->auth->hasPermission()) {
      header('HTTP/1.1 401 Unauthorized');
      exit();
    }

    $hasLibrary = $this->Book_model->hasLibrary($id);
    if (!$hasLibrary) {
      $result = $this->Book_model->setDeleted($id,true);
      $msg = ($result) ? 'Livro deletado com sucesso' : 'Ocorreu um erro ao deletar o livro';
    } else {
      $result = false;
      $msg = 'O livro não pode ser deletado';
    }

    $log = createLog($token[0],$msg);
    $this->Log_model->insert($log);

    $response['msg'] = $msg;
    $response['result'] = $result;

    print(json_encode($response));
  }

  /**
   * Busca os dados de um livro.
   * @author Caio de Freitas Adriano
   * @since 2017/11/06
   * @param Int - ID do livro
   * @return Json - Retona um objeto json com os dados do livro.
   */
  public function getById ($id,$withLibrary=false) {
    $this->db->trans_start();
    $book = $this->Book_model->getById($id);
    $book->publishingCompany = $this->PublishingCompany_model->getById($book->publishingCompany);
    $book->categories = $this->Book_model->getCategories($book);
    $book->authors = $this->Book_model->getAuthors($book);
    if ($withLibrary) {
      $book->libraries = $this->Book_model->getLibraries($book);
      foreach ($book->libraries as $library) {
        $library->address = $this->Address_model->getById($library->address);
        $library->address->City = $this->City_model->getById($library->address->City);
      }
    }
    $this->db->trans_complete();

    print(json_encode($book));
  }

  /**
   * adiciona um atributo picture com a tag img com a capa do livro.
   * @author Caio de Freitas Adriano
   * @since 2017/11/05
   * @param Array - Vetor com os objetos books
   * @return Array - Retorna o vetor com os objetos book com o novo atributo
   * picture.
   */
  private function setPicture($books) {
    foreach ($books as $book) {
      $book->picture = '<img src="'.base_url('upload/books/'.$book->cover).'">';
    }

    return $books;
  }

  /**
   * Busca todos os livros cadastrados no sistema
   * @author Caio de Freitas Adriano
   * @since 2017/11/5
   * @param Boolean (with_picture) - caso sejá true, será criado um atributo com
   * a tag img com a capa do livro.
   * @return Json - retorna um json com os livros.
   */
  public function getAll () {
    $params = (object) $this->input->get();
    $books = $this->Book_model->getAll();

    foreach ($books as $book) {
      $book->categories = $this->Book_model->getCategories($book);
      $book->authors = $this->Book_model->getAuthors($book);
    }

    // verifica os parametros da requisição
    if (isset($params->with_picture)) $books = $this->setPicture($books);
    print(json_encode($books));
  }

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
    if ($book->publishingCompany) $book->publishingCompany = $book->publishingCompany[0]->id;
    $book->cover = filename($book->cover);


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
    $config['file_name'] = filename($_FILES['cover']['name']);
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
