<?php
defined('BASEPATH') OR exit('No direct script access allowed');
ob_start();
class File_upload extends CI_Controller {

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
		//$this->Functions->check_basic_authentication($_SESSION[$this->config->item("sess_cookie_name")]["app_api_username"],"file_upload","");		
    }
	 	
	public function index()
	{
		$data['page_title'] = 'Staffs';
		$this->load->view('common/header',$data);
		$this->load->view('common/common_script',$data);
		$this->load->view('common/top_bar',$data);	
		$this->load->view('dashboard/sessions/sessions');
		$this->load->view('common/footer');
	} 
	
	public function file_upload()
	{
		extract($_POST);
		
		echo $_FILES['req_file_upload_for']['tmp_name'];
		
		/*		
		echo $req_real_img_height.'\n';
		echo $req_real_img_width.'\n';
		echo $req_modified_img_height.'\n';
		echo $req_modified_img_width.'\n';
		echo $req_image_file_base_64;
		*/
		/*
		$postdata = http_build_query(
			array(
				'app_api_username' => $_SESSION[$this->config->item("sess_cookie_name")]["app_api_username"],
				'staff_username' => $_SESSION[$this->config->item("sess_cookie_name")]["staff_username"],
				'staff_token' => $_SESSION[$this->config->item("sess_cookie_name")]["staff_token"],
				'req_image_file_base_64' => $req_image_file_base_64,
				'req_real_img_height' => $req_real_img_height,
				'req_real_img_width' => $req_real_img_width,
				'req_modified_img_height' => $req_modified_img_height,
				'req_modified_img_width' => $req_modified_img_width,
				'req_unique_id' => $req_unique_id,
				'req_file_upload_for' => $req_file_upload_for
			)
		);
		
		$opts = array('http' =>
			array(
				'method'  => 'POST',
				'header'  => 'Content-type: application/x-www-form-urlencoded',
				'content' => $postdata
			)
		);
		
		$context  = stream_context_create($opts);
		
		$response = file_get_contents($this->config->item("rest_server_url")."index.php/api/file_upload/file_upload", false, $context);*/
		
		
		/*
		$request =  $this->config->item("rest_server_url");
		$request .= "index.php/api/file_upload/file_upload/image_file_upload";
		$request .= "?";
		$request .= "app_api_username=".$_SESSION[$this->config->item("sess_cookie_name")]["app_api_username"];
		$request .= "&";
		$request .= "staff_username=".$_SESSION[$this->config->item("sess_cookie_name")]["staff_username"];
		$request .= "&";
		$request .= "staff_token=".$_SESSION[$this->config->item("sess_cookie_name")]["staff_token"];
		$request .= "&";
		$request .= "req_real_img_height=".urlencode($req_real_img_height);
		$request .= "&";
		$request .= "req_real_img_width=".urlencode($req_real_img_width);
		$request .= "&";
		$request .= "req_modified_img_height=".urlencode($req_modified_img_height);
		$request .= "&";
		$request .= "req_modified_img_width=".urlencode($req_modified_img_width);
		$request .= "&";
		$request .= "req_image_file_base_64=".urlencode($req_image_file_base_64);
		
		$response = file_get_contents($request);
		/*if(trim($response) != "")
		{
			if(json_decode($response)->result == true)
			{
				return json_decode($response)->app_api_key;
			}
		}*/
		
		echo $response;
	}
}
