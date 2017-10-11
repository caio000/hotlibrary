<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *
 */
class State_model extends CI_Model {

  /**
   * verifica se existe o estado informado, caso não exista o mesmo é cadastrado
   * na base de dados. Caso o estado já exista é retornado o seu identificador.
   * @author Caio de Freitas
   * @since 2017/09/29
   * @param Object objeto estado que será persistido.
   * @return INT Retorna o id do estado.
   */
  public function insert($state) {

    if ($this->exist($state)) {
      $state = $this->getByInitials($state['initials']);
      $result = $state->id;
    } else {
      $this->db->insert('State',$state);
      $result = $this->db->insert_id();
    }

    return $result;
  }

  /**
   * Busca um estado pela sua sigla.
   * @author Caio de Freitas Adriano
   * @since 2017/09/29
   * @param String sigla do estado
   * @return Object Retorna um objeto com os dados do estado
   */
  public function getByInitials($initials) {
    $this->db->where('initials',$initials);
    $query = $this->db->get('State');

    return $query->row();
  }

  /**
   * Verifica se o estado informado já está cadastrado na base de dados.
   * @author Caio de Freitas Adriano
   * @since 2017/09/29
   * @param objeto estado que será consultado.
   * @return Retorna um boolean true caso o estado já estejá cadastrado.
   */
  public function exist ($state) {
    $this->db->where('initials',$state['initials']);
    $query = $this->db->get('State');

    return ($query->num_rows() == 1) ? TRUE : FALSE;
  }

}


?>
