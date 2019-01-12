<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!--front_desk--icons-->
<h1 class="first_gap">&nbsp;</h1>

<section class="wow fadeIn" data-wow-duration="1s" data-wow-delay="2s">
<!--breadcrumps-->
<div class="row content_div_1">
	<div class="col-lg-1">
    </div>
    <div class="col-lg-11">
    	<div class="breadcrumps_section">
        	<div class="topic_bar">
            	<div class="btn btn-default need_hover">
                	<span class="hist_go_previous fa fa-arrow-left" title="Go previous"></span>
                </div>
                <div class="btn btn-default need_hover">
                	<span class="hist_go_next fa fa-arrow-right" title="Go next"></span>
                </div>
                <div class="btn btn-default need_hover">
                	<span>
                    	<a href="<?php echo $this->config->item("base_url");?>index.php/dashboard/front_desk" class="text_light">
                    	<img src="<?php echo $this->config->item("rest_server_url");?>assets/images/icons/front_desk.png" width="40px" /><span class="font-weight-bold">&nbsp;Front desk
                        </a>
                    </span>
                </div>
                <span class="fa fa-chevron-right"></span>
                <div class="btn btn-default need_hover">
                	<span>
                    	<img src="<?php echo $this->config->item("rest_server_url");?>assets/images/icons/patients.png" width="40px" /><span class="font-weight-bold">&nbsp;<?php echo $page_title;?>
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>
<!--breadcrumps-->

<div class="row content_div_1 entry_section">
    <div class="col-lg-2">
    	<div id="view">
        	 <div class="alert shadow-sm">
             	<p align="center">
                	<img src="<?php echo $this->config->item("rest_server_url");?>assets/images/icons/patients.png" width="100px"/>
                </p>
               
                <div class="btn btn-light btn-block" onclick="add_new_modal()">
                	<span class="fa fa-plus-circle">&nbsp;</span>Add new
                </div>
             </div>       	
        </div>
    </div>
    <div class="col-lg-9">
    	<div id="view">
        	<div class="alert shadow-sm">
            	<div class="row">
                	<div class="col-sm-4" style="">
            			<div class="input-group mb-3">
                          <input id="txt_search_key_word" type="text" class="form-control" placeholder="Search" aria-label="Search" aria-describedby="button-addon2">
                          <div class="input-group-append">
                            <button class="btn btn-outline-secondary" onclick="view()" type="button" id="button-addon2">
                            	<span class="fa fa-search"></span>
                            </button>
                          </div>
                        </div>
                	</div>
                    
                </div>
            </div>
        	<div class="alert shadow-sm view_table">
            	<!--
            	<table class="table shadow-sm table-hover table-striped">
                	<thead>
                    	<tr>
                        	<th colspan="2">
                            	Staffs
                            </th>
                           
                        </tr>
                    </thead>
                    
                    <tbody>
                    	<tr>
                        	<td width="110px" align="left" valign="middle">
                            	<img src="'+$arr[$i].app_api_company_logo+'" class="img-fluid" />
                            </td>
                            <td align="left" valign="middle">
                            	
                            	<div class="font-weight-bold">'+$arr[$i].app_api_username+'</div>
                                <div class="font-weight-light">Project Manager</div>
                                <div class="tasks">
                                    <span class="btn btn-light fa fa-user" title="Profile">
                                    </span>
                                    <span class="btn btn-light fa fa-edit" title="Edit">
                                    </span>
                                    <span class="btn btn-light fa fa-trash" title="Delete">
                                    </span>
                                </div>
                                
                            </td>
                        </tr>
                        
                        <tr>
                        	<td width="110px" align="left" valign="middle">
                            	<img src="<?php echo $this->config->item("rest_server_url");?>assets/images/icons/staffs.png" class="img-fluid" />
                            </td>
                            <td align="left" valign="middle">
                            	
                            	<div class="font-weight-bold">1001 | Karthikeyan</div>
                                <div class="font-weight-light">Project Manager</div>
                                <div class="tasks">
                                    <span class="btn btn-light fa fa-user" title="Profile">
                                    </span>
                                    <span class="btn btn-light fa fa-edit" title="Edit">
                                    </span>
                                    <span class="btn btn-light fa fa-trash" title="Delete">
                                    </span>
                                </div>
                                
                            </td>
                        </tr>
                    </tbody>
                </table>
                -->
            </div>      	
        </div>
    </div>
</div>

<style>
	.icon_btns
	{
		display:block;
	}
	.slidedown_btn
	{
		display:none;
	}
</style>


