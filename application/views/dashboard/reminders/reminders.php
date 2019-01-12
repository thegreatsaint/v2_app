<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!--front_desk--icons-->
<style>
.reminder_table td
{
	width:200px;
}

</style>
<title></title>
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
                    	<img src="<?php echo $this->config->item("rest_server_url");?>assets/images/icons/reminders.png" width="40px" /><span class="font-weight-bold">&nbsp;<?php echo $page_title;?>
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
                	<img src="<?php echo $this->config->item("rest_server_url");?>assets/images/icons/reminders.png" width="100px"/>
                </p>
               <?php
					if(($rights == "full") || ($rights == "write"))
					{
				?>
                <div class="btn btn-light btn-block" onclick="add_new_reminder()">
                	<span class="fa fa-plus-circle">&nbsp;</span>Add new
                </div>
                <?php
					}
				?>
             </div> 
             
              <p class="label2 text-center"><span class="fa fa-paint-brush"></span> Event colors</p>
              <div class="alert shadow-sm">
             		<div class="badge badge-primary d-block">Normal</div>
                    <div class="badge badge-secondary d-block">Daily</div>
                    <div class="badge badge-success d-block">Weekly</div>
                    <div class="badge badge-warning d-block">Monthly</div>
                    <div class="badge badge-dark d-block">Yearly</div>
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
            
            <div class="btn round_btn" title="Previous" onclick="calendar_navigation_left()">
            	<span class="fa fa-arrow-left"></span>
            </div>
            
            <div class="btn round_btn" title="Yesterday" onclick="calendar_navigation_right()">
            	<span class="fa fa-arrow-right"></span>
            </div>
            
            <div class="btn round_btn" style="line-height:0px; text-align:left;" title="<?php echo date('m/d/Y l');?>" onclick="calendar_navigation_today()">
               	<img style="margin-left:-9px; margin-top:-5px;"; src="<?php echo $this->Functions->today_date()?>" width="35px" />
            </div>
            
            <div class="btn round_btn" title="List view" onclick="list_view()">
               	<span class="fa fa-list"></span>
            </div>
            
            <div class="btn round_btn" title="Month view" onclick="table_view()">
               	<span class="fa fa-table"></span>
            </div>
            
            <div class="btn round_btn" title="Zoom -" onclick="zoom_minus()">
               	<span class="fa fa-search-minus"></span>
            </div>
            
            <div class="btn round_btn" title="Zoom +" onclick="zoom_plus()">
               	<span class="fa fa-search-plus"></span>
            </div>
           
        	<div class="alert shadow-sm show_calendar view" style="overflow:auto;">
            	
            </div>      	
        </div>
    </div>
</div>

