<div class="clubOpenDays view">
<h2><?php echo __('Club Open Day');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $clubOpenDay['ClubOpenDay']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Club'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($clubOpenDay['Club']['club_name'], array('controller' => 'clubs', 'action' => 'view', $clubOpenDay['Club']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Days'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $clubOpenDay['ClubOpenDay']['days']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Open Time'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $clubOpenDay['ClubOpenDay']['open_time']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Close Time'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $clubOpenDay['ClubOpenDay']['close_time']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Status'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $clubOpenDay['ClubOpenDay']['status']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Club Open Day'), array('action' => 'edit', $clubOpenDay['ClubOpenDay']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Club Open Day'), array('action' => 'delete', $clubOpenDay['ClubOpenDay']['id']), null, sprintf(__('Are you sure you want to delete # %s?'), $clubOpenDay['ClubOpenDay']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Club Open Days'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Club Open Day'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Clubs'), array('controller' => 'clubs', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Club'), array('controller' => 'clubs', 'action' => 'add')); ?> </li>
	</ul>
</div>
