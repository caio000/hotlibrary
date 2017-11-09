<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Essa classe é responsavel em entregar os templates solicitados pelo
 * AngularJS.
 */
class Template extends CI_Controller {

  /**
   * @author Caio de Freitas
   * @since 31/07/2017
   * @param String - Caminho do template que será carregado. Para definir um
   * diretório utilize o character '-'.
   * Por exemplo: 'template-login' é convertido para 'template/login'
   * @return
   */
  function getTemplate($template) {
    // Procura pelo character '-' e troca pelo character '/'
    $template = str_replace('-','/',$template);
    // Carrega o template solicitado.
    $html = $this->load->view($template,NULL,TRUE);
    if ( empty($html) )
      header('HTTP/1.1 404 Not Found');
    else
      echo $html;
  }

  public function index() {
    $isMobile = preg_match('/(iPhone|iPod|iPad|Android|BlackBerry)/',$_SERVER['HTTP_USER_AGENT']);
    $page = ($isMobile) ? 'mobile/index.html' : 'mainPage.html';
    $this->load->view($page);
  }
}

?>
