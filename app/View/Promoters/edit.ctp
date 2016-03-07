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

<!--<select>
	<option><?php //echo $countryList; ?></option>
</select>-->
<div class="row-fluid">
    <div id="page-sidebar-left" class="eqHight">
        <?php
        if (isset($club_name) && !empty($club_name)) {
            $club_name = $club_name;
        } else {
            $club_name = "";
        }
  
?>
        
        <div class="page-title">
            <h4>Your Promoter Code <br> <?php echo $data[0]['User']['promoter_code']; ?></h4>
        </div>
    </div>
    <div id="page-content-right" class="eqHight">
        <?php echo $this->element("top"); ?>
        <div class="page-title">
            <h2>Promoter Signup form</h2>
            <div class="pull-right"></div>
        </div>
        <div class="right-containr">
            <div class="rignt-contain-all">
                <?php echo $this->Session->flash(); ?>
                <div class="row-fluid">
                    <div class="span8 offset1">
                        <div class="clearfix">&nbsp;</div>
                        <?php 
						echo $this->Form->create('User',array('id'=>'signup')); 
						?>
                        <h5 class="bg-color">Promoter partner Registration form</h5>
                        <div class="row-fluid">
                            <div class="span5">
                            	<label class="">*First Name</label>
                                <?php echo $this->Form->input('first_name', array('type' => 'text','label' => false, 'class' => 'input-xlarge validate[required]', 'div' => false,'value'=>$data[0]['User']['first_name'])); ?>
                            </div>
                            <div class="span5">
                            	<label class="">*Last Name</label>
                                <?php echo $this->Form->input('last_name', array('type' => 'text', 'label' => false, 'class' => 'input-xlarge validate[required]', 'div' => false,'value'=>$data[0]['User']['last_name'])); ?>
                            </div>
                        </div>
                        <div class="clearfix">&nbsp;</div>
                        <div class="row-fluid">
                            <div class="span5">
                            	<label class="">*Email Address</label>
                                <?php echo $this->Form->input('email_address', array('type' => 'text', 'required' => false, 'label' => false, 'class' => 'input-xlarge validate[required,custom[email]]', 'div' => false,'value'=>$data[0]['User']['email_address'])); ?>
                            </div>
                            <div class="span5">
                            	<label class="">*Website Address</label>
                                <?php echo $this->Form->input('UserInfo.website', array('type' => 'text', 'required' => false, 'label' => false, 'class' => 'input-xlarge validate[required,custom[url]]', 'div' => false,'value'=>$data[0]['UserInfo']['website'])); ?>
                            </div>
                        </div>
                        <div class="clearfix">&nbsp;</div>
                        <h5 class="bg-color">Account Information</h5>
                        <div class="row-fluid">
                            <div class="span5">
                            	<label class="">*Street Address</label>
                                <?php echo $this->Form->input('UserInfo.street_address', array('type' => 'text', 'required' => false, 'label' => false, 'class' => 'input-xlarge validate[required]', 'div' => false,'value'=>$data[0]['UserInfo']['street_address'])); ?>
                            </div>
                            <div class="span5">
                            	<label class="">Additional Address</label>
                                <?php echo $this->Form->input('UserInfo.add_address', array('type' => 'text', 'required' => false, 'label' => false, 'class' => 'input-xlarge', 'div' => false,'value'=>$data[0]['UserInfo']['add_address'])); ?>
                            </div>
                        </div>
                        <div class="clearfix">&nbsp;</div>
                        <div class="row-fluid">
                            <div class="span5">
                            	<label class="">*City</label>
                                <?php echo $this->Form->input('UserInfo.city', array('type' => 'text', 'required' => false, 'label' => false, 'class' => 'input-xlarge validate[required]', 'div' => false,'value'=>$data[0]['UserInfo']['city'])); ?>
                               
                            </div>
                            <div class="span5">
                            	<label class="">*State/Province</label>
                                <?php echo $this->Form->input('UserInfo.state', array('type' => 'text', 'required' => false, 'label' => false, 'class' => 'input-xlarge validate[required]', 'div' => false,'value'=>$data[0]['UserInfo']['state'])); ?>
                            </div>
                        </div>
                        <div class="clearfix">&nbsp;</div>
                        <div class="row-fluid">
                            <div class="span5">
                            	<label class="">*Postal Code</label>
                                <?php echo $this->Form->input('UserInfo.postal_code', array('type' => 'text', 'required' => false, 'label' => false, 'class' => 'input-xlarge validate[required]', 'div' => false,'value'=>$data[0]['UserInfo']['postal_code'])); ?>
                            </div>
                            <div class="span5">
                            	<label class="">*Phone Number</label>
                                <?php echo $this->Form->input('UserInfo.phone_no', array('type' => 'text', 'required' => false, 'label' => false, 'class' => 'input-xlarge validate[required]', 'div' => false,'value'=>$data[0]['UserInfo']['phone_no'])); ?>
                            </div>
                        </div>
                        <div class="clearfix">&nbsp;</div>
                        <div class="row-fluid">
                            <div class="span5">
                                <?php 
								    echo $this->Form->input('UserInfo.country_id', array(
										'default' => $data[0]['UserInfo']['country_id'], // since your default value is $r
										'options' => $country
									)); 
								?>
                            </div>
                        </div>
                        <div class="clearfix">&nbsp;</div>
                        <h5 class="bg-color">Promoter code details</h5>
                        <h5>Your promoter code will be the code you will ask client to enter into get comissions from their perchase</h5>
                        <h5>Please note that,when you submit this form, your promoter name can not be changed.<h5>
                        <h5>We recommended your promoter code being a variation of your first name and last name(Dylan and DylanR)<h5>
                        <div class="row-fluid">
                            <div class="span5">
                            	<label class="">*Check Pay to</label>
                                <?php echo $this->Form->input('UserInfo.check', array('type' => 'text', 'required' => false, 'label' => false, 'class' => 'input-xlarge validate[required]', 'div' => false,'value'=>$data[0]['UserInfo']['check'])); ?>
                            </div>
                            <div class="span5">
                            	<label class="">Paypal Email</label>
                                <?php echo $this->Form->input('UserInfo.paypal_email', array('type' => 'text', 'required' => false, 'label' => false, 'class' => 'input-xlarge,validate[custom[email]]', 'div' => false,'value'=>$data[0]['UserInfo']['paypal_email'])); ?>
                            </div>
                        </div>
                        <div class="clearfix">&nbsp;</div>
                        
                        <div class="row-fluid">
                            <div class="span5">
                            	<label class="">*Promoter Code</label>
                                <?php echo $this->Form->input('promo_code', array('type' => 'text', 'required' => false, 'label' => false, 'class' => 'input-xlarge validate[required]', 'div' => false,'value'=>$data[0]['User']['promoter_code'])); ?>
                            </div>
                        </div>
                        <div class="clearfix">&nbsp;</div>
                        
                        <div class="row-fluid">
                            
                            <div class="span3">
                                <button type="submit" class="btn btn-labeled btn-success"><span class="btn-label"></span>Edit Account</button>
                            </div>
                        </div>
                        <?php echo $this->Form->end(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php echo $this->element('footer_Club') ?>