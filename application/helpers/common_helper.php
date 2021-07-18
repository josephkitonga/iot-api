<?php defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Function Name
 *
 * Function description
 *
 * @access    public
 * @param type    name
 * @return    type
 */

if (!function_exists('get_user_type_id')) {
	function get_user_type_id($param1 = '', $param2 = '')
	{
		//get main CodeIgniter object
		$ci =& get_instance();

		$userType = $ci->Maintenance_model->getUserType();
		$user = $ci->LoginModel->get();

		switch ($param2) {

			case 'CONF':

				foreach ($userType as $value) {
					$getUserTypeIdAssoc[$value->tag] = $value->user_type;
				}
				break;

			case 'USER':

				foreach ($user as $value) {
					$getUserTypeIdAssoc[$value->user_id] = $value->user_type;
				}
				break;

			default:
				$getUserTypeIdAssoc = array();
				break;
		}


		return $getUserTypeIdAssoc[$param1];
	}
}

if (!function_exists('get_user_type_name')) {
	function get_user_type_name($param1 = '')
	{
		//get main CodeIgniter object
		$ci =& get_instance();

		$userType = $ci->Maintenance_model->FetchAllUserTypes();

		if (!empty($userType)): foreach ($userType as $value):
			$getUserNameAssoc[$value->type_id] = $value->lable;
		endforeach; endif;

		return $getUserNameAssoc[$param1];
	}
}

if (!function_exists('get_user_type_by_label')) {
	function get_user_type_by_label($param1 = '')
	{
		//get main CodeIgniter object
		$ci =& get_instance();

		// $userType = $ci->Maintenance_model->FetchAllUserTypes();

		// if (!empty($userType)): foreach ($userType as $value):
		// 	$getUserNameAssoc[$value->lable] = $value->type_id;
		// endforeach; endif;

		// return $getUserNameAssoc[$param1];
		$userType = $ci->db->select('*')->from("maintenance_user_type")->where("lable", $param1)->get()->row();
		return $userType->type_id;
	}
}


if (!function_exists('get_user_name')) {
	function get_user_name($param1 = '')
	{

		//get main CodeIgniter object
		$ci =& get_instance();

		$user = $ci->User_model->get();
		foreach ($user as $value) {
			$getUserNameAssoc[$value->user_id] = $value->name;
		}

		return $getUserNameAssoc[$param1];

	}
}

if (!function_exists('get_user_rights')) {
	function get_user_rights($param1 = '', $param2 = '')
	{

		//get main CodeIgniter object
		$ci =& get_instance();

		$ci->load->model('Maintenance_model');

		$userRightsArray = $ci->Maintenance_model->getUserRights();

		if (!empty($userRightsArray)): foreach ($userRightsArray as $value):
			$UserRights[$value->user_type][$value->module] = "X";
		endforeach; endif;

		return $UserRights[$param1][$param2];

	}
}

if (!function_exists('count_all_audit_reports')) {
	function count_all_audit_reports()
	{
		//get main CodeIgniter object
		$ci =& get_instance();
		echo number_format($ci->db->count_all_results('audit_reports'),0,'.',',');

	}
}


if (!function_exists('count_my_audit_reports')) {
	function count_my_audit_reports($user_id="",$user_name)
	{
		//get main CodeIgniter object
		$ci =& get_instance();
		$ci ->db->where('status', 'Active'); 
		$ci->db->where("$user_id IN(partner_incharge_id,concurrent_partner_id,manager_incharge_id)", NULL, FALSE);
		$ci->db->or_where("'$user_name' IN(partner_incharge_id,concurrent_partner_id,manager_incharge_id)", NULL, FALSE);
		echo number_format($ci->db->count_all_results('audit_reports'),0,'.',',');

	}
}

if (!function_exists('count_my_uploaded_files')) {
	function count_my_uploaded_files($user_id="",$user_name)
	{
		//get main CodeIgniter object
		$ci =& get_instance();
		$ci ->db->where('status', 'Active'); 
		$ci->db->where('report_state', 'archived');
		$ci->db->where("$user_id IN(partner_incharge_id,concurrent_partner_id,manager_incharge_id)", NULL, FALSE);
		$ci->db->or_where("'$user_name' IN(partner_incharge_id,concurrent_partner_id,manager_incharge_id)", NULL, FALSE);
		echo number_format($ci->db->count_all_results('audit_reports'),0,'.',',');

	}
}

if (!function_exists('count_my_signed_reports')) {
	function count_my_signed_reports($user_id="",$user_name)
	{
		//get main CodeIgniter object
		$ci =& get_instance();
		$ci ->db->where('status', 'Active'); 
		$ci->db->where('report_state', 'signed');
		$ci->db->where("$user_id IN(partner_incharge_id,concurrent_partner_id,manager_incharge_id)", NULL, FALSE);
		$ci->db->or_where("'$user_name' IN(partner_incharge_id,concurrent_partner_id,manager_incharge_id)", NULL, FALSE);
		echo number_format($ci->db->count_all_results('audit_reports'),0,'.',',');
	}
}


if (!function_exists('get_all_users')) {
	function get_all_users()
	{
		// user_id
		$ci =& get_instance();
		
		$usersArr = [];
		$user = $ci->User_model->get();
		
			echo number_format(count($user),0,'.',',');

	}
}


	
if (!function_exists('get_office_name')) {
	function get_office_name($param1 = '')
	{
		//get main CodeIgniter object
		$ci =& get_instance();

		$Office = $ci->db->select('*')->from("maintenance_office")->where("office_id", $param1)->get()->row();
		return $Office->lable;
	}
}

if (!function_exists('get_partner_manager_name')) {
	function get_partner_manager_name($param1)
	{
		//get main CodeIgniter object
		$ci =& get_instance();
		// $User = $ci->User_model->get(array('user_type_id' => $param1));
		// foreach ($User as $user):
		// 	$getNameAssoc[$user->user_id] = $user->user_name;
		// endforeach;

		$users = $ci->db->select('*')->from("users")
		->where("user_id", $param1)
		->get()->row();


		return $users->user_name;
	}
}

if (!function_exists('get_client_name')) {
	function get_client_name($param1 = '')
	{
		//get main CodeIgniter object
		$ci =& get_instance();

		$session_data = $ci->common->loadSession();
		$office_id = $session_data['office_id'];
		// $clients = $ci->Clients_model->get(array('office_id' => $param1));
		// foreach ($clients as $client):
		// 	$getClientNameAssoc[$client->client_id] = $client->client_name;
		// endforeach;

		$getClient = $ci->db->select('*')->from("clients")->where("client_id", $param1)->get()->row();
		return $getClient->client_name;

	}
}

if (!function_exists('get_audit_file')) {
	function get_audit_file($param1 = '')
	{
		//get main CodeIgniter object
		$ci =& get_instance();

		$files = $ci->db->select('*')->from("file_uploads")->where("parent_id", $param1)->get()->row();
		return $_SERVER['HTTP_HOST'].'/'.$files->url;
	}
}


if (!function_exists('does_url_exists')) {
	function does_url_exists($url = '')
	{
		
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_NOBODY, true);
		curl_exec($ch);
		$code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

		if ($code == 200) {
			$status = true;
		} else {
			$status = false;
		}
		curl_close($ch);
		return $status;
	}
}


if (!function_exists('url_is_ok')) {
	function url_is_ok($url = '')
	{
		
		$headers = @get_headers($url);
		$httpStatus = intval(substr($headers[0], 9, 3));
		if ($httpStatus<400)
		{
			return true;
		}
		return false;
	}
}



?>
