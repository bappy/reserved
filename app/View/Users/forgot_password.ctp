
<div class="users form login">
    <?php echo $this->Session->flash(); ?>
    <?php echo $this->Session->flash('auth'); ?>
    <?php echo $this->Form->create('User'); ?>
    <fieldset>
        <legend>
            <h1><?php echo __('Reset your password'); ?></h1>
        </legend>
        <div style="width:85%;padding-top:0;float:left;">
            <p>Enter yours email address and we'll send you an email with instructions to reset  your password</p>
          
  <?php
            echo $this->Form->input('email_address',array('label'=>"Your email","required"=>false,
                "placeholder"=>"example@mail.com"));
            ?>
        </div>
      
    </fieldset>
    <?php echo $this->Form->end(__('Send mail')); ?>
</div>
<style>
    input 
    {
        padding-left: 0px;
    }
    </style>