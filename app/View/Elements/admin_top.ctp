<div class="topNav">
    <ul class="nav">
        <?php if($club_name != "") { ?>
        <li><a class="<?php echo (($this->request->controller == 'Clubs' && $this->request->action == 'add') || ($this->request->controller == 'Users') || ($this->request->controller == 'UserRoles')) ? 'active' : ''; ?>" href="<?php echo $this->Html->url(array('controller' => 'Clubs', 'action' => 'add')); ?>">Club Settings</a> </li>
        <li><a class="<?php echo ($this->request->controller == 'Clubs' && $this->request->action == 'earning') ? 'active' : ''; ?>" href="<?php echo $this->Html->url(array('controller' => 'Clubs', 'action' => 'earning'.'/by-month/'.date('Y-m-d'))); ?>">Earnings</a></li>
        <li><a class="<?php echo ($this->request->controller == 'Reservations') ? 'active' : ''; ?>" href="<?php echo $this->Html->url(array('controller' => 'Reservations', 'action' => 'index')); ?>">Reservation</a></li>
        <li><a class="<?php echo (($this->request->controller == 'Orders' && ($this->request->action == 'index')) || $this->request->controller == 'Orders') ? 'active' : ''; ?>" href="<?php echo $this->Html->url(array('controller' => 'Orders', 'action' => 'index')); ?>">Orders</a></li>
        <li><a class="<?php echo ($this->request->controller == 'clubBottles' || $this->request->controller == 'clubTables') ? 'active' : ''; ?>" href="<?php echo $this->Html->url(array('controller' => 'clubTables', 'action' => 'index')); ?>">Menu &amp; Pricing</a></li>
        <li><a class="<?php echo ($this->request->controller == 'NightDetails' || $this->request->controller == 'Events' || $this->request->controller == 'Deals') ? 'active' : ''; ?>" href="<?php echo $this->Html->url(array('controller' => 'NightDetails', 'action' => 'index')); ?>">Night Details</a></li>
        <?php } ?>
        <li class="dropdown dropdown-notifications user">
            <a data-toggle="dropdown" class="dropdown-toggle" href="javascript:void(0)">
                <i class="glyphicon-user"></i>
                <i class="icon-caret-down"></i>
            </a>
            <ul class="dropdown-menu">
                <li>
                    <?php if(isset($club_name) && $club_name!=""){ ?>
                    <div class="alert">
                        <i class="glyphicon glyph_club_name"><?php echo strtoupper(substr($club_name,0,1));?></i>&nbsp;&nbsp;&nbsp;<a class="" href="<?php echo $this->Html->url(array('controller' => 'Clubs', 'action' => 'add')); ?>">Club Settings</a>
                    </div>
                    <?php } ?>

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