<div class="tips form">
<?php echo $this->Form->create('Tip');?>
	<fieldset>
 		<legend><?php echo __('Admin Edit Tip'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('tips_description');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit'));?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete'), array('action' => 'delete', $this->Form->value('Tip.id')), null, sprintf(__('Are you sure you want to delete # %s?'), $this->Form->value('Tip.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Tips'), array('action' => 'index'));?></li>
	</ul>
</div>