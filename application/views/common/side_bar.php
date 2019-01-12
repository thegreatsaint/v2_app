<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div ud="side_bar">
<style>
.sidenav {
    height: 100%;
    width: 0;
    position: fixed;
    z-index: 1;
    top: 0;
    left: 0;
    background-color: #563d7c;
    overflow-x: hidden;
    transition: 0.5s;
    padding-top: 60px;
	border:solid 1px #CCC;
}

.sidenav a {
    padding: 3px 3px 3px 10px;
    text-decoration: none;
    font-size: 1em;
    color: #fff;
    display: block;
    transition: 0.3s;
}

.sidenav a:hover {
    color: #999;
}

.sidenav .closebtn {
    position: absolute;
    top: 0;
    right: 25px;
    font-size: 36px;
    margin-left: 50px;
}

#main_div {
    transition: margin-left .5s;
}

@media screen and (max-height: 450px) {
  .sidenav {padding-top: 15px;}
  .sidenav a {font-size: 18px;}
}
</style>
<div id="mySidenav" class="sidenav">
                <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
                <a href="<?php echo $this->config->item("base_url");?>index.php/front_desk"><span class="fa fa-circle"></span>&nbsp;
                Front Desk</a>
                 <a href="<?php echo $this->config->item("base_url");?>index.php/configuration"><span class="fa fa-circle"></span>&nbsp;
                Configuration</a>
                 <a href="<?php echo $this->config->item("base_url");?>index.php/entries"><span class="fa fa-circle"></span>&nbsp;
                Entries</a>
              
</div>

<script>

		function openNav() 
		{
    		document.getElementById("mySidenav").style.width = "250px";
			document.getElementById("main_div").style.marginLeft = "250px";
			document.getElementById("btn_side_menu_button").style.opacity = 0.0;
		}

		/* Set the width of the side navigation to 0 */
		function closeNav() 
		{
    		document.getElementById("mySidenav").style.width = "0";
			document.getElementById("main_div").style.marginLeft = "0px";
			document.getElementById("btn_side_menu_button").style.opacity = 1.0;
		}
</script>

<!--menu--button-->
