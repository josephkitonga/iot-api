<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

    function __construct() {
        parent::__construct();
        
    }

    function index() {

		$this->load->view('login_view');
        
    }


    public function VerifyLogin(){

	    $email = $this->input->post('email');
		$password = $this->input->post('password', true);

	    //query the database
	    $result = $this->User_model->login($email, $password);

	    if ($result) {
	     $sess_array = array();
	    foreach ($result as $row) {
	    $sess_array = array(
			'user_id' => $row->user_id,
			'name' => $row->user_name,
			'email' => $row->email,
			'user_type'=>$row->user_type_id,
			'office'=>$row->office,
			'reset'=> $row->reset);
	     $this->session->set_userdata('XmR2qDXOJ4ey6vZurlDpncDDDUbINQNfflkomnj', $sess_array);
	    }
	    // return true;
	    // echo 'sucess';
			redirect('/', 'refresh');
			
	    } else {

	    //  $this->form_validation->set_message('check_database', 'Invalid username or password');
		 echo 'errr';
		 $this->session->set_flashdata('err', 'invalid user name or password ');
		 redirect(base_url().'login');

	    // return false;
	    }

    }

 


        public function Logout()
        {

        $this->session->unset_userdata('XmR2qDXOJ4ey6vZurlDpncDDDUbINQNfflkomnj');
        session_destroy();
        redirect('Login', 'refresh');
        }



}
        

?>
