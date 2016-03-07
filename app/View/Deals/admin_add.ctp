<div class="deals form">
<?php echo $this->Form->create('Deal');?>
	<fieldset>
 		<legend><?php echo __('Admin Add Deal'); ?></legend>
	<?php
		echo $this->Form->input('club_id');
		echo $this->Form->input('club_table_id');
		echo $this->Form->input('deal_amount');
		echo $this->Form->input('deal_now');
		echo $this->Form->input('deal_date');
		echo $this->Form->input('recur');
		echo $this->Form->input('status');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit'));?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Deals'), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Clubs'), array('controller' => 'clubs', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Club'), array('controller' => 'clubs', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Club Tables'), array('controller' => 'club_tables', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Club Table'), array('controller' => 'club_tables', 'action' => 'add')); ?> </li>
	</ul>
</div>