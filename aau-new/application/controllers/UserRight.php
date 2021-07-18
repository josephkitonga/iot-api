<?php defined('BASEPATH') OR exit('No direct script access allowed');

class UserRight extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		//Do your magic here
		// $this->load->model('Maintenance_model');
	}

	public function index()
	{
		
	// check Session
	$this->common->checkSession();

	//get session data
	$session_data = $this->common->loadSession();

	//get header data  from the databas
	$headerData = $this->common->loadHeaderData('user-roles');
	$data['UserType'] = $this->Maintenance_model->FetchAllUserTypes();

	$this->load->view('template/header_view', $headerData);
	$this->load->view('user_right_view', $data);
	$this->load->view('template/footer_view');

	}



	public function Verify()
	{
	      $UserR = $this->Maintenance_model->getUserRights();
	      foreach ($UserR as $value) {
	       $CheckType[$value->user_type][$value->module] = "X";
	       $getID[$value->user_type][$value->module] = $value->id;
	      }
	    $user_type_id =  $this->input->post('user_type_id');
	    $module_id = $this->input->post('module_id');	
	     // echo $data;
	     if ($CheckType[$user_type_id][$module_id]!="X") {
	     $arrayName = array('user_type' => $user_type_id,'module'=> $module_id);
		//  $this->Maintenance_model->insertUserRights($arrayName);
		 $this->db->insert("user_rights", $arrayName);
	     }else{
	     $id = $getID[$user_type_id][$module_id];
		//  $this->Maintenance_model->deleteUserRight($id);
		 $this->db->delete("user_rights", array('id' => $id));
	     }
	

	}

}

/* End of file UserRight.php */
/* Location: ./application/controllers/UserRight.php */


 ?>
