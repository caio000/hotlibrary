<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Essa classe representa a relação PublishingCompany (Editora) na base de dados.
 * @author Caio de Freitas Adriano
 * @since 2017/10/28
 */
class PublishingCompany_model extends CI_Model {

  /**
   * Busca todas as editoras que não foram "deletadas" do banco de dados.
   * @author Caio de Freitas Adriano
   * @since 2017/10/28
   * @return ARRAY - Retorna um array de objetos PublishingCompany com os dados
   * das editoras.
   */
  public function getAll () {
    $this->db->where('deleted',false);
    $query = $this->db->get("PublishingCompany");

    return $query->result();
  }

  /**
   * Faz a persistencia de uma nova editora no banco de dados.
   * @author Caio de Freitas Adriano
   * @since 2017/10/28
   * @param Object - Objeto PublishingCompany com os dados da editora
   * @return Boolean - Retorna true caso a editora sejá cadastrada com sucesso.
   */
  public function insert ($PublishingCompany) {
    return $this->db->insert('PublishingCompany',$PublishingCompany);
  }

  public function hasBook ($PublishingCompany) {
    // TODO: Criar função que verifica se exite relação entre editora e livros
  }

  public function delete ($PublishingCompany) {
    // TODO: Criar função para "deletar" uma editora
  }
}

?>
