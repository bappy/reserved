<div id="page-sidebar-left" class="eqHight">
    <div class="topNav">
        <ul class="nav">
            <li><a href="#">Hooray Henry's</a></li>
        </ul>
        <div class="clear">&nbsp;</div>
    </div>
    <div class="page-title">
        <h2><?php //echo $club_name; ?></h2>
     </div>
    <div class="left-containr">
        <div id="side-tab-menu" class="tab-pane active">
            <!-- Primary Navigation -->
            <nav id="primary-nav">
                <ul>
                    <li>
                        <a class="<?php echo (($this->request->controller == 'Clubs')) ? 'active' : ''; ?>" href="<?php echo $this->Html->url(array('controller' => 'Clubs', 'action' => 'add')); ?>"><i class="glyphicon-cogwheels"></i>Club Setting</a>
                    </li>
                    <li>
                        <a class="<?php echo (($this->request->controller == 'UserRoles')) ? 'active' : ''; ?>" href="<?php echo $this->Html->url(array('controller' => 'UserRoles', 'action' => 'add')); ?>"><i class="glyphicon-vcard"></i>Account Settings<i class="halflingicon-plus pull-right"></i></a>
                    </li>
                    <li>
                        <a class="<?php echo (($this->request->controller == 'Users')) ? 'active' : ''; ?>" href="<?php echo $this->Html->url(array('controller' => 'Users', 'action' => 'index')); ?>"><i class="glyphicon-old_man"></i>Admin Account</a>
                    </li>
                </ul>
            </nav>
            <!-- END Primary Navigation -->
        </div>
    </div>
</div>
