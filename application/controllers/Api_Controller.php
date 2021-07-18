<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Api_Controller extends CI_Controller {

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
     *
     *
	 */

	function __construct() {
        parent::__construct();
        
        // Load file helper
        $this->load->helper('url');
		
		$this->load->model('Home_model');


	}


	public function index()
	{
		$this->load->view('welcome_message');
	}


    public function getProducts()
    {

        try{

			
        $result = $this->Home_model->get();

		  return $this->output
            ->set_content_type('application/json')
            ->set_status_header(200)
            ->set_output(json_encode(array("status"=>"success","message"=>"Your message here",'data' => $result)));
       
        }catch(Exception $e){

            return $this->output
            ->set_content_type('application/json')
            ->set_status_header(500)
            ->set_output(json_encode(array(
                    'code' => '500',
                    'massage' => $e->getMessage()
            )));

        }
    }
}
