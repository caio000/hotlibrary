<?php defined('BASEPATH') OR exit('No direct script access allowed');

  /**
   * Essa classe representa a relação Level no banco de dados.
   * @author Caio de Freitas
   * @since 2017/09/14
   */
  class Level_model extends CI_Model {

    /**
     * Busca todos os níveis de usuários cadastrados no banco de dados.
     * @author Caio de Freitas
     * @since 2017/09/14
     * @return Retorna uma coleção de objetos Level.
     */
    function getAll() {
      $query = $this->db->get('Level');

      return $query->result();
    }
  }


?>
