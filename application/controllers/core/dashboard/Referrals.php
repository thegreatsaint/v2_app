<?php
defined('BASEPATH') OR exit('No direct script access allowed');
ob_start();
class Referrals extends CI_Controller {

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
		$this->Functions->check_basic_authentication($_SESSION[$this->config->item("sess_cookie_name")]["staff_username"],"referrals","");		
    }
	 	
	public function index()
	{
		$data['page_title'] = 'Referrals';
		$data['rights'] = $this->Functions->get_staff_task_permission($_SESSION[$this->config->item("sess_cookie_name")]["staff_username"],"referrals");
		$this->load->view('common/header',$data);
		$this->load->view('common/common_script',$data);
		$this->load->view('common/top_bar',$data);
		if($this->Functions->get_staff_task_permission($_SESSION[$this->config->item("sess_cookie_name")]["staff_username"],"referrals") == 'full')
		{
			$this->load->view('dashboard/configurations/referral_source');
		}	
		$this->load->view('dashboard/referrals/referrals');
		$this->load->view('common/footer');
	} 

	
	public function edit()
	{
		extract($_POST);
		
		$request =  $this->config->item("rest_server_url");
		$request .= "index.php/api/referrals/referrals/edit";
		$request .= "?";
		
		$request .= "app_api_username=".$_SESSION[$this->config->item("sess_cookie_name")]["app_api_username"];
		$request .= "&";
		
		$request .= "staff_username=".$_SESSION[$this->config->item("sess_cookie_name")]["staff_username"];
		$request .= "&";
		
		$request .= "staff_token=".$_SESSION[$this->config->item("sess_cookie_name")]["staff_token"];	
		$request .= "&";
		
		$request .= "req_ref_id=".$req_ref_id;	
		
		$request = $request;
		
		$response = file_get_contents($request);
		echo $response;
	}
	
	public function check_valid_username()
	{
		extract($_POST);
		
		$request =  $this->config->item("rest_server_url");
		$request .= "index.php/api/referrals/referrals/check_valid_username";
		$request .= "?";
		$request .= "app_api_username=".$_SESSION[$this->config->item("sess_cookie_name")]["app_api_username"];
		$request .= "&";
		$request .= "staff_username=".$_SESSION[$this->config->item("sess_cookie_name")]["staff_username"];
		$request .= "&";
		$request .= "staff_token=".$_SESSION[$this->config->item("sess_cookie_name")]["staff_token"];
		$request .= "&";
		$request .= "req_new_ref_username=".$req_new_ref_username;
		
		$response = file_get_contents($request);
		
		echo $response;
		
	}
	
	public function check_valid_email_id()
	{
		extract($_POST);
		
		$request =  $this->config->item("rest_server_url");
		$request .= "index.php/api/staffs/staffs/check_valid_email_id";
		$request .= "?";
		$request .= "app_api_username=".$_SESSION[$this->config->item("sess_cookie_name")]["app_api_username"];
		$request .= "&";
		$request .= "staff_username=".$_SESSION[$this->config->item("sess_cookie_name")]["staff_username"];
		$request .= "&";
		$request .= "staff_token=".$_SESSION[$this->config->item("sess_cookie_name")]["staff_token"];
		$request .= "&";
		$request .= "req_new_staff_email_id=".$req_new_staff_email_id;
		
		$response = file_get_contents($request);
		
		echo $response;
		
	}
	
	
	public function check_valid_mobile_no()
	{
		extract($_POST);
		
		$request =  $this->config->item("rest_server_url");
		$request .= "index.php/api/staffs/staffs/check_valid_mobile_no";
		$request .= "?";
		$request .= "app_api_username=".$_SESSION[$this->config->item("sess_cookie_name")]["app_api_username"];
		$request .= "&";
		$request .= "staff_username=".$_SESSION[$this->config->item("sess_cookie_name")]["staff_username"];
		$request .= "&";
		$request .= "staff_token=".$_SESSION[$this->config->item("sess_cookie_name")]["staff_token"];
		$request .= "&";
		$request .= "req_new_staff_mobile_no=".$req_new_staff_mobile_no;
		
		$response = file_get_contents($request);
		
		echo $response;
		
	}
	
	
	
	public function delete()
	{
		extract($_POST);
		
		$request =  $this->config->item("rest_server_url");
		$request .= "index.php/api/referrals/referrals/delete";
		$request .= "?";
		
		$request .= "app_api_username=".$_SESSION[$this->config->item("sess_cookie_name")]["app_api_username"];
		$request .= "&";
		
		$request .= "staff_username=".$_SESSION[$this->config->item("sess_cookie_name")]["staff_username"];
		$request .= "&";
		
		$request .= "staff_token=".$_SESSION[$this->config->item("sess_cookie_name")]["staff_token"];	
		$request .= "&";
		
		$request .= "req_ref_id=".$req_ref_id;	
		
		$request = $request;
		
		$response = file_get_contents($request);
		echo $response;
		
		
	}
	
	public function view()
	{
		extract($_POST);
		
		$request =  $this->config->item("rest_server_url");
		$request .= "index.php/api/referrals/referrals/view";
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
		$request .= "index.php/api/referrals/referrals/add_new";
		$request .= "?";
		
		$request .= "app_api_username=".$_SESSION[$this->config->item("sess_cookie_name")]["app_api_username"];
		$request .= "&";
		
		$request .= "staff_username=".$_SESSION[$this->config->item("sess_cookie_name")]["staff_username"];
		$request .= "&";
		
		$request .= "staff_token=".$_SESSION[$this->config->item("sess_cookie_name")]["staff_token"];
		$request .= "&";
		
		$request .= "req_ref_first_name=".urlencode($req_ref_first_name);
		$request .= "&";
		
		$request .= "req_ref_last_name=".urlencode($req_ref_last_name);
		$request .= "&";
		
		$request .= "req_ref_entity_name=".urlencode($req_ref_entity_name);
		$request .= "&";
		
		$request .= "req_ref_email_id=".urlencode($req_ref_email_id);
		$request .= "&";
		
		$request .= "req_ref_username=".urlencode($req_ref_username);
		$request .= "&";
		
		$request .= "req_ref_password=".urlencode($req_ref_password);
		$request .= "&";
		
		$request .= "req_ref_contact_no=".urlencode($req_ref_contact_no);
		$request .= "&";
		
		$request .= "req_ref_address=".urlencode($req_ref_address);
		$request .= "&";
		
		$request .= "req_ref_desc=".urlencode($req_ref_desc);
		$request .= "&";
		
		$request .= "req_ref_image=".urlencode($req_ref_image);
		$request .= "&";
		
		$request .= "req_ref_gender=".urlencode($req_ref_gender);
		$request .= "&";
		
		$request .= "req_ref_sbi=".urlencode($req_ref_sbi);
	
		$request = $request;
		
		$response = file_get_contents($request);
		echo $response;
	}
	
	
	public function update()
	{
		extract($_POST);
		
		$request =  $this->config->item("rest_server_url");
		$request .= "index.php/api/referrals/referrals/update";
		$request .= "?";
		
		$request .= "app_api_username=".$_SESSION[$this->config->item("sess_cookie_name")]["app_api_username"];
		$request .= "&";
		
		$request .= "staff_username=".$_SESSION[$this->config->item("sess_cookie_name")]["staff_username"];
		$request .= "&";
		
		$request .= "staff_token=".$_SESSION[$this->config->item("sess_cookie_name")]["staff_token"];
		$request .= "&";
		
		$request .= "req_ref_id=".urlencode($req_ref_id);
		$request .= "&";
		
		$request .= "req_ref_first_name=".urlencode($req_ref_first_name);
		$request .= "&";
		
		$request .= "req_ref_last_name=".urlencode($req_ref_last_name);
		$request .= "&";
		
		$request .= "req_ref_entity_name=".urlencode($req_ref_entity_name);
		$request .= "&";
		
		$request .= "req_ref_email_id=".urlencode($req_ref_email_id);
		$request .= "&";
		
		$request .= "req_ref_username=".urlencode($req_ref_username);
		$request .= "&";
		
		$request .= "req_ref_password=".urlencode($req_ref_password);
		$request .= "&";
		
		$request .= "req_ref_contact_no=".urlencode($req_ref_contact_no);
		$request .= "&";
		
		$request .= "req_ref_address=".urlencode($req_ref_address);
		$request .= "&";
		
		$request .= "req_ref_desc=".urlencode($req_ref_desc);
		$request .= "&";
		
		$request .= "req_ref_image=".urlencode($req_ref_image);
		$request .= "&";
		
		$request .= "req_ref_gender=".urlencode($req_ref_gender);
		$request .= "&";
		
		$request .= "req_ref_sbi=".urlencode($req_ref_sbi);
	
		$request = $request;
		
		$response = file_get_contents($request);
		echo $response;
	}
	
	public function staff_logout()
	{
		$request =  $this->config->item("rest_server_url");
		$request .= "index.php/api/staffs/staffs/staff_logout";
		$request .= "?";
		$request .= "app_api_username=".$_SESSION[$this->config->item("sess_cookie_name")]["app_api_username"];
		$request .= "&";
		$request .= "staff_username=".$_SESSION[$this->config->item("sess_cookie_name")]["staff_username"];
		$request .= "&";
		$request .= "staff_token=".$_SESSION[$this->config->item("sess_cookie_name")]["staff_token"];
		
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
