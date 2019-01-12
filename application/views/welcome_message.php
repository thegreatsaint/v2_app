<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<?php
// I'm India so my timezone is Asia/Calcutta
date_default_timezone_set($this->config->item("time_zone"));

// 24-hour format of an hour without leading zeros (0 through 23)
$Hour = date('G');

if ( $Hour >= 5 && $Hour <= 11 ) {
	//echo "Good Morning";
	?>
    	<style>
		body
		{
			background:url(<?php echo $this->config->item("rest_server_url");?>assets/images/site_images/mg.jpg)
		}
		</style>
        <script>
			toastr.info("","HAVE A GOOD MORNING");
		</script>
    <?php
} else if ( $Hour >= 12 && $Hour <= 18 ) {
    //echo "Good Afternoon";
	?>
    	<style>
		body
		{
			background:url(<?php echo $this->config->item("rest_server_url");?>assets/images/site_images/day.jpg)
		}
		</style>
        <script>
			toastr.info("","HAVE A GOOD DAY");
		</script>
    <?php
} else if ( $Hour >= 19 || $Hour <= 4 ) {
    //echo "Good Evening";
	?>
    	<style>
		body
		{
			background:url(<?php echo $this->config->item("rest_server_url");?>assets/images/site_images/night.jpg)
		}
		</style>
         <script>
			toastr.info("","HAVE A GOOD DREAMS");
		</script>
    <?php
}
?>


<style>
		
.sidenav {
    height: 100%;
    width: 0;
    position: fixed;
    z-index: 1;
    top: 0;
    right: 0;
    background-color:rgba(255,255,255,0.9999);
    overflow-x: hidden;
    transition: 0.5s;
    padding-top: 60px;
}

.sidenav a {
    padding: 8px 8px 8px 32px;
    text-decoration: none;
    font-size: 25px;
    color: #818181;
    display: block;
    transition: 0.3s;
}

.sidenav .closebtn {
    position: absolute;
    top: 0;
    right: 25px;
    font-size: 36px;
    margin-left: 50px;
}

#entrance {
    transition: margin-left .5s;
}

@media screen and (max-height: 450px) {
  .sidenav {padding-top: 15px;}
  .sidenav a {font-size: 18px;}
}

.modal {
  text-align: center;
}

@media screen and (min-width: 768px) { 
  .modal:before {
    display: inline-block;
    vertical-align: middle;
    content: " ";
    height: 100%;
  }
}

.modal-dialog {
  display: inline-block;
  text-align: left;
  vertical-align: middle;
}

body
{
	overflow-x:hidden;
}
</style>

<script>
function openNav() {
    document.getElementById("mySidenav").style.width = "300px";
    //document.getElementById("entrance").style.marginLeft = "250px";
    //document.body.style.backgroundColor = "rgba(0,0,0,0.4)";
}

function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
    //document.getElementById("entrance").style.marginLeft= "0";
    //document.body.style.backgroundColor = "white";
}
</script>

