<div class="questions view">
<h2><?php echo __('Question');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $question['Question']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Question'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $question['Question']['question']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Question'), array('action' => 'edit', $question['Question']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Question'), array('action' => 'delete', $question['Question']['id']), null, sprintf(__('Are you sure you want to delete # %s?'), $question['Question']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Questions'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Question'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Question Answers'), array('controller' => 'question_answers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Question Answer'), array('controller' => 'question_answers', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Question Answers');?></h3>
	<?php if (!empty($question['QuestionAnswer'])):?>
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
		foreach ($question['QuestionAnswer'] as $questionAnswer):
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
