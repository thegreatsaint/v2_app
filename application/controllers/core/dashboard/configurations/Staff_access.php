<?php
defined('BASEPATH') OR exit('No direct script access allowed');
ob_start();
class Staff_access extends CI_Controller {

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
		$this->Functions->check_basic_authentication($_SESSION[$this->config->item("sess_cookie_name")]["staff_username"],"staffs","");		
    }
	 	
	public function index()
	{
		
		$data['page_title'] = 'Staff Access';
		$this->load->view('common/header',$data);
		$this->load->view('common/common_script',$data);
		$this->load->view('common/top_bar',$data);	
		$this->load->view('dashboard/staff_access/staff_access');
		$this->load->view('common/footer');
	} 
	
	public function view()
	{
		extract($_POST);
		
		$request =  $this->config->item("rest_server_url");
		$request .= "index.php/api/configurations/staff_access/view";
		$request .= "?";
		
		$request .= "app_api_username=".urlencode($_SESSION[$this->config->item("sess_cookie_name")]["app_api_username"]);
		$request .= "&";
		
		$request .= "staff_username=".urlencode($_SESSION[$this->config->item("sess_cookie_name")]["staff_username"]);
		$request .= "&";
		
		$request .= "staff_token=".urlencode($_SESSION[$this->config->item("sess_cookie_name")]["staff_token"]);
		$request .= "&";
		
		$request .= "req_staff_role=".urlencode($req_staff_role);	
		
		$request = $request;
		
		$response = file_get_contents($request);
		echo $response;
	}
	
	public function get_staff_role()
	{
		extract($_POST);
		
		$request =  $this->config->item("rest_server_url");
		$request .= "index.php/api/staff_access/staff_access/get_staff_role";
		$request .= "?";
		
		$request .= "app_api_username=".$_SESSION[$this->config->item("sess_cookie_name")]["app_api_username"];
		$request .= "&";
		
		$request .= "staff_username=".$_SESSION[$this->config->item("sess_cookie_name")]["staff_username"];
		$request .= "&";
		
		$request .= "staff_token=".$_SESSION[$this->config->item("sess_cookie_name")]["staff_token"];	
		
		$request = $request;
		
		$response = file_get_contents($request);
		echo $response;
	}
	
	public function delete()
	{
		extract($_POST);
		
		$request =  $this->config->item("rest_server_url");
		$request .= "index.php/api/configurations/staff_access/delete";
		$request .= "?";
		
		$request .= "app_api_username=".$_SESSION[$this->config->item("sess_cookie_name")]["app_api_username"];
		$request .= "&";
		
		$request .= "staff_username=".$_SESSION[$this->config->item("sess_cookie_name")]["staff_username"];
		$request .= "&";
		
		$request .= "staff_token=".$_SESSION[$this->config->item("sess_cookie_name")]["staff_token"];	
		$request .= "&";
		
		$request .= "req_auto_id_0=".$req_auto_id_0;	
		
		$request = $request;
		
		$response = file_get_contents($request);
		echo $response;
		
		
	}
	
	public function add_new()
	{
		extract($_POST);
		
		$request =  $this->config->item("rest_server_url");
		$request .= "index.php/api/configurations/staff_access/add_new";
		$request .= "?";
		
		$request .= "app_api_username=".urlencode($_SESSION[$this->config->item("sess_cookie_name")]["app_api_username"]);
		$request .= "&";
		
		$request .= "staff_username=".urlencode($_SESSION[$this->config->item("sess_cookie_name")]["staff_username"]);
		$request .= "&";
		
		$request .= "staff_token=".urlencode($_SESSION[$this->config->item("sess_cookie_name")]["staff_token"]);
		$request .= "&";
		
		$request .= "req_task_name=".urlencode($req_task_name);
		$request .= "&";
		
		$request .= "req_rights=".urlencode($req_rights);
		$request .= "&";
		
		$request .= "req_staff_role=".urlencode($req_staff_role);
		
		$request = $request;
		
		$response = file_get_contents($request);
		echo $response;
	}
	
	
	public function update()
	{
		extract($_POST);
		
		$request =  $this->config->item("rest_server_url");
		$request .= "index.php/api/staffs/staffs/update";
		$request .= "?";
		
		$request .= "app_api_username=".urlencode($_SESSION[$this->config->item("sess_cookie_name")]["app_api_username"]);
		$request .= "&";
		
		$request .= "staff_username=".urlencode($_SESSION[$this->config->item("sess_cookie_name")]["staff_username"]);
		$request .= "&";
		
		$request .= "staff_token=".urlencode($_SESSION[$this->config->item("sess_cookie_name")]["staff_token"]);
		$request .= "&";
		
		$request .= "req_staff_id=".urlencode($req_staff_id);
		$request .= "&";
		
		$request .= "req_staff_first_name=".urlencode($req_staff_first_name);
		$request .= "&";
		
		$request .= "req_staff_last_name=".urlencode($req_staff_last_name);
		$request .= "&";
		
		$request .= "req_staff_password=".urlencode($req_staff_password);
		$request .= "&";
		
		$request .= "req_staff_image=".urlencode($req_staff_image);
		$request .= "&";
		
		$request .= "req_staff_role=".urlencode($req_staff_role);
		$request .= "&";
		
		$request .= "req_staff_gender=".urlencode($req_staff_gender);
		$request .= "&";
		
		$request .= "req_staff_email_id=".urlencode($req_staff_email_id);
		$request .= "&";
		
		$request .= "req_staff_mobile_no=".urlencode($req_staff_mobile_no);
		$request .= "&";
		
		$request .= "req_staff_home_phone=".urlencode($req_staff_home_phone);
		$request .= "&";
		
		$request .= "req_staff_address=".urlencode($req_staff_address);
		$request .= "&";
		
		$request .= "req_staff_desc=".urlencode($req_staff_desc);
	
		$request = $request;
		
		$response = file_get_contents($request);
		echo $response;
	}
}
