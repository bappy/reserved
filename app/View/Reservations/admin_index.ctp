<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<?php //echo $this->Html->css('fullcalendar'); ?>
<?php echo $this->Html->script(array('fullcalendar')); ?>
<script type="text/javascript">

    $(document).ready(function() {

    var date = new Date();
            var d = date.getDate();
            var m = date.getMonth();
            var y = date.getFullYear();
            $('#calendar').fullCalendar({
    header: {
    left: 'prev,next today',
            center: 'title',
            right: 'month,agendaWeek,agendaDay'
    },
            eventRender: function(event, element) {
            element.attr('href', '#myModal');
                    element.attr('data-toggle', 'modal');
                    element.attr('onclick', 'reservation_detail_popup(' + event.id + ');');
            },
            allDaySlot : false,
            defaultView: 'agendaWeek',
            firstDay: 1,
            editable: true,
            islateRender: true,
            selectable: true,
            selectHelper: true,
            events: [
<?php foreach ($reservations as $key_ => $value_): ?>
    <?php
     $bg = "#000";
        $reservation_id = $value_['Booking']['id'];
        if(!empty($value_['Booking']['client_name']))
        {
                $subject = $value_['Booking']['client_name'];
        }
        else
        {
                $subject = $value_['User']['first_name']." ".$value_['User']['last_name'];
        }
        if($value_['Booking']['status']=='pending')
        {
                $bg = "#000";
        }
        if($value_['Booking']['status']=='reserved')
        {
                $bg = "#0072B0";
        }
	
        if($value_['Booking']['status']=='taken')
        {
                $bg = "#999";
        }
  ?>
            {                              id: '<?php echo $reservation_id;?>',
                    title: '<?php echo $subject;?>',
                    start: '<?php echo date("c",strtotime($value_['Booking']['arrival_date'].$value_['Booking']['arrival_time'])); ?>',
                    //end: '" . date('D, d M Y', strtotime($value_['Booking']['arrival_date'])) . " " . $value_['Booking']['arrival_time'] . "',date('c',strtotime($events[$a]['Event']['event_date'])) 

                    allDay : false,
                    //url : 'javascript:void(0);',
                    color: '<?php echo $bg; ?>'
            },
<?php endforeach; ?>
            ]
    });
    });
            function reservation_detail_popup(id){
            $.ajax({
            url:'<?php echo $this->Html->url(array('admin' => true,'controller' => 'Reservations', 'action' => 'reservation_details')) ?>',
                    dataType : 'html',
                    type : 'POST',
                    data : 'id=' + id,
                    success: function(html){
                    $('#detailsContainerPopup').html(html);
                            $('#reservation_detail_Popup').show();
                    }
            });
            }
</script>
<script type="text/javascript">
    $(document).ready(function() {
        $('a#close_reservation_popup').click(function(){
            $('div#reservation_detail_Popup').hide();
        });
    });
            $(document).on('click', '#ajax_accept', function(e) {
    e.preventDefault();
            var answer = confirm("Are you sure?");
            if (answer)
    {
    var id = $(this).attr("exe"); //alert(id);
            var type = $(this).attr("val"); //alert(type);
            $.ajax({
            type: "POST",
                    url: myBaseUrl + "/admin/Reservations/ajaxAccept/",
                    data: {id: id, type:type}
            }).done(function(msg) {
    $("#Redirecting").show();
            setTimeout(function() { $("#Redirecting").hide(); }, 2000);
            if (msg != 'load')
    {
    $('#myModal').modal('hide');
            $(location).attr('href', '<?php echo $this->Form->url('/admin/Reservations') ?>')
    }
    else
    {
    //alert("I am testing");
    $('.show').fadeOut(1000);
            $('.hide').fadeIn(2000);
    }
    });
    }
    else
    {
    return false;
    }

    return false;
    });

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
                if (isset($club_name) && !empty($club_name)) {
                    $club_name = $club_name;
                } else {
                    $club_name = "";
                }
                echo $club_name;
                ?>
            </h2>
        </div>

        <div class="left-containr">
            <div id="side-tab-menu" class="tab-pane active">
                
            </div>

        </div>
    </div>
    <div id="page-content-right" class="eqHight">
        <?php echo $this->element("admin_top"); ?>
        <div class="page-title">
            <h2>Reservations</h2>
            <a class="btn pull-right adNewAccountBtn" href="<?php echo $this->Html->url(array('controller' => 'Reservations', 'action' => 'reservation')); ?>"><i class="halflingicon-plus"></i></a>
        </div>
        <div class="right-containr">
            <div class="rignt-contain-all">
                <div class="row-fluid">
                    <div class="block block-last">
                        <div class="row-fluid">
                            <div class="span12">
                                 <?php if ($no_club != "Yes"){ ?>
                                <div id="calendar" style="width:100%;position:relative;">
                                    <div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="border:none;">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><img src="<?php echo $this->webroot; ?>img/terminate.png"></button>
                                        <div class="modal-body">
                                            <div id="detailsContainerPopup" style="height:250px;margin-left:5px;overflow:auto">


                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php }else{
                    echo "<h1>Please select a venue from left side.</h1>";
                } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


