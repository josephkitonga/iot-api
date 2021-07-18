<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

Class Clients_model extends CI_Model
{

	
	/**
     * @name string TABLE_NAME Holds the name of the table in use by this model
     */
		// Tables
	var $Clents ='clients';
	const TABLE_NAME  = 'clients';

    
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
                    $this->db->where($field, $value);
                }
            } else {
                $this->db->where(self::PRI_INDEX, $where);
            }
        }

		$this->db->order_by('id', 'DESC');
		$result = $this->db->get()->result();
		
       return $result;
          
	}


	public function insertClient($data)
	{
		$this->db->insert($this->Clents, $data);
		return $this->db->insert_id();
	}
    
    public function FetchAllClentsByOffice($office_id='')
    {
     $this->db->select("*");
	 $this->db->from($this->Clents);
	 $this->db->where('office_id',$office_id);
	 $this->db->where('status','Active');
	 $query = $this->db->get();        
	 return $query->result_array();
    }

    public function FetchAllClentsByOffices($office_id='')
    {
     $this->db->select("*");
	 $this->db->from($this->Clents);
	 $this->db->where('office_id',$office_id);
	 $query = $this->db->get();        
	 return $query->result_array();
    }

	function FetchAllClents() {
	$this->db->select("*");
	$this->db->from($this->Clents);
	$this->db->where('status','Active');
	$query = $this->db->get();        
	return $query->result_array();
	}

	public function EditClients($client_id)
	{
	$this->db->select("*");
	$this->db->from($this ->Clents);
	$this->db->where('client_id',$client_id);
	$query = $this -> db -> get();
	if($query->num_rows() > 0)
	{
	$result = $query->row();
	return $result;
	}else
	{
	return false;
	}
	}

	public function updateClients($client_id,$data)
	{
	$this->db->where('client_id',$client_id);
	$this->db->update($this -> Clents, $data);
	}



}
