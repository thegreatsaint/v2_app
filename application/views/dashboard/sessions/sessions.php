<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!-- include summernote css/js -->
<link href="<?php echo $this->config->item("rest_server_url");?>assets/summer_note/summernote-master/dist/summernote.css" rel="stylesheet">
<script src="<?php echo $this->config->item("rest_server_url");?>assets/summer_note/summernote-master/dist/summernote.js"></script>
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
                    	<img src="<?php echo $this->config->item("rest_server_url");?>assets/images/icons/sessions.png" width="40px" /><span class="font-weight-bold">&nbsp;<?php echo $page_title;?>
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>
<!--breadcrumps-->

<div class="row content_div_1 view_section">
    <div class="col-lg-2">
    	<div id="view">
        	 <div class="alert shadow-sm">
             	<p align="center">
                	<img src="<?php echo $this->config->item("rest_server_url");?>assets/images/icons/sessions.png" width="100px"/>
                </p>
                <?php
				if(($rights == "full") || ($rights == "write"))
				{
				?>
                <div class="btn btn-light btn-block" onclick="add_new_session_modal()">
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

        	<div class="alert shadow-sm">
            	<div id="session_view">
            	
                </div>
            </div>      	
        </div>
    </div>
</div>


<div class="modal fade modal-child" data-backdrop-limit="1" id="check_in_new_modal" style="z-index:1500;" backdrop="static" keypressed="false" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Check in new</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
     	<div class="row">
        	<div class="col-lg-1">
            </div>
            <div class="col-lg-10">
            	<form id="frm_add_check_in">
                <p class="label2">Date</p>
                <input type="text" id="txt_check_in_date_check_in" name="req_check_in_date" class="form-control sel_program_type need_datepicker" style="height:43px" value="<?php echo date('m/d/Y');?>" readonly="readonly" required>
                
                </select>
           		<p class="label2">Program</p>
                <select id="sel_program_id_check_in" name="req_program_id" class="form-control sel_program_type" style="height:43px" readonly="readonly" required>
                
                </select>
                                
                <p class="label2">Patient</p>
                <div class="badge badge-secondary">
                	<span class="fa fa-user">&nbsp;</span>
                    <span id="disp_check_in_patient_id"></span>
                </div>
                <input id="hid_check_in_patient_id" type="hidden" name="req_check_in_patient_id" required/>         
                <button type="submit" id="btn_frm_add_check_in" class="btn btn-light d-none">Check in</button>
                
                </form>
                 
            </div>
            <div class="col-lg-1">
            </div>
        </div>
      </div>
      <div class="modal-footer">       
        <button type="button" onclick=$("#frm_add_check_in")[0].reset() class="btn btn-light" data-dismiss="modal"><span class="fa fa-times">&nbsp;</span>Cancel</button>
        
         <button type="button" onclick=$("#btn_frm_add_check_in").click() class="btn btn-light"><span class="fa fa-save">&nbsp;</span>Check-in</button>
      </div>
    </div>
  </div>
</div>


<div class="row content_div_1 entry_section" style="display:none">
    <div class="col-lg-2">
    	<div id="view">
        	 <div class="alert shadow-sm">
             	<p align="center">
                	<img src="<?php echo $this->config->item("rest_server_url");?>assets/images/icons/sessions.png" width="100px"/>
                </p>
                <?php
				if(($rights == "full") || ($rights == "write"))
				{
				?>
                <div class="btn btn-light btn-block" onclick="view_session_modal()">
                	<span class="fa fa-search">&nbsp;</span>Session view
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
        	<div class="shadow-sm">
            	<div class="row">
                	<div class="col-lg-5">
                    	<div class="alert shadow-sm">
                        	<form id="session_start_form">
                        	<input type="hidden" id="hid_session_rand_no" name="req_session_rand_no" />
                        	<p class="label2">Choose date</p>
                            <input id="txt_session_date" type="text" class="form-control need_datepicker" value="<?php echo date('m/d/Y');?>"  readonly="readonly"/>
                            
                        	<p class="label2">Choose location</p>
                            <input id="sel_session_location" type="text" name="req_session_location" class="form-control locations" style="display:block; width:357px" required>
                            
                            <p class="label2">Choose programs</p>
                            <select id="sel_session_program_id" name="req_session_program_id" class="form-control sel_program_type" style="height:43px" required>
                            
                            </select>
                            
                            <p class="label2">Program members</p>
                            <div id="program_patient_list" style="overflow:scroll; min-height:200px; max-height:200px" class="program_patient_list">
                            </div>
                            <br />
                            <button id="btn_submit" type="submit" class="btn btn-light btn-block"><span class="fa fa-play">&nbsp;</span>Start session</button>
                            
                            </form>
                            
                        </div>
                    </div>
                    <div class="col-lg-7">
                    	<div class="shadow-sm alert" id="session_notes_section" style="display:none; height:250px;">
                        	<div class="col-lg-12">
                                <div id="session_notes" class="shadow-sm" style="max-height:250px; padding:1px; overflow:scroll; overflow-x:hidden;">
                                </div>
                            </div>
                            
                            <div class="gap_1">&nbsp;</div>
                            
                                                       
                            <select title="Notes type" id="sel_session_program_id" name="req_session_program_id" class="form-control" style="height:43px; width:200px; display:inline" required>
                            	<option value="">Notes type</option>
                                <option value="Entertainment">Entertainment</option>
                                <option value="Health">Health</option>
                                <option value="Agriculture">Agriculture</option>
                            </select>
                           
                            <select title="Rating type" id="sel_session_rate_type" name="req_session_program_id" class="form-control" style="height:43px; width:120px; display:inline" required>
                            	<option value="">Rating</option>
                                <option value="Behaviour">Behaviour</option>
                                <option value="Manner">Manner</option>
                            </select>
                            
                            <select title="Rating" id="sel_session_rating" name="req_session_program_id" class="form-control" style="height:43px; width:80px; display:inline" required>
                            	<option value="">*</option>
                            	<option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                                                        
                            <div class="round_btn" title="Rate" onclick="rate_it()">
                            	<span class="fa fa-star"></span>
                            </div>
                            
                            <select id="sel_session_patient_list" multiple="multiple" class="form-control" style="height:auto; border:solid 1px #333; display:none">
                            	<option class="" style="font-size:1.2em; font-weight:bold" value="">Choose patient</option>
                                <option class="" value="ep2001-Rip van vinkle">ep2001-Rip van vinkle</option>
                                <option class="" value="ep2002-Rip van vinkle">ep2002-Rip van vinkle</option>
                                <option class="" value="ep2003-Rip van vinkle">ep2003-Rip van vinkle</option>
                            </select>
                            
                   			<select id="sel_session_note_type_list" multiple="multiple" class="form-control" style="height:auto; border:solid 1px #333; display:none">
                            	<option class="" style="font-size:1.2em; font-weight:bold" value="">Choose notes type</option>
                                <option class="" value="Entertainment">Entertainment</option>
                                <option class="" value="Health">Health</option>
                                <option class="" value="Disease">Disease</option>
                            </select>                            
                            
                            <p class="label2">Notes</p>
                            <textarea id="txt_session_notes" style="background:rgba(204,204,204,0.5)" class="form-control summernote" placeholder="Type here notes"></textarea>
                                                        
                             <div class="col-lg-12" style="margin-top:10px">
                            	<div onclick=session_notes_insert() class="round_btn float-right" title="Send notes to save">
                                   <span class="fa fa-paper-plane"></span>
                               	</div>
                                <div class="round_btn float-right" title="Attachments">
                                   <span class="fa fa-paperclip"></span>
                               	</div>
                                <div class="round_btn float-right" title="Smile">
                                   <span class="fa fa-smile"></span>
                               	</div>
                                <div class="round_btn float-right" title="Picture">
                                   <span class="fa fa-image"></span>
                               	</div>
                                <div class="round_btn float-right" title="Voice">
                                   <span class="fa fa-microphone"></span>
                               	</div>
                            </div>
                            
                            <h1>&nbsp;</h1>
                            <div class="btn btn-light" onclick="end_session()">
                            	<span class="fa fa-check">&nbsp;</span>End session
                            </div>
                            <div class="btn btn-light" onclick=session_cancel()>
                            	<span class="fa fa-times">&nbsp;</span>Cancel
                            </div>
                            </div>
                           
                            
                            
                            
                            <div class="gap_3">&nbsp;</div>
                            
                            <h1>&nbsp;</h1>
                           
                        </div>
                    </div>
                </div>
            </div>      	
        </div>
    </div>

<div id="signature" class="row alert" style="height:0px; visibility:hidden">
        	<div class="col-lg-2">
            </div>
            <div class="col-lg-9">
        	<div id="signature-pad" class="alert shadow-sm signature-pad">
            	<div class="alert alert-info">
                	<p align="justify">
                    	<span class="fa fa-info-circle">&nbsp;</span>The session is finished when give the staff signature and session time.       </p>
                </div>
            	<p class="label2">Staff signature below</p>
                <div class="signature-pad--body">
                  <canvas style="width:400px; border:solid 1px #333; border-radius:10px; height:300px;"></canvas>
                </div>
                <div class="signature-pad--footer">
                  
            
                  <div class="signature-pad--actions">
                    <div>
                      <div title="Eraser" class="round_btn" data-action="clear">
                      	<span class="fa fa-eraser"></span>
                      </div>
                      <div title="Undo" class="round_btn" data-action="undo">
                      	<span class="fa fa-undo"></span>
                      </div>
                      
                    </div>
                    <div>
                      
                      <input type="hidden" id="hid_session_staff_signature" value="" />
                      <p class="label2">Session finish time</p>
                      <select id="sel_session_running_time" style="width:250px" class="form-control" required>
                      	<option value="">Choose</option>
                        <option value="1hr">1hr</option>
                        <option value="1.5hr">1.5hr</option>
                        <option value="2hr">2hr</option>
                        <option value="2.5hr">2.5hr</option>
                        <option value="3hr">3hr</option>
                        <option value="3.5hr">3.5hr</option>
                        <option value="4hr">4hr</option>
                        <option value="4.5hr">4.5hr</option>
                        
                      </select>
                      <br />
                      <button onclick="save_session()" type="button" class="btn btn-light button save" data-action="save-png">
                      	<span class="fa fa-save">&nbsp;</span>Save session
                      </button>
                    </div>
                  </div>
                </div>
              </div>

			  <script src="<?php echo $this->config->item("rest_server_url");?>assets/signature/js/signature_pad.umd.js"></script>
              <script src="<?php echo $this->config->item("rest_server_url");?>assets/signature/js/app.js"></script>
</div>
			</div>
            <div class="col-lg-1">
            </div>

</div>

<script>
	$(document).ready(
	function()
	{
		//onload functions---
		session_view();
		patients = [];
		patient_search_view();
		
		//$(".entry_section").hide();
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
		
		$("#frm_add_check_in").submit(
		function(e)
		{	
		 	try
			 {
				 e.preventDefault();
				 $.ajax(
				 {
					url: $("#hid_base_url").val()+"index.php/core/dashboard/check_in/add_new",
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
						//$('body').html(data);
						try
						{
							data = data.trim();
							$arr = JSON.parse(data);
							
							if($arr.result == true)
							{
								$("#frm_add_check_in")[0].reset();
								toastr.success($arr.msg);
								$("#check_in_new_modal").modal("hide");
								get_program_members_for_sessions();
								//$("#check_in_new_modal").modal("hide");
								//window.location.reload();
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
		
		
		$("#txt_session_notes").keydown(
		function(e)
		{
				if(e.keyCode == 8)
				{
					var cursorPosition = $("#txt_session_notes").prop("selectionStart")-1;
					var str = $("#txt_session_notes").val();
					
					test_string = str.charAt(cursorPosition);
					temp_string = "";
					
					if(test_string == ";")
					{
						do
						{
							if(cursorPosition <= 0)
							{
								break;
								$("#txt_session_notes").val("");
							}
							
							test_string = str.charAt(cursorPosition);
							temp_string = temp_string + test_string;
							cursorPosition--;	
						}
						while(test_string != "#");
						
						//alert(reverse(temp_string));
						$("#txt_session_notes").val(str.replace(reverse(temp_string),""));
						e.preventDefault();
						test_string = "";
						
						if(cursorPosition <= 0)
						{
							$("#txt_session_notes").val("");
						}	
					}
				}
				else
				{
				   first_key = "";
				   $("#sel_session_patient_list", "#sel_session_note_type_list").fadeOut();
				   $("#txt_session_notes").focus();		
				}
		   });
		
		
		$("#sel_session_program_id").change(
		function(e)
		{
			if($(this).val() != "")
			{
				//alert($(this).val());
				get_program_members_for_sessions();
			}
		});
		
		$("#session_start_form").submit(
		function(e)
		{
			$("#btn_submit").hide();
			$("#session_notes_section").fadeIn();
			$("#sel_session_program_id").attr("readonly","true");
			$("#txt_session_date").attr("readonly","true");
			$("#sel_session_location").attr("readonly","true");
			e.preventDefault();
			
		});
		
		
		var locations = {
							data:["Room no 1", "Room no 2", "Room no 3", "Room no 4", "Room no 5"]
						};
							
						$(".locations").easyAutocomplete(locations);
		
		$("#txt_session_notes").keypress(
		function(e)
		{
			if(e.keyCode == 16)
		  	{
			  is_shif_key_pressed = 1;
		  	}
			
			if(e.keyCode == 32)
		  	{
			  first_key = "32"; 
		  	}
			
			if(e.keyCode == 27)
			{
				$("#sel_session_patient_list").hide();
				$("#sel_session_note_type_list").hide();
			}
			
			if(e.keyCode == 64)
		  	{
				$("#sel_session_note_type_list").hide();
				$("#sel_session_patient_list").fadeIn();
				$("#sel_session_patient_list").focus();
				$("#sel_session_patient_list").val("");
			}
			
			if(first_key = "32")
			   {
					if(e.keyCode == 35)
					{
						$("#sel_session_patient_list").hide();
						$("#sel_session_note_type_list").fadeIn();
						$("#sel_session_note_type_list").focus();
						$("#sel_session_note_type_list").val("");
					}
			   }
		
		});
		
		$("#sel_session_patient_list").keyup(
		function(e)
		{
			if(e.keyCode == 27)
			{
				$("#sel_session_patient_list").hide();
				$("#sel_session_note_type_list").hide();
			}
			
			if(e.keyCode == 13)
			{
				if($(this).val() != "")
				{
						markupStr = $('#txt_session_notes').val()+" @";
						var temp = markupStr+$(this).val()+"; ";
						selection_start = $('#txt_session_notes').prop("selectionStart");
						$('#txt_session_notes').val(temp);
						$("#sel_session_patient_list").hide();
						$('#txt_session_notes').focus();
						new_selection_start = selection_start+$(this).val().toString().length+5;
						$('#txt_session_notes').prop("selectionStart",new_selection_start);
						selection_start = 0;
						$("#sel_client_reg_no").val($("#sel_session_patient_list").val());
						$("#sel_session_patient_list").fadeOut();
				}
			}
		});
		
		$("#sel_session_patient_list").click(
		function(e)
		{
			if($(this).val() != "")
			{
						markupStr = $('#txt_session_notes').val()+" @";
						var temp = markupStr+$(this).val()+"; ";
						selection_start = $('#txt_session_notes').prop("selectionStart");
						$('#txt_session_notes').val(temp);
						$("#sel_session_patient_list").hide();
						$('#txt_session_notes').focus();
						new_selection_start = selection_start+$(this).val().toString().length+5;
						$('#txt_session_notes').prop("selectionStart",new_selection_start);
						selection_start = 0;
						$("#sel_client_reg_no").val($("#sel_session_patient_list").val());
						$("#sel_session_patient_list").fadeOut();
			}
		});
		
		$("#sel_session_note_type_list").keyup(
		function(e)
		{
			if(e.keyCode == 27)
			{
				$("#sel_session_patient_list").hide();
				$("#sel_session_note_type_list").hide();
			}
			
			if(e.keyCode == 13)
			{
				if($("#sel_session_note_type_list").val() != "")
				{
			
						markupStr = $('#txt_session_notes').val()+" #";
						var temp = markupStr+$(this).val()+"; ";
						selection_start = $('#txt_session_notes').prop("selectionStart");
						//$('#txt_notes').summernote('code',temp);
						$('#txt_session_notes').val(temp);
						$("#sel_session_note_type_list").hide();
						$('#txt_session_notes').focus();
						//alert($(this).val().toString().length);
						new_selection_start = selection_start+$(this).val().toString().length+5;
						//alert(new_selection_start);
						$('#txt_session_notes').prop("selectionStart",new_selection_start);
						selection_start = 0;
						$("#sel_client_reg_no").val($("#sel_session_note_type_list").val());
						//alert($("#sel_client_reg_no").val());
						$("#sel_session_note_type_list").fadeOut();
				}
			}
		});
		
		$("#sel_session_note_type_list").click(
		function(e)
		{
			if($(this).val() != "")
			{
						markupStr = $('#txt_session_notes').val()+" #";
						var temp = markupStr+$(this).val()+"; ";
						selection_start = $('#txt_session_notes').prop("selectionStart");
						$('#txt_session_notes').val(temp);
						$("#sel_session_note_type_list").hide();
						$('#txt_session_notes').focus();
						new_selection_start = selection_start+$(this).val().toString().length+5;
						$('#txt_session_notes').prop("selectionStart",new_selection_start);
						selection_start = 0;
						$("#sel_client_reg_no").val($("#sel_session_note_type_list").val());
						$("#sel_session_note_type_list").fadeOut();
			}
		});
	});
	
	function end_session()
	{
		$("#signature").css('visibility','visible');
		 $('html, body').animate({
			scrollTop: $("#signature").offset().top
		}, 100);
	}
	
	function save_session()
	{
		try
		{
			var canvas = document.querySelector("canvas");
			var signaturePad = new SignaturePad(canvas);
			$("#hid_session_staff_signature").val(signaturePad.toDataURL("image/jpeg"));
			
			if($("#hid_session_staff_signature").val() == "")
			{
				toastr.warning("Session staff signature is empty","Warning!");
			}
			else if($("#sel_session_running_time").val() == "")
			{
				toastr.warning("Session running item is empty","Warning!");
			}
			else
			{
				$.post($("#hid_base_url").val()+"index.php/core/dashboard/sessions/save_session",
				{
					req_session_rand_no:$("#hid_session_rand_no").val(),
					req_session_staff_signature:$("#hid_session_staff_signature").val(),
					req_session_running_time:$("#sel_session_running_time").val()
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
								jQuery('html,body').animate({scrollTop:0},0);
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
				});
			}
		}
		catch(err)
		{
			alert(err.message);
		}
	};
	
	function session_cancel()
	{
		if(confirm("Are you cancel?"))
		{
			window.location.reload();
		}
	}
	
	function rate_it()
	{
		if($("#sel_session_rate_type").val() == "")
		{
			$("#sel_session_rate_type").focus();
			toastr.warning("Session rating type is empty","Warning");
		}
		else if($("#sel_session_rating").val() == "")
		{
			$("#sel_session_rating").focus();
			toastr.warning("Session rating is empty","Warning");
		}
		else
		{
			if($("#txt_session_notes").val() != "")
			{
				$rating_text = $("#txt_session_notes").val() + "*Rating : "+$("#sel_session_rate_type").val()+" | "+$("#sel_session_rating").val();
				$("#txt_session_notes").val($rating_text);
			}
		}
	}
	
	function reverse(s) 
		{
			for (var i = s.length - 1, o = ''; i >= 0; o += s[i--]) { }
			return o;
		}
	
	function get_session_random_no()
	{
		$.post($("#hid_base_url").val()+"index.php/core/dashboard/sessions/get_session_random_no",
		{
			
		},
		function(data)
		{
			$arr = JSON.parse(data);
			if($arr.result == true)
			{
				//toastr.info($arr.msg,"Session random number");
				$("#hid_session_rand_no").val($arr.msg);
			}
			else
			{
				toastr.error(data);
			}
		});
	}
	
	function session_notes_insert()
	{
		//alert($("#hid_session_rand_no").val());
		if($("#txt_session_notes").val() == "")
		{
			toastr.warning("Session notes are empty","Warning");
		}
		else if($("#req_session_method").val() == "")
		{
			toastr.warning("Session method is empty","Warning");
		}
		else if($("#txt_session_date").val() == "")
		{
			toastr.warning("Session date is empty","Warning");
		}
		else if($("#sel_session_program_id").val() == "")
		{
			toastr.warning("Session method is empty","Warning");
		}
		else if($("#sel_session_location").val() == "")
		{
			toastr.warning("Session location is empty","Warning");
		}
		else
		{
			$.post($("#hid_base_url").val()+"index.php/core/dashboard/sessions/session_notes_insert",
			{
				req_session_date:$("#txt_session_date").val(),
				req_session_rand_no:$("#hid_session_rand_no").val(),
				req_session_method:$("#sel_session_program_id").val(),
				req_session_place:$("#sel_session_location").val(),
				req_session_notes:$("#txt_session_notes").val(),
				req_session_rate_type:$("#sel_session_rate_type").val(),
				req_session_rating:$("#sel_session_rating").val()
			},
			function(data)
			{
				try
				{
					//alert(data);
					get_session_notes();
				}
				catch(err)
				{
					alert("EXCEPTION "+err.message);
				}
			});
		}
	}
	
	function get_session_notes()
	{
		$.post($("#hid_base_url").val()+"index.php/core/dashboard/sessions/get_session_notes",
		{
			req_session_rand_no:$("#hid_session_rand_no").val()
		},
		function(data)
		{
			try
			{
				$arr = JSON.parse(data);
				$outp = "";
					if($arr[0].result == true)
					{
						$outp = '<div class="alert need_hover shadow-sm bg-white">'+$("#txt_session_notes").val()+'</div>';
						//alert($outp);
						/*
						$outp = $outp + '<div class="alert shadow-sm bg-white"><span class="fa fa-times need_hover text-danger float-right" title="Remove" onclick=remove_session_notes("'+$arr[$i].patient_id+'")></span><div><span class="badge badge-secondary">'+$arr[$i].patient_id+'</span> <span class="">'+$arr[$i].patient_full_name+'</span> &nbsp;</div><p align="justify" class="small-txt">'+$arr[$i].session_notes+'</p>';*/
						
					}
				
				$("#txt_session_notes").val("");
				$("#session_notes").append($outp);
				
				$('#session_notes').stop().animate({
							  scrollTop: $('#session_notes')[0].scrollHeight
							}, 800);
				
			}
			catch(err)
			{
				alert("EXCEPTION "+err.message);
			}
		});
	}
	
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

	
	function session_view()
	{
			open_loader();
			$.post($("#hid_base_url").val()+"index.php/core/dashboard/sessions/view",
			{
			
			},
			function(data)
			{
				close_loader();
				
				try
				{
					data = data.trim();
					$arr = JSON.parse(data);
					
					$outp = '<table class="table table-bordered table-striped"> <thead class="btn-light"> <tr align="left"><th align="left">Tasks</th><th align="left">Date</th><th align="left">Patient</th><th align="left">Programs</th></tr></thead> <tbody>';
					
					for($i=0; $i<$arr.length; $i++)
					{
						if($arr[$i].result == true)
						{
						$outp = $outp + '<tr id="session_table_row_'+$arr[$i].auto_id_0+'" session_rand_no = "'+$arr[$i].session_rand_no+'" patient_id= "'+$arr[$i].patient_id+'" class="need_hover"><td><span class="fa fa-trash round_btn need_hover" title="Delete" onclick=delete_session("'+$arr[$i].auto_id_0+'")></span><span class="fa fa-print round_btn need_hover" title="Print" onclick=session_print("'+$arr[$i].auto_id_0+'")></span></td><td>'+$arr[$i].session_date+'</td><td>'+$arr[$i].patient_info+'</td><td>'+$arr[$i].session_method+'</td></tr>';
						}
					}
					
					$outp = $outp + '</tbody></table>';
					
					$("#session_view").html($outp);
				}
				catch(err)
				{
					alert("EXCEPTION:"+err.message);
				}
			});
	}
	
	function session_print($auto_id_0)
	{
		var billwindow = window.open($("#hid_base_url").val()+"index.php/core/dashboard/sessions/print_session?req_auto_id_0="+$auto_id_0, '_blank', 'location=yes,height=570,width=1000,scrollbars=yes,status=yes');
		billwindow.print();
	}
	
	function remove_program_member($program_id)
	{
		//alert($program_id);
	}
	
	function get_program_members_for_sessions()
	{
		$program_id = $("#sel_session_program_id").val();
		$.post($("#hid_base_url").val()+"index.php/core/dashboard/sessions/get_program_members_for_sessions",
		{
			req_program_id:$("#sel_session_program_id").val(),
			req_session_date:$("#txt_session_date").val()
		},
		function(data)
		{
			    try
				{
					data = data.trim();
					$arr = JSON.parse(data);
					
					$outp = '';
					
					$outp_1 = '<option class="" style="font-size:1.2em; font-weight:bold" value="">Choose patient</option>';
					
					for($i=0; $i<$arr.length; $i++)
					{
							if($arr[$i].result == true)
							{
								if($arr[$i].is_check_in_today == true)
								{
									$outp_1 = $outp_1 + '<option class="" value="'+$arr[$i].patient_id+'-'+$arr[$i].patient_full_name+'">'+$arr[$i].patient_id+'-'+$arr[$i].patient_full_name+'</option>';
									
									$outp = $outp + '<div id="patient_list_'+$program_id+'_'+$arr[$i].patient_id+'" class="need_hover guessing_item shadow_sm"><input class="d-none" name="session_patient_id" type="checkbox" style="zoom:1.8" class=""><img src="'+$arr[$i].patient_image+'" width="50px"><span class="badge badge-secondary">'+$arr[$i].patient_id+'</span><br><span class=""><span class="fa fa-user">&nbsp;</span>'+$arr[$i].patient_full_name+'</span> &nbsp;</span></div>';
								}
								else
								{
									$outp = $outp + '<div id="patient_list_'+$program_id+'_'+$arr[$i].patient_id+'" class="need_hover guessing_item shadow_sm"><div onclick=check_in_first("'+$arr[$i].patient_id+'") class="text-danger need_hover"><span class="fa fa-exclamation-triangle">&nbsp;</span>This patient does not check in!</div><input name="session_patient_id" type="checkbox" style="zoom:1.8" class="" disabled><img src="'+$arr[$i].patient_image+'" width="50px">'+$arr[$i].patient_id+'</span><br><span class=""><span class="fa fa-user">&nbsp;</span>'+$arr[$i].patient_full_name+'</span> &nbsp;</span></div>';
								}
								
							}
							else
							{
								$outp = 'No patients';
							}
					}
				
					$("#sel_session_patient_list").html($outp_1);			
					$("#program_patient_list").html($outp);
				}
				catch(err)
				{
					alert("EXCEPTION:"+err.message);
				}
		});
	}
	
	function check_in_first($patient_id)
	{
		$program_id = $("#sel_session_program_id").val();
		$check_in_date = $("#txt_session_date").val();
		if(confirm("Warning!, This patient is does not check in.  Are you check this patient?"))
		{
			$("#txt_check_in_date_check_in").val($check_in_date);
			$("#sel_program_id_check_in").val($program_id);
			
			$("#disp_check_in_patient_id").html($patient_id);
			
			var req_paitent_id = new Array();

			req_paitent_id.push(
									{
										"patient_id":$patient_id
									}
							   );
							   
			$("#hid_check_in_patient_id").val(JSON.stringify(req_paitent_id));
			
			$("#check_in_new_modal").modal(
			{
				backdrop:"static",
				keypressed:false
			}
			);
		}
	}	
	
	function delete_session($auto_id_0)
	{
		if(confirm("Are you sure to delete?"))
		{
			alert($("#session_table_row_"+$auto_id_0).attr("session_rand_no")+" | "+$("#session_table_row_"+$auto_id_0).attr("patient_id"));
			
			$.post($("#hid_base_url").val()+"index.php/core/dashboard/sessions/delete_session",
			{
				req_auto_id_0:$auto_id_0,
				req_session_rand_no:$("#session_table_row_"+$auto_id_0).attr("session_rand_no"),
				req_patient_id:$("#session_table_row_"+$auto_id_0).attr("patient_id")
			},
			function(data)
			{
				
					try
					{
							data = data.trim();
							$arr = JSON.parse(data);
							if($arr.result == true)
							{				
								$("#session_table_row_"+$auto_id_0).addClass('bg-danger');
								$("#session_table_row_"+$auto_id_0).fadeOut();
								toastr.success($arr.msg,"Deleted!");
								session_view();
							}
					}
					catch(err)
					{
						alert("EXCEPTION : "+err.message);
					}
				
			});
		}
	}
	
	function remove_patients_from_exist_program($program_id,$patient_id)
	{
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
	
	function add_new_session_modal()
	{		
		$(".entry_section").fadeIn();
		$(".view_section").hide();
		get_session_random_no();
	}
	
	function view_session_modal()
	{		
		$(".entry_section").hide();
		$(".view_section").fadeIn();
	}
	
	function open_intake_patients()
	{
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