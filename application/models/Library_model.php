<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Essa classe representa a relação Library no banco de dados.
 * @author Caio de Freitas Adriano
 * @since 2017/10/22
 */
class Library_model extends CI_Model {

  /**
   * Faz a persistencia do usuário do tipo biblioteca.
   * @author caio de freitas Adriano
   * @since 2017/11/03
   * @param Object - Objeto User com os dados do usuário.
   * @return Boolean - Retorna um true caso a persistencia ocorra com sucesso
   */
  public function insert($user){
    return $this->db->insert("Library",['id'=>$user->id]);
  }

}


?>
