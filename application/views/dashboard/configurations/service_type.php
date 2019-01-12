<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<script>
$(document).ready(
function(e)
{
	//alert("ok");
	//onloading function calls
	get_service_type();
	view_service_type();
	//onloading function calls
	$("#service_type_entry_form").submit(
		function(e)
		{
			$url = $("#hid_base_url").val()+"index.php/core/dashboard/configurations/service_type/add_new";
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
								$("#service_type_entry_form")[0].reset();
								toastr.success($arr.msg);
								//window.location.replace($("#hid_base_url").val()+"index.php/dashboard/front_desk");
							}
							else 
							{
								toastr.error($arr.msg);
							}
							
							get_service_type();
							view_service_type();
							
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

	function delete_service_type($auto_id_0)
	{
		if(window.confirm("Are you sure to delete that record?"))
		{
			//alert($("#service_type_table_row_"+$auto_id_0).attr("staff_type"));
			$.post($("#hid_base_url").val()+"index.php/core/dashboard/configurations/service_type/delete",
			{
				req_service_type:$("#service_type_table_row_"+$auto_id_0).attr("staff_type")
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
								$("#service_type_table_row_"+$auto_id_0).fadeOut(1000);
								$("#service_type_table_row_"+$auto_id_0).addClass("bg-danger");
								toastr.success($arr.msg);
								//window.location.replace($("#hid_base_url").val()+"index.php/dashboard/front_desk");
							}
							else 
							{
								toastr.error($arr.msg);
							}
							
							setTimeout(view_service_type,1000);
							get_service_type();
				}
				catch(err)
				{
					alert("EXCEPTION : "+err.message);
				}
			});
		}
	}

function view_service_type()
{
		    $.post($("#hid_base_url").val()+"index.php/core/dashboard/configurations/service_type/view",
			{
				
			},
			function(data)
			{
				try
				{
					
					
					data = data.trim();
					$arr = JSON.parse(data);
					
					$outp='<table class="table shadow-sm table-hover table-striped"> <thead> <tr> <th colspan="2">Service type</th> </tr></thead> <tbody>';
					
					////alert(data);
					for($i=0; $i<$arr.length; $i++)
					{
						if($arr[$i].result != false)
						{					
						$outp=$outp + '<tr id="service_type_table_row_'+$arr[$i].auto_id_0+'" staff_type = "'+$arr[$i].service_type+'"> <td> '+$arr[$i].service_type+' <div class="small-txt"> <span class="fa fa-align-left">&nbsp;</span>'+$arr[$i].service_type_desc+' <div><span class="fa fa-user">&nbsp;</span>'+$arr[$i].created_by+' | <span class="fa fa-clock">&nbsp;</span>'+$arr[$i].created_at+'</div></div></td><td> <div class="btn round_btn" onclick="delete_service_type('+$arr[$i].auto_id_0+')"><span class="fa fa-trash"></span></div></td></tr>';
						}
					}
					
						$outp = $outp + '</tbody></table>';
						
						$("#view_service_type").html($outp);
						
						
				}
				catch(err)
				{
					alert("EXCEPTION:"+err.message);
				}
			});
}


function get_service_type()
{
		//alert("ok");
		$.post($("#hid_base_url").val()+"index.php/core/dashboard/configurations/service_type/get_service_type",
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
						
						$outp='<option value="">Choose service type</p>';
						
						for($i=0; $i<$arr.length; $i++)
						{
							if($arr[$i].result == true)
							{						
								$outp = $outp+'<option value="'+$arr[$i].service_type+'">'+$arr[$i].service_type+'</option>';
							}
						}
						
						$(".sel_service_type").html($outp);
					}
				}
				catch(err)
				{
					alert("EXCEPTION:"+data);
				}
				
				//view_service_type();
		});
};

function add_new_service_type()
{
	//alert("ok");
	$("#service_type_modal").modal(
	 {
		backdrop:"static",
		keypress:"false"
	 }
	);
}
</script>
<!--staff_role-->
<div class="modal fade modal-child" data-backdrop-limit="4" id="service_type_modal" style="z-index:1800; overflow:auto" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Service type</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="service_type_entry_form">
          	<div class="row">
            	<div class="col-lg-1">
                </div>
            	<div class="col-lg-4 content_div_1">
                    <p class="label2">*New service type </p>
                    <input id="txt_service_type" name="req_service_type"  maxlength="30" type="text" class="form-control text-capitalize" required="required"/>
                </div>
                
                <div class="col-lg-5 content_div_1">
                	<p class="label2">Description</p>
                    <textarea id="txt_service_type_desc" name="req_service_type_desc" maxlength="255" type="text" class="form-control"></textarea>
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
                	<div id="view_service_type" class="card shadow-sm">
                  	
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
