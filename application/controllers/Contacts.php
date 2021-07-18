<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contacts extends CI_Controller {


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
		
	
		//get header data  from the databas
		$headerData = $this->common->loadHeaderData('Contacts');
		$data['cotacts'] = $this->Home_model->get();


		$this->load->view('v2/tamplate/header_dash',$headerData);
		$this->load->view('v2/contact_view',$data);
		$this->load->view('v2/tamplate/left_panel');
		$this->load->view('v2/tamplate/footer_dash');
	}


	public function all()
	{
	
		//get session data
		$session_data = $this->common->loadSession();

		//get header data  from the databas
		$headerData = $this->common->loadHeaderData('all-contacts');
		$data['cotacts'] = $this->Home_model->get();
	
		$this->load->view('template/header_view',$headerData);
		$this->load->view('all_contact_view',$data);
		$this->load->view('template/footer_view');
	}

	public function competitors()
	{
		
		// check Session
		$this->common->checkSession();

		$session_data = $this->common->loadSession();

		$headerData = $this->common->loadHeaderData('competitors');
		$data['cotacts'] = $this->Home_model->getCompetitors();
	
		$this->load->view('template/header_view',$headerData);
		$this->load->view('competitors_view',$data);
		$this->load->view('template/footer_view');
	}


	public function partners()
	{
		// check Session
		$this->common->checkSession();
		
		$session_data = $this->common->loadSession();

		$headerData = $this->common->loadHeaderData('partners');
		$data['cotacts'] = $this->Home_model->getPartners();
	
		$this->load->view('template/header_view',$headerData);
		$this->load->view('partners_view',$data);
		$this->load->view('template/footer_view');
	}


	public function myContacts()
	{
		
		// check Session
		$this->common->checkSession();
	
		$session_data = $this->common->loadSession();

		$headerData = $this->common->loadHeaderData('partners');
		$data['cotacts'] = $this->Home_model->getMyContacts($session_data['user_id']);
	
		$this->load->view('template/header_view',$headerData);
		$this->load->view('my_contacts_view',$data);
		$this->load->view('template/footer_view');

		$this->common->filterDemonPersonal();

	}
	
	

    public function clear()
    {
    	// echo "string";
        
        $this->db->truncate('contacts');
    	redirect('home', 'refresh'); 
    }

    public function get_data()
    {
    	$dataArray = array('code'=>'1','results'=>$this->Home_model->get());
    
    	
      print json_encode($dataArray);

    }

	public function import()
	{
		
		//get session data
		$session_data = $this->common->loadSession();

			// Parse data from CSV file
			$csvData = $this->csvimport->get_array($_FILES["file"]["tmp_name"]);
			$allContacts = array();
			$data = array();
			$postData = $this->input->post();
			// Insert/update CSV data into database
			if(!empty($csvData)){
				foreach($csvData as $row){
					// Prepare data for DB insertion
					$memData = array(
						'name' => $this->escapeString($row['name']),
						'email' => $row['email'],
						'phone' => $row['phone'],
						'source' => $row['source'],
						'facebook' => $row['facebook'],
						'twitter' => $row['twitter'],
						'instagram' => $row['instagram'],
						'linked_in' => $row['linked_in'],
						'type' => $postData['type'],
						'url' => $this->getDomain($row['url']),
						'user_id' => $session_data['user_id'],
					);


					array_push($allContacts,$memData);
				
				}

				$this->Home_model->insertBulk($allContacts);
			} 

			$this->session->set_flashdata('message', 'Successfully added new record ');

            redirect($postData['redirect'], 'refresh'); 
	}


	public function save()
	{
		//get session data
		$session_data = $this->common->loadSession();

		$formPost = $this->input->post();		
				
		if($formPost['type']=="add"){

			if($session_data['user_type']=="48414324554"){
				$id = $this->Home_model->get(array('email' => $formPost['email'],'url' => $this->getDomain($formPost['url'])));
				// $id = $this->Home_model->getSpesific($formPost['email'],$this->getDomain($formPost['url']));
				$this->Home_model->delete($id);
			}
		
			$memData = array(
				'name' => $formPost['name'],
				'email' => $formPost['email'],
				'phone' => $formPost['phone'],
				'url' => $this->getDomain($formPost['url']),
				'user_id' => $session_data['user_id'],
			);

			$this->Home_model->insert($memData);

	    }else{

			$memData = array(
				'name' => $formPost['name'],
				'email' => $formPost['email'],
				'phone' => $formPost['phone'],
				'url' => $this->getDomain($formPost['url']),
			);

			$this->Home_model->update($memData,$formPost['id']);

		}
    

        redirect('Contacts', 'refresh'); 
	}

	public function saveAll()
	{
		//get session data
		$session_data = $this->common->loadSession();

		$formPost = $this->input->post();		
				
		if($formPost['type']=="add"){

			if($session_data['user_type']=="48414324554"){
				$id = $this->Home_model->get(array('email' => $formPost['email'],'url' => $this->getDomain($formPost['url'])));
				// $id = $this->Home_model->getSpesific($formPost['email'],$this->getDomain($formPost['url']));
				$this->Home_model->delete($id);
			}
		
			$memData = array(
				'name' => $formPost['name'],
				'email' => $formPost['email'],
				'phone' => $formPost['phone'],
				'url' => $this->getDomain($formPost['url']),
				'user_id' => $session_data['user_id'],
			);

			$this->Home_model->insert($memData);

	    }else{

			$memData = array(
				'name' => $formPost['name'],
				'email' => $formPost['email'],
				'phone' => $formPost['phone'],
				'url' => $this->getDomain($formPost['url']),
			);

			$this->Home_model->update($memData,$formPost['id']);

			$this->session->set_flashdata('message', 'Successfully updated record ');
		}
    

        redirect('all-contacts', 'refresh'); 
	}


	public function editContacts($id)
	{
		$cotacts = $this->Home_model->get($id);
		  
		 print json_encode($cotacts);
	}


	public function getDomain($url){

		$pieces = parse_url($url);
		$domain = isset($pieces['host']) ? $pieces['host'] : '';
		if(preg_match('/(?P<domain>[a-z0-9][a-z0-9\-]{1,63}\.[a-z\.]{2,6})$/i', $domain, $regs)){
			return $regs['domain'];
		}
		
		return str_replace('www.','',$url);
	}


	public function escapeString($val) {
		$db = get_instance()->db->conn_id;
		$val = mysqli_real_escape_string($db, $val);
		return $val;
	}


	public function importTest()
	{
		
			$uploadData1 = $this->ddoo_upload('file1');
			$file1 = $uploadData1['upload_data']['file_name'];

			$file = $this->ddoo_upload('file2');
			$file2 = $file['upload_data']['file_name'];

	     	print_r($file1.'::::::'.$file2);
	}


	function ddoo_upload($filename){

		$config['upload_path']          = './assets/uploads';
		$config['allowed_types']        = 'gif|jpg|png';
		$config['max_size']             = 600;
		$config['overwrite'] = FALSE;
		$config['encrypt_name'] = TRUE;
	
		$this->load->library('upload', $config);
		if ( ! $this->upload->do_upload($filename)) {
			$error = array('error' => $this->upload->display_errors());
		return false;
		// $this->load->view('upload_form', $error);
		} else {
		$data = array('upload_data' => $this->upload->data());
		return $data;
		//$this->load->view('upload_success', $data);
		}


	}

}
