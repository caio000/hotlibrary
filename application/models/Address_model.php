<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *
 */
class Address_model extends CI_Model {

  /**
   * Cadastra um novo endereço na base de dados.
   * @author Caio de Freitas
   * @since 2017/09/29
   * @param Object Objeto com os dados sobre o endereço.
   * @return INT - Retorna o ID do endereço caso sejá cadastrado com sucesso.
   */
  public function insert ($address) {
    $this->db->insert('Address',$address);

    return $this->db->insert_id();
  }

  public function getById ($id) {
    $this->db->select("id, zipcode, Address.publicPlace, Address.number, Address.city as City");
    $this->db->where('id',$id);
    $query = $this->db->get("Address");

    return $query->row();
  }

  /**
   * Atualiza os dados do endereço no banco de dados.
   * @author Caio de Freitas Adriano
   * @since 2017/10/19
   * @param Object - Objeto Address com os dados do endereço.
   * @return Boolean - Retorna um True caso os dados sejam atualizados com sucesso
   */
  public function update ($address) {
    $this->db->where('id',$address->id);
    return $this->db->update("Address", $address);
  }
}


?>
