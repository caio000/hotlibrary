<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *
 */
class Level extends CI_Controller {

  /**
   * Busca todos os níveis de usuário cadastrados no banco de dados.
   * @author Caio de Freitas
   * @since 2017/09/14
   * @return Retorna um coleção de objetos Level em formato json
   */
  function getAll() {
    $level = $this->Level_model->getAll();
    echo json_encode($level);
  }
}


?>
