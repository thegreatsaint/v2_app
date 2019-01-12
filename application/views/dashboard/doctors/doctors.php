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
                    	<img src="<?php echo $this->config->item("rest_server_url");?>assets/images/icons/doctors.png" width="40px" /><span class="font-weight-bold">&nbsp;<?php echo $page_title;?>
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
                	<img src="<?php echo $this->config->item("rest_server_url");?>assets/images/icons/doctors.png" width="100px"/>
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
		$("#hid_form_mode").val("insert");
		//alert("ok");
		//onload functions---
		view();
		//get_staff_role();
		//assign_staff_id();
		//onload functions---
		
		
		$("#doctor_entry_form").submit(
		function(e)
		{
			alert("ok");
			e.preventDefault();
			
			if($("#hid_form_mode").val() == "insert")
			{
				$url = $("#hid_base_url").val()+"index.php/core/dashboard/doctors/add_new";
			}
			else if($("#hid_form_mode").val() == "edit")
			{
				$url = $("#hid_base_url").val()+"index.php/core/dashboard/doctors/update";
			}
			
		 	try
			 {
				 //alert($url);
				
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
							//alert(data);
							$("#txt_doctor_about").val(data);
							
							data = data.trim();
							$arr = JSON.parse(data);
							
							if($arr.result == true)
							{
								$("#doctor_entry_form")[0].reset();
								$("#add_new_modal").modal("hide");
								toastr.success($arr.msg);
								//$("#txt_ref_username").attr("readonly","false");
								
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
	
	function view()
	{
			open_loader();
			$.post($("#hid_base_url").val()+"index.php/core/dashboard/doctors/view",
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
					
					$outp='<table class="table table-hover table-striped"><thead class="bg-light"><tr><th>Doctors</th><th> </th> </tr></thead> <tbody>';
					
					for($i=0; $i<$arr.length; $i++)
					{
						if($arr[$i].result == true)
						{						
						$outp = $outp + '<tr id="doctor_table_row_'+$arr[$i].doctor_id+'"> <td width="110px" align="left" valign="middle"> <img src="'+$arr[$i].doctor_image+'" class="img-fluid"/> </td><td align="left" valign="middle"> <div class="font-weight-bold">'+$arr[$i].doctor_first_name+' '+$arr[$i].doctor_last_name+'</div><div class="font-weight-light"><b>Doctor ID : </b><span class="badge badge-secondary">'+$arr[$i].doctor_id+'</span></div>';
						
						    <?php 
							if(($rights == 'full'))
							{
							?>
								$outp = $outp +  '<td align="left" valign="left"><div class="round_btn fa fa-tasks" title="Tasks" onclick=$("#icon_btns_'+$arr[$i].doctor_id+'").slideToggle("fast")></div><br><span id="icon_btns_'+$arr[$i].doctor_id+'" class="slidedown_btn"> <span class="icon_btns fa fa-user" title="Profile" style="background: linear-gradient(to top, #87CEEB 50%, #4682B4 50%);"> </span><span class="icon_btns fa fa-edit" onclick=edit("'+$arr[$i].doctor_id+'") title="Edit" style="background:linear-gradient(to top, #0000CD 50%,#000080 50%);"></span><span onclick=delete_doctor("'+$arr[$i].doctor_id+'") class="icon_btns fa fa-trash" title="Delete" style="background:linear-gradient(to top, #663399 50%,#4B0082 50%);"> </span></span> </div>';
							<?php
							}
							else if(($rights == 'write'))
							{
							?>
								$outp = $outp +  '<div class="tasks"> <span class="round_btn fa fa-user" title="Profile"> </span> <span class="round_btn fa fa-shield-alt" onclick=staff_access("'+$arr[$i].doctor_id+'") title="Rights and Permissions"> </span> <span class="round_btn fa fa-edit" onclick="edit("'+$arr[$i].doctor_id+'")" title="Edit"> </span></div>';
							<?php
							}
							?>
							
							
						}
						
						
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
	
	
	function delete_doctor($doctor_id)
	{
		alert($doctor_id);
		if(window.confirm("Are you sure to delete that record?"))
		{
			$.post($("#hid_base_url").val()+"index.php/core/dashboard/doctors/delete",
			{
				req_doctor_id:$doctor_id
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
								$("#doctor_table_row_"+$doctor_id).fadeOut(1000);
								$("#doctor_table_row_"+$doctor_id).addClass("bg-danger");
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
	
	//add_new
	function add_new_modal()
	{
		$("#add_new_modal").modal(
		{
			backdrop:"static",
			keypressed:false
		});
	}

</script>

<!--entry-modal--->
<div class="modal fade" id="add_new_modal" backdrop="static" keypressed="false" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Doctors entry</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
      <div class="modal-body">
        <form id="doctor_entry_form">
        	<div class="row">
            	<div class="col-lg-1">
                </div>
                <div class="col-lg-5">
                	<div class="text-center alert shadow-sm">
                        <img src="<?php echo $this->config->item("rest_server_url");?>assets/images/doctors_image/default.png" width="100px" />
                        <input type="hidden" id="hid_doc_image" name="req_doc_image" value="default.png"/>
                        <input type="hidden" id="hid_doc_id" name="req_doc_id"/>
                        <input type="hidden" id="hid_form_mode" value="insert"/>
                        <div class="text-center small-txt need_hover" onclick=show_hide_password() title="show/hide password"><span class="fa fa-pencil-alt">&nbsp;</span>Change</div>
                    </div> 
                </div>
            </div>
          	<div class="row">
            	<div class="col-lg-1">
                </div>
            	<div class="col-lg-5 content_div_1">
                	                    
                    <p class="label2">*Doctor Firstname</p>
                    <input id="txt_doctor_first_name" name="req_doctor_first_name"  maxlength="30" type="text" class="form-control text-capitalize" required="required"/>
                    
                    <p class="label2">Doctor Lastname</p>
                    <input id="txt_doctor_last_name" name="req_doctor_last_name"  maxlength="30" type="text" class="form-control text-capitalize"/>
                    
                    <p class="label2">Doctor Gender</p>
                    <select id="sel_doctor_gender" class="form-control select_box" style="height:43px" name="req_doctor_gender">
                    	<option value="">Choose</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                        <option value="Others">Others</option>
                    </select>
                    
                    <p class="label2">*Doctor Email ID</p>
                    <input id="txt_doctor_email_id" name="req_doctor_email_id" maxlength="50" type="email" class="form-control text-lowercase" onblur="" required="required"/>
                    
                    <p class="label2">*Doctor Mobile No.</p>
                    <input id="txt_doctor_mobile_no" onblur="" name="req_doctor_mobile_no" maxlength="30" type="text" class="form-control number_input" required="required"/>
                    
                    <p class="label2">*Doctor Experience in years.</p>
                    <input id="txt_doctor_exp_years" min="0" max="99" onblur="" name="req_doctor_exp_years" maxlength="2" type="number" class="form-control number_input" required="required"/>
                    
					<p class="label2">Doctor Specialist in</p>
                    <input id="txt_doctor_specialist" name="req_doctor_specialist"  maxlength="50" type="text" class="form-control text-capitalize"/>                    
                    <p class="label2">Hospital Name</p>
                    <input id="txt_hospital_name" name="req_hospital_name"  maxlength="30" type="text" class="form-control"/>                    
                    <p class="label2">Hospital Street</p>
                    <input id="txt_hospital_street" name="req_hospital_street"  maxlength="30" type="text" class="form-control"/>                              
                </div>
                
                <div class="col-lg-5 content_div_1">
                	
                    <p class="label2">Hospital Landmark</p>
                    <input id="txt_hospital_landmark" name="req_hospital_landmark"  maxlength="50" type="text" class="form-control"/>                    
                	<p class="label2">Hospital City</p>
                    <input id="txt_hospital_city" name="req_hospital_city"  maxlength="50" type="text" class="form-control"/>                    
                    <p class="label2">Hospital District</p>
                    <input id="txt_hospital_district" name="req_hospital_district"  maxlength="50" type="text" class="form-control"/>                    
                    <p class="label2">Hospital State</p>
                    <input id="txt_hospital_state" name="req_hospital_state"  maxlength="50" type="text" class="form-control"/>                    
                    <p class="label2">Hospital Country</p>
                    <input id="txt_hospital_country" name="req_hospital_country"  maxlength="50" type="text" class="form-control"/>                    
                    <p class="label2">Hospital Pincode</p>
                    <input id="txt_hospital_pincode" name="req_hospital_pincode"  maxlength="50" type="number" class="form-control"/>                                        
                    <p class="label2">About the Doctor</p>
                    <textarea id="txt_doctor_about" name="req_doctor_about"  maxlength="" type="text" class="form-control"></textarea>											                    
                         
                    <input type="submit" name="submit" id="btn_save_doct" class="d-none" value="save" />
                </div>
            </div>
        </form>
      </div>
      
      
      
      
      <div class="modal-footer">
        <button onclick=$("#doctor_entry_form")[0].reset() type="button" class="btn btn-light" data-dismiss="modal"><span class="fa fa-times">&nbsp;</span>Cancel</button>
        <button onclick=$("#doctor_entry_form")[0].reset() type="button" class="btn btn-light"><span class="fa fa-redo">&nbsp;</span>Reset</button>
        <button onclick=$("#btn_save_doct").click() type="button" class="btn btn-light"><span class="fa fa-save">&nbsp;</span>Save</button>
      </div>
    </div>
  </div>
</div>
<!--entry-modal--->





</section>

<!--front_desk--icons-->