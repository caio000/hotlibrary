<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Essa classe represenda a relação User do banco de dados.
 * @author Caio de Freitas Adriano
 * @since 2017/07/21
 */
class User_model extends CI_Model {

  /**
   * Busca todos os usuários cadastrados no banco de dados.
   * @author Caio de Freitas Adriano
   * @since 2017/09/11
   * @return Retorna uma coleção com todos os objetos "User" cadastrados no banco de dados.
   */
  public function getAll() {
    $this->db->select('"User"."id","User"."name","User"."email","User"."isActive"::int,"Level"."type"',FALSE);
    $this->db->join('Level','User.level = Level.id');
    $query = $this->db->get("User");
    return $query->result();
  }

  /**
   * Insere um novo usuário na base de dados
   * @author Caio de Freitas adriano
   * @since 2017/07/23
   * @param $User Objeto usuário que será persistido no bando de dados;
   * @return Retorna um BOOLEAN TRUE caso o objeto usuário sejá persistido com sucesso.
   */
  public function insert($User) {
    $this->db->trans_start();
    $id = $this->Neighborhood_model->insert($User->Address->City->Neighborhood);
    $User->Address->City->Neighborhood->id = $id;

    $id = $this->State_model->insert($User->Address->City->State);
    $User->Address->City->State->id = $id;

    $id = $this->City_model->insert($User->Address->City);
    $User->Address->City->id = $id;

    $id = $this->Address_model->insert($User->Address);
    $User->Address->id = $id;

    $data = [
      'address'   => (integer) $User->Address->id,
      'name'      => $User->name,
      'email'     => $User->email,
      'password'  => $User->password,
      'level'     => $User->level
    ];
    print_r($data);
    $this->db->insert("User",$data);

    echo $this->db->last_query();
    $this->db->trans_complete();


    return $this->db->trans_status();
  }

  /**
   * Busca um usuário pelo email
   * @author Caio de Freitas
   * @since 2017/08/18
   * @param String $email: email do usuário
   * @return Retorna um objeto User com os dados do usuário.
   */
  public function getUserByEmail ($email) {
    $this->db->where('email',$email);
    $user = $this->db->get("User")->row();
    return $user;
  }

  /**
   * Verifica se o usuário informado existe na base de dados.
   * @author Caio de Freitas
   * @since 2017/08/02
   * @param $User OBJECT: Recebe o objeto usuário com os dados do usuário.
   * @return Retorna um BOOLEAN false caso ocorra um erro no banco de dados. NULL
   * caso a query sejá executada, porêm não foi encontrado o usuário. Caso a
   * Query sejá executada com sucesso e o usuário foi encontrado, é retornado
   * um objeto com os dados do usuário.
   */
  public function exist ($User, $level) {
    $this->db->where($User);
    $this->db->where_in('level',$level);
    $query = $this->db->get('User');

    return $query->row();
  }

  /**
   * @author Caio de Freitas
   * @since 2017/08/28
   * @param Object user: objeto com os dados do usuário
   * @return Retorna um boolean true caso os dados sejam atualizados com sucesso
   */
  public function update($user) {
    $this->db->where('id',$user->id);
    return $this->db->update('User',$user);
  }

  /**
   * Verifica se existe o email informado existe no banco de dados.
   * @author Caio de Freitas
   * @since 2017/08/16
   * @param String $email: email do usuário
   * @return retorna um boolean true caso o email esteja cadastrado.
   */
  public function existEmail($email) {
    $this->db->where('email',$email);
    $result = $this->db->get('User')->num_rows();

    return ($result == 1) ? TRUE : FALSE;
  }

  /**
   * Altera o status do usuário no banco de dados.
   * @author Caio de Freitas Adriano
   * @since 2017/10/09
   * @param Boolean novo status do usuário
   * @return Boolean Retorna um TRUE caso o status sejá alterado com sucesso.
   */
  public function setActive ($id, $status) {
    $this->db->where("id",$id);
    $this->db->set('isActive',$status);
    $query = $this->db->update('User');

    return $query;
  }
}

?>
