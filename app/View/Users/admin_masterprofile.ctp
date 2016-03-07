<div class="row-fluid">    
    <div id="page-sidebar-left" class="eqHight">
        <div class="topNav">
            <ul class="nav">
                <li><a href="#">RESERVED</a></li>
            </ul>
            <div class="clear">&nbsp;</div>
        </div>
        <div class="page-title">
            <h2> Master CMS</h2>
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
        <?php if(isset($club_id)) $club_name="master"; else $club_name = "";echo $this->element("admin_top", array("club_name" => $club_name)); ?>
        <div class="page-title">
            <h2>Update profile</h2>            
        </div>
        <div class="right-containr">
            <div class="rignt-contain-all">
                <div class="row-fluid">                    
                    <?php echo $this->Form->create('User'); ?>
                    <div class="span6">
                        <?php
                        echo $this->Form->hidden('id');
                        echo $this->Form->input('first_name');
                        echo $this->Form->input('last_name');
                        echo $this->Form->input('email_address');                        
                        ?>
                        <div class="clearfix">&nbsp;</div>
                        <div class="form-group">
                        <?php echo $this->Form->end(__('Update'), array("class" => "btn btn-primary pull-right")); ?>  
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>