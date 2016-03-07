<div class="jobTitles view">
<h2><?php echo __('Job Title');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $jobTitle['JobTitle']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Job Title'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $jobTitle['JobTitle']['job_title']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Job Title'), array('action' => 'edit', $jobTitle['JobTitle']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Job Title'), array('action' => 'delete', $jobTitle['JobTitle']['id']), null, sprintf(__('Are you sure you want to delete # %s?'), $jobTitle['JobTitle']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Job Titles'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Job Title'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Users');?></h3>
	<?php if (!empty($jobTitle['User'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Username'); ?></th>
		<th><?php echo __('Password'); ?></th>
		<th><?php echo __('First Name'); ?></th>
		<th><?php echo __('Last Name'); ?></th>
		<th><?php echo __('Email Address'); ?></th>
		<th><?php echo __('Phone Number'); ?></th>
		<th><?php echo __('Job Title Id'); ?></th>
		<th><?php echo __('Fb Id'); ?></th>
		<th><?php echo __('Fb Thumb Img'); ?></th>
		<th><?php echo __('Join Date'); ?></th>
		<th><?php echo __('User Type'); ?></th>
		<th><?php echo __('Created By'); ?></th>
		<th><?php echo __('Zip Code'); ?></th>
		<th><?php echo __('Cciv'); ?></th>
		<th><?php echo __('Promoter Code'); ?></th>
		<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($jobTitle['User'] as $user):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $user['id'];?></td>
			<td><?php echo $user['username'];?></td>
			<td><?php echo $user['password'];?></td>
			<td><?php echo $user['first_name'];?></td>
			<td><?php echo $user['last_name'];?></td>
			<td><?php echo $user['email_address'];?></td>
			<td><?php echo $user['phone_number'];?></td>
			<td><?php echo $user['job_title_id'];?></td>
			<td><?php echo $user['fb_id'];?></td>
			<td><?php echo $user['fb_thumb_img'];?></td>
			<td><?php echo $user['join_date'];?></td>
			<td><?php echo $user['user_type'];?></td>
			<td><?php echo $user['created_by'];?></td>
			<td><?php echo $user['zip_code'];?></td>
			<td><?php echo $user['cciv'];?></td>
			<td><?php echo $user['promoter_code'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'users', 'action' => 'view', $user['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'users', 'action' => 'edit', $user['id'])); ?>
				<?php echo $this->Html->link(__('Delete'), array('controller' => 'users', 'action' => 'delete', $user['id']), null, sprintf(__('Are you sure you want to delete # %s?'), $user['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
