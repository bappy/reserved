<?php

echo $this->Html->script(array('jquery-1.10.2.min.js','vendor/bootstrap.min', "ui/jquery.ui.core", "ui/jquery.ui.widget", "ui/jquery.ui.datepicker", 'basic/js/jquery.simplemodal', 'clubsettings', 'vendor/modernizr-2.6.2-respond-1.1.0.min', 'vendor/js/bootstrap-switch', 'docs/vendor/prism', 'docs/index'));
    echo $this->Html->css(array("http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css", 'bootstrap', 'plugins', 'themes', 'castom', 'main', 'bootstrap-switch', 'http://netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css', 'http://bdmdesign.github.io/bootstrap-switch/static/stylesheets/flat-ui-fonts.css', 'basic/css/basic'));
    echo $this->Html->css(array('basic/basic', 'basic/basic_ie', 'utility', 'developers-custom'));
?>
<div class="row-fluid">
    <div id="page-sidebar-left" class="eqHight">
        <div class="topNav">
            <ul class="nav">
                <li><a href="#">RESERVED</a></li>
            </ul>
            <div class="clear">&nbsp;</div>
        </div>
        <div class="page-title">
            <h2>Master CMS</h2>
        </div>
        <div class="left-containr">
            <div id="side-tab-menu" class="tab-pane active">
                <!-- Primary Navigation -->
                <nav id="primary-nav">
                    <ul>
                        <li>
                            <a class="<?php echo (($this->request->controller == 'Users')) ? 'active' : ''; ?>" href="<?php echo $this->Html->url(array('controller' => 'Users', 'action' => 'masterprofile')); ?>"><i class="glyphicon-cogwheels"></i>Profile Setting</a>
                        </li>
                        <li>
                            <a class="<?php echo (($this->request->controller == 'Settings')) ? 'active' : ''; ?>" href="<?php echo $this->Html->url(array('controller' => 'Settings', 'action' => 'index')); ?>"><i class="glyphicon-vcard"></i>Site Settings</a>
                        </li>                    
                    </ul>
                </nav>
                <!-- END Primary Navigation -->

            <?php echo $this->element("sidebar_master_cms", array('club_lists' => $club_lists)); ?>
            </div>
        </div>
    </div>
    <div id="page-content-right" class="eqHight">
            <?php echo $this->element('admin_top', array("club_name" => "Reserved")); ?>
        <div class="page-title">
            <h2>Site settings</h2>                
        </div>

        <div class="row-fluid">
            <div class="span12">
                <h4 style="color:red"><?php echo $this->Session->flash(); ?></h4>
                <div class="row-fluid">
                    <div class="offset1 span8">
                        <div class="users form">
                            <div class="tips index">                                
                                    <?php echo $this->Form->create('Settings');?>
                                    <fieldset>
                                        <legend><?php echo __('Edit Site Settings'); ?></legend>
                                        
                                            <?php
                                            foreach($settings as $setting){
                                                echo $this->Form->input($setting['Setting']['name'], array("value" => $setting['Setting']['value']));                                              
                                            }
                                            ?>
                                    </fieldset>
                                    <?php echo $this->Form->end(__('Update'));?>                                
                            </div>
                        </div>                       
                    </div>
                </div>
            </div>        
        </div>
    </div>
<?php echo $this->element("footer_Club"); ?>
<?php //echo $this->element('sql_dump');?>