<div class="clubTypes form">
<?php echo $this->Form->create('ClubType');?>
	<fieldset>
 		<legend><?php echo __('Add Club Type'); ?></legend>
	<?php
		echo $this->Form->input('type_name');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit'));?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Club Types'), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Clubs'), array('controller' => 'clubs', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Club'), array('controller' => 'clubs', 'action' => 'add')); ?> </li>
	</ul>
</div>