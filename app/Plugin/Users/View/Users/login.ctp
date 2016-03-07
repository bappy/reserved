<?php
/**
 * Copyright 2010 - 2013, Cake Development Corporation (http://cakedc.com)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright 2010 - 2013, Cake Development Corporation (http://cakedc.com)
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
?>
<div class="users index login">
    
    <?php echo $this->Session->flash('auth'); ?>
    <fieldset>
        <?php
        echo $this->Form->create($model, array('action' => 'login','id' => 'LoginForm'));
        ?>
        <legend>
            <h1><?php echo __('RESERVED'); ?></h1>
        </legend>
        <div style="width:47%;padding-top:0;padding-right:75px;float:left;border-right:1px solid #cecece;">
        <?php
        echo $this->Form->input('email_address', array(
            'label' => __d('users', 'Email')));
        echo $this->Form->input('password');

        echo '<p>' . $this->Form->input('remember_me', array('type' => 'checkbox', 'label' => __d('users', 'Remember Me'))) . '</p>';
        

        echo $this->Form->hidden('User.return_to', array(
            'value' => $return_to));
        echo $this->Form->end(__d('users', 'Submit'));
        ?>
            </div>
        <div style="width: 30%; float: left; padding: 0px 0px 0px 50px;">
            Forgot your password?<br><?php echo $this->Html->link(__('Resset it here'), array('action' => 'reset_password')); ?>
        </div>
    </fieldset>
</div>
<?php echo $this->element('Users.Users/sidebar'); ?>
