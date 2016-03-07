<div class="topNav">
    <ul class="nav">
        
        <li class="dropdown dropdown-notifications user">
            <a data-toggle="dropdown" class="dropdown-toggle" href="javascript:void(0)">
                <i class="glyphicon-user"></i>
                <i class="icon-caret-down"></i>
            </a>
            <ul class="dropdown-menu">
                <li>
                    <div class="alert alert-info">
                        <i class="glyphicon-old_man"></i>&nbsp;&nbsp;&nbsp;<a class="" href="<?php echo $this->Html->url(array('controller' => 'Users', 'action' => 'masterprofile')); ?>">Master Accounts</a>
                    </div>
                    <div class="alert alert-info">
                        <i class="glyphicon-old_man"></i>&nbsp;&nbsp;&nbsp;<a class="" href="<?php echo $this->Html->url(array('controller' => 'Settings', 'action' => 'index')); ?>">Site Settings</a>
                    </div>
                    <div class="alert alert-success">
                        <i class="halflingicon-question-sign"></i>&nbsp;&nbsp;&nbsp;<a class="" href="#">Help Center</a>
                    </div>
                    <div class="alert">
                        <i class="halflingicon-remove-sign"></i>&nbsp;&nbsp;&nbsp;<a href="<?php echo $this->Html->url(array('controller' => 'Users', 'action' => 'logout')); ?>">Logout</a>
                    </div>
                </li>
            </ul>
        </li>
    </ul>
    <div class="clear">&nbsp;</div>
</div>