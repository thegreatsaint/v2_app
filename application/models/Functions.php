<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//$_SESSION["re_req_app_username"] = $req_app_username;
				//$_SESSION["re_current_token"] = $token;

class Functions extends CI_Model 
{
	 function __construct()
     {
        parent::__construct();
		
		$this->load->helper('string');
	    $this->load->library('session');
		date_default_timezone_set($this->config->item("time_zone"));
	 }
	 
	 function today_date()
	 {
		 $d = date('d');
		 
		 if($d == 1)
		 {
			 return $this->config->item("rest_server_url")."assets/images/icons/1.png";
		 }
		 else if($d == 2)
		 {
			 return $this->config->item("rest_server_url")."assets/images/icons/2.png";
		 }
		  else if($d == 3)
		 {
			 return $this->config->item("rest_server_url")."assets/images/icons/3.png";
		 }
		  else if($d == 4)
		 {
			 return $this->config->item("rest_server_url")."assets/images/icons/4.png";
		 }
		  else if($d == 5)
		 {
			 return $this->config->item("rest_server_url")."assets/images/icons/5.png";
		 }
		  else if($d == 6)
		 {
			 return $this->config->item("rest_server_url")."assets/images/icons/6.png";
		 }
		  else if($d == 7)
		 {
			 return $this->config->item("rest_server_url")."assets/images/icons/7.png";
		 }
		  else if($d == 8)
		 {
			 return $this->config->item("rest_server_url")."assets/images/icons/8.png";
		 }
		  else if($d == 9)
		 {
			 return $this->config->item("rest_server_url")."assets/images/icons/9.png";
		 }
		  else if($d == 10)
		 {
			 return $this->config->item("rest_server_url")."assets/images/icons/10.png";
		 }
		  else if($d == 11)
		 {
			 return $this->config->item("rest_server_url")."assets/images/icons/11.png";
		 }
		  else if($d == 12)
		 {
			 return $this->config->item("rest_server_url")."assets/images/icons/12.png";
		 }
		  else if($d == 13)
		 {
			 return $this->config->item("rest_server_url")."assets/images/icons/13.png";
		 }
		  else if($d == 14)
		 {
			 return $this->config->item("rest_server_url")."assets/images/icons/14.png";
		 }
		  else if($d == 15)
		 {
			 return $this->config->item("rest_server_url")."assets/images/icons/15.png";
		 }
		  else if($d == 16)
		 {
			 return $this->config->item("rest_server_url")."assets/images/icons/16.png";
		 }
		  else if($d == 17)
		 {
			 return $this->config->item("rest_server_url")."assets/images/icons/17.png";
		 }
		  else if($d == 18)
		 {
			 return $this->config->item("rest_server_url")."assets/images/icons/18.png";
		 }
		  else if($d == 19)
		 {
			 return $this->config->item("rest_server_url")."assets/images/icons/19.png";
		 }
		  else if($d == 20)
		 {
			 return $this->config->item("rest_server_url")."assets/images/icons/20.png";
		 }
		  else if($d == 21)
		 {
			 return $this->config->item("rest_server_url")."assets/images/icons/21.png";
		 }
		  else if($d == 22)
		 {
			 return $this->config->item("rest_server_url")."assets/images/icons/22.png";
		 }
		  else if($d == 23)
		 {
			 return $this->config->item("rest_server_url")."assets/images/icons/23.png";
		 }
		  else if($d == 24)
		 {
			 return $this->config->item("rest_server_url")."assets/images/icons/24.png";
		 }
		  else if($d == 25)
		 {
			 return $this->config->item("rest_server_url")."assets/images/icons/25.png";
		 }
		  else if($d == 26)
		 {
			 return $this->config->item("rest_server_url")."assets/images/icons/26.png";
		 }
		  else if($d == 27)
		 {
			 return $this->config->item("rest_server_url")."assets/images/icons/27.png";
		 }
		  else if($d == 28)
		 {
			 return $this->config->item("rest_server_url")."assets/images/icons/28.png";
		 }
		  else if($d == 29)
		 {
			 return $this->config->item("rest_server_url")."assets/images/icons/29.png";
		 }
		  else if($d == 30)
		 {
			 return $this->config->item("rest_server_url")."assets/images/icons/30.png";
		 }
		  else if($d == 31)
		 {
			 return $this->config->item("rest_server_url")."assets/images/icons/31.png";
		 }
	 }
	 
	  
	 function check_basic_authentication($staff_username,$task_name,$rights)
	 {
		 if(!isset($_SESSION[$this->config->item("sess_cookie_name")]))
		 {
			 $this->exit_page(1);
		 }
		 if(!$this->check_staff_login($_SESSION[$this->config->item("sess_cookie_name")]["app_api_username"],$_SESSION[$this->config->item("sess_cookie_name")]["staff_username"],$_SESSION[$this->config->item("sess_cookie_name")]["staff_token"]))
		 {
			 $this->exit_page(2);
		 }
		 if(!$this->check_staff_task_permission($staff_username,$task_name,$rights))
		 {
			 $this->exit_page(3);
		 }
	 }
	 
