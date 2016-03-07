<?php
	echo $this->Html->css(array("http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css", 'http://netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css', 'http://bdmdesign.github.io/bootstrap-switch/static/stylesheets/flat-ui-fonts.css', 'validationEngine.jquery'));
	echo $this->Html->script(array('jquery.validationEngine-en', 'jquery.validationEngine', "ui/jquery.ui.core", "ui/jquery.ui.widget", "ui/jquery.ui.datepicker"));
	//echo $this->Html->script(array('main', 'main'));
?>
<script type="text/javascript">            
    jQuery(document).ready(function() {
        jQuery("#add_club_deals").validationEngine('attach');
        $('[data-toggle="tooltip"], .enable-tooltip').tooltip({ container: 'body', animation: false });
		
	});
</script>

<script type="text/javascript">            
    $(function() {
        
		var weekday=new Array(7);
		weekday[0]="Sunday";
		weekday[1]="Monday";
		weekday[2]="Tuesday";
		weekday[3]="Wednesday";
		weekday[4]="Thursday";
		weekday[5]="Friday";
		weekday[6]="Saturday";
		
		$(".datepicker").datepicker(
		{
			dateFormat: "yy-mm-dd",
			onSelect: function (date) 
			{ 
				var row = $(this).attr("exe");
				var d = new Date(date);
				var day=weekday[d.getDay()];
				$('#dateHidden'+row).val(day);
			}
		});
		var scntDiv = $('#loadHTML');
		var i = $('#loadHTML').size();
		
		$("#addScnt").click(function(){
			if(i<=6)
			{
                var j = i+1;
                $('<div id="load'+i+'"><div class="row-fluid"><div class="span8"><div class="form-group"><label class="span3" for="">Date :</label><div class="controls"><div class="span9 input-append date input-datepicker" id="deal_datepicker"><input id="dateNew'+j+'" exe="'+j+'" class="span12 validate[required] datepicker" type="text" style="clear:both;display:block" name="data[Deal][deal_date][]"></div></div></div></div></div><div class="row-fluid"><div class="span8"><div class="form-group"><label class="span4" for="recurTuesday">Recur Every <input readonly="readonly" style="width:90px;border:none;background:none;cursor:pointer;font-weight:normal;font-size:17px" type="text" id="dateHidden'+j+'" /></label><input id="RecurYes'+i+'" class="deal_status_radio_input validate[required]" type="radio" value="yes" name="data[Deal][recur]['+i+']"><label class="deal_status_radio_label" for="RecurYes">ON</label><input id="RecurNo'+i+'" class="deal_status_radio_input validate[required]" type="radio" value="no" name="data[Deal][recur]['+i+']"><label class="deal_status_radio_label" for="RecurNo">OFF</label></div></div></div></div>').appendTo(scntDiv);
				
				var weekday=new Array(7);
				weekday[0]="Sunday";
				weekday[1]="Monday";
				weekday[2]="Tuesday";
				weekday[3]="Wednesday";
				weekday[4]="Thursday";
				weekday[5]="Friday";
				weekday[6]="Saturday";
				$(".datepicker").datepicker(
				{
					dateFormat: "yy-mm-dd",
					onSelect: function (date) 
					{
						var row = $(this).attr("exe");
						var d = new Date(date);
						var day=weekday[d.getDay()];
						$('#dateHidden'+row).val(day);
					}
				});
				i++;
				return false;
			}
			else
			{
				alert("You have reached maximum limit(7 day's)")
			}
		});
		
		$("#remScnt").click(function(){
			if(i>1)
			{
				i=i-1;
				$("#load"+i).remove();
			}
		});
		
		$("#DealClubTableId").change(function(){
			var table = $("#DealClubTableId").val();//alert(table);
			$.ajax({
				type: "POST",
				url: myBaseUrl+"/Deals/getPrice/",
				data: {table: table}
                }).done(function( msg ) {
				//alert(msg);
				$("#return-min").text('$'+msg);
			});
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
            <h2>Turn Table Into Deals</h2>
		</div>
        <div class="right-containr">
            <div class="rignt-contain-all">
                <div class="row-fluid">
                    <div class="span8">
						
                        <?php echo $this->Form->create('Deal', array('id' => 'add_club_deals')); ?>
                        <?php echo $this->Form->hidden('club_id', array('value' => $club_id)); ?>                        
                        <div class="row-fluid">
							<div class="span2"><label>Table :</label></div>
							<div class="span6" style="position:relative; float:left;">
								<?php echo $this->Form->input('club_table_id', array('type' => 'select', 'label' => false, 'class' => 'span9 validate[required]', 'div' => false, 'required' => false, 'options' => $tables, 'empty' => 'Select a Table')); ?>
							</div>
							
						</div>
                        <div class="row-fluid">                            
							<div class="span2"><label>Standard Min: </label></div>
							<div class="span6"><span id='return-min'></span></div>
						</div>
                        
                        <div class="row-fluid">                        
							<div class="span2"><label>Deal % : </label></div>
							<div class="span6" style="position:relative; float:left;">
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
									'options' => $deal_array,
									'label' =>false,
									'div'=>false
									)); 
								?>
							</div>
						</div>
                        
                        <div class="clearfix">&nbsp;</div>
                        <!--<div class="row-fluid">
                            <div class="span8">
							<div class="form-group">
							<label class="span4" for="club_table_deal_now">Deal Now?</label>
							<?php
								$options = array('on' => 'ON', 'off' => 'OFF');
								$attributes = array('legend' => false, 'hiddenField' => false, 'label' => array('class' => 'deal_status_radio_label'), 'class' => 'deal_status_radio_input validate[required]', 'value' => $club_table_info['Deal'][0]['deal_now']);
								echo $this->Form->radio('deal_now', $options, $attributes);
							?>
							&nbsp;&nbsp;&nbsp;
							<a href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="Tooltip on top" class="alert-gry">?</a>
							</div>
                            </div>
						</div>-->
                        
                        <div id="loadHTML">
                            <div id="load0">
                                <div class="row-fluid">
                                    <div class="span2"><label>Date :</label></div>
                                    <div class="span6 input-append date input-datepicker" id="deal_datepicker" style="position:relative; float:left;">
										<?php echo $this->Form->input('deal_date.', array('type' => 'text', 'required' => false,'exe'=>'1', 'label' => false, 'id' => 'dateNew1', 'class' => 'span12 validate[required] datepicker', 'div' => false,'style'=>'clear:both;display:block')); ?>
									</div>
								</div>
							</div>
						</div>
						<div class="row-fluid">
							<div class="span2"><label>Recur Every </label></div>
							<div class="span2">
								<input readonly="readonly" style="width:55px;border:none;background:none;cursor:pointer;font-weight:normal;font-size:17px" type="text" id="dateHidden1" />
								?
							</div>    
							<div class="span4" style="position:relative; float:left;">
								<?php
									$options = array('yes' => 'ON', 'no' => 'OFF');
									$attributes = array('legend' => false, 'hiddenField' => false, 'label' => array('class' => 'deal_status_radio_label'), 'class' => 'deal_status_radio_input validate[required]','id'=>'RecurYes0');
									echo $this->Form->radio('Deal.recur.0', $options, $attributes);
								?>
								&nbsp;&nbsp;&nbsp;
								<a href="#" data-toggle="tooltip" data-placement="right" title="If Recurring is set to ON then this deal will be live every week on the given day" data-original-title="Tooltip on top" class="alert-gry">?</a>
							</div>
						</div>
						
                        
                        <h2 style="font-size:14px"><a href="javascript:void(0)" id="addScnt">Add</a> || <a href="javascript:void(0)" id="remScnt">Remove</a></h2>
                        
                        <div class="row-fluid">
                            <div class="span2"><label>Deal Status :</label></div>
							<div class="span6" style="position:relative; float:left;">
								<?php
									$options = array('1' => 'ON', '0' => 'OFF');
									$attributes = array('legend' => false, 'hiddenField' => false, 'label' => array('class' => 'deal_status_radio_label'), 'class' => 'deal_status_radio_input validate[required]');
									echo $this->Form->radio('status', $options, $attributes);
								?>
								
								&nbsp;&nbsp;&nbsp;
								<a href="#" data-toggle="tooltip" data-placement="right" title="If deal status is ON,deal will be live after publishing.If OFF,it will be saved for later use." data-original-title="Tooltip on top" class="alert-gry">?</a>
							</div>
						</div>
					
				<div class="row-fluid">
					<div class="span8">
						
						<a href="<?php echo $this->Html->url(array('controller' => 'Deals', 'action' => 'index')); ?>">
							<button type="button" class="btn btn-primary">Cancel</button>
						</a>
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