<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!--script-->
<script>
$(document).ready(
function(e)
{
	
	//onloading function call
	//view_staff_access();
	//onloading function call
	
	$("#sel_staff_access_role").change(
	function()
	{
		if($("#sel_staff_access_role").val() != "")
		{
			$("#hid_staff_access_role").val($("#sel_staff_access_role").val());
		}
		
		view_staff_access();
	});
	
	$("#staff_access_policy_form").submit(
		function(e)
		{
			$url = $("#hid_base_url").val()+"index.php/core/dashboard/configurations/staff_access/add_new";
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
								view_staff_access();
								//window.location.replace($("#hid_base_url").val()+"index.php/dashboard/front_desk");
							}
							else 
							{
								toastr.error($arr.msg);
							}
							
						}
						catch(ex)
						{
							alert("EXCEPTION "+ex.message+data);
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

function check_staff_role()
{
	$("#staff_access_modal").modal(
	{
		backdrop:"static",
		keypress:"false"
	});
};

function view_staff_access()
{
	//alert("ok");
		$.post($("#hid_base_url").val()+"index.php/core/dashboard/configurations/staff_access/view",
		{
			req_staff_role:$("#sel_staff_access_role").val()
		},
		function(data)
		{
			//alert(data);
			try
				{
					
					
					data = data.trim();
					$arr = JSON.parse(data);
					
					$outp='<table class="table shadow-sm table-hover table-striped"> <thead> <tr> <th></th> <th>Tasks</th> <th>Rights</th><th>Tasks</th> </tr></thead> <tbody>';
					
					for($i=0; $i<$arr.length; $i++)
					{
						
						if($arr[$i].result != false)
						{					
						$outp=$outp + '<tr id="staff_access_table_row_'+$arr[$i].auto_id_0+'" staff_task = "'+$arr[$i].task_name+'"> <td align="center" width="50px"><img src="'+$arr[$i].task_icon+'" width="50px"></td><td> '+$arr[$i].task_name+'</td><td>'+$arr[$i].rights+'</td><td><div class="btn btn-light" onclick="delete_staff_access('+$arr[$i].auto_id_0+')"><span class="fa fa-trash"></span></div></td></tr>';
						}
					}
					
						$outp = $outp + '</tbody></table>';
						
						$("#view_staff_access").html($outp);
						
						
				}
				catch(err)
				{
					alert("EXCEPTION:"+err.message);
				}
			});
	};

	function delete_staff_access($auto_id_0)
	{
		if(window.confirm("Are you sure to delete that record?"))
		{
			$.post($("#hid_base_url").val()+"index.php/core/dashboard/configurations/staff_access/delete",
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
								$("#staff_access_table_row_"+$auto_id_0).fadeOut(1000);
								$("#staff_access_table_row_"+$auto_id_0).addClass("bg-danger");
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
</script>
<!--staff_role-->

<div class="modal fade  modal-child" data-backdrop-limit="1" id="staff_access_modal" style="z-index:1500;" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Staff access policy</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">              
                
                <div class="row">
                
                    <div class="col-lg-1 content_div_1">
                        <p class="label2">&nbsp;</p>
                        <div class="btn btn-light" onclick=$("#add_staff_access_policy").fadeToggle()>
                            <span class="fa fa-plus-circle" title="Create a new policy"></span>
                        </div>
                    </div>
                    
                 	<div class="col-lg-10 alert shadow-sm" id="">
                    	<div class="row">
                              <div class="col-lg-5">
                              <p class="label2">Choose staff role</p>
                                <select id="sel_staff_access_role" style="height:43px;"  type="text" class="sel_staff_role form-control select_box" placeholder="search staff username" aria-label="Search" aria-describedby="button-addon2" />
                                </select>
                                <?php 
                                    if($this->Functions->get_staff_task_permission($_SESSION[$this->config->item("sess_cookie_name")]["staff_username"],"staffs") == 'full')
                                    {
                                ?>
                                <div class="small-txt" title="Add new">
                                    <span onclick="add_new_staff_role()" class="need_hover">
                                        <span class="fa fa-plus-circle">&nbsp;</span>Add new
                                    </span>
                                    <span>&nbsp;&nbsp;</span>
                                    <span onclick="get_staff_role()" class="need_hover" title="Refresh">
                                        <span class="fa fa-sync">&nbsp;</span>Refresh
                                    </span>                        
                                </div>
                                <?php
                                   }
                                ?>
                            </div>
                        </div>
                    </div>                    
                 
                </div>
                
                <div class="row">
                
                    <div class="col-lg-1">
                    </div>
                    
                 	<div class="col-lg-10 alert shadow-sm bg-light" style="display:none" id="add_staff_access_policy">
                    	<form id="staff_access_policy_form">
                    	<div class="row">
                            <div class="col-lg-5">
                            	<input type="hidden" name="req_staff_role" id="hid_staff_access_role" required="required"/>
                                <p class="label2">Create a new staff access policy</p>
                                <select id="" name="req_task_name" style="height:43px;"  type="text" class="form-control select_box" required/>
                                    <option value="">Choose staff role</option>
                                    <option value="app_api_clients">App_api_clients</option>
                                    <option value="doctors">Doctors</option>
                                    <option value="to_do_lists">To_do_lists</option>
                                    <option value="patients">Patients</option>
                                    <option value="referrals">Referrals</option>
                                    <option value="reminders">Reminders</option>
                                    <option value="staffs">Staffs</option>
                                    <option value="drugtest">Drugtest</option>
                                    <option value="programs">Programs</option>
                                    <option value="sessions">Sessions</option>
                                    
                                </select>
                            </div>
                        
                            <div class="col-lg-4">
                                <p class="label2">&nbsp;</p>
                                <select name="req_rights" style="height:43px;"  type="text" class="form-control select_box" required/>
                                    <option value="">Choose rights</option>
                                    <option value="full">full</option>
                                    <option value="read">read</option>
                                    <option value="write">write</option>
                                </select>
                            </div>
                        
                            <div class="col-lg-1">
                                <p class="label2">&nbsp;</p>
                                <button type="submit" class="btn btn-light" title="Add new policy">
                                    <span class="fa fa-plus-circle"></span>
                                </button>
                            </div>
                        </div>
                        </form>
                    </div>                    
                 
                </div>
             
            
        	<div class="row">
            	<div class="col-lg-1">
                </div>
            	<div class="col-lg-10 alert shadow-sm bg-light">
                	<div id="view_staff_access" class="shadow-sm">
                  		
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