	 function return_week_day($week_no)
	 {
		switch($week_no)
		{
				case "1":
				{
					return "Mon";
					break;
				}
				
				case "2":
				{
					return "Tue";
					break;
				}
				
				case "3":
				{
					return "Wed";
					break;
				}
				
				case "4":
				{
					return "Thu";
					break;
				}
				
				case "5":
				{
					return "Fri";
					break;
				}
				
				case "6":
				{
					return "Sat";
					break;
				}
				
				case "7":
				{
					return "Sun";
					break;
				}
		}
	 }
	 
	 function return_month_name($week_no)
	 {
		switch($week_no)
		{
				case "1":
				{
					return "Jan";
					break;
				}
				
				case "2":
				{
					return "Feb";
					break;
				}
				
				case "3":
				{
					return "Mar";
					break;
				}
				
				case "4":
				{
					return "Apr";
					break;
				}
				
				case "5":
				{
					return "May";
					break;
				}
				
				case "6":
				{
					return "Jun";
					break;
				}
				
				case "7":
				{
					return "Jul";
					break;
				}
				
				case "8":
				{
					return "Aug";
					break;
				}
				
				case "9":
				{
					return "Sep";
					break;
				}
				
				case "10":
				{
					return "Oct";
					break;
				}
				
				case "11":
				{
					return "Nov";
					break;
				}
				
				case "12":
				{
					return "Dec";
					break;
				}
			
		}
	 }
	 
	 function get_staff_task_permission($staff_username,$task_name)
	 {
		 $rights = "";
		 
		 if($this->check_staff_task_permission($staff_username,$task_name,"full"))
		 {
			  $rights = "full";
		 }
		 
		 if($this->check_staff_task_permission($staff_username,$task_name,"write"))
		 {
			  $rights = "write";
		 }
		 
		 if($this->check_staff_task_permission($staff_username,$task_name,"read"))
		 {
			  $rights = "read";
		 }
		 
		 return $rights;
	 }
	 
	 function check_staff_task_permission($staff_username,$task_name,$rights)
	 {
			$request = $this->config->item("rest_server_url");
			$request .= "index.php/api/staffs/staffs/check_staff_task_permission";
			$request .= "?";
			$request .= "app_api_username=".urlencode($_SESSION[$this->config->item("sess_cookie_name")]["app_api_username"]);
			$request .= "&";
			$request .= "staff_username=".urlencode($staff_username);
			$request .= "&";
			$request .= "staff_token=".urlencode($_SESSION[$this->config->item("sess_cookie_name")]["staff_token"]);
			$request .= "&";
			$request .= "task_name=".urlencode($task_name);
			$request .= "&";
			$request .= "rights=".urlencode($rights);
			
			$response = file_get_contents($request);
			
			//echo $request;
			
			//echo $response;
	
			if(json_decode($response)->result == true)
			{
				return true;
			}
			else
			{
				return false;
			}

	 }
	 
	 function check_staff_login($app_api_username,$staff_username,$staff_token)
	 {
		$request = $this->config->item("rest_server_url");
		$request .= "index.php/api/staffs/staffs/check_staff_login";
		$request .= "?";
		$request .= "app_api_username=".urlencode($app_api_username);
		$request .= "&";
		$request .= "staff_username=".urlencode($staff_username);
		$request .= "&";
		$request .= "staff_token=".urlencode($staff_token);
		
		$response = file_get_contents($request);
		
		if(json_decode($response)->result == true)
		{
			return true;
		}
		else
		{
			return false;
		}

	 }
	 
	 function exit_page($option)
	 {
		 if($option = 1)
		 {
			 header('location:'.$this->config->item("base_url").'');
		 }
		 else if($option = 2)
		 {
			 header('location:'.$this->config->item("base_url").'');
		 }
		 else if($option = 3)
		 {
			 header('location:'.$this->config->item("base_url").'');
		 }
	 }
	 
	 
}
?>