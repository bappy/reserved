<div class="clubExceptions form">
    <?php echo $this->Form->create('ClubException');?>
    <fieldset>
        <legend><?php echo __('Edit Club Exception'); ?></legend>
        <?php
        echo $this->Form->input('id');
        echo $this->Form->input('club_id');
        echo $this->Form->input('exception_date');
        echo $this->Form->input('exception_name');
        echo $this->Form->input('open_time');
        echo $this->Form->input('close_time');
        echo $this->Form->input('status');
        ?>
    </fieldset>
    <?php echo $this->Form->end(__('Submit'));?>
</div>
<div class="actions">
    <h3><?php echo __('Actions'); ?></h3>
    <ul>

        <li><?php echo $this->Html->link(__('Delete'), array('action' => 'delete', $this->Form->value('ClubException.id')), null, sprintf(__('Are you sure you want to delete # %s?'), $this->Form->value('ClubException.id'))); ?></li>
        <li><?php echo $this->Html->link(__('List Club Exceptions'), array('action' => 'index'));?></li>
        <li><?php echo $this->Html->link(__('List Clubs'), array('controller' => 'clubs', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__('New Club'), array('controller' => 'clubs', 'action' => 'add')); ?> </li>
    </ul>
</div>