<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<script>
$(document).ready(
function(e)
{
	//alert("ok");
	//onloading function calls
	get_staff_role();
	view_staff_role();
	//onloading function calls
	$("#staff_role_entry_form").submit(
		function(e)
		{
			$url = $("#hid_base_url").val()+"index.php/core/dashboard/configurations/staff_role/add_new";
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
								$("#staff_role_entry_form")[0].reset();
								toastr.success($arr.msg);
								//window.location.replace($("#hid_base_url").val()+"index.php/dashboard/front_desk");
							}
							else 
							{
								toastr.error($arr.msg);
							}
							
							get_staff_role();
							view_staff_role();
							
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
});

	function delete_staff_role($auto_id_0)
	{
		if(window.confirm("Are you sure to delete that record?"))
		{
			//alert($("#staff_role_table_row_"+$auto_id_0).attr("staff_role"));
			$.post($("#hid_base_url").val()+"index.php/core/dashboard/configurations/staff_role/delete",
			{
				req_staff_role:$("#staff_role_table_row_"+$auto_id_0).attr("staff_role")
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
		    $.post($("#hid_base_url").val()+"index.php/core/dashboard/configurations/staff_role/view",
			{
				
			},
			function(data)
			{
				//alert(data);
				try
				{
					
					
					data = data.trim();
					$arr = JSON.parse(data);
					
					$outp='<table class="table shadow-sm table-hover table-striped"> <thead> <tr> <th colspan="2">Staffs list</th> </tr></thead> <tbody>';
					
					for($i=0; $i<$arr.length; $i++)
					{
						if($arr[$i].result != false)
						{					
						$outp=$outp + '<tr id="staff_role_table_row_'+$arr[$i].auto_id_0+'" staff_role = "'+$arr[$i].staff_role+'"> <td> '+$arr[$i].staff_role+' <div class="small-txt"> <span class="fa fa-align-left">&nbsp;</span>'+$arr[$i].staff_role_desc+' <div><span class="fa fa-user">&nbsp;</span>'+$arr[$i].created_by+' | <span class="fa fa-clock">&nbsp;</span>'+$arr[$i].created_at+'</div></div></td><td> <div class="btn btn-light" onclick="delete_staff_role('+$arr[$i].auto_id_0+')"><span class="fa fa-trash"></span></div></td></tr>';
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
		//alert("ok");
		$.post($("#hid_base_url").val()+"index.php/core/dashboard/configurations/staff_role/get_staff_role",
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
						
						for($i=0; $i<$arr.length; $i++)
						{
							if($arr[$i].result == true)
							{						
								$outp = $outp+'<option value="'+$arr[$i].staff_role+'">'+$arr[$i].staff_role+'</option>';
							}
						}
						
						$(".sel_staff_role").html($outp);
					}
				}
				catch(err)
				{
					alert("EXCEPTION:"+data);
				}
				
				//view_staff_role();
		});
};

function add_new_staff_role()
{
	$("#staff_role_modal").modal(
	 {
		backdrop:"static",
		keypress:"false"
	 }
	);
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
                    <input id="txt_staff_role" name="req_staff_role"  maxlength="30" type="text" class="form-control" required="required"/>
                </div>
                
                <div class="col-lg-5 content_div_1">
                	<p class="label2">Description</p>
                    <textarea id="txt_staff_role_desc" name="req_staff_role_desc" maxlength="255" type="text" class="form-control"></textarea>
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
</section>
