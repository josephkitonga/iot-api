<?php defined('BASEPATH') OR exit('No direct script access allowed');
class User_model extends CI_Model {

    // Tables
   var $User = 'users';

    public function login($email, $password){

        $this->db->select('*');
        $this->db->from($this->User);
        $this->db->where('email', $email);
        $this->db->where('password', $password);
        $this->db->limit(1);

        $query = $this->db->get();

        if ($query->num_rows() == 1) {
            return $query->result();
        } else {
            return false;
        }
    }

    // getUsers
    public function getUsers($where = null)
    {
        $this->db->select('*');
        $this->db->from($this->User);
        if ($where !== null) {
            if (is_array($where)) {
                foreach ($where as $field => $value) {
                    $this->db->where($field, $value);
                }
            } else {
                $this->db->where('user_id', $where);
            }
        }
        $query = $this->db->get();
        return $query->result_array();
    }


    public function get($where = NULL) {
        $this->db->select('*');
        $this->db->from($this->User);
        if ($where !== NULL) {
            if (is_array($where)) {
                foreach ($where as $field=>$value) {
                    $this->db->where($field, $value);
                }
            } else {
                $this->db->where('user_id', $where);
            }
        }
        $result = $this->db->get()->result();
        // if ($result) {
        //     if ($where !== NULL) {
        //         return array_shift($result);
        //     } else {
                return $result;
        //     }
        // } else {
        //     return false;
        // }
    }

    public function addUser($data){
        $this->db->insert($this->User,$data);
        return $this->db->insert_id();
    }

    public function updateUser($id,$data)
     {
         $this->db->where('user_id',$id);
      $this->db->update($this->User, $data);
        echo $this->db->affected_rows();
     }
    

}

/* End of file User_model.php */

?>
