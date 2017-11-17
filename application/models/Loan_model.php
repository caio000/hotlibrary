<?php defined('BASEPATH') OR exit('No direct script access allowed');

  /**
   * Essa classe representa a relação Loan no banco dados
   * @author Caio de Freitas Adriano
   * @since 2017/11/16
   */
  class Loan_model extends CI_Model {

    /**
     * Busca o número de solicitações de empréstimo em aberto de um usuário
     * @author Caio de Freitas Adriano
     * @since 2017/11/16
     * @param Object - Objeto client com os dados do cliente
     * @return Integer - Retona um a quantidade de empretos em aberto
     */
    public function numOpenLoan($client) {
      $this->db->where('client',$client->id);
      $this->db->where('returnDate',null);
      $query = $this->db->get("Loan");

      // echo $this->db->last_query();
      return $query->num_rows();
    }

    /**
     * Insere no banco uma nova solicitação de emprestimo
     * @author Caio de Freitas Adriano
     * @since 2017/11/16
     * @param Object - Objeto loan com os dados do emprestimo (Livro, cliente, biblioteca)
     * @return Boolean - retorna um Boolean true caso sejá criado a solicitação
     * de emprestimo com sucesso.
     */
    function insert ($loan) {
      $this->db->insert("Loan",$loan);
    }
  }

?>