<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 * @package cakephp
 * @name Left Sidebar for Menu and Pricing
 */
?>
<?php
echo $this->Html->css('validationEngine.jquery');
echo $this->Html->script(array('jquery.validationEngine-en', 'jquery.validationEngine'));
?>
<script type="text/javascript">            
    jQuery(document).ready(function() {
        jQuery("#edit_club_bottles_category").validationEngine('attach');
    });
</script>
<div class="topNav">
    <ul class="nav">
        <li><a href="#">Hooray Henry's</a></li>
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
                    <h4>Categories</h4>
                    <?php echo $this->Form->create('Category', array('url' => array('controller' => 'clubBottles', 'action' => 'edit_bottles_category'), 'id' => 'edit_club_bottles_category')); ?>
                    <div class="row-fluid">
                        <div class="span9">
                            <?php echo $this->Form->hidden('category_type', array('value' => 'bottle')); ?>
                            <?php echo $this->Form->hidden('id'); ?>
                            <?php echo $this->Form->input('category_name', array('type' => 'text', 'required' => false, 'label' => false, 'class' => 'validate[required] input_bottle_category', 'div' => false, 'placeholder' => 'Category Name')); ?>
                        </div>
                        <div class="span3">
                            <button type="submit" name="save" class="btn btn-labeled btn-success"><span class="btn-label"></span>Save</button>
                        </div>
                    </div>
                    <?php echo $this->Form->end(); ?>
                    <?php if (!empty($left_categories)): ?>
                        <ul style="display:block;">
                            <?php foreach ($left_categories as $left_category): ?>
                                <li>
                                    <a class="bottle_category_name" href="<?php echo $this->Html->url(array('controller' => 'clubBottles', 'action' => 'edit_bottles_category', $left_category['Category']['id'])); ?>"><?php echo $left_category['Category']['category_name']; ?></a>
                                    <?php echo $this->Html->link($this->Html->image('del.png'), array('controller' => 'clubBottles', 'action' => 'delete_bottles_category', $left_category['Category']['id']), array('class' => 'bottle_category_delete', 'escape' => false), sprintf(__('If you delete the categories all bottles will be deleted, do you want to delete? # %s?'), $left_category['Category']['id'])); ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                </li>
            </ul>
        </nav>
        <!-- END Primary Navigation -->
    </div>
</div>