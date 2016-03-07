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
                    <a class="<?php echo ($this->request->controller == 'clubTables') ? 'active' : ''; ?>" href="<?php echo $this->Html->url(array('controller' => 'clubTables', 'action' => 'index')); ?>"><i class="glyphicon-fast_food"></i>Tables</a>
                    <h4>Categories</h4>
                    <?php if (!empty($left_categories)): ?>
                        <ul style="display:block;">
                            <?php foreach ($left_categories as $left_category): ?>
                                <li>
                                    <a href="<?php echo $this->Html->url(array('controller' => 'ClubTables', 'action' => 'index'."/".$left_category['Category']['id'])); ?>"><?php echo $left_category['Category']['category_name']; ?></a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                </li>
                <li>
                    <a class="<?php echo ($this->request->controller == 'clubBottles') ? 'active' : ''; ?>" href="<?php echo $this->Html->url(array('controller' => 'clubBottles', 'action' => 'index')); ?>"><i class="glyphicon-celebration"></i>Bottles</a>
                </li>
            </ul>
        </nav>
        <!-- END Primary Navigation -->
    </div>
</div>