<div class="questionAnswers view">
<h2><?php echo __('Question Answer');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $questionAnswer['QuestionAnswer']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('User'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($questionAnswer['User']['email_address'], array('controller' => 'users', 'action' => 'view', $questionAnswer['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Question'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($questionAnswer['Question']['question'], array('controller' => 'questions', 'action' => 'view', $questionAnswer['Question']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Answer'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $questionAnswer['QuestionAnswer']['answer']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Question Answer'), array('action' => 'edit', $questionAnswer['QuestionAnswer']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Question Answer'), array('action' => 'delete', $questionAnswer['QuestionAnswer']['id']), null, sprintf(__('Are you sure you want to delete # %s?'), $questionAnswer['QuestionAnswer']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Question Answers'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Question Answer'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Questions'), array('controller' => 'questions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Question'), array('controller' => 'questions', 'action' => 'add')); ?> </li>
	</ul>
</div>
