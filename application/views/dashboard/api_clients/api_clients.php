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
                    	<img src="<?php echo $this->config->item("rest_server_url");?>assets/images/icons/api_clients.png" width="40px" /><span class="font-weight-bold">&nbsp;<?php echo $page_title;?>
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
                	<img src="<?php echo $this->config->item("rest_server_url");?>assets/images/icons/api_clients.png" width="100px"/>
                </p>
                <?php
					if(($rights == "full") || ($rights == "write"))
					{
				?>
                <div class="btn btn-light btn-block" onclick="add_new_modal()">
                	<span class="fa fa-plus-circle">&nbsp;</span>Add new
                </div>
                <?php
					}
				?>
             </div>       	
        </div>
    </div>
    <div class="col-lg-9">
    	<div id="view">
        	<div class="alert shadow-sm">
            	<div class="row">
                	<div class="col-sm-4" style="">
            			<div class="input-group mb-3">
                          <input id="txt_app_api_search" onchange="view()" type="text" class="form-control" placeholder="Search" aria-label="Search" aria-describedby="button-addon2">
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

<script>
	$(document).ready(
	function()
	{
		//onload functions---
		view();
		//onload functions---
		
		
		$("#api_client_entry_form").submit(
		function(e)
		{		
		 	try
			 {
				 var url = "";
				 if($("#hid_form_mode").val() == "insert")
				 {
					 url = $("#hid_base_url").val()+"index.php/core/dashboard/api_clients/add_new";
				 }
				 else if($("#hid_form_mode").val() == "edit")
				 {
					 url = $("#hid_base_url").val()+"index.php/core/dashboard/api_clients/update";
				 }
				 
				 alert(url);
				 
				 e.preventDefault();
				 $.ajax(
				 {
					url: url,
					type: "POST",
					data:  new FormData(this),
					contentType: false,
					cache: false,
					processData: false,
					beforeSend : function()
					{
						//alert("ok");
					},
					success: function(data)
					{
						try
						{
							alert(data);
							data = data.trim();
							$arr = JSON.parse(data);
							if($arr.result == true)
							{
								$("#api_client_entry_form")[0].reset();
								$("#add_new_modal").modal("hide");
								toastr.success($arr.msg);
								//window.location.replace($("#hid_base_url").val()+"index.php/dashboard/front_desk");
							}
							else 
							{
								toastr.error($arr.msg);
							}
							
							view();
							
						}
						catch(ex)
						{
							alert("EXCEPTION "+ex.message);
						}
					},
					error: function(e) 
					{
						alert(e.status);
					}          
				  });
			 }
			 catch(err)
			 {
				 alert(err.message);
			 }
		});
		
	});
	
	function assign_api_key()
	{
		$.post($("#hid_base_url").val()+"index.php/core/dashboard/api_clients/assign_api_key",
		{
			
		},
		function(data)
		{
			//alert(data);
			$("#api_client_entry_form")[0].reset();
				try
				{
							data = data.trim();
							$arr = JSON.parse(data);
							if($arr.result == "true")
							{
								$("#txt_app_api_key").val($arr.app_api_key);
								toastr.info($arr.msg);
							}
							else
							{
								toastr.danger("Error in assigning api key");
							}
							
							
				}
				catch(err)
				{
					alert("EXCEPTION : "+err.message);
				}
		});
	}
	
	function edit($auto_id_0)
	{
		$.post($("#hid_base_url").val()+"index.php/core/dashboard/api_clients/edit",
		{
			auto_id_0:$auto_id_0
		},
		function(data)
		{
				try
				{
							data = data.trim();
							$arr = JSON.parse(data);
							
								$("#hid_api_req_auto_id_0").val($arr[0].auto_id_0);
								$("#txt_app_api_key").val($arr[0].app_api_key);
								$("#txt_app_api_key").attr("readonly","true");
								$("#txt_app_api_username").val($arr[0].app_api_username);
								$("#txt_app_api_username").attr("readonly","true");
								$("#txt_app_api_password").val($arr[0].app_api_password);
								$("#hid_app_api_password").val($arr[0].app_api_password);
								$("#txt_app_api_reenter_password").val($arr[0].app_api_password);
								$("#txt_app_api_company").val($arr[0].app_api_company_name);
								$("#txt_app_api_company_phone").val($arr[0].app_api_company_phone);
								$("#txt_app_api_company_address").val($arr[0].app_api_company_address);
								$("#txt_app_api_company_desc").val($arr[0].app_api_company_desc);
								
								$("#txt_app_api_staff_id_prefix").val($arr[0].app_api_staff_id_prefix);
								$("#txt_app_api_referral_id_prefix").val($arr[0].app_api_referral_id_prefix);
								$("#txt_app_api_patient_id_prefix").val($arr[0].app_api_patient_id_prefix);
								$("#txt_app_api_doctor_id_prefix").val($arr[0].app_api_doctor_id_prefix);
								
								toastr.info("Ready to edit information");
								$("#hid_form_mode").val("edit");
								
								$("#add_new_modal").modal(
															{
																"backdrop":"static",
																"keypressed":false
															}
														 );
				}
				catch(err)
				{
					alert("EXCEPTION : "+err.message);
				}
		});
	}
	
	function remove($auto_id_0)
	{
		if(window.confirm("Are you sure to delete that record?"))
		{
			$.post($("#hid_base_url").val()+"index.php/core/dashboard/api_clients/remove",
			{
				auto_id_0:$auto_id_0
			},
			function(data)
			{
				try
				{
							data = data.trim();
							$arr = JSON.parse(data);
							if($arr.result == true)
							{
								$("#table_row_"+$auto_id_0).fadeOut(1000);
								$("#table_row_"+$auto_id_0).addClass("bg-danger");
								toastr.success($arr.msg);
								//window.location.replace($("#hid_base_url").val()+"index.php/dashboard/front_desk");
							}
							else 
							{
								toastr.error($arr.msg);
							}
							
							setTimeout(view,1000);
				}
				catch(err)
				{
					alert("EXCEPTION : "+err.message);
				}
			});
		}
	}

	function view()
	{
			$.post($("#hid_base_url").val()+"index.php/core/dashboard/api_clients/view",
			{
				search_key_word:$("#txt_app_api_search").val()
			},
			function(data)
			{
				try
				{
					data = data.trim();
					$outp="";
					if(data != "")
					{
						$arr = JSON.parse(data);
						
						$outp='<table class="table shadow-sm table-hover table-striped"> <thead> <tr> <th colspan="2"> API Clients list </th> </tr></thead> <tbody>';
						
						for($i=0; $i<$arr.length; $i++)
						{						
							$outp=$outp + '<tr id="table_row_'+$arr[$i].auto_id_0+'"> <td width="110px" align="left" valign="middle"> <img src="'+$arr[$i].app_api_company_logo+'" class="img-fluid"/> </td><td align="left" valign="middle"> <div class="font-weight-bold">'+$arr[$i].app_api_username+'</div><div class="font-weight-light">API key : '+$arr[$i].app_api_key+'</div><div class="font-weight-light">API password : '+$arr[$i].app_api_password+'</div><div class="font-weight-light">API Company : '+$arr[$i].app_api_company_name+'</div><div class="font-weight-light">API Company Phone : '+$arr[$i].app_api_company_phone+'</div><div class="font-weight-light">API Company Address : '+$arr[$i].app_api_company_address+'</div>';
							
							<?php 
							if(($rights == 'full'))
							{
							?>
							$outp=$outp + ' <td align="left"><div class="icon_btn"><br><div class="round_btn fa fa-tasks" onclick=$(".icon_btns").slideToggle("fast")></div><br><span class="icon_btns fa fa-user" title="Profile" style="background:linear-gradient(to top, #87CEEB 50%, #4682B4 50%);"></span><br><span class="icon_btns fa fa-edit" onclick="edit('+$arr[$i].auto_id_0+')" title="Edit" style="background:linear-gradient(to top, #0000CD 50%,#000080 50%);"></span><br><span onclick="remove('+$arr[$i].auto_id_0+')" class="icon_btns fa fa-trash" title="Delete"style="background:linear-gradient(to top, #663399 50%,#4B0082 50%);"></span></div></td>';
							<?php
							}
							else if(($rights == 'write'))
							{
							?>
							$outp=$outp + '<div class="tasks"> <span class="round_btn fa fa-user" title="Profile"> </span> <span class="round_btn fa fa-edit" onclick="edit('+$arr[$i].auto_id_0+')" title="Edit"></span> </span> </div>';
							<?php
							}
							?>
							
							$outp=$outp + '</td></tr>';
						}
						
						$outp = $outp + '</tbody></table>';
						$(".view_table").html($outp);
					}
					else
					{
						$(".view_table").html($outp);
					}
				}
				catch(err)
				{
					alert("EXCEPTION:"+err.message+" "+data);
					$(".view_table").html(data);
				}
				
				
			});
	}
	
	function add_new_modal()
	{
		assign_api_key();
		$("#hid_form_mode").val("insert");
		$("#add_new_modal").modal(
			{
				"backdrop":"static",
				"keypressed":false
			}
		);
	}
	
	function check_valid_username()
	{
		$username = $("#txt_app_api_username").val().toLowerCase().trim();
		if($username != "")
		{	
			$.post($("#hid_base_url").val()+"index.php/core/dashboard/api_clients/check_valid_username",
			{
				new_app_api_username:$username
			},
			function(data)
			{
				try
				{
					data = data.trim();
					$arr = JSON.parse(data);
					if($arr.result == true)
					{
						toastr.info($arr.msg_desc);
						return true;
					}
					else
					{
						toastr.error($arr.msg_desc);
						$("#txt_app_api_username").focus();
						return false;
					}
				}
				catch(err)
				{
					alert("EXCEPTION:"+err.message);
				}
			})
		}
	}
	
	function check_password_validation()
	{
		$password = $("#txt_app_api_password").val();
		$reenter_password = $("#txt_app_api_reenter_password").val();
		$("#hid_app_api_password").val("");
		if(($password != "") && ($reenter_password != ""))
		{
			//alert("hi");
			if(($password.length < 8) || ($password.length > 16))
			{
				toastr.warning('Password is minimum 8 characters and maximum 16 character should be submit');
				//$("#txt_app_api_password").focus();
				$("#txt_app_api_password").val("");
				$("#txt_app_api_reenter_password").val("");
				return false;
			}
			else if($password != $reenter_password)
			{
				toastr.error('Password does not match');
				$("#txt_app_api_password").val("");
				$("#txt_app_api_reenter_password").val("");
				return false;
			}
			else
			{
				toastr.info('Password is accepted');
				$("#hid_app_api_password").val($reenter_password);
				return true;
			}
		}
	}
	
