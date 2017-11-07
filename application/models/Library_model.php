<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Essa classe representa a relação Library no banco de dados.
 * @author Caio de Freitas Adriano
 * @since 2017/10/22
 */
class Library_model extends CI_Model {

  /**
   * Altera o status de deletado pra true.
   * @author Caio de Freitas Adriano
   * @since 2017/11/07
   * @param Int - ID da biblioteca
   * @param Int - ID do livro
   * @return Boolean - Retorna um boolean true caso o status seja alterado com sucesso.
   */
  public function deleteBook($library,$book) {
    $this->db->set('deleted',true);
    $this->db->where('library',$library);
    $this->db->where('book',$book);
    return $this->db->update('Library_has_Book');
  }

  /**
   * adiciona o vinculo da biblioteca ao livro no banco de dados.
   * @author Caio de Freitas Adriano
   * @since 2017/11/05
   * @param Int - ID da biblioteca
   * @param Int - ID do livro livro
   * @return Boolean - Retorna true caso seja feito a persistencia com sucesso
   */
  public function addBook($library,$book) {
    return $this->db->insert("Library_has_Book",['library'=>$library,'book'=>$book]);
  }

  /**
   * Busca todos os livros de uma biblioteca
   * @author Caio de Freitas Adriano
   * @since 2017/11/05
   * @param Object - Objeto Library com os dados da biblioteca.
   * @return Array - Retorna um vetor com os objetos books
   */
  public function getBooks($library) {
    $this->db->select('Book.*');
    $this->db->where('library',$library->id);
    $this->db->where('Library_has_Book.deleted',false);
    $this->db->join('Book','Book.id = Library_has_Book.book');
    return $this->db->get("Library_has_Book")->result();
  }

  /**
   * Faz a persistencia do usuário do tipo biblioteca.
   * @author caio de freitas Adriano
   * @since 2017/11/03
   * @param Object - Objeto User com os dados do usuário.
   * @return Boolean - Retorna um true caso a persistencia ocorra com sucesso
   */
  public function insert($user){
    return $this->db->insert("Library",['id'=>$user->id]);
  }

}


?>