<script>
	$(document).ready(
	function()
	{
		//onload functions---
		view();
		//onload functions--		
	});
	
	function patient_more_info($auto_id_0)
	{
		$.post($("#hid_base_url").val()+"index.php/core/dashboard/patients/patient_more_info",
		{
			req_auto_id_0:$auto_id_0
		},
		function(data)
		{
			//alert(data);
			$("#patient_more_info_modal").modal(
				{
					backdrop:"static",
					keypress:false
				}
			);
			
				try
				{
					data = data.trim();
					$arr = JSON.parse(data);
					
					if($arr[0].patient_status == 'Incoming')
					{
						$(".btn_pre_registered").fadeIn();
					}
					else
					{
						$(".btn_pre_registered").hide();
					}
					
					
					
					$outp = '<div class="row"><div class="col-lg-6"><p class="label2">Patient first name</p><p class="label1">'+$arr[0].patient_first_name+'</p><p class="label2">Patient middle name</p><p class="label1">'+$arr[0].patient_middle_name+'</p><p class="label2">Patient last name</p><p class="label1">'+$arr[0].patient_last_name+'</p><p class="label2">Patient mobile no</p><p class="label1">'+$arr[0].patient_mobile_no+'</p></div><div class="col-lg-6"><p class="label2">Patient email id</p><p class="label1">'+$arr[0].patient_email_id+'</p><p class="label2">Patient status</p><p class="label1">'+$arr[0].patient_status+'</p><p class="label2">Patient description</p><p class="label1">'+$arr[0].patient_desc+'</p></div></div>';
					$(".hid_patient_auto_id_0").val($arr[0].auto_id_0);
					$(".patient_image").attr("src",$arr[0].patient_image);
					$(".disp_patient_id").html('<span class="label2"><span class="fa fa-tag">&nbsp;</span>Patient ID</span></span><br><span class="label1">'+$arr[0].patient_id+"</span>");
					$("#txt_intake_patient_id").val($arr[0].patient_id);
					$(".disp_patient_full_name").html('<span class="label2"><span class="fa fa-user">&nbsp;</span>Patient full name</span><br><span class="label1 text-uppercase">'+$arr[0].patient_first_name+" "+$arr[0].patient_middle_name+" "+$arr[0].patient_last_name+"</span></span>");
					$(".disp_patient_status").html('<span class="label2"><span class="fa fa-tachometer-alt">&nbsp;</span>Patient status</span><br><span class="label1">'+$arr[0].patient_status+"</span>");
					$(".disp_patient_referral_source").html('<span class="label2"><span class="fa fa-user-circle">&nbsp;</span>Referral source</span><br><span class="label1">'+$arr[0].patient_ref_source_name+"</span>");
					$(".disp_patient_referral_person").html('<span class="label2"><span class="fa fa-users">&nbsp;</span>Referral person</span><br><span class="label1">'+$arr[0].patient_ref_person+"</span>");
					$(".disp_patient_telephone_no").html('<a href="tel:'+$arr[0].patient_mobile_no+'"><span class="label2"><span class="fa fa-mobile">&nbsp;</span>Mobile phone</span><br><span class="label1">'+$arr[0].patient_mobile_no+'</span></a>');	
					$(".disp_patient_email_id").html('<span class="label2"><span class="fa fa-envelope">&nbsp;</span>Email ID</span><br><span class="label1">'+$arr[0].patient_email_id+"</span>");
					
				}
				catch(err)
				{
					alert("EXCEPTION:"+err.message);
				}
				
			
			
		});
	};
	
	function view()
	{
			//alert("ok");
			//alert($("#txt_search_key_word").val());
			open_loader();
			$.post($("#hid_base_url").val()+"index.php/core/dashboard/patients/view",
			{
				search_key_word:$("#txt_search_key_word").val()
			},
			function(data)
			{
				close_loader();
				//$("body").append(data);
				try
				{
					
					//alert(data);
					data = data.trim();
					$arr = JSON.parse(data);
					
					$outp='<table class="table shadow-sm table-hover table-striped"> <thead> <tr> <th colspan="2">Patients list</th> </tr></thead> <tbody>';
					
					for($i=0; $i<$arr.length; $i++)
					{	
						<?php
	if($this->Functions->get_staff_task_permission($_SESSION[$this->config->item("sess_cookie_name")]["staff_username"],"patients") == "full")
						{
						?>
						
						$outp=$outp + '<tr id="patients_table_row_'+$arr[$i].auto_id_0+'"> <td width="110px" align="left" valign="middle"> <img src="'+$arr[$i].patient_image+'" class="img-fluid"/> </td><td align="left" valign="middle"><div class="label2">'+$arr[$i].patient_id+'</div> <div class="font-weight-bold">'+$arr[$i].patient_first_name+' '+$arr[$i].patient_middle_name+' '+$arr[$i].patient_last_name+'</div></td><br><td align="left" valign="left"><div class="round_btn fa fa-tasks" title="Tasks" onclick=$("#icon_btns_'+$arr[$i].auto_id_0+'").slideToggle("fast")></div><br><span id="icon_btns_'+$arr[$i].auto_id_0+'" class="slidedown_btn"><span class="icon_btns fa fa-user" title="Profile" style="background: linear-gradient(to top, #87CEEB 50%, #4682B4 50%);" onclick="patient_more_info('+$arr[$i].auto_id_0+')" title="Client account"></span><span onclick="delete()" class="icon_btns fa fa-trash" title="Delete" style="background:linear-gradient(to top, #663399 50%,#4B0082 50%);"></span></span></td></tr>';
						<?php
						}
						?>
						
						<?php
	if($this->Functions->get_staff_task_permission($_SESSION[$this->config->item("sess_cookie_name")]["staff_username"],"patients") == "write")
						{
						?>
						
						$outp=$outp + '<tr id="patients_table_row_'+$arr[$i].auto_id_0+'"> <td width="110px" align="left" valign="middle"> <img src="'+$arr[$i].patient_image+'" class="img-fluid"/> </td><td align="left" valign="middle"> <div class="font-weight-bold">'+$arr[$i].patient_first_name+' '+$arr[$i].patient_middle_name+' '+$arr[$i].patient_last_name+'</div><div class="tasks"> <span class="round_btn fa fa-user" onclick="patient_more_info('+$arr[$i].auto_id_0+')" title="Client account"> </span> <span class="round_btn fa fa-edit" onclick="edit('+$arr[$i].auto_id_0+')" title="Edit"> </span></div></td></tr>';
						
						<?php
						}
						?>
						
						
						<?php
	if($this->Functions->get_staff_task_permission($_SESSION[$this->config->item("sess_cookie_name")]["staff_username"],"patients") == "read")
						{
						?>
						
						$outp=$outp + '<tr id="patients_table_row_'+$arr[$i].auto_id_0+'"> <td width="110px" align="left" valign="middle"> <img src="'+$arr[$i].patient_image+'" class="img-fluid"/> </td><td align="left" valign="middle"> <div class="font-weight-bold">'+$arr[$i].patient_first_name+' '+$arr[$i].patient_middle_name+' '+$arr[$i].patient_last_name+'</div><div class="tasks"><span class="round_btn fa fa-user" onclick="patient_more_info('+$arr[$i].auto_id_0+')" title="Client account"> </span></div></td></tr>';
						
						<?php
						}
						?>
					}
						$outp = $outp + '</tbody></table>';
						
						$(".view_table").html($outp);
				}
				catch(err)
				{
					alert("EXCEPTION:"+err.message);
				}
			});
	}
	
	
	function add_new_modal()
	{
		$("#add_new_modal").modal(
			{
				"backdrop":"static",
				"keypressed":false
			}
		);
	}
	
	function open_intake_patients()
	{
		//alert("ok");
		///$("#patient_more_info_modal").modal("hide");
		$("#intake_patient_modal").modal(
			{
				backdrop:"static",
				keypress:false
			}
		);
	}
	
	function intake_patient()
	{
		if($("#hid_intake_patient_auto_id_0").val() == "")
		{
			toastr.error("Patient auto id does not assign");
		}
		else if($("#txt_intake_patient_intake_date").val() == "")
		{
			toastr.error("Patient Intake date is empty");
		}
		else
		{
				$.post($("#hid_base_url").val()+"index.php/core/dashboard/patients/intake_patient",
				{
					req_auto_id_0 : $("#hid_intake_patient_auto_id_0").val(),
					req_patient_intake_date : $("#txt_intake_patient_intake_date").val()
				},
				function(data)
				{
					try
					{
								data = data.trim();
								$arr = JSON.parse(data);
								if($arr.result == true)
								{
									toastr.success($arr.msg);
									
									view();
									patient_more_info($("#hid_intake_patient_auto_id_0").val());
									$("#intake_patient_modal").modal("hide");
									//window.location.replace($("#hid_base_url").val()+"index.php/dashboard/front_desk");
								}
								else 
								{
									toastr.error($arr.msg);
								}
								
					}
					catch(err)
					{
						alert("EXCEPTION : "+err.message);
					}
				});
		}
	}
	
