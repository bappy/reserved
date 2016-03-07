<div class="clubTypes view">
<h2><?php echo __('Club Type');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $clubType['ClubType']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Type Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $clubType['ClubType']['type_name']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Club Type'), array('action' => 'edit', $clubType['ClubType']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Club Type'), array('action' => 'delete', $clubType['ClubType']['id']), null, sprintf(__('Are you sure you want to delete # %s?'), $clubType['ClubType']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Club Types'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Club Type'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Clubs'), array('controller' => 'clubs', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Club'), array('controller' => 'clubs', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Clubs');?></h3>
	<?php if (!empty($clubType['Club'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Club Name'); ?></th>
		<th><?php echo __('Club Type Id'); ?></th>
		<th><?php echo __('Short Description'); ?></th>
		<th><?php echo __('Create Date'); ?></th>
		<th><?php echo __('Address'); ?></th>
		<th><?php echo __('Latitude'); ?></th>
		<th><?php echo __('Longitude'); ?></th>
		<th><?php echo __('Approve Auto Purchase'); ?></th>
		<th><?php echo __('Status'); ?></th>
		<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($clubType['Club'] as $club):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $club['id'];?></td>
			<td><?php echo $club['user_id'];?></td>
			<td><?php echo $club['club_name'];?></td>
			<td><?php echo $club['club_type_id'];?></td>
			<td><?php echo $club['short_description'];?></td>
			<td><?php echo $club['create_date'];?></td>
			<td><?php echo $club['address'];?></td>
			<td><?php echo $club['latitude'];?></td>
			<td><?php echo $club['longitude'];?></td>
			<td><?php echo $club['approve_auto_purchase'];?></td>
			<td><?php echo $club['status'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'clubs', 'action' => 'view', $club['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'clubs', 'action' => 'edit', $club['id'])); ?>
				<?php echo $this->Html->link(__('Delete'), array('controller' => 'clubs', 'action' => 'delete', $club['id']), null, sprintf(__('Are you sure you want to delete # %s?'), $club['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Club'), array('controller' => 'clubs', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
