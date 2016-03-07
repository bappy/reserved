<style type="text/css"> 
  input[type="checkbox"] {
    /* Double-sized Checkboxes */
    transform: scale(2);         /* FF 16+, IE 10+ */
    -webkit-transform: scale(2); /* Chrome, Safari 3.5+, Opera 15+ */

    -ms-transform: scale(2);     /* legacy: IE 9+ */
    -moz-transform: scale(2);    /* legacy: FF 3.5+ */
    -o-transform: scale(2);      /* legacy: Opera 10.5 */
margin:4px 0 0 20px;
  }
</style>
<script type="text/javascript">
$(document).ready(function(){
    
  
 $(":checkbox").change(function(){
        var tableid = $(this).attr("table_id");
        var id = $(this).val();
       if($(this).is(':checked'))
        {            
            getFulfilled(this, id, tableid, 1)
        }
        else
        {
            getFulfilled(this, id, tableid, 0)
        }         
    });
});



   


function getFulfilled(e, id, table_id, status)
{
    var answer = confirm('Are you sure "table '+table_id+' Order" has been fulfilled?');
    if (answer)
    {
    if(status == 1)
        var bgcolor = "#ddd";
    else
        var bgcolor = "";

    $.ajax({
        type: "POST",
        url: "<?php echo $this->Html->url(array('controller' => 'Orders', 'action' => 'fulfilled')); ?>",
        data: {
            id:id,
            status:status
        }
    }).done(function( msg ) {
       
        $(e).parent().parent().css("background-color",bgcolor);
        
        alert(msg);
        //window.location.reload();
    });
}else{   }
}

function cancel(id, table_id)
{
    var answer = confirm("Are you sure you want to Cancel Table "+table_id+" Order?");
    if (answer)
    {
    $.ajax({
        type: "POST",
        url: "<?php echo $this->Html->url(array('controller' => 'Orders', 'action' => 'cancel')); ?>",
        data: {
            id:id
        }
    }).done(function( msg ) {
       alert(msg);
       window.location.reload();
    });
}
}
</script>
<div class="row-fluid">
    <div id="page-sidebar-left" class="eqHight">
        <div class="topNav">
            <ul class="nav">
                <li><a href="#">Hooray Henry's</a></li>
            </ul>
            <div class="clear">&nbsp;</div>
        </div>
        <div class="page-title">
            <h2>
                <?php
                /*if (isset($club_name) && !empty($club_name)):
                    echo $club_name;
                endif;
        */
                ?>
            </h2>
        </div>
        <div class="left-containr"></div>
    </div>
    <div id="page-content-right" class="eqHight">
        <?php echo $this->element("top"); ?>
        <div class="page-title">
            <h2>All Orders <small><?php echo $this->Paginator->sort('order_time', 'By Time', array('escape' => false , 'class' => 'order_sort')); ?> </small><small><?php echo $this->Paginator->sort('club_table_id', 'By Table', array('escape' => false , 'class' => 'order_sort')); ?></small></h2>
        </div>
        <div class="right-containr">
            <div class="rignt-contain-all">
                <div class="row-fluid">
<div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>TIME</th>
                                <th>TABLE</th>
                                <th>NAME</th>
                                <th>ORDER</th>
                                <th>CANCEL?</th>
                                <th>CAREGORY</th>
                                <th>PRICE</th>                                
                                <th>FULFILLED</th>
                            </tr>                            
                        </thead>
                        <tbody>
                            <?php if (!empty($bookings)): ?>
                                <?php foreach ($bookings as $booking): 
                                    if($booking['Order']['status']=="completed")
                                    {
                                        $color = "background-color:#ddd";
                                    }
                                    else
                                    { $color = ""; }
                                    $items = ""; 
                                    $category = "";
                                    $price = 0;

                                    if(isset($booking['OrderItem']) && count($booking['OrderItem']) > 0)    
                                    {
                                        foreach ($booking['OrderItem'] as $item){										
                                           if(isset($item['ClubBottle']['bottle_name'])){
                                            $items.= $item['ClubBottle']['bottle_name'].", ";
                                            }
                                            if(isset($item['ClubBottle']['Category']['category_name']))
                                            $category.= $item['ClubBottle']['Category']['category_name'].", ";
                                            $price+= ($item['quantity']*$item['price']);    
                                        }
                                    }
                                    ?>
                                    <tr style="<?php echo $color; ?>">
                                        <td><?php echo date("H:i",strtotime($booking['Order']['order_time'])); ?></td>
                                        <td><?php echo $booking['Order']['club_table_id']; ?></td>
                                        <td><?php echo $booking['User']['name']; ?></td>
                                        <td><?php echo trim($items,", ");?></td>
                                        <td><a href="javascript:void(0);" class="cancel" Onclick="cancel(<?php echo $booking['Order']['id'].", ".$booking['Order']['club_table_id']; ?>);"><i style="color:red" class="icon-remove icon-red red"></i></a></td>
                                        <td><?php echo trim($category,", ");?></td>
                                        <td><?php echo "$".$price; ?></td>
                                        <td>
                                            <?php if($booking['Order']['status']!="fulfilled") { ?>
                                                <!--Onclick="getFulfilled(<?php echo $booking['Order']['id'].", ".$booking['Order']['club_table_id']; ?>);"-->
                                                <input type="checkbox" id="create-switch<?php echo $booking['Order']['id'];?>" class="getFulfilled" value="<?php echo $booking['Order']['id'];?>" table_id="<?php echo$booking['Order']['club_table_id'];?>">
                                         <?php } else { ?>
                                                <input type="checkbox" checked="checked" id="create-switch<?php echo $booking['Order']['id'];?>">
                                                <input type="checkbox" id="create-switch<?php echo $booking['Order']['id'];?>" class="getFulfilled" value="<?php echo $booking['Order']['id'];?>" table_id="<?php echo$booking['Order']['club_table_id'];?>">
                                         <?php } ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="8">No Order Found.</td>
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
            |   <?php echo $this->Paginator->numbers(); ?>
            |
            <?php echo $this->Paginator->next(__('next') . ' >>', array(), null, array('class' => 'disabled')); ?>
        </div>
                </div>
            </div>
        </div>
    </div>
</div>