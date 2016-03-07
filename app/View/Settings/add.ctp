<div class="tips form">
<?php echo $this->Form->create('Tip');?>
	<fieldset>
 		<legend><?php echo __('Add Tip'); ?></legend>
	<?php
		echo $this->Form->input('tips_description');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit'));?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Tips'), array('action' => 'index'));?></li>
	</ul>
</div>