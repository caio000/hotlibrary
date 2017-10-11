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
   * @return Boolean Retorna um Boolean true caso o endereço sejá cadastrado com
   * sucesso.
   */
  public function insert ($address) {
    $data = [
      'city'        => $address['City']['id'],
      'zipCode'     => $address['zipcode'],
      'number'      => $address['number'],
      'publicPlace' => $address['publicPlace']
    ];

    $this->db->insert('Address',$data);
    echo $this->db->last_query();

    return $this->db->insert_id();
  }
}


?>
