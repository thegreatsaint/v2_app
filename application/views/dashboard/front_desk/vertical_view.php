<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!--front_desk--icons-->
<div id="vertical_view_icon" style="display:none" class="row content_div_1">
	<div class="col-lg-1">
    </div>
    <div class="col-lg-10">
    	<div class="front_icons_section">
        	<!--topic bar-->
            <div class="breadcrumps_section">
                <div class="topic_bar">
                    <div class="btn btn-default">
                        <span class="fa fa-arrow-left" title="Go previous"></span>
                    </div>
                    <div class="btn btn-default">
                        <span class="fa fa-arrow-right" title="Go next"></span>
                    </div>
                    <div class="btn btn-default">
                        <img src="<?php echo $this->config->item("base_url");?>assets/images/icons/front_desk.png" width="40px" /><span class="font-weight-bold">&nbsp;<?php echo $page_title;?></span>
                    </div>
                </div>
            </div>
            <!--topic bar-->
            
            <div style="overflow:scroll; overflow-y:hidden; padding-right:30px;">
            <table  width="" cellpadding="5px">
            	<tr>
                	<td style="width:300px;" valign="top">
                    	<div>
                    	<div class="alert">
                                <span><img src="<?php echo $this->config->item("base_url");?>assets/images/icons/peoples.png" width="40px" /><span class="font-weight-normal font-weight-bold">&nbsp;Peoples</span>
                                </span>
                        </div>
            
                        <!--icons-->
                        <div class="row">
                        	<a href="<?php echo $this->config->item("base_url");?>index.php/dashboard/patients">
                            <div class="col-lg-12">
                                <div class="front_icon btn-block btn btn-default need_hover">
                                    <img src="<?php echo $this->config->item("base_url");?>assets/images/icons/patients.png"/>
                                    <br />
                                    Patients
                                </div>
                            </div>
                            </a>
                            
                            <a href="<?php echo $this->config->item("base_url");?>index.php/dashboard/referrals">
                            <div class="col-lg-12">
                                <div class="front_icon btn-block btn btn-default need_hover">
                                    <img src="<?php echo $this->config->item("base_url");?>assets/images/icons/referrals.png"/>
                                    <br />
                                    Referrals
                                </div>
                            </div>
                            </a>
                            
                            <div class="col-lg-12">
                            	<a href="<?php echo $this->config->item("base_url");?>index.php/dashboard/staffs">
                                <div class="front_icon btn-block btn btn-default need_hover">
                                    <img src="<?php echo $this->config->item("base_url");?>assets/images/icons/staffs.png"/>
                                    <br />
                                    Staffs
                                </div>
                                </a>
                            </div>
                            
                            <div class="col-lg-12">
                                <div class="front_icon btn-block btn btn-default need_hover">
                                    <img src="<?php echo $this->config->item("base_url");?>assets/images/icons/doctors.png"/>
                                    <br />
                                    Doctors
                                </div>
                            </div>
                        </div>
                        </div>
                    </td>
                    
                    <td style="width:300px;"   valign="top">
                    	
                    	
                    	<div class="alert">
                            <span><img src="<?php echo $this->config->item("base_url");?>assets/images/icons/entries.png" width="40px" /><span class="font-weight-normal font-weight-bold">&nbsp;Entries</span>
                            </span>
                        </div>
                        <!--icons-->
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="front_icon btn-block btn btn-default need_hover">
                                    <img src="<?php echo $this->config->item("base_url");?>assets/images/icons/drugtest.png"/>
                                    <br />
                                    Drugtest
                                </div>
                            </div>
                            
                            <div class="col-lg-12">
                                <div class="front_icon btn-block btn btn-default need_hover">
                                    <img src="<?php echo $this->config->item("base_url");?>assets/images/icons/sessions.png"/>
                                    <br />
                                    Sessions
                                </div>
                            </div>
                            
                            <div class="col-lg-12">
                                <div class="front_icon btn-block btn btn-default need_hover">
                                    <img src="<?php echo $this->config->item("base_url");?>assets/images/icons/treatment_plan.png"/>
                                    <br />
                                    Treatment plan
                                </div>
                            </div>
                            
                            <div class="col-lg-12">
                                <div class="front_icon btn-block btn btn-default need_hover">
                                    <img src="<?php echo $this->config->item("base_url");?>assets/images/icons/sub_notes.png"/>
                                    <br />
                                    Sub notes
                                </div>
                            </div>
                            
                            <div class="col-lg-12">
                                <div class="front_icon btn-block btn btn-default need_hover">
                                    <img src="<?php echo $this->config->item("base_url");?>assets/images/icons/documents.png"/>
                                    <br />
                                    Documents
                                </div>
                            </div>
                            
                        </div>
                        <!--icons-->
                    </td>
                    
                    <td style="width:300px;"   valign="top">
                    	
                        <div class="alert">
                            <span><img src="<?php echo $this->config->item("base_url");?>assets/images/icons/schedules.png" width="40px" /><span class="font-weight-normal font-weight-bold">Schedules</span>
                            </span>
                        </div>
                        <!--icons-->
                        <div class="row">
                            <div class="col-lg-12">
                            	<a href="<?php echo $this->config->item("base_url");?>index.php/dashboard/reminders">
                                <div class="front_icon btn-block btn btn-default need_hover">
                                    <img src="<?php echo $this->config->item("base_url");?>assets/images/icons/reminders.png"/>
                                    <br />
                                    Reminders
                                </div>
                                </a>
                            </div>
                            
                            <div class="col-lg-12">
                            <!--
                                <div class="front_icon btn-block btn btn-default need_hover">
                                    <img src="<?php echo $this->config->item("base_url");?>assets/images/icons/todo_list.png"/>
                                    <br />
                                    Todo list
                                </div>
                                -->
                            </div>
                        </div>
                    </td>
                    
                    <td style="width:300px;"   valign="top">
                    	
                        <div class="alert">
                            <span><img src="<?php echo $this->config->item("base_url");?>assets/images/icons/misc.png" width="40px" /><span class="font-weight-normal font-weight-bold">&nbsp;Misc</span>
                            </span>
                        </div>
                        
                        <!--icons-->
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="front_icon btn-block btn btn-default need_hover">
                                    <img src="<?php echo $this->config->item("base_url");?>assets/images/icons/bills.png"/>
                                    <br />
                                    Bills
                                </div>
                            </div>
                            
                            <div class="col-lg-12">
                                <div class="front_icon btn-block btn btn-default need_hover">
                                    <img src="<?php echo $this->config->item("base_url");?>assets/images/icons/reports.png"/>
                                    <br />
                                    Reports
                                </div>
                            </div>
                            
                            <div class="col-lg-12">
                                <div class="front_icon btn-block btn btn-default need_hover">
                                    <img src="<?php echo $this->config->item("base_url");?>assets/images/icons/management.png"/>
                                    <br />
                                    Management
                                </div>
                            </div>
                        </div>
                    </td>
                   
                </tr>
            </table>
            </div>
        
        </div>
    </div>
    <div class="col-lg-1">
    </div>
</div>
<!--front_desk--icons-->