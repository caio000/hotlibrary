<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *
 */
class Author_model extends CI_Model {

  /**
   * Verifica se exise alguma relação entre livros e o autor informado.
   * @author Caio de Freitas Adriano
   * @since 2017/10/27
   * @param INT - id do autor
   * @return BOOlEAN - returna true caso exista alguma relação entre livros e o
   * autor informado.
   */
  public function has_book($id) {
    $this->db->where('author',$id);
    $query = $this->db->get('Book_Author');

    return ($query->num_rows() >= 1) ? true : false;
  }

  /**
   * altera o status de deletado para true.
   * @author Caio de Freitas Adriano
   * @since 2017/10/27
   * @param INT - id do autor
   * @return BOOLEAN - retorna true caso o status seja alterado.
   */
  public function delete ($id) {
    $query = false;

    if (!$this->has_book($id)) {
      $this->db->set('deleted',true);
      $this->db->where('id',$id);
      $query = $this->db->update("Author");
    }

    return $query;
  }

  /**
   * Insere um novo(a) autor(a) no banco de dados
   * @author Caio de Freitas Adriano
   * @since 2017/10/27
   * @param Object - Objeto author com os dados do autor.
   * @return Boolean - retorna true caso o(a) autor(a) sejá cadastrado com sucesso.
   */
  public function insert ($author){
    return $this->db->insert("Author",$author);
  }

  /**
   * Busca todos os autores cadastrados no banco de dados
   * @author Caio de Freitas Adriano
   * @since 2017/10/24
   * @return ARRAY - Retorna um vetor com objetos Author com os dados dos autores
   */
  public function getAll() {
    $this->db->where('deleted',false);
    $query = $this->db->get("Author");

    return $query->result();
  }

}

?>
