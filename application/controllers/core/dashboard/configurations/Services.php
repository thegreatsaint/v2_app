<?php
defined('BASEPATH') OR exit('No direct script access allowed');
ob_start();
class Services extends CI_Controller {

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
		$this->Functions->check_basic_authentication($_SESSION[$this->config->item("sess_cookie_name")]["staff_username"],"reminders","");	
    }
	 	
	public function index()
	{
		$data['page_title'] = 'Staffs';
		$data['rights'] = $this->Functions->get_staff_task_permission($_SESSION[$this->config->item("sess_cookie_name")]["staff_username"],"staffs");
		$this->load->view('common/header',$data);
		$this->load->view('common/common_script',$data);
		$this->load->view('common/top_bar',$data);	
		if($this->Functions->get_staff_task_permission($_SESSION[$this->config->item("sess_cookie_name")]["staff_username"],"staffs") == 'full')
		{
			
		}
		$this->load->view('dashboard/staffs/staffs');
		$this->load->view('common/footer');
	} 
	
	public function get_service_type()
	{
		extract($_POST);
		
		$request =  $this->config->item("rest_server_url");
		$request .= "index.php/api/configurations/service_type/get_service_type";
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
	
	public function add_new()
	{
		extract($_POST);
		
		if(isset($req_service_timing_units))
		{
			if($req_service_timing_units == 'option_1')
			{
				$req_service_timing_units = '60';
			}
			else
			{
				$req_service_timing_units = $req_service_timing_units_minutes;
			}
			
				$request =  $this->config->item("rest_server_url");
				$request .= "index.php/api/configurations/services/add_new";
				$request .= "?";
				
				$request .= "app_api_username=".urlencode($_SESSION[$this->config->item("sess_cookie_name")]["app_api_username"]);
				$request .= "&";
				
				$request .= "staff_username=".urlencode($_SESSION[$this->config->item("sess_cookie_name")]["staff_username"]);
				$request .= "&";
				
				$request .= "staff_token=".urlencode($_SESSION[$this->config->item("sess_cookie_name")]["staff_token"]);	
				$request .= "&";
				
				$request .= "req_service_type=".urlencode($req_service_type);	
				$request .= "&";
				
				$request .= "req_service_code=".urlencode($req_service_code);	
				$request .= "&";
				
				$request .= "req_mapping_icd10_code=".urlencode($req_mapping_icd10_code);	
				$request .= "&";
				
				$request .= "req_service_def_app_duration=".urlencode($req_service_def_app_duration);	
				$request .= "&";
				
				$request .= "req_service_timing_units=".urlencode($req_service_timing_units);	
				$request .= "&";
				
				$request .= "req_standard_rate_in_dollar=".urlencode($req_standard_rate_in_dollar);	
				$request .= "&";
				
				$request .= "req_service_desc=".urlencode($req_service_desc);	
				
				$request = $request;
				
				$response = file_get_contents($request);
				echo $response;
		}
	}
	
	public function delete()
	{
		extract($_POST);
		
		$request =  $this->config->item("rest_server_url");
		$request .= "index.php/api/configurations/services/delete";
		$request .= "?";
		
		$request .= "app_api_username=".urlencode($_SESSION[$this->config->item("sess_cookie_name")]["app_api_username"]);
		$request .= "&";
		
		$request .= "staff_username=".urlencode($_SESSION[$this->config->item("sess_cookie_name")]["staff_username"]);
		$request .= "&";
		
		$request .= "staff_token=".urlencode($_SESSION[$this->config->item("sess_cookie_name")]["staff_token"]);
		$request .= "&";
		
		$request .= "req_auto_id_0=".urlencode($req_auto_id_0);	
		
		$request = $request;
		
		$response = file_get_contents($request);
		echo $response;
		
		
	}
	
	public function edit()
	{
		extract($_POST);
		
		$request =  $this->config->item("rest_server_url");
		$request .= "index.php/api/configurations/services/edit";
		$request .= "?";
		
		$request .= "app_api_username=".urlencode($_SESSION[$this->config->item("sess_cookie_name")]["app_api_username"]);
		$request .= "&";
		
		$request .= "staff_username=".urlencode($_SESSION[$this->config->item("sess_cookie_name")]["staff_username"]);
		$request .= "&";
		
		$request .= "staff_token=".urlencode($_SESSION[$this->config->item("sess_cookie_name")]["staff_token"]);
		$request .= "&";
		
		$request .= "req_auto_id_0=".urlencode($req_auto_id_0);
	
		$request = $request;
		$response = file_get_contents($request);
		echo $response;
		
	}
	
	public function view()
	{
		extract($_POST);
		
		$request =  $this->config->item("rest_server_url");
		$request .= "index.php/api/configurations/services/view";
		$request .= "?";
		
		$request .= "app_api_username=".urlencode($_SESSION[$this->config->item("sess_cookie_name")]["app_api_username"]);
		$request .= "&";
		
		$request .= "staff_username=".urlencode($_SESSION[$this->config->item("sess_cookie_name")]["staff_username"]);
		$request .= "&";
		
		$request .= "staff_token=".urlencode($_SESSION[$this->config->item("sess_cookie_name")]["staff_token"]);
	
		$request = $request;
		$response = file_get_contents($request);
		echo $response;
	}
}
