<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Essa classe representa a relação PublishingCompany (Editora) na base de dados.
 * @author Caio de Freitas Adriano
 * @since 2017/10/28
 */
class PublishingCompany_model extends CI_Model {

  /**
   * Busca todas as editoras que não foram "deletadas" do banco de dados.
   * @author Caio de Freitas Adriano
   * @since 2017/10/28
   * @return ARRAY - Retorna um array de objetos PublishingCompany com os dados
   * das editoras.
   */
  public function getAll ($order=null) {
    $this->db->where('deleted',false);
    if ($order) {
      $this->db->order_by($order->column,$order->type);
    }
    $query = $this->db->get("PublishingCompany");

    return $query->result();
  }

  /**
   * Faz a persistencia de uma nova editora no banco de dados.
   * @author Caio de Freitas Adriano
   * @since 2017/10/28
   * @param Object - Objeto PublishingCompany com os dados da editora
   * @return Boolean - Retorna true caso a editora sejá cadastrada com sucesso.
   */
  public function insert ($PublishingCompany) {
    return $this->db->insert('PublishingCompany',$PublishingCompany);
  }

  /**
   * verifica se exista relação entre algum livro com a editora
   * @author caio de Freitas Adriano
   * @since 2017/10/28
   * @param INTEGER - id da editora
   * @return Boolean - retorna true caso exista algum relacionamento.
   */
  public function hasBook ($PublishingCompany) {
    $this->db->where('publishingCompany',$PublishingCompany);
    $query = $this->db->get('Book');

    return ($query->num_rows() >= 1) ? true : false;
  }

  /**
   * Altera o status de deletado para true.
   * @author Caio de Freitas Adriano
   * @since 2017/10/28
   * @param INTEGER - id da editora
   * @return Boolean - returna true o status seja alterado
   */
  public function delete ($PublishingCompany) {
    $query = false;

    if (!$this->hasBook($PublishingCompany)) {
      $this->db->set('deleted',true);
      $this->db->where('id',$PublishingCompany);
      $query = $this->db->update('PublishingCompany');
    }

    return $query;
  }
}

?>
