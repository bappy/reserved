<div class="clubTables view">
<h2><?php echo __('Club Table');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $clubTable['ClubTable']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('User'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($clubTable['User']['email_address'], array('controller' => 'users', 'action' => 'view', $clubTable['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Club'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($clubTable['Club']['club_name'], array('controller' => 'clubs', 'action' => 'view', $clubTable['Club']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Table Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $clubTable['ClubTable']['table_name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Category'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($clubTable['Category']['category_name'], array('controller' => 'categories', 'action' => 'view', $clubTable['Category']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Minimum Price'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $clubTable['ClubTable']['minimum_price']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Table Min Guy'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $clubTable['ClubTable']['table_min_guy']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Table Min Girls'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $clubTable['ClubTable']['table_min_girls']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Max Guys1'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $clubTable['ClubTable']['max_guys1']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Max Guys1 Price'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $clubTable['ClubTable']['max_guys1_price']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Max Guys2'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $clubTable['ClubTable']['max_guys2']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Max Guys2 Price'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $clubTable['ClubTable']['max_guys2_price']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Create Date'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $clubTable['ClubTable']['create_date']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Status'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $clubTable['ClubTable']['status']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Club Table'), array('action' => 'edit', $clubTable['ClubTable']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Club Table'), array('action' => 'delete', $clubTable['ClubTable']['id']), null, sprintf(__('Are you sure you want to delete # %s?'), $clubTable['ClubTable']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Club Tables'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Club Table'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Clubs'), array('controller' => 'clubs', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Club'), array('controller' => 'clubs', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Categories'), array('controller' => 'categories', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Category'), array('controller' => 'categories', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Bookings'), array('controller' => 'bookings', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Booking'), array('controller' => 'bookings', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Deals'), array('controller' => 'deals', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Deal'), array('controller' => 'deals', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Bookings');?></h3>
	<?php if (!empty($clubTable['Booking'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Club Id'); ?></th>
		<th><?php echo __('Club Table Id'); ?></th>
		<th><?php echo __('Guys'); ?></th>
		<th><?php echo __('Girls'); ?></th>
		<th><?php echo __('Arrival Time'); ?></th>
		<th><?php echo __('Arrival Date'); ?></th>
		<th><?php echo __('Booking Price'); ?></th>
		<th><?php echo __('Booking Method'); ?></th>
		<th><?php echo __('Booking Time'); ?></th>
		<th><?php echo __('Status'); ?></th>
		<th><?php echo __('Client Name'); ?></th>
		<th><?php echo __('Client Phone'); ?></th>
		<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($clubTable['Booking'] as $booking):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $booking['id'];?></td>
			<td><?php echo $booking['user_id'];?></td>
			<td><?php echo $booking['club_id'];?></td>
			<td><?php echo $booking['club_table_id'];?></td>
			<td><?php echo $booking['guys'];?></td>
			<td><?php echo $booking['girls'];?></td>
			<td><?php echo $booking['arrival_time'];?></td>
			<td><?php echo $booking['arrival_date'];?></td>
			<td><?php echo $booking['booking_price'];?></td>
			<td><?php echo $booking['booking_method'];?></td>
			<td><?php echo $booking['booking_time'];?></td>
			<td><?php echo $booking['status'];?></td>
			<td><?php echo $booking['client_name'];?></td>
			<td><?php echo $booking['client_phone'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'bookings', 'action' => 'view', $booking['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'bookings', 'action' => 'edit', $booking['id'])); ?>
				<?php echo $this->Html->link(__('Delete'), array('controller' => 'bookings', 'action' => 'delete', $booking['id']), null, sprintf(__('Are you sure you want to delete # %s?'), $booking['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Booking'), array('controller' => 'bookings', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Deals');?></h3>
	<?php if (!empty($clubTable['Deal'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Club Id'); ?></th>
		<th><?php echo __('Club Table Id'); ?></th>
		<th><?php echo __('Deal Amount'); ?></th>
		<th><?php echo __('Deal Now'); ?></th>
		<th><?php echo __('Deal Date'); ?></th>
		<th><?php echo __('Recur'); ?></th>
		<th><?php echo __('Status'); ?></th>
		<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($clubTable['Deal'] as $deal):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $deal['id'];?></td>
			<td><?php echo $deal['club_id'];?></td>
			<td><?php echo $deal['club_table_id'];?></td>
			<td><?php echo $deal['deal_amount'];?></td>
			<td><?php echo $deal['deal_now'];?></td>
			<td><?php echo $deal['deal_date'];?></td>
			<td><?php echo $deal['recur'];?></td>
			<td><?php echo $deal['status'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'deals', 'action' => 'view', $deal['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'deals', 'action' => 'edit', $deal['id'])); ?>
				<?php echo $this->Html->link(__('Delete'), array('controller' => 'deals', 'action' => 'delete', $deal['id']), null, sprintf(__('Are you sure you want to delete # %s?'), $deal['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Deal'), array('controller' => 'deals', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
