<div id="page-sidebar-left" class="eqHight">
    <div class="topNav">
        <ul class="nav">
            <li><a href="#">RESERVED</a></li>
        </ul>
        <div class="clear">&nbsp;</div>
    </div>
    <div class="page-title">
        <h2><?php echo $club_name; ?></h2>
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
                        <a class="<?php echo (($this->request->controller == 'Settings')) ? 'active' : ''; ?>" href="<?php echo $this->Html->url(array('controller' => 'Settings', 'action' => 'index')); ?>"><i class="glyphicon-vcard"></i>Site Settings<i class="halflingicon-plus pull-right"></i></a>
                    </li>                    
                </ul>
            </nav>
            <!-- END Primary Navigation -->
        </div>
    </div>
</div>
