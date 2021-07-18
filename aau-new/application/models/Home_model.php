<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Home_model extends CI_Model {

    /**
     * @name string TABLE_NAME Holds the name of the table in use by this model
     */
	const TABLE_NAME = 'contacts';
    const CRAWLER  = 'web_crawler_log';
    const LEADS  = 'search_leads';
    const EDUCATORS  = 'educators';

    
    /**
     * @name string PRI_INDEX Holds the name of the tables' primary index used in this model
     */
    const PRI_INDEX = 'id';

    /**
     * Retrieves record(s) from the database
     *
     * @param mixed $where Optional. Retrieves only the records matching given criteria, or all records if not given.
     *                      If associative array is given, it should fit field_name=>value pattern.
     *                      If string, value will be used to match against PRI_INDEX
     * @return mixed Single record if ID is given, or array of results
     */

    public function get($where = NULL) {
		
        $this->db->select('*');
		$this->db->from(self::TABLE_NAME);
		$this->db->order_by('id', 'desc');
        if ($where !== NULL) {
            if (is_array($where)) {
                foreach ($where as $field=>$value) {
					$valueEsk = $this->db->escape_like_str($value);
                    $this->db->where($field, $valueEsk);
                }
            } else {
                $this->db->where(self::PRI_INDEX, $where);
            }
        }
        $result = $this->db->get()->result();
        
        return $result;
          
	}
	

	
	public function getCompetitors() {
	 
		$userArr = [];
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where('user_type','48414324554');
		$Admins = $this->db->get()->result();
		foreach ($Admins as $value) { array_push($userArr,$value->user_id); }

		if(!empty($userArr)){
		$this->db->select('*');
		$this->db->from(self::TABLE_NAME);
		$this->db->where('type','0');
		$this->db->where_in('user_id',$userArr);
		$result = $this->db->get()->result();
		}

        return $result;
          
	}
	

	public function getPartners() {
	 
		$userArr = [];
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where('user_type','48414324554');
		$Admins = $this->db->get()->result();
		foreach ($Admins as $value) { array_push($userArr,$value->user_id); }

		if(!empty($userArr)){
		$this->db->select('*');
		$this->db->from(self::TABLE_NAME);
		$this->db->where('type','1');		
		$this->db->where_in('user_id',$userArr);
		$result = $this->db->get()->result();
		}

        return $result;
          
	}

	public function getMyContacts($user_id) {
	 
		// $userArr = [];
		// $this->db->select('*');
		// $this->db->from('users');
		// $this->db->where('user_type','48414324554');
		// $Admins = $this->db->get()->result();
		// foreach ($Admins as $value) { array_push($userArr,$value->user_id); }

		// if(!empty($userArr)){
		$this->db->select('*');
		$this->db->from(self::TABLE_NAME);
		$this->db->where('user_id',$user_id);		
		// $this->db->where_in('user_id',$userArr);
		$result = $this->db->get()->result();
		// }

        return $result;
          
	}
	
	
    

    public function getEducators($where = NULL) {
        $this->db->select('*');
        $this->db->from(self::EDUCATORS);
        if ($where !== NULL) {
            if (is_array($where)) {
                foreach ($where as $field=>$value) {
					$valueEsk = $this->db->escape_like_str($value);
                    $this->db->where($field, $valueEsk);
                }
            } else {
                $this->db->where(self::PRI_INDEX, $where);
            }
        }
        $result = $this->db->get()->result();
        
        return $result;
          
	}


	public function getCrawler($where = NULL) {
        $this->db->select('*');
        $this->db->from(self::CRAWLER);
        if ($where !== NULL) {
            if (is_array($where)) {
                foreach ($where as $field=>$value) {
                    $this->db->where($field, $value);
                }
            } else {
                $this->db->where("id",$where);
            }
        }
        $result = $this->db->get()->result();
        
        return $result;
    
    }

    public function getLeads($where = NULL) {
        
        $this->db->select('*');
        $this->db->from(self::LEADS);
        if ($where !== NULL) {
            if (is_array($where)) {
                foreach ($where as $field=>$value) {
                    $this->db->where($field, $value);
                }
            } else {
                $this->db->where("id",$where);
            }
        }
        $result = $this->db->get()->result();
        
        return $result;
    
    }	

	public function getSpesific($email,$domain) {
        $this->db->select('*');
		$this->db->from(self::TABLE_NAME);
		// $this->db->where('email', $email)

		$this->db->like("SUBSTRING_INDEX(SUBSTRING_INDEX(email, '@', -1), '.', 1)", "SUBSTRING_INDEX(SUBSTRING_INDEX('$email', '@', -1), '.', 1)", 'both')
		->or_where('url =', $domain);
        $result = $this->db->get()->row()->id;
	
		return $result;
		          
    }

    /**
     * Inserts new data into database
     *
     * @param Array $data Associative array with field_name=>value pattern to be inserted into database
     * @return mixed Inserted row ID, or false if error occured
     */
    public function insert(Array $data) {

		$sql = "INSERT IGNORE INTO contacts(name, email, phone, url, user_id) VALUES (?,?,?,?,?);"; 
		$this->db->query($sql, array($data['name'], $data['email'], $data['phone'], $data['url'], $data['user_id']));

	}

	public function insertBulk(Array $data) {

		// $sql = "INSERT IGNORE INTO contacts(name, email, phone, url, user_id) VALUES (?,?,?,?,?);"; 
		// $this->db->query($sql, array($data['name'], $data['email'], $data['phone'], $data['url'], $data['user_id']));
		$this->db->insert_batch(self::TABLE_NAME, $data);
    }

    public function insertLeadsBulk(Array $data) {

		$this->db->insert_batch(self::LEADS, $data);
    }
    

    public function insertEducatorsBulk(Array $data) {

		$this->db->insert_batch(self::EDUCATORS, $data);
    }
    

	public function insertCrawlerBulk(Array $data) {

		// $sql = "INSERT IGNORE INTO contacts(name, email, phone, url, user_id) VALUES (?,?,?,?,?);"; 
		// $this->db->query($sql, array($data['name'], $data['email'], $data['phone'], $data['url'], $data['user_id']));
		$this->db->insert_batch(self::CRAWLER, $data);

    }
    
    public function insertEducators(Array $data)
    {
        if ($this->db->insert(self::EDUCATORS, $data)) {
            return $this->db->insert_id();
        } else {
            return false;
        }
    }
	

    /**
     * Updates selected record in the database
     *
     * @param Array $data Associative array field_name=>value to be updated
     * @param Array $where Optional. Associative array field_name=>value, for where condition. If specified, $id is not used
     * @return int Number of affected rows by the update query
     */
    public function update(Array $data, $where = array()) {
            if (!is_array($where)) {
                $where = array(self::PRI_INDEX => $where);
            }
        $this->db->update(self::TABLE_NAME, $data, $where);
        return $this->db->affected_rows();
	}
	
	public function updateCrawler(Array $data, $where = array()) {
		if (!is_array($where)) {
			$where = array('id' => $where);
		}
	$this->db->update(self::CRAWLER, $data, $where);
	return $this->db->affected_rows();
}

    /**
     * Deletes specified record from the database
     *
     * @param Array $where Optional. Associative array field_name=>value, for where condition. If specified, $id is not used
     * @return int Number of rows affected by the delete query
     */
    public function delete($where = array()) {
        if (!is_array($where)) {
            $where = array(self::PRI_INDEX => $where);
        }
        $this->db->delete(self::TABLE_NAME, $where);
        return $this->db->affected_rows();
    }
}
        

?>