</script>

<!--entry-modal--->
<div class="modal fade" id="add_new_modal" backdrop="static" keypressed="false" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
    
        <h5 class="modal-title" id="exampleModalLabel">New API Client</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        
      </div>
      <div class="modal-body">
        <form id="api_client_entry_form">
          	<div class="row">
            	<div class="col-lg-1">
                </div>
            	<div class="col-lg-5 content_div_1">
                
                	<p class="label2">*App API key</p>
                    <input type="hidden" value="insert" id="hid_form_mode"/>
                    <input type="hidden" value="" id="hid_api_req_auto_id_0" name="req_auto_id_0"/>
                    <input id="txt_app_api_key" name="req_app_api_key" type="text" class="form-control" value="" required="required" readonly="readonly" />
                    <div id="msg_for_txt_app_api_key" class="inline_msg label3 text-danger"></div>
                    <p class="label2">*App API Username</p>
                    <input id="txt_app_api_username" name="req_app_api_username" onblur="check_valid_username()" maxlength="30" type="text" class="form-control text-lowercase" required="required"/>
                    <div id="msg_for_txt_app_api_username" class="inline_msg label3 text-danger"></div>
                    <p class="label2">*App API Password</p>
                    <input id="txt_app_api_password" maxlength="16" onblur="check_password_validation()" onchange="check_password_validation()" type="password" class="form-control password_control" required="required" />
                    <div class="small-txt need_hover" onclick=show_hide_password() title="show/hide password"><span class="fa fa-eye">&nbsp;</span>show/hide password</div>
                    <div id="msg_for_txt_app_api_password" class="inline_msg label3 text-danger"></div>
                    <p class="label2">*App API Reenter Password</p>
                    <input id="txt_app_api_reenter_password" maxlength="16" onblur="check_password_validation()" onchange="check_password_validation()" type="password" class="form-control password_control" required="required" />
                    <input id="hid_app_api_password" name="req_app_api_password" type="hidden" required="required"/>
                    <div id="msg_for_txt_app_api_reenter_password" class="inline_msg label3 text-danger"></div>
                    <p class="label2">*App Company name</p>
                    <input id="txt_app_api_company" name="req_app_api_company" type="text" class="form-control text-capitalize" required="required" />
                    <p class="label2">*App Company Phone</p>
                    <input id="txt_app_api_company_phone" name="req_app_api_company_phone" type="text" class="form-control number_input" required="required" />
                    <p class="label2">Address</p>
                    <textarea id="txt_app_api_company_address" name="req_app_api_company_address" class="form-control"></textarea>
                    <div id="msg_for_txt_app_api_company_address" class="inline_msg label3 text-danger"></div>
                	<p class="label2">App API Company desc</p>
                    <textarea id="txt_app_api_company_desc" name="req_app_api_company_desc" class="form-control"></textarea>
                    <div id="msg_for_txt_app_api_company_desc" class="inline_msg label3 text-danger"></div>
                    
                 
                    <div id="msg_for_txt_app_company" class="inline_msg label3 text-danger"></div>
                    
                </div>
                
                <div class="col-lg-5 content_div_1">
                
                	
                    <p class="label2">*Warning</p>
                    <div class="alert alert-warning">
                        <p align="justify" class="label2">
                        <span class="fa fa-exclamation-triangle">&nbsp;</span>Prefix id is important one for create peoples for this app company. It is contains only lowercase alphanumeric (a-z and 0-9) characters, does not allow special character like space and quote('). Ex:ep_staff_
                        </p>
                    </div>
                    <p class="label2">*App Staff ID prefix</p>
                    <input id="txt_app_api_staff_id_prefix" name="req_app_api_staff_id_prefix" maxlength="30" type="text" class="form-control text-lowercase" maxlength="12" placeholder="Ex. ep_staff_" required="required"/>
                    <p class="label2">*App Referral ID prefix</p>
                    <input id="txt_app_api_referral_id_prefix" maxlength="12" name="req_app_api_referral_id_prefix" maxlength="30" type="text" class="form-control text-lowercase" placeholder="Ex. ep_referral_" required="required"/>
                    <p class="label2">*App Paitent ID prefix</p>
                    <input id="txt_app_api_patient_id_prefix" maxlength="12" name="req_app_api_patient_id_prefix" maxlength="30" type="text" class="form-control text-lowercase" placeholder="Ex. ep_patient_" required="required"/>
                    <p class="label2">*App Doctor ID prefix</p>
                    <input id="txt_app_api_doctor_id_prefix" maxlength="12" name="req_app_api_doctor_id_prefix" maxlength="30" type="text" class="form-control text-lowercase" placeholder="Ex. ep_doctor_" required="required"/>
                    <div id="msg_for_txt_app_api_company_phone" class="inline_msg label3 text-danger"></div>
                	<input type="submit" name="submit" id="btn_save_api_client" class="d-none" value="save" />
                    
                </div>
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button onclick=$("#api_client_entry_form")[0].reset() type="button" class="btn btn-light" data-dismiss="modal"><span class="fa fa-times">&nbsp;</span>Cancel</button>
        <button onclick=$("#api_client_entry_form")[0].reset() type="button" class="btn btn-light"><span class="fa fa-redo">&nbsp;</span>Reset</button>
        <button onclick=$("#btn_save_api_client").click() type="button" class="btn btn-light"><span class="fa fa-save">&nbsp;</span>Save</button>
      </div>
    </div>
  </div>
</div>
<!--entry-modal--->





</section>

<!--front_desk--icons-->