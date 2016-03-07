<div class="categories view">
<h2><?php echo __('Category');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $category['Category']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Category Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $category['Category']['category_name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Category Type'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $category['Category']['category_type']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Category'), array('action' => 'edit', $category['Category']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Category'), array('action' => 'delete', $category['Category']['id']), null, sprintf(__('Are you sure you want to delete # %s?'), $category['Category']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Categories'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Category'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Club Bottles'), array('controller' => 'club_bottles', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Club Bottle'), array('controller' => 'club_bottles', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Club Tables'), array('controller' => 'club_tables', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Club Table'), array('controller' => 'club_tables', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Events'), array('controller' => 'events', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Event'), array('controller' => 'events', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Club Bottles');?></h3>
	<?php if (!empty($category['ClubBottle'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Club Id'); ?></th>
		<th><?php echo __('Category Id'); ?></th>
		<th><?php echo __('Bottle Name'); ?></th>
		<th><?php echo __('Bottle Price'); ?></th>
		<th><?php echo __('Upsell'); ?></th>
		<th><?php echo __('Upsell Type'); ?></th>
		<th><?php echo __('Status'); ?></th>
		<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($category['ClubBottle'] as $clubBottle):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $clubBottle['id'];?></td>
			<td><?php echo $clubBottle['user_id'];?></td>
			<td><?php echo $clubBottle['club_id'];?></td>
			<td><?php echo $clubBottle['category_id'];?></td>
			<td><?php echo $clubBottle['bottle_name'];?></td>
			<td><?php echo $clubBottle['bottle_price'];?></td>
			<td><?php echo $clubBottle['upsell'];?></td>
			<td><?php echo $clubBottle['upsell_type'];?></td>
			<td><?php echo $clubBottle['status'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'club_bottles', 'action' => 'view', $clubBottle['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'club_bottles', 'action' => 'edit', $clubBottle['id'])); ?>
				<?php echo $this->Html->link(__('Delete'), array('controller' => 'club_bottles', 'action' => 'delete', $clubBottle['id']), null, sprintf(__('Are you sure you want to delete # %s?'), $clubBottle['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Club Bottle'), array('controller' => 'club_bottles', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Club Tables');?></h3>
	<?php if (!empty($category['ClubTable'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Club Id'); ?></th>
		<th><?php echo __('Table Name'); ?></th>
		<th><?php echo __('Category Id'); ?></th>
		<th><?php echo __('Minimum Price'); ?></th>
		<th><?php echo __('Table Min Guy'); ?></th>
		<th><?php echo __('Table Min Girls'); ?></th>
		<th><?php echo __('Max Guys1'); ?></th>
		<th><?php echo __('Max Guys1 Price'); ?></th>
		<th><?php echo __('Max Guys2'); ?></th>
		<th><?php echo __('Max Guys2 Price'); ?></th>
		<th><?php echo __('Create Date'); ?></th>
		<th><?php echo __('Status'); ?></th>
		<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($category['ClubTable'] as $clubTable):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $clubTable['id'];?></td>
			<td><?php echo $clubTable['user_id'];?></td>
			<td><?php echo $clubTable['club_id'];?></td>
			<td><?php echo $clubTable['table_name'];?></td>
			<td><?php echo $clubTable['category_id'];?></td>
			<td><?php echo $clubTable['minimum_price'];?></td>
			<td><?php echo $clubTable['table_min_guy'];?></td>
			<td><?php echo $clubTable['table_min_girls'];?></td>
			<td><?php echo $clubTable['max_guys1'];?></td>
			<td><?php echo $clubTable['max_guys1_price'];?></td>
			<td><?php echo $clubTable['max_guys2'];?></td>
			<td><?php echo $clubTable['max_guys2_price'];?></td>
			<td><?php echo $clubTable['create_date'];?></td>
			<td><?php echo $clubTable['status'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'club_tables', 'action' => 'view', $clubTable['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'club_tables', 'action' => 'edit', $clubTable['id'])); ?>
				<?php echo $this->Html->link(__('Delete'), array('controller' => 'club_tables', 'action' => 'delete', $clubTable['id']), null, sprintf(__('Are you sure you want to delete # %s?'), $clubTable['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Club Table'), array('controller' => 'club_tables', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Events');?></h3>
	<?php if (!empty($category['Event'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Club Id'); ?></th>
		<th><?php echo __('Category Id'); ?></th>
		<th><?php echo __('Performer'); ?></th>
		<th><?php echo __('Price Multiplier'); ?></th>
		<th><?php echo __('Recur Week'); ?></th>
		<th><?php echo __('Event Date'); ?></th>
		<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($category['Event'] as $event):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $event['id'];?></td>
			<td><?php echo $event['club_id'];?></td>
			<td><?php echo $event['category_id'];?></td>
			<td><?php echo $event['performer'];?></td>
			<td><?php echo $event['price_multiplier'];?></td>
			<td><?php echo $event['recur_week'];?></td>
			<td><?php echo $event['event_date'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'events', 'action' => 'view', $event['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'events', 'action' => 'edit', $event['id'])); ?>
				<?php echo $this->Html->link(__('Delete'), array('controller' => 'events', 'action' => 'delete', $event['id']), null, sprintf(__('Are you sure you want to delete # %s?'), $event['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Event'), array('controller' => 'events', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
