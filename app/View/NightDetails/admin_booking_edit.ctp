<?php
echo $this->Html->css(array("http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css", 'http://netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css', 'http://bdmdesign.github.io/bootstrap-switch/static/stylesheets/flat-ui-fonts.css'));
echo $this->Html->css('validationEngine.jquery');
echo $this->Html->script(array('jquery.validationEngine-en', 'jquery.validationEngine'));
?>
<script type="text/javascript">            
    jQuery(document).ready(function() {
        jQuery("#edit_club_booking").validationEngine('attach');
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
        <?php echo $this->element("sidebar_master_cms", array('club_lists' => $club_lists)); ?>
    </div>
    <div id="page-content-right" class="eqHight">
        <?php echo $this->element("top"); ?>
        <div class="page-title">
            <h2>Club Night Details</h2>
        </div>
        <div class="right-containr">
            <div class="rignt-contain-all">
                <div class="row-fluid">
                    <div class="span12">                        
                        <div class="clearfix">&nbsp;</div>
                        <?php echo $this->Form->create('Booking', array('id' => 'edit_club_booking')); ?>
                        <?php
                        echo $this->Form->hidden('id');
                        echo $this->Form->hidden('user_id');
                        echo $this->Form->hidden('club_id');
                        ?>
                        <div class="row-fluid">
                            <div class="span8">
                                <div class="form-group">
                                    <label class="span3" for="status">Status :</label>
                                    <?php
									
                                    $dropdown_array = array(
                                        "available" => "available",
                                        "cancelled" => "cancelled",
                                        "check_in" => "check_in",
                                        "pending" => "pending",
                                        "reserved" => "reserved",
                                        "taken" => "taken",
                                        "expired" => "expired",
                                        "accepted" => "accepted"
                                    );
                                    echo $this->Form->input('status', array('type' => 'select', 'label' => false, 'class' => 'span9 validate[required]', 'id' => 'status', 'div' => false, 'required' => false, 'options' => $dropdown_array));
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="row-fluid">
                            <div class="span8">
                                <div class="form-group">
                                    <label class="span3" for="clientName">Client :</label>
                                    <?php echo $this->Form->input('client_name', array('type' => 'text', 'required' => false, 'label' => false, 'class' => 'span9', 'div' => false)); ?>
                                </div>
                            </div>
                        </div>
                        <div class="row-fluid">
                            <div class="span8">
                                <div class="form-group">
                                    <label class="span3" for="clientPhone">Call Phone number :</label>
                                    <?php echo $this->Form->input('client_phone', array('type' => 'text', 'required' => false, 'label' => false, 'class' => 'span9', 'div' => false)); ?>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row-fluid">
                            <div class="span8">
                        
                                    <a href="<?php echo $this->Html->url(array('controller' => 'NightDetails', 'action' => 'index')); ?>">
                                        <button type="button" class="btn btn-primary">Cancel</button>
                                    </a>
                                    <button type="submit" name="submit" class="btn btn-success">Save And Publish</button>
                                </div>
                        
                        </div>
                        
                        <?php echo $this->Form->end(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>