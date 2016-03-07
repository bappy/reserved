<div class="clubs form">
    <?php echo $this->Form->create('Club');?>
    <fieldset>
        <legend><?php echo __('Add Club'); ?></legend>
        <?php
        //echo $this->Form->input('user_id');
        echo $this->Form->input('club_name');
        //echo $this->Form->input('club_type_id');
        echo $this->Form->input('address');
        //echo $this->Form->input('latitude');
        //echo $this->Form->input('longitude');
        echo $this->Form->input('User.email_address');
        echo $this->Form->input('User.confirm_email_address');
        echo $this->Form->input('User.phone_number');
        ?>
    </fieldset>
    <?php echo $this->Form->end(__('Submit'));?>
</div>