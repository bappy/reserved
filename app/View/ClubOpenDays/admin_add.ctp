<div class="clubOpenDays form">
<?php echo $this->Form->create('ClubOpenDay');?>
	<fieldset>
 		<legend><?php echo __('Admin Add Club Open Day'); ?></legend>
	<?php
		echo $this->Form->input('club_id');
		echo $this->Form->input('days');
		echo $this->Form->input('open_time');
		echo $this->Form->input('close_time');
		echo $this->Form->input('status');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit'));?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Club Open Days'), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Clubs'), array('controller' => 'clubs', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Club'), array('controller' => 'clubs', 'action' => 'add')); ?> </li>
	</ul>
</div>