<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *
 */
class City_model extends CI_Model {

  /**
   * verifica se existe a cidade informada, caso não exista o mesmo é cadastrado
   * na base de dados. Caso a cidade já exista é retornado o seu identificador.
   * @author Caio de Freitas
   * @since 2017/09/29
   * @param Object objeto cidade que será persistido.
   * @return INT Retorna o id da cidade.
   */
  public function insert($city) {

    if ($this->exist($city)) {
      $city = $this->getByName($city['name']);
      $result = $city->id;
    } else {
      $data = [
        'name'          => $city['name'],
        'state'         => $city['State']['id'],
        'neighborhood'  => $city['Neighborhood']['id']
      ];
      $this->db->insert('City',$data);
      $result = $this->db->insert_id();
    }

    return $result;
  }

  /**
   * Busca uma cidade pelo seu nome
   * @author Caio de Freitas Adriano
   * @since 2017/09/29
   * @param String name da cidade
   * @return Object Retorna um objeto com os dados da cidade.
   */
  public function getByName($name) {
    $this->db->where('name',$name);
    $query = $this->db->get('City');

    return $query->row();
  }

  /**
   * Verifica se a cidade informada já está cadastrada na base de dados.
   * @author Caio de Freitas Adriano
   * @since 2017/09/29
   * @param objeto cidade que será consultada.
   * @return Retorna um boolean true caso a cidade já estejá cadastrada.
   */
  public function exist ($city) {
    $this->db->where('name',$city['name']);
    $query = $this->db->get('City');

    return ($query->num_rows() == 1) ? TRUE : FALSE;
  }

  /**
   *
   */
  public function getById($id) {
    $this->db->select('name, neighborhood as Neighborhood, state AS State');
    $this->db->where("id",$id);
    $query = $this->db->get("City");

    return $query->row();
  }

}


?>
