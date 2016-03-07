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
	var weekday=new Array(7);
        weekday[0]="Sunday";
        weekday[1]="Monday";
        weekday[2]="Tuesday";
        weekday[3]="Wednesday";
        weekday[4]="Thursday";
        weekday[5]="Friday";
        weekday[6]="Saturday";	
        $("#datepicker").datepicker(
        {
                dateFormat: "yy-mm-dd",
                onSelect: function (date) 
                { 
                    var d = new Date(date);
                    var day=weekday[d.getDay()];
                    $('#dateHidden').val(day);
                }
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
        <?php echo $this->element("admin_top"); ?>
        <div class="page-title">
            <h2>Turn Table Into Deals</h2>
        </div>
        <div class="right-containr">
            <div class="rignt-contain-all">
                <div class="row-fluid">
                    <div class="span8">
                        <?php echo $this->Form->create('Deal', array('id' => 'add_club_deals')); ?>
                        <?php
                        $current_date = date("Y-m-d");
                        echo $this->Form->hidden('club_id', array('value' => $club_table_info['ClubTable']['club_id']));
                        echo $this->Form->hidden('club_table_id', array('value' => $club_table_info['ClubTable']['id']));
                        echo $this->Form->hidden('deal_date', array('value' => $current_date, 'id' => 'hidden_deal_date', 'disabled' => true));
                        if (isset($club_table_info['Deal'][0]['id'])) {
                            echo $this->Form->hidden('id', array('value' => $club_table_info['Deal'][0]['id'], 'id' => 'hidden_deal_id'));
                        }
                        else {
                            $club_table_info['Deal'][0]['deal_price'] = '';
                            $club_table_info['Deal'][0]['deal_now'] = '';
                            $club_table_info['Deal'][0]['deal_date'] = '';
                            $club_table_info['Deal'][0]['recur'] = '';
                            $club_table_info['Deal'][0]['status'] = '';
                        }
                        ?>
                        <div class="row-fluid">
                            <div class="span8">
                                <div class="form-group">
                                    <label class="span3" for="minimumPrice">Standard Min: </label>
<?php echo "$" . $club_table_info['ClubTable']['minimum_price']; ?>
                                </div>
                            </div>
                        </div>
                        <div class="row-fluid">
                            <div class="span8">
                                <div class="form-group">
                                    <label class="span3" for="dealPrice">Deal % : </label>
                                     <?php
                                    $deal_array = array(
                                        "10" => "10",
                                        "15" => "15",
                                        "20" => "20",
                                        "25" => "25",
                                        "30" => "30",
                                        "35" => "35",
                                        "40" => "40",
                                        "45" => "45",
                                        "50" => "50",
                                        "55" => "55",
                                        "60" => "60",
                                        "65" => "65",
                                        "70" => "70",
                                        "75" => "75",
                                        "80" => "80",
                                        "85" => "85",
                                        "90" => "90",
                                    );
                                    echo $this->Form->input('deal_price', array(
                                        'default' => $club_table_info['Deal']['deal_price'],//since your default value is $r
                                         'options' => $deal_array,
                                          'label' =>false,
                                           'div'=>false
                                        )); 
                                ?>
                                </div>
                            </div>
                        </div>
                        
<!--                        <div class="row-fluid">
                            <div class="span8">
                                <div class="form-group">
                                    <label class="span4" for="club_table_deal_now">Deal Now?</label>
                                    <?php
                                    $options = array('on' => 'ON', 'off' => 'OFF');
                                    $attributes = array('legend' => false, 'hiddenField' => false, 'label' => array('class' => 'deal_status_radio_label'), 'class' => 'deal_status_radio_input validate[required]', 'value' => $club_table_info['Deal']['deal_now']);
                                    echo $this->Form->radio('deal_now', $options, $attributes);
                                    ?>
                                    &nbsp;&nbsp;&nbsp;
                                    <a href="#" data-toggle="tooltip" data-placement="right" title="When ON deal will be immediately live on the Reserved App after Publishing." data-original-title="Tooltip on top" class="alert-gry">?</a>
                                </div>
                            </div>
                        </div>-->
                        <div class="row-fluid">
                            <div class="span8">
                                <div class="form-group">
                                    <label class="span3" for="">Date :</label>
                                    <div class="controls">
                                        <div class="span9 input-append date input-datepicker" id="deal_datepicker">
<?php echo $this->Form->input('deal_date', array('type' => 'text', 'required' => false, 'label' => false, 'value' => $club_table_info['Deal']['deal_date'], 'id' => 'datepicker', 'class' => 'span12 validate[required]', 'div' => false)); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row-fluid">
                            <div class="span8">
                                <div class="form-group">
                                    <label class="span6" for="recurTuesday">Recur Every                                        
                                        <?php 
                                        if(isset($club_table_info['Deal']['deal_date']) && $club_table_info['Deal']['deal_date']!="")
                                        {
                                                $timestamp = strtotime($club_table_info['Deal']['deal_date']);
                                                $day = date('l', $timestamp);
                                        }
                                        else
                                        {
                                                $day = "";
                                        }
					?>
                                    	<input readonly="readonly" style="width:55px;border:none;background:none;cursor:pointer;font-weight:normal;font-size:17px" type="text" id="dateHidden" value="<?php echo $day; ?>" />
                                        ?</label>
                                    <?php
                                    $options = array('yes' => 'ON', 'no' => 'OFF');
                                    $attributes = array('legend' => false, 'hiddenField' => false, 'label' => array('class' => 'deal_status_radio_label'), 'class' => 'deal_status_radio_input validate[required]', 'value' => $club_table_info['Deal']['recur']);
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
                                    $options = array('1' => 'ON', '0' => 'OFF');
                                    $attributes = array('legend' => false, 'hiddenField' => false, 'label' => array('class' => 'deal_status_radio_label'), 'class' => 'deal_status_radio_input validate[required]', 'value' => $club_table_info['Deal']['status']);
                                    echo $this->Form->radio('status', $options, $attributes);
                                    ?>
                                    &nbsp;&nbsp;&nbsp;
                                    <a href="#" data-toggle="tooltip" data-placement="right" title="If deal status is ON,deal will be live after publishing.If OFF,it will be saved for later use." data-original-title="Tooltip on top" class="alert-gry">?</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row-fluid">
                        <div class="span8">                          
                                <a href="<?php echo $this->Html->url(array('controller' => 'Deals', 'action' => 'index')); ?>">
                                    <button type="button" class="btn btn-primary">Cancel</button>
                                </a>
                                <button type="submit" name="submit" class="btn btn-success">Save And Publish</button>
                                <?php echo $this->Html->link(__('Delete'), array('action' => 'delete', $club_table_info['Deal']['id']), null, sprintf(__('Are you sure you want to delete # %s?'), $club_table_info['Deal']['id'])); ?>
                            
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