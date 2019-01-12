<!--css--menu-->
<link rel="stylesheet" href="<?php echo $this->config->item("rest_server_url");?>/assets/css_menu_2/styles.css" />
<script src="<?php echo $this->config->item("rest_server_url");?>/assets/css_menu_2/script.js"></script>


 <!--css menu-->
            <div class="container">
                <div id='cssmenu' style="background-color:#fff; color:#111; z-index:100">
                    <ul>
                       <li><a href='#'>General</a></li>
                       <li class='active'><a href='#'>Entries</a>
                          <ul>
                             <li><a href='<?php echo $this->config->item("base_url");?>index.php/device_category'>Device Category</a>
                                <ul>
                                   <li><a href='<?php echo $this->config->item("base_url");?>index.php/device_category#entry_section'><span class="fa fa-plus-circle">&nbsp;</span>Add new</a></li>
                                   <li><a href='<?php echo $this->config->item("base_url");?>index.php/device_category#view_section'><span class="fa fa-search">&nbsp;</span>View</a></li>
                                </ul>
                             </li>
                             <li><a href='#'>Device Status</a>
                                <ul>
                                   <li><a href='<?php echo $this->config->item("base_url");?>index.php/device_status#entry_section'><span class="fa fa-plus-circle">&nbsp;</span>Add new</a></li>
                                   <li><a href='<?php echo $this->config->item("base_url");?>index.php/device_status#view_section'><span class="fa fa-search">&nbsp;</span>View</a></li>
                                </ul>
                             </li>
                          </ul>
                       </li>
                    </ul>
                </div>
            </div>
<!--css menu-->