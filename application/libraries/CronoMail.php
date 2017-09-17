<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Essa classe é responsavel em enviar email.
 * Essa classe está utilizando a lib PHPMailer para enviar emails,
 * para evitar de fazer a configuração da lib toda vez que seja necessário
 * um email as configurações ficaram aqui.
 * Sendo assim necessário apenas informar apenas o email para quem será enviado,
 * conteúdo e assunto do email.
 * @since 2017/09/15
 * @author Caio de Freitas
 */
class CronoMail {

  protected $phpMailer;

  function __construct() {
    $this->phpMailer = new PHPMailer;
    $this->phpMailer->isSMTP();
    $this->phpMailer->Host = 'smtp.gmail.com';
    $this->phpMailer->CharSet = 'UTF-8';
    $this->phpMailer->SMTPAuth = TRUE;
    $this->phpMailer->Username = 'cronodevcaragua@gmail.com';
    $this->phpMailer->Password = '#cronodev2017#';
    $this->phpMailer->SMTPSecure = 'tls';
    $this->phpMailer->Port = 587;

    $this->phpMailer->setFrom('cronodevcaragua@gmail.com','Equipe Cronodev');
    $this->phpMailer->isHTML(TRUE);
  }

  public function getError() {
    return $this->phpMailer->ErrorInfo;
  }

  public function send () {
    return $this->phpMailer->send();
  }

  public function setContent ($content) {
    $this->phpMailer->msgHTML($content);
  }

  /**
   * Configura o nome e o phpMailer para onde a mensagem será enviada.
   * @author Caio de Freitas
   * @since 2017/09/15
   * @param endereço de email
   * @param nome
   */
  public function to ($email, $name) {
    $this->phpMailer->addAddress($email,$name);
  }

  /**
   * Configura o assunto do email.
   * @author Caio de Freitas
   * @since 2017/09/15
   * @param Assunto do email
   */
  public function setSubject ($subject) {
    $this->phpMailer->Subject = $subject;
  }
}


?>
