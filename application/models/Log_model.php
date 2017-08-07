<?php defined('BASEPATH') OR exit('No direct script access allowed');

  /**
   * Essa classe representa a relação Log do banco de dados
   * @author Caio de Freitas
   * @since 2017/08/04
   */
  class Log_model extends CI_Model{

    /**
     * Insere um log no banco de dados.
     * @author Caio de Freitas
     * @since 2017/08/04
     * @param $log - Recebe um vetor ou um objeto com os dados que serão
     * persistidos no banco de dados.
     * @return Retorna um BOOLEAN TRUE caso o log seja persistido com sucesso.
     */
    function insert ($log) {
      return $this->db->insert('Log',$log);
    }
  }


?>
