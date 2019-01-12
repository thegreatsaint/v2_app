<?php
defined('BASEPATH') OR exit('No direct script access allowed');
ob_start();
class Reminders extends CI_Controller {

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
		date_default_timezone_set($this->config->item("time_zone"));	
    }
	 	
	public function index()
	{
		$data['date'] = date('m/d/Y');
		$data['time'] = date('h:i A');
		
		$data['page_title'] = 'Reminders';
		$data['rights'] = $this->Functions->get_staff_task_permission($_SESSION[$this->config->item("sess_cookie_name")]["staff_username"],"reminders");
		$this->load->view('common/header',$data);
		$this->load->view('common/common_script',$data);
		$this->load->view('common/top_bar',$data);
		$this->load->view('dashboard/reminders/reminders');
		if($this->Functions->get_staff_task_permission($_SESSION[$this->config->item("sess_cookie_name")]["staff_username"],"reminders") == 'full')
		{
			$this->load->view('dashboard/configurations/services');
			$this->load->view('dashboard/configurations/service_type');
		}
		$this->load->view('common/footer');
	} 
	
	
	public function location_check_date_conflict()
	{
		extract($_POST);
		
		$request =  $this->config->item("rest_server_url");
		$request .= "index.php/api/reminders/reminders/location_check_date_conflict";
		$request .= "?";
		
		$request .= "app_api_username=".$_SESSION[$this->config->item("sess_cookie_name")]["app_api_username"];
		$request .= "&";
		
		$request .= "staff_username=".$_SESSION[$this->config->item("sess_cookie_name")]["staff_username"];
		$request .= "&";
		
		$request .= "staff_token=".$_SESSION[$this->config->item("sess_cookie_name")]["staff_token"];
		$request .= "&";
		
		$request .= "req_reminder_start_date=".urlencode($req_reminder_start_date);
		$request .= "&";
		
		$request .= "req_reminder_end_date=".urlencode($req_reminder_end_date);
		$request .= "&";
		
		$request .= "req_reminder_start_time=".urlencode($req_reminder_start_time);
		$request .= "&";
		
		$request .= "req_reminder_end_time=".urlencode($req_reminder_end_time);
		$request .= "&";
		
		$request .= "req_reminder_event_from_date=".urlencode($req_reminder_event_from_date);
		$request .= "&";
		
		$request .= "req_reminder_event_to_date=".urlencode($req_reminder_event_to_date);
		$request .= "&";
		
		$request .= "req_reminder_event_type=".urlencode($req_reminder_event_type);
		$request .= "&";
		
		$request .= "req_repeat_weeks=".urlencode($req_repeat_weeks);
		$request .= "&";
		
		$request .= "req_repeat_months=".urlencode($req_repeat_months);
		$request .= "&";
		
		$request .= "req_repeat_years=".urlencode($req_repeat_years);
		$request .= "&";
	
		$request .= "req_reminder_repeat=".urlencode($req_reminder_repeat);
		$request .= "&";
		
		$request .= "req_reminder_calendar=".urlencode($req_reminder_calendar);
		$request .= "&";
		
		$request .= "req_reminder_location=".urlencode($req_reminder_location);
		$request .= "&";
		
		
		
		//echo $request;
		
		$response = file_get_contents($request);
		
		echo $response;
		
		
	}
	
	public function check_date_conflict()
	{
		extract($_POST);
		
		$request =  $this->config->item("rest_server_url");
		$request .= "index.php/api/reminders/reminders/check_date_conflict";
		$request .= "?";
		
		$request .= "app_api_username=".$_SESSION[$this->config->item("sess_cookie_name")]["app_api_username"];
		$request .= "&";
		
		$request .= "staff_username=".$_SESSION[$this->config->item("sess_cookie_name")]["staff_username"];
		$request .= "&";
		
		$request .= "staff_token=".$_SESSION[$this->config->item("sess_cookie_name")]["staff_token"];
		$request .= "&";
		
		$request .= "req_reminder_start_date=".urlencode($req_reminder_start_date);
		$request .= "&";
		
		$request .= "req_reminder_end_date=".urlencode($req_reminder_end_date);
		$request .= "&";
		
		$request .= "req_reminder_start_time=".urlencode($req_reminder_start_time);
		$request .= "&";
		
		$request .= "req_reminder_end_time=".urlencode($req_reminder_end_time);
		$request .= "&";
		
		$request .= "req_reminder_event_from_date=".urlencode($req_reminder_event_from_date);
		$request .= "&";
		
		$request .= "req_reminder_event_to_date=".urlencode($req_reminder_event_to_date);
		$request .= "&";
		
		$request .= "req_reminder_event_type=".urlencode($req_reminder_event_type);
		$request .= "&";
		
		$request .= "req_repeat_weeks=".urlencode($req_repeat_weeks);
		$request .= "&";
		
		$request .= "req_repeat_months=".urlencode($req_repeat_months);
		$request .= "&";
		
		$request .= "req_repeat_years=".urlencode($req_repeat_years);
		$request .= "&";
	
		$request .= "req_reminder_repeat=".urlencode($req_reminder_repeat);
		$request .= "&";
		
		$request .= "req_reminder_calendar=".urlencode($req_reminder_calendar);
		$request .= "&";
		
		//echo $request;
		
		$response = file_get_contents($request);
		
		echo $response;
		
		
	}
	
	public function service_check_date_conflict()
	{
		extract($_REQUEST);
		//echo $req_patient_id;
		
		$request =  $this->config->item("rest_server_url");
		$request .= "index.php/api/reminders/reminders/service_check_date_conflict";
		$request .= "?";
		
		$request .= "app_api_username=".$_SESSION[$this->config->item("sess_cookie_name")]["app_api_username"];
		$request .= "&";
		
		$request .= "staff_username=".$_SESSION[$this->config->item("sess_cookie_name")]["staff_username"];
		$request .= "&";
		
		$request .= "staff_token=".$_SESSION[$this->config->item("sess_cookie_name")]["staff_token"];
		$request .= "&";
		
		$request .= "req_reminder_start_date=".urlencode($req_reminder_start_date);
		$request .= "&";
		
		$request .= "req_reminder_end_date=".urlencode($req_reminder_end_date);
		$request .= "&";
		
		$request .= "req_reminder_start_time=".urlencode($req_reminder_start_time);
		$request .= "&";
		
		$request .= "req_reminder_end_time=".urlencode($req_reminder_end_time);
		$request .= "&";
		
		$request .= "req_reminder_event_from_date=".urlencode($req_reminder_event_from_date);
		$request .= "&";
		
		$request .= "req_reminder_event_to_date=".urlencode($req_reminder_event_to_date);
		$request .= "&";
		
		$request .= "req_reminder_event_type=".urlencode($req_reminder_event_type);
		$request .= "&";
		
		$request .= "req_repeat_weeks=".urlencode($req_repeat_weeks);
		$request .= "&";
		
		$request .= "req_repeat_months=".urlencode($req_repeat_months);
		$request .= "&";
		
		$request .= "req_repeat_years=".urlencode($req_repeat_years);
		$request .= "&";

		$request .= "req_reminder_repeat=".urlencode($req_reminder_repeat);
		$request .= "&";
		
		$request .= "req_reminder_calendar=".urlencode($req_reminder_calendar);
		$request .= "&";
		
		$request .= "req_service_code=".urlencode($req_service_code);
		$request .= "&";
		
		//echo $request;
		
		$response = file_get_contents($request);
		echo $response;	
	}
	
	
	public function doctor_check_date_conflict()
	{
		extract($_REQUEST);
		//echo $req_patient_id;
		
		$request =  $this->config->item("rest_server_url");
		$request .= "index.php/api/reminders/reminders/doctor_check_date_conflict";
		$request .= "?";
		
		$request .= "app_api_username=".$_SESSION[$this->config->item("sess_cookie_name")]["app_api_username"];
		$request .= "&";
		
		$request .= "staff_username=".$_SESSION[$this->config->item("sess_cookie_name")]["staff_username"];
		$request .= "&";
		
		$request .= "staff_token=".$_SESSION[$this->config->item("sess_cookie_name")]["staff_token"];
		$request .= "&";
		
		$request .= "req_reminder_start_date=".urlencode($req_reminder_start_date);
		$request .= "&";
		
		$request .= "req_reminder_end_date=".urlencode($req_reminder_end_date);
		$request .= "&";
		
		$request .= "req_reminder_start_time=".urlencode($req_reminder_start_time);
		$request .= "&";
		
		$request .= "req_reminder_end_time=".urlencode($req_reminder_end_time);
		$request .= "&";
		
		$request .= "req_reminder_event_from_date=".urlencode($req_reminder_event_from_date);
		$request .= "&";
		
		$request .= "req_reminder_event_to_date=".urlencode($req_reminder_event_to_date);
		$request .= "&";
		
		$request .= "req_reminder_event_type=".urlencode($req_reminder_event_type);
		$request .= "&";
		
		$request .= "req_repeat_weeks=".urlencode($req_repeat_weeks);
		$request .= "&";
		
		$request .= "req_repeat_months=".urlencode($req_repeat_months);
		$request .= "&";
		
		$request .= "req_repeat_years=".urlencode($req_repeat_years);
		$request .= "&";

		$request .= "req_reminder_repeat=".urlencode($req_reminder_repeat);
		$request .= "&";
		
		$request .= "req_reminder_calendar=".urlencode($req_reminder_calendar);
		$request .= "&";
		
		$request .= "req_doctor_id=".urlencode($req_doctor_id);
		$request .= "&";
		
		//echo $request;
		
		$response = file_get_contents($request);
		echo $response;	
	}
	
	public function patient_check_date_conflict()
	{
		extract($_REQUEST);
		//echo $req_patient_id;
		
		$request =  $this->config->item("rest_server_url");
		$request .= "index.php/api/reminders/reminders/patient_check_date_conflict";
		$request .= "?";
		
		$request .= "app_api_username=".$_SESSION[$this->config->item("sess_cookie_name")]["app_api_username"];
		$request .= "&";
		
		$request .= "staff_username=".$_SESSION[$this->config->item("sess_cookie_name")]["staff_username"];
		$request .= "&";
		
		$request .= "staff_token=".$_SESSION[$this->config->item("sess_cookie_name")]["staff_token"];
		$request .= "&";
		
		$request .= "req_reminder_start_date=".urlencode($req_reminder_start_date);
		$request .= "&";
		
		$request .= "req_reminder_end_date=".urlencode($req_reminder_end_date);
		$request .= "&";
		
		$request .= "req_reminder_start_time=".urlencode($req_reminder_start_time);
		$request .= "&";
		
		$request .= "req_reminder_end_time=".urlencode($req_reminder_end_time);
		$request .= "&";
		
		$request .= "req_reminder_event_from_date=".urlencode($req_reminder_event_from_date);
		$request .= "&";
		
		$request .= "req_reminder_event_to_date=".urlencode($req_reminder_event_to_date);
		$request .= "&";
		
		$request .= "req_reminder_event_type=".urlencode($req_reminder_event_type);
		$request .= "&";
		
		$request .= "req_repeat_weeks=".urlencode($req_repeat_weeks);
		$request .= "&";
		
		$request .= "req_repeat_months=".urlencode($req_repeat_months);
		$request .= "&";
		
		$request .= "req_repeat_years=".urlencode($req_repeat_years);
		$request .= "&";

		$request .= "req_reminder_repeat=".urlencode($req_reminder_repeat);
		$request .= "&";
		
		$request .= "req_reminder_calendar=".urlencode($req_reminder_calendar);
		$request .= "&";
		
		$request .= "req_patient_id=".urlencode($req_patient_id);
		$request .= "&";
		
		//echo $request;
		
		$response = file_get_contents($request);
		echo $response;	
	}
	
	
	public function staff_check_date_conflict()
	{
		extract($_REQUEST);
		//echo $req_patient_id;
		
		$request =  $this->config->item("rest_server_url");
		$request .= "index.php/api/reminders/reminders/staff_check_date_conflict";
		$request .= "?";
		
		$request .= "app_api_username=".$_SESSION[$this->config->item("sess_cookie_name")]["app_api_username"];
		$request .= "&";
		
		$request .= "staff_username=".$_SESSION[$this->config->item("sess_cookie_name")]["staff_username"];
		$request .= "&";
		
		$request .= "staff_token=".$_SESSION[$this->config->item("sess_cookie_name")]["staff_token"];
		$request .= "&";
		
		$request .= "req_reminder_start_date=".urlencode($req_reminder_start_date);
		$request .= "&";
		
		$request .= "req_reminder_end_date=".urlencode($req_reminder_end_date);
		$request .= "&";
		
		$request .= "req_reminder_start_time=".urlencode($req_reminder_start_time);
		$request .= "&";
		
		$request .= "req_reminder_end_time=".urlencode($req_reminder_end_time);
		$request .= "&";
		
		$request .= "req_reminder_event_from_date=".urlencode($req_reminder_event_from_date);
		$request .= "&";
		
		$request .= "req_reminder_event_to_date=".urlencode($req_reminder_event_to_date);
		$request .= "&";
		
		$request .= "req_reminder_event_type=".urlencode($req_reminder_event_type);
		$request .= "&";
		
		$request .= "req_repeat_weeks=".urlencode($req_repeat_weeks);
		$request .= "&";
		
		$request .= "req_repeat_months=".urlencode($req_repeat_months);
		$request .= "&";
		
		$request .= "req_repeat_years=".urlencode($req_repeat_years);
		$request .= "&";

		$request .= "req_reminder_repeat=".urlencode($req_reminder_repeat);
		$request .= "&";
		
		$request .= "req_reminder_calendar=".urlencode($req_reminder_calendar);
		$request .= "&";
		
		$request .= "req_staff_id=".urlencode($req_staff_id);
		$request .= "&";
		
		//echo $request;
		
		$response = file_get_contents($request);
		echo $response;
	}
	
	public function show_reminder_info()
	{
		extract($_REQUEST);
		
		$request =  $this->config->item("rest_server_url");
		$request .= "index.php/api/reminders/reminders/edit";
		$request .= "?";
		
		$request .= "app_api_username=".$_SESSION[$this->config->item("sess_cookie_name")]["app_api_username"];
		$request .= "&";
		
		$request .= "staff_username=".$_SESSION[$this->config->item("sess_cookie_name")]["staff_username"];
		$request .= "&";
		
		$request .= "staff_token=".$_SESSION[$this->config->item("sess_cookie_name")]["staff_token"];	
		$request .= "&";
		
		$request .= "req_reminder_id=".$req_reminder_id;
				
		$request = $request;
		
		$response = file_get_contents($request);
		//echo $response;
		
		
		
		$json_info = json_decode($response);
		$reminder_general_info = "";
		$participats_patients = "";
		$participats_staffs = "";
		$participats_doctors = "";
		$participats_services = "";
		for($i=0; $i < sizeof($json_info); $i++)
		{	
			if($json_info[$i]->is_owner)
			{
				$reminder_general_info .= '<div class="btn round_btn" title="Edit" onclick=edit_reminder("'.$json_info[$i]->reminder_id.'")>
											 <span class="fa fa-edit"></span>
										   </div>
											<div class="btn round_btn" title="Remove" onclick=delete_reminder("'.$json_info[$i]->reminder_id.'")>
												<span class="fa fa-trash"></span>
											</div>';
			}
			
			$reminder_general_info .= '<div class="row">';
			$reminder_general_info .= '<div class="col-lg-6">';
			
			$reminder_general_info .= '<p class="label2">Calendar of</p>';
			$reminder_general_info .= '<p class="label1">'.ucfirst($json_info[$i]->reminder_calendar).'</p>';
			
			
			$reminder_general_info .= '<p class="label2">Reminder subject</p>';
			$reminder_general_info .= '<p class="label1">'.$json_info[$i]->reminder_type.'</p>';
			
			
			$reminder_general_info .= '<p class="label2">Reminder type</p>';
			$reminder_general_info .= '<p class="label1">'.$json_info[$i]->reminder_event_type.'</p>';
			
			if($json_info[$i]->reminder_repeat != 'Daily')
			{
				$reminder_general_info .= '<p class="label2">Reminder starts on</p>';
				$reminder_general_info .= '<p class="label1">'.$json_info[$i]->reminder_start_date.' '.$json_info[$i]->reminder_start_time.'</p>';
				
				$reminder_general_info .= '<p class="label2">Reminder ends on</p>';
				$reminder_general_info .= '<p class="label1">'.$json_info[$i]->reminder_end_date.' '.$json_info[$i]->reminder_end_time.'</p>';
			}
			else
			{
				$reminder_general_info .= '<p class="label2">Reminder starts on</p>';
				$reminder_general_info .= '<p class="label1">-</p>';
				
				$reminder_general_info .= '<p class="label2">Reminder ends on</p>';
				$reminder_general_info .= '<p class="label1">-</p>';
			}
			$reminder_general_info .= '</div>';
			
			$reminder_general_info .= '<div class="col-lg-6">';
			
			$reminder_repeat = "";
			if($json_info[$i]->reminder_repeat == 'No')
			{
				$reminder_repeat = 'Regular';
			}
			
			if($json_info[$i]->reminder_repeat == 'No')
			{
				$reminder_general_info .= '<p class="label2">Reminder repeat</p>';
				$reminder_general_info .= '<p class="label1">'.$reminder_repeat.'</p>';
			}
			else if($json_info[$i]->reminder_repeat == 'Daily')
			{
				$reminder_general_info .= '<p class="label2">Reminder repeat</p>';
				$reminder_general_info .= '<p class="label1">'.$json_info[$i]->reminder_repeat.'</p>';
				
				$reminder_general_info .= '<p class="label2">Reminder repeat from</p>';
				$reminder_general_info .= '<p class="label1">'.$json_info[$i]->reminder_limit_from_date.'</p>';
				
				$reminder_general_info .= '<p class="label2">Reminder repeat to</p>';
				$reminder_general_info .= '<p class="label1">'.$json_info[$i]->reminder_limit_to_date.'</p>';
			}
			else if($json_info[$i]->reminder_repeat == 'Weekly')
			{
				$reminder_general_info .= '<p class="label2">Reminder repeat</p>';
				$reminder_general_info .= '<p class="label1">'.$json_info[$i]->reminder_repeat.'</p>';
				
				
				$arr = explode(",",$json_info[$i]->repeat_weeks);
				$week_day = '';
				
				foreach($arr as $value)
				{
					
					$week_day.=$this->Functions->return_week_day($value)." ";
				}
								
				$reminder_general_info .= '<p class="label2">Reminder weeks</p>';
				$reminder_general_info .= '<p class="label1">'.$week_day.'</p>';
				
				$reminder_general_info .= '<p class="label2">Reminder repeat from</p>';
				$reminder_general_info .= '<p class="label1">'.$json_info[$i]->reminder_limit_from_date.'</p>';
				
				$reminder_general_info .= '<p class="label2">Reminder repeat to</p>';
				$reminder_general_info .= '<p class="label1">'.$json_info[$i]->reminder_limit_to_date.'</p>';
			}
			else if($json_info[$i]->reminder_repeat == 'Monthly')
			{
				$reminder_general_info .= '<p class="label2">Reminder repeat</p>';
				$reminder_general_info .= '<p class="label1">'.$json_info[$i]->reminder_repeat.'</p>';
				
				$arr = explode(",",$json_info[$i]->repeat_months);
				$month_name = '';
				
				foreach($arr as $value)
				{					
					$month_name.=$this->Functions->return_month_name($value)." ";
				}
				
				$reminder_general_info .= '<p class="label2">Reminder months</p>';
				$reminder_general_info .= '<p class="label1">'.$month_name.'</p>';
				
				$reminder_general_info .= '<p class="label2">Reminder repeat from</p>';
				$reminder_general_info .= '<p class="label1">'.$json_info[$i]->reminder_limit_from_date.'</p>';
				
				$reminder_general_info .= '<p class="label2">Reminder repeat to</p>';
				$reminder_general_info .= '<p class="label1">'.$json_info[$i]->reminder_limit_to_date.'</p>';
			}
			else if($json_info[$i]->reminder_repeat == 'Yearly')
			{
				$reminder_general_info .= '<p class="label2">Reminder repeat</p>';
				$reminder_general_info .= '<p class="label1">'.$json_info[$i]->reminder_repeat.'</p>';	
				
				$reminder_general_info .= '<p class="label2">Reminder years</p>';
				$reminder_general_info .= '<p class="label1">'.$json_info[$i]->repeat_years.'</p>';	
			}
			
			
			$reminder_general_info .= '<p class="label2">Location</p>';
			$reminder_general_info .= '<p class="label1">'.$json_info[$i]->reminder_location.'</p>';
			
			$reminder_general_info .= '<p class="label2">Description</p>';
			$reminder_general_info .= '<p class="label1" align="justify">'.$json_info[$i]->reminder_desc_alert.'</p>';
			
			$reminder_general_info .= '</div></div>';
			
			
			$reminder_patients_json = json_decode($json_info[$i]->reminder_patients_json);
			
			if($json_info[$i]->reminder_patients_json != "[{}]")
			{
				for($k=0; $k<sizeof($reminder_patients_json); $k++)
				{
					if($reminder_patients_json[$k]->patient_id != "")
					{
					$participats_patients .= '<div class="need_hover guessing_item shadow_sm"> <img src="'.$reminder_patients_json[$k]->patient_image.'" width="50px"/> <span class="badge badge-secondary">'.$reminder_patients_json[$k]->patient_id.'</span> <span class="">'.$reminder_patients_json[$k]->patient_first_name.'</span> &nbsp;</div>';
					}
				}
			}
		
			$reminder_staffs_json = json_decode($json_info[$i]->reminder_staffs_json);
			
			if($json_info[$i]->reminder_staffs_json != "[{}]")
			{
			
				for($k=0; $k<sizeof($reminder_staffs_json); $k++)
				{
					if($reminder_staffs_json[$k]->staff_id != "")
					{
					$participats_staffs .= '<div class="need_hover guessing_item shadow_sm"> <img src="'.$reminder_staffs_json[$k]->staff_image.'" width="50px"/> <span class="badge badge-secondary">'.$reminder_staffs_json[$k]->staff_id.'</span><span class=""> '.$reminder_staffs_json[$k]->staff_first_name.' '.$reminder_staffs_json[$k]->staff_last_name.'</span> &nbsp;</div>';
					}
				}
			}
			
			$reminder_doctors_json = json_decode($json_info[$i]->reminder_doctors_json);
			
			if($json_info[$i]->reminder_doctors_json != '[{}]')
			{
				//echo $reminder_doctors_json;
				for($k=0; $k<sizeof($reminder_doctors_json); $k++)
				{
					if($reminder_doctors_json[$k]->doctor_id != "")
					{
					$participats_doctors .= '<div class="need_hover guessing_item shadow_sm"> <img src="'.$reminder_doctors_json[$k]->doctor_image.'" width="50px"/> <span class="badge badge-secondary">'.$reminder_doctors_json[$k]->doctor_id.'</span> <span class="">'.$reminder_doctors_json[$k]->doctor_first_name.'</span> &nbsp;</div>';
					}
				}
			
			}
			
			
			$reminder_services_json = json_decode($json_info[$i]->reminder_services_json);
		
			if($json_info[$i]->reminder_services_json != "[{}]")
			{
			
				for($k=0; $k<sizeof($reminder_services_json); $k++)
				{
					if($reminder_services_json[$k]->service_code != "")
					{
					$participats_services .= '<div class="need_hover guessing_item shadow_sm"> <span class="">'.$reminder_services_json[$k]->service_code.' - '.$reminder_services_json[$k]->service_type.'</span>&nbsp;</div>';
					}
					
				}
			}

			//echo "Reminder id : ".$json_info[$i]->reminder_staffs_json;
		}
		
		
		$outp = '<div class="accordian">

					  <div class="card">
						<div class="card-header">
						  <a class="card-link" data-toggle="collapse" href="#collapseOne">
							General Information
						  </a>
						</div>
						<div id="collapseOne" class="collapse show" data-parent="#accordion">
						  <div class="card-body">'.$reminder_general_info.'</div>
						</div>
					  </div>
					
					  <div class="card">
						<div class="card-header">
						  <a class="collapsed card-link" data-toggle="collapse" href="#collapseTwo">
							Participants patients
						  </a>
						</div>
						<div id="collapseTwo" class="collapse" data-parent="#accordion">
							 <div class="card-body">'.$participats_patients.'</div>
						</div>
					  </div>
					
					  <div class="card">
						<div class="card-header">
						  <a class="collapsed card-link" data-toggle="collapse" href="#collapseThree">
							Participants staffs
						  </a>
						</div>
						<div id="collapseThree" class="collapse" data-parent="#accordion">
						  <div class="card-body">
							'.$participats_staffs.'
						  </div>
						</div>
					  </div>
					  
					  <div class="card">
						<div class="card-header">
						  <a class="collapsed card-link" data-toggle="collapse" href="#collapseFour">
							Participants doctors
						  </a>
						</div>
						<div id="collapseFour" class="collapse" data-parent="#accordion">
						  <div class="card-body">
							'.$participats_doctors.'
						  </div>
						</div>
					  </div>
					  
					  <div class="card">
						<div class="card-header">
						  <a class="collapsed card-link" data-toggle="collapse" href="#collapseFive">
							Participants Services
						  </a>
						</div>
						<div id="collapseFive" class="collapse" data-parent="#accordion">
						  <div class="card-body">
							'.$participats_services.'
						  </div>
						</div>
					  </div>
					
					</div>';
					
					echo $outp;
					
	
	}
	
	public function view()
	{
		extract($_POST);
				
		//$reminder_start_date = date();
		
		if(!isset($_SESSION[$this->config->item("sess_cookie_name")]["today"]))
		{
			$today = date('Y-m-d');
			$_SESSION[$this->config->item("sess_cookie_name")]["today"] = $today;
		}
		else
		{
			$today = $_SESSION[$this->config->item("sess_cookie_name")]["today"];
		}
		
		if($navigation == 'forward')
		{
			$today = date('Y-m-d',strtotime("+1 month",strtotime($today)));
		}
		else if($navigation == 'backward')
		{
			$today = date('Y-m-d',strtotime("-1 month",strtotime($today)));
		}
		else if($navigation == 'today')
		{
			$today = date('Y-m-d');
		}
		
		$_SESSION[$this->config->item("sess_cookie_name")]["today"] = $today;

		//echo $today;
		
		$today = strtotime($today);
		$year = date('Y',$today);
		$day = date('d',$today);
		$month = date('m',$today);
		$month_name = date('F',$today);
		
		//echo $year."-".$day."-".$month;
		
		$request =  $this->config->item("rest_server_url");
		$request .= "index.php/api/reminders/reminders/view";
		$request .= "?";
		
		$request .= "app_api_username=".$_SESSION[$this->config->item("sess_cookie_name")]["app_api_username"];
		$request .= "&";
		
		$request .= "staff_username=".$_SESSION[$this->config->item("sess_cookie_name")]["staff_username"];
		$request .= "&";
		
		$request .= "staff_token=".$_SESSION[$this->config->item("sess_cookie_name")]["staff_token"];
		$request .= "&";
		
		$request .= "req_year=".urlencode($year);
		$request .= "&";
		
		$request .= "req_month=".urlencode($month);
		$request .= "&";
		
		$request .= "req_day=".urlencode($day);
		$request .= "&";
			
		
		$request = $request;
		//echo $request;
		$json_calendar = file_get_contents($request);
		//echo $json_calendar;
		
		if($view_mode == 'month')
		{
			$daysArr = array('Mon','Tue','Wed','Thu','Fri','Sat','Sun');
			$monthtotdays=cal_days_in_month(CAL_GREGORIAN,$month,$year);
			$currdays=jddayofweek(cal_to_jd(CAL_GREGORIAN,$month,1,$year),2);
			$currdaysval = 0;
			$outp = '<div class="text-center"><span class="fa fa-calendar-alt">&nbsp;</span>'.$month_name.' '.$year.'</div>';
			//$outp = $monthtotdays." ".$currdays;
			
			$outp .= "<table align='center' class='table table-condenced table-bordered table-striped'>";
			$outp .= "<tr class='btn-light'>";
			
			for($d=0;$d<=6;$d++)
			{
				$outp .= "<th width='200px'>".$daysArr[$d]."</td>";
				if($daysArr[$d]==$currdays) 
				 {
				   $currdaysval = $d;
				 }
			}
			$outp .= "</tr>";
			$outp .= "<tr>";
			if($currdaysval > 0 ){
			$outp .= '<td colspan="'.$currdaysval.'"></td>';
			}
			for($i=1;$i<=$monthtotdays;$i++){
			
			$temp_date = date('Y-m-d',strtotime($year."-".$month."-".$i));
			$weekday = date('w',strtotime($year."-".$month."-".$i));
			$this_month = date('m',strtotime($year."-".$month."-".$i));
			$this_day = date('d',strtotime($year."-".$month."-".$i));
			$this_year = date('Y',strtotime($year."-".$month."-".$i));
			$outp .= "<td>".$i."".$this->get_event_in_this_date($json_calendar,$temp_date,$weekday,$this_month,$this_day,$this_year)."</td>";
			if(($i+$currdaysval )%7 <= 0 )
			{
			$outp .= "</tr><tr>";
			}
			}
			
			$outp .= "</tr></table>";
			echo $outp;
		}
		else if($view_mode == 'list')
		{
			
			$outp = "";
			$outp = '<div class="text-center"><span class="fa fa-calendar-alt">&nbsp;</span>'.$month_name.' '.$year.'</div>';
			$outp .= '<table class="table table-condenced table-bordered table-striped">';
			$outp .= '<thead class="btn-light">';
			$outp .= '<tr><th width="230px">Date/Time</th><th>Subject</th><th>Type</th><th>Organizer</th></tr>';
			$outp .= '</thead>';
			$outp .= '<tbody class="small-txt">';
			if($json_calendar != "")
			{
				$json_calendar_array = json_decode($json_calendar);
				for($i=0; $i < sizeof($json_calendar_array); $i++)
				{
					
				$reminder_repeat = $json_calendar_array[$i]->reminder_repeat;
				if($reminder_repeat == 'No')
				{
					$reminder_repeat = 'Regular';
				}
				
				$outp .= '<tr class="need_hover" onclick=show_reminder_info("'.$json_calendar_array[$i]->reminder_id.'")><td><span class="fa fa-calendar"></span> '.$json_calendar_array[$i]->reminder_start_date.' <span class="fa fa-clock"></span> '.$json_calendar_array[$i]->reminder_start_time.'</td><td> '.$json_calendar_array[$i]->reminder_type.'</td><td> '.$reminder_repeat.'</td><td> '.ucfirst($json_calendar_array[$i]->reminder_calendar).'</td></tr>';
				}
			}
			else
			{
				$outp .= '<tr class="need_hover"><td colspan="2"><span class="fa fa-info-circle"></span> No more event in this month</td></tr>';
			}
				$outp .= '<tbody>';
				$outp .= '</tbody>';
				$outp .= '</table>';
			
			
			echo $outp;
			
		}
	}
	
	public function edit()
	{
		extract($_POST);
		
		$request =  $this->config->item("rest_server_url");
		$request .= "index.php/api/reminders/reminders/edit";
		$request .= "?";
		
		$request .= "app_api_username=".$_SESSION[$this->config->item("sess_cookie_name")]["app_api_username"];
		$request .= "&";
		
		$request .= "staff_username=".$_SESSION[$this->config->item("sess_cookie_name")]["staff_username"];
		$request .= "&";
		
		$request .= "staff_token=".$_SESSION[$this->config->item("sess_cookie_name")]["staff_token"];	
		$request .= "&";
		
		$request .= "req_reminder_id=".$req_reminder_id;
				
		$request = $request;
		
		$response = file_get_contents($request);
		echo $response;
	}
	
	public function getDatesFromRange($start, $end, $format = 'Y-m-d') 
	{
		$array = array();
		$interval = new DateInterval('P1D');
	
		$realEnd = new DateTime($end);
		$realEnd->add($interval);
	
		$period = new DatePeriod(new DateTime($start), $interval, $realEnd);
		
		
		foreach($period as $date) { 
			$array[] = $date->format($format); 
		}
	
		return $array;
    }
	
	private function get_event_in_this_date($json_calendar,$day,$weekday,$this_month,$this_day,$this_year)
	{
		$event = "";
		if($json_calendar != "")
		{
	
		$json_calendar_array = json_decode($json_calendar);
		for($i=0; $i < sizeof($json_calendar_array); $i++)
		{		
			//echo $json_calendar_array[$i]->reminder_repeat;
			//secho $json_calendar_array[$i]->reminder_repeat;
				
				if($json_calendar_array[$i]->reminder_repeat == 'No')
				{
					$period = $this->getDatesFromRange($json_calendar_array[$i]->reminder_start_date, $json_calendar_array[$i]->reminder_end_date);
					
					if(in_array($day,$period))
					{
						$event .= '<br><div title="'.$json_calendar_array[$i]->reminder_type.'" style="font-size:0.8em" class="need_hover badge badge-primary" onclick=show_reminder_info("'.$json_calendar_array[$i]->reminder_id.'") style=""><span class="fa fa-clock"> </span> '.$json_calendar_array[$i]->reminder_start_time.'-'.substr($json_calendar_array[$i]->reminder_type,0,5).'</div>';
						
					}
				}
				else if($json_calendar_array[$i]->reminder_repeat == 'Daily')
				{
										
					$period_1 = $this->getDatesFromRange($json_calendar_array[$i]->reminder_limit_from_date, $json_calendar_array[$i]->reminder_limit_to_date);
					
					if(in_array($day,$period_1))
					{
						$event .= '<br><div title="'.$json_calendar_array[$i]->reminder_type.'" style="font-size:0.8em" class="need_hover badge badge-secondary" onclick=show_reminder_info("'.$json_calendar_array[$i]->reminder_id.'") style=""><span class="fa fa-clock"> </span> '.$json_calendar_array[$i]->reminder_start_time.'-'.substr($json_calendar_array[$i]->reminder_type,0,5).'</div>';
							
					}
				}
				else if($json_calendar_array[$i]->reminder_repeat == 'Weekly')
				{
					
					$period_1 = $this->getDatesFromRange($json_calendar_array[$i]->reminder_limit_from_date, $json_calendar_array[$i]->reminder_limit_to_date);
					
					
					$repeat_weeks[] = explode(",",$json_calendar_array[$i]->repeat_weeks);
					
					//echo sizeof($period_1);
														
								if(in_array($weekday,$repeat_weeks[0]))
								{									
								
									if(in_array($day,$period_1))
									{
										//echo $value."<br>";
										$event .= '<br><div title="'.$json_calendar_array[$i]->reminder_type.'" style="font-size:0.8em" class="need_hover badge badge-success" onclick=show_reminder_info("'.$json_calendar_array[$i]->reminder_id.'") style=""><span class="fa fa-clock"> </span> '.$json_calendar_array[$i]->reminder_start_time.'-'.substr($json_calendar_array[$i]->reminder_type,0,5).'</div>';
								
									}
								}
				}
				/*
				else if($json_calendar_array[$i]->reminder_repeat == 'Weekly')
				{
					
					$period_1 = $this->getDatesFromRange($json_calendar_array[$i]->reminder_limit_from_date, $json_calendar_array[$i]->reminder_limit_to_date);
					
					
					$repeat_weeks[] = explode(",",$json_calendar_array[$i]->repeat_weeks);
					
					//echo sizeof($period_1);
														
								if(in_array($weekday,$repeat_weeks[0]))
								{									
								
									if(in_array($day,$period_1))
									{
										//echo $value."<br>";
										$event .= '<br><div style="font-size:0.8em" class="need_hover badge badge-danger" onclick=show_reminder_info("'.$json_calendar_array[$i]->reminder_id.'") style=""><span class="fa fa-clock"> </span> '.$json_calendar_array[$i]->reminder_start_time.'-'.$json_calendar_array[$i]->reminder_type.'</div>';
								
									}
								}
				}*/
				else if($json_calendar_array[$i]->reminder_repeat == 'Monthly')
				{
					
					$period_1 = $this->getDatesFromRange($json_calendar_array[$i]->reminder_limit_from_date, $json_calendar_array[$i]->reminder_limit_to_date);
					
					
					$repeat_months[] = explode(",",$json_calendar_array[$i]->repeat_months);
					
					//echo sizeof($period_1);
								
								if(in_array($this_month,$repeat_months[0]))
								{
									if(in_array($day,$period_1))
									{	
									
									$period_2 = $this->getDatesFromRange($json_calendar_array[$i]->reminder_start_date, $json_calendar_array[$i]->reminder_end_date);
									
									foreach($period_2 as $value)
									{
										$test_day = date('d',strtotime($value));
										if($test_day == $this_day)
										{
											$event .= '<br><div title="'.$json_calendar_array[$i]->reminder_type.'" style="font-size:0.8em" class="need_hover badge badge-warning" onclick=show_reminder_info("'.$json_calendar_array[$i]->reminder_id.'") style=""><span class="fa fa-clock"> </span> '.$json_calendar_array[$i]->reminder_start_time.'-'.substr($json_calendar_array[$i]->reminder_type,0,5).'</div>';
											
										}
									}
											
												
											
									}
								}
								/*				
										//echo $value."<br>";
										$event .= '<br><div style="font-size:0.8em" class="need_hover badge badge-secondary" onclick=show_reminder_info("'.$json_calendar_array[$i]->reminder_id.'") style=""><span class="fa fa-clock"> </span> '.$json_calendar_array[$i]->reminder_start_time.'-'.$json_calendar_array[$i]->reminder_type.'</div>';
								
									}
								}*/
				}
				else if($json_calendar_array[$i]->reminder_repeat == 'Yearly')
				{
					
					$period_1 = $this->getDatesFromRange($json_calendar_array[$i]->reminder_limit_from_date, $json_calendar_array[$i]->reminder_limit_to_date);
					
					$repeat_years[] = explode(",",$json_calendar_array[$i]->repeat_years);
					
					//echo sizeof($period_1);
								
								if(in_array($this_year,$repeat_years[0]))
								{
									if(in_array($day,$period_1))
									{	
																		
									$period_2 = $this->getDatesFromRange($json_calendar_array[$i]->reminder_start_date, $json_calendar_array[$i]->reminder_end_date);
									
									foreach($period_2 as $value)
									{
										$test_day = date('d',strtotime($value));
										$test_month = date('m',strtotime($value));
										if($test_month == $this_month)
										{
											if($test_day == $this_day)
											{
												$event .= '<br><div title="'.$json_calendar_array[$i]->reminder_type.'" style="font-size:0.8em" class="need_hover badge badge-dark" onclick=show_reminder_info("'.$json_calendar_array[$i]->reminder_id.'") style=""><span class="fa fa-clock"> </span> '.$json_calendar_array[$i]->reminder_start_time.'-'.substr($json_calendar_array[$i]->reminder_type,0,5).'</div>';
												
											}
										}
									}											
												
											
									}
								}
								/*				
																	
									
										//echo $value."<br>";
										$event .= '<br><div style="font-size:0.8em" class="need_hover badge badge-secondary" onclick=show_reminder_info("'.$json_calendar_array[$i]->reminder_id.'") style=""><span class="fa fa-clock"> </span> '.$json_calendar_array[$i]->reminder_start_time.'-'.$json_calendar_array[$i]->reminder_type.'</div>';
								
									}
								}*/
				}
			
		}
		}
		
		return $event;
	}
	
	
	
	public function intake_patient()
	{
		extract($_POST);
		
		$request =  $this->config->item("rest_server_url");
		$request .= "index.php/api/patients/patients/patient_intake";
		$request .= "?";
		
		$request .= "app_api_username=".$_SESSION[$this->config->item("sess_cookie_name")]["app_api_username"];
		$request .= "&";
		
		$request .= "staff_username=".$_SESSION[$this->config->item("sess_cookie_name")]["staff_username"];
		$request .= "&";
		
		$request .= "staff_token=".$_SESSION[$this->config->item("sess_cookie_name")]["staff_token"];	
		$request .= "&";
		
		$request .= "req_auto_id_0=".$req_auto_id_0;
		$request .= "&";
		
		$request .= "req_patient_intake_date=".$req_patient_intake_date;
				
		$request = $request;
		
		$response = file_get_contents($request);
		echo $response;
	}
	
	public function patient_more_info()
	{
		extract($_POST);
		
		$request =  $this->config->item("rest_server_url");
		$request .= "index.php/api/patients/patients/patient_more_info";
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
	
	public function check_incoming_patients()
	{
		extract($_POST);
		
		$request =  $this->config->item("rest_server_url");
		$request .= "index.php/api/patients/patients/check_incoming_patients";
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

	public function check_valid_username()
	{
		extract($_POST);
		
		$request =  $this->config->item("rest_server_url");
		$request .= "index.php/api/staffs/staffs/check_valid_username";
		$request .= "?";
		$request .= "app_api_username=".$_SESSION[$this->config->item("sess_cookie_name")]["app_api_username"];
		$request .= "&";
		$request .= "staff_username=".$_SESSION[$this->config->item("sess_cookie_name")]["staff_username"];
		$request .= "&";
		$request .= "staff_token=".$_SESSION[$this->config->item("sess_cookie_name")]["staff_token"];
		$request .= "&";
		$request .= "req_new_staff_username=".$req_new_staff_username;
		
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
		$request .= "index.php/api/reminders/reminders/delete";
		$request .= "?";
		
		$request .= "app_api_username=".$_SESSION[$this->config->item("sess_cookie_name")]["app_api_username"];
		$request .= "&";
		
		$request .= "staff_username=".$_SESSION[$this->config->item("sess_cookie_name")]["staff_username"];
		$request .= "&";
		
		$request .= "staff_token=".$_SESSION[$this->config->item("sess_cookie_name")]["staff_token"];	
		$request .= "&";
		
		$request .= "req_reminder_id=".$req_reminder_id;	
		
		$request = $request;
		
		$response = file_get_contents($request);
		echo $response;
	}
	
	public function add_new()
	{
		extract($_POST);
	
		$request =  $this->config->item("rest_server_url");
		$request .= "index.php/api/reminders/reminders/add_new";
		$request .= "?";
		
		$request .= "app_api_username=".$_SESSION[$this->config->item("sess_cookie_name")]["app_api_username"];
		$request .= "&";
		
		$request .= "staff_username=".$_SESSION[$this->config->item("sess_cookie_name")]["staff_username"];
		$request .= "&";
		
		$request .= "staff_token=".$_SESSION[$this->config->item("sess_cookie_name")]["staff_token"];
		$request .= "&";
		
		$request .= "req_reminder_calendar=".urlencode($req_reminder_calendar);
		$request .= "&";
		
		$request .= "req_reminder_type=".urlencode($req_reminder_type);
		$request .= "&";
		
		$request .= "req_reminder_start_date=".urlencode($req_reminder_start_date);
		$request .= "&";
		
		$request .= "req_reminder_start_time=".urlencode($req_reminder_start_time);
		$request .= "&";
		
		$request .= "req_reminder_end_date=".urlencode($req_reminder_end_date);
		$request .= "&";
		
		$request .= "req_reminder_end_time=".urlencode($req_reminder_end_time);
		$request .= "&";
		
		$request .= "req_reminder_repeat=".urlencode($req_reminder_repeat);
		$request .= "&";
		
		$request .= "req_reminder_event_type=".urlencode($req_reminder_event_type);
		$request .= "&";
		
		$request .= "req_reminder_limit_from_date=".urlencode($req_reminder_limit_from_date);
		$request .= "&";
		
		$request .= "req_reminder_limit_to_date=".urlencode($req_reminder_limit_to_date);
		$request .= "&";

		
		if(isset($req_repeat_weeks))
		{
			$request .= "req_repeat_weeks=".urlencode(implode(",",$req_repeat_weeks));
			$request .= "&";
		}
		else
		{
			$request .= "req_repeat_weeks=".urlencode(" ");
			$request .= "&";
		}
		
		$request .= "req_repeat_months=".urlencode($req_repeat_months);
		$request .= "&";
		
		$request .= "req_repeat_years=".urlencode($req_repeat_years);
		$request .= "&";	
	
		$request .= "req_reminder_patients_json=".urlencode($req_reminder_patients_json);
		$request .= "&";
		
		$request .= "req_reminder_staffs_json=".urlencode($req_reminder_staffs_json);
		$request .= "&";
		
		$request .= "req_reminder_doctors_json=".urlencode($req_reminder_doctors_json);
		$request .= "&";
		
		$request .= "req_reminder_services_json=".urlencode($req_reminder_services_json);
		$request .= "&";
		
		$request .= "req_reminder_location=".urlencode($req_reminder_location);
		$request .= "&";
		
		$request .= "req_reminder_desc_alert=".urlencode($req_reminder_desc_alert);
	
		$request = $request;
		
		$response = file_get_contents($request);
		echo $response;
	}
	
	
	public function update()
	{
		extract($_POST);
		
		$request =  $this->config->item("rest_server_url");
		$request .= "index.php/api/reminders/reminders/update";
		$request .= "?";
		
		$request .= "app_api_username=".$_SESSION[$this->config->item("sess_cookie_name")]["app_api_username"];
		$request .= "&";
		
		$request .= "staff_username=".$_SESSION[$this->config->item("sess_cookie_name")]["staff_username"];
		$request .= "&";
		
		$request .= "staff_token=".$_SESSION[$this->config->item("sess_cookie_name")]["staff_token"];
		$request .= "&";
		
		$request .= "req_reminder_id=".urlencode($req_reminder_id);
		$request .= "&";
		
		$request .= "req_reminder_calendar=".urlencode($req_reminder_calendar);
		$request .= "&";
		
		$request .= "req_reminder_type=".urlencode($req_reminder_type);
		$request .= "&";
		
		$request .= "req_reminder_start_date=".urlencode($req_reminder_start_date);
		$request .= "&";
		
		$request .= "req_reminder_start_time=".urlencode($req_reminder_start_time);
		$request .= "&";
		
		$request .= "req_reminder_end_date=".urlencode($req_reminder_end_date);
		$request .= "&";
		
		$request .= "req_reminder_end_time=".urlencode($req_reminder_end_time);
		$request .= "&";
		
		$request .= "req_reminder_repeat=".urlencode($req_reminder_repeat);
		$request .= "&";
		
		$request .= "req_reminder_event_type=".urlencode($req_reminder_event_type);
		$request .= "&";
		
		$request .= "req_reminder_limit_from_date=".urlencode($req_reminder_limit_from_date);
		$request .= "&";
		
		$request .= "req_reminder_limit_to_date=".urlencode($req_reminder_limit_to_date);
		$request .= "&";

		
		if(isset($req_repeat_weeks))
		{
			$request .= "req_repeat_weeks=".urlencode(implode(",",$req_repeat_weeks));
			$request .= "&";
		}
		else
		{
			$request .= "req_repeat_weeks=".urlencode(" ");
			$request .= "&";
		}
		
		$request .= "req_repeat_months=".urlencode($req_repeat_months);
		$request .= "&";
		
		$request .= "req_repeat_years=".urlencode($req_repeat_years);
		$request .= "&";	
	
		$request .= "req_reminder_patients_json=".urlencode($req_reminder_patients_json);
		$request .= "&";
		
		$request .= "req_reminder_staffs_json=".urlencode($req_reminder_staffs_json);
		$request .= "&";
		
		$request .= "req_reminder_doctors_json=".urlencode($req_reminder_doctors_json);
		$request .= "&";
		
		$request .= "req_reminder_services_json=".urlencode($req_reminder_services_json);
		$request .= "&";
		
		$request .= "req_reminder_location=".urlencode($req_reminder_location);
		$request .= "&";
		
		$request .= "req_reminder_desc_alert=".urlencode($req_reminder_desc_alert);
	
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
