<?php
echo $this->Html->css('validationEngine.jquery');
echo $this->Html->script(array('jquery.validationEngine-en', 'jquery.validationEngine'));
//echo $this->Html->script(array('main', 'main'));
//echo $countryList->select('country');
//pr($list);
?>
<script type="text/javascript">            
    jQuery(document).ready(function() {
		jQuery("#signup").validationEngine('attach');
    });
</script>
<div class="row-fluid">
    <div id="page-sidebar-left" class="eqHight">
        <?php
        if (isset($club_name) && !empty($club_name)) {
            $club_name = $club_name;
        } else {
            $club_name = "";
        }
        //echo $this->element("sidebar-left-pricing-tables", array("club_name" => "$club_name"));
        ?>
    </div>
    <div id="page-content-right" class="eqHight">
        <?php echo $this->element("top"); ?>
        <div class="page-title">
            <h2>CHANGE PASSWORD</h2>
            <div class="pull-right"></div>
        </div>
        <div class="right-containr">
            <div class="rignt-contain-all">
                <?php echo $this->Session->flash(); ?>
                <div class="row-fluid">
                    <div class="span8 offset1">
                        <div class="clearfix">&nbsp;</div>
                        <?php echo $this->Form->create('User',array('id'=>'signup')); ?>
                        <h5 class="bg-color">CHANGE PASSWORD</h5>
                        <div class="row-fluid">
                            <div class="span5">
                            	<label class="">*Old Password</label>
                                <?php echo $this->Form->input('old_pass', array('type' => 'password','label' => false, 'class' => 'input-xlarge validate[required]', 'div' => false)); ?>
                            </div>
                            <div class="span5">
                            	<label class="">*New Password</label>
                                <?php echo $this->Form->input('password', array('type' => 'password', 'label' => false, 'class' => 'input-xlarge validate[required]', 'div' => false)); ?>
                            </div>
                        </div>
                        <div class="clearfix">&nbsp;</div>
                        <div class="row-fluid">
                            <div class="span5">
                            	<label class="">*Confirm Password</label>
                                <?php echo $this->Form->input('confirm_password', array('type' => 'password', 'required' => false, 'label' => false, 'class' => 'input-xlarge validate[required]', 'div' => false)); ?>
                            </div>
                        </div>
                        <div class="clearfix">&nbsp;</div>
                        <div class="row-fluid">
                            
                            <div class="span3">
                                <button type="submit" name="registration" class="btn btn-labeled btn-success"><span class="btn-label"></span>Create My Account</button>
                            </div>
                        </div>
                        <?php echo $this->Form->end(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php //echo $this->element('footer_Club') ?>