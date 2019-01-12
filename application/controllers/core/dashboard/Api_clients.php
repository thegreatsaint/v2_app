<?php
defined('BASEPATH') OR exit('No direct script access allowed');
ob_start();
class Api_clients extends CI_Controller {

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
		$this->Functions->check_basic_authentication($_SESSION[$this->config->item("sess_cookie_name")]["staff_username"],"app_api_clients","full");		
    }
	 	
	public function index()
	{
		$data['page_title'] = 'API Clients';
		$data['rights'] = $this->Functions->get_staff_task_permission($_SESSION[$this->config->item("sess_cookie_name")]["staff_username"],"app_api_clients");
		$this->load->view('common/header',$data);
		$this->load->view('common/common_script',$data);
		$this->load->view('common/top_bar',$data);	
		$this->load->view('dashboard/api_clients/api_clients');
		$this->load->view('common/footer');
	} 
	
	public function assign_api_key()
	{
		$outp["result"] = "true";
		$outp["msg"] = "Assigned new api key";
		$outp["app_api_key"]=$this->generate_app_api_key();
		
		echo json_encode($outp);
	}
	
	public function update()
	{
		extract($_POST);
		
		$request =  $this->config->item("rest_server_url");
		$request .= "index.php/api/api_clients/api_clients/update";
		$request .= "?";
		
		$request .= "app_api_username=".$_SESSION[$this->config->item("sess_cookie_name")]["app_api_username"];
		$request .= "&";
		
		$request .= "staff_username=".$_SESSION[$this->config->item("sess_cookie_name")]["staff_username"];
		$request .= "&";
		
		$request .= "staff_token=".$_SESSION[$this->config->item("sess_cookie_name")]["staff_token"];
		$request .= "&";
		
		
		$request .= "req_app_api_password=".$req_app_api_password;
		$request .= "&";
		
		$request .= "req_app_api_company=".urlencode($req_app_api_company);
		$request .= "&";
		
		$request .= "req_app_api_company_phone=".urlencode($req_app_api_company_phone);
		$request .= "&";
		
		$request .= "req_app_api_company_address=".urlencode($req_app_api_company_address);
		$request .= "&";
		
		$request .= "req_app_api_company_desc=".urlencode($req_app_api_company_desc);
		$request .= "&";
		
		$request .= "req_auto_id_0=".$req_auto_id_0;
		$request .= "&";
		
		$request .= "req_app_api_staff_id_prefix=".urlencode($req_app_api_staff_id_prefix);
		$request .= "&";
		
		$request .= "req_app_api_referral_id_prefix=".urlencode($req_app_api_referral_id_prefix);
		$request .= "&";
		
		$request .= "req_app_api_patient_id_prefix=".urlencode($req_app_api_patient_id_prefix);
		$request .= "&";
		
		$request .= "req_app_api_doctor_id_prefix=".urlencode($req_app_api_doctor_id_prefix);
		$request .= "&";
		
		$request = $request;
		
		$response = file_get_contents($request);
		echo $response;
	}
	
	public function edit()
	{
		extract($_POST);
		
		$request =  $this->config->item("rest_server_url");
		$request .= "index.php/api/api_clients/api_clients/edit";
		$request .= "?";
		
		$request .= "app_api_username=".$_SESSION[$this->config->item("sess_cookie_name")]["app_api_username"];
		$request .= "&";
		
		$request .= "staff_username=".$_SESSION[$this->config->item("sess_cookie_name")]["staff_username"];
		$request .= "&";
		
		$request .= "staff_token=".$_SESSION[$this->config->item("sess_cookie_name")]["staff_token"];	
		$request .= "&";
		
		$request .= "auto_id_0=".$auto_id_0;	
		
		$request = $request;
		
		$response = file_get_contents($request);
		echo $response;
	}
	
	public function check_valid_username()
	{
		extract($_POST);
		
		$request =  $this->config->item("rest_server_url");
		$request .= "index.php/api/api_clients/api_clients/check_valid_username";
		$request .= "?";
		$request .= "app_api_username=".$_SESSION[$this->config->item("sess_cookie_name")]["app_api_username"];
		$request .= "&";
		$request .= "staff_username=".$_SESSION[$this->config->item("sess_cookie_name")]["staff_username"];
		$request .= "&";
		$request .= "staff_token=".$_SESSION[$this->config->item("sess_cookie_name")]["staff_token"];
		$request .= "&";
		$request .= "new_app_api_username=".$new_app_api_username;
		
		$response = file_get_contents($request);
		
		echo $response;
		
	}
	
	
	
	public function remove()
	{
		extract($_POST);
		
		$request =  $this->config->item("rest_server_url");
		$request .= "index.php/api/api_clients/api_clients/remove";
		$request .= "?";
		
		$request .= "app_api_username=".$_SESSION[$this->config->item("sess_cookie_name")]["app_api_username"];
		$request .= "&";
		
		$request .= "staff_username=".$_SESSION[$this->config->item("sess_cookie_name")]["staff_username"];
		$request .= "&";
		
		$request .= "staff_token=".$_SESSION[$this->config->item("sess_cookie_name")]["staff_token"];	
		$request .= "&";
		
		$request .= "auto_id_0=".$auto_id_0;	
		
		$request = $request;
		
		$response = file_get_contents($request);
		echo $response;
		
		
	}
	
	public function view()
	{
		extract($_POST);
		
		$request =  $this->config->item("rest_server_url");
		$request .= "index.php/api/api_clients/api_clients/view";
		$request .= "?";
		
		$request .= "app_api_username=".$_SESSION[$this->config->item("sess_cookie_name")]["app_api_username"];
		$request .= "&";
		
		$request .= "staff_username=".$_SESSION[$this->config->item("sess_cookie_name")]["staff_username"];
		$request .= "&";
		
		$request .= "staff_token=".$_SESSION[$this->config->item("sess_cookie_name")]["staff_token"];
		$request .= "&";
		
		$request .="search_key_word=".$search_key_word;	
		
		$request = $request;
		
		$response = file_get_contents($request);
		echo $response;
	}

	
	public function add_new()
	{
		extract($_POST);
		
		$request =  $this->config->item("rest_server_url");
		$request .= "index.php/api/api_clients/api_clients/add_new";
		$request .= "?";
		
		$request .= "app_api_username=".$_SESSION[$this->config->item("sess_cookie_name")]["app_api_username"];
		$request .= "&";
		
		$request .= "staff_username=".$_SESSION[$this->config->item("sess_cookie_name")]["staff_username"];
		$request .= "&";
		
		$request .= "staff_token=".$_SESSION[$this->config->item("sess_cookie_name")]["staff_token"];
		$request .= "&";
		
		$request .= "req_app_api_key=".$req_app_api_key;
		$request .= "&";
		
		$request .= "req_app_api_username=".$req_app_api_username;
		$request .= "&";
		
		$request .= "req_app_api_password=".$req_app_api_password;
		$request .= "&";
		
		$request .= "req_app_api_company=".urlencode($req_app_api_company);
		$request .= "&";
		
		$request .= "req_app_api_company_phone=".urlencode($req_app_api_company_phone);
		$request .= "&";
		
		$request .= "req_app_api_company_address=".urlencode($req_app_api_company_address);
		$request .= "&";
		
		$request .= "req_app_api_company_desc=".urlencode($req_app_api_company_desc);
		$request .= "&";
		
		$request .= "req_app_api_staff_id_prefix=".urlencode($req_app_api_staff_id_prefix);
		$request .= "&";
		
		$request .= "req_app_api_referral_id_prefix=".urlencode($req_app_api_referral_id_prefix);
		$request .= "&";
		
		$request .= "req_app_api_patient_id_prefix=".urlencode($req_app_api_patient_id_prefix);
		$request .= "&";
		
		$request .= "req_app_api_doctor_id_prefix=".urlencode($req_app_api_doctor_id_prefix);
		$request .= "&";
		
		$request = $request;
		
		$response = file_get_contents($request);
		echo $response;
	}
	
	public function generate_app_api_key()
	{
		$request =  $this->config->item("rest_server_url");
		$request .= "index.php/api/api_clients/api_clients/generate_app_api_key";
		$request .= "?";
		$request .= "app_api_username=".$_SESSION[$this->config->item("sess_cookie_name")]["app_api_username"];
		$request .= "&";
		$request .= "staff_username=".$_SESSION[$this->config->item("sess_cookie_name")]["staff_username"];
		$request .= "&";
		$request .= "staff_token=".$_SESSION[$this->config->item("sess_cookie_name")]["staff_token"];
		
		$response = file_get_contents($request);
		if(trim($response) != "")
		{
			if(json_decode($response)->result == true)
			{
				return json_decode($response)->app_api_key;
			}
		}
		
		return $response;
	}
}
