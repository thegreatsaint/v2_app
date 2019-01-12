<?php
defined('BASEPATH') OR exit('No direct script access allowed');
ob_start();
class Drugtest extends CI_Controller {

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
		$this->Functions->check_basic_authentication($_SESSION[$this->config->item("sess_cookie_name")]["staff_username"],"drugtest","");	
		date_default_timezone_set($this->config->item("time_zone"));	
    }
	 	
	public function index()
	{
		$data['date'] = date('m/d/Y');
		$data['time'] = date('h:i A');
		
		$data['page_title'] = 'Drugtest';
		$data['rights'] = $this->Functions->get_staff_task_permission($_SESSION[$this->config->item("sess_cookie_name")]["staff_username"],"drugtest");
		$this->load->view('common/header',$data);
		$this->load->view('common/common_script',$data);
		$this->load->view('common/top_bar',$data);
		$this->load->view('dashboard/drugtest/drugtest');
		if($this->Functions->get_staff_task_permission($_SESSION[$this->config->item("sess_cookie_name")]["staff_username"],"drugtest") == 'full')
		{
			$this->load->view('dashboard/configurations/services');
			$this->load->view('dashboard/configurations/service_type');
		}
		$this->load->view('common/footer');
	}
	
	public function print_drugtest()
	{
		extract($_REQUEST);
		
		$request =  $this->config->item("rest_server_url");
		$request .= "index.php/api/drugtest/drugtest/print_drugtest";
		$request .= "?";
		
		$request .= "app_api_username=".urlencode($_SESSION[$this->config->item("sess_cookie_name")]["app_api_username"]);
		$request .= "&";
		
		$request .= "staff_username=".urlencode($_SESSION[$this->config->item("sess_cookie_name")]["staff_username"]);
		$request .= "&";
		
		$request .= "staff_token=".urlencode($_SESSION[$this->config->item("sess_cookie_name")]["staff_token"]);
		$request .= "&";
		
		$request .= "req_patient_id=".urlencode($req_patient_id);	
		
		$request = $request;
		
		$response = file_get_contents($request);
		//echo $response;
		
		$json_data = json_decode($response);
		$drugtest_patient = $json_data[0]->drugtest_patient;
		
		$outp = '<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
				  <style>
					tr:odd
					{
						background-color:#eee;
						border:solid 1px #333;
					}
					td
					{
						font-size:0.8em;
					}
					body
					{
						padding:5px;
					}
				  </style>';
		
		$outp .= '<div class="heading1" style="text-align:center; color:#333; font-size:1.2em;">DRUGTEST RESULTS</div>';
		
		$outp .= '<table width="100%">
					<tr>
						<td>
							Patient info: <br>
							<b>'.$drugtest_patient.'</b>
						</td>
					</tr>
				</table>';
				
		$outp .= '<table class="table-bordered table-hover table-striped" width="100%" style="border:solid 1px #333">
						<thead style="background-color:#eee">
							<tr>
								<th>
									Date
								</th>
								<th>
									Drugtest type
								</th>
								<th>
									Result
								</th>
								<th>
									Notes
								</th>
							</tr>
						</thead>
					<tbody>';
	
		for($k=0; $k<sizeof($json_data); $k++)
		{
			$outp .= '<tr>
							<td>'.$json_data[$k]->drugtest_date.'</td>
							<td>'.$json_data[$k]->drugtest_type.'</td>
							<td>'.$json_data[$k]->drugtest_result.'</td>
							<td>'.$json_data[$k]->drugtest_notes.'</td>
					  </tr>';
			/*
			$auto_id_0 = $json_data[$k]->auto_id_0;
			$drugtest_date = $json_data[$k]->drugtest_date;
			$drugtest_patient = $json_data[$k]->drugtest_patient;
			$drugtest_staff = $json_data[$k]->drugtest_staff;
			$drugtest_type = $json_data[$k]->drugtest_type;
			$drugtest_result = $json_data[$k]->drugtest_result;
			$drugtest_notes = $json_data[$k]->drugtest_notes;
			$drugtest_attachments = $json_data[$k]->drugtest_attachments;
			$created_by = $json_data[$k]->created_by;
			$created_at = $json_data[$k]->created_at;
			$patient_info = $json_data[$k]->patient_info;*/
		}
		
		$outp .= '</tbody></table>';
		echo $outp;				
	}
	
	public function delete()
	{
		extract($_POST);
		
		$request =  $this->config->item("rest_server_url");
		$request .= "index.php/api/drugtest/drugtest/delete";
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
	
	public function drugtest_graph()
	{
		extract($_POST);
		
		$request =  $this->config->item("rest_server_url");
		$request .= "index.php/api/drugtest/drugtest/drugtest_graph";
		$request .= "?";
		
		$request .= "app_api_username=".urlencode($_SESSION[$this->config->item("sess_cookie_name")]["app_api_username"]);
		$request .= "&";
		
		$request .= "staff_username=".urlencode($_SESSION[$this->config->item("sess_cookie_name")]["staff_username"]);
		$request .= "&";
		
		$request .= "staff_token=".urlencode($_SESSION[$this->config->item("sess_cookie_name")]["staff_token"]);
		$request .= "&";
		
		$request .= "req_patient_id=".urlencode($req_patient_id);	
		
		$request = $request;
		
		$response = file_get_contents($request);
		echo $response;
	}
	
	public function view()
	{
		extract($_POST);
		
		$request =  $this->config->item("rest_server_url");
		$request .= "index.php/api/drugtest/drugtest/view";
		$request .= "?";
		
		$request .= "app_api_username=".urlencode($_SESSION[$this->config->item("sess_cookie_name")]["app_api_username"]);
		$request .= "&";
		
		$request .= "staff_username=".urlencode($_SESSION[$this->config->item("sess_cookie_name")]["staff_username"]);
		$request .= "&";
		
		$request .= "staff_token=".urlencode($_SESSION[$this->config->item("sess_cookie_name")]["staff_token"]);
		$request .= "&";
		
		$request .= "req_search_key_word=".urlencode($req_search_key_word);
		$request .= "&";
		
		$request .="req_view_limit=".urlencode($req_view_limit);
		$request .= "&";
		
		$request .="req_search_date=".urlencode($req_search_date);
		$request .= "&";
	
		$request = $request;
		
		$response = file_get_contents($request);
		echo $response;
	}
	
	
	public function add_new()
	{
		extract($_REQUEST);
		
		$ch = curl_init();
		
		if($_FILES['req_drugtest_attachements']["name"] != "")
		{
			$filePath = $_FILES['req_drugtest_attachements']['tmp_name'];
			$type=strtolower($_FILES['req_drugtest_attachements']['type']);
			$fileName = $_FILES['req_drugtest_attachements']['name'];
			
			$data = array(
			
						"app_api_username" => $_SESSION[$this->config->item("sess_cookie_name")]["app_api_username"],
						"staff_username" => $_SESSION[$this->config->item("sess_cookie_name")]["staff_username"],		
						"staff_token" => $_SESSION[$this->config->item("sess_cookie_name")]["staff_token"],
						"req_drugtest_date" => $req_drugtest_date,
						"req_drugtest_patient" => $req_drugtest_patient,
						"req_drugtest_staff" => $req_drugtest_staff,
						"req_drugtest_type" => $req_drugtest_type,
						"req_drugtest_result" => $req_drugtest_result,
						"req_drugtest_notes" => $req_drugtest_notes,
						"req_drugtest_attachements" => curl_file_create($filePath,$type,$fileName)
				
				);
						
			curl_setopt($ch, CURLOPT_URL, $this->config->item("rest_server_url").'index.php/api/drugtest/drugtest/add_new');
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
			$response = curl_exec($ch);
			curl_close($ch);
			echo $response;
		}
		else
		{
			$data = array(
			
						"app_api_username" => $_SESSION[$this->config->item("sess_cookie_name")]["app_api_username"],
						"staff_username" => $_SESSION[$this->config->item("sess_cookie_name")]["staff_username"],		
						"staff_token" => $_SESSION[$this->config->item("sess_cookie_name")]["staff_token"],
						"req_drugtest_date" => $req_drugtest_date,
						"req_drugtest_patient" => $req_drugtest_patient,
						"req_drugtest_staff" => $req_drugtest_staff,
						"req_drugtest_type" => $req_drugtest_type,
						"req_drugtest_result" => $req_drugtest_result,
						"req_drugtest_notes" => $req_drugtest_notes
				
				);
						
			curl_setopt($ch, CURLOPT_URL, $this->config->item("rest_server_url").'index.php/api/drugtest/drugtest/add_new');
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
			$response = curl_exec($ch);
			curl_close($ch);
			echo $response;
			
		}
		
		/*
		extract($_POST);
		
		$request =  $this->config->item("rest_server_url");
		$request .= "index.php/api/drugtest/drugtest/add_new";
		$request .= "?";
		
		$request .= "app_api_username=".$_SESSION[$this->config->item("sess_cookie_name")]["app_api_username"];
		$request .= "&";
		
		$request .= "staff_username=".$_SESSION[$this->config->item("sess_cookie_name")]["staff_username"];
		$request .= "&";
		
		$request .= "staff_token=".$_SESSION[$this->config->item("sess_cookie_name")]["staff_token"];	
		$request .= "&";
		
		$request .= "req_drugtest_date=".urlencode($req_drugtest_date);
		$request .= "&";
		
		$request .= "req_drugtest_patient=".urlencode($req_drugtest_patient);
		$request .= "&";
		
		$request .= "req_drugtest_staff=".urlencode($req_drugtest_staff);
		$request .= "&";
		
		$request .= "req_drugtest_type=".urlencode($req_drugtest_type);
		$request .= "&";
		
		$request .= "req_drugtest_result=".urlencode($req_drugtest_result);
		$request .= "&";
		
		$request .= "req_drugtest_notes=".urlencode($req_drugtest_notes);
		$request .= "&";
		
		$request = $request;
	
		$response = file_get_contents($request);
		echo $response;
		*/
	
	}
}
