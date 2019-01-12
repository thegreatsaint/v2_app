<?php
defined('BASEPATH') OR exit('No direct script access allowed');
ob_start();
class Dashboard extends CI_Controller {

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
	 
	function __construct()
    {
        parent::__construct();
		
		$this->load->library('session');
		$this->load->model("Functions");
		$this->Functions->check_basic_authentication($_SESSION[$this->config->item("sess_cookie_name")]["staff_username"],"front_desk","");
    }
	 	
	public function index()
	{
		$data['page_title'] = 'Dashboard';
		$this->load->view('common/header',$data);
		$this->load->view('common/top_bar',$data);
		$this->load->view('common/common_script',$data);	
		$this->load->view('dashboard/dashboard');
		$this->load->view('common/footer');
	} 
}
