<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<?php
echo $this->Html->css(array("http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css", 'http://netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css', 'http://bdmdesign.github.io/bootstrap-switch/static/stylesheets/flat-ui-fonts.css', 'validationEngine.jquery'));
echo $this->Html->script(array('jquery.validationEngine-en', 'jquery.validationEngine', "ui/jquery.ui.core", "ui/jquery.ui.widget", "ui/jquery.ui.datepicker"));
//echo $this->Html->script(array('main', 'main'));
?>
<script type="text/javascript">            
    jQuery(document).ready(function() {
        jQuery("#add_club_deals").validationEngine('attach');
		
		// Initialize Tooltips
        $('[data-toggle="tooltip"], .enable-tooltip').tooltip({ container: 'body', animation: false });
		
        $( "#datepicker" ).datepicker({
            showOn: "button",
            dateFormat: 'yy-mm-dd',
            buttonImage: '<?php echo $this->webroot ?>img/calendar.gif',
            buttonImageOnly: true
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
        echo $this->element("sidebar-left-night-details", array("club_name" => "$club_name"));
        ?>
    </div>
    <div id="page-content-right" class="eqHight">
        <?php echo $this->element("top"); ?>
        <div class="page-title">
            <h2>Club Night Details</h2>
        </div>
        <div class="right-containr">
            <div class="rignt-contain-all">
                <div class="row-fluid">
                    <div class="span8">
                        <div class="clearfix">&nbsp;</div>
                        <div class="clearfix">&nbsp;</div>
                        <div class="clearfix">&nbsp;</div>
                        <div class="clearfix">&nbsp;</div>
                        <?php echo $this->Form->create('Deal', array('id' => 'add_club_deals')); ?>
                        <?php
						echo $this->Form->hidden('club_id', array('value' => $club_table_info['ClubTable']['club_id']));
						echo $this->Form->hidden('user_id', array('value' => $club_table_info['ClubTable']['user_id']));
                        ?>
                        <div class="row-fluid">
                            <div class="span8">
                                <div class="form-group">
                                    <label class="span3" for="minimumPrice">Standard Min: </label>
                                    <?php echo "$". $club_table_info['ClubTable']['minimum_price']; ?>
                            </div>
                        </div>
                        <div class="row-fluid">
                            <div class="span8">
                                <div class="form-group">
                                    <label class="span3" for="dealPrice">Deal Price : $</label>
<?php echo $this->Form->input('deal_price', array('type' => 'text', 'required' => false,  'label' => false, 'class' => 'span9 validate[required]', 'div' => false)); ?>
                                </div>
                            </div>
                        </div>
                        <div class="clearfix">&nbsp;</div>
                        <div class="row-fluid">
                            <div class="span8">
                                <div class="form-group">
                                    <label class="span4" for="club_table_deal_now">Deal Now?</label>
                                    <?php
                                    $options = array('on' => 'ON', 'off' => 'OFF');
                                    $attributes = array('legend' => false, 'hiddenField' => false, 'label' => array('class' => 'deal_status_radio_label'), 'class' => 'deal_status_radio_input validate[required]');
                                    echo $this->Form->radio('deal_now', $options, $attributes);
                                    ?>
                                    &nbsp;&nbsp;&nbsp;
                                    <a href="#" data-toggle="tooltip" data-placement="right" title="When ON deal will be immediately live on the Reserved App after Publishing." data-original-title="Tooltip on top" class="alert-gry">?</a>
                                </div>
                            </div>
                        </div>
                        <div class="row-fluid">
                            <div class="span8">
                                <div class="form-group">
                                    <label class="span3" for="">Date :</label>
                                    <div class="controls">
                                        <div class="span9 input-append date input-datepicker" id="deal_datepicker">
<?php echo $this->Form->input('deal_date', array('type' => 'text', 'required' => false, 'label' => false,'id' => 'datepicker', 'class' => 'span12 validate[required]', 'div' => false)); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row-fluid">
                            <div class="span8">
                                <div class="form-group">
                                    <label class="span4" for="recurTuesday">Recur Every Tuesday ?</label>
                                    <?php
                                    $options = array('yes' => 'ON', 'no' => 'OFF');
                                    $attributes = array('legend' => false, 'hiddenField' => false, 'label' => array('class' => 'deal_status_radio_label'), 'class' => 'deal_status_radio_input validate[required]');
                                    echo $this->Form->radio('recur', $options, $attributes);
                                    ?>
                                    &nbsp;&nbsp;&nbsp;
                                    <a href="#" data-toggle="tooltip" data-placement="right" title="If Recurring is set to ON then this deal will be live every week on the given day" data-original-title="Tooltip on top" class="alert-gry">?</a>
                                </div>
                            </div>
                        </div>
                        <div class="row-fluid">
                            <div class="span8">
                                <div class="form-group">
                                    <label class="span4" for="dealStatus">Deal Status :</label>
                                    <?php
                                    $options = array('on' => 'ON', 'off' => 'OFF');
                                    $attributes = array('legend' => false, 'hiddenField' => false, 'label' => array('class' => 'deal_status_radio_label'), 'class' => 'deal_status_radio_input validate[required]');
                                    echo $this->Form->radio('status', $options, $attributes);
                                    ?>
                                </div>
                                &nbsp;&nbsp;&nbsp;
                                <a href="#" data-toggle="tooltip" data-placement="right" title="If deal status is ON,deal will be live after publishing.If OFF,it will be saved for later use." data-original-title="Tooltip on top" class="alert-gry">?</a>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix">&nbsp;</div>
                    <div class="clearfix">&nbsp;</div>
                    <div class="clearfix">&nbsp;</div>
                    <div class="row-fluid">
                        <div class="span8">
                            <div class="form-actions">
                                <!--<a href="<?php echo $this->Html->url(array('controller' => 'Deals', 'action' => 'index')); ?>">
                                    <button type="button" class="btn btn-primary">Cancel</button>
                                </a>-->
                                <button type="submit" name="submit" class="btn btn-success">Save</button>
                            </div>
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