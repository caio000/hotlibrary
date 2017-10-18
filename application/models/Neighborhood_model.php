<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *
 */
class Neighborhood_model extends CI_Model {

  /**
   * Insere um bairro no banco de dados caso não exista o bairro informado
   * @author Caio de Freitas Adriano
   * @since 2017/09/29
   * @param objeto bairro que será persistido
   * @return Retorna o id do bairro
   */
  public function insert($neighborhood) {
    $result = null;

    if ($this->exist($neighborhood['name'])) {
      $neighborhood = $this->getByName($neighborhood['name']);
      $result = $neighborhood['id'];
    } else {
      $this->db->insert('Neighborhood',$neighborhood);
      $result = $this->db->insert_id();
    }

    return $result;
  }

  /**
   * verifica se o bairro informado existe no banco de dados
   * @author Caio de Freitas Adriano
   * @since 2017/09/29
   * @param Nome do bairro
   * @return Retorna um boolean true caso o bairro já esteja cadastrado no banco de dados.
   */
  public function exist($name) {
    $this->db->where('name',$name);
    $query = $this->db->get('Neighborhood');

    $result = ($query->num_rows() == 1) ? TRUE : FALSE;

    return $result;
  }

  /**
   * Busca um bairro no banco de dados pelo seu nome
   * @author Caio de Freitas
   * @since 2017/09/29
   * @param Nome do bairro
   * @return Retorna um objeto com os dados do bairro.
   */
  public function getByName($name) {
    $this->db->where('name',utf8_encode($name));
    $query = $this->db->get("Neighborhood");

    echo $this->db->last_query();

    return $query->row();
  }

  public function getById ($id) {
    $this->db->select('name');
    $this->db->where('id',$id);
    $query = $this->db->get('Neighborhood');

    return $query->row();
  }
}



?>
