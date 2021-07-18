<?php defined('BASEPATH') OR exit('No direct script access allowed');

class AuditLibrary_Model extends CI_Model {

	  /**
     * @name string TABLE_NAME Holds the name of the table in use by this model
     */
	const TABLE_NAME = 'audit_reports';
	const FILE_UPLOAD = 'file_uploads';

// 	var $AuditLibrary ='audit_library';
// var $FileUploads = 'file_uploads';
// var $AuditReport = 'audit_reports';
// var $RefNo = 'maintenance_ref_no';
// var $FileState = 'file_state_log';
	

    /**
     * @name string PRI_INDEX Holds the name of the tables' primary index used in this model
     */
	const PRI_INDEX = 'audit_report_id';

    /**
     * Retrieves record(s) from the database
     *
     * @param mixed $where Optional. Retrieves only the records matching given criteria, or all records if not given.
     *                      If associative array is given, it should fit field_name=>value pattern.
     *                      If string, value will be used to match against PRI_INDEX
     * @return mixed Single record if ID is given, or array of results
     */

    public function get($where = NULL,$user_id='',$user_name='') {
		$this->db->select('*');
		$this->db->from(self::TABLE_NAME);
		if($user_id !== ''){
			$this->db->where("'$user_id' IN(partner_incharge_id,concurrent_partner_id,manager_incharge_id)", NULL, FALSE);
			$this->db->or_where("'$user_name' IN(partner_incharge_id,concurrent_partner_id,manager_incharge_id)", NULL, FALSE);
		}
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

	function allReports($where)
	{
		$this->db->select("*");
		$this->db->from(self::TABLE_NAME);
		$this ->db->where('status', 'Active'); 
		if ($where !== NULL) {
            if (is_array($where)) {
                foreach ($where as $field=>$value) {
                    $this->db->where($field, $value);
                }
            }
		}

		$this->db->order_by('id', 'DESC');
		$result = $this->db->get()->result();
		
       return $result;
	}

	public function getWithFile($where = NULL) {
		$this->db->select('audit_reports.office,audit_reports.report_state,audit_reports.status,audit_reports.audit_report_id,audit_reports.ref_no,audit_reports.client_id,audit_reports.date_time,audit_reports.year_end,file_uploads.parent_id,file_uploads.url');
		$this->db->from(self::TABLE_NAME);
		$this->db->join('file_uploads', 'file_uploads.parent_id = audit_reports.audit_report_id');
		if ($where !== NULL) {
            if (is_array($where)) {
                foreach ($where as $field=>$value) {
                    $this->db->where('audit_reports.'.$field, $value);
                }
            } else {
                $this->db->where(self::PRI_INDEX, $where);
            }
        }
		$this->db->order_by('id', 'DESC');
		$result = $this->db->get()->result();
		
		
	   return $result;

          
	}

	

	public function getCreatedReports($user_id=null,$user_name=null)
	{
		$this->db->select("*");
		$this->db->from(self::TABLE_NAME);
		$this ->db->where('report_state', 'created'); 
		$this ->db->where('status', 'Active'); 

		if($user_id!=null){

			if (is_array($user_id)) {
                foreach ($user_id as $field=>$value) {
					$this->db->where($field, $value);
                }
			}else{
			$this->db->where("'$user_id' IN(partner_incharge_id,concurrent_partner_id,manager_incharge_id)", NULL, FALSE);
			$this->db->or_where("'$user_name' IN(partner_incharge_id,concurrent_partner_id,manager_incharge_id)", NULL, FALSE);
			}
		}

		$this->db->order_by('id', 'DESC');
		$result = $this->db->get()->result();
		
       return $result;
	}


	function getSignedReports($user_id=null,$user_name=null)
	{
		$this->db->select("*");
		$this->db->from(self::TABLE_NAME);
		$this ->db->where('report_state', 'signed'); 
		$this ->db->where('status', 'Active'); 
		if($user_id!=null){

			if (is_array($user_id)) {
                foreach ($user_id as $field=>$value) {
					$this->db->where($field, $value);
                }
			}else{
			$this->db->where("'$user_id' IN(partner_incharge_id,concurrent_partner_id,manager_incharge_id)", NULL, FALSE);
			$this->db->or_where("'$user_name' IN(partner_incharge_id,concurrent_partner_id,manager_incharge_id)", NULL, FALSE);
			}
		}

		$this->db->order_by('id', 'DESC');
		$result = $this->db->get()->result();
		
       return $result;
	}


	function archivedReports($user_id=null,$user_name=null)
	{
		$this->db->select("*");
		$this->db->from(self::TABLE_NAME);
		$this ->db->where('report_state', 'archived'); 
		$this ->db->where('status', 'Active'); 
		if($user_id!=null){
			
			if (is_array($user_id)) {
                foreach ($user_id as $field=>$value) {
					$this->db->where($field, $value);
                }
			}else{
			$this->db->where("'$user_id' IN(partner_incharge_id,concurrent_partner_id,manager_incharge_id)", NULL, FALSE);
			$this->db->or_where("'$user_name' IN(partner_incharge_id,concurrent_partner_id,manager_incharge_id)", NULL, FALSE);
			}
		}

		$this->db->order_by('id', 'DESC');
		$result = $this->db->get()->result();
		
       return $result;
	}


	

    /**
     * Inserts new data into database
     *
     * @param Array $data Associative array with field_name=>value pattern to be inserted into database
     * @return mixed Inserted row ID, or false if error occured
     */
    public function insert(Array $data) {

		if ($this->db->insert(self::TABLE_NAME, $data)) {
			return $this->db->insert_id();
		} else {
			return false;
		}
	}


	public function insertFileUploads($data)
	{
		if ($this->db->insert(self::FILE_UPLOAD, $data)) {
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
	


}

/* End of file ModelName.php */


?>