<script>
$(document).ready(
function(e)
{
	$("#frm_staff_login").submit(
	function(e)
	{
			 try
			 {
				 e.preventDefault();
				 $.ajax(
				 {
					url: $("#hid_base_url").val()+"index.php/welcome/login/",
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
							if($arr.msg_type == 'success')
							{
								toastr.success($arr.msg_code+" - "+$arr.msg_desc);
								window.location.replace($("#hid_base_url").val()+"index.php/dashboard/front_desk");
							}
							else if($arr.msg_type == 'danger')
							{
								toastr.error($arr.msg_code+" - "+$arr.msg_desc);
							}
							
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
			 }
			 catch(err)
			 {
				 alert(err.message);
			 }
	});
});
</script>







<!--login-->
<div id="mySidenav" class="sidenav">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()"><span class="">&times;</span></a>
  <div class="" style="padding:10px;">
                <br />
                    <p align="center">
                        <img src="<?php echo $this->config->item("base_url");?>assets/images/site_images/company_logo.png" width="100px"/>
                    </p>
                    <form id="frm_staff_login">
                        <p class="label2 text-default"><span class="fa fa-user">&nbsp;</span>Username</p>
                        <input style="border:none; border-radius:0px; border-bottom:dotted 1px #333; background-color:transparent; width:100%; text-transform:lowercase" name="req_staff_username" onFocus=$(this).css('box-shadow','none') placeholder="Username" type="text" class="form-control" value="balaji" required/>
                        <p class="label3">&nbsp;</p>
                        <p class="label2 text-default"><span class="fa fa-key">&nbsp;</span>Password</p>
                        <input style="border:none; border-radius:0px; border-bottom:dotted 1px #333; background-color:transparent; width:100%;" name="req_staff_password" onFocus=$(this).css('box-shadow','none') placeholder="Password" type="password" class="form-control"  value="12345678" required/>
                        <p class="label3">&nbsp;</p>
                        <button class="btn btn-light btn-block"><span class="fa fa-sign-in-alt">&nbsp;</span>Login</button>
                    </form>
  </div>
</div>
<!--login-->


<div class="modal fade" id="staff_login_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog shadow-lg" role="document">
    <div class="modal-content" style="border-radius:10px;">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><span class="">&nbsp;</span>Login</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
          <div class="modal-body">
                
      	  </div>
          <div class="modal-footer">
            
          </div>
    </div>
  </div>
</div>


<!--entrance-->
<div id="entrance" class="row">
	<div class="col-lg-12">
    	<!--nav--bar-->
        	<section class="wow" data-wow-duration="1s" data-wow-delay="2s">
                <div class="nav_bar">
                	
                    <nav class="navbar navbar-expand-lg navbar-light bg-white" style="box-shadow:0px 1px 1px rgba(204,204,204,0.2); background:url(<?php echo $this->config->item("rest_server_url")?>assets/images/site_images/small_blue_tile.jpg)">
                          <button class="navbar-toggler float-right text-white" title="Menu" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="fa fa-bars"></span>
                          </button>
                      
                          <a class="navbar-brand" href="#">
                                <img src="<?php echo $this->config->item("base_url");?>assets/images/site_images/company_logo.png" width="25px"/>
                                <span class="font-weight-bold text-white"><?php echo strtoupper($_SESSION["entry_plus_v2"]["company_name"]);?></span>
                          </a>
                          <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
                            
                            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                              	<li class="nav-item"></li>
                            </ul>
                            <form class="form-inline my-3 my-lg-0">
                                 <div class="dropdown">
                                  <button onclick=openNav() class="btn btn-light dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="width:200px">
                                    <span class="fa fa-sign-in-alt">&nbsp;</span>Login
                                  </button>
                                  <!--
                                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href=javascript:openNav()><span class="fa fa-user">&nbsp;</span>Staff Login</a>
                                  </div>
                                  -->
                                </div>
                            </form>
                          </div>
                    </nav>
                </div>
</section>
        <!--nav--bar-->
    </div>
</div>
<!--entrance-->

<!--container--->
<div class="container">
	<div class="row">
    	<div class="col-lg-6">
        	<section class="wow animated fadeIn" data-wow-duration="1s" data-wow-delay="2s">
            	<h1>&nbsp;</h1>
           		<center>
            	  <img class="img-fluid" src="<?php echo $this->config->item("base_url");?>assets/images/site_images/company_logo.png" width="250px" />
                </center>
            </section>        	
        </div>
        <div class="col-lg-6">
        	<section class="wow animated fadeIn" data-wow-duration="1s" data-wow-delay="2s">
                <h1>&nbsp;</h1>
                <div class="display-2 text-white" style="font-size:5vw;">
                    Smart Rehabs Management System
                </div>
            </section>     
        </div>
    </div>
</div>
<!--container--->