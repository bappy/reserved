<div class="users view">
<h2><?php echo __('User');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $user['User']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Username'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $user['User']['username']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Password'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $user['User']['password']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('First Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $user['User']['first_name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Last Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $user['User']['last_name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Email Address'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $user['User']['email_address']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Phone Number'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $user['User']['phone_number']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Job Title'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($user['JobTitle']['job_title'], array('controller' => 'job_titles', 'action' => 'view', $user['JobTitle']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Fb Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $user['User']['fb_id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Fb Thumb Img'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $user['User']['fb_thumb_img']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Join Date'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $user['User']['join_date']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('User Type'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $user['User']['user_type']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Created By'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $user['User']['created_by']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Zip Code'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $user['User']['zip_code']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Cciv'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $user['User']['cciv']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Promoter Code'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $user['User']['promoter_code']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit User'), array('action' => 'edit', $user['User']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete User'), array('action' => 'delete', $user['User']['id']), null, sprintf(__('Are you sure you want to delete # %s?'), $user['User']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Job Titles'), array('controller' => 'job_titles', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Job Title'), array('controller' => 'job_titles', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Bookings'), array('controller' => 'bookings', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Booking'), array('controller' => 'bookings', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Cards'), array('controller' => 'cards', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Card'), array('controller' => 'cards', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Club Bottles'), array('controller' => 'club_bottles', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Club Bottle'), array('controller' => 'club_bottles', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Club Tables'), array('controller' => 'club_tables', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Club Table'), array('controller' => 'club_tables', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Clubs'), array('controller' => 'clubs', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Club'), array('controller' => 'clubs', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Orders'), array('controller' => 'orders', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Order'), array('controller' => 'orders', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Photos'), array('controller' => 'photos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Photo'), array('controller' => 'photos', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Question Answers'), array('controller' => 'question_answers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Question Answer'), array('controller' => 'question_answers', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Splits'), array('controller' => 'splits', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Split'), array('controller' => 'splits', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Bookings');?></h3>
	<?php if (!empty($user['Booking'])):?>
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
		foreach ($user['Booking'] as $booking):
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
	<h3><?php echo __('Related Cards');?></h3>
	<?php if (!empty($user['Card'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Cards'); ?></th>
		<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($user['Card'] as $card):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $card['id'];?></td>
			<td><?php echo $card['user_id'];?></td>
			<td><?php echo $card['cards'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'cards', 'action' => 'view', $card['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'cards', 'action' => 'edit', $card['id'])); ?>
				<?php echo $this->Html->link(__('Delete'), array('controller' => 'cards', 'action' => 'delete', $card['id']), null, sprintf(__('Are you sure you want to delete # %s?'), $card['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Card'), array('controller' => 'cards', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Club Bottles');?></h3>
	<?php if (!empty($user['ClubBottle'])):?>
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
		foreach ($user['ClubBottle'] as $clubBottle):
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
	<?php if (!empty($user['ClubTable'])):?>
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
		foreach ($user['ClubTable'] as $clubTable):
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
	<h3><?php echo __('Related Clubs');?></h3>
	<?php if (!empty($user['Club'])):?>
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
		foreach ($user['Club'] as $club):
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
<div class="related">
	<h3><?php echo __('Related Orders');?></h3>
	<?php if (!empty($user['Order'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Booking Id'); ?></th>
		<th><?php echo __('Club Bottle Id'); ?></th>
		<th><?php echo __('Quantity'); ?></th>
		<th><?php echo __('Price'); ?></th>
		<th><?php echo __('Transactionid'); ?></th>
		<th><?php echo __('Status'); ?></th>
		<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($user['Order'] as $order):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $order['id'];?></td>
			<td><?php echo $order['user_id'];?></td>
			<td><?php echo $order['booking_id'];?></td>
			<td><?php echo $order['club_bottle_id'];?></td>
			<td><?php echo $order['quantity'];?></td>
			<td><?php echo $order['price'];?></td>
			<td><?php echo $order['transactionid'];?></td>
			<td><?php echo $order['status'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'orders', 'action' => 'view', $order['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'orders', 'action' => 'edit', $order['id'])); ?>
				<?php echo $this->Html->link(__('Delete'), array('controller' => 'orders', 'action' => 'delete', $order['id']), null, sprintf(__('Are you sure you want to delete # %s?'), $order['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Order'), array('controller' => 'orders', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Photos');?></h3>
	<?php if (!empty($user['Photo'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Club Id'); ?></th>
		<th><?php echo __('Photos'); ?></th>
		<th><?php echo __('Photo Type'); ?></th>
		<th><?php echo __('Profile Picture'); ?></th>
		<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($user['Photo'] as $photo):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $photo['id'];?></td>
			<td><?php echo $photo['user_id'];?></td>
			<td><?php echo $photo['club_id'];?></td>
			<td><?php echo $photo['photos'];?></td>
			<td><?php echo $photo['photo_type'];?></td>
			<td><?php echo $photo['profile_picture'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'photos', 'action' => 'view', $photo['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'photos', 'action' => 'edit', $photo['id'])); ?>
				<?php echo $this->Html->link(__('Delete'), array('controller' => 'photos', 'action' => 'delete', $photo['id']), null, sprintf(__('Are you sure you want to delete # %s?'), $photo['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Photo'), array('controller' => 'photos', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Question Answers');?></h3>
	<?php if (!empty($user['QuestionAnswer'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Question Id'); ?></th>
		<th><?php echo __('Answer'); ?></th>
		<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($user['QuestionAnswer'] as $questionAnswer):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $questionAnswer['id'];?></td>
			<td><?php echo $questionAnswer['user_id'];?></td>
			<td><?php echo $questionAnswer['question_id'];?></td>
			<td><?php echo $questionAnswer['answer'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'question_answers', 'action' => 'view', $questionAnswer['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'question_answers', 'action' => 'edit', $questionAnswer['id'])); ?>
				<?php echo $this->Html->link(__('Delete'), array('controller' => 'question_answers', 'action' => 'delete', $questionAnswer['id']), null, sprintf(__('Are you sure you want to delete # %s?'), $questionAnswer['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Question Answer'), array('controller' => 'question_answers', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Splits');?></h3>
	<?php if (!empty($user['Split'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Booking Id'); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th><?php echo __('Splited Amount'); ?></th>
		<th><?php echo __('Status'); ?></th>
		<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($user['Split'] as $split):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $split['id'];?></td>
			<td><?php echo $split['user_id'];?></td>
			<td><?php echo $split['booking_id'];?></td>
			<td><?php echo $split['name'];?></td>
			<td><?php echo $split['splited_amount'];?></td>
			<td><?php echo $split['status'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'splits', 'action' => 'view', $split['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'splits', 'action' => 'edit', $split['id'])); ?>
				<?php echo $this->Html->link(__('Delete'), array('controller' => 'splits', 'action' => 'delete', $split['id']), null, sprintf(__('Are you sure you want to delete # %s?'), $split['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Split'), array('controller' => 'splits', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
