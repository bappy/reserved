<?php
	echo $this->Html->css(array("http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css", 'http://netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css', 'http://bdmdesign.github.io/bootstrap-switch/static/stylesheets/flat-ui-fonts.css', 'validationEngine.jquery'));
	echo $this->Html->script(array('jquery.validationEngine-en', 'jquery.validationEngine', "ui/jquery.ui.core", "ui/jquery.ui.widget", "ui/jquery.ui.datepicker"));
?>
<script type="text/javascript">            
    jQuery(document).ready(function() {
        jQuery("#add_club_events").validationEngine('attach');
        $('[data-toggle="tooltip"], .enable-tooltip').tooltip({ container: 'body', animation: false });
		var weekday=new Array(7);
        weekday[0]="Sunday";
        weekday[1]="Monday";
        weekday[2]="Tuesday";
        weekday[3]="Wednesday";
        weekday[4]="Thursday";
        weekday[5]="Friday";
        weekday[6]="Saturday";
        
         $( "#datepicker" ).datepicker({
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
    <div class="span12">        
        <div class="row-fluid">
            <div class="span3 text-left">
                <h3>Add Event</h3>
			</div>
            <div class="span1 offset6">
                <div class="checkbox pull-right">
                    <a href="<?php echo $this->Html->url(array('controller' => 'Events', 'action' => 'index')); ?>">
                        <button type="button" class="btn btn-labeled btn-default">
                            <span class="btn-label">Cancel</span>
						</button>
					</a>
				</div>
			</div>
            
		</div>
        <?php echo $this->Form->create('Event', array('id' => 'add_club_events')); ?>        
		<div class="row-fluid">
			<div class="span12">
				<div class="row-fluid">
					<div class="span4"><label>Performer :</label></div>
					<div class="span8" style="position:relative; float:left;"><?php echo $this->Form->input('performer', array('type' => 'text', 'required' => false, 'label' => false, 'class' => 'span9 validate[required]', 'div' => false)); ?>
					</div>
				</div>				
				<div class="row-fluid">					
					<div class="span4"><label>Music :</label></div>
					<div class="span8" style="position:relative; float:left;"><?php echo $this->Form->input('category_id', array('type' => 'select', 'label' => false, 'class' => 'span9 validate[required]', 'id' => 'status', 'div' => false, 'required' => false, 'options' => $categories, 'empty' => 'Select a Category')); ?>
					</div>					
				</div>
				<div class="row-fluid">					
					<div class="span4"><label>Table Price Multiplier :</label></div>
					<div class="span7" style="position:relative; float:left;">
						<?php
							$mltiplier_array = array(
							" " => "None",
							".5" => ".5",
							"1" => "1",
							"1.5" => "1.5",
							"2" => "2",
							"2.5" => "2.5",
							"3" => "3",
							"3.5" => "3.5",
							"4" => "4",
							"4.5" => "4.5",
							"5" => "5",
							);
							echo $this->Form->input('price_multiplier', array('type' => 'select', 'label' => false, 'class' => 'span9 validate[required]', 'id' => 'status', 'div' => false, 'required' => false, 'options' => $mltiplier_array));
						?>
					</div>
					
					<div class="span1">
						<a href="#" data-toggle="tooltip" data-placement="right" title="This increase all the table prices by a certain multiplier.This number gets multiplied by the table minimum and shows a higher minimum for the night.(ex:Have a hot DJ for a certain night?Changing the table to 1.5 would change a $1,000 table into a $1,500 table)" data-original-title="Tooltip on top" class="alert-gry">?</a>
					</div>
				</div>
				<div class="row-fluid">
					<div class="span4"><label>Date :</label></div>
					
					<div class="span8 input-append date input-datepicker" style="position:relative; float:left;">
						<?php echo $this->Form->input('event_date', array('type' => 'text', 'required' => false, 'label' => false, 'id' => 'datepicker', 'class' => 'validate[required] span12', 'div' => false)); ?>
					</div>
				</div>				
				<div class="row-fluid">
					<div class="span8">
						<label>Recur Every 
							<input readonly="readonly" style="width:75px;border:none;background:none;cursor:pointer;font-weight:normal;font-size:17px" type="text" id="dateHidden" />
						?</label>
					</div>
					<?php
						$options = array('yes' => 'ON', 'no' => 'OFF');
						$attributes = array('legend' => false, 'hiddenField' => false, 'label' => array('class' => 'recur_radio_label'), 'class' => 'recur_radio_input validate[required]', 'value' => 'no');
						echo $this->Form->radio('recur_week', $options, $attributes);
					?>
					&nbsp;&nbsp;&nbsp;
					<a href="#" data-toggle="tooltip" data-placement="right" title="If Recurring is set ON then this deal will be live every week on the given day" data-original-title="Tooltip on top" class="alert-gry">?</a>
				</div>
			</div>
		</div>
		<div class="row-fluid">
			<div class="span12">			
				<a href="<?php echo $this->Html->url(array('controller' => 'Events', 'action' => 'index')); ?>">
					<button type="button" class="btn btn-primary">Cancel</button>
				</a>
				<button type="submit" class="btn btn-success">Save And Publish</button>
				
			</div>
		</div>
	</div>			
</div>
<?php echo $this->Form->hidden('club_id', array('value' => $club_id)); ?>
<?php echo $this->Form->end(); ?>
</div>
</div>