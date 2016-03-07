<?php
echo $this->Html->script(array('jquery-1.10.2.min.js', 'vendor/bootstrap.min', "ui/jquery.ui.core", "ui/jquery.ui.widget", "ui/jquery.ui.datepicker", 'basic/js/jquery.simplemodal', 'clubsettings', 'vendor/modernizr-2.6.2-respond-1.1.0.min', 'docs/vendor/prism', 'docs/index'));
echo $this->Html->css(array("http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css", 'bootstrap', 'plugins', 'themes', 'castom', 'plugins', 'main', 'http://netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css', 'http://bdmdesign.github.io/bootstrap-switch/static/stylesheets/flat-ui-fonts.css', 'basic/css/basic'));
echo $this->Html->css(array('basic/basic', 'basic/basic_ie', 'utility', 'developers-custom'));
?>
<div class="row-fluid">
    <div class="clearfix">&nbsp;</div>
    <div class="clearfix">&nbsp;</div>
    <div class="clearfix">&nbsp;</div>
    <div class="clearfix">&nbsp;</div>
    <div class="clearfix">&nbsp;</div>
    <div class="clearfix">&nbsp;</div>
    <div class="span6 offset3">
        <div class="signuptitel">
            <h2 class="lightFint">Reserved</h2>
        </div>
        <div class="well well-white">
            <div class="row-fluid">
                <div class="span12">
                    <?php echo $this->Session->flash(); ?>
                    <?php echo $this->Session->flash('auth'); ?>
                    <div class="row-fluid">
                        <div class="span12">
                            <h3>Log In To Your Dashboard</h3>
                        </div>
                    </div>
                    <div class="row-fluid">
                        <div class="span8">
                            <?php echo $this->Form->create('User', array('class' => 'login')); ?>
                            <div class="form-group">
                                <label for="Email" class="span8">Email address</label>
                                <?php echo $this->Form->input('email_address', array('type' => 'text', 'required' => false, 'label' => false, 'class' => 'form-control span8', 'id' => 'Email', 'div' => false, 'placeholder' => 'Email address')); ?>
                            </div>                           
                            <div class="form-group">
                                <label for="Password" class="span8">Password</label>
                                <?php echo $this->Form->input('password', array('type' => 'password', 'required' => false, 'label' => false, 'class' => 'form-control span8', 'id' => 'Password', 'div' => false, 'placeholder' => 'Password')); ?>
                            </div>
                            <div class="form-group">
                                <input type="checkbox" checked="" id="destroy-switch" class="pull-left">
                                <label for="inputUsernameEmail" class="span8">Remember my email</label>
                            </div>
                            <div class="clear">&nbsp;</div>
                            <div class="form-group">
                                <button type="submit" class="btn btn btn-primary">
                                    Login
                                </button>
                            </div>
                            <?php echo $this->Form->end(); ?>
                        </div>
                        <div class="span4">
                            <div class="login-forget-password">
                                <h5>Forgot your password?</h5>
                                <?php echo $this->Html->link(__('Reset it here'), array('controller' => 'Users', 'action' => 'forgot_password')); ?>
                            </div>
                        </div>
                    </div>
                    <div class="clear">&nbsp;</div>
                </div>
            </div>
        </div>
    </div>
</div>