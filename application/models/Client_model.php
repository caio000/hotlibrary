<?php defined('BASEPATH') OR exit('No direct script access allowed');

  /**
   * Essa classe representa a relação Client no banco de dados.
   * @author Caio de Freitas Adriano
   * @since 2017/11/16
   */
  class Client_model extends CI_Model {

    /**
     * Faz a persistencia de um novo cliente na base de dados
     * @author Caio de Freitas Adriano
     * @since 2017/11/24
     * @param Object - Objeto User com os dados do usuário (cliente)
     * @return Boolean - Retorna um true caso o objeto seja persistido com sucesso
     */
    public function insert($user) {
      return $this->db->insert("Client",['id'=>$user->id]);
    }

    /**
     * Busca todos os emprestimos até a data atual
     * @author Caio de Freitas Adriano
     * @since 2017/11/19
     * @param INT - ID do cliente
     * @return Array - Retorna um vetor de objetos Loan (empréstimo)
     */
    public function getLoanHistory($clientId) {
      $this->db->where('client',$clientId);
      $this->db->where('loanDate <= now()');
      $this->db->order_by('loanDate');
      return $this->db->get('Loan')->result();
    }

    /**
     * busca todos os emprestimos que foram cancelados.
     * @author Caio de Freitas Adriano
     * @since 2017/11/19
     * @param INT - ID do cliente
     * @return Array - Retorna um vetor de objetos Loan (empréstimo)
     */
    public function getCanceledLoan($clientId) {
      $this->db->where('client',$clientId);
      $this->db->where('returnDate',null);
      $this->db->where('loanDate is not null');
      return $this->db->get("Loan")->result();
    }

    /**
     * Busca os livros que o usuário pegou emprestado atualmente.
     * @author Caio de Freitas Adriano
     * @since 2017/11/19
     * @param INT - ID do cliente
     * @return Array - retorna um vetor de objetos loan com os dados do emprestimo.
     */
    public function getMyBooks ($clientId) {
      $this->db->where('client',$clientId);
      $this->db->where('returnDate > now()');
      $this->db->order_by('returnDate');
      return $this->db->get("Loan")->result();
    }

    /**
     * Busca todas as solicitações em empréstimo em aberto
     * @author Caio de Freitas Adriano
     * @since 2017/11/19
     * @param INT - ID do cliente
     * @return Array - retorna um vetor com
     */
    public function getOpenedLoan($clientId) {
      $this->db->where('client',$clientId);
      $this->db->where('loanDate',null);
      $this->db->where('returnDate',null);
      return $this->db->get("Loan")->result();
    }

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
