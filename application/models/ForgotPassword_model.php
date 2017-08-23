<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *
 */
class ForgotPassword_model extends CI_Model {

  /**
   * Essa função cria uma nova solicitação de troca de senha no banco de dados.
   * @author Caio de Freitas
   * @since 2017/08/17
   * @param ARRAY $request: Vetor com os dados da requisição (email, token, Data e hora)
   */
  function insert ($request) {
    $this->db->trans_start();
    $user = $this->User_model->getUserByEmail($request['email']);
    // Cria a solicitação no banco
    $this->db->insert('ForgotPassword',array(
      'expireAt'  => $request['datetime'],
      'token'     => $request['token'],
      'idUser'    => $user->id
    ));
    $this->db->trans_complete(); // Fim da transação

    // pega o status da transação
    $status = $this->db->trans_status();

    $message = ($status) ? 'Usuário solicitou a troca de senha' : 'Ocorreu um erro na solicitação da troca de senha';
    $log = createLog($user->id, $message);
    $this->Log_model->insert($log);

    return $status;
  }

  /**
   * Verifica se o token é valido
   * @author Caio de Freitas
   * @since 2017/08/22
   * @param String token
   * @return
   */
  function checkTokenValidation ($token) {

    $this->checkExpiredToken();

    $this->db->where('token',$token);
    $this->db->where('expireAt >= now()');
    $this->db->where('valid',TRUE);
    $result = $this->db->get("ForgotPassword")->num_rows();

    return (boolean) $result;
  }

  /**
   * Verifica a validade dos tokens
   * @author Caio de Freitas
   * @since 2017/08/22
   */
  private function checkExpiredToken () {
    $this->db->where('expireAt < now()');
    $this->db->where('valid',TRUE);
    $result = $this->db->update('ForgotPassword',['valid'=>FALSE]);

    return $result;
  }

}


?>
