<?php
if(!isset($_SESSION[$this->config->item("sess_cookie_name")]))
{
	header("location:".$this->config->item("base_url"));
}
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?php echo $this->config->item("rest_server_url");?>assets/bootstrap/bootstrap_4.css" crossorigin="anonymous">

    <title><?php echo strtoupper(trim($page_title));?> | <?php echo strtoupper(trim($this->config->item("company_name")));?></title>
    <link rel="shortcut icon" href="<?php echo $this->config->item("rest_server_url");?>assets/images/site_images/favicon.png"/>
    <link rel="icon" href="<?php echo $this->config->item("rest_server_url");?>assets/images/site_images/favicon.png"/>
           
    <!--javascript-->
    <script src="<?php echo $this->config->item("rest_server_url");?>assets/jquery/jquery-2.1.4.min.js"></script>
    
    <!--autocomplete--->
    <script async src="<?php echo $this->config->item("rest_server_url");?>assets/autocomplete/EasyAutocomplete-1.3.5/jquery.easy-autocomplete.js" type="text/javascript"></script>
    
    <!--popper-->
    <script src="<?php echo $this->config->item("rest_server_url");?>assets/bootstrap/popper.js"></script>
    
    <!--bootstrap-->
    <script src="<?php echo $this->config->item("rest_server_url");?>assets/bootstrap/bootstrap_4.js"></script>
    
    <!--wow--animation-->
    <link rel="stylesheet" href="<?php echo $this->config->item("rest_server_url");?>assets/wow/animate.css"/>
    <script type="text/javascript" src="<?php echo $this->config->item("rest_server_url");?>assets/wow/wow.min.js"></script>
    
    <!--font--awesome-->
    <link rel="stylesheet" href="<?php echo $this->config->item("rest_server_url");?>assets/fa/css/all.css"/>
    
    <!--autocomplete--->
    <link rel="stylesheet" href="<?php echo $this->config->item("rest_server_url");?>assets/autocomplete/EasyAutocomplete-1.3.5/easy-autocompleted.css">
  
    <!--custom css-->
    <link rel="stylesheet" href="<?php echo $this->config->item("rest_server_url");?>assets/css/<?php echo $this->config->item("custom_css_name");?>"/>
    
    <!--datepicker-->
    <script src="<?php echo $this->config->item("rest_server_url");?>assets/datepicker3/dist/js/bootstrap-datepicker.js"></script>
    <link rel="stylesheet" href="<?php echo $this->config->item("rest_server_url");?>assets/datepicker3/dist/css/bootstrap-datepicker.css">
    
    <!--toastr-->
    <script src="<?php echo $this->config->item("rest_server_url");?>assets/toaster/toastr.min.js"></script>
	<link rel="stylesheet" href="<?php echo $this->config->item("rest_server_url");?>assets/toaster/toastr.css"/>
    
    <!--common script-->
	<link rel="stylesheet" href="<?php echo $this->config->item("rest_server_url");?>assets/toaster/toastr.css"/>
    
    
    <!--time picker-->
    <script src="<?php echo $this->config->item("rest_server_url");?>assets/timepicker/mdtimepicker.min.js"></script>
	<link rel="stylesheet" href="<?php echo $this->config->item("rest_server_url");?>assets/timepicker/mdtimepicker.min.css"/>
     
    <script>
	toastr.options = 
								{
									
									  "debug": false,
									  "newestOnTop": false,
									  "progressBar": true,
									  "positionClass": "toast-top-center",
									  "preventDuplicates": true,
									  "onclick": null,
									  "showDuration": "100",
									  "hideDuration": "5000",
									  "timeOut": "3000",
									  "extendedTimeOut": "1000",
									  "showEasing": "swing",
									  "hideEasing": "linear",
									  "showMethod": "fadeIn",
									  "hideMethod": "fadeOut"
								}
	</script>
    
    
    <script>
		$(document).ready(
		function()
		{
			//scroll top function
			$('[data-toggle="popover"]').popover(); 
			
			$(".number_input").keydown(function (e) 
			{
			// Allow: backspace, delete, tab, escape, enter and .
			if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
				 // Allow: Ctrl+A, Command+A
				(e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) || 
				 // Allow: home, end, left, right, down, up
				(e.keyCode >= 35 && e.keyCode <= 40)) {
					 // let it happen, don't do anything
				return;
			}
			// Ensure that it is a number and stop the keypress
			if(e.shiftKey && e.keyCode == 187)
			{
				return;
			}
			else if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) 
			{
				//alert(e.keyCode);
				e.preventDefault();
				///return;
			}
			});
			
			
			$(".scroll_top").click(
			function() 
			{
			  $("html, body").animate({ scrollTop: 0 }, "fast");
			  return false;
			});
			
				
			$(".need_datepicker").datepicker(
			{
				dateFormat:'mm/dd/yyyy',
				todayHighlight:true
			});
			
			$(".need_monthpicker").datepicker(
			{
				format:'mm',
				startDate:'',
				startView:'month',
				minViewMode:'months',
				multidate:true
			});
			
			$(".need_yearpicker").datepicker(
			{
				format:'yyyy',
				startDate:'',
				startView:'year',
				minViewMode:'years',
				multidate:true
			});
			
			$(".need_timepicker").mdtimepicker();
			  
			//$('.credits').popover({title: "Developed by", content: "<img src='"+$("#hid_base_url").val()+"/assets/images/site_images/pr.png' width='100%'>", html: true, placement: "top", fallbackPlacement: "flip"}); 
			
			//setTimeout(redirect,5000);
			//$("#frm_login")[0].reset();
			$(".form-control").focus(
			function()
			{
				
			});
			
			
		});
		
		function redirect()
		{
			window.location.replace("login/?login");
		};
		
		
		
		
		wow = new WOW(
                    {
                      boxClass:     'wow',      // default
                      animateClass: 'animated', // default
                      offset:       0,          // default
                      mobile:       true,       // default
                      live:         true        // default
                    })
              new WOW().init();
	
	</script>
    <style>
	.content_div_1
	{
		padding:10px;
	}
	
	.modal
	{
		overflow:auto;
		overflow-x:hidden;
		background-color:#111;
	}
	.mdtp__wrapper
	{
		top:24px; !important;
		box-shadow:none;
	}
	.popover 
	{
    	z-index: 3000; /* A value higher than 1010 that solves the problem */
	}
	
	</style>
    
  </head>
  <body>
  <div id="main_div">
  <!--hidden control-->
  <input type="hidden" id="hid_base_url" value="<?php echo $this->config->item("base_url");?>"/>
  <input type="hidden" id="hid_rest_server_url" value="<?php echo $this->config->item("rest_server_url");?>"/>
  <input type="hidden" id="hid_req_api_key" value="<?php echo $this->config->item("req_api_key");?>"/>
  <input type="hidden" id="hid_today_date" value="<?php echo date('m/d/Y');?>"/>
  
  		
  
  