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

    public function __construct() {

        // $this->load->helper('url');

    }


	public function index()
	{
		$this->load->view('welcome_message');
	}


    public function getProducts()
    {

        try{

            // $result = $this->db->select('*')->from('sys_items')->get()->results();

            // return $this->output
            // ->set_content_type('application/json')
            // ->set_status_header(200)
            // ->set_output(json_encode(array(
            //         'code' => '200',
            //         'message' => '',
            //         'data' =>''
            // )));

            return $this->output
            ->set_content_type('application/json')
            ->set_status_header(200)
            ->set_output(json_encode(array(
                    'text' => 'Success',
                    'type' => 'json',
					'data' => ''
            )));


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
