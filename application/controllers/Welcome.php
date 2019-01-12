<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

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
		
		$_SESSION[$this->config->item("sess_cookie_name")] = array(
											"app_api_key" => $this->config->item("app_api_key"),
											"app_api_username" => $this->config->item("app_api_username"),
											"app_api_password" => $this->config->item("app_api_password"),
											"company_name" => $this->config->item("company_name"),
											"staff_username" => "",
											"staff_token" => ""
										  );
							  
		if(trim($_SESSION[$this->config->item("sess_cookie_name")]["app_api_key"]) == "")
		{
			echo "<h1 style='color:#ff0000'>API KEY DOES NOT FOUND</h1>";
			exit();
		}
		else if(trim($_SESSION[$this->config->item("sess_cookie_name")]["app_api_username"]) == "")
		{
			echo "<h1 style='color:#ff0000'>API USERNAME DOES NOT FOUND</h1>";
			exit();
		}
		else if(trim($_SESSION[$this->config->item("sess_cookie_name")]["app_api_password"]) == "")
		{
			echo "<h1 style='color:#ff0000'>API PASSWORD DOES NOT FOUND</h1>";
			exit();
		}
		else
		{
			if(!$this->check_api_config())
			{
				echo "<h1 style='color:#ff0000'>INVALID API CONFIGURATION CHECK THAT</h1>";
				exit();
			}
		}
		
     }
	 
	public function index()
	{				
		$data['page_title'] = 'Welcome';
		$this->load->view('common/header',$data);
		$this->load->view('welcome_message');
		$this->load->view('common/footer');
	}
	
	public function entrance()
	{
		$data['page_title'] = 'Entrance';
		$this->load->view('common/header',$data);
		$this->load->view('entrance');
		$this->load->view('common/footer');
	}
	
	public function check_api_config()
	{
		$request =  $this->config->item("rest_server_url");
		$request .= "index.php/api/config/config/check_api_config";
		$request .= "?";
		$request .= "app_api_key=".$_SESSION[$this->config->item("sess_cookie_name")]["app_api_key"];
		$request .= "&";
		$request .= "app_api_username=".$_SESSION[$this->config->item("sess_cookie_name")]["app_api_username"];
		$request .= "&";
		$request .= "app_api_password=".$_SESSION[$this->config->item("sess_cookie_name")]["app_api_password"];
		
		$response = file_get_contents($request);
		
		if(json_decode($response)->result == true)
		{
			$_SESSION[$this->config->item("sess_cookie_name")]["company_name"] = json_decode($response)->app_api_company_name;
			return true;
		}
		else
		{
			return false;
		}
	}
	
	public function login()
	{
		extract($_POST);
	
		$request =  $this->config->item("rest_server_url");
		$request .= "index.php/api/login/login/staff_login";
		$request .= "?";
		$request .= "app_api_username=".$_SESSION[$this->config->item("sess_cookie_name")]["app_api_username"];
		$request .= "&";
		$request .= "staff_username=".$req_staff_username;
		$request .= "&";
		$request .= "staff_password=".$req_staff_password;
		
		$response = file_get_contents($request);
			
		if(json_decode($response)->result == true)
		{
			$_SESSION[$this->config->item("sess_cookie_name")]["staff_username"] = json_decode($response)->staff_username;
			$_SESSION[$this->config->item("sess_cookie_name")]["staff_token"] = json_decode($response)->staff_token;
		}		
		
		echo $response;
	}
	
	
	
}
