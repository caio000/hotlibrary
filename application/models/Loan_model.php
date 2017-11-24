<?php defined('BASEPATH') OR exit('No direct script access allowed');

  /**
   * Essa classe representa a relação Loan no banco dados
   * @author Caio de Freitas Adriano
   * @since 2017/11/16
   */
  class Loan_model extends CI_Model {

    /**
     * Atualiza os dados do objeto loan
     * @author Caio de Freitas Adriano
     * @since 2017/11/21
     * @param Object - Objeto loan (Empréstimo)
     * @return BOOLEAN - Retorna true caso os dados sejam atualizados com sucesso
     */
    public function update($loan) {
      $this->db->where('id',$loan->id);
      return $this->db->update('Loan',$loan);
    }

    /**
     * Busca todas as solicitações de emprestimo (não confirmadas) de uma biblioteca
     * @author Caio de Freitas Adriano
     * @since 2017/11/17
     * @param Int - ID da biblioteca
     * @return Array - retorna um vetor com as solicitações.
     */
    public function notificationFrom($library) {
      $this->db->where('library',$library);
      $this->db->where('loanDate',null);
      return $this->db->get("Loan")->result();
    }

    /**
     * Busca o número de solicitações de empréstimo em aberto de um usuário
     * @author Caio de Freitas Adriano
     * @since 2017/11/16
     * @param Object - Objeto client com os dados do cliente
     * @return Integer - Retona um a quantidade de empretos em aberto
     */
    public function numOpenLoan($client) {
      $this->db->where('client',$client->id);
      $this->db->where('loanDate',null);
      $this->db->where('returnDate',null);
      $query = $this->db->get("Loan");

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
