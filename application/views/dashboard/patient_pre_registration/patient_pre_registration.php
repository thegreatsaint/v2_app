<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!--front_desk--icons-->
<h1 class="first_gap">&nbsp;</h1>

<section class="wow fadeIn" data-wow-duration="1s" data-wow-delay="2s">
<!--breadcrumps-->

<!--breadcrumps-->
<script>
	$(document).ready(
	function()
	{
	
		//onload functions---
	
		//assign_staff_id();
		//onload functions---
		
		$(".sel_ref_entity_name").change(
		function()
		{
			get_referral_person($(this).attr('id'));
		});
		
		$("#full_patient_reg_form").submit(
		function(e)
		{
			$url = $("#hid_base_url").val()+"index.php/core/dashboard/patient_pre_registration/patient_full_register";
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
						$("#txt_patient_is_employ").val(data);
						try
						{
							//alert(data);
							
							data = data.trim();
							$arr = JSON.parse(data);
							
							if($arr.result == true)
							{
								$("#full_patient_reg_form")[0].reset();
								$("#full_reg_modal").modal("hide");
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
		
		$("#patient_quick_pre_reg_form").submit(
		function(e)
		{
			if($("#hid_form_mode").val() == "insert")
			{
				$url = $("#hid_base_url").val()+"index.php/core/dashboard/patient_pre_registration/quick_pre_register";
			}
			else if($("#hid_form_mode").val() == "edit")
			{
				$url = $("#hid_base_url").val()+"index.php/core/dashboard/patient_pre_registration/quick_pre_register";
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
								$("#patient_quick_pre_reg_form")[0].reset();
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
		
		//sel_patient_other_ref
		$("#sel_patient_other_ref").change(
		function()
		{
			if($(this).val() != "")
			{
				if($("#sel_patient_other_ref").val() == 'Yes')
				{
					$(".sec_patient_other_ref_explain").fadeIn();
					$("#txt_patient_other_ref_explain").focus();
				}
				else
				{
					$(".sec_patient_other_ref_explain").fadeOut();
				}
			}
		}); 
		
		//sel_patient_is_employ
		$("#sel_patient_is_employ").change(
		function()
		{
			if($(this).val() == "Employed")
			{
					$(".sec_patient_is_employ").fadeIn();
					$("#txt_patient_is_employ").val("");
					$("#txt_patient_is_employ").focus();
			}
			else
			{
				$(".sec_patient_is_employ").fadeOut();
				$("#txt_patient_is_employ").val("Un-employed");
			}
		});
		
		//
		$("#sel_patient_is_psychiatric_hosp").change(
		function()
		{
			if($(this).val() == "Yes")
			{
					$(".sec_psychiatric").fadeIn();
					$("#txt_patient_exp_psychiatric_hosp").val("");
					$("#txt_patient_exp_psychiatric_hosp").focus();
			}
			else
			{
				$(".sec_psychiatric").fadeOut();
				$("#txt_patient_exp_psychiatric_hosp").val("No");
			}
		});
		
		
	});

	
	function add_new_modal()
	{
		$("#add_new_modal").modal(
			{
				"backdrop":"static",
				"keypressed":false
			}
		);
	}
	
	function go_to_full_registration()
	{
		$("#add_new_modal").modal("hide");
		$("#full_reg_modal").modal(
		{
			backdrop:"static",
			"keypressed":false	
		}
		);
	};
</script>

<!--entry-modal--->
<div class="modal fade" id="add_new_modal" backdrop="static" keypressed="false" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Quick patients pre-registration</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="patient_quick_pre_reg_form">
        	<div class="row">
            	<div class="col-lg-1">
                </div>
                <div class="col-lg-5 content_div_1">
                	<div class="need_hover btn btn-light btn-block" onclick=go_to_full_registration()><span class="fa fa-arrow-right">&nbsp;&nbsp;</span>Go to full registration</div>
                </div>
            </div>
          	<div class="row">
            	<div class="col-lg-1">
                </div>
            	<div class="col-lg-5 content_div_1">
                    
                    <input type="hidden" id="hid_form_mode" value="insert" />
                    <p class="label2">*Patient Referral Entity name</p>  
                    <select id="sel_quick_patient_ref_source_name" name="req_patient_ref_source_name" style="height:43px" class="form-control select_box sel_ref_entity_name" required="required">
                    	<option value="">Choose</option>
                    </select>
                    <div class="small-txt" title="Check referrals">
                        <span class="need_hover" onclick="get_referral_source()">
                        	<span class="fa fa-sync">&nbsp;</span>Refresh
                    	</span>                       
                    </div>
                                                           
                    <p class="label2">*Patient Referral Person</p>  
                     <select id="sel_patient_ref_person" style="height:43px" name="req_patient_ref_person" class="form-control select_box sel_ref_entity_person" required="required">
                    	<option value="">Choose</option>
                     </select>  
                  	<?php 
                    	if($this->Functions->get_staff_task_permission($_SESSION[$this->config->item("sess_cookie_name")]["staff_username"],"referrals") == 'full')
                        {
                    ?>
                    			<a href="javascript:window.confirm('Are you wish to open in new window for prevent current window from redirect? \npress OK to open in new window. \npress Cancel to open in current window.')?window.open('referrals'):window.location.replace('referrals')">
                                <div class="small-txt" title="Check referrals">
                                    <span class="need_hover">
                                        <span class="fa fa-search">&nbsp;</span>Check referrals
                                    </span>                       
                                </div>
                                </a>
                   	<?php
                         }
                    ?>    
                    
                     
                    
                    <p class="label2">*Patient name</p>
                    <input id="txt_patient_first_name" name="req_patient_first_name"  maxlength="30" type="text" class="form-control text-capitalize" required="required"/>
                    
                    <p class="label2">*Patient Mobile no</p>
                    <input id="txt_patient_mobile_no" name="req_patient_mobile_no"  maxlength="30" type="tel" class="form-control number_input" required="required"/>
                    <div class="checkbox">
                      <label><input type="checkbox" value="">&nbsp;<span class="fa fa-comment">&nbsp;</span>Send SMS to this number</label>
                    </div>
                                       
                </div>
                
                <div class="col-lg-5 content_div_1">
                	
                    <p class="label2">*Patient Email ID</p>
                    <input id="txt_patient_email_id" name="req_patient_email_id"  maxlength="50" type="email" class="form-control text-lowercase" required="required"/>
                    
                    <div class="checkbox">
                      <label><input type="checkbox" value="">&nbsp;<span class="fa fa-envelope">&nbsp;</span>Send Mail to this email</label>
                    </div>
                    
                    <p class="label2">Patient Description</p>
                    <textarea id="txt_patient_desc" maxlength="255" name="req_patient_desc" class="form-control" ></textarea> 
                	     
                    <input type="submit" name="submit" id="btn_save_referral" class="d-none" value="save" />
                    
                </div>
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button onclick=$("#staff_entry_form")[0].reset() type="button" class="btn btn-light" data-dismiss="modal"><span class="fa fa-times">&nbsp;</span>Cancel</button>
        <button onclick=$("#staff_entry_form")[0].reset() type="button" class="btn btn-light"><span class="fa fa-redo">&nbsp;</span>Reset</button>
        <button onclick=$("#btn_save_referral").click() type="button" class="btn btn-light"><span class="fa fa-save">&nbsp;</span>Save</button>
      </div>
    </div>
  </div>
</div>
<!--entry-modal--->

<!--full registration modal-->
<div class="modal fade" id="full_reg_modal" backdrop="static" keypressed="false" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel full_reg_modal">Patients Full pre-registration</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="full_patient_reg_form">
          	<div class="row">
            	<div class="col-lg-1">
                </div>
            	<div class="col-lg-5 content_div_1">
           
                    <p class="label2" style="font-size:20px">Referral Information</p>  
                    
                    <input type="hidden" id="hid_form_mode" value="insert" />
                    <p class="label2">*Patient Referral Entity name</p>  
                    <select id="sel_patient_ref_source_name" name="req_patient_ref_source_name" style="height:43px" class="form-control select_box sel_ref_entity_name" required="required">
                    	<option value="">Choose</option>
                    </select>
                    <div class="small-txt" title="Check referrals">
                        <span class="need_hover" onclick="get_referral_source()">
                        	<span class="fa fa-sync">&nbsp;</span>Refresh
                    	</span>                       
                    </div>
                                                           
                    <p class="label2">*Patient Referral Person</p>  
                     <select id="sel_patient_ref_person" style="height:43px" name="req_patient_ref_person" class="form-control select_box  sel_ref_entity_person" required="required">
                    	<option value="">Choose</option>
                     </select>  
                  	<?php 
                    	if($this->Functions->get_staff_task_permission($_SESSION[$this->config->item("sess_cookie_name")]["staff_username"],"referrals") == 'full')
                        {
                    ?>
                    			
                                <div class="" title="Check referrals">
                                	<a href="javascript:window.confirm('Are you wish to open in new window for prevent current window from redirect? \npress OK to open in new window. \npress Cancel to open in current window.')?window.open('referrals'):window.location.replace('referrals')">
                                    <span class="need_hover small-txt">
                                        <span class="fa fa-search">&nbsp;</span>Check referrals
                                    </span>    
                                    </a>                   
                                </div>
                                
                   	<?php
                         }
                    ?>    
                    <p class="label2">Is Patient currently receiving treatment at another agency:</p>
                    	<select id="sel_patient_other_ref" style="height:43px" class="form-control" required="required">
                    		<option value="">Choose</option>
                        	<option value="Yes">Yes</option>
                        	<option value="No">No</option>
                    	</select>
                        
                    <span class="sec_patient_other_ref_explain" style="display:none">
                    <p class="label2">From where?</p>
                    <input id="sel_patient_other_ref" name="req_patient_other_ref" maxlength="30" type="text" class="form-control text-capitalize" required="required" value="No"/>
					</span>
                    
                    <hr />
                    
					<P class="label2" style="font-size:20px">Patient Information</P>
                    
                    <p class="label2">*Patient First Name</p>
                    <input id="txt_patient_first_name" name="req_patient_first_name" maxlength="30" type="text" class="form-control text-capitalize" required="required"/>
                    
                    <p class="label2">Patient Middle Name</p>
                    <input id="txt_patient_middle_name" name="req_patient_middle_name" maxlength="30" type="text" class="form-control text-capitalize"/>
                    
                    <p class="label2">Patient Last Name</p>
                    <input id="txt_patient_last_name" name="req_patient_last_name" maxlength="30" type="text" class="form-control text-capitalize"/>
                    
                    <p class="label2">Gender</p>
                    <select style="height:43px" id="sel_patient_gender" name="req_patient_gender" class="form-control" required="required">
                    <option value="">Choose</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                        <option value="Other">Other</option>
                    </select>
                    
                    <p class="label2">*Date of Birth</p>
                   
                    <input type="number" placeholder="m" class="form-control sel_month_box number_input" min="1" max="12" maxlength="2" style="width:60px; display:inline" /> /
                    <input type="number" placeholder="d" class="form-control sel_day_box number_input" min="1" max="31" maxlength="2" style="width:60px; display:inline" /> /
                    <input type="number" placeholder="yyyy" class="form-control sel_year_box number_input" min="1900" max="2050" maxlength="4" style="width:70px; display:inline" />
                    <input type="hidden" id="hid_patient_dob" name="req_patient_dob"/>
                 	<div class="small-txt" title="Check referrals">
                                    <span class="need_hover">
                                        <span class="fa fa-algolia-alt">&nbsp;</span>Age : <span class="age_text">0</span>
                                    </span>                       
                    </div>                  
                    
                    <p class="label2">Address</p>                    
                    <textarea class="form-control" id="txt_patient_address" name="req_patient_address" style="" ></textarea>
                    
                    <p class="label2">City</p>
                    <input id="txt_patient_city" name="req_patient_city" maxlength="30" type="text" class="form-control text-capitalize"/>
                    
                    <p class="label2">State</p>
                    <input id="txt_patient_state" name="req_patient_state" maxlength="30" type="text" class="form-control text-capitalize"/>
                    
                    <p class="label2">Zip</p>
                    <input id="txt_patient_zip" name="req_patient_zip" maxlength="6" type="text" class="form-control number_input"/>
                    
                    <p class="label2">Case worker</p>
                    <input id="txt_patient_case_worker" name="req_patient_case_worker" maxlength="30" type="text" class="form-control text-capitalize"/>
                    
                    <p class="label2">Supervisor</p>
                    <input id="txt_patient_supervisor" name="req_patient_supervisor" maxlength="30" type="text" class="form-control text-capitalize"/>
                     
                    <p class="label2">Marital Status</p>
                    <select id="sel_patient_marital_status" style="height:43px" name="req_patient_marital_status" class="form-control">
                    <option value="">Choose</option>
                    <option value="Married">Married</option>
                    <option value="Single">Single</option>
                    <option value="Other">Other</option>
                    </select>
                    
                    <p class="label2">Patient employment status</p>
                    <select class="form-control" id="sel_patient_is_employ" style="height:43px" name="req_patient_is_employ">
                    	<option value="">Choose</option>
                        <option value="Employed">Employed</option>
                        <option value="Un-employed">Un-employed</option>
                    </select>
                    
                    <span class="sec_patient_is_employ" style="display:none">
                    <p class="label2">Explain about patient employment</p>
                    <textarea class="form-control" value="Un-employed"  id="txt_patient_is_employ" name="req_patient_is_employ" style="">Un-employed</textarea>
                    </span>
                    
                    <p class="label2">*Patient Mobile no</p>
                    <input id="txt_patient_mobile_no" name="req_patient_mobile_no"  maxlength="30" type="tel" class="form-control number_input" required="required"/>
                    
                    <div class="checkbox">
                      <label><input type="checkbox" value="">&nbsp;<span class="fa fa-comment">&nbsp;</span>Send SMS to this number</label>
                    </div>
                                       
                </div>
                
                <div class="col-lg-5 content_div_1">
					<p class="label2" style="font-size:20px">&nbsp;</p> 
                    
                    
                    
                    
                    <p class="label2">*Patient Email ID</p>
                    <input id="txt_patient_email_id" name="req_patient_email_id"  maxlength="50" type="email" class="form-control text-lowercase" required="required"/>
                    
                    <div class="checkbox">
                      <label><input type="checkbox" value="">&nbsp;<span class="fa fa-envelope">&nbsp;</span>Send Mail to this email</label>
                    </div>
                    
                    <p class="label2">*Patient Telephone no</p>
                    <input id="txt_patient_telephone_no" name="req_patient_telephone_no"  maxlength="30" type="tel" class="form-control number_input" required="required"/>
                    
                    <p class="label2">Date of Referral/Registration</p>
                    <input type="text" class="form-control need_datepicker" id="txt_patient_date_of_referral" name="req_patient_date_of_referral" value="<?php echo date("m/d/Y");?>">
                                    
                    <p class="label2">Referral County</p>
                    <input type="text" class="form-control guessing_word_need" name="req_patient_referral_county" id="txt_patient_referral_county" style="text-transform:capitalize">
                    <p class="label2">Does Client have a history of violent crimes or psychiatric hospitalizations</p>
                    <select id="sel_patient_is_psychiatric_hosp" style="height:43px" name="req_patient_is_psychiatric_hosp" class="form-control">
                    <option value="">Choose</option>
                    <option value="Yes">Yes</option>
                    <option value="No">No</option>
                    </select>
							                    
                    <span class="sec_psychiatric">

                    <p class="label2">If yes please explain</p>
                    <textarea class="form-control" id="txt_patient_exp_psychiatric_hosp"  name="req_patient_exp_psychiatric_hosp" style=""></textarea>
                    </span>
                    
                    <p class="label2">Drugs Use History</p>
                    <textarea class="form-control" id="txt_patient_drug_use_history" name="req_patient_drug_use_history" style=""></textarea>
                                    
                    <p class="label2">Reason for Referral</p>
                    <textarea class="form-control" id="txt_patient_reason_for_referral" name="req_patient_reason_for_referral" style="" ></textarea>
                                    
                    <p class="label2">Diagnosis (if known)</p>
                    <textarea class="form-control"  id="txt_patient_diagnosis" name="req_patient_diagnosis" style="text-transform:capitalize"></textarea>
                                    
                    <p class="label2">Recommended Level of Care</p>
                    <textarea class="form-control"  id="txt_patient_level_of_care" name="req_patient_level_of_care" style=""></textarea>
                                    
                    <p class="label2">Recommended Program (please specify English or Spanish program)</p>
                    <select class="form-control" style="height:43px" id="sel_req_patient_recommended_program" name="req_patient_recommended_program">
                    	<option value="">Choose</option>
                        <option value="Program_1">Program_1</option>
                        <option value="Program_2">Program_2</option>
                        <option value="Program_3">Program_3</option>
                        <option value="Program_4">Program_4</option>
                    </select>
                    
                    <p class="label2">Patient/guardian signed HIPAA NPP</p>
                    <select class="form-control" style="height:43px" id="sel_patient_hipaa" name="req_patient_hipaa">
                    	<option value="">Choose</option>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                    </select>
                                        
                    <p class="label2">PCP Release</p>
                    <select class="form-control" style="height:43px" id="sel_patient_pcp_release" name="req_patient_pcp_release">
                    	<option value="">Choose</option>
                        <option value="Patient consented to release information">Patient consented to release information</option>
                        <option value="Patient declined to release information">Patient declined to release information</option>
                        <option value="No">No</option>
                    </select>  
                    
                    <p class="label2">Languages</p>
                    <input id="txt_patient_langauage" name="req_patient_langauage"  maxlength="30" type="tel" class="form-control text-capitalize"/>               
                    
                    
                    <p class="label2">Patient Description</p>
                    <textarea id="txt_patient_description" maxlength="255" name="req_patient_desc" class="form-control" ></textarea>    
                    <input type="submit" name="submit" id="btn_save_patient_full_reg" class="d-none" value="save" />
                    
                    
                    
                </div>
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button onclick=$("#btn_save_patient_full_reg")[0].reset() type="button" class="btn btn-light" data-dismiss="modal"><span class="fa fa-times">&nbsp;</span>Cancel</button>
        <button onclick=$("#btn_save_patient_full_reg")[0].reset() type="button" class="btn btn-light"><span class="fa fa-redo">&nbsp;</span>Reset</button>
        <button onclick=$("#btn_save_patient_full_reg").click() type="button" class="btn btn-light"><span class="fa fa-save">&nbsp;</span>Save</button>
      </div>
    </div>
  </div>
</div>
<!--full registration modal-->
</section>

<!--front_desk--icons-->