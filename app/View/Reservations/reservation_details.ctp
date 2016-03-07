<div class="row-fluid" id='myModal'>
    <div class="span5">
        <div id="myCarousel" class="carousel slide mCarousal">
           
            <div class="carousel-inner">
                <div class="active item">
            <?php 
	          if (!empty($profile_image['Photo']['photos'])) { 
                    ?>
                    <img src="<?php echo $this->webroot; ?>img/profile/<?php echo $profile_image['Photo']['photos']; ?>">
                     <?php 
		    } 
		    else 
                     { ?>
                    <img src="<?php echo $this->webroot; ?>img/default.jpg">
                     <?php 
		     } 
			?>
<!--                     <img src="<?php echo $this->webroot; ?>img/members.png">-->
                </div>
            </div>
        </div>
          <?php 
		 if($reservation['Club']['approve_auto_purchase'] == 'yes')
		 {
                    if($reservation['Booking']['status'] == 'reserved') :
		    ?>
        <a class="mBtn" href="javascript:void(0)" id="ajax_accept" exe="<?php echo $reservation['Booking']['id']; ?>" val="arrived">Arrived</a>
                    <?php  
                    endif;
                    if($reservation['Booking']['status'] == 'pending') :
                        ?>
        <a class="mBtn" href="javascript:void(0)" id="ajax_accept" exe="<?php echo $reservation['Booking']['id']; ?>" val="arrived">Arrived</a>   
                        <?php
                    endif;
                 } 
                 else
		 {
			if($reservation['Booking']['status'] == 'reserved')
			 {
			?>
        <a class="mBtn" href="javascript:void(0)" id="ajax_accept" exe="<?php echo $reservation['Booking']['id']; ?>" val="arrived">Arrived</a>
			<?php 
			 }
			 
			 if($reservation['Booking']['status'] == 'pending')
			 {
				?>
        <div class='show'>        
            <a href="#" class="mBtn" id="ajax_accept" exe="<?php echo $reservation['Booking']['id']; ?>" val="accept">Accept Request</a>
            <a href="#" id="ajax_accept" class="mBtn deep" exe="<?php echo $reservation['Booking']['id']; ?>" val="deny" style="margin:10px 0 0 4px">Deny Request</a>
        </div>
        <div class='hide'>
            <a href="#" class="mBtn" id="ajax_accept" exe="<?php echo $reservation['Booking']['id']; ?>" val="arrived">Arrived</a>
        </div>
				<?php 
			 }
		 }
                 ?>

    </div>

    <div class="span7">
        <h2 class="mTitle">
            <?php
              if ($reservation['Booking']['client_name'])
                {
                        echo $reservation['Booking']['client_name'];
                }
                else
                {
                        echo $reservation['User']['first_name']." ".$reservation['User']['last_name'];
                }
            ?>
        </h2>
        <div class="row-fluid">
            <div class="span6">
                <div class="box">
                    <span>Guys</span>
                    <h2><?php echo $reservation['Booking']['guys']; ?></h2>
                </div>
            </div>
            <div class="span6">
                <div class="box">
                    <span>Girls</span>
                    <h2><?php echo $reservation['Booking']['girls']; ?></h2>
                </div>
            </div>
        </div>
               <?php $total =  $reservation['Booking']['girls']+$reservation['Booking']['guys']; ?>
        <div class="box full">
            <span>Table Number</span>
            <h2><?php echo $total; ?></h2>
        </div>
    </div>
</div>