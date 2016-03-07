<div class="bookings form">
<?php echo $this->Form->create('Booking');?>
	<fieldset>
 		<legend><?php echo __('Add Booking'); ?></legend>
	<?php
		echo $this->Form->input('user_id');
		echo $this->Form->input('club_id');
		echo $this->Form->input('club_table_id');
		echo $this->Form->input('guys');
		echo $this->Form->input('girls');
		echo $this->Form->input('arrival_time');
		echo $this->Form->input('arrival_date');
		echo $this->Form->input('booking_price');
		echo $this->Form->input('booking_method');
		echo $this->Form->input('booking_time');
		echo $this->Form->input('status');
		echo $this->Form->input('client_name');
		echo $this->Form->input('client_phone');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit'));?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Bookings'), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Clubs'), array('controller' => 'clubs', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Club'), array('controller' => 'clubs', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Club Tables'), array('controller' => 'club_tables', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Club Table'), array('controller' => 'club_tables', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Orders'), array('controller' => 'orders', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Order'), array('controller' => 'orders', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Splits'), array('controller' => 'splits', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Split'), array('controller' => 'splits', 'action' => 'add')); ?> </li>
	</ul>
</div>