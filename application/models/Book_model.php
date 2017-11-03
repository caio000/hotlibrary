<?php defined('BASEPATH') OR exit('No direct script access allowed');


  /**
   * Essa classe representa a relação Book da base dados.
   * @author Caio de Freitas Adriano
   * @since 2017/11/02
   */
  class Book_model extends CI_Model {

    /**
     * Busca todos os livros cadastrados no banco de dados
     * @author Caio de Freitas Adriano
     * @since 2017/11/02
     * @return Array - Retorna um vetor com objetos Book com os dados dos livros
     */
    public function getAll () {
      $this->db->where("deleted",false);
      return $this->db->get("Book")->result();
    }

    /**
     * faz o vinculo da categoria ao livro.
     * @author Caio de Freitas Adriano
     * @since 2017/11/02
     * @param Object - Objeto Book com os dados do livro
     * @param Object - Objeto category com os dados da categoria
     * @return Boolen - Retorna true caso o objeto sejá persistido com sucesso.
     */
    public function setCategory($book,$category) {
      $data = new stdClass();
      $data->book = $book->id;
      $data->category = $category->id;
      return $this->db->insert("Book_Category",$data);
    }

    /**
     * Faz os vinculo do autor ao livro no banco de dados.
     * @author Caio de Freitas Adriano
     * @since 2017/11/02
     * @param Object - objeto book os dados do livro.
     * @param Object - Objeto author com os dados do autor.
     * @return Boolean - Retorna true caso o objeto sejá persistido com sucesso.
     */
    public function setAuthor($book,$author) {
      $data = new stdClass();
      $data->book = $book->id;
      $data->author = $author->id;
      return $this->db->insert("Book_Author",$data);
    }

    /**
     * Faz a persistencia do objeto book
     * @author Caio de Freitas Adriano
     * @since 2017/11/02
     * @param Object - Objeto book com os dados do livro.
     * @return BOOLEAN - return true caso o livro sejá persistido com sucesso
     */
    function insert($book) {
      return $this->db->insert('Book',$book);
    }
  }

?>
