<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Essa classe representa a relação Category no banco de dados.
 * @author Caio de Freitas Adriano
 * @since 2017/10/25
 */
class Category_model extends CI_Model {

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
