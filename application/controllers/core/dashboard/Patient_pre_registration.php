<?php
defined('BASEPATH') OR exit('No direct script access allowed');
ob_start();
class Patient_pre_registration extends CI_Controller {

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
		$this->Functions->check_basic_authentication($_SESSION[$this->config->item("sess_cookie_name")]["staff_username"],"patients","");	
    }
	 	
	public function index()
	{
		$data['page_title'] = 'Staffs';
		$data['rights'] = $this->Functions->get_staff_task_permission($_SESSION[$this->config->item("sess_cookie_name")]["staff_username"],"staffs");
		$this->load->view('common/header',$data);
		$this->load->view('common/common_script',$data);
		$this->load->view('common/top_bar',$data);	
		if($this->Functions->get_staff_task_permission($_SESSION[$this->config->item("sess_cookie_name")]["staff_username"],"patients") == 'full')
		{
			$this->load->view('dashboard/configurations/referral_source/referral_source');
		}
		$this->load->view('dashboard/patient_pre_registration/patient_pre_registration');
		$this->load->view('common/footer');
	} 
	
	public function get_staff_role()
	{
		extract($_POST);
		
		$request =  $this->config->item("rest_server_url");
		$request .= "index.php/api/configurations/staff_role/get_staff_role";
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
	
	public function quick_pre_register()
	{
		extract($_POST);
		
		$request =  $this->config->item("rest_server_url");
		$request .= "index.php/api/patients/patients/quick_pre_register";
		$request .= "?";
		
		$request .= "app_api_username=".$_SESSION[$this->config->item("sess_cookie_name")]["app_api_username"];
		$request .= "&";
		
		$request .= "staff_username=".$_SESSION[$this->config->item("sess_cookie_name")]["staff_username"];
		$request .= "&";
		
		$request .= "staff_token=".$_SESSION[$this->config->item("sess_cookie_name")]["staff_token"];	
		$request .= "&";
		
		$request .= "req_patient_ref_source_name=".urlencode($req_patient_ref_source_name);	
		$request .= "&";
		
		$request .= "req_patient_ref_person=".urlencode($req_patient_ref_person);	
		$request .= "&";
		
		$request .= "req_patient_first_name=".urlencode($req_patient_first_name);	
		$request .= "&";
		
		$request .= "req_patient_mobile_no=".urlencode($req_patient_mobile_no);	
		$request .= "&";
		
		$request .= "req_patient_email_id=".urlencode($req_patient_email_id);	
		$request .= "&";
		
		$request .= "req_patient_desc=".urlencode($req_patient_desc);
		
		$request = $request;
		
		$response = file_get_contents($request);
		echo $response;
	}
	
	public function patient_full_register()
	{
		/*
		INSERT INTO `patient_info_table` (`auto_id_0`, ``, ``, `patient_id`, `patient_image`, ``, ``, ``, ``, ``, ``, ``, ``, `created_at`, `created_by`, `app_api_username`, ``, ``, ``, ``, ``, ``, ``, ``, ``, ``, ``, ``, ``, ``, ``, ``, ``, ``, ``, ``, ``, ``, ``, ``) VALUES (NULL, '', '', '', 'default.png', '', '', '', '', '', '', 'incoming', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '')*/
		
		extract($_POST);
		
		$request =  $this->config->item("rest_server_url");
		$request .= "index.php/api/patients/patients/patient_full_register";
		$request .= "?";
		
		$request .= "app_api_username=".$_SESSION[$this->config->item("sess_cookie_name")]["app_api_username"];
		$request .= "&";
		
		$request .= "staff_username=".$_SESSION[$this->config->item("sess_cookie_name")]["staff_username"];
		$request .= "&";
		
		$request .= "staff_token=".$_SESSION[$this->config->item("sess_cookie_name")]["staff_token"];	
		$request .= "&";
		
		$request .= "req_patient_ref_source_name=".urlencode($req_patient_ref_source_name);	
		$request .= "&";
		
		$request .= "req_patient_ref_person=".urlencode($req_patient_ref_person);	
		$request .= "&";
		
		$request .= "req_patient_other_ref=".urlencode($req_patient_other_ref);	
		$request .= "&";
		
		$request .= "req_patient_first_name=".urlencode($req_patient_first_name);	
		$request .= "&";
		
		$request .= "req_patient_middle_name=".urlencode($req_patient_middle_name);	
		$request .= "&";
		
		$request .= "req_patient_last_name=".urlencode($req_patient_last_name);	
		$request .= "&";
		
		$request .= "req_patient_mobile_no=".urlencode($req_patient_mobile_no);	
		$request .= "&";
		
		$request .= "req_patient_email_id=".urlencode($req_patient_email_id);	
		$request .= "&";
		
		$request .= "req_patient_desc=".urlencode($req_patient_desc);	
		$request .= "&";
				
		$request .= "req_patient_gender=".urlencode($req_patient_gender);	
		$request .= "&";
		
		$request .= "req_patient_dob=".urlencode($req_patient_dob);	
		$request .= "&";
		
		$request .= "req_patient_address=".urlencode($req_patient_address);	
		$request .= "&";
		
		$request .= "req_patient_city=".urlencode($req_patient_city);	
		$request .= "&";
		
		$request .= "req_patient_state=".urlencode($req_patient_state);	
		$request .= "&";
		
		$request .= "req_patient_zip=".urlencode($req_patient_zip);	
		$request .= "&";
		
		$request .= "req_patient_case_worker=".urlencode($req_patient_case_worker);	
		$request .= "&";
		
		$request .= "req_patient_supervisor=".urlencode($req_patient_supervisor);	
		$request .= "&";
		
		$request .= "req_patient_marital_status=".urlencode($req_patient_marital_status);	
		$request .= "&";
		
		$request .= "req_patient_telephone_no=".urlencode($req_patient_telephone_no);	
		$request .= "&";
		
		$request .= "req_patient_date_of_referral=".urlencode($req_patient_date_of_referral);	
		$request .= "&";
		
		$request .= "req_patient_referral_county=".urlencode($req_patient_referral_county);	
		$request .= "&";
		
		$request .= "req_patient_is_psychiatric_hosp=".urlencode($req_patient_is_psychiatric_hosp);	
		$request .= "&";
		
		$request .= "req_patient_exp_psychiatric_hosp=".urlencode($req_patient_exp_psychiatric_hosp);	
		$request .= "&";
		
		$request .= "req_patient_drug_use_history=".urlencode($req_patient_drug_use_history);	
		$request .= "&";
		
		$request .= "req_patient_reason_for_referral=".urlencode($req_patient_reason_for_referral);	
		$request .= "&";
		
		$request .= "req_patient_diagnosis=".urlencode($req_patient_diagnosis);	
		$request .= "&";
		
		$request .= "req_patient_level_of_care=".urlencode($req_patient_level_of_care);	
		$request .= "&";
		
		$request .= "req_patient_recommended_program=".urlencode($req_patient_recommended_program);	
		$request .= "&";
		
		$request .= "req_patient_is_employ=".urlencode($req_patient_is_employ);	
		$request .= "&";
		
		$request .= "req_patient_hipaa=".urlencode($req_patient_hipaa);	
		$request .= "&";
		
		$request .= "req_patient_pcp_release=".urlencode($req_patient_pcp_release);	
		$request .= "&";
		
		$request .= "req_patient_langauage=".urlencode($req_patient_langauage);	
		
		$response = file_get_contents($request);
		echo $response;
	}
	
	public function delete()
	{
		extract($_POST);
		
		$request =  $this->config->item("rest_server_url");
		$request .= "index.php/api/configurations/staff_role/delete";
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
	
	
}