</script>
</section>

<div class="modal fade modal-child" data-backdrop-limit="1" id="intake_patient_modal" style="z-index:1500;" backdrop="static" keypressed="false" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Intake patient</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
     	<div class="row">
        	<div class="col-lg-1">
            </div>
            <div class="col-lg-10">
            
            	<p class="label2 disp_patient_id need_hover"></p>
            	<p class="label1 disp_patient_full_name need_hover text-uppercase"><span class="fa fa-user">&nbsp;</span></p>
              	<p class="label2">Intake date</p>
                <input type="hidden" id="hid_intake_patient_auto_id_0" class="hid_patient_auto_id_0" />
                <input type="text" id="txt_intake_patient_intake_date" value="<?php echo date('m/d/Y');?>"; class="form-control need_datepicker number_input" placeholder="m/d/yyyy" maxlength="10" />
               
                <div class="btn btn-light btn-block" onclick="intake_patient()">
                	<span class="fa fa-check">&nbsp;</span>Intake
                </div>
            </div>
            <div class="col-lg-1">
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-light" data-dismiss="modal"><span class="fa fa-times">&nbsp;</span>Cancel</button>
      </div>
    </div>
  </div>
</div>



<!--patient account--->
<div class="modal fade" data-backdrop-limit="1" id="patient_more_info_modal" backdrop="static" keypressed="false" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" style="max-width:1250px" role="document">
    <div class="modal-content col-lg-12">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Patient account</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      	<div class="general_info">
        	<div class="row">
            	<div class="col-lg-2 text-center">
                	<div>
                	<img src="" class="img-thumbnail img-fluid patient_image"/>  
                    </div>
                    <div class="btn btn-link" title="Edit"><span class="fa fa-edit"></span></div>
                    <div class="btn btn-link" title="Remove"><span class="fa fa-trash"></span></div> 
                    <div class="btn btn-light btn-block btn_pre_registered" onclick="open_intake_patients()">
                        	<span class="fa fa-hand-point-right">&nbsp;</span>Click to Intake
                    </div>        	
                </div>
                <div class="col-lg-4">
                	<div class="patient_info">
                    	<p class="disp_patient_id"></p>
                    	<p class="disp_patient_full_name"><span class="fa fa-user">&nbsp;</span></p>
                        <p class="disp_patient_status"><span class="fa fa-dashboard">&nbsp;</span></p>
                        <p class="disp_patient_referral_source"><span class="fa fa-user-circle">&nbsp;</span></p>
                        
                    </div>
                </div>
                <div class="col-lg-4">
                	 	<p class="disp_patient_referral_person"><span class="fa fa-users">&nbsp;</span></p>
                       	<p class="label2 disp_patient_telephone_no need_hover"><span class="fa fa-phone">&nbsp;</span></p>
                        <p class="label2 disp_patient_email_id need_hover"><span class="fa fa-envelope">&nbsp;</span></p>
                        
                        <p class="label2 need_hover">&nbsp;</p>
                        
                        <div title="Send SMS" class="need_hover btn round_btn" style="border-radius: 50%; top: 80px; right: 5px;"><span class="fa fa-comment"></span></div>
                        <div title="Send Email" class="need_hover btn round_btn" style="border-radius: 50%; top: 80px; right: 5px;"><span class="fa fa-envelope"></span></div>
                        <div title="Send Chat" class="need_hover btn round_btn" style="border-radius: 50%; top: 80px; right: 5px;"><span class="fa fa-comments"></span></div>
                       
                </div>
            </div>
        </div>
        <hr />
      	
        
        <div class="container mt-3">
          <!-- Nav tabs -->
          <ul class="nav nav-tabs">
            <li class="nav-item">
              <a class="active btn btn-light" data-toggle="tab" href="#general">General</a>
            </li>
            <li class="nav-item">
              <a class="btn btn-light" data-toggle="tab" href="#schedules">Schedules</a>
            </li>
            <li class="nav-item">
              <a class="btn btn-light" data-toggle="tab" href="#programs">Programs</a>
            </li>
          </ul>

          <!-- Tab panes -->
          <div class="tab-content">
            <div id="general" class="container tab-pane active"><br>
            	
            </div>
            <div id="schedules" class="container tab-pane fade"><br>
            </div>
            <div id="programs" class="container tab-pane fade"><br>
            </div>
          </div>
         </div>
        
        <!--
        <div class="menu_section">
        	<div class="btn btn-light">
            	General
            </div>
            <div class="btn btn-light">
            	Doctors
            </div>
            <div class="btn btn-light">
            	Drugtest
            </div>
            <div class="btn btn-light">
            	Session
            </div>
            <div class="btn btn-light">
            	Treatment
            </div>
            <div class="btn btn-light">
            	History
            </div>
            <div class="btn btn-light">
            	Documents
            </div>
            <div class="btn btn-light">
            	Events and programs
            </div>
            <div class="btn btn-light">
            	Bills
            </div>
            <div class="btn btn-light">
            	Insurance
            </div>
            <div class="btn btn-light">
            	Diagnosis journals
            </div>
        </div>
        -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-light" data-dismiss="modal"><span class="fa fa-times">&nbsp;</span>Cancel</button>
      </div>
    </div>
  </div>
</div>
<!--patient account-->