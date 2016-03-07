<div class="photos form">
    <?php echo $this->Form->create('Photo');?>
    <fieldset>
        <legend><?php echo __('Admin Edit Photo'); ?></legend>
        <?php
        echo $this->Form->input('id');
        echo $this->Form->input('user_id');
        echo $this->Form->input('club_id');
        echo $this->Form->input('photos');
        echo $this->Form->input('photo_type');
        echo $this->Form->input('profile_picture');
        ?>
    </fieldset>
    <?php echo $this->Form->end(__('Submit'));?>
</div>
<div class="actions">
    <h3><?php echo __('Actions'); ?></h3>
    <ul>

        <li><?php echo $this->Html->link(__('Delete'), array('action' => 'delete', $this->Form->value('Photo.id')), null, sprintf(__('Are you sure you want to delete # %s?'), $this->Form->value('Photo.id'))); ?></li>
        <li><?php echo $this->Html->link(__('List Photos'), array('action' => 'index'));?></li>
        <li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
        <li><?php echo $this->Html->link(__('List Clubs'), array('controller' => 'clubs', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__('New Club'), array('controller' => 'clubs', 'action' => 'add')); ?> </li>
    </ul>
</div>