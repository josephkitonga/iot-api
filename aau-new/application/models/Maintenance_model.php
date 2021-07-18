<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Maintenance_model extends CI_Model
{

	// Tables
	var $Rooms = 'maintenance_rooms';
	var $Cabinets = 'maintenance_cabinet';
	var $Folders = 'maintenance_folder';
	var $FileStates = 'maintenance_file_state';
	var $ClientTypes = 'maintenance_client_type';
	var $UserTypes = 'maintenance_user_type';
	var $FileColorDefs = 'maintenance_file_color_defs';
	var $Audittype = 'maintenance_audit_type';
	var $Country = 'country';
	var $RightsModules = 'maintenance_rights_modules';
	var $UserRights = 'user_rights';
	var $Logs = 'logs';
	var $Office = 'maintenance_office';
	var $OfficeAuditType = 'maintenance_office_audittype';
	var $Alerts = 'alerts';
	var $Backup = 'backup';
	var $BackupLog = 'file_backup_logs';
	var $Tets = 'test';
	var $BillingLog = 'billing_log';
	var $BillingTemplete = "billing_templete";
	var $BillingMonthCount = "billing_monthcount";
	var $BillingProcess = "billing_process";




	// start Fetch all statement
	function getBackupstate()
	{
		$this->db->select("*");
		$this->db->from($this->Backup);
		$query = $this->db->get();
		return $query->result_array();
	}

	function getBackuplog()
	{
		$this->db->select("*");
		$this->db->from($this->BackupLog);
		$query = $this->db->get();
		return $query->result_array();
	}

	function FetchAllRooms()
	{
		$this->db->select("*");
		$this->db->from($this->Rooms);
		$query = $this->db->get();
		return $query->result_array();
	}

	function FetchAllCabinets()
	{
		$this->db->select("*");
		$this->db->from($this->Cabinets);
		$query = $this->db->get();
		return $query->result_array();
	}

	function FetchAllFolders()
	{
		$this->db->select("*");
		$this->db->from($this->Folders);
		$query = $this->db->get();
		return $query->result_array();
	}

	function FetchAllFileStates()
	{
		$this->db->select("*");
		$this->db->from($this->FileStates);
		$query = $this->db->get();
		return $query->result_array();
	}

	function FetchAllClientTypes()
	{
		$this->db->select("*");
		$this->db->from($this->ClientTypes);
		$query = $this->db->get();
		return $query->result_array();
	}

	function FetchAllUserTypes()
	{
		$this->db->select("*");
		$this->db->from($this->UserTypes);
		// $query = $this->db->get();
		$result = $this->db->get()->result();

		return $result;
	}

	function FetchAllFileColorDefs()
	{
		$this->db->select("*");
		$this->db->from($this->FileColorDefs);
		$query = $this->db->get();
		return $query->result_array();
	}

	function auditType()
	{
		$this->db->select("*");
		$this->db->from($this->Audittype);
		$result = $this->db->get()->result();

		return $result;
	}

	function FetchAllCountry()
	{
		$this->db->select("*");
		$this->db->from($this->Country);
		$query = $this->db->get();
		return $query->result_array();
	}


	function FetchAllRightsModules()
	{
		$this->db->select("*");
		$this->db->from($this->RightsModules);
		$query = $this->db->get();
		return $query->result_array();
	}

	function FetchAllUserRights()
	{
		$this->db->select("*");
		$this->db->from($this->UserRights);
		$query = $this->db->get();
		return $query->result_array();
	}

	function FetchAllLogs()
	{
		$this->db->select("*");
		$this->db->from($this->Logs);
		$query = $this->db->get();
		return $query->result_array();
	}

	function FetchAllOffices()
	{
		$this->db->select("*");
		$this->db->from($this->Office);
		$query = $this->db->get();
		return $query->result_array();
	}

	function FetchAllOfficeAuditType($where)
	{
		$this->db->select('*');
		$this->db->from($this->OfficeAuditType);
		$this->db->order_by('id', 'desc');
        if ($where !== NULL) {
            if (is_array($where)) {
           
				foreach ($where as $field=>$value) {
                    $this->db->where($field, $value);
                }
            } else {
                $this->db->where('id', $where);
            }
        }
		$query = $this->db->get();

		return $query->result_array();
	}

	function FetchAllAlerts()
	{
		$this->db->select("*");
		$this->db->from($this->Alerts);
		$query = $this->db->get();
		return $query->result_array();
	}

	function FetchAllBillingTemplete()
	{
		$this->db->select("*");
		$this->db->from($this->BillingTemplete);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function FetchAllBillingMonthCount()
	{
		$this->db->select("*");
		$this->db->from($this->BillingMonthCount);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function getBillingProcess($where = NULL)
	{
		$this->db->select('*');
		$this->db->from($this->BillingProcess);
		if ($where !== NULL) {
			if (is_array($where)) {
				foreach ($where as $field => $value) {
					$this->db->where($field, $value);
				}
			} else {
				$this->db->where('billing_process_id', $where);
			}
		}

		$query = $this->db->get();
		return $query->result_array();
	}

	public function FetchAllBillingLog()
	{
		$this->db->select("*");
		$this->db->from($this->BillingLog);
		$query = $this->db->get();
		return $query->result_array();
	}


	public function getUserRights($where = NULL) {
		//get session data

	   $this->db->select('*');
	   $this->db->from("user_rights");
	   if ($where !== NULL) {
		   if (is_array($where)) {
			   foreach ($where as $field=>$value) {
				   $this->db->where($field, $value);
			   }
		   } else {
			   $this->db->where("id", $where);
		   }
	   }
	   $result = $this->db->get()->result();
	  return $result;
   }

	public function getModule($where = NULL) {
	  
	   $this->db->select('*');
	   $this->db->from("maintenance_module");
	   $this->db->order_by('order', 'asc');
	   if ($where !== NULL) {
		   if (is_array($where)) {
			   foreach ($where as $field=>$value) {
				   $this->db->where($field, $value);
			   }
		   } else {
			   $this->db->where("module_id", $where);
		   }
	   }

		$result = $this->db->get()->result();
	  return $result;
   }


	// end Fetch all statement


	// start insert statements

	public function insertBackupLog($data)
	{
		$this->db->insert($this->BackupLog, $data);
		return $this->db->insert_id();
	}

	public function InsertTets($data)
	{
		$this->db->insert($this->Tets, $data);
		return $this->db->insert_id();
	}

	public function InsertRightsModules($data)
	{
		$this->db->insert($this->RightsModules, $data);
		return $this->db->insert_id();
	}

	public function InsertRooms($data)
	{
		$this->db->insert($this->Rooms, $data);
		return $this->db->insert_id();
	}

	public function InsertCabinets($data)
	{
		$this->db->insert($this->Cabinets, $data);
		return $this->db->insert_id();
	}

	public function InsertFolders($data)
	{
		$this->db->insert($this->Folders, $data);
		return $this->db->insert_id();
	}

	public function InsertFileStates($data)
	{
		$this->db->insert($this->FileStates, $data);
		return $this->db->insert_id();
	}

	public function InsertClientTypes($data)
	{
		$this->db->insert($this->ClientTypes, $data);
		return $this->db->insert_id();
	}

	public function InsertUserTypes($data)
	{
		$this->db->insert($this->UserTypes, $data);
		return $this->db->insert_id();
	}

	public function InsertFileColorDefs($data)
	{
		$this->db->insert($this->FileColorDefs, $data);
		return $this->db->insert_id();
	}

	public function InsertAudittype($data)
	{
		$this->db->insert($this->Audittype, $data);
		return $this->db->insert_id();
	}


	public function InsertCountry($data)
	{
		$this->db->insert($this->Country, $data);
		return $this->db->insert_id();
	}
	public function InsertUserRights($data)
	{
		$this->db->insert($this->UserRights, $data);
		return $this->db->insert_id();
	}

	public function InsertLogs($data)
	{
		$this->db->insert($this->Logs, $data);
		return $this->db->insert_id();
	}

	public function InsertOffice($data)
	{
		$this->db->insert($this->Office, $data);
		return $this->db->insert_id();
	}

	public function InsertOfficeAuditType($data)
	{
		$this->db->insert($this->OfficeAuditType, $data);
		return $this->db->insert_id();
	}

	public function InsertAlerts($data)
	{
		$this->db->insert($this->Alerts, $data);
		return $this->db->insert_id();
	}

	public function InsertBillingLogs($data = '')
	{
		$this->db->insert($this->BillingLog, $data);
		return $this->db->insert_id();
	}

	public function InsertBillingMonthCount($data = '')
	{
		$this->db->insert($this->BillingMonthCount, $data);
		return $this->db->insert_id();
	}

	// end insert statements


	// start Edit statement

	public function EditRooms($room_id)
	{
		$this->db->select("*");
		$this->db->from($this->Rooms);
		$this->db->where('room_id', $room_id);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			$result = $query->row();
			return $result;
		} else {
			return false;
		}
	}

	public function EditCabinets($cabinet_id)
	{
		$this->db->select("*");
		$this->db->from($this->Cabinets);
		$this->db->where('cabinet_id', $cabinet_id);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			$result = $query->row();
			return $result;
		} else {
			return false;
		}
	}

	public function EditFolders($folder_id)
	{
		$this->db->select("*");
		$this->db->from($this->Folders);
		$this->db->where('folder_id', $folder_id);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			$result = $query->row();
			return $result;
		} else {
			return false;
		}
	}

	public function EditFileStates($file_state_id)
	{
		$this->db->select("*");
		$this->db->from($this->FileStates);
		$this->db->where('file_state_id', $file_state_id);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			$result = $query->row();
			return $result;
		} else {
			return false;
		}
	}

	public function EditClientTypes($client_type_id)
	{
		$this->db->select("*");
		$this->db->from($this->ClientTypes);
		$this->db->where('client_type_id', $client_type_id);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			$result = $query->row();
			return $result;
		} else {
			return false;
		}
	}

	public function EditUserTypes($type_id)
	{
		$this->db->select("*");
		$this->db->from($this->UserTypes);
		$this->db->where('type_id', $type_id);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			$result = $query->row();
			return $result;
		} else {
			return false;
		}
	}

	public function EditFileColorDefs($file_color_id)
	{
		$this->db->select("*");
		$this->db->from($this->FileColorDefs);
		$this->db->where('file_color_id', $file_color_id);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			$result = $query->row();
			return $result;
		} else {
			return false;
		}
	}

	public function EditAudittype($audit_type_id)
	{
		$this->db->select("*");
		$this->db->from($this->Audittype);
		$this->db->where('audit_type_id', $audit_type_id);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			$result = $query->row();
			return $result;
		} else {
			return false;
		}
	}

	public function EditCountry($country_id)
	{
		$this->db->select("*");
		$this->db->from($this->Country);
		$this->db->where('id', $country_id);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			$result = $query->row();
			return $result;
		} else {
			return false;
		}
	}

	public function EditRightsModules($rights_module_id)
	{
		$this->db->select("*");
		$this->db->from($this->RightsModules);
		$this->db->where('rights_module_id', $rights_module_id);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			$result = $query->row();
			return $result;
		} else {
			return false;
		}
	}

	public function EditOffice($office_id)
	{
		$this->db->select("*");
		$this->db->from($this->Office);
		$this->db->where('office_id', $office_id);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			$result = $query->row();
			return $result;
		} else {
			return false;
		}
	}

	public function EditAlerts($alert_id)
	{
		$this->db->select("*");
		$this->db->from($this->Alerts);
		$this->db->where('alert_id', $alert_id);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			$result = $query->row();
			return $result;
		} else {
			return false;
		}
	}
	// end Edit statement


	// start Update statements
	public function UpdateRooms($room_id, $data)
	{
		$this->db->where('room_id', $room_id);
		$this->db->update($this->Rooms, $data);
	}

	public function UpdateCabinets($cabinet_id, $data)
	{
		$this->db->where('cabinet_id', $cabinet_id);
		$this->db->update($this->Cabinets, $data);
	}

	public function UpdateFolders($folder_id, $data)
	{
		$this->db->where('folder_id', $folder_id);
		$this->db->update($this->Folders, $data);
	}

	public function UpdateFileStates($file_state_id, $data)
	{
		$this->db->where('file_state_id', $file_state_id);
		$this->db->update($this->FileStates, $data);
	}

	public function UpdateClientTypes($client_type_id, $data)
	{
		$this->db->where('client_type_id', $client_type_id);
		$this->db->update($this->ClientTypes, $data);
	}

	public function UpdateUserTypes($type_id, $data)
	{
		$this->db->where('type_id', $type_id);
		$this->db->update($this->UserTypes, $data);
	}

	public function UpdateFileColorDefs($file_color_id, $data)
	{
		$this->db->where('file_color_id', $file_color_id);
		$this->db->update($this->FileColorDefs, $data);
	}

	public function UpdateAudittype($audit_type_id, $data)
	{
		$this->db->where('audit_type_id', $audit_type_id);
		$this->db->update($this->Audittype, $data);
	}

	public function UpdateUserRights($user_rights_id, $data)
	{
		$this->db->where('user_rights_id', $user_rights_id);
		$this->db->update($this->UserRights, $data);
	}

	public function UpdateRightsModules($rights_module_id, $data)
	{
		$this->db->where('rights_module_id', $rights_module_id);
		$this->db->update($this->RightsModules, $data);
	}

	public function UpdateOffice($office_id, $data)
	{
		$this->db->where('office_id', $office_id);
		$this->db->update($this->Office, $data);
	}

	public function UpdateOfficeAuditType($office_audittype_id, $data)
	{
		$this->db->where('office_audittype_id', $office_audittype_id);
		$this->db->update($this->OfficeAuditType, $data);
	}

	public function UpdateAlerts($alert_id, $data)
	{
		$this->db->where('alert_id', $alert_id);
		$this->db->update($this->Alerts, $data);
	}

	public function UpdateBillingMonthCount($id, $data)
	{
		$this->db->where('id', $id);
		$this->db->update($this->BillingMonthCount, $data);
	}

	public function updateBillingLog($id, $data)
	{
		$this->db->where('year_months', $id);
		$this->db->update($this->BillingLog, $data);
	}

	public function Checker($id, $data)
	{
		$this->db->where('id', $id);
		$this->db->update($this->Backup, $data);
	}

	// end Update statements

}
