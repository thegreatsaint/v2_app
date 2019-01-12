<?php
defined('BASEPATH') OR exit('No direct script access allowed');
ob_start();
class Sessions extends CI_Controller {

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
		$this->load->helper('string');
	    $this->load->library('session');
		$this->load->model('Functions');
		$this->Functions->check_basic_authentication($_SESSION[$this->config->item("sess_cookie_name")]["staff_username"],"sessions","");		
    }
	 	
	public function index()
	{
		$data['page_title'] = 'Sessions';
		$data['rights'] = $this->Functions->get_staff_task_permission($_SESSION[$this->config->item("sess_cookie_name")]["staff_username"],"programs");
		$this->load->view('common/header',$data);
		$this->load->view('common/common_script',$data);
		$this->load->view('common/top_bar',$data);
		$this->load->view('dashboard/sessions/sessions');
		if($this->Functions->get_staff_task_permission($_SESSION[$this->config->item("sess_cookie_name")]["staff_username"],"sessions") == 'full')
		{
			$this->load->view('dashboard/configurations/services');
			$this->load->view('dashboard/configurations/services');
		}
		
		$this->load->view('common/footer');
	} 
	
	public function delete_session()
	{
		extract($_POST);
		
		$request =  $this->config->item("rest_server_url");
		$request .= "index.php/api/sessions/sessions/session_delete";
		$request .= "?";
		
		$request .= "app_api_username=".$_SESSION[$this->config->item("sess_cookie_name")]["app_api_username"];
		$request .= "&";
		
		$request .= "staff_username=".$_SESSION[$this->config->item("sess_cookie_name")]["staff_username"];
		$request .= "&";
		
		$request .= "staff_token=".$_SESSION[$this->config->item("sess_cookie_name")]["staff_token"];	
		$request .= "&";
		
		$request .= "req_auto_id_0=".urlencode($req_auto_id_0);
		$request .= "&";
		
		$request .= "req_session_rand_no=".urlencode($req_session_rand_no);
		$request .= "&";
		
		$request .= "req_patient_id=".urlencode($req_patient_id);
		$request = $request;
		
		$response = file_get_contents($request);
		echo $response;
	}
	
	public function save_session()
	{
		extract($_POST);
		
		$request =  $this->config->item("rest_server_url");
		$request .= "index.php/api/sessions/sessions/save_session";
		$request .= "?";
		
		$request .= "app_api_username=".$_SESSION[$this->config->item("sess_cookie_name")]["app_api_username"];
		$request .= "&";
		
		$request .= "staff_username=".$_SESSION[$this->config->item("sess_cookie_name")]["staff_username"];
		$request .= "&";
		
		$request .= "staff_token=".$_SESSION[$this->config->item("sess_cookie_name")]["staff_token"];	
		$request .= "&";
		
		$request .= "req_session_rand_no=".urlencode($req_session_rand_no);
		$request .= "&";
		
		$request .= "req_session_staff_signature=".urlencode($req_session_staff_signature);
		$request .= "&";
		
		$request .= "req_session_running_time=".urlencode($req_session_running_time);
		$request .= "&";
	
		$response = file_get_contents($request);
		echo $response;
	}
	
	public function get_program_members_for_sessions()
	{
		extract($_POST);
		
		$request =  $this->config->item("rest_server_url");
		$request .= "index.php/api/sessions/sessions/get_program_members_for_sessions";
		$request .= "?";
		
		$request .= "app_api_username=".$_SESSION[$this->config->item("sess_cookie_name")]["app_api_username"];
		$request .= "&";
		
		$request .= "staff_username=".$_SESSION[$this->config->item("sess_cookie_name")]["staff_username"];
		$request .= "&";
		
		$request .= "staff_token=".$_SESSION[$this->config->item("sess_cookie_name")]["staff_token"];	
		$request .= "&";
		
		$request .= "req_program_id=".$req_program_id;
		$request .= "&";
		
		$request .= "req_session_date=".$req_session_date;
		$request = $request;
		
		$response = file_get_contents($request);
		echo $response;
	}
	
	public function get_session_notes()
	{
		extract($_REQUEST);
		
		$request =  $this->config->item("rest_server_url");
		$request .= "index.php/api/sessions/sessions/get_session_notes";
		$request .= "?";
		
		$request .= "app_api_username=".$_SESSION[$this->config->item("sess_cookie_name")]["app_api_username"];
		$request .= "&";
		
		$request .= "staff_username=".$_SESSION[$this->config->item("sess_cookie_name")]["staff_username"];
		$request .= "&";
		
		$request .= "staff_token=".$_SESSION[$this->config->item("sess_cookie_name")]["staff_token"];	
		$request .= "&";
		
		$request .= "req_session_rand_no=".urlencode($req_session_rand_no);	
		$request .= "&";
		
		$request = $request;
		
		$response = file_get_contents($request);
		echo $response;
	}
	
	public function get_session_random_no()
	{
		$request =  $this->config->item("rest_server_url");
		$request .= "index.php/api/sessions/sessions/get_session_random_no";
		$request .= "?";
		
		$request .= "app_api_username=".$_SESSION[$this->config->item("sess_cookie_name")]["app_api_username"];
		$request .= "&";
		
		$request .= "staff_username=".$_SESSION[$this->config->item("sess_cookie_name")]["staff_username"];
		$request .= "&";
		
		$request .= "staff_token=".$_SESSION[$this->config->item("sess_cookie_name")]["staff_token"];	
		$request .= "&";
		
		$request = $request;
		
		$response = file_get_contents($request);
		echo $response;
	}
	
	public function session_notes_insert()
	{
		extract($_REQUEST);
		
		$request =  $this->config->item("rest_server_url");
		$request .= "index.php/api/sessions/sessions/session_notes_insert";
		$request .= "?";
		
		$request .= "app_api_username=".$_SESSION[$this->config->item("sess_cookie_name")]["app_api_username"];
		$request .= "&";
		
		$request .= "staff_username=".$_SESSION[$this->config->item("sess_cookie_name")]["staff_username"];
		$request .= "&";
		
		$request .= "staff_token=".$_SESSION[$this->config->item("sess_cookie_name")]["staff_token"];	
		$request .= "&";
		
		$request .= "req_session_date=".urlencode($req_session_date);	
		$request .= "&";
		
		$request .= "req_session_rand_no=".urlencode($req_session_rand_no);	
		$request .= "&";
		
		$request .= "req_session_method=".urlencode($req_session_method);	
		$request .= "&";
		
		$request .= "req_session_notes=".urlencode($req_session_notes);	
		$request .= "&";
		
		$request .= "req_session_place=".urlencode($req_session_place);	
		$request .= "&";
		
		
		//echo $request;
		$request = $request;
		
		$response = file_get_contents($request);
		echo $response;
	}
	
	public function add_new()
	{
		extract($_POST);
		
		$request =  $this->config->item("rest_server_url");
		$request .= "index.php/api/sessions/sessions/add_new";
		$request .= "?";
		
		$request .= "app_api_username=".$_SESSION[$this->config->item("sess_cookie_name")]["app_api_username"];
		$request .= "&";
		
		$request .= "staff_username=".$_SESSION[$this->config->item("sess_cookie_name")]["staff_username"];
		$request .= "&";
		
		$request .= "staff_token=".$_SESSION[$this->config->item("sess_cookie_name")]["staff_token"];	
		$request .= "&";
		
		$request .= "session_rand_no=".$req_session_rand_no;
		$request .= "&";
		
		$request .= "req_session_date=".$req_session_date;
		$request = $request;
		
		$response = file_get_contents($request);
		echo $response;
	}
	
	public function view()
	{
		extract($_POST);
		
		$request =  $this->config->item("rest_server_url");
		$request .= "index.php/api/sessions/sessions/view";
		$request .= "?";
		
		$request .= "app_api_username=".$_SESSION[$this->config->item("sess_cookie_name")]["app_api_username"];
		$request .= "&";
		
		$request .= "staff_username=".$_SESSION[$this->config->item("sess_cookie_name")]["staff_username"];
		$request .= "&";
		
		$request .= "staff_token=".$_SESSION[$this->config->item("sess_cookie_name")]["staff_token"];	
		$request .= "&";
		
		$response = file_get_contents($request);
		echo $response;
	}
	
	public function print_session()
	{
		 extract($_REQUEST);
		 
		$request =  $this->config->item("rest_server_url");
		$request .= "index.php/api/sessions/sessions/print_session";
		$request .= "?";
		
		$request .= "app_api_username=".$_SESSION[$this->config->item("sess_cookie_name")]["app_api_username"];
		$request .= "&";
		
		$request .= "staff_username=".$_SESSION[$this->config->item("sess_cookie_name")]["staff_username"];
		$request .= "&";
		
		$request .= "staff_token=".$_SESSION[$this->config->item("sess_cookie_name")]["staff_token"];	
		$request .= "&";
		
		$request .= "req_auto_id_0=".$req_auto_id_0;
		$response = file_get_contents($request);

		echo $response;
		
	}
}
