<div class="splits index">
	<h2><?php echo __('Splits');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('user_id');?></th>
			<th><?php echo $this->Paginator->sort('booking_id');?></th>
			<th><?php echo $this->Paginator->sort('name');?></th>
			<th><?php echo $this->Paginator->sort('splited_amount');?></th>
			<th><?php echo $this->Paginator->sort('status');?></th>
			<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($splits as $split):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $split['Split']['id']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($split['User']['email_address'], array('controller' => 'users', 'action' => 'view', $split['User']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($split['Booking']['client_name'], array('controller' => 'bookings', 'action' => 'view', $split['Booking']['id'])); ?>
		</td>
		<td><?php echo $split['Split']['name']; ?>&nbsp;</td>
		<td><?php echo $split['Split']['splited_amount']; ?>&nbsp;</td>
		<td><?php echo $split['Split']['status']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $split['Split']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $split['Split']['id'])); ?>
			<?php echo $this->Html->link(__('Delete'), array('action' => 'delete', $split['Split']['id']), null, sprintf(__('Are you sure you want to delete # %s?'), $split['Split']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%')
	));
	?>	</p>

	<div class="paging">
		<?php echo $this->Paginator->prev('<< ' . __('previous'), array(), null, array('class'=>'disabled'));?>
	 | 	<?php echo $this->Paginator->numbers();?>
 |
		<?php echo $this->Paginator->next(__('next') . ' >>', array(), null, array('class' => 'disabled'));?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Split'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Bookings'), array('controller' => 'bookings', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Booking'), array('controller' => 'bookings', 'action' => 'add')); ?> </li>
	</ul>
</div>