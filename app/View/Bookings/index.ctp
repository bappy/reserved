<script type="text/javascript">
function getFulfilled(id)
{
    alert("Url :-"+myBaseUrl);
    $.ajax({
        type: "POST",
        url: myBaseUrl+"/Bookings/fulfilled",
        data: {
            id:id
        }
    }).done(function( msg ) {
       alert(msg);
       window.location.reload();
    });
}
function cancel(id)
{
    alert("Url :-"+myBaseUrl);
    $.ajax({
        type: "POST",
        url: myBaseUrl+"/Bookings/cancel",
        data: {
            id:id
        }
    }).done(function( msg ) {
       alert(msg);
       window.location.reload();
    });
}
</script>
<div class="row-fluid">
    <div id="page-sidebar-left" class="eqHight">
        <div class="topNav">
            <ul class="nav">
                <li><a href="#">RESERVED</a></li>
            </ul>
            <div class="clear">&nbsp;</div>
        </div>
        <div class="page-title">
            <h2>
                <?php
                if (isset($club_name) && !empty($club_name)):
                    echo $club_name;
                endif;
                ?>
            </h2>
        </div>
        <div class="left-containr"></div>
    </div>
    <div id="page-content-right" class="eqHight">
        <?php echo $this->element("top"); ?>
        <div class="page-title">
            <h2>All Orders <small><?php echo $this->Paginator->sort('arrival_time', 'By Time', array('escape' => false , 'class' => 'order_sort')); ?> </small><small><?php echo $this->Paginator->sort('club_table_id', 'By Table', array('escape' => false , 'class' => 'order_sort')); ?></small></h2>
        </div>
        <div class="right-containr">
            <div class="rignt-contain-all">
                <div class="row-fluid">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th><?php echo $this->Paginator->sort('arrival_time', 'TIME', array('escape' => false , 'class' => 'order_sort')); ?></th>
                                <th><?php echo $this->Paginator->sort('club_table_id', 'TABLE', array('escape' => false , 'class' => 'order_sort')); ?></th>
                                <th>NAME</th>
                                <th>REQUEST</th>
                                <th>CAREGORY</th>
                                <th>PRICE</th>
                                <th>Cancel</th>
                                <th>FULFILLED</th>
                            </tr>
                            
                        </thead>
                        <tbody>
                            <?php if (!empty($bookings)): ?>
                                <?php foreach ($bookings as $booking): 
                                    if($booking['Booking']['status']=="fulfilled")
                                    {
                                        $color = "#ededed";
                                    }
                                    else
                                    { $color = ""; }
                                    ?>
                                    <tr bgcolor="<?php echo $color; ?>">
                                        <td><a class="addRightSit" href="#"><?php echo $booking['Booking']['arrival_time']; ?></a></td>
                                        <td><?php echo $booking['ClubTable']['table_name']; ?></td>
                                        <td><?php echo $booking['Booking']['client_name']; ?></td>
                                        <td><i class="glyphicon-wallet"></i>&nbsp;&nbsp; <?php if(!empty($booking['Booking']['booking_method'])){ echo $booking['Booking']['booking_method']; } else { echo "Not given" ;} ?></td>
                                        <td>
											<?php 
											if(isset($booking['ClubTable']['Category']['category_name']) && $booking['ClubTable']['Category']['category_name'] !="")
											{ 
												echo $booking['ClubTable']['Category']['category_name'];
											
											} ?></td>
                                        <td><?php echo $booking['Booking']['booking_price']; 
										   ?>
                                         </td>
                                        <td> <a href="#" Onclick="cancel(<?php echo $booking['Booking']['id']; ?>); ">Cancel</a></td>
                                        <td>
                                         <?php if($booking['Booking']['status']!="fulfilled") { ?>
                                                <input type="checkbox" id="create-switch" onclick="getFulfilled(<?php echo $booking['Booking']['id']; ?>)">
                                         <?php } else { ?>
                                                <input type="checkbox" checked="checked" id="create-switch">
                                         <?php } ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="7">No Order Found.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>

                    <p>
            <?php
            echo $this->Paginator->counter(array(
                'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%')
            ));
            ?>
        </p>
        <div class="paging">
            <?php echo $this->Paginator->prev('<< ' . __('previous'), array(), null, array('class' => 'disabled')); ?>
            |   <?php echo $this->Paginator->numbers(); ?>
            |
            <?php echo $this->Paginator->next(__('next') . ' >>', array(), null, array('class' => 'disabled')); ?>
        </div>
                </div>
            </div>
        </div>
    </div>
</div>