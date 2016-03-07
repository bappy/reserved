<div class="tips view">
<h2><?php echo __('Tip');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $tip['Tip']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Tips Description'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $tip['Tip']['tips_description']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Tip'), array('action' => 'edit', $tip['Tip']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Tip'), array('action' => 'delete', $tip['Tip']['id']), null, sprintf(__('Are you sure you want to delete # %s?'), $tip['Tip']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Tips'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Tip'), array('action' => 'add')); ?> </li>
	</ul>
</div>
