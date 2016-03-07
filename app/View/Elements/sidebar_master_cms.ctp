<div class="accordion" id="accordion2">
	<div class="accordion-group">
		<div class="accordion-heading">
	    	<h3><a class="accordion-toggle venuhead" data-toggle="collapse" data-parent="#accordion2" href="#collapseOne">VENUES&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="icon-chevron-down"></i></a></h3>
		</div>
		<div id="collapseOne" class="accordion-body collapse">
			<div class="accordion-inner venueitem">
				<?php 
					foreach($club_lists as $key=>$club_list){                         
						echo $this->Html->link(__($club_list), array('action' => 'set_club', $key),array('target' => '_blank'))."<br>";
					}
				?>
			</div>
		</div>
    </div>
    <div class="accordion-group">
    	<div class="accordion-heading">
    		<h3><a class="accordion-toggle"  href="<?php echo $this->Html->url(array('controller' => 'Promoters', 'action' => 'master_dashboard')); ?>">PROMOTERS</a></h3>
    	</div>
    	<!-- <div id="collapseTwo" class="accordion-body collapse">
    		<div class="accordion-inner"></div>
    	</div> -->
    </div>
    <div class="accordion-group">
    	<div class="accordion-heading">
    		<h3><a class="accordion-toggle" href="<?php echo $this->Html->url(array('controller' => 'Users', 'action' => 'master_dashboard')); ?>">USERS</a></h3>
    	</div>
    	<!-- <div id="collapseThree" class="accordion-body collapse">
    		<div class="accordion-inner"></div>
    	</div> -->
    </div>

</div>
<script type="text/javascript">
$(document).ready(function(){
$( ".venuhead" ).mouseover(function(){
   $( ".venuhead" ).trigger( "click" );
});
});
</script>

