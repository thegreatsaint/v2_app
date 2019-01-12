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
                    	<img src="<?php echo $this->config->item("rest_server_url");?>assets/images/icons/programs.png" width="40px" /><span class="font-weight-bold">&nbsp;<?php echo $page_title;?>
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
                	<img src="<?php echo $this->config->item("rest_server_url");?>assets/images/icons/programs.png" width="100px"/>
                </p>
                <?php
				if(($rights == "full") || ($rights == "write"))
				{
				?>
                <div class="btn btn-light btn-block" onclick="add_new_program_modal()">
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
        	<div class="alert shadow-sm d-none">
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
        	<div class="alert shadow-sm">
            	<div id="program_view">
            	
                </div>
            </div>      	
        </div>
    </div>
</div>

<script>
	$(document).ready(
	function()
	{
		//onload functions---
		program_view();
		patients = [];
		patient_search_view();
		//onload functions--	
		
		$("#frm_add_program").submit(
		function(e)
		{	
		 	try
			 {
				 e.preventDefault();
				 $.ajax(
				 {
					url: $("#hid_base_url").val()+"index.php/core/dashboard/programs/add_new",
					type: "POST",
					data:  new FormData(this),
					contentType: false,
					cache: false,
					processData: false,
					beforeSend : function()
					{
						
					},
					success: function(data)
					{
						try
						{
							data = data.trim();
							$arr = JSON.parse(data);
							
							if($arr.result == true)
							{
								$("#frm_add_program")[0].reset();
								toastr.success($arr.msg);
								$("#add_new_reminder_modal").modal("hide");
								window.location.reload();
							}
							else 
							{
								toastr.error($arr.msg);
							}
						}
						catch(ex)
						{
							alert("EXCEPTION "+ex.message+" "+data);
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
	
	function add_patients($patient_id)
	{
		if((!check_duplicate_patient($patient_id)) && (!check_duplicate_patient_in_existing_program($patient_id))) 
		{
			try
			{
				patients.push({
						"patient_id":$patient_id, 
						"patient_image":$("#patient_search_result_row_"+$patient_id).attr("patient_image"),
						"patient_first_name":$("#patient_search_result_row_"+$patient_id).attr("patient_first_name")
						});
				
				//alert(JSON.stringify(patients));
				$("#hid_program_patients_list").val(JSON.stringify(patients));
				toastr.success("Patients added to reminder","Added");
				show_added_patients();
				
			}
			catch(err)
			{
				alert("EXCEPTION "+err.message);
			}
		}
		else
		{
			toastr.warning("Patients alredy added","Warning!");
		}
		//alert(patients);
		//alert($patient_id);
	}
	
	function show_added_patients()
	{
		if($("#hid_program_patients_list").val() != "")
		{
			try
			{
				$arr = JSON.parse($("#hid_program_patients_list").val());
				$outp = "";
				for($i = 0; $i<$arr.length; $i++)
				{
					if($arr[$i].patient_id != "")
					{
						$outp = $outp + '<div class="need_hover guessing_item shadow_sm"> <img src="'+$arr[$i].patient_image+'" width="50px"/> <span class="badge badge-secondary">'+$arr[$i].patient_id+'</span> <span class="">'+$arr[$i].patient_first_name+'</span> &nbsp;<span class="fa fa-times need_hover text-danger float-right" title="Remove from reminder" onclick=remove_patients_from_program("'+$arr[$i].patient_id+'")></span></div>';
					}
				}

				$("#reminder_patients_list").html($outp);
			}
			catch(err)
			{
				alert("EXCEPTION "+err.message);
			}
		}
	}
	
	function check_duplicate_patient($patient_id)
	{
			$has_duplicate = false;
			$service_code = $("#sel_program_id").val();
			
			if($("#hid_program_patients_list").val() != "")
			{
				try
				{
					$arr = JSON.parse($("#hid_program_patients_list").val());
					
					for($i = 0; $i<$arr.length; $i++)
					{
						if($arr[$i].patient_id == $patient_id)
						{
							$has_duplicate = true;
						}
					}
				}
				catch(err)
				{
					alert("EXCEPTION "+err.message);
				}
			}
						
			return $has_duplicate;
	}
	
	function check_duplicate_patient_in_existing_program($patient_id)
	{
			$service_code = $("#sel_program_id").val();
			
			if($("#hid_program_patients_list").val() != "")
			{
							$.post($("#hid_base_url").val()+"index.php/core/dashboard/programs/is_duplicate_patient",
							{
								req_patient_id:$patient_id,
								req_service_code:$("#sel_program_id").val()
							},
							function(data)
							{
								try
								{
									data = data.trim();
									$arr = JSON.parse(data);
									
									if($arr.result == true)
									{
										return true;
										toastr.warning($arr.msg,"Warning!");
									}
								}
								catch(err)
								{
									alert("EXCEPTION:"+err.message);
								}
							});
			}
	}

	
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
	
	function program_view()
	{
			//alert("ok");
			//alert($("#txt_search_key_word").val());
			open_loader();
			$.post($("#hid_base_url").val()+"index.php/core/dashboard/programs/view",
			{
				search_key_word:""
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
					
					$outp = '<table class="table table-bordered table-striped"> <thead class="btn-light"> <tr align="left"><th align="left">Programs and members</th> </tr></thead> <tbody>';
					
					for($i=0; $i<$arr.length; $i++)
					{
						$outp = $outp + '<tr class="need_hover"><td><div class=""> <div class="" onclick=$("#program_patient_list_'+$arr[$i].service_code+'").fadeToggle()>'+$arr[$i].service_code+'-'+$arr[$i].service_desc+'&nbsp;<div onclick=get_program_members("'+$arr[$i].service_code+'") class="badge badge-primary"><span class="fa fa-users">&nbsp;</span>'+$arr[$i].program_members_count+' Patients</div></div><div id="program_patient_list_'+$arr[$i].service_code+'" style="display:none"></div></div></td></tr>';
						
					}
					
					$outp = $outp + '</tbody></table>';
					
					$("#program_view").html($outp);
				}
				catch(err)
				{
					alert("EXCEPTION:"+err.message);
				}
			});
	}
	
	function remove_program_member($program_id)
	{
		alert($program_id);
	}
	
	function get_program_members($program_id)
	{
		//alert($program_id);
		$.post($("#hid_base_url").val()+"index.php/core/dashboard/programs/get_program_members",
		{
			req_program_id:$program_id
		},
		function(data)
		{
			    try
				{
					//alert(data);
					data = data.trim();
					$arr = JSON.parse(data);
					
					$outp = '';
					
					for($i=0; $i<$arr.length; $i++)
					{
							if($arr[$i].result == true)
							{
								$outp = $outp + '<div id="patient_list_'+$program_id+'_'+$arr[$i].patient_id+'" class="need_hover guessing_item shadow_sm"> <span class="fa fa-times need_hover text-danger float-right" title="Remove from reminder" onclick=remove_patients_from_exist_program("'+$program_id+'","'+$arr[$i].patient_id+'")></span><img src="'+$arr[$i].patient_image+'" width="50px"><span class="badge badge-secondary">'+$arr[$i].patient_id+'</span> <span class="">'+$arr[$i].patient_full_name+'</span> &nbsp;</span></div>';
								
							}
							else
							{
								$outp = 'No patients';
							}
					}
										
					$("#program_patient_list_"+$program_id).html($outp);
					$("#program_patient_list_"+$program_id).fadeIn();
				}
				catch(err)
				{
					alert("EXCEPTION:"+err.message);
				}
		});
	}
	
	
	function remove_patients_from_exist_program($program_id,$patient_id)
	{
		//alert($program_id+", "+$patient_id);
		
		/*
		$("#patient_list_"+$program_id+"_"+$patient_id).addClass('bg-danger');
		$("#patient_list_"+$program_id+"_"+$patient_id).fadeOut();
		*/
		if(confirm("Are you sure to delete?"))
		{
			$.post($("#hid_base_url").val()+"index.php/core/dashboard/programs/remove_patients_from_exist_program",
			{
				req_program_id:$program_id,
				req_patient_id:$patient_id
			},
			function(data)
			{
					try
					{
							data = data.trim();
							$arr = JSON.parse(data);
							if($arr.result == true)
							{				
								$("#patient_list_"+$program_id+"_"+$patient_id).addClass('bg-danger');
								$("#patient_list_"+$program_id+"_"+$patient_id).fadeOut();
								toastr.success("Deleted!",$arr.msg);
							}
					}
					catch(err)
					{
						alert("EXCEPTION : "+err.message);
					}
			});
		}
		
				
	}
	
	function add_new_program_modal()
	{
		$("#add_new_program_modal").modal(
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
	
	function remove_patients_from_program($patient_id)
	{
		if(findObjectByKey(patients,"patient_id",$patient_id) != null)
		{
			//alert(patients[findObjectByKey(patients,"patient_id",$patient_id)].patient_id);
			patients[findObjectByKey(patients,"patient_id",$patient_id)].patient_id = "";
			$("#hid_program_patients_list").val(JSON.stringify(patients));
			//alert(patients[findObjectByKey(patients,"patient_id",$patient_id)].patient_id);
		}
		
		show_added_patients();
	}
	
	
	//findobjectarray
	function findObjectByKey(array, key, value) 
	{
		for (var i = 0; i < array.length; i++) {
			if (array[i][key] === value) {
				return i;
			}
		}
		return null;
    }
	
</script>
</section>

<!--add_new_program_modal-->
<div class="modal fade modal-child" data-backdrop-limit="1" id="add_new_program_modal" style="z-index:1500;" backdrop="static" keypressed="false" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Patient to program</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
     	<div class="row">
        	<div class="col-lg-1">
            </div>
            <div class="col-lg-10">
            	<form id="frm_add_program">
           		<p class="label2">Choose program</p>
                <select id="sel_program_id" name="req_program_id" class="form-control sel_program_type" style="height:43px" required>
                
                </select>
                <?php 
                        if($this->Functions->get_staff_task_permission($_SESSION[$this->config->item("sess_cookie_name")]["staff_username"],"drugtest") == 'full')
                         {
                ?>
                                    <div class="small-txt" title="Add new">
                                        <span onclick=add_new_service('Programs') class="need_hover">
                                            <span class="fa fa-plus-circle">&nbsp;</span>Add new Program
                                        </span>
                                        <span>&nbsp;&nbsp;</span>
                                        <span onclick=get_service() class="need_hover" title="Refresh">
                                            <span class="fa fa-sync">&nbsp;</span>Refresh
                                        </span>                        
                                    </div>
                  <?php
                     	}
                   ?>
                <p class="label2">Choose program</p>
                <input type="hidden" id="hid_program_patients_list" name="req_program_patient" value="[{}]" />
                <div class="btn btn-light btn-block patient_picker">
                	<span class="fa fa-plus-circle">&nbsp;</span>Add Patients
                </div>
                <div id="reminder_patients_list" class="">
                </div>
                
                <button type="submit" id="btn_frm_add_program" class="btn btn-light d-none">Save</button>
                
                </form>
                 
            </div>
            <div class="col-lg-1">
            </div>
        </div>
      </div>
      <div class="modal-footer">
      	<button type="button" onclick=$("#frm_add_program")[0].reset() class="btn btn-light"><span class="fa fa-sync-alt">&nbsp;</span>Reset</button>
       
        <button type="button" onclick=$("#frm_add_program")[0].reset() class="btn btn-light" data-dismiss="modal"><span class="fa fa-times">&nbsp;</span>Cancel</button>
        
         <button type="button" onclick=$("#btn_frm_add_program").click() class="btn btn-light"><span class="fa fa-save">&nbsp;</span>Save</button>
      </div>
    </div>
  </div>
</div>
<!--add_new_program_modal-->