<script>
	$(document).ready(
	function()
	{
			patients = [];
			staffs = [];
			doctors = [];
			services = [];
			reminder_json = "[{}]";
			navigation = "";
			calendar_view_mode = "list";
			calendar_show();
			
			//patient_search_view
			patient_search_view();
			staff_search_view();
			doctor_search_view();
			service_search_view();
			
			//alert("ok"); 	
			//calendar_monthly_view('11/1/2018');
			var locations = {
							data:["Room no 1", "Room no 2", "Room no 3", "Room no 4", "Room no 5"]
						  };
							
							$(".locations").easyAutocomplete(locations);
							
			var reminder_type = {
							data:["To Do", "Therapy Intake", "Therapy Session", "Consultation", "Group Therapy", "Psycological Evaluation", "Schedule Event", "Vacation or Blackout period"]
						  };
							
							$(".reminder_type").easyAutocomplete(reminder_type);
			
			$("#sel_reminder_event_type").change(
			function()
			{
				//alert($(this).val());
				if($(this).val() == 'full_day')
				{
					$("#txt_reminder_start_time").val("12:00 AM");
					$("#txt_reminder_end_time").val("11:59 PM");
					
					$("#txt_reminder_start_time").hide();
					$("#txt_reminder_end_time").hide();
					$(".full_day_disp").fadeIn();
				}
				else
				{
					$("#txt_reminder_start_time").fadeIn();
					$("#txt_reminder_end_time").fadeIn();
					$(".full_day_disp").hide();
				}
				
				check_date_conflict();
			});
			
			//$('.need_datepicker').datepicker('setStartDate', "<?php echo date('m/d/Y');?>");
			
			
			$("#txt_reminder_end_date").change(
				function(e)
				{
					var start_date = new Date($("#txt_reminder_start_date").val());
					var end_date = new Date($("#txt_reminder_end_date").val());
					
					if(start_date > end_date)
					{
						toastr.warning("Starting date is paster than ending date!","WARNING!");
						$("#txt_reminder_end_date").val($("#txt_reminder_start_date").val());
						//$("#txt_reminder_end_date").focus();
					}
					//(start_date.getMonth()+1) + '/' + start_date.getDate() + '/' + start_date.getFullYear();
					e.preventDefault();
				});

			
			$("#txt_reminder_start_date").change(
			function()
			{
				$("#txt_reminder_end_date").val($(this).val());
				$("#txt_reminder_event_from_date").val($(this).val());
				$("#txt_reminder_event_to_date").val($(this).val());
				//$(".need_datepicker").datepicker('setStartDate', $(this).val());
				check_date_conflict();
			});
			
			$("#txt_reminder_start_time").change(
			function()
			{
				$("#txt_reminder_end_time").val($(this).val());
				check_date_conflict();
			});
			
			$("#txt_reminder_end_time").change(
			function()
			{
				check_date_conflict();
			});
			
			
			
			$("#txt_reminder_end_date").change(
			function()
			{
				if($("#sel_reminder_repeat").val() == 'Daily')
				{
					$("#txt_reminder_end_date").val($("#txt_reminder_start_date").val());
				}
				check_date_conflict();
			});
			
			
			
			$("#chkb_inifinite").change(
			function()
			{
				if($(this).prop("checked"))
				{
					$("#txt_reminder_event_to_date").val("Infinite");
				}
				else
				{
					$("#txt_reminder_event_to_date").val($("#hid_today_date").val());
				}
			});
			
			$("#txt_reminder_event_to_date").blur(
			function()
			{
				if($("#txt_reminder_event_to_date").val() == 'Infinite')
				{
					//alert("ok");
					$("#chkb_inifinite").click();
				}
				
			});
			
			
			$("#txt_reminder_event_from_date").blur(
			function()
			{
				//$(".need_datepicker").datepicker('setStartDate', $(this).val());
			});
		
			$("#sel_reminder_repeat").click(
			function()
			{
				if($("#sel_reminder_repeat").val() == 'Daily')
				{
					//alert("ok");
					$(".reminder_date").hide();
					$(".repeat_event_section").fadeIn();
					$(".weekly_repeat_section").hide();
					$(".monthly_repeat_section").hide();
					$(".yearly_repeat_section").hide();
					$("#txt_reminder_end_date").val($("#txt_reminder_start_date").val());
				}
				else if($("#sel_reminder_repeat").val() == 'Weekly')
				{
					$(".reminder_date").hide();
					$(".repeat_event_section").fadeIn();
					$(".weekly_repeat_section").fadeIn();
					$(".monthly_repeat_section").hide();
					$(".yearly_repeat_section").hide();
					$(".reminder_limit_date").fadeIn();
				}
				else if($("#sel_reminder_repeat").val() == 'Monthly')
				{
					$(".reminder_limit_date").fadeIn();
					$(".reminder_date").fadeIn();
					$(".repeat_event_section").fadeIn();
					$(".weekly_repeat_section").hide();
					$(".monthly_repeat_section").fadeIn();
					$(".yearly_repeat_section").hide();
				}
				else if($("#sel_reminder_repeat").val() == 'Yearly')
				{
					//salert("ok");
					$(".reminder_limit_date").hide();
					$(".reminder_date").fadeIn();
					$(".repeat_event_section").fadeIn();
					$(".weekly_repeat_section").hide();
					$(".monthly_repeat_section").hide();
					$(".yearly_repeat_section").fadeIn();
				}
				else
				{
					$(".repeat_event_section").hide();
					$(".reminder_date").fadeIn();
				}
				
				check_date_conflict();
				
			});
			
			$("#txt_repeat_months").change(
			function()
			{
				if($(this).val() != "")
				{						
					$repeat_months = $(this).val();
					//alert($repeat_months);
					$arr = $repeat_months.split(",");
					$arr_2 = [];
					for($i=0; $i<$arr.length; $i++)
					{
						$arr_2[$i]=parseInt($arr[$i]);
					}
				
					//alert("Minimum value "+Math.min.apply(null,$arr_2));
					//alert("Maximum value "+Math.max.apply(null,$arr_2));
					//alert(pad(Math.min.apply(null,$arr_2),2);
					//$("#txt_reminder_event_from_date").val();
					$("#txt_reminder_event_from_date").val(Math.min.apply(null,$arr_2)+"/<?php echo date('d/Y');?>");
					$("#txt_reminder_event_to_date").val(Math.max.apply(null,$arr_2)+"/<?php echo date('d/Y');?>");
					//$("#txt_reminder_event_to_date").val();
					
					check_date_conflict();
				}
			});
			
			
			$("#txt_repeat_years").change(
			function()
			{
				if($(this).val() != "")
				{			
					$repeat_years = $(this).val();
					//alert($repeat_months);
					$arr = $repeat_years.split(",");
					$arr_2 = [];
					for($i=0; $i<$arr.length; $i++)
					{
						$arr_2[$i]=parseInt($arr[$i]);
					}
				
					//alert("Minimum value "+Math.min.apply(null,$arr_2));
					//alert("Maximum value "+Math.max.apply(null,$arr_2));
					//alert(pad(Math.min.apply(null,$arr_2),2);
					//$("#txt_reminder_event_from_date").val();
					$("#txt_reminder_event_from_date").val("01/01/"+Math.min.apply(null,$arr_2));
					$("#txt_reminder_event_to_date").val("12/31/"+Math.max.apply(null,$arr_2));
					//$("#txt_reminder_event_to_date").val();
					
					check_date_conflict();
					
				}
			});
							
		//$(".reminder_view_table").html();
		
		$("#txt_reminder_event_from_date").blur(
		function()
		{
			check_date_conflict();
		});
		
		$("#txt_reminder_location").change(
		function()
		{
			//alert("ok");
			if($(this).val() != "")
			{
				location_check_date_conflict();
			}
		});
		
		$("#txt_reminder_event_to_date").blur(
		function()
		{
			check_date_conflict();
		});
		
		$("input[name='req_repeat_weeks[]']").change(
		function()
		{
			var req_repeat_weeks = new Array();
			$("input[name='req_repeat_weeks[]']:checked").each(
			function() 
			{
			   req_repeat_weeks.push($(this).val());
			});
			
			$("#req_repeat_weeks_json").val(req_repeat_weeks);
			//alert(JSON.stringify(req_repeat_weeks));
		
			check_date_conflict();
			//alert($(this).val());
		});
		
		$("#add_new_reminder_modal").on("hidden.bs.modal", function () {
				
				if(confirm("Page is redirect?"))
				{
					window.location.reload();
				}

		});
							
							
		$("#reminder_save_form").submit(
		function(e)
		{
			if($("#hid_frm_mode").val() == 'insert')
			{
				$url = $("#hid_base_url").val()+"index.php/core/dashboard/reminders/add_new";
			}
			else if($("#hid_frm_mode").val() == 'update')
			{
				$url = $("#hid_base_url").val()+"index.php/core/dashboard/reminders/update";
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
						
					},
					success: function(data)
					{
						try
						{
							//alert(data);
							//$("#txt_reminder_desc_alerts").val(data);
							
							data = data.trim();
							$arr = JSON.parse(data);
							
							if($arr.result == true)
							{
								$("#reminder_save_form")[0].reset();
								toastr.success($arr.msg);
								$("#add_new_reminder_modal").modal("hide");
								
								//window.location.reload();
								//$("#txt_ref_username").attr("readonly","false");
								//window.location.replace($("#hid_base_url").val()+"index.php/dashboard/front_desk");
							}
							else 
							{
								toastr.error($arr.msg);
							}
							
							//calendar_show();
							
						}
						catch(ex)
						{
							alert("EXCEPTION "+ex.message+" "+data);
						}
						
						//$("#txt_staff_address").val(data);
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
	
	function edit_reminder($reminder_id)
	{
		open_loader();
		$.post($("#hid_base_url").val()+"index.php/core/dashboard/reminders/edit",
			{
				req_reminder_id:$reminder_id
			},
			function(data)
			{
				close_loader();
					 try
						{
							data = data.trim();
							$arr100 = JSON.parse(data);
							//alert(data);
							if($arr100[0].result == true)
							{
								
								$("#hid_reminder_id").val($arr100[0].reminder_id);
								
								$("#sel_reminder_calendar").val($arr100[0].reminder_calendar);
								$("#txt_reminder_type").val($arr100[0].reminder_type);
								
								$("#sel_reminder_event_type").val($arr100[0].reminder_event_type);
								$("#sel_reminder_event_type").click();
								
								$("#sel_reminder_repeat").val($arr100[0].reminder_repeat);
								$("#sel_reminder_repeat").click();
								
								$arr2 = $arr100[0].reminder_start_date.split("-");
								$("#txt_reminder_start_date").val($arr2[1]+"/"+$arr2[2]+"/"+$arr2[0]);
								
								$arr3 = $arr100[0].reminder_end_date.split("-");
								$("#txt_reminder_end_date").val($arr3[1]+"/"+$arr3[2]+"/"+$arr3[0]);
								
								$("#txt_reminder_start_time").val($arr100[0].reminder_start_time);
								$("#txt_reminder_end_time").val($arr100[0].reminder_end_time);
								
								$arr4 = $arr100[0].reminder_limit_from_date.split("-");
								$("#txt_reminder_event_from_date").val($arr4[1]+"/"+$arr4[2]+"/"+$arr4[0]);
								
								$arr5 = $arr100[0].reminder_limit_to_date.split("-");
								$("#txt_reminder_event_to_date").val($arr5[1]+"/"+$arr5[2]+"/"+$arr5[0]);
								
							
								
								$weeks = $arr100[0].repeat_weeks.split(",");
								
								$(".repeat_weeks").prop("checked",false);
								
								$("input[name='req_repeat_weeks[]']:checked").each(
								function() 
								{
								   $(this).prop("checked",false);
								});
																
								for($i=0; $i<$weeks.length; $i++)
								{
									if($weeks[$i] == 1)
									{
										$("#chkb_mon").prop("checked",true);
									}
									else if($weeks[$i] == 2)
									{
										$("#chkb_tue").prop("checked",true);
									}
									else if($weeks[$i] == 3)
									{
										$("#chkb_wed").prop("checked",true);
									}
									else if($weeks[$i] == 4)
									{
										$("#chkb_thu").prop("checked",true);
									}
									else if($weeks[$i] == 5)
									{
										$("#chkb_fri").prop("checked",true);
									}
									else if($weeks[$i] == 6)
									{
										$("#chkb_sat").prop("checked",true);
									}
									else if($weeks[$i] == 7)
									{
										$("#chkb_sun").prop("checked",true);
									}
									
								}
																
								$("#txt_repeat_months").val($arr100[0].repeat_months);
								$("#txt_repeat_years").val($arr100[0].repeat_years);
								
								$("#txt_reminder_location").val($arr100[0].reminder_location);
								$("#txt_reminder_desc_alerts").val($arr100[0].reminder_desc_alert);
								
								//alert($arr[0].reminder_patients_json);
								if($arr100[0].reminder_patients_json != '[{}]')
								{
									$arr6 = JSON.parse($arr100[0].reminder_patients_json);
									for($i=0; $i<$arr6.length; $i++)
									{
										if($arr6[$i].patient_id != "")
										{
											toastr.remove();
											add_patients_to_reminder($arr6[$i].patient_id);
										}
									}
								}
								//alert($arr100[0].reminder_staffs_json);	
													
								if($arr100[0].reminder_staffs_json != '[{}]')
								{
									//alert($arr[0].reminder_staffs_json);
									$arr7 = JSON.parse($arr100[0].reminder_staffs_json);
									for($i=0; $i<$arr7.length; $i++)
									{
										if($arr7[$i].staff_id != "")
										{
											toastr.remove();
											add_staffs($arr7[$i].staff_id);
										}
									}
								}
								
								
								if($arr100[0].reminder_doctors_json != '[{}]')
								{
									//alert($arr[0].reminder_staffs_json);
									$arr8 = JSON.parse($arr100[0].reminder_doctors_json);
									for($i=0; $i<$arr8.length; $i++)
									{
										if($arr8[$i].doctor_id != "")
										{
											toastr.remove();
											add_doctors($arr8[$i].doctor_id);
										}
									}
								}
								
								
								if($arr100[0].reminder_services_json != '[{}]')
								{
									//alert($arr[0].reminder_staffs_json);
									$arr9 = JSON.parse($arr100[0].reminder_services_json);
									for($i=0; $i<$arr9.length; $i++)
									{
										if($arr9[$i].service_code != "")
										{
											toastr.remove();
											add_service($arr9[$i].service_code);
										}
									}
								}
								
								$("#reminder_info_modal").modal("hide");
									$("#add_new_reminder_modal").modal(
										{
											backdrop:'static',
											keypress:false
										}
									);
									
									$("#hid_frm_mode").val("update");
									toastr.info("Ready to edit reminder information","Ready to Edit");
									
								
							}
							else
							{
								//toastr.info(data);
							}	

						}
						catch(ex)
						{
							alert("EXCEPTION "+ex.message);
							//$("#txt_reminder_desc_alerts").html(data);
						}
			});
	}
	
	function check_date_conflict()
	{
			/*
			for($i=0; $i<req_repeat_weeks.length; $i++)
			{
				alert(req_repeat_weeks[$i]);
			}*/
		//alert($("#req_repeat_weeks_json").val());
		//open_loader();
		if($("#sel_reminder_event_type").val() == "")
		{
			toastr.error("Reminder event is empty","Error!");
			$("#sel_reminder_event_type").focus();
		}
		else if($("#txt_reminder_start_date").val() == "")
		{
			toastr.error("Start date is empty","Error!");
			$("#txt_reminder_start_date").focus();
		}
		else if($("#txt_reminder_end_date").val() == "")
		{
			toastr.error("End date is empty","Error!");
			$("#txt_reminder_end_date").focus();
		}
		else if($("#txt_reminder_start_time").val() == "")
		{
			toastr.error("Start time is empty","Error!");
			$("#txt_reminder_start_time").focus();
		}
		else if($("#txt_reminder_end_time").val() == "")
		{
			toastr.error("End time is empty","Error!");
			$("#txt_reminder_end_time").focus();
		}
		else
		{
			$.post($("#hid_base_url").val()+"index.php/core/dashboard/reminders/check_date_conflict",
			{
				req_reminder_start_date:$("#txt_reminder_start_date").val(),
				req_reminder_end_date:$("#txt_reminder_end_date").val(),
				req_reminder_start_time:$("#txt_reminder_start_time").val(),
				req_reminder_end_time:$("#txt_reminder_start_time").val(),
				req_reminder_event_type:$("#sel_reminder_event_type").val(),
				req_reminder_event_from_date:$("#txt_reminder_event_from_date").val(),
				req_reminder_event_to_date:$("#txt_reminder_event_to_date").val(),
				req_repeat_weeks:$("#req_repeat_weeks_json").val(),
				req_repeat_months:$("#txt_repeat_months").val(),
				req_repeat_years:$("#txt_repeat_years").val(),
				req_reminder_repeat:$("#sel_reminder_repeat").val(),
				req_reminder_calendar:$("#sel_reminder_calendar").val()
				
			},
			function(data)
			{
				//close_loader();
					 try
						{
							//alert(data);
							//stoastr.info(data);
							
							data = data.trim();
							$arr = JSON.parse(data);
							
							if($arr.result == true)
							{
								toastr.warning($arr.msg);
							}
							else
							{
								//toastr.info(data);
							}	

						}
						catch(ex)
						{
							alert("EXCEPTION "+ex.message+" "+data);
							//$("#txt_reminder_desc_alerts").html(data);
						}
			});
		}
	}
	
	
	
	function compareDate(str1){
// str1 format should be dd/mm/yyyy. Separator can be anything e.g. / or -. It wont effect
var dt1   = parseInt(str1.substring(0,2));
var mon1  = parseInt(str1.substring(3,5));
var yr1   = parseInt(str1.substring(6,10));
var date1 = new Date(yr1, mon1-1, dt1);
return date1;
}
	
	function pad(n, width, z) 
	{
	  z = z || '0';
	  n = n + '';
	  return n.length >= width ? n : new Array(width - n.length + 1).join(z) + n;
	}
	
	function list_view()
	{
		calendar_view_mode = "list";
		calendar_show();
	}
	
	function table_view()
	{
		calendar_view_mode = "month";
		calendar_show();
	}
	
	function calendar_navigation_left()
	{
		//alert("back");
		navigation = "backward";
		calendar_show();
	}
	
	function calendar_navigation_right()
	{
		//alert("front");
		navigation = "forward";
		calendar_show();
	}
	
	function calendar_navigation_today()
	{
		navigation = "today";
		calendar_show();
	}
	
	function calendar_show()
	{
		//alert(calendar_view_mode);
		open_loader();
		$.post($("#hid_base_url").val()+"index.php/core/dashboard/reminders/view",
		{
			search_key_word:$("#txt_search_key_word").val(),
			navigation:navigation,
			view_mode:calendar_view_mode
		},
		function(data,success)
		{
			close_loader();
			//reminder_json = data;
			//sshow_reminder();
			$(".show_calendar").html(data);
			//alert(data);
			//scalendar_monthly_view('11/1/2018');
		});
	}
	
	function check_event_is_in_this_date($year, $month, $date)
	{
		
		$arr = JSON.parse(reminder_json);
		if($arr[0].reminder_start_date);
		
		$temp_date_1 = new Date($year,$month,$date);
		$temp_date_2 = new Date($arr[0].reminder_start_date);
		//alert($arr[0].reminder_start_date+" | "+$year+"-"+$month+"-"+$date);
		//gsalert($temp_date_1.getTime()+" "+$temp_date_2.getTime());
		
	}
	
	function add_doctors_to_reminder($doctor_id)
	{
		if(!check_duplicate_doctor($doctor_id)) 
		{
		try
			{
				doctors.push({
						"doctor_id":$doctor_id, 
						"doctor_image":$("#doctors_search_result_row_"+$doctor_id).attr("doctor_image"),
						"doctor_first_name":$("#doctors_search_result_row_"+$doctor_id).attr("doctor_first_name"),
						"doctor_last_name":$("#doctors_search_result_row_"+$doctor_id).attr("doctor_last_name")
						});
				
				//alert(JSON.stringify(patients));
				$("#hid_reminder_doctors_list").val(JSON.stringify(doctors));
				toastr.success("Doctor added to reminder","Added");
				show_added_doctors();
			}
			catch(err)
			{
				alert("EXCEPTION "+err.message);
			}
		}
		else
		{
			toastr.warning("Doctor alredy added","Warning!");
		}
	}
	//add_patients
	function add_patients_to_reminder($patient_id)
	{
		if(!check_duplicate_patient($patient_id)) 
		{
			try
			{
				patients.push({
						"patient_id":$patient_id, 
						"patient_image":$("#patient_search_result_row_"+$patient_id).attr("patient_image"),
						"patient_first_name":$("#patient_search_result_row_"+$patient_id).attr("patient_first_name")
						});
				
				//alert(JSON.stringify(patients));
				$("#hid_reminder_patients_list").val(JSON.stringify(patients));
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
	
	
	function location_check_date_conflict()
	{
		$reminder_location = $("#txt_reminder_location").val();
		//alert($reminder_location);
		if($reminder_location != "")
		{
			
		open_loader();
		if($("#sel_reminder_event_type").val() == "")
		{
			toastr.error("Reminder event is empty","Error!");
			$("#sel_reminder_event_type").focus();
		}
		else if($("#txt_reminder_start_date").val() == "")
		{
			toastr.error("Start date is empty","Error!");
			$("#txt_reminder_start_date").focus();
		}
		else if($("#txt_reminder_end_date").val() == "")
		{
			toastr.error("End date is empty","Error!");
			$("#txt_reminder_end_date").focus();
		}
		else if($("#txt_reminder_start_time").val() == "")
		{
			toastr.error("Start time is empty","Error!");
			$("#txt_reminder_start_time").focus();
		}
		else if($("#txt_reminder_end_time").val() == "")
		{
			toastr.error("End time is empty","Error!");
			$("#txt_reminder_end_time").focus();
		}
		else
		{
			$.post($("#hid_base_url").val()+"index.php/core/dashboard/reminders/location_check_date_conflict",
			{
				req_reminder_start_date:$("#txt_reminder_start_date").val(),
				req_reminder_end_date:$("#txt_reminder_end_date").val(),
				req_reminder_start_time:$("#txt_reminder_start_time").val(),
				req_reminder_end_time:$("#txt_reminder_start_time").val(),
				req_reminder_event_type:$("#sel_reminder_event_type").val(),
				req_reminder_event_from_date:$("#txt_reminder_event_from_date").val(),
				req_reminder_event_to_date:$("#txt_reminder_event_to_date").val(),
				req_repeat_weeks:$("#req_repeat_weeks_json").val(),
				req_repeat_months:$("#txt_repeat_months").val(),
				req_repeat_years:$("#txt_repeat_years").val(),
				req_reminder_repeat:$("#sel_reminder_repeat").val(),
				req_reminder_calendar:$("#sel_reminder_calendar").val(),
				req_reminder_location:$reminder_location
				
			},
			function(data)
			{
				close_loader();
					 	try
						{
							$arr = JSON.parse(data);
							
							$outp ="";
						
							if($arr.result == true)
							{
									$arr_2 = JSON.parse($arr.reminder_list_json);
																
									$outp = '<div class="row guessing_item" id=""> <div class="col-lg-3"></div><div class="col-lg-9"><p class="label2"><span class="badge badge-secondary">Location : '+$reminder_location+'</span></p><br><div title="Add any way" onclick=add_location() class="btn round_btn"><span class="fa fa-plus-circle"></span></div>Add any way</div></div>';
									$outp = $outp + '<div class="alert alert-warning"><span class="fa fa-exclamation-triangle">&nbsp;</span>Already, This location is assigned for below reminders</div>';
																	
									$outp = $outp + '<table class="table table-condenced table-bordered table-striped"><thead class="btn-light"><tr><th width="300px">Date/Time</th><th>Reminders</th><th>Type</th><th>Organizer</th></tr></thead><tbody class="small-txt">';									
									for($i=0; $i<$arr_2.length; $i++)
									{
										$ids = $arr_2[$i].reminder_id.trim();
										$outp = $outp + '<tr class="need_hover" onclick=show_reminder_info("'+$ids+'")><td><span class="fa fa-calendar"></span> '+$arr_2[$i].reminder_start_date+' <span class="fa fa-clock"></span>  '+$arr_2[$i].reminder_start_time+' - '+$arr_2[$i].reminder_end_time+'</td><td> '+$arr_2[$i].reminder_type+'</td><td> '+$arr_2[$i].reminder_repeat+'</td><td> '+$arr_2[$i].reminder_calendar+'</td></tr>';
										
									}
									
									$outp = $outp + '</tbody></table>';	
									
									$("#disp_conflict_type").text('Reminder conflict! - Location');
									
									$(".conflict_info").html($outp);
									
									$("#conflicts_modal").modal(
										{
											backdrop:"static"
										}
									);										
							}
							else
							{
								
							}
							
						}
						catch(ex)
						{
							alert(ex.message+" "+data);
							//$("#txt_reminder_desc_alerts").html(data);
						}
			});
		}
		}
		
		close_loader();
	}
	
	function doctor_check_date_conflict($doctor_id)
	{
		open_loader();
		if($("#sel_reminder_event_type").val() == "")
		{
			toastr.error("Reminder event is empty","Error!");
			$("#sel_reminder_event_type").focus();
		}
		else if($("#txt_reminder_start_date").val() == "")
		{
			toastr.error("Start date is empty","Error!");
			$("#txt_reminder_start_date").focus();
		}
		else if($("#txt_reminder_end_date").val() == "")
		{
			toastr.error("End date is empty","Error!");
			$("#txt_reminder_end_date").focus();
		}
		else if($("#txt_reminder_start_time").val() == "")
		{
			toastr.error("Start time is empty","Error!");
			$("#txt_reminder_start_time").focus();
		}
		else if($("#txt_reminder_end_time").val() == "")
		{
			toastr.error("End time is empty","Error!");
			$("#txt_reminder_end_time").focus();
		}
		else
		{
			$.post($("#hid_base_url").val()+"index.php/core/dashboard/reminders/doctor_check_date_conflict",
			{
				req_reminder_start_date:$("#txt_reminder_start_date").val(),
				req_reminder_end_date:$("#txt_reminder_end_date").val(),
				req_reminder_start_time:$("#txt_reminder_start_time").val(),
				req_reminder_end_time:$("#txt_reminder_start_time").val(),
				req_reminder_event_type:$("#sel_reminder_event_type").val(),
				req_reminder_event_from_date:$("#txt_reminder_event_from_date").val(),
				req_reminder_event_to_date:$("#txt_reminder_event_to_date").val(),
				req_repeat_weeks:$("#req_repeat_weeks_json").val(),
				req_repeat_months:$("#txt_repeat_months").val(),
				req_repeat_years:$("#txt_repeat_years").val(),
				req_reminder_repeat:$("#sel_reminder_repeat").val(),
				req_reminder_calendar:$("#sel_reminder_calendar").val(),
				req_doctor_id:$doctor_id
				
			},
			function(data)
			{
				close_loader();
					 try
						{
							//alert(data);
							$arr = JSON.parse(data);
							
							$outp ="";
						
							if($arr.result == true)
							{
									$arr_2 = JSON.parse($arr.reminder_list_json);
																
									$outp = '<div class="row guessing_item" id=""> <div class="col-lg-3"> <img src="'+$("#doctors_search_result_row_"+$arr.doctor_id).attr("doctor_image")+'" class="img-fluid img-circle"> </div><div class="col-lg-9"><p class="label2"><span class="badge badge-secondary">'+$arr.doctor_id+'</span> </p>'+$("#doctors_search_result_row_"+$arr.doctor_id).attr("doctor_first_name")+'<br><div title="Add any way" onclick=add_doctors_to_reminder("'+$arr.doctor_id+'") class="btn round_btn"><span class="fa fa-plus-circle"></span></div>Add any way</div></div>';
									
									$outp = $outp + '<div class="alert alert-warning"><span class="fa fa-exclamation-triangle">&nbsp;</span>Already, This doctor is assigned for below reminders</div>';
																		
									$outp = $outp + '<table class="table table-condenced table-bordered table-striped"><thead class="btn-light"><tr><th width="300px">Date/Time</th><th>Reminders</th><th>Type</th><th>Organizer</th></tr></thead><tbody class="small-txt">';
									
									for($i=0; $i<$arr_2.length; $i++)
									{
										$ids = $arr_2[$i].reminder_id.trim();
										$outp = $outp + '<tr class="need_hover" onclick=show_reminder_info("'+$ids+'")><td><span class="fa fa-calendar"></span> '+$arr_2[$i].reminder_start_date+' <span class="fa fa-clock"></span>  '+$arr_2[$i].reminder_start_time+' - '+$arr_2[$i].reminder_end_time+'</td><td> '+$arr_2[$i].reminder_type+'</td><td> '+$arr_2[$i].reminder_repeat+'</td><td> '+$arr_2[$i].reminder_calendar+'</td></tr>';
										
									}
									
									$outp = $outp + '</tbody></table>';	
									
									$("#disp_conflict_type").text('Reminder conflict! - Doctor');
									$(".conflict_info").html($outp);
									
									$("#conflicts_modal").modal(
										{
											backdrop:"static"
										}
									);										
							}
							else
							{
								add_doctors_to_reminder($doctor_id);
							}
						}
						catch(ex)
						{
							alert(ex.message+" "+data);
							//$("#txt_reminder_desc_alerts").html(data);
						}
			});
		}
		close_loader();
	}
	
	function patient_check_date_conflict($patient_id)
	{
		open_loader();
		if($("#sel_reminder_event_type").val() == "")
		{
			toastr.error("Reminder event is empty","Error!");
			$("#sel_reminder_event_type").focus();
		}
		else if($("#txt_reminder_start_date").val() == "")
		{
			toastr.error("Start date is empty","Error!");
			$("#txt_reminder_start_date").focus();
		}
		else if($("#txt_reminder_end_date").val() == "")
		{
			toastr.error("End date is empty","Error!");
			$("#txt_reminder_end_date").focus();
		}
		else if($("#txt_reminder_start_time").val() == "")
		{
			toastr.error("Start time is empty","Error!");
			$("#txt_reminder_start_time").focus();
		}
		else if($("#txt_reminder_end_time").val() == "")
		{
			toastr.error("End time is empty","Error!");
			$("#txt_reminder_end_time").focus();
		}
		else
		{
			$.post($("#hid_base_url").val()+"index.php/core/dashboard/reminders/patient_check_date_conflict",
			{
				req_reminder_start_date:$("#txt_reminder_start_date").val(),
				req_reminder_end_date:$("#txt_reminder_end_date").val(),
				req_reminder_start_time:$("#txt_reminder_start_time").val(),
				req_reminder_end_time:$("#txt_reminder_start_time").val(),
				req_reminder_event_type:$("#sel_reminder_event_type").val(),
				req_reminder_event_from_date:$("#txt_reminder_event_from_date").val(),
				req_reminder_event_to_date:$("#txt_reminder_event_to_date").val(),
				req_repeat_weeks:$("#req_repeat_weeks_json").val(),
				req_repeat_months:$("#txt_repeat_months").val(),
				req_repeat_years:$("#txt_repeat_years").val(),
				req_reminder_repeat:$("#sel_reminder_repeat").val(),
				req_reminder_calendar:$("#sel_reminder_calendar").val(),
				req_patient_id:$patient_id
				
			},
			function(data)
			{
				close_loader();
					 try
						{
							//alert(data);
							$arr = JSON.parse(data);
							
							$outp ="";
						
							if($arr.result == true)
							{
									$arr_2 = JSON.parse($arr.reminder_list_json);
																
									$outp = '<div class="row guessing_item" id=""> <div class="col-lg-3"> <img src="'+$("#patient_search_result_row_"+$arr.patient_id).attr("patient_image")+'" class="img-fluid img-circle"> </div><div class="col-lg-9"><p class="label2"><span class="badge badge-secondary">'+$arr.patient_id+'</span> </p>'+$("#patient_search_result_row_"+$arr.patient_id).attr("patient_first_name")+'<br><div title="Add any way" onclick=add_patients_to_reminder("'+$arr.patient_id+'") class="btn round_btn"><span class="fa fa-plus-circle"></span></div>Add any way</div></div>';
									$outp = $outp + '<div class="alert alert-warning"><span class="fa fa-exclamation-triangle">&nbsp;</span>Already, This patient is assigned for below reminders</div>';
																		
									$outp = $outp + '<table class="table table-condenced table-bordered table-striped"><thead class="btn-light"><tr><th width="300px">Date/Time</th><th>Reminders</th><th>Type</th><th>Organizer</th></tr></thead><tbody class="small-txt">';
									
									for($i=0; $i<$arr_2.length; $i++)
									{
										$ids = $arr_2[$i].reminder_id.trim();
										$outp = $outp + '<tr class="need_hover" onclick=show_reminder_info("'+$ids+'")><td><span class="fa fa-calendar"></span> '+$arr_2[$i].reminder_start_date+' <span class="fa fa-clock"></span>  '+$arr_2[$i].reminder_start_time+' - '+$arr_2[$i].reminder_end_time+'</td><td> '+$arr_2[$i].reminder_type+'</td><td> '+$arr_2[$i].reminder_repeat+'</td><td> '+$arr_2[$i].reminder_calendar+'</td></tr>';
										
									}
									
									$outp = $outp + '</tbody></table>';	
									
									$("#disp_conflict_type").text('Reminder conflict! - Patient');
									$(".conflict_info").html($outp);
									
									$("#conflicts_modal").modal(
										{
											backdrop:"static"
										}
									);										
							}
							else
							{
								add_patients_to_reminder($patient_id);
							}
						}
						catch(ex)
						{
							alert(ex.message+" "+data);
							//$("#txt_reminder_desc_alerts").html(data);
						}
			});
		}
		close_loader();
	}
	
	
	function staff_check_date_conflict($staff_id)
	{
		open_loader();
		if($("#sel_reminder_event_type").val() == "")
		{
			toastr.error("Reminder event is empty","Error!");
			$("#sel_reminder_event_type").focus();
		}
		else if($("#txt_reminder_start_date").val() == "")
		{
			toastr.error("Start date is empty","Error!");
			$("#txt_reminder_start_date").focus();
		}
		else if($("#txt_reminder_end_date").val() == "")
		{
			toastr.error("End date is empty","Error!");
			$("#txt_reminder_end_date").focus();
		}
		else if($("#txt_reminder_start_time").val() == "")
		{
			toastr.error("Start time is empty","Error!");
			$("#txt_reminder_start_time").focus();
		}
		else if($("#txt_reminder_end_time").val() == "")
		{
			toastr.error("End time is empty","Error!");
			$("#txt_reminder_end_time").focus();
		}
		else
		{
			$.post($("#hid_base_url").val()+"index.php/core/dashboard/reminders/staff_check_date_conflict",
			{
				req_reminder_start_date:$("#txt_reminder_start_date").val(),
				req_reminder_end_date:$("#txt_reminder_end_date").val(),
				req_reminder_start_time:$("#txt_reminder_start_time").val(),
				req_reminder_end_time:$("#txt_reminder_start_time").val(),
				req_reminder_event_type:$("#sel_reminder_event_type").val(),
				req_reminder_event_from_date:$("#txt_reminder_event_from_date").val(),
				req_reminder_event_to_date:$("#txt_reminder_event_to_date").val(),
				req_repeat_weeks:$("#req_repeat_weeks_json").val(),
				req_repeat_months:$("#txt_repeat_months").val(),
				req_repeat_years:$("#txt_repeat_years").val(),
				req_reminder_repeat:$("#sel_reminder_repeat").val(),
				req_reminder_calendar:$("#sel_reminder_calendar").val(),
				req_staff_id:$staff_id
				
			},
			function(data)
			{
				close_loader();
					 	try
						{
							//alert(data);
							$arr = JSON.parse(data);
							
							$outp ="";
						
							if($arr.result == true)
							{
									$arr_2 = JSON.parse($arr.reminder_list_json);
																
									$outp = '<div class="row guessing_item" id=""> <div class="col-lg-3"> <img src="'+$("#staff_search_result_row_"+$arr.staff_id).attr("staff_image")+'" class="img-fluid img-circle"> </div><div class="col-lg-9"><p class="label2"><span class="badge badge-secondary">'+$arr.staff_id+'</span> </p>'+$("#staff_search_result_row_"+$arr.staff_id).attr("staff_first_name")+'<br><div title="Add any way" onclick=add_staffs_to_reminder("'+$arr.staff_id+'") class="btn round_btn"><span class="fa fa-plus-circle"></span></div>Add any way</div></div>';
									
									$outp = $outp + '<div class="alert alert-warning"><span class="fa fa-exclamation-triangle">&nbsp;</span>Already, This staff is assigned for below reminders</div>';
																		
									$outp = $outp + '<table class="table table-condenced table-bordered table-striped"><thead class="btn-light"><tr><th width="300px">Date/Time</th><th>Reminders</th><th>Type</th><th>Organizer</th></tr></thead><tbody class="small-txt">';									
									for($i=0; $i<$arr_2.length; $i++)
									{
										$ids = $arr_2[$i].reminder_id.trim();
										$outp = $outp + '<tr class="need_hover" onclick=show_reminder_info("'+$ids+'")><td><span class="fa fa-calendar"></span> '+$arr_2[$i].reminder_start_date+' <span class="fa fa-clock"></span>  '+$arr_2[$i].reminder_start_time+' - '+$arr_2[$i].reminder_end_time+'</td><td> '+$arr_2[$i].reminder_type+'</td><td> '+$arr_2[$i].reminder_repeat+'</td><td> '+$arr_2[$i].reminder_calendar+'</td></tr>';
										
									}
									
									$outp = $outp + '</tbody></table>';	
									
									$("#disp_conflict_type").text('Reminder conflict! - Staff');
									
									$(".conflict_info").html($outp);
									
									$("#conflicts_modal").modal(
										{
											backdrop:"static"
										}
									);										
							}
							else
							{
								add_staffs_to_reminder($staff_id);
							}
						}
						catch(ex)
						{
							alert(ex.message+" "+data);
							//$("#txt_reminder_desc_alerts").html(data);
						}
			});
		}
		close_loader();
	}
	
	
	function service_check_date_conflict($service_code)
	{
		open_loader();
		if($("#sel_reminder_event_type").val() == "")
		{
			toastr.error("Reminder event is empty","Error!");
			$("#sel_reminder_event_type").focus();
		}
		else if($("#txt_reminder_start_date").val() == "")
		{
			toastr.error("Start date is empty","Error!");
			$("#txt_reminder_start_date").focus();
		}
		else if($("#txt_reminder_end_date").val() == "")
		{
			toastr.error("End date is empty","Error!");
			$("#txt_reminder_end_date").focus();
		}
		else if($("#txt_reminder_start_time").val() == "")
		{
			toastr.error("Start time is empty","Error!");
			$("#txt_reminder_start_time").focus();
		}
		else if($("#txt_reminder_end_time").val() == "")
		{
			toastr.error("End time is empty","Error!");
			$("#txt_reminder_end_time").focus();
		}
		else
		{
			$.post($("#hid_base_url").val()+"index.php/core/dashboard/reminders/service_check_date_conflict",
			{
				req_reminder_start_date:$("#txt_reminder_start_date").val(),
				req_reminder_end_date:$("#txt_reminder_end_date").val(),
				req_reminder_start_time:$("#txt_reminder_start_time").val(),
				req_reminder_end_time:$("#txt_reminder_start_time").val(),
				req_reminder_event_type:$("#sel_reminder_event_type").val(),
				req_reminder_event_from_date:$("#txt_reminder_event_from_date").val(),
				req_reminder_event_to_date:$("#txt_reminder_event_to_date").val(),
				req_repeat_weeks:$("#req_repeat_weeks_json").val(),
				req_repeat_months:$("#txt_repeat_months").val(),
				req_repeat_years:$("#txt_repeat_years").val(),
				req_reminder_repeat:$("#sel_reminder_repeat").val(),
				req_reminder_calendar:$("#sel_reminder_calendar").val(),
				req_service_code:$service_code
				
			},
			function(data)
			{
				close_loader();
					 	try
						{
							///alert(data);
							$arr = JSON.parse(data);
							
							$outp ="";
						
							if($arr.result == true)
							{
									$arr_2 = JSON.parse($arr.reminder_list_json);
																
									$outp = '<div class="row guessing_item" id=""> <div class="col-lg-3"></div><div class="col-lg-9"><p class="label2"><span class="badge badge-secondary">'+$arr.service_code+'</span> </p>'+$("#service_search_result_row_"+$arr.service_code).attr("service_type")+'<br><div title="Add any way" onclick=add_services_to_reminder("'+$arr.service_code+'") class="btn round_btn"><span class="fa fa-plus-circle"></span></div>Add any way</div></div>';
									$outp = $outp + '<div class="alert alert-warning"><span class="fa fa-exclamation-triangle">&nbsp;</span>Already, This location is assigned for below reminders</div>';
																		
									$outp = $outp + '<table class="table table-condenced table-bordered table-striped"><thead class="btn-light"><tr><th width="300px">Date/Time</th><th>Reminders</th><th>Type</th><th>Organizer</th></tr></thead><tbody class="small-txt">';									
									for($i=0; $i<$arr_2.length; $i++)
									{
										$ids = $arr_2[$i].reminder_id.trim();
										$outp = $outp + '<tr class="need_hover" onclick=show_reminder_info("'+$ids+'")><td><span class="fa fa-calendar"></span> '+$arr_2[$i].reminder_start_date+' <span class="fa fa-clock"></span>  '+$arr_2[$i].reminder_start_time+' - '+$arr_2[$i].reminder_end_time+'</td><td> '+$arr_2[$i].reminder_type+'</td><td> '+$arr_2[$i].reminder_repeat+'</td><td> '+$arr_2[$i].reminder_calendar+'</td></tr>';
										
									}
									
									$outp = $outp + '</tbody></table>';	
									
									$("#disp_conflict_type").text('Reminder conflict! - Service');
									
									$(".conflict_info").html($outp);
									
									$("#conflicts_modal").modal(
										{
											backdrop:"static"
										}
									);										
							}
							else
							{
								add_services_to_reminder($service_code);
							}
						}
						catch(ex)
						{
							alert(ex.message+" "+data);
							//$("#txt_reminder_desc_alerts").html(data);
						}
			});
		}
		close_loader();
	}
	
	function delete_reminder($reminder_id)
	{
		if(window.confirm("Are you sure to delete that calendar?"))
		{
			$.post($("#hid_base_url").val()+"index.php/core/dashboard/reminders/delete",
			{
				req_reminder_id:$reminder_id
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
								toastr.success($arr.msg,"Deleted!");
								//window.location.replace($("#hid_base_url").val()+"index.php/dashboard/front_desk");
								$("#reminder_info_modal").modal("hide");
							}
							else 
							{
								toastr.error($arr.msg,"Warning!");
							}
							
							calendar_show();
				}
				catch(err)
				{
					alert("EXCEPTION : "+err.message);
				}
			});
		}
		
	}
	
	
	function add_patients($patient_id)
	{
		//alert($patient_id);
		patient_check_date_conflict($patient_id);
	}
	
	//add_staffs
	function add_staffs($staff_id)
	{
		//alert($staff_id);
		staff_check_date_conflict($staff_id);
	}
	
	function add_staffs_to_reminder($staff_id)
	{
		if(!check_duplicate_staff($staff_id)) 
		{
		    try
			{
				staffs.push({
						"staff_id":$staff_id, 
						"staff_image":$("#staff_search_result_row_"+$staff_id).attr("staff_image"),
						"staff_first_name":$("#staff_search_result_row_"+$staff_id).attr("staff_first_name"),
						"staff_last_name":$("#staff_search_result_row_"+$staff_id).attr("staff_last_name"),
						"staff_role":$("#staff_search_result_row_"+$staff_id).attr("staff_role")
						});
				
				//alert(JSON.stringify(patients));
				$("#hid_reminder_staffs_list").val(JSON.stringify(staffs));
				toastr.success("staff added to reminder","Added");
				show_added_staffs();
			}
			catch(err)
			{
				alert("EXCEPTION "+err.message);
			}
		}
		else
		{
			toastr.warning("Staff alredy added","Warning!");
		}
	}
	
	function add_location()
	{
		toastr.success("Location is added to reminder","Success");
	}
	
	//add_doctors
	function add_doctors($doctor_id)
	{
		//alert($doctor_id);
		doctor_check_date_conflict($doctor_id);
	}
	
	//add_doctors
	function add_service($service_code)
	{
		//alert($doctor_id);
		service_check_date_conflict($service_code);
	}
	
	function add_services_to_reminder($service_code)
	{
		if(!check_duplicate_service($service_code)) 
		{
		try
			{
				services.push({
						"service_code":$("#service_search_result_row_"+$service_code).attr("service_code"), 
						"service_type":$("#service_search_result_row_"+$service_code).attr("service_type")
						});
				
				//alert(JSON.stringify(patients));
				$("#hid_reminder_services_list").val(JSON.stringify(services));
				toastr.success("Service added to reminder","Added");
				//alert($("#hid_reminder_services_list").val());
				show_added_services();
			}
			catch(err)
			{
				alert("EXCEPTION "+err.message);
			}
		}
		else
		{
			toastr.warning("Doctor alredy added","Warning!");
		}
	}
	
	function check_duplicate_patient($patient_id)
	{
			
			$has_duplicate = false;
			if($("#hid_reminder_patients_list").val() != "")
			{
				try
				{
					$arr = JSON.parse($("#hid_reminder_patients_list").val());
					
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
	
	
	function check_duplicate_doctor($doctor_id)
	{
			
			$has_duplicate = false;
			if($("#hid_reminder_doctors_list").val() != "")
			{
				try
				{
					$arr = JSON.parse($("#hid_reminder_doctors_list").val());
					
					for($i = 0; $i<$arr.length; $i++)
					{
						if($arr[$i].doctor_id == $doctor_id)
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
	
	
	function check_duplicate_staff($staff_id)
	{
			
			$has_duplicate = false;
			if($("#hid_reminder_staffs_list").val() != "")
			{
				try
				{
					$arr = JSON.parse($("#hid_reminder_staffs_list").val());
					
					for($i = 0; $i<$arr.length; $i++)
					{
						if($arr[$i].staff_id == $staff_id)
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
	
	
	function check_duplicate_service($service_code)
	{
			
			$has_duplicate = false;
			if($("#hid_reminder_services_list").val() != "")
			{
				try
				{
					$arr = JSON.parse($("#hid_reminder_services_list").val());
					
					for($i = 0; $i<$arr.length; $i++)
					{
						if($arr[$i].service_code == $service_code)
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
	
	
	function show_added_patients()
	{
		if($("#hid_reminder_patients_list").val() != "")
		{
			try
			{
				$arr = JSON.parse($("#hid_reminder_patients_list").val());
				$outp = "";
				for($i = 0; $i<$arr.length; $i++)
				{
					if($arr[$i].patient_id != "")
					{
						$outp = $outp + '<div class="need_hover guessing_item shadow_sm"> <img src="'+$arr[$i].patient_image+'" width="50px"/> <span class="badge badge-secondary">'+$arr[$i].patient_id+'</span> <span class="">'+$arr[$i].patient_first_name+'</span> &nbsp;<span class="fa fa-times need_hover text-danger float-right" title="Remove from reminder" onclick=remove_patients_from_reminder("'+$arr[$i].patient_id+'")></span></div>';
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
	
	/*
	<span id="conflict_of_'+$arr[$i].patient_id+'" onclick = "show_participants_reminder("'+$arr[$i].patient_id+'")" class="small_txt text-danger"><span class="fa fa-exclamation-triangle">&nbsp;</span>2 conflicts</span>
	*/
	
	function show_added_staffs()
	{
		if($("#hid_reminder_staffs_list").val() != "")
		{
			try
			{
				$arr = JSON.parse($("#hid_reminder_staffs_list").val());
				$outp = "";
				for($i = 0; $i<$arr.length; $i++)
				{
					if($arr[$i].staff_id != "")
					{
						$outp = $outp + '<div class="need_hover guessing_item shadow_sm"> <img src="'+$arr[$i].staff_image+'" width="50px"/> <span class="badge badge-secondary">'+$arr[$i].staff_id+'</span> <span class="">'+$arr[$i].staff_first_name+' '+$arr[$i].staff_last_name+'</span> &nbsp; <span class="fa fa-times need_hover text-danger float-right" title="Remove from reminder" onclick=remove_staffs_from_reminder("'+$arr[$i].staff_id+'")></span></div>';
					}
				}
				
				$("#reminder_staffs_list").html($outp);
			}
			catch(err)
			{
				alert("EXCEPTION "+err.message);
			}
		}
	}
	
	
	function show_added_doctors()
	{
		if($("#hid_reminder_doctors_list").val() != "")
		{
			try
			{
				$arr = JSON.parse($("#hid_reminder_doctors_list").val());
				$outp = "";
				for($i = 0; $i<$arr.length; $i++)
				{
					if($arr[$i].doctor_id != "")
					{
						$outp = $outp + '<div class="need_hover guessing_item shadow_sm"> <img src="'+$arr[$i].doctor_image+'" width="50px"/> <span class="badge badge-secondary">'+$arr[$i].doctor_id+'</span> <span class="">'+$arr[$i].doctor_first_name+'</span> &nbsp; <span class="fa fa-times need_hover text-danger float-right" title="Remove from reminder" onclick=remove_doctors_from_reminder("'+$arr[$i].doctor_id+'")></span></div>';
					}
				}
				
				$("#reminder_doctors_list").html($outp);
			}
			catch(err)
			{
				alert("EXCEPTION "+err.message);
			}
		}
	}
	
	
	function show_added_services()
	{
		if($("#hid_reminder_services_list").val() != "")
		{
			//alert("ok");
			try
			{
				$arr = JSON.parse($("#hid_reminder_services_list").val());
				$outp = "";
				for($i = 0; $i<$arr.length; $i++)
				{
					if($arr[$i].service_code != "")
					{
						$outp = $outp + '<div class="need_hover guessing_item shadow_sm"> <span class="">'+$arr[$i].service_code+' - '+$arr[$i].service_type+'</span> &nbsp; <span class="fa fa-times need_hover text-danger float-right" title="Remove from reminder" onclick=remove_services_from_reminder("'+$arr[$i].service_code+'")></span></div>';
					}
				}
				//alert($outp);
				$("#reminder_services_list").html($outp);
			}
			catch(err)
			{
				alert("EXCEPTION "+err.message);
			}
		}
	}
	
	function remove_patients_from_reminder($patient_id)
	{
		if(findObjectByKey(patients,"patient_id",$patient_id) != null)
		{
			//alert(patients[findObjectByKey(patients,"patient_id",$patient_id)].patient_id);
			patients[findObjectByKey(patients,"patient_id",$patient_id)].patient_id = "";
			$("#hid_reminder_patients_list").val(JSON.stringify(patients));
			//alert(patients[findObjectByKey(patients,"patient_id",$patient_id)].patient_id);
		}
		
		show_added_patients();
	}
	
	function remove_staffs_from_reminder($staff_id)
	{
		//alert(staffs[findObjectByKey(staffs,"staff_id",$staff_id)].staff_id);
		if(findObjectByKey(staffs,"staff_id",$staff_id) != null)
		{
			
			staffs[findObjectByKey(staffs,"staff_id",$staff_id)].staff_id = "";
			$("#hid_reminder_staffs_list").val(JSON.stringify(staffs));
			//alert(patients[findObjectByKey(patients,"patient_id",$patient_id)].patient_id);
		}
		
		show_added_staffs();
	}
	
	function remove_doctors_from_reminder($doctor_id)
	{
		if(findObjectByKey(doctors,"doctor_id",$doctor_id) != null)
		{
			
			doctors[findObjectByKey(doctors,"doctor_id",$doctor_id)].doctor_id = "";
			$("#hid_reminder_doctors_list").val(JSON.stringify(doctors));
			//alert(patients[findObjectByKey(patients,"patient_id",$patient_id)].patient_id);
		}
		
		show_added_doctors();
	}
	
	
	function remove_services_from_reminder($service_code)
	{
		if(findObjectByKey(services,"service_code",$service_code) != null)
		{
			services[findObjectByKey(services,"service_code",$service_code)].service_code = "";
			$("#hid_reminder_services_list").val(JSON.stringify(services));
			//alert(patients[findObjectByKey(patients,"patient_id",$patient_id)].patient_id);
		}
		
		show_added_services();
	}
	
	function add_new_reminder()
	{
		$("#add_new_reminder_modal").modal(
		{
			backdrop:"static",
			keypressed:false
		});
	};

	
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
	
	//function clear form
	function clear_form()
	{
		$("#reminder_save_form")[0].reset();
			patients = [];
			staffs = [];
			doctors = [];
			services = [];
			reminder_json = "[{}]";
	}
</script>
<script src="<?php echo $this->config->item("rest_server_url");?>assets/analog_clock/js/jquery.thooClock.js"></script> 
<script language="javascript">
	var intVal, myclock;

	$(window).resize(function(){
		//window.location.reload()
	});

	$(document).ready(function(){

		var audioElement = new Audio("");

		//clock plugin constructor
		$('#myclock').thooClock({
			size:250,
			onAlarm:function(){
				//all that happens onAlarm
				$('#alarm1').show();
				alarmBackground(0);
				//audio element just for alarm sound
				document.body.appendChild(audioElement);
				var canPlayType = audioElement.canPlayType("audio/ogg");
				if(canPlayType.match(/maybe|probably/i)) {
					audioElement.src = 'alarm.ogg';
				} else {
					audioElement.src = 'alarm.mp3';
				}
				// erst abspielen wenn genug vom mp3 geladen wurde
				audioElement.addEventListener('canplay', function() {
					audioElement.loop = true;
					audioElement.play();
				}, false);
			},
			showNumerals:true,
			brandText:'',
			brandText2:'',
			onEverySecond:function(){
				//callback that should be fired every second
			},
			//alarmTime:'15:10',
			offAlarm:function(){
				$('#alarm1').hide();
				audioElement.pause();
				clearTimeout(intVal);
				$('body').css('background-color','#FCFCFC');
			}
		});

	});



	$('#turnOffAlarm').click(function(){
		$.fn.thooClock.clearAlarm();
	});


	$('#set').click(function(){
		var inp = $('#altime').val();
		$.fn.thooClock.setAlarm(inp);
	});

	
	function alarmBackground(y){
			var color;
			if(y===1){
				color = '#CC0000';
				y=0;
			}
			else{
				color = '#FCFCFC';
				y+=1;
			}
			$('body').css('background-color',color);
			intVal = setTimeout(function(){alarmBackground(y);},100);
	}
</script>
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-36251023-1']);
  _gaq.push(['_setDomainName', 'jqueryscript.net']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
</section>
<input type="hidden" id="hid_temp_outp" value=""/>

<div class="modal fade" data-backdrop-limit="5" id="conflicts_modal" style="z-index:1800" backdrop="static" keypressed="false" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content col-lg-12">
      <div class="modal-header">
        <h5 class="modal-title text-danger" id="exampleModalLabel"><span class="fa fa-exclamation-triangle"></span> <span id="disp_conflict_type"></span></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
      <div class="modal-body">
      	 <div class="conflict_info">
         	<div class="begin_to_load text-center">
            	<h1>
            		<span class="fa fa-sync-alt fa-spin"></span>
                </h1>
            </div>
         </div>
      </div>
      
      <div class="modal-footer">
       <button  type="button" class="btn btn-light" data-dismiss="modal"><span class="fa fa-times">&nbsp;</span>Cancel</button>
      </div>
      
    </div>
  </div>
</div>


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
      	 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-light" data-dismiss="modal"><span class="fa fa-times">&nbsp;</span>Cancel</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" data-backdrop-limit="1" id="add_new_reminder_modal" style="z-index:1500" backdrop="static" keypressed="false" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content col-lg-12">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add new reminder</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="reminder_save_form">
      <div class="modal-body">
      	 <div class="row">
         	
            <div class="col-lg-6 text-center">
            	<p align="center">
       		  <div id="myclock" style="width:250px; height:250px; text-align:center"></div>
                </p>
                	 	 	<div class="btn round_btn" title="Previous" onclick="calendar_navigation_left()">
                            	<span class="fa fa-arrow-left"></span>
                            </div>
                            <div class="btn round_btn" title="Yesterday" onclick="calendar_navigation_right()">
                                <span class="fa fa-arrow-right"></span>
                            </div>
                            <div class="btn round_btn" title="<?php echo date('m/d/Y l');?>" onclick="calendar_navigation_today()">
                                <span class="font-weight-bold"><?php echo date('d');?></span>
                            </div>
                            <div class="btn round_btn" title="List view" onclick="list_view()">
                                <span class="fa fa-list"></span>
                            </div>
                            <div class="btn round_btn" title="Month view" onclick="table_view()">
                                <span class="fa fa-table"></span>
                            </div>
                    <div class="text-center show_calendar view" style="overflow:auto">
                    </div>
            </div>
            <div class="col-lg-6">
            
            	<input type="hidden" id="hid_frm_mode" name="req_frm_mode" value="insert"/>
            	<input type="hidden" id="hid_reminder_id" name="req_reminder_id" />
             
            	<p class="label2">*Choose calendar</p>
              <select class="form-control" id="sel_reminder_calendar" name="req_reminder_calendar" style="height:43px" required="required">
                	<option value="<?php echo $_SESSION[$this->config->item("sess_cookie_name")]["staff_username"]?>">My Calendar</option>
                </select>
                
            	<p class="label2">*Reminder type or subject&nbsp; <a href="#" data-trigger="focus" title="Info" data-container="body" data-toggle="popover" data-placement="top" data-content="Reminder type or subject is displayed in calender view"><span class="fa fa-info-circle need_hover"></span></a></p>
                <input type="text" id="txt_reminder_type" name="req_reminder_type" style="width:250px;" class="form-control reminder_type text-capitalize" required="required" />
                               
                                
                
                <p class="label2">*Choose reminder event type</p>
                <select class="form-control" id="sel_reminder_event_type" name="req_reminder_event_type" style="height:43px" required>
                	<option value="">Choose</option>
                	<option value="full_day">Full day</option>
                    <option value="customize">Customize</option>
                </select>
                
                <p class="label2">*Repeat event</p>
                <select class="form-control" id="sel_reminder_repeat" name="req_reminder_repeat" style="height:43px" required>
                	<option value="">Choose</option>
                	<option value="No">Regular</option>
                	<option value="Daily">Daily</option>
                    <option value="Weekly">Weekly</option>
                    <option value="Monthly">Monthly</option>
                    <option value="Yearly">Yearly</option>
                </select>
                
                <p class="label2">*Reminder starts on</p>
                
                <span class="fa fa-calendar reminder_date"></span>
                <input type="text"  class="form-control need_datepicker reminder_date" id="txt_reminder_start_date" name="req_reminder_start_date" value="<?php echo $date;?>" style="display:inline; width:100px; margin:0px 5px 0px 5px" readonly="readonly" />
                <span class="fa fa-clock">&nbsp;</span>  
                <input type="text" class="form-control need_timepicker" id="txt_reminder_start_time" name="req_reminder_start_time" value="<?php echo $time;?>" style="display:inline; width:100px; margin:0px 5px 0px 5px" readonly="readonly"/>
                <span class="full_day_disp" style="display:none">12:00 AM</span>
                             
                <p class="label2">*Reminder ends on</p>
                <span class="fa fa-calendar reminder_date"></span>
                <input type="text" class="form-control need_datepicker reminder_date" id="txt_reminder_end_date" name="req_reminder_end_date" value="<?php echo $date;?>" style="display:inline; width:100px; margin:0px 5px 0px 5px" readonly="readonly"/>
                
                <span class="fa fa-clock">&nbsp;</span>  
                <input type="text" class="form-control need_timepicker" id="txt_reminder_end_time" name="req_reminder_end_time" value="<?php echo $time;?>" style="display:inline; width:100px; margin:0px 5px 0px 5px" readonly="readonly"/>
                <span class="full_day_disp" style="display:none">11:59 PM</span>
                           
                <!--daily-->
                <div class="repeat_event_section" style="display:none">
                	<span class="weekly_repeat_section">
                        <p class="label2">*Choose Weeks</p>
                        <label class="checkbox repeat_weeks"><input id="chkb_mon" name="req_repeat_weeks[]" type="checkbox" value="1"> Mon</label>
                        <label class="checkbox repeat_weeks"><input id="chkb_tue" name="req_repeat_weeks[]" type="checkbox" value="2"> Tue</label>
                        <label class="checkbox repeat_weeks"><input id="chkb_wed" name="req_repeat_weeks[]" type="checkbox" value="3"> Wed</label>
                        <label class="checkbox repeat_weeks"><input id="chkb_thu" name="req_repeat_weeks[]" type="checkbox" value="4"> Thu</label>                
                        <label class="checkbox repeat_weeks"><input id="chkb_fri" name="req_repeat_weeks[]" type="checkbox" value="5"> Fri</label>
                        <label class="checkbox repeat_weeks"><input id="chkb_sat" name="req_repeat_weeks[]" type="checkbox" value="6"> Sat</label>
                        <label class="checkbox repeat_weeks"><input id="chkb_sun" name="req_repeat_weeks[]" type="checkbox" value="0"> Sun</label>
                        <input type="hidden" id="req_repeat_weeks_json" value=" "/>
                        
                    </span>
          
                  	<span class="monthly_repeat_section">
                        <p class="label2">*Choose Months</p>
                        <input type="text" id="txt_repeat_months" class="form-control need_monthpicker" name="req_repeat_months"  readonly="readonly"/>
                    </span>
                    
                    <span class="yearly_repeat_section">
                        <p class="label2">*Choose Years</p>
                        <input type="text" id="txt_repeat_years" class="form-control need_yearpicker" name="req_repeat_years"  readonly="readonly"/>
                    </span>
                    
                    <span class="reminder_limit_date">
                    <p class="label2">*Reminder limit</p>
                    
                    From : <input type="text"  class="form-control need_datepicker" id="txt_reminder_event_from_date" name="req_reminder_limit_from_date" onchange=$("#txt_reminder_event_to_date").val($(this).val()) value="<?php echo $date;?>" style="display:inline; width:100px; margin:0px 5px 0px 5px" readonly="readonly" />
                    To : <input type="text"  class="form-control need_datepicker" id="txt_reminder_event_to_date" name="req_reminder_limit_to_date" value="<?php echo $date;?>" style="display:inline; width:100px; margin:0px 5px 0px 5px" readonly="readonly" />
                    <label class="checkbox-inline d-none" style="float:right; margin-right:55px;"><input id="chkb_inifinite" type="checkbox" value=""> Infinite</label>
                    </span>
                   
                </div>
                <!--daily-->
                
                
            
                <p class="label2">Patient</p>
                <input type="hidden" id="hid_reminder_patients_list" name="req_reminder_patients_json" value="[{}]" />
                <div class="btn btn-light btn-block patient_picker text-left"><span class="fa fa-plus-circle">&nbsp;</span>Add Patients</div>
                <div id="reminder_patients_list" class="">
                </div>
                
                <p class="label2">Staff</p>
                <input type="hidden" id="hid_reminder_staffs_list" name="req_reminder_staffs_json" value="[{}]" />
                <div class="btn btn-light btn-block staff_picker text-left"><span class="fa fa-plus-circle">&nbsp;</span>Add Staffs</div>
                <div id="reminder_staffs_list" class="">
                </div>
                
                <p class="label2">Doctors</p>
                <input type="hidden" id="hid_reminder_doctors_list" name="req_reminder_doctors_json" value="[{}]" />
                <div class="btn btn-light btn-block doctor_picker text-left"><span class="fa fa-plus-circle">&nbsp;</span>Add Doctors</div>
                
                <div id="reminder_doctors_list" class="">
                </div>
               
                <p class="label2">Services</p>
                <input type="hidden" id="hid_reminder_services_list" name="req_reminder_services_json" value="[{}]"/>
                <div class="btn btn-light btn-block service_picker text-left"><span class="fa fa-plus-circle">&nbsp;</span>Add Services</div>
                <div id="reminder_services_list" class="">
                </div>
 
                <p class="label2">*Location <a href="#" data-trigger="focus" title="Info" data-container="body" data-toggle="popover" data-placement="top" data-content="Location = Room"><span class="fa fa-info-circle need_hover"></span></a></p>
                <input type="text" id="txt_reminder_location" name="req_reminder_location" class="form-control locations" style="width:250px;" required="required"/>
               
                <p class="label2">Description for alert</p>
                <textarea class="form-control" id="txt_reminder_desc_alerts" name="req_reminder_desc_alert"></textarea>
                
                <p class="label2">&nbsp;</p>
                
                <button type="submit" class="d-none" id="btn_save_reminder"></button>
                
                <button onclick=$("#reminder_save_form")[0].reset() type="button" class="btn btn-light" data-dismiss="modal"><span class="fa fa-times">&nbsp;</span>Cancel</button>
                <button onclick=$("#reminder_save_form")[0].reset() type="button" class="btn btn-light"><span class="fa fa-redo">&nbsp;</span>Reset</button>
                <button onclick=$("#btn_save_reminder").click() type="button" class="btn btn-light"><span class="fa fa-save">&nbsp;</span>Save</button>
              
            </div>
            
         </div>
      </div>
      </form>
      <div class="modal-footer">
       <button onclick=$("#reminder_save_form")[0].reset() type="button" class="btn btn-light" data-dismiss="modal"><span class="fa fa-times">&nbsp;</span>Cancel</button>
        <button onclick=$("#reminder_save_form")[0].reset() type="button" class="btn btn-light"><span class="fa fa-redo">&nbsp;</span>Reset</button>
        <button onclick=$("#btn_save_reminder").click() type="button" class="btn btn-light"><span class="fa fa-save">&nbsp;</span>Save</button>
      </div>
    </div>
  </div>
</div>
<!--patient account-->