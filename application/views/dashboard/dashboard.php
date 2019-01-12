<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!--front_desk--icons-->
<style>
.card_1
{
	min-height:300px;
}
</style>
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
                    	<img src="<?php echo $this->config->item("rest_server_url");?>assets/images/site_images/company_logo.png" width="40px" /><span class="font-weight-bold">&nbsp;<?php echo $page_title;?>
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
                	<img src="<?php echo $this->config->item("rest_server_url");?>assets/images/site_images/company_logo.png" width="100px"/>
                </p>
                <p align="center">
                <?php echo strtoupper($_SESSION["entry_plus_v2"]["company_name"]);?>
                </p>
             </div>    
             <!--<div class="shadow-sm">
             	<div class="guessing_item">
                	<p class="label2"><span class="fa fa-building">&nbsp;</span>Company name</p>
                    <p class="label3">Entryplus_main</p>
                </div>
             	<div class="guessing_item">
                	<p class="label2"><span class="fa fa-user">&nbsp;</span>Started by</p>
                    <p class="label3">Balaji</p>
                </div>
                <div class="guessing_item">
                	<p class="label2"><span class="fa fa-calendar">&nbsp;</span>Started at</p>
                    <p class="label3">2015-09-10 11:12:00</p>
                </div>
                <div class="guessing_item">
                	<p class="label2"><span class="fa fa-database">&nbsp;</span>Database size</p>
                    <p class="label3">200kb</p>
                </div>
             </div>--> 	
        </div>
    </div>
        
    <div class="col-lg-9">
    	<div id="dashboard_contents">
        
        	<!--alerts-->
            <div class="alert shadow-sm" style="zoom:0.8">
            	<div class="label1 need_hover" onclick=$(".alerts_cls").fadeToggle() style="display:block">Alerts</div>
                	<div class="alerts_cls" style="display:block">
            			<div class="row">
                        	<div class="col-lg-6">
                            	<div class=" alert shadow-sm">
                                	<p class="label1"><span class="fa fa-newspaper">&nbsp;</span>News</p>
                                    <div class="">
                                    	The quick brown fox jumps over the lazy brown dog.
                                    </div>
                                </div>
                                <div class=" alert shadow-sm">
                                	<p class="label1"><span class="fa fa-comments">&nbsp;</span>Chats</p>
                                    <div class="">
                                    	The quick brown fox jumps over the lazy brown dog.
                                    </div>
                                </div>
                                <div class=" alert shadow-sm">
                                	<p class="label1"><span class="fa fa-exclamation-triangle">&nbsp;</span>Popups</p>
                                    <div class="">
                                    	The quick brown fox jumps over the lazy brown dog.
                                    </div>
                                </div>
                                <div class=" alert shadow-sm">
                                	<p class="label1"><span class="fa fa-envelope">&nbsp;</span>Mails</p>
                                    <div class="">
                                    	The quick brown fox jumps over the lazy brown dog.
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 content_div_1">
                            	<div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
                                  <div class="carousel-inner">
                                    <div class="carousel-item active">
                                      <img class="d-block w-100" src="<?php echo $this->config->item("rest_server_url");?>assets/images/slider_1/1.png" alt="First slide">
                                    </div>
                                    <div class="carousel-item">
                                      <img class="d-block w-100" src="<?php echo $this->config->item("rest_server_url");?>assets/images/slider_1/2.png" alt="Second slide">
                                    </div>
                                    <div class="carousel-item">
                                      <img class="d-block w-100" src="<?php echo $this->config->item("rest_server_url");?>assets/images/slider_1/3.png" alt="Second slide">
                                    </div>
                                    <div class="carousel-item">
                                      <img class="d-block w-100" src="<?php echo $this->config->item("rest_server_url");?>assets/images/slider_1/4.png" alt="Second slide">
                                    </div>
                                    <div class="carousel-item">
                                      <img class="d-block w-100" src="<?php echo $this->config->item("rest_server_url");?>assets/images/slider_1/5.png" alt="Second slide">
                                    </div>
                                    <div class="carousel-item">
                                      <img class="d-block w-100" src="<?php echo $this->config->item("rest_server_url");?>assets/images/slider_1/6.png" alt="Second slide">
                                    </div>
                                    <div class="carousel-item">
                                      <img class="d-block w-100" src="<?php echo $this->config->item("rest_server_url");?>assets/images/slider_1/7.png" alt="Second slide">
                                    </div>
                                    <div class="carousel-item">
                                      <img class="d-block w-100" src="<?php echo $this->config->item("rest_server_url");?>assets/images/slider_1/8.png" alt="Second slide">
                                    </div>
                                    <div class="carousel-item">
                                      <img class="d-block w-100" src="<?php echo $this->config->item("rest_server_url");?>assets/images/slider_1/9.png" alt="Second slide">
                                    </div>
                                    <div class="carousel-item">
                                      <img class="d-block w-100" src="<?php echo $this->config->item("rest_server_url");?>assets/images/slider_1/10.png" alt="Second slide">
                                    </div>
                                  </div>
                            	</div>
                            </div>
                        </div>
                    </div>
                </div>
            <!--alerts-->
        
        	<!--today result--->
            <div class="alert shadow-sm" style="zoom:0.8">
            	<div class="label1 need_hover" onclick=$(".today_tasks_cls").fadeToggle() style="display:block">Today tasks</div>
                	<div class="today_tasks_cls" style="display:block">
            			<div class="row">
                        	<div class="col-lg-12">
                            	<div class="card_1 alert">
                                	<table class="table table-bordered table-striped table-hover">
                                    	<thead class="btn-light">
                                        	<tr>
                                            	<th width="200px">Time</th>
                                                <th>Subject</th>
                                                <th>Staff</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        	<tr>
                                        		<td><span class="fa fa-clock"></span>10:00 am</td>
                                                <td>Drugtest</td>
                                                <td><span class="fa fa-user">&nbsp;</span>Balaji</td>
                                            </tr>
                                            <tr>
                                        		<td><span class="fa fa-clock"></span>10:00 am</td>
                                                <td>Drugtest</td>
                                                <td><span class="fa fa-user">&nbsp;</span>Balaji</td>
                                            </tr>
                                            <tr>
                                        		<td><span class="fa fa-clock"></span>10:00 am</td>
                                                <td>Drugtest</td>
                                                <td><span class="fa fa-user">&nbsp;</span>Balaji</td>
                                            </tr>
                                            <tr>
                                        		<td><span class="fa fa-clock"></span>10:00 am</td>
                                                <td>Drugtest</td>
                                                <td><span class="fa fa-user">&nbsp;</span>Balaji</td>
                                            </tr>
                                            <tr>
                                        		<td><span class="fa fa-clock"></span>10:00 am</td>
                                                <td>Drugtest</td>
                                                <td><span class="fa fa-user">&nbsp;</span>Balaji</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <!--today result--->
        
        	<!--in-our-system-->
            <div class="alert shadow-sm" style="zoom:0.8">
            	<div class="label1 need_hover" onclick=$(".status_cls").fadeToggle() style="display:block">Status</div>
                	<div class="status_cls" style="display:none">
            			<div class="row">
                        	<div class="col-lg-3">
                            	<div class="card_1 alert shadow-sm">
                                    <p align="center">
                                        <img src="<?php echo $this->config->item("rest_server_url");?>assets/images/icons/patients.png" width="100px"/>
                                    </p>
                                    <div class="btn btn-light btn-block">
                                    	<span class="badge badge-secondary">100</span> Patients
                                    </div>
                                    <div class="btn btn-light btn-block">
                                    	 <span class="badge badge-secondary">50</span> Intaked
                                    </div>
                                    <div class="btn btn-light btn-block">
                                    	 <span class="badge badge-secondary">10</span> Discharged
                                    </div>
                                </div>  
                            </div>
                            
                            <div class="col-lg-3">
                            	<div class="card_1 alert shadow-sm">
                                    <p align="center">
                                        <img src="<?php echo $this->config->item("rest_server_url");?>assets/images/icons/referrals.png" width="100px"/>
                                        
                                    </p>
                                    <div class="btn btn-light btn-block">
                                    	<span class="badge badge-secondary">10</span> Referrals
                                    </div>
                                </div>  
                            </div>
                            
                            <div class="col-lg-3">
                            	<div class="card_1 alert shadow-sm">
                                    <p align="center">
                                        <img src="<?php echo $this->config->item("rest_server_url");?>assets/images/icons/staffs.png" width="100px"/>
                                    </p>
                                    <div class="btn btn-light btn-block">
                                    	<span class="badge badge-secondary">30</span> Staffs
                                    </div>
                                </div>  
                            </div>
                            
                            <div class="col-lg-3">
                            	<div class="card_1 alert shadow-sm">
                                    <p align="center">
                                        <img src="<?php echo $this->config->item("rest_server_url");?>assets/images/icons/doctors.png" width="100px"/>
                                    </p>
                                     <div class="btn btn-light btn-block">
                                    	<span class="badge badge-secondary">10</span> Doctors
                                    </div>
                                </div>  
                            </div>
                        </div>
                    </div>
                </div>
            <!--in-out-system-->
            
        	<!--tasks-->
        	<div class="alert shadow-sm" style="zoom:0.8">
            	<div class="label1 need_hover" onclick=$(".task_list_cls").fadeToggle() style="display:block">Tasks</div>
                	<div class="task_list_cls" style="display:none">
            		<div id="tasks_list" class="scrolling-wrapper">
                    
                      <div class="cards">
                      	<a href="<?php echo $this->config->item("base_url");?>index.php/dashboard/patients">
                            <div class="front_icon btn-block btn btn-default need_hover">
                                <img src="<?php echo $this->config->item("base_url");?>assets/images/icons/patients.png"/>
                                <br />
                                Patients
                            </div>
                    	</a>
                      </div>
                      
                      <div class="cards">
                      	<a href="<?php echo $this->config->item("base_url");?>index.php/dashboard/referrals">
                            <div class="front_icon btn-block btn btn-default need_hover">
                                <img src="<?php echo $this->config->item("base_url");?>assets/images/icons/referrals.png"/>
                                <br />
                                Referrals
                            </div>
                        </a>
                      </div>
                      
                      <div class="cards">
                      	<a href="<?php echo $this->config->item("base_url");?>index.php/dashboard/staffs">
                            <div class="front_icon btn-block btn btn-default need_hover">
                                <img src="<?php echo $this->config->item("base_url");?>assets/images/icons/staffs.png"/>
                                <br />
                                Staffs
                            </div>
                        </a>
                      </div>
                      
                      <div class="cards">
                      	<a href="<?php echo $this->config->item("base_url");?>index.php/dashboard/doctors">
                            <div class="front_icon btn-block btn btn-default need_hover">
                                <img src="<?php echo $this->config->item("base_url");?>assets/images/icons/doctors.png"/>
                                <br />
                                Doctors
                            </div>
                        </a>
                      </div>
                      
                       <div class="cards">
                      	<a href="<?php echo $this->config->item("base_url");?>index.php/dashboard/drugtest">
                            <div class="front_icon btn-block btn btn-default need_hover">
                                <img src="<?php echo $this->config->item("base_url");?>assets/images/icons/drugtest.png"/>
                                <br />
                                Drugtest
                            </div>
                        </a>
                      </div>
                      
                      <div class="cards">
                      	<div class="front_icon btn-block btn btn-default need_hover">
                            <img src="<?php echo $this->config->item("base_url");?>assets/images/icons/sessions.png"/>
                            <br />
                            Sessions
                    	</div>
                      </div>
                      
                      <div class="cards">
                      	<div class="front_icon btn-block btn btn-default need_hover">
                            <img src="<?php echo $this->config->item("base_url");?>assets/images/icons/treatment_plan.png"/>
                            <br />
                            Treatment plan
                    	</div>
                      </div>
                      
                      <div class="cards">
                      	<div class="front_icon btn-block btn btn-default need_hover">
                            <img src="<?php echo $this->config->item("base_url");?>assets/images/icons/sub_notes.png"/>
                            <br />
                            Sub notes
                    	</div>
                      </div>
                      
                       <div class="cards">
                      	<div class="front_icon btn-block btn btn-default need_hover">
                            <img src="<?php echo $this->config->item("base_url");?>assets/images/icons/documents.png"/>
                            <br />
                            Documents
                    	</div>
                      </div>
                      
                      <div class="cards">
                      	<a href="<?php echo $this->config->item("base_url");?>index.php/dashboard/reminders">
                		<div class="front_icon btn-block btn btn-default need_hover">
                            <img src="<?php echo $this->config->item("base_url");?>assets/images/icons/reminders.png"/>
                            <br />
                            Reminders
                    	</div>
                    </a>
                      </div>
                      
                      <div class="cards">
                      	<div class="front_icon btn-block btn btn-default need_hover">
                            <img src="<?php echo $this->config->item("base_url");?>assets/images/icons/bills.png"/>
                            <br />
                            Bills
                    	</div>
                      </div>
                      
                      <div class="cards">
                      	<div class="front_icon btn-block btn btn-default need_hover">
                            <img src="<?php echo $this->config->item("base_url");?>assets/images/icons/reports.png"/>
                            <br />
                            Reports
                    	</div>
                      </div>
                      
                      <div class="cards">
                      	<div class="front_icon btn-block btn btn-default need_hover">
                            <img src="<?php echo $this->config->item("base_url");?>assets/images/icons/management.png"/>
                            <br />
                            Management
                    	</div>
                      </div>
                      
                    </div><br />
                    <center><div id="tasks_list_scroll_left" class="btn round_btn" title="Left">
                        <span class="fa fa-chevron-left"></span>
                    </div>
                    <div id="tasks_list_scroll_right" class="btn round_btn" title="Right">
                        <span class="fa fa-chevron-right"></span>
                    </div></center>
                    </div>
                </div>
            </div>   	
            <!--tasks-->
        </div>
    </div>
</div>
</section>


<script>
$(document).ready(function(e) {
    
	
		$("#tasks_list_scroll_left").click(
		function(e)
		{
			e.stopPropagation();
			var leftPos = $('#tasks_list').scrollLeft();
  			$("#tasks_list").animate({scrollLeft: leftPos - 200}, 800);
		});
		
		$("#tasks_list_scroll_right").click(
		function(e)
		{
			e.stopPropagation();
			var rightpos = $('#tasks_list').scrollLeft();
  			$("#tasks_list").animate({scrollLeft: rightpos + 200}, 800);
		});
	
});
</script>
