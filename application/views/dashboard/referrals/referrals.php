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
                    	<img src="<?php echo $this->config->item("rest_server_url");?>assets/images/icons/referrals.png" width="40px" /><span class="font-weight-bold">&nbsp;<?php echo $page_title;?>
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
                	<img src="<?php echo $this->config->item("rest_server_url");?>assets/images/icons/referrals.png" width="100px"/>
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
		//get_staff_role();
		//assign_staff_id();
		//onload functions---
		
		
		$("#ref_entry_form").submit(
		function(e)
		{
			if($("#hid_form_mode").val() == "insert")
			{
				$url = $("#hid_base_url").val()+"index.php/core/dashboard/referrals/add_new";
			}
			else if($("#hid_form_mode").val() == "edit")
			{
				$url = $("#hid_base_url").val()+"index.php/core/dashboard/referrals/update";
			}
			
		 	try
			 {
				 //alert($url);
				 e.preventDefault();
				 $.ajax(
				 {
					url: $url,
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
						$("#txt_ref_address").val(data);
						try
						{
							alert(data);
							
							data = data.trim();
							$arr = JSON.parse(data);
							
							if($arr.result == true)
							{
								$("#ref_entry_form")[0].reset();
								$("#add_new_modal").modal("hide");
								toastr.success($arr.msg);
								$("#txt_ref_username").attr("readonly","false");
								
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
							alert("EXCEPTION "+ex.message+data);
						}
						
						$("#txt_staff_address").val(data);
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
	
	function get_staff_role()
	{
		$.post($("#hid_base_url").val()+"index.php/core/dashboard/staff_access/get_staff_role",
		{
			
		},
		function(data)
		{
			try
				{
					data = data.trim();
					$outp="";
					//alert(data);
					if(data != "")
					{
						$arr = JSON.parse(data);
						
						$outp='<option value="">Choose staff role</p>';
						$outp=$outp+'<option value="Add_new" class="bg-info">+Add new</p>';
						
						for($i=0; $i<$arr.length; $i++)
						{						
							$outp = $outp+'<option value="'+$arr[$i].staff_role+'">'+$arr[$i].staff_role+'</option>';
						}
						
						$("#sel_staff_role").html($outp);
					}
					else
					{
						$(".view_table").html($outp);
					}
				}
				catch(err)
				{
					alert("EXCEPTION:"+err.message+" "+data);
				}
		});
	};
	
	function staff_access($staff_role)
	{
		//alert($staff_role);
		if(window.confirm("Are you sure to redirect new page? click ok or new tab please click cancel"))
		{
			window.location.replace($("#hid_base_url").val()+"index.php/dashboard/staff_access?staff_role="+$staff_role);
		}
		else
		{
			
		}
	}
	
	function Delete($ref_id)
	{
		if(window.confirm("Are you sure to delete that record?"))
		{
			$.post($("#hid_base_url").val()+"index.php/core/dashboard/referrals/delete",
			{
				req_ref_id:$ref_id
			},
			function(data)
			{
				//alert(data);
				try
				{
							data = data.trim();
							$arr = JSON.parse(data);
							if($arr.result == true)
							{
								$("#table_row_"+$ref_id).fadeOut(1000);
								$("#table_row_"+$ref_id).addClass("bg-danger");
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
			open_loader();
			$.post($("#hid_base_url").val()+"index.php/core/dashboard/referrals/view",
			{
				search_key_word:$("#txt_search_key_word").val()
			},
			function(data)
			{
				close_loader();
				try
				{
					
					//alert(data);
					data = data.trim();
					$arr = JSON.parse(data);
					
					$outp='<table class="table shadow-sm table-hover table-striped"> <thead> <tr> <th colspan="2">Referrals list</th> </tr></thead> <tbody>';
					
					for($i=0; $i<$arr.length; $i++)
					{
						
						if($arr[$i].result == true)
						{	
						
						 <?php
							if($rights == "full")
							{
						 ?>					
						$outp=$outp + '<tr id="table_row_'+$arr[$i].ref_id+'"> <td width="110px" align="left" valign="middle"> <img src="'+$arr[$i].ref_image_src+'" class="img-fluid"/> </td><td align="left" valign="middle"> <div class="font-weight-bold">'+$arr[$i].ref_first_name+' '+$arr[$i].ref_last_name+'</div><div class="font-weight-light">Ref ID : '+$arr[$i].ref_id+'</div><div class="font-weight-light">Ref first name : '+$arr[$i].ref_first_name+'</div><div class="font-weight-light">Ref last name :  '+$arr[$i].ref_last_name+'</div><div class="font-weight-light">Ref Username : '+$arr[$i].ref_username+'</div><div class="font-weight-light">Ref Password : '+$arr[$i].ref_password+'</div></td><td align="left" valign="left"> <div class="round_btn fa fa-tasks" onclick=$("#icon_btns_'+$arr[$i].ref_id+'").slideToggle("fast")></div><br><span id="icon_btns_'+$arr[$i].ref_id+'" class="slidedown_btn"><span class="icon_btns fa fa-user" title="Profile" style="background: linear-gradient(to top, #87CEEB 50%, #4682B4 50%);"> </span><span class="icon_btns fa fa-edit" onclick="edit('+$arr[$i].ref_id+')" title="Edit" style="background:linear-gradient(to top, #0000CD 50%,#000080 50%);"> </span><span onclick="Delete('+$arr[$i].ref_id+')" class="icon_btns fa fa-trash" title="Delete" style="background:linear-gradient(to top, #663399 50%,#4B0082 50%);"> </span></span></td></tr>';
						
						<?php
							}
							else if($rights == "write")
							{
							?>
							$outp=$outp + '<tr id="table_row_'+$arr[$i].ref_id+'"> <td width="110px" align="left" valign="middle"> <img src="'+$arr[$i].ref_image_src+'" class="img-fluid"/> </td><td align="left" valign="middle"> <div class="font-weight-bold">'+$arr[$i].ref_first_name+'</div><div class="font-weight-light">Ref ID : '+$arr[$i].ref_id+'</div><div class="font-weight-light">Ref first name : '+$arr[$i].ref_first_name+'</div><div class="font-weight-light">Ref last name :  '+$arr[$i].ref_last_name+'</div><div class="font-weight-light">Ref Username : '+$arr[$i].ref_username+'</div><div class="font-weight-light">Ref Password : '+$arr[$i].ref_password+'</div><div class="tasks"> <span class="btn btn-light fa fa-user" title="Profile"> </span><span class="btn btn-light fa fa-edit" onclick="edit('+$arr[$i].ref_id+')" title="Edit"> </span></span> </div></td></tr>';
							<?php
							}
							else 
							{
							?>
							$outp=$outp + '<tr id="table_row_'+$arr[$i].ref_id+'"> <td width="110px" align="left" valign="middle"> <img src="'+$arr[$i].ref_image_src+'" class="img-fluid"/> </td><td align="left" valign="middle"> <div class="font-weight-bold">'+$arr[$i].ref_first_name+'</div><div class="font-weight-light">Ref ID : '+$arr[$i].ref_id+'</div><div class="font-weight-light">Ref first name : '+$arr[$i].ref_first_name+'</div><div class="font-weight-light">Ref last name :  '+$arr[$i].ref_last_name+'</div><div class="font-weight-light">Ref Username : '+$arr[$i].ref_username+'</div><div class="font-weight-light">Ref Password : '+$arr[$i].ref_password+'</div></td></tr>';
							<?php	
							}
						?>
						}
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
	
	function edit($ref_id)
	{
		$.post($("#hid_base_url").val()+"index.php/core/dashboard/referrals/edit",
		{
			req_ref_id:$ref_id
		},
		function(data)
		{
			//alert(data);
				try
				{
							data = data.trim();
							$arr = JSON.parse(data);
							
								$("#hid_ref_id").val($arr[0].ref_id);
								$("#txt_ref_first_name").val($arr[0].ref_first_name);
								$("#txt_ref_last_name").val($arr[0].ref_last_name);
								$("#txt_ref_username").val($arr[0].ref_username);
								$("#txt_ref_username").attr("readonly","true");
								$("#txt_ref_password").val($arr[0].ref_password);
								$("#txt_ref_reenter_password").val($arr[0].ref_password);
								$("#hid_ref_password").val($arr[0].ref_password);
								$("#hid_ref_image").val($arr[0].ref_image);
								$("#txt_ref_sbi").val($arr[0].ref_sbi);
								$("#sel_ref_gender").val($arr[0].ref_gender);
								$("#txt_ref_email_id").val($arr[0].ref_email_id);
								$("#txt_ref_contact_no").val($arr[0].ref_contact_no);
								$("#txt_ref_address").val($arr[0].ref_address);
								$("#txt_ref_desc").val($arr[0].ref_desc);
								
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
	
	
	function add_new_modal()
	{
		$("#add_new_modal").modal(
			{
				"backdrop":"static",
				"keypressed":false
			}
		);
	}
	
	function check_valid_username()
	{
		//open_loader();
		$username = $("#txt_ref_username").val().toLowerCase().trim();
		if($username != "")
		{	
			$.post($("#hid_base_url").val()+"index.php/core/dashboard/referrals/check_valid_username",
			{
				req_new_ref_username:$username
			},
			function(data)
			{
				//alert(data);
				//close_loader();
				try
				{
					
					data = data.trim();
					$arr = JSON.parse(data);
					if($arr.result == true)
					{
						toastr.info($arr.msg);
						return true;
					}
					else
					{
						toastr.error($arr.msg);
						$("#txt_ref_username").focus();
						//$("#txt_staff_username").focus();
						return false;
					}
				}
				catch(err)
				{
					alert("EXCEPTION:"+err.message);
				}
			});
		}
		else
		{
			toastr.error("Empty staff username");
			//$("#txt_staff_username").focus();
			return false;
		}
	}
	
	
	function check_valid_email()
	{
		//open_loader();
		$staff_email_id = $("#txt_staff_email_id").val().toLowerCase().trim();
		
		if($staff_email_id != "")
		{
			if(!validate_email($staff_email_id))
			{
				//close_loader();
				toastr.error("Invalid email id format");
				//$("#txt_staff_email_id").focus();
				return false;
			}
			else
			{
				$.post($("#hid_base_url").val()+"index.php/core/dashboard/staffs/check_valid_email_id",
				{
					req_new_staff_email_id:$staff_email_id
				},
				function(data)
				{
					//alert(data);
					//close_loader();
					try
					{
						
						data = data.trim();
						$arr = JSON.parse(data);
						if($arr.result == true)
						{
							toastr.info($arr.msg);
							return true;
						}
						else
						{
							toastr.error($arr.msg);
							//$("#txt_staff_email_id").focus();
							return false;
						}
					}
					catch(err)
					{
						alert("EXCEPTION:"+err.message);
					}
					});
				}
		}
		else
		{
			//$("#txt_staff_email_id").focus();
			toastr.error("Staff email id is empty");
		}
	}
	
	
	function check_valid_mobile_no()
	{
		//open_loader();
		$staff_mobile_no = $("#txt_staff_mobile_no").val().trim();
		
		//alert($staff_mobile_no);
		if($staff_mobile_no != "")
		{
			
				$.post($("#hid_base_url").val()+"index.php/core/dashboard/staffs/check_valid_mobile_no",
				{
					req_new_staff_mobile_no:$staff_mobile_no
				},
				function(data)
				{
					//alert(data);
					//close_loader();
					try
					{
						
						data = data.trim();
						$arr = JSON.parse(data);
						if($arr.result == true)
						{
							toastr.info($arr.msg);
							return true;
						}
						else
						{
							toastr.error($arr.msg);
							//$("#txt_staff_mobile_no").focus();
							return false;
						}
					}
					catch(err)
					{
						alert("EXCEPTION:"+err.message);
						return false;
					}
					});
		}
		else
		{
			//$("#txt_staff_mobile_no").focus();
			toastr.error("Staff mobile number is empty");
			return false;
		}
	}
	
	function check_password_validation()
	{
		
		$password = $("#txt_ref_password").val();
		$reenter_password = $("#txt_ref_reenter_password").val();
		$("#hid_staff_password").val("");
		if(($password != "") && ($reenter_password != ""))
		{
			//alert("hi");
			if(($password.length < 8) || ($password.length > 16))
			{
				toastr.warning('Password is minimum 8 characters and maximum 16 character should be submit');
				$("#txt_ref_password").focus();
				$("#txt_ref_password").val("");
				$("#txt_ref_reenter_password").val("");
				return false;
			}
			else if($password != $reenter_password)
			{
				toastr.error('Password does not match');
				$("#txt_ref_password").val("");
				$("#txt_ref_reenter_password").val("");
				return false;
			}
			else
			{
				toastr.info('Password is accepted');
				$("#hid_ref_password").val($reenter_password);
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
        <h5 class="modal-title" id="exampleModalLabel">Referrals</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="ref_entry_form">
          	<div class="row">
            	<div class="col-lg-1">
                </div>
            	<div class="col-lg-5 content_div_1">
                	
                    <div class="text-center alert shadow-sm">
                    <img src="<?php echo $this->config->item("rest_server_url");?>assets/images/referral_images/default.png" width="100px" />
                    <input type="hidden" id="hid_ref_image" name="req_ref_image" value="default.png"/>
                    <input type="hidden" id="hid_ref_id" name="req_ref_id"/>
                    <input type="hidden" id="hid_form_mode" value="insert"/>
                    <div class="text-center small-txt need_hover" onclick=show_hide_password() title="show/hide password"><span class="fa fa-pencil-alt">&nbsp;</span>Change</div>
                    </div> 
                    
                    <p class="label2">*Referral Entity name</p><!-- entity = referral source name - this is also refererral source name--->
                   	<select id="sel_ref_entity_name" name="req_ref_entity_name" class="form-control select_box sel_ref_entity_name" style="height:43px">
                    	<option value="Choose">Choose</option>
                        <option value="add_new" class="bg-info">+Add new</option>
                        <option value="DCPP">DCPP</option>
                        <option value="SCP">SCP</option>
                    </select> 
                    <?php 
                    	if($this->Functions->get_staff_task_permission($_SESSION[$this->config->item("sess_cookie_name")]["staff_username"],"referrals") == 'full')
                        {
                    ?>
                                <div class="small-txt" title="Add new">
                                    <span onclick="add_new_referral_source()" class="need_hover">
                                        <span class="fa fa-plus-circle">&nbsp;</span>Add new
                                    </span>
                                    <span>&nbsp;&nbsp;</span>
                                    <span onclick="get_referral_source()" class="need_hover" title="Refresh">
                                        <span class="fa fa-sync">&nbsp;</span>Refresh
                                    </span>                        
                                </div>
                   	<?php
                         }
                    ?>                
                    
                    <p class="label2">Referral Firstname</p>
                    <input id="txt_ref_first_name" name="req_ref_first_name"  maxlength="30" type="text" class="form-control text-capitalize" required="required"/>
                    
                    <p class="label2">Referral Lastname</p>
                    <input id="txt_ref_last_name" name="req_ref_last_name"  maxlength="30" type="text" class="form-control text-capitalize"/>
                                        
                    <p class="label2">*Referral Username</p>
                    <input id="txt_ref_username" onblur="check_valid_username()" name="req_ref_username" maxlength="30" type="text" class="form-control text-lowercase" required="required"/>
                   
                    <p class="label2">*Password</p>
                    <input id="txt_ref_password" maxlength="16" onblur="check_password_validation()" onchange="check_password_validation()" type="password" class="form-control password_control" required="required" />
                    <div class="small-txt need_hover" onclick=show_hide_password() title="show/hide password"><span class="fa fa-eye">&nbsp;</span>show/hide password</div>
                 
                    <p class="label2">*Reenter Password</p>
                    <input id="txt_ref_reenter_password" maxlength="16" onblur="check_password_validation()" onchange="check_password_validation()" type="password" class="form-control password_control" required="required" />
                    <input id="hid_ref_password" name="req_ref_password" type="hidden" required="required"/>                    
                              
                </div>
                
                <div class="col-lg-5 content_div_1">
                
                	<p class="label2">Referral Gender</p>
                    <select id="sel_ref_gender" class="form-control select_box" style="height:43px" name="req_ref_gender">
                    	<option value="">Choose</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                        <option value="Transgender">Transgender</option>
                        <option value="Unknown">Unknown</option>
                    </select>
                    
                    <p class="label2">*Referral Email ID</p>
                    <input id="txt_ref_email_id" name="req_ref_email_id" maxlength="30" type="text" class="form-control text-lowercase" onblur="" required="required"/>
                    
                    <p class="label2">*Referral Mobile No.</p>
                    <input id="txt_ref_contact_no" onblur="" name="req_ref_contact_no"  maxlength="30" type="text" class="form-control number_input" required="required"/>
                    
                    <p class="label2">*Referral Sbi.</p>
                    <input id="txt_ref_sbi" onblur="" name="req_ref_sbi"  maxlength="30" type="text" class="form-control number_input" required="required"/>
                                       
                    <p class="label2">Referral Address</p>
                    <textarea id="txt_ref_address" name="req_ref_address" class="form-control"></textarea>
                    
                    <p class="label2">Referral Description</p>
                    <textarea id="txt_ref_desc" name="req_ref_desc" class="form-control"></textarea>
                	     
                    <input type="submit" name="submit" id="btn_save_ref" class="d-none" value="save" />
                </div>
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button onclick=$("#ref_entry_form")[0].reset() type="button" class="btn btn-light" data-dismiss="modal"><span class="fa fa-times">&nbsp;</span>Cancel</button>
        <button onclick=$("#ref_entry_form")[0].reset() type="button" class="btn btn-light"><span class="fa fa-redo">&nbsp;</span>Reset</button>
        <button onclick=$("#btn_save_ref").click() type="button" class="btn btn-light"><span class="fa fa-save">&nbsp;</span>Save</button>
      </div>
    </div>
  </div>
</div>
<!--entry-modal--->





</section>

<!--front_desk--icons-->