<?php

echo $this->Html->css('validation_css/validationEngine.jquery');
	echo $this->Html->script(array('validation_js/jquery.validationEngine-en', 'validation_js/jquery.validationEngine'));
?>
<script type="text/javascript">
    jQuery(document).ready(function() {
        jQuery("#signup").validationEngine('attach');

        $('#showBasicInfo').on('click', function(e) {
            e.preventDefault();
            $(".showBasicInfo").hide();
            $(".editBasicInfo").show();
            $(this).hide();
            $("#hideBasicInfo").show();
        });
        $('#hideBasicInfo').on('click', function(e) {
            e.preventDefault();
            $(".showBasicInfo").show();
            $(".editBasicInfo").hide();
            $(this).hide();
            $("#showBasicInfo").show();
        });

        jQuery("#contactinfo").validationEngine('attach');
        $('#showContactInfo').on('click', function(e) {
            e.preventDefault();
            $(".showContactInfo").hide();
            $(".editContactInfo").show();
            $(this).hide();
            $("#hideContactInfo").show();
        });
        $('#hideContactInfo').on('click', function(e) {
            e.preventDefault();
            $(".showContactInfo").show();
            $(".editContactInfo").hide();
            $(this).hide();
            $("#showContactInfo").show();
        });
        jQuery("#paymentinfo").validationEngine('attach');
        $('#showPaymentInfo').on('click', function(e) {
            e.preventDefault();
            $(".showPaymentInfo").hide();
            $(".editPaymentInfo").show();
            $(this).hide();
            $("#hidePaymentInfo").show();
        });
        $('#hidePaymentInfo').on('click', function(e) {
            e.preventDefault();
            $(".showPaymentInfo").show();
            $(".editPaymentInfo").hide();
            $(this).hide();
            $("#showPaymentInfo").show();
        });
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
			
		?>

        <div class="page-title">
            <h4>Your Promoter Code <br> <?php echo $data[0]['User']['promoter_code']; ?></h4>
        </div>
    </div>
    <div id="page-content-right" class="eqHight">
        <?php echo $this->element("top"); ?>
        <div class="page-title">
            <h2>Account Settings</h2>
            <div class="pull-right"></div>
        </div>
        <div class="right-containr">
            <div class="rignt-contain-all">
                <?php echo $this->Session->flash(); ?>
                <div class="row-fluid">
                    <div class="span8">                        
                        <?php //echo $this->Form->create('User',array('id'=>'signup')); ?>                        
                        <div class="row-fluid">
                            <h5 class="bg-color">Basic Information <span style="float:right"><a id='showBasicInfo' href="javascript:void(0);">Edit</a><a id='hideBasicInfo' href="javascript:void(0);" style="display:none">Cancel</a></a></span></h5>
                            <div class="span12 showBasicInfo">
                                <div class="row-fluid">
                                    <div class="span2">
                                        <label>Payee Name :</label>
                                    </div>
                                    <div class="span6">
									<?php echo $data[0]['User']['first_name']."&nbsp;"; echo $data[0]['User']['last_name']; ?>
                                    </div>
                                </div>
                                <div class="row-fluid">
                                    <div class="span2">
                                        <label>Address :</label>
                                    </div>
                                    <div class="span6">
									<?php 
										echo $data[0]['UserInfo']['street_address']."<br>";
										if($data[0]['UserInfo']['add_address']) { 
											echo $data[0]['UserInfo']['add_address']."<br>"; 
										} 
										echo $data[0]['UserInfo']['city']."<br>"; 
										echo $data[0]['UserInfo']['state']."<br>";
										echo $data[0]['UserInfo']['postal_code']."<br>";
									?>
                                    </div>
                                </div>	
                                <div class="row-fluid">
                                    <div class="span2">
                                        <label>Tax ID :</label>
                                    </div>
                                    <div class="span6">
									<?php if(isset($data[0]['UserInfo']['tax_id']))echo $data[0]['UserInfo']['tax_id']; ?>
                                    </div>
                                </div>                                
                            </div>
                            <div class="span12 editBasicInfo" style="display:none">
                                <div class="row-fluid">
                                    <div class="span11 offset1">								
									<?php 
										echo $this->Form->create('User',array('id'=>'signup',"class" =>"form-horizontal",
										'url' => array('controller' => 'Promoters', 'action' => 'edit',$data[0]['User']['id'] )
										)); 
									?>										
                                        <div class="control-group">
                                            <label class="control-label" for="UserFirstName"><span class="error">*</span>First Name</label>
                                            <div class="controls" style="position:relative">
											<?php echo $this->Form->input('first_name', array('type' => 'text','label' => false, 'class' => 'input validate[required]', 'div' => false,'value'=>$data[0]['User']['first_name'])); ?>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label" for="UserLastName"><span class="error">*</span>Last Name</label>
                                            <div class="controls">
											<?php echo $this->Form->input('last_name', array('type' => 'text', 'label' => false, 'class' => 'input validate[required]', 'div' => false,'value'=>$data[0]['User']['last_name'])); ?>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label" for="UserInfoStreetAddress"><span class="error">*</span>Street Address</label>
                                            <div class="controls">
											<?php echo $this->Form->input('UserInfo.street_address', array('type' => 'text', 'required' => false, 'label' => false, 'class' => 'input validate[required]', 'div' => false,'value'=>$data[0]['UserInfo']['street_address'])); ?>
                                            </div>
                                        </div>										
                                        <div class="control-group">
                                            <label class="control-label" for="UserInfoAddAddress">Suite or Apt #</label>
                                            <div class="controls">
											<?php echo $this->Form->input('UserInfo.add_address', array('type' => 'text', 'required' => false, 'label' => false, 'class' => 'input', 'div' => false,'value'=>$data[0]['UserInfo']['add_address'])); ?>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label" for="UserInfoCity"><span class="error">*</span>City</label>
                                            <div class="controls">
											<?php echo $this->Form->input('UserInfo.city', array('type' => 'text', 'required' => false, 'label' => false, 'class' => 'input validate[required]', 'div' => false,'value'=>$data[0]['UserInfo']['city'])); ?>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label" for="UserInfoCountryId"><span class="error">*</span>Country</label>
                                            <div class="controls">
											<?php 
												echo $this->Form->input('UserInfo.country_id', array(
												'default' => $data[0]['UserInfo']['country_id'], 
												'options' => $country,
												'div' => false,
												'label' => false													
												)); 
											?>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label" for="UserInfoState"><span class="error">*</span>State / Province</label>
                                            <div class="controls">
											<?php echo $this->Form->input('UserInfo.state', array('type' => 'text', 'required' => false, 'label' => false, 'class' => 'validate[required]', 'div' => false,'value'=>$data[0]['UserInfo']['state'])); ?>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label" for="UserInfoPostalCode"><span class="error">*</span>Zip / Postal Code</label>
                                            <div class="controls">
											<?php echo $this->Form->input('UserInfo.postal_code', array('type' => 'text', 'required' => false, 'label' => false, 'class' => 'input validate[required]', 'div' => false,'value'=>$data[0]['UserInfo']['postal_code'])); ?>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label" for="UserInfoTaxId">Tax ID</label>
                                            <div class="controls">
											<?php echo $this->Form->input('UserInfo.tax_id', array('type' => 'text', 'required' => false, 'label' => false, 'class' => 'input', 'div' => false,'value'=>$data[0]['UserInfo']['tax_id'])); ?>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <div class="controls">										  
                                                <button type="submit" class="btn btn-labeled btn-success"><span class="btn-label"></span>Update Basic Information</button>
                                            </div>
                                        </div>
									<?php echo $this->Form->end(); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row-fluid">
                            <div class="span12 showBasicInfo">
							<?php echo $this->Html->link(__('Change Password'), array('action' => 'change_password', $data[0]['UserInfo']['user_id'])); ?>
                            </div>
                        </div>
                        <div class="clearfix">&nbsp;</div>                        
                        <div class="row-fluid">
                            <h5 class="bg-color">Contact Information <span style="float:right"><a id='showContactInfo' href="javascript:void(0);">Edit</a><a id='hideContactInfo' href="javascript:void(0);" style="display:none">Cancel</a></a></span></h5>
                            <div class="span12 showContactInfo">
                                <div class="row-fluid">
                                    <div class="span2">
                                        <label>Name :</label>
                                    </div>
                                    <div class="span6">
									<?php echo $data[0]['User']['first_name']."&nbsp;";  echo $data[0]['User']['last_name']; ?>
                                    </div>
                                </div>
                                <div class="row-fluid">
                                    <div class="span2">
                                        <label>Email :</label>
                                    </div>
                                    <div class="span6">
									<?php echo $data[0]['User']['email_address']; ?>
                                    </div>
                                </div>
                                <div class="row-fluid">
                                    <div class="span2">
                                        <label>Phone :</label>
                                    </div>
                                    <div class="span6">
									<?php echo $data[0]['UserInfo']['phone_no']; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="span12 editContactInfo" style="display:none">
                                <div class="row-fluid">
                                    <div class="span11 offset1">								
									<?php 
										echo $this->Form->create('User',array('name'=>'contactinfo','id'=>'contactinfo',"class" =>"form-horizontal",
										'url' => array('controller' => 'Promoters', 'action' => 'edit',$data[0]['User']['id'] )
										)); 
									?>										
                                        <div class="control-group">
                                            <label class="control-label" for="UserFirstName"><span class="error">*</span>First Name</label>
                                            <div class="controls" style="position:relative">
											<?php echo $this->Form->input('first_name', array('type' => 'text','label' => false, 'class' => 'input validate[required]', 'div' => false,'value'=>$data[0]['User']['first_name'])); ?>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label" for="UserLastName"><span class="error">*</span>Last Name</label>
                                            <div class="controls">
											<?php echo $this->Form->input('last_name', array('type' => 'text', 'label' => false, 'class' => 'input validate[required]', 'div' => false,'value'=>$data[0]['User']['last_name'])); ?>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label" for="UserInfoStreetAddress"><span class="error">*</span>Email</label>
                                            <div class="controls">
											<?php echo $this->Form->input('User.email_address', array('type' => 'text', 'required' => false, 'label' => false, 'class' => 'input validate[required,custom[email]]', 'div' => false,'value'=>$data[0]['User']['email_address'])); ?>
                                            </div>
                                        </div>									
                                        <div class="control-group">
                                            <label class="control-label" for="UserInfoCity"><span class="error">*</span>Phone Number</label>
                                            <div class="controls">
											<?php echo $this->Form->input('UserInfo.phone_no', array('type' => 'text', 'required' => false, 'label' => false, 'class' => 'input validate[required]', 'div' => false,'value'=>$data[0]['UserInfo']['phone_no'])); ?>
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <div class="controls">										  
                                                <button type="submit" class="btn btn-labeled btn-success"><span class="btn-label"></span>Update Contact Information</button>
                                            </div>
                                        </div>
									<?php echo $this->Form->end(); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="clearfix">&nbsp;</div>
                        <div class="row-fluid">
                            <h5 class="bg-color">Payment Information  <span style="float:right"><a id='showPaymentInfo' href="javascript:void(0);">Edit</a><a id='hidePaymentInfo' href="javascript:void(0);" style="display:none">Cancel</a></a></span></h5>
                            <div class="span12 showPaymentInfo">						
                                <label>Payment Threshold : $<?php echo $data[0]['UserInfo']['payment_threshold']; ?></label> 
                                <label>Paypal for Payments : <?php echo $data[0]['UserInfo']['paypal_email']; ?></label>
                            </div>

                        </div>
                        <div class="span12 editPaymentInfo" style="display:none">
                            <div class="row-fluid">
                                <div class="span11 offset1">								
									<?php 
										echo $this->Form->create('User',array('name'=>'paymentinfo','id'=>'paymentinfo',"class" =>"form-horizontal",
										'url' => array('controller' => 'Promoters', 'action' => 'edit',$data[0]['User']['id'] )
										)); 
									?>										
                                    <div class="control-group">
                                        <label class="control-label" for="UserFirstName"><span class="error">*</span>Payment Threshold</label>
                                        <div class="controls" style="position:relative">
											<?php 
											$thresholds['100'] = "$100.00";
											$thresholds['500'] = "$500.00";
											$thresholds['1000'] = "$1000.00";
											$thresholds['2000'] = "$2000.00";
											$thresholds['5000'] = "$5000.00";
											$thresholds['10000'] = "$10000.00";
												echo $this->Form->input('UserInfo.payment_threshold', array(
												'default' => $data[0]['UserInfo']['payment_threshold'], 
												'options' => $thresholds,
												'div' => false,
												'label' => false													
												)); 
											?>
                                        </div>
                                    </div>								
                                    <div class="control-group">
                                        <div class="controls">										  
                                            <button type="submit" class="btn btn-labeled btn-success"><span class="btn-label"></span>Update Payment Information</button>
                                        </div>
                                    </div>
									<?php echo $this->Form->end(); ?>
                                </div>
                            </div>
                        </div>
					<?php //echo $this->Form->end(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php echo $this->element('footer_Club') ?>			