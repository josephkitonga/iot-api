<?php defined('BASEPATH') or exit('No direct script access allowed');
// ini_set('display_errors', 0);
class Common
{
    protected $ci;
   
    public function __construct()
    {
        $this->ci = &get_instance();
    }


    public function loadSession()
    {
        return $this->ci->session->userdata('XmR2qDXOJ4ey6vZurlDpncDDDUbINQNfflkomnj');
    }

    public function loadHeaderData($Menue)
    {
	  //Load session	
        $session_data = $this->loadSession();

	 
	  //get data from the database
        $headerData['user_name'] = $session_data['name'];
        $headerData['user_id'] = $session_data['user_id'];
        $headerData['email'] = $session_data['email'];
		$headerData['user_type'] = $session_data['user_type'];
		$headerData['office'] = $session_data['office'];


        $headerData["module"] = $Menue;

		if($session_data['user_type']=="48414324554"){$headerData['visible_admin'] = ""; }else{ $headerData['visible_admin'] = "none";}

        $headerData['Module'] = $this->ci->Maintenance_model->getModule();
        $headerData['UserRights'] = $this->ci->Maintenance_model->getUserRights();

        return $headerData;
    }

    public function checkSession()
    {
     //check Session
        $Session = $this->ci->session->userdata('XmR2qDXOJ4ey6vZurlDpncDDDUbINQNfflkomnj');
        if (empty($Session)) {

            redirect('Login', 'refresh');
        }
        

        // $session_data = $this->loadSession();
        // if ($session_data['reset']==0) {
        //  $this->ci->session->set_flashdata('message',"Oops! Your account has beeen deactivated plese reset your Password"); 
        //     redirect('Reset', 'refresh');
        // }

	}
	
    // unique ids
    function uniqidReal($lenght = 13)
    {
    // uniqid gives 13 chars, but you could adjust it to your needs.
        if (function_exists("random_bytes")) {
            $bytes = random_bytes(ceil($lenght / 2));
        } elseif (function_exists("openssl_random_pseudo_bytes")) {
            $bytes = openssl_random_pseudo_bytes(ceil($lenght / 2));
        } else {
            throw new Exception("no cryptographically secure random function available");
        }
        return substr(bin2hex($bytes), 0, $lenght);
    }
    

}

/* End of file Common.php */
/* Location: ./application/libraries/Common.php */
