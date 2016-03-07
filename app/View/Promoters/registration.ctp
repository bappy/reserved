<?php

echo $this->Html->css('validation_css/validationEngine.jquery');
echo $this->Html->script(array('validation_js/jquery.validationEngine-en', 'validation_js/jquery.validationEngine'));
?>
<script type="text/javascript">
    jQuery(document).ready(function() {
        jQuery("#signup").validationEngine('attach');
    });
</script>
<style>
    body {background: #fff;}
    .formWrapper {
        background: none repeat scroll 0 0 #d6d6d6;
        margin: 7px;
        padding: 75px 95px 12px;
    }
    .pageTitle {color: #584d4d; font-family: "Perpetua Titling MT Bold"; }
    .form {background: #fff; padding: 1px;}
    .registationForm { padding: 0 12px 25px 22px; background: #f8f2e2; border: 1px solid #e3ddb9; margin: 0!important;}
    .registationForm label span {color: red;}
    .registationForm label { font-size: 14px; color: #5f5c5a;}
    .registationForm label.leftLabel, .registationForm input.leftInput, .registationForm select.leftSelect {margin-left: 15px;}

    .registationForm input[type="checkbox"] {width: auto;}
    .registationForm input { height: 15px!important; width: 80%;}
    .registationForm select { height: 27px!important; width: 85%;}
    .topTitle {border-bottom: 1px solid #ebe5c9; margin-bottom: 10px;}
    .secTitle {color: #584d4d;  padding-bottom: 8px; font-size: 18px; text-transform: capitalize; float: left; margin-bottom: 0;} 
    .secTitleTwo {color: #584d4d;  padding-bottom: 8px; font-size: 18px; text-transform: capitalize; border-bottom: 1px solid #ebe5c9; } 
    .starMark { float: right; font-size: 11px; margin-top: 12px; font-weight: bold;}
    .starMark b {color: red;}
    .codeDetails {font-size: 13px; color: #584d4d; font-weight: bold; margin-left: 10px; margin-bottom: 28px;}
    .btnSuccess {background: #fe9d21; color: #fff; border: 1px solid #cac5b8; padding: 10px; font-size: 25px; font-weight: bold; margin-top: 20px; margin-left: 41px;}
    .btnSuccess:hover {background: #fe9d21; color: #fff;}
    .promoterSign h2 {font-size: 25px; color: #584d4d; line-height: 30px!important;}
    .promoterSign {margin-top: 70px;}
</style>

<div class="row-fluid">
    <div class="span9">
        <div class="formWrapper">
            <div class="pageTitle">
                <h2>Hooray Henry's</h2>
                <div class="pull-right"></div>
            </div>
            <div class="form">
                <?php echo $this->Session->flash(); ?>
                <?php echo $this->Form->create('User', array('id' => 'signup','class' => 'registationForm')); ?>                
                <div class="topTitle">
                    <h5 class="secTitle">Promoter partner Registration form</h5>
                    <span class="starMark">Fields marks with <b>*</b> are mandatory.</span>
                    <div class="clearfix">&nbsp;</div>
                </div>
                <div class="row-fluid">
                    <div class="span6">
                        <label class="leftLabel"><span>*</span>First Name</label>                            
                            <?php echo $this->Form->input('first_name', array('type' => 'text', 'label' => false, 'class' => 'input-xlarge validate[required]', 'div' => false)); ?>
                    </div>
                    <div class="span6">
                        <label class=""><span>*</span>Last Name</label>
                            <?php echo $this->Form->input('last_name', array('type' => 'text', 'label' => false, 'class' => 'input-xlarge validate[required]', 'div' => false)); ?>
                    </div>
                </div>
                <div class="clearfix">&nbsp;</div>
                <div class="row-fluid">
                    <div class="span6">
                        <label class="leftLabel"><span>*</span>Email Address</label>
                            <?php echo $this->Form->input('email_address', array('type' => 'text', 'required' => false, 'label' => false, 'class' => 'input-xlarge validate[required,custom[email]]', 'div' => false)); ?>
                    </div>
                    <div class="span6">
                        <label class="">Website Address</label>
                            <?php echo $this->Form->input('UserInfo.website', array('type' => 'text', 'required' => false, 'label' => false, 'class' => 'input-xlarge', 'div' => false)); ?>
                    </div>
                </div>
                <div class="clearfix">&nbsp;</div>
                <h5 class="secTitleTwo">Account Details</h5>
                <div class="row-fluid">
                    <div class="span6">
                        <label class="leftLabel"><span>*</span>Street Address</label>
                        <?php echo $this->Form->input('UserInfo.street_address', array('type' => 'text', 'required' => false, 'label' => false, 'class' => 'input-xlarge validate[required]', 'div' => false)); ?>
                    </div>
                    <div class="span6">
                        <label class="">Additional Address</label>
                        <?php echo $this->Form->input('UserInfo.add_address', array('type' => 'text', 'required' => false, 'label' => false, 'class' => 'input-xlarge', 'div' => false)); ?>
                    </div>
                </div>
                <div class="clearfix">&nbsp;</div>
                <div class="row-fluid">
                    <div class="span6">
                        <label class="leftLabel"><span>*</span>City</label>
                        <?php echo $this->Form->input('UserInfo.city', array('type' => 'text', 'required' => false, 'label' => false, 'class' => 'input-xlarge validate[required]', 'div' => false)); ?>
                                <?php
                                echo $this->Form->input('User.join_date', array('type' => 'hidden', 'required' => false, 'label' => false, 'div' => false, 'value' => date('Y-m-d H:i:s')));
                                echo $this->Form->input('UserInfo.user_id', array('type' => 'hidden', 'required' => false, 'label' => false, 'div' => false));
                                echo $this->Form->input('User.user_type', array('type' => 'hidden', 'required' => false, 'label' => false, 'div' => false, 'value' => 'promoter'));
                                ?>
                    </div>
                    <div class="span6">
                        <label class=""><span>*</span>State/Province</label>
                        <?php echo $this->Form->input('UserInfo.state', array('type' => 'text', 'required' => false, 'label' => false, 'class' => 'input-xlarge validate[required]', 'div' => false)); ?>
                    </div>
                </div>
                <div class="clearfix">&nbsp;</div>
                <div class="row-fluid">
                    <div class="span6">
                        <label class="leftLabel"><span>*</span>Postal Code</label>
                        <?php echo $this->Form->input('UserInfo.postal_code', array('type' => 'text', 'required' => false, 'label' => false, 'class' => 'input-xlarge validate[required]', 'div' => false)); ?>
                    </div>
                    <div class="span6">
                        <label><span>*</span>Phone Number</label>
                        <?php echo $this->Form->input('UserInfo.phone_no', array('autocomplete' => 'off','type' => 'text', 'required' => false, 'label' => false, 'class' => 'input-xlarge validate[required]', 'div' => false)); ?>
                    </div>
                </div>
                <div class="clearfix">&nbsp;</div>
                <div class="row-fluid">
                    <div class="span6">
                        <label class="leftLabel">Country</label>
                        <?php echo $this->Form->input('UserInfo.country_id', array('type' => 'select', 'label' => false, 'class' => 'input-xlarge validate[required]', 'div' => false, 'required' => false, 'options' => $country, 'empty' => 'Select Countries')); ?>                    
                    </div>
                </div>
                <div class="clearfix">&nbsp;</div>
                <h5 class="secTitleTwo">Account Details:</h5>

                <div class="row-fluid">
                    <div class="span6">
                        <label class="leftLabel"><span>*</span>Password</label>
                        <?php echo $this->Form->input('password', array('autocomplete' => 'off','type' => 'password', 'required' => false, 'label' => false, 'class' => 'input-xlarge validate[required]', 'div' => false)); ?>
                    </div>
                    <div class="span6">
                        <label><span>*</span>Check Payable To</label>
                        <?php echo $this->Form->input('UserInfo.check', array('type' => 'text', 'required' => false, 'label' => false, 'class' => 'input-xlarge validate[required]', 'div' => false)); ?>
                    </div>
                </div>
                <div class="clearfix">&nbsp;</div>

                <div class="row-fluid">
                    <div class="span6">
                        <label class="leftLabel"><span>*</span>Confirm Password</label>
                        <?php echo $this->Form->input('confirm_password', array('autocomplete' => 'off','type' => 'password', 'required' => false, 'label' => false, 'class' => 'input-xlarge validate[required]', 'div' => false)); ?>
                    </div>
                    <div class="span6">
                        <label class="">Paypal Email</label>
                        <?php echo $this->Form->input('UserInfo.paypal_email', array('type' => 'text', 'required' => false, 'label' => false, 'class' => 'input-xlarge,validate[custom[email]]', 'div' => false)); ?>
                    </div>
                </div>
                <div class="clearfix">&nbsp;</div>

                <div class="row-fluid">
                    <div class="span12">
                        <h5 class="secTitleTwo">Promoter Code Details:</h5>
                        <div class="codeDetails">
                            <p>Your promoter code will be the code you will ask client to enter into get comissions from their perchase</p>
                            <p>Please note that,when you submit this form, your promoter name can not be changed.</p>
                            <p>We recommended your promoter code being a variation of your first name and last name(Dylan and DylanR)</p>
                        </div>
                    </div>
                </div>
                <div class="row-fluid">
                    <div class="span6">
                        <label class="leftLabel"><span>*</span>Promoter Code</label>
                        <?php echo $this->Form->input('promoter_code', array('type' => 'text', 'required' => false, 'label' => false, 'class' => 'input-xlarge validate[required]', 'div' => false)); ?>
                    </div>
                    <div class="span6">
                        <label class=""><span>*</span>Confirm Promoter Code</label>
                        <?php echo $this->Form->input('con_promoter_code', array('type' => 'text', 'required' => false, 'label' => false, 'class' => 'input-xlarge validate[required]', 'div' => false)); ?>
                    </div>
                </div>
                <div class="clearfix">&nbsp;</div>
                <div class="row-fluid">
                    <div class="span6 offset3">
<!--                        <div class="input checkbox">
                            <input name="data[UserInfo][terms]" id="UserInfoTerms_" value="0" type="hidden">
                            <input name="data[UserInfo][terms]" class="validate[required]" value="1" id="UserInfoTerms" type="checkbox">
                            <label for="UserInfoTerms">I have read and agree to the <a href=" #" style="text-decoration: underline; color: #5f5c5a;">terms and conditions</a></label>
                        </div>-->
<!-- Button trigger modal -->

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header" style="color:#000;background:#e3ddb9 ">
        
        <h4 class="modal-title" style="background:#e3ddb9" id="myModalLabel">Terms and Conditions</h4>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        
      </div>
    </div>
  </div>
</div>
                        <?php
                            echo $this->Form->input('UserInfo.terms', array('type' => 'checkbox', 'label' => 'I have read and agree to the <a  data-toggle="modal" data-target="#myModal">terms and conditions</a>', 'class' => 'validate[required]'));
?>
 <br>

                        <button type="submit" name="registration" class="btn btn-labeled btnSuccess"><span class="btn-label"></span>Create My Account</button>
                    </div>
                </div>
                <div class="clearfix">&nbsp;</div>
                <div class="row-fluid">
                    <div class="span3">
                    </div>
                </div>
                </form> 
            </div>
        </div>
    </div>
    <div class="span3" style="min-height: 500px">
        <div class="promoterSign">
            
            <div class="pull-right"></div>
        </div>
    </div>
</div>


<?php //echo $this->element('footer_Club'); ?>