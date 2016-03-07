<?php 
echo '<pre>';
print_r($user); 
echo '</pre>';
?>
<div class="users form">
<?php echo $this->Form->create('User',array('action' => 'accounts_settings'));?>
	<fieldset>
 		<legend><?php echo __('Account'); ?></legend>
	<?php
		echo __('BASIC INFORMATION');
		echo $this->Form->input('id');
		echo $this->Form->input('name',array('value'=>$user['User']['name']));
		echo $this->Form->input('pwd',array('type'=>'text','label'=>array('text'=>'Enter your new password'))); 
		echo $this->Form->input('pwd_repeat',array('type'=>'text','label'=>array('text'=>'Confirm your new password'))); 
		//echo $this->Form->input('first_name');
		//echo $this->Form->input('last_name');
		echo $this->Form->input('email_address');
		
		echo __('SECURITY QUESTION (OPTIONAL)');
		
		echo $this->Form->input('user_id', array('type' => 'hidden','value' => $user['User']['id']));
		if(isset($user['QuestionAnswer'][0])){
			echo $this->Form->input('question_id', array('default'=>$user['QuestionAnswer'][0]['question_id']));
			echo $this->Form->input('answer',array('value'=>$user['QuestionAnswer'][0]['answer']));
		}
		else{
			echo $this->Form->input('question_id');
			echo $this->Form->input('answer');
		}
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit'));?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete'), array('action' => 'delete', $this->Form->value('User.id')), null, sprintf(__('Are you sure you want to delete # %s?'), $this->Form->value('User.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('action' => 'index'));?></li>
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