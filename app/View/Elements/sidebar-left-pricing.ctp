<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 * @package cakephp
 * @name Left Sidebar for Menu and Pricing
 */
?>
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
                    <a class="<?php echo ($this->request->controller == 'clubTables') ? 'active' : ''; ?>" href="<?php echo $this->Html->url(array('controller' => 'clubTables', 'action' => 'index')); ?>"><i class="glyphicon-fast_food"></i>Tables</a>
                </li>
                <li>
                    <a class="<?php echo ($this->request->controller == 'clubBottles') ? 'active' : ''; ?>" href="<?php echo $this->Html->url(array('controller' => 'clubBottles', 'action' => 'index')); ?>"><i class="glyphicon-celebration"></i>Bottles</a>
                </li>
                <li>
                <?php 
                 $ses=$this->Session->read('Auth.User');
                 echo "<a class='active'>".$ses['first_name'].' '.$ses['last_name'].'</a>';
                ?>
                </li>
                <li>
                    <a class="menu-link" href="#"><i class="icon-list-ul"></i>Categories<span>&gt;</span></a>
                    <ul>
                        <li>
                            <a href="#">Lounge Surrounding Area</a>
                        </li>
                        <li>
                            <a href="#">DJ/Dance Floor Area</a>
                        </li>
                        <li>
                            <a href="#">Most Expensive Tables</a>
                        </li>
                    </ul>
                </li>
            
            </ul>
            
            </li>
            </ul>
        </nav>
        <!-- END Primary Navigation -->
    </div>
</div>