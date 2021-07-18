<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{

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
		$headerData = $this->common->loadHeaderData('dashboard');


		// print_r($session_data);
		// exit;
		$data['auditType'] = $this->Maintenance_model->auditType();
		$data['clients'] = $this->Clients_model->get(array('office_id' => $session_data['office']));
		$data['partner'] = $this->User_model->get(array('user_type_id' => get_user_type_by_label('Partner')));
		$data['manager'] = $this->User_model->get(array('user_type_id' => get_user_type_by_label('Manager')));
		$data['createdAU'] = $this->AuditLibrary_Model->getCreatedReports($session_data['user_id'], $session_data['name']);
		$data['signedAU'] = $this->AuditLibrary_Model->getSignedReports($session_data['user_id'], $session_data['name']);

		$this->load->view('template/header_view', $headerData);
		$this->load->view('dashboard_view', $data);
		$this->load->view('template/footer_view');
	}


	public function users()
	{

		// check Session
		$this->common->checkSession();

		//get session data
		$session_data = $this->common->loadSession();

		$headerData = $this->common->loadHeaderData('users');

		$data['Users'] = $this->User_model->getUsers();
		$data['userType'] = $this->Maintenance_model->FetchAllUserTypes();
		$data['office'] = $this->Maintenance_model->FetchAllOffices();

		$this->load->view('template/header_view', $headerData);
		$this->load->view('user_view', $data);
		$this->load->view('template/footer_view');
	}

	public function auditLibrary()
	{
			// check Session
			$this->common->checkSession();

			//get session data
			$session_data = $this->common->loadSession();
	
			$headerData = $this->common->loadHeaderData('auditLibrary');
	
			// $data['clients'] = $this->Clients_model->get();
			// $data['office'] = $this->Maintenance_model->FetchAllOffices();
	
			// $arrwhere = array('office'=>$session_data['office'],'report_state'=>'archived','status'=>'Active');		
			// $data['archivedAU'] = $this->AuditLibrary_Model->getWithFile($arrwhere);
			$data['archivedAU'] = $this->AuditLibrary_Model->archivedReports(array('office'=>$session_data['office']));


		$this->load->view('template/header_view', $headerData);
		$this->load->view('audit_library', $data);
		$this->load->view('template/footer_view');
	}



	public function searchArchivedReport($searched)
	{

		$session_data = $this->common->loadSession();
		$searched = $this->input->post('searchd');

		if($searched!=""){

		$auditReports =  $this->db->select("*")
		          ->from('audit_reports')
				  ->where('ref_no', trim($searched))
				  ->where('report_state', 'archived')
				  ->where('office', $session_data['office'])				  
				  ->where('status', 'Active')
				  ->order_by('id', 'DESC')
				  ->get()->result();
				  

				  $count =1;
		foreach($auditReports as $r) {

			$client_id = "'".$r->client_id."'";
			$audit_report_id = "'".$r->audit_report_id."'";

			
			$data[] = array(
				$count++,
				$r->ref_no,
				get_client_name($r->client_id),
				$r->year_end,
				date_format(date_create($r->date_time), 'd-m-Y'),
				'<a onclick="javascript:LogDownload('.$client_id.')" href="'.base_url($r->url).'" download>
				<button data-toggle="tooltip" data-original-title="View report Details" onclick="viewAuditReport('.$audit_report_id.')" class="btn btn-icon btn-icon-circle btn-warning btn-icon-style-3"><span class="btn-icon-wrap"><i class="icon-rocket"></i></span></button>
				</a>
				<button onclick="javascript:GetMore('.$client_id.')" type="button" class="btn btn-info" >View All</button>',
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

	public function auditByClient($client_id)
	{


		$arrwhere = array('report_state'=>'archived','client_id'=>$client_id);		
		$archivedAU = $this->AuditLibrary_Model->getWithFile($arrwhere);

		$html = "";
		$html .= '<table id="" class="table table-hover w-100 display pb-30">
									<thead>
										<tr >
											<th>#</th>
											<th>Ref No</th>
											<th>Client</th>
											<th>Year End</th>
											<th>Date</th>
											<th>Actions</th>
										</tr>
									</thead>
									<tbody>';
										 $count = 1;
										if (!empty($archivedAU)) : foreach ($archivedAU as $data) : if ($data->report_state != "archived") {
													continue;
												}
										$date = date_format(date_create($data->date_time), 'd F');

										$html .= '<tr >
													<td>'.$count++.'</td>
													<td>'.$data->ref_no.'</td>
													<td>'.get_client_name($data->client_id).'</td>
													<td>'.$data->year_end.'</td>
													<td>'.$date.'</td>
													<td>
													<a onclick="javascript:LogDownload('.$data->client_id.')" href="'.base_url('../'.$data->url).'" download>
														<button data-toggle="tooltip" data-original-title="View report Details" onclick="viewAuditReport('.$data->audit_report_id.')" class="btn btn-icon btn-icon-circle btn-warning btn-icon-style-3"><span class="btn-icon-wrap"><i class="icon-rocket"></i></span></button>
													</a>
													</td>

												</tr>';
										 endforeach; endif; 
										 $html .='</tbody>
									<tfoot>
										<tr>
											<th>#</th>
											<th>Ref No</th>
											<th>Client</th>
											<th>Year End</th>
											<th>Date</th>
											<th>Actions</th>
										</tr>
									</tfoot>
								</table>';

		echo json_encode(array('sliderData'=>$html));
	}

	public function clients()
	{

		// check Session
		$this->common->checkSession();

		//get session data
		$session_data = $this->common->loadSession();

		$headerData = $this->common->loadHeaderData('clients');

		$data['client'] = $this->Clients_model->get();
		$data['office'] = $this->Maintenance_model->FetchAllOffices();

		$data['partner'] = $this->User_model->get(array('user_type_id'=>'1500586142'));
		$data['manager'] = $this->User_model->get(array('user_type_id'=>'1500366739'));


		$this->load->view('template/header_view', $headerData);
		$this->load->view('client_view', $data);
		$this->load->view('template/footer_view');
	}


	public function auditReports()
	{
		// check Session
		$this->common->checkSession();

		//get session data
		$session_data = $this->common->loadSession();

		$headerData = $this->common->loadHeaderData('auditReports');

		$data['clients'] = $this->Clients_model->get();
		$data['office'] = $this->Maintenance_model->FetchAllOffices();

		$arrwhere = array('office'=>$session_data['office'],'report_state'=>'created','status'=>'Active');
		// $result = $this->AuditLibrary_Model->get($arrwhere,'','');
	
		// $data['createdAU'] = $this->AuditLibrary_Model->get($arrwhere,'','');
		$data['createdAU'] = $this->AuditLibrary_Model->getCreatedReports(array('office'=>$session_data['office']));

		$data['partner'] = $this->User_model->get(array('user_type_id'=>'1500586142'));
		$data['manager'] = $this->User_model->get(array('user_type_id'=>'1500366739'));
		$data['auditType'] = $this->Maintenance_model->auditType();

		 $partnerAssoc= array();
		foreach ($this->User_model->get() as $row) {
			$partnerAssoc[trim($row->user_name)] = $row->user_id;
		}
		
		$data['partnerAssoc'] = $partnerAssoc;

		// print_r($data);

		// exit;


		$this->load->view('template/header_view', $headerData);
		$this->load->view('audit_view', $data);
		$this->load->view('template/footer_view');
	}


	public function insertAuditReport()
	{

		//get session data
		$session_data = $this->common->loadSession();

		$session_id = $session_data['user_id'];
		$Office = $session_data['office'];
		$Atype = $this->input->post('audit_type_id');
		$Yaer = date('Y');
		$ip = $this->input->ip_address();
		$Uniqueid = time();
		$officeAuditType = $this->Maintenance_model->FetchAllOfficeAuditType(array('office_id' => $Office, 'audit_type_id' => $Atype));
		if($officeAuditType){
		foreach ($officeAuditType as $key) {
			$num = $key['no'];
			$officeaudittype_id = $key['office_audittype_id'];

			if ($Yaer == $key['year']) {
				$data = array('no' => $key['no'] + 1, 'year' => $Yaer);
				if ($this->Maintenance_model->UpdateOfficeAuditType($officeaudittype_id, $data)) {
					echo json_encode(array('status' => TRUE));
				} else {
					echo json_encode(array('status' => FALSE));
				}
				$num = $key['no'];
			} else {
				$data = array('no' => "0", 'year' => $Yaer);
				if ($this->Maintenance_model->UpdateOfficeAuditType($officeaudittype_id, $data)) {
					echo json_encode(array('status' => TRUE));
				} else {
					echo json_encode(array('status' => FALSE));
				}
				$num = "0";
			}
			# code...
			}

		}else{
			
			$data = array('office_audittype_id'=>time(),'no' => "0", 'year' => $Yaer,'audit_type_id'=>$Atype,'office_id'=> $Office);
			if ($this->Maintenance_model->InsertOfficeAuditType($data)) {
				echo json_encode(array('status' => TRUE));
			} else {
				echo json_encode(array('status' => FALSE));
			}
		}

		// $newNum = $this->Maintenance_model->FetchAllOfficeAuditType(array('office_id' => $Office, 'audit_type_id' => $Atype));
		$paddedNum = sprintf("%04d", $num + 1);
		$RefNo = $paddedNum . "/" . $Yaer;
		$Uniqueid = time();
		$data = array(
			'audit_report_id' => $Uniqueid,
			'ref_no' => $RefNo,
			'audit_type_id' => $this->input->post('audit_type_id'),
			'partner_incharge_id' => $this->input->post('partner_incharge_id'),
			'concurrent_partner_id' => $this->input->post('concurrent_partner_id'),
			'manager_incharge_id' => $this->input->post('manager_incharge_id'),
			'year_end' => $this->input->post('year_end'),
			'client_id' => $this->input->post('client_select')=="" ? $this->input->post('client_id') : $this->input->post('client_select'),
			'status' => "Active",
			'office' => $Office,
			'report_state' => "created"
		);


		if ($this->AuditLibrary_Model->insert($data)) {
			$logdata = array(
				'log_id' => $Uniqueid . "0",
				'parent_id' => $Uniqueid,
				'status' => "Created AuditReport",
				'session_id' => $session_id,
				'ip' => $ip
			);
			$this->Maintenance_model->InsertLogs($logdata);
			// $this->common->saveBiling('RDBS');
		} else {
			echo json_encode(array('status' => FALSE));
		}
	}


	public function auditReportDetails($audit_report_id)
	{

		$createdAU = $this->AuditLibrary_Model->get(array('audit_report_id' => $audit_report_id));
		$partner_incharge = empty(get_user_name($createdAU[0]->partner_incharge_id)) ? $createdAU[0]->partner_incharge_id : get_user_name($createdAU[0]->partner_incharge_id);
		$concurrent_partner = get_user_name($createdAU[0]->concurrent_partner_id) == "" ? $createdAU[0]->concurrent_partner_id : get_user_name($createdAU[0]->concurrent_partner_id);
		$manager_incharge = get_user_name($createdAU[0]->manager_incharge_id) == "" ? $createdAU[0]->manager_incharge_id : get_user_name($createdAU[0]->manager_incharge_id);
		$year_end = date_format(date_create($createdAU[0]->year_end), 'd F');

		$table = '<table class="table table-sm table-hover w-100 display pb-30">
					<thead>
					<tr>
						<th>Audit Ref No</th>
						<th>Partner in Charge</th>
						<th>Concurrent Partner</th>
						<th>Manager in charge</th>
						<th>Year end</th>
						<th>CCH Code</th>
						<th>Client Name</th>
					</tr>
				  </thead>
				<tbody>
					<tr>
						<td>' . $createdAU[0]->ref_no . '</td>
						<td>' . $partner_incharge . '</td>
						<td>' . $concurrent_partner . '</td>
						<td>' . $manager_incharge . '</td>
						<td>' . $year_end . '</td>
						<td>' . get_client_name($createdAU[0]->client_id). '</td>
						<td>' . get_client_name($createdAU[0]->client_id) . '</td>
					</tr>
				</tbody>
				</table>';

		print $table;
	}

	public function signAuditReport()
	{

		$Uniqueid = time();
		$session_data = $this->common->loadSession();
		$session_id = $session_data['user_id'];
		$ip = $this->input->ip_address();

		$id = $this->input->post('audit_report_id');
		$data = array('report_state' => "signed", 'sign_off_date' => $this->input->post('sign_off_date'));

		if ($this->AuditLibrary_Model->update($data, $id)) {

			$logdata = array(
				'log_id' => $Uniqueid,
				'parent_id' => $id,
				'status' => "Signed Audit Report",
				'session_id' => $session_id,
				'ip' => $ip
			);
			$this->Maintenance_model->InsertLogs($logdata);
			// $this->common->saveBiling('RDBS');

			echo json_encode(array('status' => TRUE));
		} else {
			echo json_encode(array('status' => FALSE));
		}

		redirect('/');
	}


	public function  addUsers()
	{

		$session_data = $this->common->loadSession();
		$userData = $this->input->post();
		$userData['user_id'] = uniqid();

		// password
		$parts = explode("@", $this->input->post('email'));
		$userData['password'] = md5($parts[0]);

		$arrwhere = array('email' => $userData['email']);
		$result = $this->User_model->getUsers($arrwhere);
		if ($result) {
			//  echo 'exist';
			$this->session->set_flashdata('err', 'User already exists');
		} else {
			$this->User_model->addUser($userData);
			$this->session->set_flashdata('message', 'Successfully added new user ');
		}
	}

	public function editUsers($value = '')
	{
		$arrwhere = array('user_id' => $value);
		$result = $this->User_model->getUsers($arrwhere);
		echo json_encode($result);
	}

	public function updateUsers()
	{
		$session_data = $this->common->loadSession();
		$userData = $this->input->post();
		$user_id = $this->input->post('user_id');
		if ($this->User_model->updateUser($user_id, $userData)) {
			echo "sucess";
		}
	}


	public function addClients()
	{

		$session_data = $this->common->loadSession();
		$userData = $this->input->post();

		$arrwhere = array('email' => $userData['email']);
		$result = $this->Clients_model->get($arrwhere);
		if ($result) {
			//  echo 'exist';
			$this->session->set_flashdata('err', 'Client already exists');
		} else {
			$this->Clients_model->insertClient($userData);
			$this->session->set_flashdata('message', 'Successfully added new Client ');
		}
	}

	public function editClients($value = '')
	{
		$arrwhere = array('client_id' => $value);
		$result = $this->Clients_model->get($arrwhere);
		echo json_encode($result);
	}

	public function updateClients()
	{
		$session_data = $this->common->loadSession();
		$userData = $this->input->post();
		$client_id = $this->input->post('client_id');
		if ($this->Clients_model->updateClients($client_id, $userData)) {
			echo "sucess";
		}
	}


	public function editAuditReport($value = '')
	{
		$session_data = $this->common->loadSession();

		$arrwhere = array('audit_report_id' => $value);
		$result = $this->AuditLibrary_Model->get($arrwhere,'','');
		echo json_encode($result);
	}

	public function updateAuditReport()
	{
		$session_data = $this->common->loadSession();
		$userData = $this->input->post();
		$audit_report_id = $this->input->post('audit_report_id');

		if ($this->AuditLibrary_Model->update($userData,$audit_report_id)) {
			echo "sucess";
		}
	}

	public function InsertAuditLibrary()
	{

		$session_data = $this->common->loadSession();
		$session_id = $session_data['user_id'];
		$ip = $this->input->ip_address();
		$Uniqueid = time();
		$data = array(
			'audit_library_id' => $Uniqueid,
			'audit_description' => $this->input->post('description'),
			'cch_code' => $this->input->post('cch_code'),
			'manager_id' => $this->input->post('manager_id'),
			'client_id' => $this->input->post('client_id'),
			'cabinet_id' => $this->input->post('cabinet_id'),
			'folder_id' => $this->input->post('folder_id'),
			'room_id' => $this->input->post('room_id'),
			'session_id' => $session_id,
			'ip' => $ip,
			'status' => $this->input->post('status')
		);

		if ($this->Audit_Library_model->InsertAuditLibrary($data)) {
			echo json_encode(array('status' => TRUE));
			$this->common->saveBiling('RDBS');
		} else {
			echo json_encode(array('status' => FALSE));
		}
	}

	public function fileUpload()
	{

		$session_data = $this->common->loadSession();
		$session_id = $session_data['user_id'];
		$ip = $this->input->ip_address();
		$Uniqueid = time();
		if (!empty($_FILES)) {
			$tempFile = $_FILES['file']['tmp_name'];
			$fileName = $_FILES['file']['name'];
			$targetPath = '../files/auditfiles/';
			$targetFile = $targetPath . $fileName;
			$FileSize = $_FILES['file']['size'];

            $target_file = $targetPath . basename($_FILES["file"]["name"]);

			// $questionImage = $this->do_file_upload('file');
			// print_r($target_file);
			// exit;

			if (file_exists($target_file) != true) {

				// $file_exists = file_exists ($targetFile);
				// if(!$file_exists) //If file does not exists then upload
				// {
				$ext  = (new SplFileInfo($fileName))->getExtension();
				$name = (new SplFileInfo($fileName))->getBasename('.' . $ext);
				// move_uploaded_file($tempFile, $targetFile);


				$questionImage = $this->do_file_upload('file');
				$question_file_url = $targetPath.$questionImage['upload_data']['file_name'];	

				// exit;

				$uploaddata = array(
					'session_id' => $session_id,
					'upload_id' => $Uniqueid,
					'ip' => $ip,
					'file_name' => $name,
					'file_extension' => $ext,
					'url' => 'files/auditfiles/' . $fileName,
					'parent_id' => $this->input->post('parent_id')
				);
				if ($this->AuditLibrary_Model->insertFileUploads($uploaddata)) {

					//billing log
					// $this->BillingLog($FileSize);

					echo json_encode(array('status' => TRUE));

					$realdate = date_format(date_create(), 'Y-m-d H:i:s');
					$audit_id = $this->input->post('parent_id');
					$data = array('archive_date' => $realdate, 'report_state' => "archived");
					$this->AuditLibrary_Model->update($data,$audit_id);

					$logdata = array(
						'log_id' => $Uniqueid,
						'parent_id' => $this->input->post('parent_id'),
						'status' => "archived Audit Report",
						'session_id' => $session_id,
						'ip' => $ip
					);
					$this->Maintenance_model->InsertLogs($logdata);
					// $this->common->saveBiling('RDBS');
				} else {
					echo json_encode(array('status' => FALSE));
				}
			} else //If file exists then echo the error and set a http error response
			{
				//upload failed, echo back negative response to dropzone.js
				header('HTTP/1.1 500 Internal Server Error');
				header('Content-type: text/plain');
				$this->output->set_header("HTTP/1.0 400 Bad Request");
				echo 'Error: Duplicate file name, please change it!';
			}


			// $this->load->database(); // load database
			// $this->db->insert('file_uploads',$uploaddata);
		}
	}

	function do_file_upload($filename){

		// $config['upload_path']          = './files/auditfiles/';
		$config["upload_path"] = "../files/auditfiles/";
		$config['allowed_types']        = 'gif|jpg|jpeg|png|iso|dmg|zip|rar|doc|docx|xls|xlsx|xlsm|ppt|pptx|csv|ods|odt|odp|pdf|rtf|sxc|sxi|txt|exe|avi|mpeg|mp3|mp4|3gp';
		$config['max_size']             = 100000;
		$config['overwrite'] = FALSE;
		// $config['encrypt_name'] = TRUE;
		$config['remove_spaces'] = TRUE;
 
		
		$this->upload->initialize($config);

		// print_r($config["upload_path"]);

		$this->load->library('upload', $config);
		// $this->upload->initialize($config);


		if ( ! $this->upload->do_upload($filename)) {
		//   $error = array('error' => $this->upload->display_errors());
		// return false;
		// $this->load->view('upload_form', $error);
		// print_r($error);
		} else {
		$data = array('upload_data' => $this->upload->data());
		return $data;
		$this->load->view('upload_success', $data);
		}
	}



	public function updateSigned()
	{
		$userData = $this->input->post();

        $this->db->update('audit_reports', array('sign_off_date'=>$userData['sign_off_date']), array('audit_report_id'=>$userData['audit_report_id']));

		$this->session->set_flashdata('message', 'Successfully updated...');
		redirect('signed-report','redirect');
	}


	public function test()
	{

		$file =  'http://54.188.144.96/audit/files/auditfiles/086.2018.zip';

		print_r($this->urlIsOk($file));
		//  fopen("http://pkfeaaau.com/files/auditfiles/AudBcack - Rameshwar Distributors Limited p.e 2015.12.31.zip", 'r');
	}



function urlIsOk($url)
{
    $headers = @get_headers($url);
    $httpStatus = intval(substr($headers[0], 9, 3));
    if ($httpStatus<400)
    {
        return true;
    }
    return false;
}

	function URLIsValid($URL)
	{
		$exists = true;
		$file_headers = @get_headers($URL);
		$InvalidHeaders = array('404', '403', '500');
		foreach($InvalidHeaders as $HeaderVal)
		{
				if(strstr($file_headers[0], $HeaderVal))
				{
						$exists = false;
						break;
				}
		}
		return $exists;
	}


	
}

