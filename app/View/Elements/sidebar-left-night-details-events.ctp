<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<?php
echo $this->Html->css('validationEngine.jquery');
echo $this->Html->script(array('jquery.validationEngine-en', 'jquery.validationEngine'));
?>
<script type="text/javascript">            
    jQuery(document).ready(function() {
        jQuery("#add_events_category").validationEngine('attach');
    });
</script>
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
                    <h4>Categories</h4>
                    <?php echo $this->Form->create('Category', array('url' => array('controller' => 'Events', 'action' => 'add_events_category'), 'id' => 'add_events_category')); ?>
                    <div class="row-fluid">
                        <div class="span9">
                            <?php echo $this->Form->hidden('category_type', array('value' => 'events')); ?>
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
                                    <a class="bottle_category_name" href="<?php echo $this->Html->url(array('controller' => 'Events', 'action' => 'edit_events_category', $left_category['Category']['id'])); ?>"><?php echo $left_category['Category']['category_name']; ?></a>
                                    <?php echo $this->Html->link($this->Html->image('del.png'), array('controller' => 'Events', 'action' => 'delete_events_category', $left_category['Category']['id']), array('class' => 'bottle_category_delete', 'escape' => false), sprintf(__('If you delete the categories all events will be deleted, do you want to delete? # %s?'), $left_category['Category']['id'])); ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                </li>
                <li>
                    <a class="menu-link <?php echo (($this->request->controller == 'Deals')) ? 'active' : ''; ?>" href="<?php echo $this->Html->url(array('controller' => 'Deals', 'action' => 'index')); ?>"><i class="icon-list-ul"></i>Deals</a>
                </li>
            </ul>
        </nav>
        <!-- END Primary Navigation -->
    </div>
</div>