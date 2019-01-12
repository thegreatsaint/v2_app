<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<script>
$(document).ready(
function(e)
{
	//alert("ok");
	//service_code_entry_form
	view_service();
	get_service();	
	
	$("#service_code_entry_form").submit(
		function(e)
		{
			$url = $("#hid_base_url").val()+"index.php/core/dashboard/configurations/services/add_new";
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
								$("#service_code_entry_form")[0].reset();
								toastr.success($arr.msg);
								//window.location.replace($("#hid_base_url").val()+"index.php/dashboard/front_desk");
							}
							else 
							{
								toastr.error($arr.msg);
								$("#txt_service_code").focus();
							}
						}
						catch(ex)
						{
							alert("EXCEPTION "+ex.message);
							$("#txt_service_descs").val(data);
						}
						
						//$("#txt_staff_address").val(data);
						view_service();
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

function add_new_service($service_type)
{
	//alert("ok");
	$("#sel_service_type").val($service_type);
	$("#service_modal").modal(
	{
		backdrop:"static",
		keypress:"false"
	});
}

function get_service()
{
		    $.post($("#hid_base_url").val()+"index.php/core/dashboard/configurations/services/view",
			{
				
			},
			function(data)
			{
				try
				{
					data = data.trim();
					$arr = JSON.parse(data);
					
					$outp_1='<option value="">Choose drugtest type</option>';
					$outp_2='<option value="">Choose program</option>';
										
					//alert(data);
					for($i=0; $i<$arr.length; $i++)
					{
						if($arr[$i].service_type == 'Drugtest')
						{
							$outp_1 = $outp_1+'<option value="'+$arr[$i].service_code+'">'+$arr[$i].service_code+' - '+$arr[$i].service_desc+'</option>';
						}
						else if($arr[$i].service_type == 'Programs')
						{
							$outp_2 = $outp_2+'<option value="'+$arr[$i].service_code+'">'+$arr[$i].service_code+' - '+$arr[$i].service_desc+'</option>';
						}
					}
					
					$(".sel_drugtest_type").html($outp_1);
					$(".sel_program_type").html($outp_2);
				}
				catch(ex)
				{
					
				}
			});
}


function view_service()
{
		    $.post($("#hid_base_url").val()+"index.php/core/dashboard/configurations/services/view",
			{
				
			},
			function(data)
			{
				try
				{
					
					data = data.trim();
					$arr = JSON.parse(data);
					
					$outp='<table class="table shadow-sm table-hover table-striped"> <thead> <tr> <th colspan="2">Service type</th> </tr></thead> <tbody>';
					
					//alert(data);
					for($i=0; $i<$arr.length; $i++)
					{
						if($arr[$i].result != false)
						{					
							$outp=$outp + '<tr id="service_table_row_'+$arr[$i].auto_id_0+'" staff_type = "'+$arr[$i].service_type+'"> <td> '+$arr[$i].service_code+' - '+$arr[$i].service_type+' <div class="small-txt">Duration : '+$arr[$i].service_def_app_duration+' </div><div class="small-txt">Service timing Units : '+$arr[$i].service_timing_units+' </div><div class="small-txt">Rate : <span class="fa fa-dollar-sign">&nbsp;</span>'+$arr[$i].standard_rate_in_dollar+' </div><div class="small-txt"> <span class="fa fa-align-left">&nbsp;</span>'+$arr[$i].service_desc+' </div><div class="small-txt"><span class="fa fa-user">&nbsp;</span>'+$arr[$i].created_by+' | <span class="fa fa-clock">&nbsp;</span>'+$arr[$i].created_at+'</div></div></td><td> <a href="#sel_service_type"><div class="btn round_btn" onclick="edit_service('+$arr[$i].auto_id_0+')"><span class="fa fa-edit"></span></div></a><div class="btn round_btn" onclick="delete_service('+$arr[$i].auto_id_0+')"><span class="fa fa-trash"></span></div></td></tr>';
						}
					}
					
					$outp = $outp + '</tbody></table>';
						
					$("#view_service").html($outp);
						
						
				}
				catch(err)
				{
					alert("EXCEPTION:"+err.message);
				}
			});
}

function edit_service($auto_id_0)
{
	//alert("tbd");
	
	$.post($("#hid_base_url").val()+"index.php/core/dashboard/configurations/services/edit",
	{
		req_auto_id_0:$auto_id_0
	},
	function(data)
	{
				try
				{
							data = data.trim();
							$arr = JSON.parse(data);
							if($arr[0].result == true)
							{
								//alert($arr[0].auto_id_0);
								$("#sel_service_type").val($arr[0].service_type);
								$("#txt_service_code").val($arr[0].service_code);
								$("#txt_service_def_app_duration").val($arr[0].service_def_app_duration);
								$("#txt_service_timing_units_minutes").val($arr[0].service_timing_units);
								$("#txt_standard_rate_in_dollar").val($arr[0].standard_rate_in_dollar);
								$("#txt_service_desc").val($arr[0].service_desc);
								$("#txt_mapping_icd10_code").val($arr[0].mapping_icd10_code);
								toastr.info("Ready to edit service type.");
							}
							else 
							{
								toastr.error($arr.msg);
							}
							
							setTimeout(view_service,1000);
							//get_service_type();
				}
				catch(err)
				{
					alert("EXCEPTION : "+err.message);
				}
	});
}

function delete_service($auto_id_0)
{
	if(window.confirm("Are you sure to delete that record?"))
		{
			//alert($("#service_type_table_row_"+$auto_id_0).attr("staff_type"));
			$.post($("#hid_base_url").val()+"index.php/core/dashboard/configurations/services/delete",
			{
				req_auto_id_0:$auto_id_0
			},
			function(data)
			{
				try
				{
							data = data.trim();
							$arr = JSON.parse(data);
							if($arr.result == true)
							{
								$("#service_table_row_"+$auto_id_0).fadeOut(1000);
								$("#service_table_row_"+$auto_id_0).addClass("bg-danger");
								toastr.success($arr.msg);
								//window.location.replace($("#hid_base_url").val()+"index.php/dashboard/front_desk");
							}
							else 
							{
								toastr.error($arr.msg);
							}
							
							setTimeout(view_service,1000);
				}
				catch(err)
				{
					alert("EXCEPTION : "+err.message);
				}
			});
		}
}
</script>
<!--staff_role-->
<div class="modal fade modal-child" data-backdrop-limit="3" id="service_modal" style="z-index:1700; overflow:auto" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Services</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="service_code_entry_form">
          	<div class="row">
            	<div class="col-lg-1">
                </div>
            	<div class="col-lg-10 content_div_1">
                  <h6>Add a Service Code</h6>  
                    <p class="label2">*Service type</p>
                    <select id="sel_service_type" name="req_service_type" style="height:43px" class="form-control" required="required"/>
                    	<option value="">Choose</option>
                    	<option value="Drugtest">Drugtest</option>
                        <option value="Programs">Programs</option>
                    </select>
                    <?php 
                    if($this->Functions->get_staff_task_permission($_SESSION[$this->config->item("sess_cookie_name")]["staff_username"],"drugtest") == 'full')
                     {
                    ?>
                    			<!--
                                <div class="small-txt" title="Add new drugtest">
                                    <span onclick="add_new_service_type()" class="need_hover">
                                        <span class="fa fa-plus-circle">&nbsp;</span>Add new drugtest type
                                    </span>
                                    <span>&nbsp;&nbsp;</span>
                                    <span onclick="get_service_type()" class="need_hover" title="Refresh">
                                        <span class="fa fa-sync">&nbsp;</span>Refresh
                                    </span>                        
                                </div>
                                -->
                     <?php
                      }
                      ?>
                    
                    <p class="label2">*Service Code</p>
                    <input id="txt_service_code" name="req_service_code"  maxlength="30" type="text" class="form-control" required="required" />
                    
                    <p class="label2">*Service name</p>
                    <input type="text" id="txt_service_desc" style="text-transform:capitalize" name="req_service_desc" maxlength="30" type="text" class="form-control" required="required">
                    
                    <p class="label2">Mapping ICD10 code</p>
                    <input type="text" id="txt_mapping_icd10_code" name="req_mapping_icd10_code" maxlength="30" type="text" class="form-control">         
                                        
                    <p class="label2">*Default Appointment Duration</p>
                    <input id="txt_service_def_app_duration" name="req_service_def_app_duration" type="number" class="form-control number_input" min="10" max="999" maxlength="3" value="60" style="width:60px; display:inline"  required="required" />
                     minutes
                    
                    <p class="label2">*Time Units:</p>
                    	<div class="radio">
                          <label><input type="radio" id="rad_service_timing_units_1" name="req_service_timing_units" value="option_1" checked required="required" checked="false">Always bill for 1 unit of this service per session Schedule</label>
                        </div>
                        <div class="radio">
                          <label><input type="radio" id="rad_service_timing_units_2" name="req_service_timing_units" value="option_2" required="required" checked="false">Bill for 1 unit for every&nbsp;<input type="number" id="txt_service_timing_units_minutes" name="req_service_timing_units_minutes" class="form-control number_input" min="0" max="999" maxlength="3" value="60" style="width:60px; display:inline" required="required" /> &nbsp; minutes spent on this service during a single session</label>
                        </div>
                        
                     
                    <p class="label2">*Standard Rate</p>
                   	<input type="text" class="form-control number_input" id="txt_standard_rate_in_dollar" name="req_standard_rate_in_dollar" style="display:inline" maxlength="10" placeholder="0.00$"  required="required"/>
                    
                    <p class="label2">&nbsp;</p>
                    <button type="submit" class="btn btn-light">
                    	<span class="fa fa-plus-circle">&nbsp;</span>Add service code
                    </button>
            </div>
           <div class="col-lg-1 content_div_1">
           </div>
         </div>
        </form>
        	<div class="row">
            	<div class="col-lg-1">
                </div>
            	<div class="col-lg-10 content_div_1">
                	<div id="view_service" class="card shadow-sm">
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
</section>
