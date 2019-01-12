<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<script>
$(document).ready(
function()
{
	//image_file_upload 
	$("#file_image_upload").change(
	function(e)
	{
		//alert(e.target.files[0].type);
		$allowed_size = 2000;//kb
		$allowed_file_types = ["image/png","image/jpg","image/gif"];
				
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
		else if(!jQuery.inArray($type,$allowed_file_types))
		{
			toastr.error("Your image file does not choose");
			$(this).val("");
		}
		else if($size > $allowed_size)
		{
			toastr.error("Your image file size is "+$size+"KB, only allowed below "+$allowed_size+"KB");
			$(this).val("");
		}
		else if($file_name == "")
		{
			toastr.error("Image file name error");
			$(this).val("");
		}
		else
		{
			toastr.info("Your image file accepted");
		}
		
		readURL(this);
				
	});
	
	
	$("#img_upload_frm").submit(
	function(e)
	{
				 $.ajax(
				 {
					url: $("#hid_base_url").val()+"index.php/core/dashboard/file_upload/file_upload/",
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
				  
				   e.preventDefault();
	});
	
	//image_file_upload
	
	var currentDate = new Date()
	var day = currentDate.getDate()
	var month = currentDate.getMonth() + 1
	var year = currentDate.getFullYear()
	today = month + "/" + day + "/" + year;
	zoom = 100;
	
	//go up arrow
	$("#gst_go_up").click(
	function(e)
	{
		 $("html, body").animate({scrollTop: 0}, 500);
	});
	
	//sel_month_box_validation
	$(".sel_month_box").blur(
	function(e)
	{
		$month = $(this).val();
		if($month != "")
		{
			if(($month > 12) || ($month < 1))
			{
				toastr.warning("Invalid day (1 - 12) only allowed");
				$(".sel_month_box").val("");
				$(".sel_month_box").focus();
			}
		}
		//alert(e.fromElement.value());
	});
	
	//sel_month_box_validation
	$(".sel_day_box").blur(
	function(e)
	{
		$day = $(this).val();
		if($day != "")
		{
			if(($day > 31) || ($day < 1))
			{
				toastr.warning("Invalid month (1 - 31) only allowed");
				$(".sel_day_box").val("");
				$(".sel_day_box").focus();
			}
		}
		//alert(e.fromElement.value());
	});
	
	//sel_month_box_validation
	$(".sel_year_box").blur(
	function(e)
	{
		$year = $(this).val();
		if($year != "")
		{
			if(($year > 2050) || ($year < 1900))
			{
				toastr.warning("Invalid year (1900 - 2050) only allowed");
				$(".sel_year_box").val("");
				$(".sel_year_box").focus();
				
			}
			else
			{
				
				$dob = $(".sel_month_box").val()+"/"+$(".sel_day_box").val()+"/"+$(".sel_year_box").val();
				$("#hid_patient_dob").val($dob);
				toastr.info("Patient DOB "+$("#hid_patient_dob").val()+" is accepted");
				$(".age_text").html("~"+calculateAge($dob, today));
			}
		}
		//alert(e.fromElement.value());
	});
	
	//check incoming patients
	<?php
	if(($this->Functions->get_staff_task_permission($_SESSION[$this->config->item("sess_cookie_name")]["staff_username"],"patients") != "read") and ($this->Functions->get_staff_task_permission($_SESSION[$this->config->item("sess_cookie_name")]["staff_username"],"patients") != ""))
	{
	?>
	$.post($("#hid_base_url").val()+"index.php/core/dashboard/patients/check_incoming_patients",
	{
		
	},
	function(data,success)
	{
		if(success)
		{
			try
			{
				//alert(data);
				data = data.trim();
				$arr = JSON.parse(data);
				$outp = "";
				
				if($arr.result == true)
				{
					if($arr.count > 0)
					{
						$("#alert_notification_icon").addClass("dancing");
						$("#alert_notification_icon").attr("title",$arr.msg);
						$outp = '<a class="need_hover" href="<?php echo $this->config->item("base_url");?>index.php/dashboard/patients"><div class="guessing_item bg-light"><span class="btn"><img src="'+$arr.patients_icon+'" width="50px"></span><span class="fa fa-info-circle">&nbsp;</span>'+$arr.msg+'</div></a>';
						$("#incoming_patients_info").html($outp);
						
						//toastr.info($arr.msg);
					}
					else
					{
						$("#alert_notification_icon").removeClass("dancing");
					}
					//toastr.info($arr.msg);
				}
				else
				{
					toastr.error($arr.msg);
				}
			}
			catch(err)
			{
				alert("EXCEPTION "+err.message);
			}
		}
	});
	<?php
	}
	?>
	//check incoming patients
	
	
	$("#v_align").change(
	function(e)
	{
		try
		{
				$y_img = $("#v_align").val();
				$x_img = $("#h_align").val();
				
				$y_img = parseInt($("#hid_real_real_image_height").val()) - $y_img;
				$x_img = parseInt($("#hid_real_real_image_width").val()) - $x_img;
				
				//ctx.clearRect(0, 0, c.width, c.height);
				
				canvas = document.getElementById("image_canvas");
				ctx = canvas.getContext("2d");
				ctx.clearRect(0, 0, canvas.width, canvas.height);
				
				var img = new Image();
				
				//img = document.getElementById("image_upload_preview");
				
							img.onload = function() 
							{
								ctx.drawImage(img,  -($x_img), -($y_img));
								$("#hid_modified_real_image_height").val(-($y_img));
								$("#hid_modified_real_image_width").val(-($x_img));
								//ctx.drawImage(img,-($x_img), -($y_img));
								$("#disp_w_h").text($x_img+" x "+$y_img);
							}
			   //alert($("#image_upload_preview").attr("src"));
			   img.src = $("#image_upload_preview").attr("src");
		}
		catch(err)
		{
			alert(err.message);
		}
	});
	
	$("#h_align").change(
	function(e)
	{
		try
		{
				$y_img = $("#v_align").val();
				$x_img = $("#h_align").val();
				
				$y_img = parseInt($("#hid_real_real_image_height").val()) - $y_img;
				$x_img = parseInt($("#hid_real_real_image_width").val()) - $x_img;
				
				//ctx.clearRect(0, 0, c.width, c.height);
				
				canvas = document.getElementById("image_canvas");
				ctx = canvas.getContext("2d");
				ctx.clearRect(0, 0, canvas.width, canvas.height);
				
				var img = new Image();
				
				//img = document.getElementById("image_upload_preview");
				
							img.onload = function() 
							{
								ctx.drawImage(img,  -($x_img), -($y_img));
								$("#hid_modified_real_image_height").val(-($y_img));
								$("#hid_modified_real_image_width").val(-($x_img));
								//ctx.drawImage(img,-($x_img), -($y_img));
								$("#disp_w_h").text($x_img+" x "+$y_img);
							}
			   //alert($("#image_upload_preview").attr("src"));
			   img.src = $("#image_upload_preview").attr("src");
		}
		catch(err)
		{
			alert(err.message);
		}
	});
	
	//patient_picker
	$(".patient_picker").click(
	function(e)
	{
		$("#patient_search_modal").modal(
			{
				backdrop:"static",
				keypressed:false
			}
		);
	});
	
	$(".staff_picker").click(
	function(e)
	{
		$("#staff_search_modal").modal(
			{
				backdrop:"static",
				keypressed:false
			}
		);
	});
	
	$(".doctor_picker").click(
	function(e)
	{
		$("#doctor_search_modal").modal(
			{
				backdrop:"static",
				keypressed:false
			}
		);
	});
	
	$(".service_picker").click(
	function(e)
	{
		$("#search_search_modal").modal(
			{
				backdrop:"static",
				keypressed:false
			}
		);
	});

	
	$("#txt_search_patient_box").keyup(
	function(e)
	{
		patient_search_view();
	});

	
});

function patient_search_view()
{
	<?php 
		if($this->Functions->get_staff_task_permission($_SESSION[$this->config->item("sess_cookie_name")]["staff_username"],"patients") != "")
		{		
		?>
		
		$.post($("#hid_base_url").val()+"index.php/core/dashboard/patients/view",
			{
				search_key_word:$("#txt_search_patient_box").val()
			},
			function(data)
			{
				try
				{
					$outp = "";
					//alert(data);
					data = data.trim();
					$arr = JSON.parse(data);
					for($i=0; $i<$arr.length; $i++)
					{
						if($arr[$i].result == true)
						{
						$outp = $outp+'<div class="row guessing_item" id="patient_search_result_row_'+$arr[$i].patient_id+'" patient_first_name = "'+$arr[$i].patient_first_name+'" patient_image = "'+$arr[$i].patient_image+'"> <div class="col-lg-3"> <img src="'+$arr[$i].patient_image+'" class="img-fluid img-circle"/> </div><div class="col-lg-9"> <p class="label2"><span class="badge badge-secondary">'+$arr[$i].patient_id+'</span> '+$arr[$i].patient_first_name+' '+$arr[$i].patient_middle_name+' '+$arr[$i].patient_last_name+'<br/>D.O.B : '+$arr[$i].parent_dob+'</p><div class="btn round_btn" onclick=add_patients("'+$arr[$i].patient_id+'")> <span class="fa fa-plus-circle"></span></div></div></div>';
						}
					}
					
					$("#search_patient_result").html($outp);
				}
				catch(err)
				{
					alert("EXCEPTION:"+err.message);
				}
			});	
	
		<?php
		}
		else
		{
		?>
			
		<?php
		}
		?>
}


function staff_search_view()
{
	<?php 
		if($this->Functions->get_staff_task_permission($_SESSION[$this->config->item("sess_cookie_name")]["staff_username"],"staffs") != "")
		{		
		?>
		
		$.post($("#hid_base_url").val()+"index.php/core/dashboard/staffs/view",
			{
				search_key_word:$("#txt_search_staff_box").val()
			},
			function(data)
			{
				try
				{
					$outp = "";
					//alert(data);
					data = data.trim();
					$arr = JSON.parse(data);
					for($i=0; $i<$arr.length; $i++)
					{
						if($arr[$i].result == true)
						{
							$outp = $outp+'<div class="row guessing_item" id="staff_search_result_row_'+$arr[$i].staff_id+'" staff_first_name = "'+$arr[$i].staff_first_name+'" staff_last_name = "'+$arr[$i].staff_last_name+'" staff_role = "'+$arr[$i].staff_role+'" staff_image = "'+$arr[$i].staff_image_src+'"> <div class="col-lg-3"> <img src="'+$arr[$i].staff_image_src+'" class="img-fluid img-circle"/> </div><div class="col-lg-9"> <p class="label2"><span class="badge badge-secondary">'+$arr[$i].staff_id+'</span> '+$arr[$i].staff_first_name+' '+$arr[$i].staff_last_name+'<br/>Staff role : '+$arr[$i].staff_role+'</p><div class="btn round_btn" onclick=add_staffs("'+$arr[$i].staff_id+'")> <span class="fa fa-plus-circle"></span></div></div></div>';
						}
					}
					
					$("#search_staff_result").html($outp);
				}
				catch(err)
				{
					alert("EXCEPTION:"+err.message);
				}
			});	
	
		<?php
		}
		else
		{
		?>
			
		<?php
		}
		?>
}


function doctor_search_view()
{
	<?php 
		if($this->Functions->get_staff_task_permission($_SESSION[$this->config->item("sess_cookie_name")]["staff_username"],"doctors") != "")
		{		
		?>
		
		$.post($("#hid_base_url").val()+"index.php/core/dashboard/doctors/view",
			{
				search_key_word:$("#txt_search_staff_box").val()
			},
			function(data)
			{
				try
				{
					$outp = "";
					//alert(data);
					data = data.trim();
					$arr = JSON.parse(data);
					for($i=0; $i<$arr.length; $i++)
					{
						if($arr[$i].result == true)
						{
							$outp = $outp+'<div class="row guessing_item" id="doctors_search_result_row_'+$arr[$i].doctor_id+'" doctor_first_name = "'+$arr[$i].doctor_first_name+'" doctor_last_name = "'+$arr[$i].doctor_last_name+'" doctor_specialist = "'+$arr[$i].doctor_specialist+'" doctor_image = "'+$arr[$i].doctor_image_src+'"> <div class="col-lg-3"> <img src="'+$arr[$i].doctor_image_src+'" class="img-fluid img-circle"/> </div><div class="col-lg-9"> <p class="label2"><span class="badge badge-secondary">'+$arr[$i].doctor_id+'</span> '+$arr[$i].doctor_first_name+' '+$arr[$i].doctor_last_name+'<br/>Specialist in : '+$arr[$i].doctor_specialist+'</p><div class="btn round_btn" onclick=add_doctors("'+$arr[$i].doctor_id+'")> <span class="fa fa-plus-circle"></span></div></div></div>';
						}
					}
					
					$("#search_doctor_result").html($outp);
				}
				catch(err)
				{
					alert("EXCEPTION:"+err.message);
				}
			});	
	
		<?php
		}
		else
		{
		?>
			
		<?php
		}
		?>
}


function service_search_view()
{
	   <?php 
		if(1)
		{		
		?>
		//alert("ok");
			$.post($("#hid_base_url").val()+"index.php/core/dashboard/configurations/services/view",
			{
				
			},
			function(data)
			{
				//alert(data);
				try
				{
					data = data.trim();
					$arr = JSON.parse(data);
					
					$outp='';
					
					//alert(data);
					for($i=0; $i<$arr.length; $i++)
					{
						if($arr[$i].result != false)
						{		
									
						$outp = $outp+'<div class="row guessing_item" id="service_search_result_row_'+$arr[$i].service_code+'" service_code = "'+$arr[$i].service_code+'" service_type = "'+$arr[$i].service_type+'"><div class="col-lg-12"> <p class="label2"><span class="">'+$arr[$i].service_code+'</span> - '+$arr[$i].service_type+' </p><div class="btn round_btn" onclick=add_service("'+$arr[$i].service_code+'")> <span class="fa fa-plus-circle"></span></div></div></div>';
						
						}
					}
					
					$outp = $outp + '';
					$("#search_service_result").html($outp);
				}
				catch(err)
				{
					alert("EXCEPTION:"+err.message);
				}
			});	
	
		<?php
		}
		else
		{
		?>
			
		<?php
		}
		?>
}


function calendar_monthly_view(datestring)
{
	//alert("ok");
	//alert(datestring);
	//var datestring = '11/15/2018';
	var dt = new Date(datestring);
	//alert(dt.getUTCFullYear()+", "+dt.getUTCMonth());
	var daysArr = ['Mon','Tue','Wed','Thu','Fri','Sat','Sun'];
	var monthtotdays = getNumberOfDays(dt.getUTCFullYear(), dt.getUTCMonth()+1);
	//alert(monthtotdays);
	var currdays = daysArr[dt.getDay()-1];
	var currdaysval = 0;
	var outp = "<span class='float-center badge badge-secondary '>"+datestring+"</span>";
	    outp = outp+"<table align='center' class='table reminder_table  table-condenced  table-hover table-bordered table-striped'>";
		
	    outp = outp+"<tr class='btn-light'>";
				
		for($d=0;$d<=6;$d++){
		outp = outp + "<td>"+daysArr[$d]+"</td>";
		if(daysArr[$d]==currdays) 
		 {
		   currdaysval = $d;
		 }
		}
		
		outp = outp + "</tr>";
		outp = outp + "<tr>";
		
		if(currdaysval > 0 )
		{
			outp = outp + '<td colspan="'+currdaysval+'">&nbsp;</td>';
			for($i=1;$i<=monthtotdays;$i++)
			{
				outp = outp + '<td class=""><span class=""><span class=""></span>'+$i+'</span></td>';	
				$date = $i;
				$month = dt.getUTCMonth();
				$year = dt.getUTCFullYear();
			
				//$temp_date = new Date(dt.getUTCFullYear(),dt.getUTCMonth()+1,$i);
				check_event_is_in_this_date($year,$month,$date);
					
				if(($i+currdaysval )%7 <= 0 )
				{
					outp = outp + "</tr><tr>";
				}
			}
			
			outp = outp + "</tr></table>";
		}
	//alert(currdaysval);
	//alert(outp);
	//alert(JSON.stringify(monthtotdays));
	$(".reminder_view_table").html(outp);
}

function getNumberOfDays(year, month) {
	//month = month - 1;
    var isLeap = ((year % 4) == 0 && ((year % 100) != 0 || (year % 400) == 0));
    return [31, (isLeap ? 29 : 28), 31, 30, 31, 30, 31, 31, 30, 31, 30, 31][month];
}
//onpreview
function readURL(input) {

  if (input.files && input.files[0]) {
    var reader = new FileReader();
	
    reader.onload = function(e) 
	{
	  var img = new Image();
	  
	  //alert("ATTENTIONS PLEASE!\nImage is Captured, you can crop and save."+e.target.result);  
	 
	  //$("#image_canvas").attr("height","300px");	
	  //$("#image_canvas").attr("width","300px");	
	  $("#image_upload_preview").attr("src","");
	  $("#image_upload_preview").attr("src",e.target.result);
	  $("#hid_upload_image_file_base64").val(e.target.result);
	  var c = document.getElementById("image_canvas");
	  var ctx = c.getContext("2d");
	  c.width = 300;
	  c.height = 300;
	  
	  img = document.getElementById("image_upload_preview");
	  
	  //ctx.drawImage(img,0,0);
	  img.onload = function () {
		  
		  						$("#hid_real_real_image_height").val(this.naturalHeight); 
								$("#hid_real_real_image_width").val(this.naturalWidth);
								$("#v_align").attr("max",$("#hid_real_real_image_height").val());
								$("#h_align").attr("max",$("#hid_real_real_image_width").val());
								$("#v_align").attr("value",$("#hid_real_real_image_height").val());
								$("#h_align").attr("value",$("#hid_real_real_image_height").val());
								
								$("#disp_w_h").text($("#hid_real_real_image_width").val()+" x "+$("#hid_real_real_image_height").val());
		  						ctx.clearRect(0, 0, c.width, c.height);
								ctx.drawImage(img,0,0);
								$("#img_edit_section").fadeIn();
							}
    }

    reader.readAsDataURL(input.files[0]);
  }
}

function open_notification()
{
	$("#notification_modal").modal(
	{
		backdrop:"static",
		keypressed:false
	});
}

function calculateAge (birthDate, otherDate) {
    birthDate = new Date(birthDate);
    otherDate = new Date(otherDate);

    var years = (otherDate.getFullYear() - birthDate.getFullYear());

    if (otherDate.getMonth() < birthDate.getMonth() || 
        otherDate.getMonth() == birthDate.getMonth() && otherDate.getDate() < birthDate.getDate()) {
        years--;
    }

    return years;
}



<!--show--hide--password-->
function show_hide_password()
{
	$type = $(".password_control").attr("type").toLowerCase();
	if($type == 'text')
	{
		$(".password_control").attr("type","password");
	}
	else
	{
		$(".password_control").attr("type","text");
	}
	
}
<!--show--hide--password-->

function logout()
{
	if(confirm("Are you sure to logout?"))
	{
		$.post($("#hid_base_url").val()+"index.php/core/dashboard/staffs/staff_logout",
		{
			
		},
		function(data)
		{
			try
			{
				//alert(data);
				data = data.trim();
				$arr = JSON.parse(data);
				
				if($arr.result == true)
				{
					toastr.success($arr.msg);
					setTimeout(window.location.replace($("#hid_base_url").val()+"index.php/welcome/entrance"),1000);
				}
				else
				{
					toastr.error($arr.msg);
				}
			}
			catch(err)
			{
				alert("EXCEPTION "+err.message);
			}
		});
	}
}

function open_loader()
{
	$("#loader").modal(
	{
		backdrop:"static",
		keypressed:false
	});
}

function close_loader()
{
	$("#loader").modal("hide");
}

function validate_email(mail) 
{
  if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(mail))
  {
    return true
  }
  else
  {
  	return false
  }
}

function show_picture_upload_modal($for)
{
	//alert($for);
	if($for == 'staff_pro_pic')
	{
		$("#hid_file_upload_for").val($for);
		$("#disp_txt_upload_caption").text("Upload a staff propic");
		$("#hid_unique_id").val($("#hid_staff_id").val());
		$("#picture_upload_modal").modal(
		{
			backdrop:"static",
			keypressed:false
		});		
	}
}

function show_reminder_info($reminder_id)
{
	//alert($reminder_id);
	$("#reminder_info_modal").modal(
	{
		backdrop:"static",
		keypressed:false
	});
	
	$.post($("#hid_base_url").val()+"index.php/core/dashboard/reminders/show_reminder_info",
	{
		req_reminder_id:$reminder_id
	},
	function(data)
	{
		//alert(data);
		$(".reminder_info").html(data);
	});
}

function zoom_minus()
{
	//alert(view);
	zoom = zoom - 10;
	zoom = zoom;
	//alert(zoom);
	$(".view").css("zoom",zoom+"%");
}

function zoom_plus()
{
	zoom = zoom + 10;
	zoom = zoom;
	$(".view").css("zoom",zoom+"%");
}



</script>

<!--right-side--quickacess-->
<script>
$(document).ready(function(e) {
  
  	$("#btn_change_view").click(
	function(e)
	{
		$("#horizontal_view_icon").fadeToggle();
		$("#vertical_view_icon").fadeToggle();
		if($("#btn_change_view_icon").attr("class") == "fa fa-table")
		{
			$("#btn_change_view_icon").attr("class","fa fa-list");
		}
		else
		{
			$("#btn_change_view_icon").attr("class","fa fa-table");
		}
		//$("#btn_change_view_icon").addClass("fa fa-list");
	});
});
</script>
<div class="round_btn" onclick="open_notification()" style="position:fixed; top:80px; right:5px; z-index:100; display:block">
	<span id="alert_notification_icon" class="fa fa-bell">
    </span>
</div>

<div class="round_btn" style="position:fixed; border-radius:50%; top:130px; right:5px; z-index:100">
	<span class="fa fa-comment">
    </span>
</div>

<div class="round_btn" style="position:fixed; border-radius:50%; top:180px; right:5px; z-index:100">
	<span class="fa fa-clock">
    </span>
</div>

<div id="gst_go_up" class="round_btn" style="position:fixed; border-radius:50%; bottom:5px; right:5px; z-index:100">
	<span class="fa fa-arrow-circle-up">
    </span>
</div>

<a href="<?php echo $this->config->item("base_url");?>index.php/dashboard/">
<div id="go_to_home" class="round_btn" style="position:fixed; border-radius:50%; bottom:55px; right:5px; z-index:100">
	<span class="fa fa-home">
    </span>
</div>
</a>

<div id="btn_change_view" title="Change view" class="round_btn right_side_buttons need_hover" style="position:fixed; border-radius:50%; top:230px; right:5px; display:none; z-index:100">
	<span id="btn_change_view_icon" class="fa fa-table">
    </span>
</div>
<!--right side quick access bar-->

<!--loader modal--->
        <div class="modal" id="loader" data-backdrop-limit="10" backdrop="static" style="overflow:scroll; z-index:3000; overflow-x:hidden">
            <div class="modal-dialog">
              <!-- Modal content-->
              <div class="modal-content" style="padding-top:100px; vertical-align:middle; text-align:center; background-color:transparent; border:none; box-shadow:0px 0px 0px #fff;color:#fff; font-size:5em;">
                  <span class="loading fa fa-hourglass fa fa-spin" style="text-shadow:0px 0px 10px #000"></span>
                  <h5 style="text-shadow:0px 0px 10px #000; margin-top:20px">Wait Please...</h5>     
              </div><!-- Modal content-->
               <!-- Modal content-->
            </div>
          </div>
<!--loader modal--->

<!--notification modal-->
<div class="modal fade" id="notification_modal" backdrop="static" keypressed="false" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><span class="fa fa-bell">&nbsp;</span>Notifications</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        	<div id="incoming_patients_info" class="">
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-light" data-dismiss="modal"><span class="fa fa-times">&nbsp;</span>Cancel</button>
      </div>
    </div>
  </div>
</div>
<!--notification modal-->

			<style>
			input[type=range][orient=vertical]
			{
				writing-mode: bt-lr; /* IE */
				-webkit-appearance: slider-vertical; /* WebKit */
				width: 8px;
				height: 175px;
				padding: 0 5px;
			}
			</style>

<!--notification modal-->
<div class="modal fade"  data-backdrop-limit="2" style="z-index:1600; overflow:auto" id="picture_upload_modal" backdrop="static" keypressed="false" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><span class="fa fa-upload-alt">&nbsp;</span><span id="disp_txt_upload_caption">Upload an image</span></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        	<div class="">
            	<input id="file_image_upload" type="file" accept="image/*" class="d-none" name="req_upload_file" required/>
            	<form id="img_upload_frm">
            	<p align="left">
                <input type="hidden" name="req_unique_id" id="hid_unique_id"/>
                <input type="hidden" name="req_file_upload_for" id="hid_file_upload_for" />
                <input type="hidden" name="req_real_img_height" id="hid_real_real_image_height" />
                <input type="hidden" name="req_real_img_width" id="hid_real_real_image_width" />
                <input type="hidden" name="req_modified_img_height" id="hid_modified_real_image_height" />
                <input type="hidden" name="req_modified_img_width" id="hid_modified_real_image_width" />
                <input type="hidden" name="req_image_file_base_64" id="hid_upload_image_file_base64" />
                <button type="button" name="btn_file_choose" class="btn btn-light" onclick=$("#file_image_upload").click()>
                	<span class="fa fa-search">&nbsp;</span>Choose image
                </button>
                </p>
                </form>
            </div>
            <p id="img_edit_section" style="overflow:auto; display:none">
            	<input id="v_align"  type="range" orient="vertical" style="position:absolute; left:20px; top:80px; height:300px" />
                <input id="h_align"  type="range" style="position:absolute; margin-left:20px; top:380px; width:300px" />
            
            	<img id="image_upload_preview" width="0px" />
            	<canvas id="image_canvas" style="margin-left:20px;" class="shadow-lg">
                <div class="small-text" id="disp_w_h"></div>
                <button type="submit" name="req_btn_submit" onclick=$("#img_upload_frm").submit() class="btn btn-light">
                	<span class="fa fa-upload">&nbsp;</span>Upload
                </button>
            </p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-light" data-dismiss="modal"><span class="fa fa-times">&nbsp;</span>Cancel</button>
      </div>
    </div>
  </div>
</div>
<!--notification modal-->


<!--notification modal-->
<div class="modal fade"  data-backdrop-limit="2" style="z-index:1600; overflow:auto" id="patient_search_modal" backdrop="static" keypressed="false" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><span class="fa fa-search">&nbsp;</span>Search patient</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        	<div class="row">
            	<div class="col-lg-1">
                </div>
                <div class="col-lg-10">
                	<div class="input-group mb-3">
                          <input id="txt_search_patient_box" type="text" class="form-control" placeholder="Search" aria-label="Search" aria-describedby="button-addon2">
                          <div class="input-group-append">
                            <button class="btn btn-outline-secondary" onclick="view()" type="button" id="button-addon2">
                            	<span class="fa fa-search"></span>
                            </button>
                          </div>
                     </div>
                     <div id="search_patient_result" class="alert shadow-sm" style="overflow:auto; max-height:300px">
                     	
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
<!--notification modal-->


<!--notification modal-->
<div class="modal fade"  data-backdrop-limit="2" style="z-index:1600; overflow:auto" id="staff_search_modal" backdrop="static" keypressed="false" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><span class="fa fa-search">&nbsp;</span>Search Staff</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        	<div class="row">
            	<div class="col-lg-1">
                </div>
                <div class="col-lg-10">
                	<div class="input-group mb-3">
                          <input id="txt_search_staff_box" type="text" class="form-control" placeholder="Search" aria-label="Search" aria-describedby="button-addon2">
                          <div class="input-group-append">
                            <button class="btn btn-outline-secondary" onclick="view()" type="button" id="button-addon2">
                            	<span class="fa fa-search"></span>
                            </button>
                          </div>
                     </div>
                     <div id="search_staff_result" class="alert shadow-sm" style="overflow:auto; max-height:300px">
                     	
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
<!--notification modal-->

<div class="modal fade"  data-backdrop-limit="2" style="z-index:1600; overflow:auto" id="doctor_search_modal" backdrop="static" keypressed="false" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><span class="fa fa-search">&nbsp;</span>Search Doctor</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        	<div class="row">
            	<div class="col-lg-1">
                </div>
                <div class="col-lg-10">
                	<div class="input-group mb-3">
                          <input id="txt_search_doctor_box" type="text" class="form-control" placeholder="Search" aria-label="Search" aria-describedby="button-addon2">
                          <div class="input-group-append">
                            <button class="btn btn-outline-secondary" onclick="view()" type="button" id="button-addon2">
                            	<span class="fa fa-search"></span>
                            </button>
                          </div>
                     </div>
                     <div id="search_doctor_result" class="alert shadow-sm" style="overflow:auto; max-height:300px">
                     	
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


<div class="modal fade"  data-backdrop-limit="2" style="z-index:1600; overflow:auto" id="search_search_modal" backdrop="static" keypressed="false" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><span class="fa fa-search">&nbsp;</span>Search Services</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        	<div class="row">
            	<div class="col-lg-1">
                </div>
                <div class="col-lg-10">
                	
                     <?php 
                         if($this->Functions->get_staff_task_permission($_SESSION[$this->config->item("sess_cookie_name")]["staff_username"],"staffs") == 'full')
                     {
                      ?>
                                <div class="small-txt" title="Add new">
                                    <span onclick="add_new_service()" class="need_hover">
                                        <span class="fa fa-plus-circle">&nbsp;</span>Add new services
                                    </span>
                                    <span>&nbsp;&nbsp;</span>
                                    <span onclick="get_service_list()" class="need_hover" title="Refresh">
                                        <span class="fa fa-sync">&nbsp;</span>Refresh
                                    </span>                        
                                </div>
                    <?php
                     }
                    ?>
                     <div id="search_service_result" class="alert shadow-sm" style="overflow:auto; max-height:300px">
                     	
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

<!--notification modal-->
<div class="modal fade"  data-backdrop-limit="6" style="z-index:2000; overflow:auto" id="reminder_info_modal" backdrop="static" keypressed="false" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><span class="fa fa-search">&nbsp;</span>Reminder info</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        	<div class="row">
            	<div class="col-lg-12">
                    <div class="content_div_1 reminder_info">
                        <div class="begin_to_load text-center">
                            <h1>
                                <span class="fa fa-sync-alt fa-spin"></span>
                            </h1>
                        </div>
                    </div>
                </div>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-light" data-dismiss="modal"><span class="fa fa-times">&nbsp;</span>Cancel</button>
      </div>
    </div>
  </div>
</div>
<!--notification modal-->