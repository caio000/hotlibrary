<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *
 */
class Author_model extends CI_Model {

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
