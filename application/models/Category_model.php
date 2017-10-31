<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Essa classe representa a relação Category no banco de dados.
 * @author Caio de Freitas Adriano
 * @since 2017/10/25
 */
class Category_model extends CI_Model {

  /**
   * Verifica se existe relacinamento entre algum livro com a categoria
   * informada.
   * @author Caio de Freitas Adriano
   * @since 2017/10/27
   * @param INTEGER - ID da categoria
   * @return BOOLEAN - retorna um boolean true caso exista relacinamento entre
   * algum livro com a categoria.
   */
  public function hasBook ($id) {
    $this->db->where('category',$id);
    $query = $this->db->get('Book_Category');

    return ($query->num_rows() >= 1) ? true : false;
  }

  /**
   * Altera o status de deletado para true.
   * @author Caio de Freitas Adriano
   * @since 2017/10/26
   * @param INTEGER - ID da categoria.
   * @return BOOLEAN - Retorna true caso o status sejá alterado com sucesso.
   */
  public function delete($id) {
    $query = false;

    if (!$this->hasBook($id)) {
      $this->db->set('deleted',true);
      $this->db->where('id',$id);
      $query = $this->db->update('Category');
    }

    return $query;
  }

  /**
   * Busca toda as categorias cadastradas no banco de dados.
   * @author Caio de Freitas Adriano
   * @since 2017/10/26
   * @return Array - Retona um array de objetos category com os dados da categoria.
   */
  public function getAll($order=null) {
    $this->db->where('deleted',false);
    if ($order) $this->db->order_by($order->column,$order->type);
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
