<?php defined('BASEPATH') OR exit('No direct script access allowed');

  /**
   * Essa classe represenda a relação Zipcode na base de dados.
   * @author Caio de Freitas Adriano
   * @since 2017/10/20
   */
  class Zipcode_model extends CI_Model {

    /**
     * insere um novo cep no banco de dados caso ainda não exista o cep informado.
     * @author Caio de Freitas Adriano
     * @since 2017/10/20
     * @param Object - Objeto Zipcode com os dados do cep.
     * @return INT - Retorna o ID do cep cadastrado.
     */
    public function insert ($zipcode) {
      $result = null;

      if ($this->exist($zipcode->number)) {
        $zipcode = $this->getByNumber($zipcode->number);
        $result = $zipcode->id;
      } else {
        $this->db->insert("Zipcode",$zipcode);
        $result = $this->db->insert_id();
      }

      return $result;
    }

    /**
     * Verifica se o número do CEP já existe no banco de dados
     * @author Caio de Freitas Adriano
     * @since 2017/10/20
     * @param String - CEP
     * @return BOOLEAN - retorna true caso o cep já exista na base de dados.
     */
    public function exist ($number) {
      $this->db->where('number',$number);
      $query = $this->db->get("Zipcode");

      $result = ($query->num_rows() == 1) ? TRUE : FALSE;

      return $result;
    }

    /**
     * Busca a entidade Zipcode apartir do seu número.
     * @author Caio de Freitas Adriano
     * @since 2017/10/20
     * @param String - número do cep.
     * @return Object - Retorna um objeto da relação Zipcode.
     */
    public function getByNumber ($number) {
      $this->db->where('number',$number);
      $query = $this->db->get('Zipcode');

      return $query->row();
    }

    /**
     * Busca um CEP pelo ID.
     * @author Caio de Freitas Adriano
     * @since 2017/10/20
     * @param INT - ID
     * @return Object - Retona um objeto da relação Zipcode.
     */
    public function getById ($id) {
      $this->db->where('id',$id);
      $query = $this->db->get('Zipcode');

      return $query->row();
    }

  }


?>
