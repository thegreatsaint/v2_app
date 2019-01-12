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
                    	<a href="<?php echo $this->config->item("base_url");?>index.php/dashboard/" class="text_light">
                    	<img src="<?php echo $this->config->item("rest_server_url");?>assets/images/icons/front_desk.png" width="40px" /><span class="font-weight-bold">&nbsp;Front desk
                        </a>
                    </span>
                </div>
                <span class="fa fa-chevron-right"></span>
                <div class="btn btn-default need_hover">
                	<span>
                    	<img src="<?php echo $this->config->item("rest_server_url");?>assets/images/icons/staffs.png" width="40px" /><span class="font-weight-bold">&nbsp;<?php echo $page_title;?>
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
                	<img src="<?php echo $this->config->item("rest_server_url");?>assets/images/icons/staffs.png" width="100px"/>
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
					else if(($rights == "write"))
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

<script>
	$(document).ready(
	function()
	{
		//onload functions---
		view();
		get_staff_role();
		view_staff_role();
		//assign_staff_id();
		//onload functions---
		
		$("#sel_staff_role").change(
		function()
		{
			if($("#sel_staff_role").val() == "Add_new")
			{
				$("#add_new_modal").modal("hide");
				$("#staff_role_modal").modal({backdrop:"static",keypress:false});
			}
		});
		
		$("#staff_role_modal").on('hide.bs.modal', 
		function(){
           $("#add_new_modal").modal({backdrop:"static",keypress:false});
		   get_staff_role();
        });
		
		
		$("#staff_role_entry_form").submit(
		function(e)
		{
			e.preventDefault();
			
			$.post($("#hid_base_url").val()+"index.php/core/dashboard/staffs/add_new_staff_role",
			{
				req_staff_role:$("#sel_staff_role").val(),
				req_staff_role_desc:$("#txt_staff_role_desc").val()
			},
			function(data)
			{
				alert(data);
				try
				{
							data = data.trim();
							$arr = JSON.parse(data);
							if($arr.result == true)
							{
								toastr.success($arr.msg);
							}
							else 
							{
								toastr.error($arr.msg);
							}
							
							setTimeout(view_staff_role,1000);
				}
				catch(err)
				{
					alert("EXCEPTION : "+err.message);
				}
			});
			
			
		});
		
		
		$("#staff_entry_form").submit(
		function(e)
		{
			if($("#hid_form_mode").val() == "insert")
			{
				$url = $("#hid_base_url").val()+"index.php/core/dashboard/staffs/add_new";
			}
			else if($("#hid_form_mode").val() == "edit")
			{
				$url = $("#hid_base_url").val()+"index.php/core/dashboard/staffs/update";
			}
			
		 	try
			 {
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
						try
						{
							//alert(data);
							data = data.trim();
							$arr = JSON.parse(data);
							
							if($arr.result == true)
							{
								$("#staff_entry_form")[0].reset();
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
	
	function delete_staff_role($auto_id_0)
	{
		if(window.confirm("Are you sure to delete that record?"))
		{
			$.post($("#hid_base_url").val()+"index.php/core/dashboard/staffs/delete_staff_role",
			{
				req_staff_role:$("#staff_role_table_row_"+$auto_id_0).attr("staff_role")
			},
			function(data)
			{
				alert(data);
				try
				{
							data = data.trim();
							$arr = JSON.parse(data);
							if($arr.result == true)
							{
								$("#staff_role_table_row_"+$auto_id_0).fadeOut(1000);
								$("#staff_role_table_row_"+$auto_id_0).addClass("bg-danger");
								toastr.success($arr.msg);
								//window.location.replace($("#hid_base_url").val()+"index.php/dashboard/front_desk");
							}
							else 
							{
								toastr.error($arr.msg);
							}
							
							setTimeout(view_staff_role,1000);
				}
				catch(err)
				{
					alert("EXCEPTION : "+err.message);
				}
			});
		}
	}
	
	function view_staff_role()
	{
		    $.post($("#hid_base_url").val()+"index.php/core/dashboard/staffs/view_staff_role",
			{
				
			},
			function(data)
			{
				try
				{
					
					//alert(data);
					data = data.trim();
					$arr = JSON.parse(data);
					
					$outp='<table class="table shadow-sm table-hover table-striped"> <thead> <tr> <th colspan="2">Staffs list</th> </tr></thead> <tbody>';
					
					for($i=0; $i<$arr.length; $i++)
					{
						if($arr[$i].result != false)
						{					
						$outp=$outp + '<tr id="staff_role_table_row_'+$arr[$i].auto_id_0+'" staff_role = "'+$arr[$i].staff_role+'"> <td> '+$arr[$i].staff_role+' <div class="small-txt"> '+$arr[$i].staff_role_desc+' <div><span class="fa fa-user">&nbsp;</span>'+$arr[$i].created_by+' | <span class="fa fa-clock">&nbsp;</span>'+$arr[$i].created_at+'</div></div></td><td> <div class="btn btn-light" onclick="delete_staff_role('+$arr[$i].auto_id_0+')"><span class="fa fa-trash"></span></div></td></tr>';
						}
					}
					
						$outp = $outp + '</tbody></table>';
						
						$("#view_staff_role").html($outp);
						
						
				}
				catch(err)
				{
					alert("EXCEPTION:"+err.message);
				}
			});
	}
	
	function get_staff_role()
	{
		$.post($("#hid_base_url").val()+"index.php/core/dashboard/staffs/get_staff_role",
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
						 <?php 
							if(($rights == 'full') || ($rights == 'write'))
							{
						 ?>
								$outp=$outp+'<option value="Add_new" class="bg-info">+Add new</p>';
								
						  <?php 
							}
						   ?>
						
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
	
	function Delete($staff_id)
	{
		if(window.confirm("Are you sure to delete that record?"))
		{
			$.post($("#hid_base_url").val()+"index.php/core/dashboard/staffs/delete",
			{
				req_staff_id:$staff_id
			},
			function(data)
			{
				alert(data);
				try
				{
							data = data.trim();
							$arr = JSON.parse(data);
							if($arr.result == true)
							{
								$("#table_row_"+$staff_id).fadeOut(1000);
								$("#table_row_"+$staff_id).addClass("bg-danger");
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
			$.post($("#hid_base_url").val()+"index.php/core/dashboard/staffs/view",
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
					
					$outp='<table class="table"><thead class="bg-light"><tr><th>Staff roles</th><th> Remove </th> </tr></thead> <tbody>';
					
					for($i=0; $i<$arr.length; $i++)
					{						
						$outp=$outp + '<tr id="table_row_'+$arr[$i].staff_id+'"> <td width="110px" align="left" valign="middle"> <img src="'+$arr[$i].staff_image_src+'" class="img-fluid"/> </td><td align="left" valign="middle"> <div class="font-weight-bold">'+$arr[$i].staff_first_name+'</div><div class="font-weight-light">Staff ID : '+$arr[$i].staff_id+'</div><div class="font-weight-light">Staff first name : '+$arr[$i].staff_first_name+'</div><div class="font-weight-light">Staff last name :  '+$arr[$i].staff_last_name+'</div><div class="font-weight-light">Staff Username : '+$arr[$i].staff_username+'</div><div class="font-weight-light">Staff Password : '+$arr[$i].staff_password+'</div>';
						    <?php 
							if(($rights == 'full'))
							{
							?>
								$outp = $outp +  '<div class="tasks"> <span class="btn btn-light fa fa-user" title="Profile"> </span> <span class="btn btn-light fa fa-shield-alt" onclick=staff_access("'+$arr[$i].staff_role+'") title="Rights and Permissions"> </span> <span class="btn btn-light fa fa-edit" onclick="edit('+$arr[$i].staff_id+')" title="Edit"> </span> <span onclick="Delete('+$arr[$i].staff_id+')" class="btn btn-light fa fa-trash" title="Delete"> </span> </div>';
							<?php
							}
							else if(($rights == 'write'))
							{
							?>
							$outp = $outp +  '<div class="tasks"> <span class="btn btn-light fa fa-user" title="Profile"> </span> <span class="btn btn-light fa fa-shield-alt" onclick=staff_access("'+$arr[$i].staff_role+'") title="Rights and Permissions"> </span> <span class="btn btn-light fa fa-edit" onclick="edit('+$arr[$i].staff_id+')" title="Edit"> </span></div>';
							<?php
							}
							?>
							
							$outp = $outp + '</td></tr>';
					
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
	
	function edit($staff_id)
	{
		$.post($("#hid_base_url").val()+"index.php/core/dashboard/staffs/edit",
		{
			req_staff_id:$staff_id
		},
		function(data)
		{
			//alert(data);
				try
				{
							data = data.trim();
							$arr = JSON.parse(data);
							
								$("#hid_staff_id").val($arr[0].staff_id);
								$("#txt_staff_first_name").val($arr[0].staff_first_name);
								$("#txt_staff_last_name").val($arr[0].staff_last_name);
								$("#txt_staff_username").val($arr[0].staff_username);
								$("#txt_staff_password").val($arr[0].staff_password);
								$("#txt_staff_reenter_password").val($arr[0].staff_password);
								$("#hid_staff_password").val($arr[0].staff_password);
								$("#hid_staff_image").val($arr[0].staff_image);
								$("#sel_staff_role").val($arr[0].staff_role);
								$("#sel_staff_gender").val($arr[0].staff_gender);
								$("#txt_staff_email_id").val($arr[0].staff_email_id);
								$("#txt_staff_mobile_no").val($arr[0].staff_mobile_no);
								$("#txt_staff_home_phone").val($arr[0].staff_home_phone);
								$("#txt_staff_address").val($arr[0].staff_address);
								$("#txt_staff_desc").val($arr[0].staff_desc);
								
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
		$username = $("#txt_staff_username").val().toLowerCase().trim();
		if($username != "")
		{	
			$.post($("#hid_base_url").val()+"index.php/core/dashboard/staffs/check_valid_username",
			{
				req_new_staff_username:$username
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
		
		$password = $("#txt_staff_password").val();
		$reenter_password = $("#txt_staff_reenter_password").val();
		$("#hid_staff_password").val("");
		if(($password != "") && ($reenter_password != ""))
		{
			//alert("hi");
			if(($password.length < 8) || ($password.length > 16))
			{
				toastr.warning('Password is minimum 8 characters and maximum 16 character should be submit');
				$("#txt_app_api_password").focus();
				$("#txt_staff_password").val("");
				$("#txt_staff_reenter_password").val("");
				return false;
			}
			else if($password != $reenter_password)
			{
				toastr.error('Password does not match');
				$("#txt_staff_password").val("");
				$("#txt_staff_reenter_password").val("");
				return false;
			}
			else
			{
				toastr.info('Password is accepted');
				$("#hid_staff_password").val($reenter_password);
				return true;
			}
		}
	}
	
</script>

<!--staff_role-->
<div class="modal fade modal-child" data-backdrop-limit="1" id="staff_role_modal" style="z-index:1500; overflow:auto" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Staff role</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="staff_role_entry_form">
          	<div class="row">
            	<div class="col-lg-1">
                </div>
            	<div class="col-lg-4 content_div_1">
                    <p class="label2">*New staff role</p>
                    <input id="txt_staff_role"  maxlength="30" type="text" class="form-control" required="required"/>
                </div>
                
                <div class="col-lg-5 content_div_1">
                	<p class="label2">Description</p>
                    <textarea id="txt_staff_role_desc" maxlength="255" type="text" class="form-control"></textarea>
                </div>
                
                <div class="col-lg-1 content_div_1">
                	<p class="label2">&nbsp;</p>
                    <button type="submit" class="btn btn-light">
                    	<span class="fa fa-plus-circle"></span>
                    </button>
                </div>
            </div>
        </form>
        	<div class="row">
            	<div class="col-lg-1">
                </div>
            	<div class="col-lg-10 content_div_1">
                	<div id="view_staff_role" class="card shadow-sm">
                  	<table class="table">
                    	<thead class="bg-light">
                        	<tr>
                            	<th>
                                	Staff roles
                                </th>
                                <th>
                                	Remove
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                        	<tr>
                            	<td>
                                	Manager
                                    <div class="small-txt">
                                    	The quick brown fox jumps over the lazy brown dog.
                                        <div>created by | 2015-09-03 08:00:01</div>
                                    </div>
                                </td>
                                <td>
                                	<div class="btn btn-light" onclick="remove_staff_role('1')"><span class="fa fa-trash"></span></div>
                                </td>
                            </tr>
                            <tr>
                            	<td>
                                	Manager
                                </td>
                                <td>
                                	<div class="btn btn-light" onclick="remove_staff_role('1')"><span class="fa fa-trash"></span></div>
                                </td>
                            </tr>
                            <tr>
                            	<td>
                                	Manager
                                </td>
                                <td>
                                	<div class="btn btn-light" onclick="remove_staff_role('1')"><span class="fa fa-trash"></span></div>
                                </td>
                            </tr>
                            <tr>
                            	<td>
                                	Manager
                                </td>
                                <td>
                                	<div class="btn btn-light" onclick="remove_staff_role('1')"><span class="fa fa-trash"></span></div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    </div>
                </div>
                <div class="col-lg-1">
                </div>
            </div>
      </div>
      <div class="modal-footer">
        <button onclick=$("#staff_entry_form")[0].reset() type="button" class="btn btn-light" data-dismiss="modal"><span class="fa fa-times">&nbsp;</span>Cancel</button>
      </div>
    </div>
  </div>
</div>
<!--staff_role-->


<!--entry-modal--->
<div class="modal fade" id="add_new_modal" style="z-index:1400; overflow:auto" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Staffs</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="staff_entry_form">
          	<div class="row">
            	<div class="col-lg-1">
                </div>
            	<div class="col-lg-5 content_div_1">
                	
                    <div class="text-center alert shadow-sm">
                    <img src="<?php echo $this->config->item("rest_server_url");?>assets/images/staff_images/default.png" width="100px" />
                    <input type="hidden" id="hid_staff_image" name="req_staff_image"/>
                    <input type="hidden" id="hid_staff_id" name="req_staff_id"/>
                    <input type="hidden" id="hid_form_mode" value="insert"/>
                    <div class="text-center small-txt need_hover" onclick=show_hide_password() title="show/hide password"><span class="fa fa-pencil-alt">&nbsp;</span>Change</div>
                    </div>                    
                    
                    <p class="label2">*Staff Firstname</p>
                    <input id="txt_staff_first_name" name="req_staff_first_name"  maxlength="30" type="text" class="form-control" required="required"/>
                    
                    <p class="label2">Staff Lastname</p>
                    <input id="txt_staff_last_name" name="req_staff_last_name"  maxlength="30" type="text" class="form-control"/>
                    
                    <p class="label2">*Staff Username</p>
                    <input id="txt_staff_username" name="req_staff_username" onblur="check_valid_username()" maxlength="30" type="text" class="form-control text-lowercase" required="required"/>
                   
                    
                    <p class="label2">*Staff Password</p>
                    <input id="txt_staff_password" maxlength="16" onblur="check_password_validation()" onchange="check_password_validation()" type="password" class="form-control password_control" required="required" />
                    <div class="small-txt need_hover" onclick=show_hide_password() title="show/hide password"><span class="fa fa-eye">&nbsp;</span>show/hide password</div>
                    <div id="msg_for_txt_app_api_password" class="inline_msg label3 text-danger"></div>
                    
                    <p class="label2">*Staff Reenter Password</p>
                    <input id="txt_staff_reenter_password" maxlength="16" onblur="check_password_validation()" onchange="check_password_validation()" type="password" class="form-control password_control" required="required" />
                    <input id="hid_staff_password" name="req_staff_password" type="hidden" required="required"/>
                                       
                    <p class="label2">*Choose staff Role</p>
                    <select id="sel_staff_role" style="height:43px" name="req_staff_role" class="form-control select_box" required="required">
                    	<option value="">Choose</option>
                        <option value="Manager">Manager</option>
                        <option value="Admin">Admin</option>
                    </select>
                    
                              
                </div>
                
                <div class="col-lg-5 content_div_1">
                
                	<p class="label2">*Choose staff Gender</p>
                    <select id="sel_staff_gender" class="form-control select_box" style="height:43px" name="req_staff_gender" required="required">
                    	<option value="">Choose</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                        <option value="Transgender">Transgender</option>
                        <option value="Unknown">Unknown</option>
                    </select>
                    
                    <p class="label2">*Staff Email id</p>
                    <input id="txt_staff_email_id" name="req_staff_email_id" maxlength="30" type="text" class="form-control text-lowercase" onblur="" required="required"/>
                    
                    <p class="label2">*Staff Mobile No.</p>
                    <input id="txt_staff_mobile_no" onblur="" name="req_staff_mobile_no"  maxlength="30" type="text" class="form-control number_input" required="required"/>
                    
                    <p class="label2">Staff Home Phones</p>
                    <input id="txt_staff_home_phone" name="req_staff_home_phone"  maxlength="30" type="text" class="form-control text-lowercase number_input"/>
                    
                    <p class="label2">Staff address</p>
                    <textarea id="txt_staff_address" name="req_staff_address" class="form-control"></textarea>
                    
                    <p class="label2">Staff description</p>
                    <textarea id="txt_staff_desc" name="req_staff_desc" class="form-control"></textarea>
                    
                	     
                    <input type="submit" name="submit" id="btn_save_staff" class="d-none" value="save" />
                    
                </div>
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button onclick=$("#staff_entry_form")[0].reset() type="button" class="btn btn-light" data-dismiss="modal"><span class="fa fa-times">&nbsp;</span>Cancel</button>
        <button onclick=$("#staff_entry_form")[0].reset() type="button" class="btn btn-light"><span class="fa fa-redo">&nbsp;</span>Reset</button>
        <button onclick=$("#btn_save_staff").click() type="button" class="btn btn-light"><span class="fa fa-save">&nbsp;</span>Save</button>
      </div>
    </div>
  </div>
</div>
<!--entry-modal--->





</section>

<!--front_desk--icons-->