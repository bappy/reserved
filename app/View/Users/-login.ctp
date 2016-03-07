

<!-- Login Intro -->
<a href="javascript:void(0)" class="login-btn themed-background-default">
    <span class="login-logo">
        <span class="square1 themed-border-default"></span>
        <span class="square2"></span>
        <span class="name">ReservedApp</span>
    </span>
</a>
<div class="left-door"></div>
<div class="right-door"></div>
<!-- END Login Intro -->

<!-- Login Container -->
<div id="login-container" class="hide">
    <!-- Login Block -->
    <div class="block-tabs block-themed themed-border-night">
        <ul id="login-tabs" class="nav nav-tabs themed-background-deepsea" data-toggle="tabs">
            <li class="active text-center">
                <a href="#login-form-tab">
                    <i class="icon-user"></i> Login
                </a>
            </li>

        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="login-form-tab">

                <!-- Login Form -->
                <div id="login-buttons">
                    <?php echo $this->Session->flash('auth'); ?>
                     <?php echo $this->Session->flash(); ?>
                </div>
                <?php echo $this->Form->create('User', array('id' => 'login-form', 'class' => 'form-inline')); ?>
                <div class="control-group">
                    <div class="controls">
                        <div class="input-prepend">
                            <span class="add-on"><i class="icon-envelope-alt"></i></span>
                            <input type="text" id="login-email" name="username" placeholder="Email..">
                        </div>
                    </div>
                </div>
                <div class="control-group">
                    <div class="controls">
                        <div class="input-prepend">
                            <span class="add-on"><i class="icon-asterisk"></i></span>
                            <input type="password" id="login-password" name="password" placeholder="Password..">
                        </div>
                    </div>
                </div>
                <div class="control-group">
                    <div class="controls clearfix">
                        <div class="pull-right">
                            <button type="submit" class="btn btn-success remove-margin">LogIn to Dashboard</button>
                        </div>
<!--                        <div class="pull-left login-extra-check">
                            <label for="login-remember-me">
                                <input type="checkbox" id="login-remember-me" name="login-remember-me" class="input-themed">
                                Remember me
                            </label>
                        </div>-->
                    </div>
                </div>
                </form>
                <!-- END Login Form -->
            </div>

        </div>
    </div>
    <!-- END Login Block -->
</div>
<!-- END Login Container -->
