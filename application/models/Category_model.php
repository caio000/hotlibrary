<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Essa classe representa a relação Category no banco de dados.
 * @author Caio de Freitas Adriano
 * @since 2017/10/25
 */
class Category_model extends CI_Model {

  /**
   * Busca toda as categorias cadastradas no banco de dados.
   * @author Caio de Freitas Adriano
   * @since 2017/10/26
   * @return Array - Retona um array de objetos category com os dados da categoria.
   */
  public function getAll() {
    $query = $this->db->get("Category");
    return $query->result();
  }

  /**
   * Insere uma nova categoria no banco de dados.
   * @author Caio de Freitas Adriano
   * @since 2017/10/25
   * @param Object - Objeto Category com os dados da categoria
   * @return BOOLEAN - Retona true caso a categoria sejá cadastrada com sucesso.
   */
  public function insert ($category) {
    return $this->db->insert('Category',$category);
  }
}

?>
