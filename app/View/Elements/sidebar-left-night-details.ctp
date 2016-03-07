<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
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
                    <a class="<?php echo (($this->request->controller == 'NightDetails' && ($this->request->action == 'index' || $this->request->action == 'booking_edit'))) ? 'active' : ''; ?>" href="<?php echo $this->Html->url(array('controller' => 'NightDetails', 'action' => 'index')); ?>"><i class="icon-list-alt"></i>Tables Bookings</a>
                </li>
                <li>
                    <a class="<?php echo (($this->request->controller == 'Events')) ? 'active' : ''; ?>" href="<?php echo $this->Html->url(array('controller' => 'Events', 'action' => 'index')); ?>"><i class="glyphicon-celebration"></i>Special Events</a>
                </li>
                <li>
                    <a class="menu-link <?php echo (($this->request->controller == 'Deals')) ? 'active' : ''; ?>" href="<?php echo $this->Html->url(array('controller' => 'Deals', 'action' => 'index')); ?>"><i class="icon-list-ul"></i>Deals</a>
                </li>
            </ul>
        </nav>
        <!-- END Primary Navigation -->
    </div>
</div>