<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!---nav---bar--->
<script>
$(document).ready(
function()
{
	$('.dropdown-menu a.dropdown-toggle').on('click', function(e) {
	  if (!$(this).next().hasClass('show')) {
		$(this).parents('.dropdown-menu').first().find('.show').removeClass("show");
	  }
	  var $subMenu = $(this).next(".dropdown-menu");
	  $subMenu.toggleClass('show');
	
	
	  $(this).parents('li.nav-item.dropdown.show').on('hidden.bs.dropdown', function(e) {
		$('.dropdown-submenu .show').removeClass("show");
	  });
	
	
	  return false;
	});
});
</script>
<style>
.dropdown-submenu {
  position: relative;
}

.dropdown-submenu a::after {
  transform: rotate(-90deg);
  position: absolute;
  right: 6px;
  top: 20px;
}

.dropdown-submenu .dropdown-menu {
  top: 0;
  left: 100%;
  margin-left: .1rem;
  margin-right: .1rem;
}
</style>
<div class="row">
	<div class="col-lg-12">
    	<!--nav--bar-->
        	<div class="top_menu_bar">
              	<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
                  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                  </button>
                  <div class="">
                  	 <a class="navbar-brand" href="<?php echo $this->config->item("base_url");?>index.php/dashboard/front_desk">
                                <img src="<?php echo $this->config->item("rest_server_url");?>assets/images/site_images/company_logo.png" width="25px"/>
                                <span class="font-weight-bold" style="overflow:scroll"><?php echo strtoupper($_SESSION["entry_plus_v2"]["company_name"]);?></span>
                     </a>
                  </div>
                  <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
                    
                    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                     	
                        <li class="nav-item">
                        		
                        		  
                                  <div class="dropdown" title="Peoples">
                                  		  
                                          <div   class="need_hover btn gst_round dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                               <img src="<?php echo $this->config->item("rest_server_url");?>assets/images/icons/peoples.png" width="40px" />&nbsp;Peoples
                                          </div>
                                          <div class="dropdown-menu shadow-lg" aria-labelledby="dropdownMenuButton" style="">
                                          	  <a class="dropdown-item need_hover" href="<?php echo $this->config->item("base_url");?>index.php/dashboard/patients"><img src="<?php echo $this->config->item("rest_server_url");?>assets/images/icons/patients.png" width="40px" />&nbsp;Patients</a>
                                              
                                              <a class="dropdown-item need_hover" href="<?php echo $this->config->item("base_url");?>index.php/dashboard/referrals"><img src="<?php echo $this->config->item("rest_server_url");?>assets/images/icons/referrals.png" width="40px" />&nbsp;Referrals</a>
                                              
                                              <a class="dropdown-item need_hover" href="<?php echo $this->config->item("base_url");?>index.php/dashboard/staffs"><img src="<?php echo $this->config->item("rest_server_url");?>assets/images/icons/staffs.png" width="40px" />&nbsp;Staffs</a>
                                              
                                              <a class="dropdown-item need_hover" href="<?php echo $this->config->item("base_url");?>index.php/dashboard/doctors"><img src="<?php echo $this->config->item("rest_server_url");?>assets/images/icons/doctors.png" width="40px" />&nbsp;Doctors</a>
                                          </div>
                               		</div>
                        </li>
                        
                        
                        <li class="nav-item">
                                 	<div class="dropdown" title="Entries">
                                          <div   class="need_hover btn gst_round dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                               <img src="<?php echo $this->config->item("base_url");?>assets/images/icons/entries.png" width="40px" />&nbsp;Entries
                                               
                                          </div>
                                          <div class="dropdown-menu shadow-lg" aria-labelledby="dropdownMenuButton" style="">
                                          	  <a class="dropdown-item need_hover" href="<?php echo $this->config->item("base_url");?>index.php/dashboard/programs"><img src="<?php echo $this->config->item("rest_server_url");?>assets/images/icons/programs.png" width="40px" />&nbsp;Programs</a>
                                          	  <a class="dropdown-item need_hover" href="<?php echo $this->config->item("base_url");?>index.php/dashboard/check_in"><img src="<?php echo $this->config->item("rest_server_url");?>assets/images/icons/check_in.png" width="40px" />&nbsp;Check-in</a>
                                              <a class="dropdown-item need_hover" href="<?php echo $this->config->item("base_url");?>index.php/dashboard/drugtest"><img src="<?php echo $this->config->item("rest_server_url");?>assets/images/icons/drugtest.png" width="40px" />&nbsp;Drugtest</a>
                                              
                                              <a class="dropdown-item need_hover" href="<?php echo $this->config->item("base_url");?>index.php/dashboard/sessions"><img src="<?php echo $this->config->item("rest_server_url");?>assets/images/icons/sessions.png" width="40px" />&nbsp;Sessions</a>
                                              <a class="dropdown-item need_hover" href="#"><img src="<?php echo $this->config->item("rest_server_url");?>assets/images/icons/treatment_plan.png" width="40px" />&nbsp;Treatment plan</a>
                                              <a class="dropdown-item need_hover" href="#"><img src="<?php echo $this->config->item("rest_server_url");?>assets/images/icons/sub_notes.png" width="40px" />&nbsp;Sub notes</a>
                                              <a class="dropdown-item need_hover" href="#"><img src="<?php echo $this->config->item("rest_server_url");?>assets/images/icons/documents.png" width="40px" />&nbsp;Documents</a>
                                          </div>
                               		</div>
                         </li>
                         
                         
                          <li class="nav-item">
                                  <div class="dropdown" title="Schedules">
                                          <div   class="need_hover btn gst_round dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                               <img src="<?php echo $this->config->item("rest_server_url");?>assets/images/icons/schedules.png" width="40px" />&nbsp;Schedules
                                               
                                          </div>
                                          <div class="dropdown-menu shadow-lg" aria-labelledby="dropdownMenuButton" style="">
                                              <a class="dropdown-item need_hover" href="<?php echo $this->config->item("base_url");?>index.php/dashboard/reminders"><img src="<?php echo $this->config->item("rest_server_url");?>assets/images/icons/reminders.png" width="40px" />&nbsp;Reminders </a>
                                              <!--
                                              <a class="dropdown-item need_hover" href="#"><img src="<?php echo $this->config->item("rest_server_url");?>assets/images/icons/todo_list.png" width="40px" />&nbsp;To Do lists</a>
                                              -->
                                          </div>
                               		</div>
                           </li>
                                
                   		<li class="nav-item dropdown">
                         <div   class="need_hover btn gst_round dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                               <img src="<?php echo $this->config->item("rest_server_url");?>assets/images/icons/misc.png" width="40px" />&nbsp;Misc
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                          <a class="dropdown-item need_hover" href="<?php echo $this->config->item("base_url");?>index.php/dashboard/configurations">
                          <img src="<?php echo $this->config->item("rest_server_url");?>assets/images/icons/management.png" width="40px" />&nbsp;Configurations
                          </a>
                          	<!--
                            <ul class="dropdown-menu">
                                           
                				<li><a class="dropdown-item need_hover" href="#"><img src="<?php //echo $this->config->item("rest_server_url");?>assets/images/icons/bills.png" width="40px" />&nbsp;Bills </a></li>
                          		<li><a class="dropdown-item need_hover" href="#"><img src="<?php //echo $this->config->item("rest_server_url");?>assets/images/icons/reports.png" width="40px" />&nbsp;Reports</a></li>
                                                            
                            </ul>
                            -->
                            </li>
                        </ul>
                      </li>
                      
                       <!--super admin tasks-->
                       <li class="nav-item">
                                  <div class="dropdown" title="Peoples">
                                          <div   class="need_hover btn gst_round dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                               <img src="<?php echo $this->config->item("rest_server_url");?>assets/images/icons/super_admin.png" width="40px" />&nbsp;Super admin
                                          </div>
                                          <div class="dropdown-menu shadow-lg" aria-labelledby="dropdownMenuButton" style="">
                                          	  <a class="dropdown-item need_hover" href="<?php echo $this->config->item("base_url");?>index.php/dashboard/api_clients/"><img src="<?php echo $this->config->item("rest_server_url");?>assets/images/icons/api_clients.png" width="40px" />&nbsp;Create new api client</a>
                                          </div>
                               	 </div>
                        </li>
                        <!--super admin tasks-->
                    </ul>
                    
                                 <div class="dropdown" title="Schedules" >
                                          <div   class="need_hover btn gst_round dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                               <img src="<?php echo $this->config->item("rest_server_url");?>assets/images/icons/staffs.png" width="40px" title="Balaji Mariappan"/>&nbsp;Hi, Balaji...
                                          </div>
                                          
                                          <div style="z-index:1001" class="dropdown-menu shadow-lg" aria-labelledby="dropdownMenuButton" style="">
                                          	   <p align="center">
                                               		<img src="<?php echo $this->config->item("rest_server_url");?>assets/images/icons/staffs.png" width="100px" />
                                               </p>
                                          	   
                                              <a class="dropdown-item need_hover" href="#"><span class="fa fa-user"></span>&nbsp;&nbsp;Profile </a>
                                              <a class="dropdown-item need_hover" href="javascript:logout()"><span class="fa fa-sign-out-alt"></span>&nbsp;Logout</a>
                                          </div>
                               		</div>
                  
                  </div>
                </nav>
            </div>
        <!--nav--bar-->
    </div>
    </div>
</div>
<!---nav---bar--->