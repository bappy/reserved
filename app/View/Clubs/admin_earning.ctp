<?php

echo $this->Html->script(array("ui/jquery.ui.core", "ui/jquery.ui.widget",'ui/jquery.ui.datepicker'));
echo $this->Html->css(array("http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css"));
?>
<script src="<?php echo $this->webroot; ?>js/highcharts.js"></script>
<script src="<?php echo $this->webroot; ?>js/excellentexport.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $("#datepicker").datepicker({
            dateFormat: "yy-mm-dd",
        });
        $("#datepicker1").datepicker({
            dateFormat: "yy-mm-dd",
        });
        /*********Get Today Start*********/
        var today = new Date();
        var dd = today.getDate();
        var mm = today.getMonth() + 1; //January is 0!
        var yyyy = today.getFullYear();
        if (dd < 10) {
            dd = '0' + dd
        }
        if (mm < 10) {
            mm = '0' + mm
        }
        var today = yyyy + '-' + mm + '-' + dd;

    });
</script>
<script type="text/javascript">
    $(function() {
        var chart;
        $(document).ready(function() {
<?php if (!empty($data_earnings)) {  ?>


    <?php
            $date="";$price="";
                foreach($data_earnings as $rows){
                    $date.= "'".date("M d,Y",(strtotime($rows['Order']['order_date'])))."',";
                    $price.= ($rows['Order']['price']).",";
                }
         ?>
            $(function() {
                $('#container').highcharts({
                    title: {
                        text: 'Club Earnings',
                        x: -20 //center
                    },
                    xAxis: {
                        categories: [<?php echo trim($date,",");?>],
                    },
                    yAxis: {
                        title: {
                            text: ''
                        },
                        plotLines: [{
                                value: 0,
                                width: 2,
                                color: '#808080'
                            }]
                    },
                    chart: {
                        'zoomType': 'x',
                    },
                    tooltip: {
                        valuePrefix: '$'
                    },
                    'credits': {
                        enabled: false
                    },
                    legend: {
                        enable: false
                    },
                    series: [{
                            name: 'Amount',
                            data: [<?php echo trim($price,",");?>]
                        }]
                });
            });
             <?php } else { ?>
            var msg = "No data found for the graph";
            $('#container').text(msg);
<?php } ?>
        });
    });
