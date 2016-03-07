<?php
echo $this->Html->css(array("http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css", 'http://netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css', 'http://bdmdesign.github.io/bootstrap-switch/static/stylesheets/flat-ui-fonts.css'));
echo $this->Html->css('validationEngine.jquery');
echo $this->Html->script(array('jquery.validationEngine-en', 'jquery.validationEngine'));
?>
<script type="text/javascript">
    jQuery(document).ready(function() {
        jQuery("#revervation").validationEngine('attach');
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
        echo $this->element("sidebar-left-night-details", array("club_name" => "$club_name"));
        
        ?>
        <?php //echo $this->element("sidebar_master_cms", array('club_lists' => $club_lists)); ?>
    </div>
    <div id="page-content-right" class="eqHight">
        <?php echo $this->element("admin_top"); ?>
        <div class="page-title">
            <h2>Club Night Details</h2>
        </div>
        <div class="right-containr">
            <div class="rignt-contain-all">
                <div class="row-fluid">
                    <div class="span12">                        
                        <?php echo $this->Form->create('Booking', array('id' => 'revervation')); ?>
                        <?php
                        //echo $this->Form->hidden('user_id',array('value'=>$user_id));
                        echo $this->Form->hidden('club_id',array('value'=>$club_id));
			echo $this->Form->hidden('booking_method',array('value'=>'Manually Added'));
                       ?>
                        <div class="row-fluid">
                            <div class="span2">                                
                                <label>Status :</label>
                            </div>
                            <div class="span6">                                
                                    <?php
                                    $dropdown_array = array(                                        
					"pending" => "pending",
                                        "available" => "available",
                                        "cancelled" => "cancelled",
                                        "check_in" => "check_in",
                                        "reserved" => "reserved",
                                        "taken" => "taken",
                                        "expired" => "expired",
                                        "accepted" => "accepted"
                                    );
                                    echo $this->Form->input('status', array('type' => 'select', 'label' => false,'class' => 'span9 validate[required]', 'id' => 'status', 'div' => false, 'required' => false, 'options' => $dropdown_array));
                                    ?>
                            </div>
                        </div>

                        <div class="row-fluid">
                            <div class="span2">                               
                                <label>Client :</label>
                            </div>
                            <div class="span6">                               
                                    <?php echo $this->Form->input('client_name', array('type' => 'text', 'required' => false, 'label' => false, 'class' => 'span9', 'div' => false)); ?>
                            </div>
                        </div>

                        <div class="row-fluid">
                            <div class="span2">                                
                                <label>Call phone number :</label>                                    
                            </div>
                            <div class="span6">                       
                                <?php echo $this->Form->input('client_phone', array('type' => 'text', 'required' => false, 'label' => false, 'class' => 'span9', 'div' => false)); ?>
                            </div>
                        </div>
                        <div class="row-fluid">
                            <div class="span2">                                
                                <label>Arrival date :</label>
                            </div>
                            <div class="span6">                       
                                    <?php echo $this->Form->input('arrival_date', array('label' => false, 'div' => false, 'style'=>'width:25%')); ?>
                            </div>
                        </div>
                        <div class="row-fluid">
                            <div class="span2">                                
                                <label>Booking time :</label>
                            </div>
                            <div class="span6">                       
                                    <?php echo $this->Form->input('booking_time', array('label' => false, 'div' => false, 'style'=>'width:13%')); ?>
                            </div>
                        </div>
                        <div class="clearfix">&nbsp;</div>
                        <div class="row-fluid">
                            <div class="span8">                                
                                    <button type="submit" name="submit" class="btn btn-success">Save And Publish</button>
                                
                            </div>
                        </div>
                        <div class="clearfix">&nbsp;</div>
                        <?php echo $this->Form->end(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>