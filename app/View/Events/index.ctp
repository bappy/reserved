<?php
	echo $this->Html->css(array("http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css", 'http://netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css', 'http://bdmdesign.github.io/bootstrap-switch/static/stylesheets/flat-ui-fonts.css'));
	echo $this->Html->css('validationEngine.jquery');
	echo $this->Html->script(array('jquery.validationEngine-en', 'jquery.validationEngine'));
?>
<div class="row-fluid">
    <div id="page-sidebar-left" class="eqHight">
        <?php
			if (isset($club_name) && !empty($club_name)) {
				$club_name = $club_name;
				} else {
				$club_name = "";
			}
			echo $this->element("sidebar-left-night-details-events", array("club_name" => $club_name));
		?>
	</div>
    <div id="page-content-right" class="eqHight">
        <?php echo $this->element("admin_top"); ?>
        <div class="page-title">
            <h2>Club Night Details</h2>
			<a href="#myModal" role="button" class="btn pull-right adNewAccountBtn" data-toggle="modal543" data-load-remote="<?php echo $this->Html->url(array('controller' => 'Events', 'action' => 'add')); ?>" data-remote-target=".ajax-content"><i class="halflingicon-plus"></i></a> 
		</div>
        <div class="right-containr">
            <div class="rignt-contain-all">
                <div class="row-fluid">
                    <div class="span6">
                        <div class="responsive club_table">
                            <table class="table table-bordered table-hover">
								<thead>
									<tr>
										<th>Date</th>
										<th>Performer/DJ</th>
										<th>Type of Music</th>
										<th>Table Price Multiplier</th>
										
									</tr>
								</thead>
								<tbody>
									<?php
										if (!empty($events)):
										foreach ($events as $event):
									?>
                                    <tr data-remote-target=".ajax-content" data-load-remote="<?php echo $this->Html->url(array("action" => "edit",$event['Event']['id']));?>">
                                        <td><?php echo date("D, M j, Y", strtotime($event['Event']['event_date'])); ?></td>
                                        <td><?php echo $event['Event']['performer']; ?></td>
                                        <td><?php echo $event['Category']['category_name']; ?></td>
                                        <td><?php echo $event['Event']['price_multiplier']; ?></td>
                                        <!--td>
                                            <?php echo $this->Html->link(__('Edit | '), array('controller' => 'Events', 'action' => 'edit', $event['Event']['id'])); ?>
                                            <?php echo $this->Html->link(__('Delete'), array('controller' => 'Events', 'action' => 'delete', $event['Event']['id']), null, sprintf(__('Are you sure you want to delete # %s?'), $event['Event']['id'])); ?>
										</td-->
									</tr>
                                    <?php
										endforeach;
										else:
									?>
									<tr>
										<td colspan="4">No Special Events Found.</td>
									</tr>
									<?php endif; ?>
								</tbody>
							</table>
						</div>
						<p>
							<?php
								echo $this->Paginator->counter(array(
								'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%')
								));
							?>
						</p>
						<div class="paging">
							<?php echo $this->Paginator->prev('<< ' . __('previous'), array(), null, array('class' => 'disabled')); ?>
							| 	<?php echo $this->Paginator->numbers(); ?>
							|
							<?php echo $this->Paginator->next(__('next') . ' >>', array(), null, array('class' => 'disabled')); ?>
						</div>
					</div>
                    <div class="span6">
                        <div class="ajax-content"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
    jQuery(document).ready(function() {
        var loader_html = "<span style='text-align:center;font-weight:700;'>loading please wait...</span>";
        $('[data-load-remote]').on('click', function(e) {
            e.preventDefault();
            var $this = $(this);
            var remote = $this.data('load-remote');
			
            if (remote) {
                $($this.data('remote-target')).html(loader_html);
                $($this.data('remote-target')).load(remote);
			}
		});
		
	});
    
</script>