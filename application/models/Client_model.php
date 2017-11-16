<?php defined('BASEPATH') OR exit('No direct script access allowed');

  /**
   * Essa classe representa a relação Client no banco de dados.
   * @author Caio de Freitas Adriano
   * @since 2017/11/16
   */
  class Client_model extends CI_Model {

    /**
     * Busca os dados de um cliente.
     * @author Caio de Freitas Adriano
     * @since 2017/11/16
     * @param Integer - ID do cliente
     * @return Object - Retorna um objeto com os dados do cliente
     */
    public function getById($id) {
      $this->db->select("User.*,Client.notLoan");
      $this->db->join("User","User.id = Client.id");
      $this->db->where('Client.id',$id);
      return $this->db->get("Client")->row();
    }
  }

?>
