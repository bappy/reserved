<?php
//echo $this->Html->script(array('jquery-1.10.2.min.js', "ui/jquery.ui.core", "ui/jquery.ui.widget", "ui/jquery.ui.datepicker", 'basic/js/jquery.simplemodal', 'clubsettings', 'vendor/modernizr-2.6.2-respond-1.1.0.min', 'vendor/js/bootstrap-switch', 'docs/vendor/prism', 'docs/index'));
//echo $this->Html->script(array('jquery-1.10.2.min.js','uploadify/js/jquery.uploadify.min', "ui/jquery.ui.core", "ui/jquery.ui.widget", "ui/jquery.ui.datepicker", 'basic/js/jquery.simplemodal', 'basic/js/basic', 'vendor/modernizr-2.6.2-respond-1.1.0.min', 'vendor/js/bootstrap-switch', 'docs/index'));
echo $this->Html->css(array("http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css", 'clubsettings/css/bootstrap', 'clubsettings/css/plugins', 'clubsettings/css/themes', 'clubsettings/css/castom', 'clubsettings/css/plugins', 'clubsettings/css/main', 'clubsettings/css/castom', 'clubsettings/css/bootstrap-switch', 'http://netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css', 'http://bdmdesign.github.io/bootstrap-switch/static/stylesheets/flat-ui-fonts.css', 'basic/css/basic'));
echo $this->Html->css(array('basic/basic', 'basic/basic_ie','utility'));
?>
<?php 
/*
?>
<div class="userRoles form">
<?php echo $this->Form->create('UserRole'); ?>
	<fieldset>
		<legend><?php echo __('Add User Role'); ?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('role_id');
		echo $this->Form->input('user_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List User Roles'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Roles'), array('controller' => 'roles', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Role'), array('controller' => 'roles', 'action' => 'add')); ?> </li>
	</ul>
</div>
<?php */ ?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">

        <title>Admin Account</title>

        <meta name="description" content="RESERVED">
        <meta name="author" content="RESERVED">
        <meta name="robots" content="RESERVED">

        <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1.0">

        <!-- Icons -->
        <!-- The following icons can be replaced with your own, they are used by desktop and mobile browsers -->
        <link rel="shortcut icon" href="img/favicon.ico">
        <link rel="apple-touch-icon" href="img/apple-touch-icon.png">
        <link rel="apple-touch-icon" sizes="57x57" href="img/apple-touch-icon-57x57-precomposed.png">
        <link rel="apple-touch-icon" sizes="72x72" href="img/apple-touch-icon-72x72-precomposed.png">
        <link rel="apple-touch-icon" sizes="114x114" href="img/apple-touch-icon-114x114-precomposed.png">
        <link rel="apple-touch-icon-precomposed" href="img/apple-touch-icon-precomposed.png">
        <!-- END Icons -->

        <!-- Stylesheets -->
        
        <!-- Bootstrap is included in its original form, unaltered -->
        <link rel="stylesheet" href="css/bootstrap.css">

        <!-- Related styles of various icon packs and javascript plugins -->
        <link rel="stylesheet" href="css/plugins.css">

        <!-- The main stylesheet of this template. All Bootstrap overwrites are defined in here -->
        <link rel="stylesheet" href="css/main.css">

        <!-- Load a specific file here from css/themes/ folder to alter the default theme of all the template -->

        <!-- The themes stylesheet of this template (for using specific theme color in individual elements (must included last) -->
        <link rel="stylesheet" href="css/themes.css">
        
		<!-- The main castom stylesheet of this admin. kb-->
        <link rel="stylesheet" href="css/castom.css">
        
        <!-- The fonts stylesheet of admin. kb -->
        <link rel="stylesheet" href="fonts/customfont.css">
        <!-- END Stylesheets -->
        
        <!-- Modernizr (Browser feature detection library) & Respond.js (Enable responsive CSS code on browsers that don't support it) -->
        <script src="js/vendor/modernizr-2.6.2-respond-1.1.0.min.js"></script>
        
		<!-- ISO CHECK BOX -->
        <link rel="stylesheet" href="css/bootstrap-switch.css" />
        <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css">
        <link rel="stylesheet" href="http://bdmdesign.github.io/bootstrap-switch/static/stylesheets/flat-ui-fonts.css">
        <!-- END ISO CHECK BOX -->
    </head>

    <!-- Body -->
    <body>
        <!-- Page Container -->
        <div id="page-container" class="full-width">
            <!-- Header -->
            <!---------------------------------->
            <div class="row-fluid">
                <div id="page-sidebar-left" class="eqHight">
                    <div class="topNav">
                        <ul class="nav">
                            <li><a href="#">RESERVED</a></li>
                        </ul>
                        <div class="clear">&nbsp;</div>
                    </div>
                    <div class="page-title">
                    	<h2><?php  echo $club_name;?></h2>
                         
                    </div>
                    <div class="left-containr">
                        <div id="side-tab-menu" class="tab-pane active">
                                <!-- Primary Navigation -->
                                <nav id="primary-nav">
                                    <ul>
                                  
                                     
                                        <li>
                                            <a href="<?php echo $this->Html->url(array('controller' => 'Clubs', 'action' => 'add')); ?>"><i class="glyphicon-cogwheels"></i>Club Setting</a>
                                        </li>
                                        
                                        <li>
                                            <a href="<?php echo $this->Html->url(array('controller' => 'UserRoles', 'action' => 'add')); ?>"><i class="glyphicon-vcard"></i>Account Settings</a>
                                        </li>
                                        <li>
                                            <a class="active" href="<?php echo $this->Html->url(array('controller' => 'Users', 'action' => 'index')); ?>"><i class="glyphicon-old_man"></i>Admin Account</a>
                                        </li>
                                        
                                    </ul>
                                </nav>
                                <!-- END Primary Navigation -->
                            </div>
                    </div>
                </div>
                <div id="page-content-right" class="eqHight">
                    <div class="topNav">
                    	<ul class="nav">
                    	
                    	 <?php 
    	if ($this->Session->read('Auth.User'))
    		{?>
   		 <li><a href="<?php echo $this->Html->url(array('controller' => 'Users', 'action' => 'logout')); ?>">Logout</a></li>
    		<?php }
    	else
   		 {
    		?>
    	<li><a href="<?php echo $this->Html->url(array('controller' => 'Users', 'action' => 'loggin')); ?>">Login</a></li>
    	<?php 
    	}
   		 ?>
                            <li><a href="#">Earnings</a></li>
                            <li><a href="#">Reservation</a></li>
                            <li><a href="#">Orders</a></li>
                            <li><a href="#">Menu &amp; Pricing</a></li>
                            <li><a href="#">Night Details</a></li>
                            <li class="dropdown dropdown-notifications user">
                                    <a data-toggle="dropdown" class="dropdown-toggle" href="javascript:void(0)">
                                        <i class="glyphicon-user"></i>
                                        <i class="icon-caret-down"></i>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <div class="alert">
                                                <i class="icon-bell"></i> <strong>App</strong> Please pay attention!
                                            </div>
                                            <div class="alert alert-error">
                                                <i class="icon-bell-alt"></i> <strong>App</strong> There was an error!
                                            </div>
                                            <div class="alert alert-info">
                                                <i class="icon-bolt"></i> <strong>App</strong> Info message!
                                            </div>
                                            <div class="alert alert-success">
                                                <i class="icon-bullhorn"></i> <strong>App</strong> Service restarted!
                                            </div>
                                        </li>
                                        <li class="divider"></li>
                                        <li>
                                            <a href="javascript:void(0)"><i class="icon-warning-sign pull-right"></i>Notification Center</a>
                                        </li>
                                    </ul>
                                </li>
                        </ul>
                        <div class="clear">&nbsp;</div>
                    </div>
                    <div class="page-title">
                    	<h2>New User</h2>
                        <div class="pull-right">
                        	<form class="form-inline">
                              <label class="checkbox">
                                <a href="#">Reset Password</a> &nbsp;&nbsp;
                              </label>
                              <button type="submit" class="btn">Cancel</button>
                              <button type="submit" class="btn">Delete</button>&nbsp;&nbsp;
                            </form>
                        </div>
                    </div>
                    <div class="basickInfirmation">
                        <h4>User Details</h4>
                    </div>
                    <h3>You are not allowed to access this page !!</h3>
                    <ul>
                    <li>You have no permission to access the page</li>
                    <li>You have not created clubs.</li>
                    </ul>
                </div>
            </div>
            <!----------------------------------->
            
            

            <!-- Footer -->
            <footer>
                <div class="pull-right">
                    Developed with  <strong>&nbsp;<i class="icon-heart"></i>&nbsp;<a href="#" target="_blank">Reserved</a></strong>
                </div>
                <div class="pull-left">
                    <span id="year-copy"></span> &copy; <strong><a href="#" target="_blank">Reserved</a></strong>
                </div>
            </footer>
            <!-- END Footer -->
        </div>
        <!-- END Page Container -->

        <!-- Scroll to top link, check main.js - scrollToTop() -->
        
        <!-- Javascript code only for this page -->
        
        
        
        
        <!-- ISO CHECK BOX -->
         
          
          <!-- END ISO CHECK BOX -->
        <!-- equalHeight JS -->
		
        
    </body>
</html>