</script>
<div class="row-fluid">
    <div id="page-sidebar-left" class="eqHight">
        <div class="topNav">
            <ul class="nav">
                <li><a href="javascript:void(0);">RESERVED</a></li>
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
                <!-- Primary Navigation -->
                <nav id="primary-nav">
                    <ul>                        
                        <li>
                            <a class="<?php echo ( (!empty($active)) && $active =='by_day' && $this->request->action == 'earning') ? 'active' : ''; ?>" href="<?php echo $this->Html->url(array('controller' => 'Clubs', 'action' => 'earning'.'/by-day/'.date('Y-m-d'))); ?>"><i class="glyphicon-notes"></i>Today</a>
                        </li>
                        <li>
                            <a class="<?php echo ( (!empty($active))  && $active =='by_week' && $this->request->action == 'earning') ? 'active' : ''; ?>" href="<?php echo $this->Html->url(array('controller' => 'Clubs', 'action' => 'earning'.'/by-week/'.date('W/Y'))); ?>"><i class="glyphicon-table"></i>This week</a>
                        </li>
                        <li>
                            <a class="<?php echo ((!empty($active)) && $active =='by_month' && $this->request->action == 'earning') ? 'active' : ''; ?>" href="<?php echo $this->Html->url(array('controller' => 'Clubs', 'action' => 'earning'.'/by-month/'.date('Y-m-d'))); ?>"><i class="glyphicon-calendar"></i>This month</a>
                        </li>
                    </ul>
                    <?php //echo $this->element("sidebar_master_cms", array('club_lists' => $club_lists)); ?>
                </nav>
                <!-- END Primary Navigation -->
            </div>
        </div>
    </div>
    <div id="page-content-right" class="eqHight">
        <?php echo $this->element("admin_top"); ?>
        <div class="page-title">
            <h2>Earnings</h2>            
        </div>
        <div class="right-containr">
            <div class="rignt-contain-all">
                <?php if ($no_club != "Yes"){ ?>
                <div class="row-fluid">
                    <div class="block block-last">
                        <div class="row-fluid">                           
                            <?php echo $this->Form->create('Club',array('url' => array('controller' => 'Clubs', 'action' => 'earning','by-day'),'id' => 'graph_data','class'=>"form-inline")); ?>

                            <?php 
                            
                            if(isset($active) && $active == 'by_month'){
                                if(isset($param_date))
                                    $date = $param_date;
                                else
                                    $date = date("Y-m-d");
                                
                                $d = new DateTime($date); 
                                $d2 = new DateTime($date); 
                                $d->modify('first day of previous month');
                                $prev = '/by-month/'.$d->format('Y-m-d'); 

                                $d2->modify('first day of next month');                            
                                $next = '/by-month/'.$d2->format('Y-m-d');
                            }else if($active == 'by_week'){
                                $prev = '/by-week/'.date("W/Y", strtotime($param_date[2] . 'W' . str_pad($param_date[1], 2, 0, STR_PAD_LEFT) . ' -1 week'));
                                $next = '/by-week/'.date("W/Y", strtotime($param_date[2] . 'W' . str_pad($param_date[1], 2, 0, STR_PAD_LEFT) . ' +1 week'));        
                            }else{
                                if(isset($param_date))
                                    $date = $param_date;
                                else
                                    $date = date("Y-m-d");
                                
                                $d = new DateTime($date); 
                                $d2 = new DateTime($date); 
                                $d->modify('previous day');
                                $prev = '/by-day/'.$d->format('Y-m-d'); 

                                $d2->modify('next day');                            
                                $next = '/by-day/'.$d2->format('Y-m-d');
                                
                            }
                            ?>
                            <a href="<?php echo $this->Html->url(array('controller' => 'Clubs', 'action' => 'earning'.$prev)); ?>" class="" style="float:left;margin-right:10px;"><i class="icon-chevron-left"></i></a>    
                            <?php echo $this->Form->input('from', array('type' => 'text', 'required' => false, 'label' => false, 'id' => 'datepicker', 'class' => 'input-small', 'div' => false)); ?>
                            <a href="<?php echo $this->Html->url(array('controller' => 'Clubs', 'action' => 'earning'.$next)); ?>"style="float:left;margin:0 10px;"><i class="icon-chevron-right"></i></a>

                            <button type="submit" class="btn">Search</button>&nbsp;<a href="javascript:void(0);" class="export">Spreed Sheet</a>
                            <?php echo $this->Form->end(); ?></form>

                        </div>
                    </div>

                </div>
                <div class="row-fluid">
                    <div class="span12">
                        <div id="container" style="min-width: 400px; height: auto; margin: 0 auto"></div>
                    </div>
                </div>           

                <div class="row-fluid">
                    <div class="span12">
                        <div class="row-fluid" id="dvData">
                            <div class="responsive">
                                <table id="datatable" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Sales</th>
                                            <th>Tax</th>
                                            <th>Gratuity</th>
                                            <th>Total Collected</th>
                                            <th>Reserved Fee</th>
                                            <th>Net Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                            <?php if (!empty($data_earnings)): ?>
                                <?php 
                                $sales = 0;
                                $tax = 0;
                                $gratuity = 0;
                                $t_collected = 0;
                                $reserved_fee = 0;
                                $net_total = 0;
                                foreach ($data_earnings as $tempData):
                                    $price = $tempData['Order']['price'];
                                    $sales += $price;
                                    $tax += ($price*8)/100;
                                    $gratuity += ($price*20)/100;
                                    $t_collected=$sales+$tax+$gratuity;
                                    $reserved_fee = ($t_collected*10)/100;
                                    $net_total = $t_collected-$reserved_fee;
                                ?>
                                <?php endforeach; ?>
                                        <tr>
                                            <td><?php echo "$ ".$sales; ?></td>
                                            <td><?php echo "$ ".$tax; ?></td>
                                            <td><?php echo "$ ".$gratuity; ?></td>
                                            <td><?php echo "$ ".$t_collected; ?></td>
                                            <td><?php echo "$ ".$reserved_fee; ?></td>
                                            <td><?php echo "$ ".$net_total; ?></td>
                                        </tr>

                            <?php else: ?>
                                        <tr>
                                            <td colspan="6" style="text-align:center;">No data Found.</td>
                                        </tr>
                            <?php endif; ?>

                <?php if(!empty($netTotalUp)) : ?>
                                        <tr>
                                            <td colspan="6"></td>
                                        </tr>
                                        <tr style="background-color: #ededed">
                                            <td colspan="2"><?php echo date("l M. jS", strtotime($netTotalUp[0]['Order']['order_date'])); ?></td>
                                            <td colspan="2">Sales</td>
                                            <td colspan="2">$<?php echo $netTotalUp[0]['Order']['price']; ?></td>
                                        </tr>
                            <?php foreach ($userDataUp as $upRow) {
                                $items1 = "";
                                $price1 =0;
                                    foreach ($upRow['OrderItem'] as $item){
                                            $items1.= $item['ClubBottle']['bottle_name'].", ";                                            
                                            $price1+= ($item['quantity']*$item['price']);
                                        }
                                ?>
                                        <tr>
                                            <td colspan="2"><?php if($upRow['User']['name'] == "") { echo "Unknown"; } else { echo $upRow['User']['name']; } ?></td>
                                            <td colspan="2"><?php echo trim($items1,", ");?></td>
                                            <td colspan="2">$<?php echo $price1;?></td>
                                        </tr>
                            <?php } ?>
                            <?php if(!empty($netTotalDown)) { ?>
                                        <tr style="background-color: #ededed">
                                            <td colspan="2"><?php echo date("D, M j, Y", strtotime($netTotalDown[0]['Order']['order_date'])); ?></td>
                                            <td colspan="2">Sales</td>
                                            <td colspan="2">$<?php echo $netTotalDown[0]['Order']['price']; ?></td>
                                        </tr>
                            <?php } ?>
                            <?php if(isset($userDataDown))
                            {
                                foreach ($userDataDown as $downRow) {
                                 $items2 = "";
                                 $price2 =0;
                                    foreach ($downRow['OrderItem'] as $item){
                                            $items2.= $item['ClubBottle']['bottle_name'].", ";                                            
                                            $price2+= ($item['quantity']*$item['price']);
                                        }
                                ?>
                                        <tr>
                                            <td colspan="2"><?php if($downRow['User']['name'] == "") { echo "Unknown"; } else { echo $downRow['User']['name']; } ?></td>
                                            <td colspan="2"><?php echo trim($items2,", ");?></td>
                                            <td colspan="2">$<?php echo $price2;?></td>
                                        </tr>
                            <?php }
                            }
                            ?>

                <?php endif; ?>
                                    </tbody>
                                </table>
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