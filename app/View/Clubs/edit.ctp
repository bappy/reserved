<div class="clubs form">
    <?php echo $this->Form->create('Club');?>
    <fieldset>
        <legend><?php echo __('Edit Club'); ?></legend>
        <?php
        echo $this->Form->input('id');
        echo $this->Form->input('user_id');
        echo $this->Form->input('club_name');
        echo $this->Form->input('club_type_id');
        echo $this->Form->input('short_description');
        echo $this->Form->input('create_date');
        echo $this->Form->input('address');
        echo $this->Form->input('latitude');
        echo $this->Form->input('longitude');
        echo $this->Form->input('approve_auto_purchase');
        echo $this->Form->input('status');
        ?>
    </fieldset>
    <?php echo $this->Form->end(__('Submit'));?>
</div>
<div class="actions">
    <h3><?php echo __('Actions'); ?></h3>
    <ul>

        <li><?php echo $this->Html->link(__('Delete'), array('action' => 'delete', $this->Form->value('Club.id')), null, sprintf(__('Are you sure you want to delete # %s?'), $this->Form->value('Club.id'))); ?></li>
        <li><?php echo $this->Html->link(__('List Clubs'), array('action' => 'index'));?></li>
        <li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
        <li><?php echo $this->Html->link(__('List Club Types'), array('controller' => 'club_types', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__('New Club Type'), array('controller' => 'club_types', 'action' => 'add')); ?> </li>
        <li><?php echo $this->Html->link(__('List Bookings'), array('controller' => 'bookings', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__('New Booking'), array('controller' => 'bookings', 'action' => 'add')); ?> </li>
        <li><?php echo $this->Html->link(__('List Club Bottles'), array('controller' => 'club_bottles', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__('New Club Bottle'), array('controller' => 'club_bottles', 'action' => 'add')); ?> </li>
        <li><?php echo $this->Html->link(__('List Club Exceptions'), array('controller' => 'club_exceptions', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__('New Club Exception'), array('controller' => 'club_exceptions', 'action' => 'add')); ?> </li>
        <li><?php echo $this->Html->link(__('List Club Open Days'), array('controller' => 'club_open_days', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__('New Club Open Day'), array('controller' => 'club_open_days', 'action' => 'add')); ?> </li>
        <li><?php echo $this->Html->link(__('List Club Tables'), array('controller' => 'club_tables', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__('New Club Table'), array('controller' => 'club_tables', 'action' => 'add')); ?> </li>
        <li><?php echo $this->Html->link(__('List Deals'), array('controller' => 'deals', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__('New Deal'), array('controller' => 'deals', 'action' => 'add')); ?> </li>
        <li><?php echo $this->Html->link(__('List Events'), array('controller' => 'events', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__('New Event'), array('controller' => 'events', 'action' => 'add')); ?> </li>
        <li><?php echo $this->Html->link(__('List Photos'), array('controller' => 'photos', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__('New Photo'), array('controller' => 'photos', 'action' => 'add')); ?> </li>
    </ul>
</div>