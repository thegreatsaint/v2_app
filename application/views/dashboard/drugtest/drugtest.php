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

<link rel="stylesheet" href="<?php echo $this->config->item("rest_server_url");?>assets/moris/moris.css">
<script src="<?php echo $this->config->item("rest_server_url");?>assets/moris/rephael.js"></script>
<script src="<?php echo $this->config->item("rest_server_url");?>assets/moris/moris.min.js"></script>

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
                    	<img src="<?php echo $this->config->item("rest_server_url");?>assets/images/icons/drugtest.png" width="50px" /><span class="font-weight-bold">&nbsp;<?php echo $page_title;?>
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
                	<img src="<?php echo $this->config->item("rest_server_url");?>assets/images/icons/drugtest.png" width="120px"/>
                </p>
               
               	<?php
								if(($rights == "full") || ($rights == "write"))
								{
							?>
                <div class="btn btn-light btn-block" onclick=add_new_drugtest()>
                	<span class="fa fa-plus-circle">&nbsp;</span>Add new
                </div>
                <?php
								}
								?>
             </div> 
             
              <!--<p class="label2 text-center"><span class="fa fa-paint-brush"></span> Event colors</p>
              <div class="alert shadow-sm">
             		<div class="badge badge-primary d-block">Normal</div>
                    <div class="badge badge-secondary d-block">Daily</div>
                    <div class="badge badge-success d-block">Weekly</div>
                    <div class="badge badge-warning d-block">Monthly</div>
                    <div class="badge badge-dark d-block">Yearly</div>
             </div>-->      	
        </div>
    </div>
    <div class="col-lg-9">
    	<div id="view">
        	<div class="alert shadow-sm">
            	<div class="row">
                	<div class="col-sm-4" style="">
            			<div class="input-group mb-3">
                          <input id="txt_drugtest_search_key_word" type="text" class="form-control" placeholder="Search patient id" aria-label="Search patient id" aria-describedby="button-addon2">
                          <div class="input-group-append">
                            <button class="btn btn-outline-secondary" onclick="drugtest_view()" type="button" id="button-addon2">
                            	<span class="fa fa-search"></span>
                            </button>
                          </div>
                        </div>
                	</div>
                    
                    <div class="col-sm-3" style="">
            			<div class="input-group mb-3">
                          <input id="txt_drugtest_search_date" type="text" onchange="drugtest_view()" class="form-control need_datepicker" placeholder="Date" aria-label="Search" aria-describedby="button-addon2" value="">
                          <div class="input-group-append">
                            <button class="btn btn-outline-secondary" onclick="drugtest_view()" type="button" id="button-addon2">
                            	<span class="fa fa-calendar"></span>
                            </button>
                          </div>
                        </div>
                	</div>
                    
                    <div class="col-sm-2" style="">
            			<div class="input-group mb-3">
                          <input id="txt_drugtest_view_limit" title="Show limit" onchange="drugtest_view()" type="number" class="form-control" placeholder="show" aria-label="Search" min="50" onkeydown="return false" step="50" aria-describedby="button-addon2" value="100" />
                        </div>
                	</div>
                </div>
                
                <div class="row">
                	<div class="col-sm-12 drugtest_graph" style="display:none;">
                    	<div id="drugtest_graph" style="height:300px;"></div>
                        <h1>&nbsp;</h1>
                    </div>
                </div>
               
            </div>
           
           	<div class="">       
        		<div class="alert shadow-sm show_calendar drugtest_view" style="overflow:auto;"></div>
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
		
		patient_search_view();
		staff_search_view();
		drugtest_view();

		$("#drugtest_save_form").submit(
		function(e)
		{	
		 	try
			 {
				 e.preventDefault();
				 $.ajax(
				 {
					url: $("#hid_base_url").val()+"index.php/core/dashboard/drugtest/add_new",
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
							//salert(data);
							data = data.trim();
							$arr = JSON.parse(data);
							
							if($arr.result == true)
							{
								$("#drugtest_save_form")[0].reset();
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
		
		
		$("#file_drugtest_attachements").change(
		function(e)
		{
			//alert(e.target.files[0].type);
			$allowed_size = 2000;//kb
					
			$src = e.target.files[0].path;
			$type = e.target.files[0].type;
			$size = Math.round(e.target.files[0].size/1024);
			$file_name = e.target.files[0].name;
			$file_info = "<br>"+$file_name +" <br> "+$type+" <br> "+$size+" <br> "+$src;
			
			if($src == "")
			{
				toastr.info("Your image file does not choose");
				$(this).val("");
			}
			else if($size > $allowed_size)
			{
				toastr.error("Your file size is "+$size+"KB, only allowed below "+$allowed_size+"KB","Error!");
				$(this).val("");
			}
			else if($file_name == "")
			{
				toastr.error("file name error","Error!");
				$(this).val("");
			}
			else
			{
				toastr.info("Your file accepted","Info!");
				readURL(this);
			}					
		});
	});
	
	function drugtest_view()
	{
			open_loader();
			$.post($("#hid_base_url").val()+"index.php/core/dashboard/drugtest/view",
			{
				req_search_key_word:$("#txt_drugtest_search_key_word").val(),
				req_view_limit:$("#txt_drugtest_view_limit").val(),
				req_search_date:$("#txt_drugtest_search_date").val()
			},
			function(data)
			{
				close_loader();
				//alert(data);
				//$("body").append(data);
				try
				{
					//alert(data);
					data = data.trim();
					$arr = JSON.parse(data);
					
					$outp='<table class="table table-bordered table-hover table-striped"><thead class="btn-light"><tr><th>Tasks</th><th>Date</th><th>Patient</th> <th>Staffs</th><th>Drugtest type</th><th>Results</th><th>info</th></tr></thead> <tbody class="small-txt">';
					
					for($i=0; $i<$arr.length; $i++)
					{
						if($arr[$i].result == true)
						{
							<?php
								if(($rights == "full") || ($rights == "write"))
								{
							?>
							if($arr[$i].drugtest_result == '+ve')
							{	
							
							$outp = $outp + '<tr id="drugtest_row_'+$arr[$i].auto_id_0+'"><td><div class="btn round_btn"   title="Delete" onclick=delete_drugtest("'+$arr[$i].auto_id_0+'")><span class="fa fa-trash"></span></div><div class="btn round_btn"   title="Print" onclick=print_drugtest("'+$arr[$i].drugtest_patient_id+'")><span class="fa fa-print"></span></div><div id="" title="Graph" onclick=show_drugtest_graph("'+$arr[$i].drugtest_patient_id+'") class="round_btn"><span class="fa fa-chart-area"></span></div><a href="'+$arr[$i].drugtest_attachments+'" download><div class="btn round_btn"  title="Attachments" onclick=download_attachments("'+$arr[$i].auto_id_0+'")><span class="fa fa-paperclip"></span></div></a></td><td>'+$arr[$i].drugtest_date+'</td><td>'+$arr[$i].drugtest_patient+'</td> <td>'+$arr[$i].drugtest_staff+'</td><td>'+$arr[$i].drugtest_type+'</td><td><span class="badge badge-success">'+$arr[$i].drugtest_result+'</span></td><td>'+$arr[$i].drugtest_notes+'<div class=""><span class="fa fa-user">&nbsp;</span>'+$arr[$i].created_by+'</div><div class=""><span class="fa fa-clock">&nbsp;</span>'+$arr[$i].created_at+'</div></td></tr>';
							
							}
							else if($arr[$i].drugtest_result == '-ve')
							{
									
							$outp = $outp + '<tr id="drugtest_row_'+$arr[$i].auto_id_0+'"><td><div class="btn round_btn"   title="Delete" onclick=delete_drugtest("'+$arr[$i].auto_id_0+'")><span class="fa fa-trash"></span></div><div class="btn round_btn"   title="Print" onclick=print_drugtest("'+$arr[$i].drugtest_patient_id+'")><span class="fa fa-print"></span></div><div id="" title="Graph" onclick=show_drugtest_graph("'+$arr[$i].drugtest_patient_id+'") class="round_btn"><span class="fa fa-chart-area"></span></div><a href="'+$arr[$i].drugtest_attachments+'" download><div class="btn round_btn"  title="Attachments" onclick=download_attachments("'+$arr[$i].auto_id_0+'")><span class="fa fa-paperclip"></span></div></a></td><td>'+$arr[$i].drugtest_date+'</td><td>'+$arr[$i].drugtest_patient+'</td> <td>'+$arr[$i].drugtest_staff+'</td><td>'+$arr[$i].drugtest_type+'</td><td><span class="badge badge-danger">'+$arr[$i].drugtest_result+'</span></td><td>'+$arr[$i].drugtest_notes+'<div class=""><span class="fa fa-user">&nbsp;</span>'+$arr[$i].created_by+'</div><div class=""><span class="fa fa-clock">&nbsp;</span>'+$arr[$i].created_at+'</div></td></tr>';
							
							}
							else
							{
								
							$outp = $outp + '<tr id="drugtest_row_'+$arr[$i].auto_id_0+'"><td><div class="btn round_btn"   title="Delete" onclick=delete_drugtest("'+$arr[$i].auto_id_0+'")><span class="fa fa-trash"></span></div><div class="btn round_btn"   title="Print" onclick=print_drugtest("'+$arr[$i].drugtest_patient_id+'")><span class="fa fa-print"></span></div><div id="" title="Graph" onclick=show_drugtest_graph("'+$arr[$i].drugtest_patient_id+'") class="round_btn"><span class="fa fa-chart-area"></span></div><a href="'+$arr[$i].drugtest_attachments+'" download><div class="btn round_btn"  title="Attachments" onclick=download_attachments("'+$arr[$i].auto_id_0+'")><span class="fa fa-paperclip"></span></div></a></td><td>'+$arr[$i].drugtest_date+'</td><td>'+$arr[$i].drugtest_patient+'</td> <td>'+$arr[$i].drugtest_staff+'</td><td>'+$arr[$i].drugtest_type+'</td><td><span class="badge badge-warning">'+$arr[$i].drugtest_result+'</span></td><td>'+$arr[$i].drugtest_notes+'<div class=""><span class="fa fa-user">&nbsp;</span>'+$arr[$i].created_by+'</div><div class=""><span class="fa fa-clock">&nbsp;</span>'+$arr[$i].created_at+'</div></td></tr>';
							
							}
							<?php
								}
								else
								{
								?>
							if($arr[$i].drugtest_result == '+ve')
							{	
							
							$outp = $outp + '<tr id="drugtest_row_'+$arr[$i].auto_id_0+'"><td><div class="btn round_btn"   title="Print" onclick=print_drugtest("'+$arr[$i].drugtest_patient_id+'")><span class="fa fa-print"></span></div><div id="" title="Graph" onclick=show_drugtest_graph("'+$arr[$i].drugtest_patient_id+'") class="round_btn"><span class="fa fa-chart-area"></span></div><a href="'+$arr[$i].drugtest_attachments+'" download><div class="btn round_btn"  title="Attachments" onclick=download_attachments("'+$arr[$i].auto_id_0+'")><span class="fa fa-paperclip"></span></div></a></td><td>'+$arr[$i].drugtest_date+'</td><td>'+$arr[$i].drugtest_patient+'</td> <td>'+$arr[$i].drugtest_staff+'</td><td>'+$arr[$i].drugtest_type+'</td><td><span class="badge badge-success">'+$arr[$i].drugtest_result+'</span></td><td>'+$arr[$i].drugtest_notes+'<div class=""><span class="fa fa-user">&nbsp;</span>'+$arr[$i].created_by+'</div><div class=""><span class="fa fa-clock">&nbsp;</span>'+$arr[$i].created_at+'</div></td></tr>';
							
							}
							else if($arr[$i].drugtest_result == '-ve')
							{
									
							$outp = $outp + '<tr id="drugtest_row_'+$arr[$i].auto_id_0+'"><td><div class="btn round_btn"   title="Print" onclick=print_drugtest("'+$arr[$i].drugtest_patient_id+'")><span class="fa fa-print"></span></div><div id="" title="Graph" onclick=show_drugtest_graph("'+$arr[$i].drugtest_patient_id+'") class="round_btn"><span class="fa fa-chart-area"></span></div><a href="'+$arr[$i].drugtest_attachments+'" download><div class="btn round_btn"  title="Attachments" onclick=download_attachments("'+$arr[$i].auto_id_0+'")><span class="fa fa-paperclip"></span></div></a></td><td>'+$arr[$i].drugtest_date+'</td><td>'+$arr[$i].drugtest_patient+'</td> <td>'+$arr[$i].drugtest_staff+'</td><td>'+$arr[$i].drugtest_type+'</td><td><span class="badge badge-danger">'+$arr[$i].drugtest_result+'</span></td><td>'+$arr[$i].drugtest_notes+'<div class=""><span class="fa fa-user">&nbsp;</span>'+$arr[$i].created_by+'</div><div class=""><span class="fa fa-clock">&nbsp;</span>'+$arr[$i].created_at+'</div></td></tr>';
							
							}
							else
							{
								
							$outp = $outp + '<tr id="drugtest_row_'+$arr[$i].auto_id_0+'"><td><div class="btn round_btn"   title="Print" onclick=print_drugtest("'+$arr[$i].drugtest_patient_id+'")><span class="fa fa-print"></span></div><div id="" title="Graph" onclick=show_drugtest_graph("'+$arr[$i].drugtest_patient_id+'") class="round_btn"><span class="fa fa-chart-area"></span></div><a href="'+$arr[$i].drugtest_attachments+'" download><div class="btn round_btn"  title="Attachments" onclick=download_attachments("'+$arr[$i].auto_id_0+'")><span class="fa fa-paperclip"></span></div></a></td><td>'+$arr[$i].drugtest_date+'</td><td>'+$arr[$i].drugtest_patient+'</td> <td>'+$arr[$i].drugtest_staff+'</td><td>'+$arr[$i].drugtest_type+'</td><td><span class="badge badge-warning">'+$arr[$i].drugtest_result+'</span></td><td>'+$arr[$i].drugtest_notes+'<div class=""><span class="fa fa-user">&nbsp;</span>'+$arr[$i].created_by+'</div><div class=""><span class="fa fa-clock">&nbsp;</span>'+$arr[$i].created_at+'</div></td></tr>';
							
							}		
							
							<?php
								}
								?>
						}
					}
					
					$outp = $outp + '</tbody></table>';
					$(".drugtest_view").html($outp);
				}
				catch(err)
				{
					alert("EXCEPTION:"+err.message);
				}
			});
	}

	function delete_drugtest($auto_id_0)
	{
		if(window.confirm("Are you sure to delete that calendar?"))
		{
			$.post($("#hid_base_url").val()+"index.php/core/dashboard/drugtest/delete",
			{
				req_auto_id_0:$auto_id_0
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
								$("#drugtest_row_"+$auto_id_0).addClass('bg-danger');
								$("#drugtest_row_"+$auto_id_0).fadeOut();
								
								toastr.success($arr.msg,"Deleted!");
								
								//window.location.replace($("#hid_base_url").val()+"index.php/dashboard/front_desk");
							}
							else 
							{
								toastr.error($arr.msg,"Warning!");
							}
							
							drugtest_view();
				}
				catch(err)
				{
					alert("EXCEPTION : "+err.message);
				}
			});
		}		
	}
	
	function print_drugtest($drugtest_patient_id)
	{
		//alert($drugtest_patient_id);
		
		var billwindow = window.open($("#hid_base_url").val()+"index.php/core/dashboard/drugtest/print_drugtest?req_patient_id="+$drugtest_patient_id, '_blank', 'location=yes,height=570,width=1000,scrollbars=yes,status=yes');
		billwindow.print();
	}
	
	function add_new_drugtest()
	{
		$("#drugtest_add_new_modal").modal(
		{
			backdrop:"static",
			keypress:false
		});
	}
	
	function add_patients($patient_id)
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
	
	
	function add_staffs($staff_id)
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
	
	
	
	function show_drugtest_graph($patient_id)
	{
		//alert($patient_id);
		
			open_loader();
			$.post($("#hid_base_url").val()+"index.php/core/dashboard/drugtest/drugtest_graph",
			{
				req_patient_id:$patient_id
			},
			function(data)
			{
				close_loader();
				//alert(data);
				//$("body").append(data);
				try
				{
					$(".drugtest_graph").show(1000);
					//data = data.trim();
					//var datas = data;
					var json_data = JSON.parse(data);
					
					$("#drugtest_graph").empty();
					
					$("#hid_json_drugtest_result").val(data);
					new Morris.Line({
				  // ID of the element in which to draw the chart.
				  element: 'drugtest_graph',
				  // Chart data records -- each entry in this array corresponds to a point on
				  // the chart.
				  data:json_data,
				  // The name of the data record attribute that contains x-values.
				  xkey: ['drugtest_date'],
				  xLabelFormat: function (d) {
					  return (d.getFullYear())+"-"+(d.getMonth()+1)+"-"+(d.getDate());
				   },
				  // A list of names of data record attributes that contain y-values.
				  ykeys: ['result'],
				
				  yLabelFormat:function (y) 
				  { 
					if((y >= -1) && (y < 0))
					{
						return '-ve';
					}
					else if((y > 0) && (y <= 1))
					{
						return '+ve';
					}
					else if(y == 0)
					{
						return 'Inconclusive';
					}
				  },
				  // Labels for the ykeys -- will be displayed when you hover over the
				  // chart.
				  labels: ['result'],
				  resize: true,
				  xLabelAngle: 60,
				});
				
						$("#drugtest_graph").prepend('<div class="label1"><span class="fa fa-user"></span> '+json_data[0].patient_info+'</div>');
						
						$('html, body').animate({
							scrollTop: $("body").offset().top
						}, 500);
						
						
						
						}
						catch(ex)
						{
							alert(ex.message);
						}
					});
					
					
	}
	
	
</script>
</section>
<input type="hidden" id="hid_temp_outp" value=""/>
<input type="hidden" id="hid_json_drugtest_result" value=""/>
<div class="modal fade" data-backdrop-limit="5" id="conflicts_modal" style="z-index:1800" backdrop="static" keypressed="false" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content col-lg-12">
      <div class="modal-header">
        <h5 class="modal-title text-danger" id="exampleModalLabel"><span class="fa fa-exclamation-triangle"></span> Patient conflicts!</h5>
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


<div class="modal fade" data-backdrop-limit="1" id="drugtest_graph_modal" style="z-index:1400" backdrop="static" keypressed="false" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content col-lg-12">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Drugtest Graph</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
      <div class="modal-body">
      	 <div class="">
        	<div class="row content_div_1 alert shadow-sm">
            	<div class="col-lg-12">
                	
                </div>
            </div>
         </div>
      </div>
      
      <div class="modal-footer">
       <button  type="button" class="btn btn-light" data-dismiss="modal"><span class="fa fa-times">&nbsp;</span>Cancel</button>
      </div>
      
    </div>
  </div>
</div>


<div class="modal fade" data-backdrop-limit="1" id="drugtest_add_new_modal" style="z-index:1500" backdrop="static" keypressed="false" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content col-lg-12">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add new Drugtest</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="drugtest_save_form">
      <div class="modal-body">
      	 <div class="row">
         
         	<div class="col-lg-6">
                <p class="label2">*Choose Date</p>
    
                    <input type="text" class="form-control need_datepicker reminder_date" id="txt_drugtest_date" name="req_drugtest_date" value="<?php echo $date;?>" style="display:inline; width:100%; background:none; margin:0px 5px 0px 5px" readonly="readonly" />
                    
                <!--
                <p class="label2">*Choose test method</p>
                    <select class="form-control" id="sel_reminder_event_type" name="req_reminder_event_type" style="height:43px" required>
                        <option value="">Choose</option>
                        <option value="common_test_type">common test type</option>
                        <option value="general_test">general test</option>
                    </select>
                 -->
                                  
                <p class="label2" style="padding-bottom:10px">*Patient</p>
                <input type="hidden" id="hid_reminder_patients_list" name="req_drugtest_patient" value="[{}]" />
                <div class="btn btn-block patient_picker text-left form-control"><span class="fa fa-plus-circle" style="color:#F00">&nbsp;</span>&nbsp;Add Patient</div>
                <div id="reminder_patients_list" class="">
                </div>
                
                <p class="label2" style="padding-bottom:10px">*Staff</p>
                <input type="hidden" id="hid_reminder_staffs_list" name="req_drugtest_staff" value="[{}]" />
                <div class="btn btn-block staff_picker text-left form-control"><span class="fa fa-plus-circle" style="color:#F00">&nbsp;</span>&nbsp;Add Staff</div>
                <div id="reminder_staffs_list" class="">
                </div>
                
                <p class="label2">*Choose drugtest type</p>
                <select class="form-control sel_drugtest_type" id="sel_drugtest_type" name="req_drugtest_type" style="height:43px" required>
                        
                </select>
                
                 <?php 
                        if($this->Functions->get_staff_task_permission($_SESSION[$this->config->item("sess_cookie_name")]["staff_username"],"drugtest") == 'full')
                         {
                 ?>
                                    <div class="small-txt" title="Add new">
                                        <span onclick=add_new_service('Drugtest') class="need_hover">
                                            <span class="fa fa-plus-circle">&nbsp;</span>Add new drugtest type
                                        </span>
                                        <span>&nbsp;&nbsp;</span>
                                        <span onclick="get_service()" class="need_hover" title="Refresh">
                                            <span class="fa fa-sync">&nbsp;</span>Refresh
                                        </span>                        
                                    </div>
                   <?php
                     }
                    ?>
                     
             </div>
            
            
         	 <div class="col-lg-6">
                                          
                <p class="label2" style="border-bottom:none">Choose Result</p>
            	<div class="form-check-inline need_hover content_div_1">
                  <label class="form-check-label">
                    <input type="radio" class="form-check-input" value="+ve"  name="req_drugtest_result">+ve
                  </label>
                </div> 
                
                <div class="form-check-inline need_hover">
                  <label class="form-check-label">
                    <input type="radio" class="form-check-input" value="-ve" name="req_drugtest_result">-ve
                  </label>
                </div>
                
                <div class="form-check-inline need_hover">
                  <label class="form-check-label">
                    <input type="radio" class="form-check-input" value="Inconclusive" name="req_drugtest_result">Inconclusive
                  </label>
                </div>                
                
                <p class="label2">Notes</p>
                <textarea class="form-control" id="txt_drugtest_notes" name="req_drugtest_notes"></textarea>
                
                <button type="submit" class="d-none" id="btn_save_reminder"></button>
                
                <p class="label2"><span class="fa fa-paperclip">&nbsp;</span>Attachments</p>
                <input type="file" id="file_drugtest_attachements" name="req_drugtest_attachements" class="form-control" />
              
            </div>
            
         </div>
      </div>
      </form>
      <div class="modal-footer">
       <button onclick=$("#drugtest_save_form")[0].reset() type="button" class="btn btn-light" data-dismiss="modal"><span class="fa fa-times">&nbsp;</span>Cancel</button>
        <button onclick=$("#drugtest_save_form")[0].reset() type="button" class="btn btn-light"><span class="fa fa-redo">&nbsp;</span>Reset</button>
        <button onclick=$("#btn_save_reminder").click() type="button" class="btn btn-light"><span class="fa fa-save">&nbsp;</span>Save</button>
      </div>
    </div>
  </div>
</div>
<!--patient account-->