<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reports extends CI_Controller {


	function __construct() {
        parent::__construct();
        
        // Load file helper
        $this->load->helper('url');

        $this->load->model('Home_model');
		// $this->load->library('CSVReader');
		$this->load->library('Csvimport');

    }

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		// check Session
		$this->common->checkSession();

		//get session data
		$session_data = $this->common->loadSession();
		$headerData = $this->common->loadHeaderData('unsigned-report');

		$data['report'] = $this->AuditLibrary_Model->getCreatedReports(array('office'=>$session_data['office']));
		$data['tittle'] = "Unsigned Audit Report";
		$data['state'] = "created";

		$this->load->view('template/header_view', $headerData);
		$this->load->view('report_unsigned_view', $data);
		$this->load->view('template/footer_view');
	}


	public function signedReport()
	{
		// check Session
		$this->common->checkSession();

		//get session data
		$session_data = $this->common->loadSession();
		$headerData = $this->common->loadHeaderData('signed-report');

		$data['report'] = $this->AuditLibrary_Model->getSignedReports(array('office'=>$session_data['office']));
		$data['tittle'] = "Signed Audit Report";
		$data['state'] = "signed";
		$data['user_rights'] = 0;
		$user_rights = $this->db->select('*')->from("user_rights")->where("user_type", $session_data['user_type'])->where("module", 'c78i7c5c376u8')->get()->row();
	
		if($user_rights){
		  $data['user_rights'] = 1;
		}

		$this->load->view('template/header_view', $headerData);
		$this->load->view('report_signed_view', $data);
		$this->load->view('template/footer_view');
		
	}


	public function archivedReport()
	{
		// check Session
		$this->common->checkSession();

		//get session data
		$session_data = $this->common->loadSession();
		$headerData = $this->common->loadHeaderData('archived-report');

		$data['report'] = $this->AuditLibrary_Model->archivedReports(array('office'=>$session_data['office']));
		$data['tittle'] = "Archived Audit Report";
		$data['state'] = "archived";

		$this->load->view('template/header_view', $headerData);
		$this->load->view('report_archived_view', $data);
		$this->load->view('template/footer_view');
		
		
	}

	public function signedPendingArchival()
	{
		// check Session
		$this->common->checkSession();

		//get session data
		$session_data = $this->common->loadSession();
		$headerData = $this->common->loadHeaderData('signed-pending-archival');

	
		$data['report'] = $this->AuditLibrary_Model->getSignedReports(array('office'=>$session_data['office']));
		$data['tittle'] = "Audit Reports Signed Pending Archival";
		$data['state'] = "signed";

		$this->load->view('template/header_view', $headerData);
		$this->load->view('report_signed_pending_archival_view', $data);
		$this->load->view('template/footer_view');
	}


	public function archivedFilesCheck()
	{
		// check Session
		$this->common->checkSession();

		//get session data
		$session_data = $this->common->loadSession();
		$headerData = $this->common->loadHeaderData('archived-files-check');

		$data['report'] = $this->AuditLibrary_Model->archivedReports();
		$data['tittle'] = "Archived files check";
		$data['state'] = "archived";

		$this->load->view('template/header_view', $headerData);
		$this->load->view('report_archived_check_view', $data);
		$this->load->view('template/footer_view');
	}


	public function updateArchived()
	{
		$postData = $this->input->post();
		$this->db->update('audit_reports', array('report_state'=>$postData['report_state']), array('audit_report_id'=>$postData['audit_report_id']));
	
		$this->session->set_flashdata('message', 'Successfully updated record ');
		redirect('archived-files-check', 'refresh'); 
	}

	public function allReports()
	{
		// check Session
		$this->common->checkSession();

		//get session data
		$session_data = $this->common->loadSession();
		$headerData = $this->common->loadHeaderData('archived-report');

		$today = date('d-m-Y');
		$before = date('d-m-Y', strtotime($today. ' - 29 days'));

		// $data['report'] = $this->AuditLibrary_Model->allReports(array('office'=>$session_data['office']));
		$data['tittle'] = "All Audit Report";
		$data['state'] = "archived";
		// $data['start_date'] = $today;
		// $data['end_date'] = $before;

		$this->load->view('template/header_view', $headerData);
		$this->load->view('all_report_view', $data);
		$this->load->view('template/footer_view');
		
		
	}

	public function searchAllReport()
	{

		// 01-10-2017:::::01-03-2021
    //   $start_date = date_format(date_create('01/10/2017'),'Y-m-d');
	//   $end_date =   date_format(date_create('01/03/2021'),'Y-m-d'); 
	if(!empty($this->input->post('start_date'))){

	  $start_date = date_format(date_create($this->input->post('start_date')),'Y-m-d');
	  $end_date = date_format(date_create($this->input->post('end_date')),'Y-m-d'); 
	}else{

		$end_date = date('Y-m-d');
		$start_date = date('Y-m-d', strtotime(date('Y-m-d'). ' - 29 days'));
	}


		$session_data = $this->common->loadSession();
		$auditReports =  $this->db->select("*")
		          ->from('audit_reports')
				  ->where("DATE_FORMAT(date_time,'%Y-%m-%d') >='".trim($start_date)."'")
                  ->where("DATE_FORMAT(date_time,'%Y-%m-%d') <='".trim($end_date)."'")
				  ->where('office', $session_data['office'])				  
				  ->where('status', 'Active')
				  ->order_by('id', 'DESC')
				  ->get()->result();

	//    print_r($auditReports);
	//   exit;		  
				  
		$count =1;
		foreach($auditReports as $r) {

			$data[] = array(
				$count++,
				$r->ref_no,
				get_client_name($r->client_id),
				get_partner_manager_name($r->partner_incharge_id) ? get_partner_manager_name($r->partner_incharge_id) : $r->partner_incharge_id,
				get_partner_manager_name($r->manager_incharge_id) ? get_partner_manager_name($r->manager_incharge_id) : $r->manager_incharge_id,
				get_office_name($r->office),											
				$r->sign_off_date,
				$r->archive_date,
				$r->year_end,
				date_format(date_create($r->date_time), 'd-m-Y'),
			);
		}
		   
		$result = array(
				"draw" => 1,
				"recordsTotal" => count($auditReports),
				"recordsFiltered" => count($auditReports),
				"data" => $data
			);
		   
		echo json_encode($result);	
		
	}


}
