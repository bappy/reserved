<div class="jobTitles form">
<?php echo $this->Form->create('JobTitle');?>
	<fieldset>
 		<legend><?php echo __('Admin Edit Job Title'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('job_title');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit'));?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete'), array('action' => 'delete', $this->Form->value('JobTitle.id')), null, sprintf(__('Are you sure you want to delete # %s?'), $this->Form->value('JobTitle.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Job Titles'), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>