<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
echo $this->Html->script(array("ui/jquery.ui.core", "ui/jquery.ui.widget",'ui/jquery.ui.datepicker'));
echo $this->Html->css(array("http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css"));
//$date1 = date('Y-m-1', strtotime($firstDay));
//$date2 = date("Y-m-t", strtotime($lastDay));
//$first = explode('-', $date1);
//$last = explode('-', $date2);
?>
<script src="<?php echo $this->webroot; ?>js/highcharts.js"></script>
<!--<script src="<?php echo $this->webroot; ?>js/exporting.js"></script>-->
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
        /*********Get Today end*********/
        function exportTableToCSV($table, filename) {

            var $rows = $table.find('tr:has(th,td)'),
                    // Temporary delimiter characters unlikely to be typed by keyboard
                    // This is to avoid accidentally splitting the actual contents
                    tmpColDelim = String.fromCharCode(11), // vertical tab character
                    tmpRowDelim = String.fromCharCode(0), // null character

                    // actual delimiter characters for CSV format
                    colDelim = '","',
                    rowDelim = '"\r\n"',
                    // Grab text from table into CSV formatted string
                    csv = '"' + $rows.map(function(i, row) {
                        var $row = $(row),
                                $cols = $row.find('th,td');

                        return $cols.map(function(j, col) {
                            var $col = $(col),
                                    text = $col.text();

                            return text.replace('"', '""'); // escape double quotes

                        }).get().join(tmpColDelim);

                    }).get().join(tmpRowDelim)
                    .split(tmpRowDelim).join(rowDelim)
                    .split(tmpColDelim).join(colDelim) + '"',
                    // Data URI
                    csvData = 'data:application/csv;charset=utf-8,' + encodeURIComponent(csv);

            $(this)
                    .attr({
                        'download': filename,
                        'href': csvData,
                        'target': '_blank'
                    });
        }

        // This must be a hyperlink
        $(".export").on('click', function(event) {
            // CSV
            var fileName = 'SpreedSheet_' + today + '.csv';
            exportTableToCSV.apply(this, [$('#dvData>table'), fileName]);

            // IF CSV, don't do event.preventDefault() or return false
            // We actually need this to be a typical hyperlink
        });
    });
</script>
<script type="text/javascript">
    $(function() {
        var chart;
        $(document).ready(function() {
<?php if (!empty($data_earnings)) { ?>
            /*var chart = new Highcharts.Chart({
             'chart':{
             'renderTo':'container',
             'type':'spline',
             'zoomType':'x',
             'backgroundColor': '#FCFFC5',
             },
             'tooltip': 
             {
             valuePrefix: ' $',
             },
             
             'credits': {
             enabled: false
             },
             'exporting':{'enabled':true},
             'title':{'text':''},
             'xAxis': {
             type: "datetime",
             dateTimeLabelFormats: {
             day: '%b %d, %Y',
             year: '%Y'
             },
             tickInterval: 24 * 3600 * 1000 * 7,
             min: Date.UTC(<?php echo $first[0]; ?>, <?php echo ($first[1]-1); ?>, <?php echo $first[2]; ?>),
             max: Date.UTC(<?php echo $last[0]; ?>, <?php echo ($last[1]-1); ?>, <?php echo $last[2]; ?>)
             },
             'yAxis':{'title':{'text':''}, 'min':0},
             'series':[{showInLegend: false, name: 'Amount', 'data':[
             
             <?php
                $count = count($data_earnings);
                $i=1;
                foreach($data_earnings as $rows):
                     $date = explode('-',$rows['Order']['order_date']);
                  
                ?>
             {'x':Date.UTC(<?php echo $date[0];?>, <?php echo (int)($date[1]-1)?>, <?php echo (int)$date[2]; ?>), 'y':<?php echo ($rows['Order']['price']*($settings['Setting']['value']/100)); ?>} <?php  if($i!=$count) { echo ","; } ?>
             <?php
                $i++;
                endforeach;
                ?>                       
             ]
             }]});*/
            <?php
            $date="";$price="";
                foreach($data_earnings as $rows){
                    $date.= "'".date("M d,Y",(strtotime($rows['Order']['order_date'])))."',";
                    $price.= ($rows['Order']['price']*($settings['Setting']['value']/100)).",";
                }
         ?>
            $(function() {
                $('#container').highcharts({
                    title: {
                        text: 'Promoter Earnings',
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

<script type="text/javascript">
    $(function() {
    <?php if (!empty($data_earnings)) { ?>
        Highcharts.setOptions({
            global: {
                useUTC: false
            }});
        $('#container1').highcharts({
            chart: {
                type: 'bar',
            },
            title: {
                text: ''
            },
            subtitle: {
                text: ''
            },
            xAxis: {
                categories:
                        [
                           <?php
                            $count = count($data_earnings);
                            $i=1;
                            foreach($data_earnings as $rows):
                                $date = date("d-F-y", strtotime($rows['Order']['order_date']));
                                $date = explode('-',$date);
                                $month = substr($date[1],0,3);
                                $date = $date[0].'-'.$month.'-'.$date[2];
                                $date = '"'.$date.'"';
                                echo $date;if($i!=$count) { echo ","; }
                                $i++;
                            endforeach; 
                            ?>
                        ],
                title: {
                    text: null
                }
            },
            yAxis: {
                min: null,
                title: {
                    text: '',
                    align: 'high'
                },
                labels:
                        {
                            enabled: false
                        }

            },
            tooltip: {
                valuePrefix: ' $',
            },
            plotOptions: {
                bar: {
                    dataLabels: {
                        enabled: true
                    },
                    pointWidth: 15,
                }
            },
            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'top',
                x: -40,
                y: 100,
                floating: true,
                borderWidth: 0,
                backgroundColor: (Highcharts.theme && Highcharts.theme.legendBackgroundColor || '#FFFFFF'), shadow: false
            },
            credits: {
                enabled: false
            },
            series: [{
                    showInLegend: false,
                    data: [
                    <?php
                $count = count($data_earnings);
                $i=1;
                foreach($data_earnings as $rows):                    
                    echo number_format(($rows['Order']['price']*($settings['Setting']['value']/100)),2,'.',''); if($i!=$count) { echo ","; } 
                $i++;
                endforeach;
                ?>
                    ]
                }]
        });
   <?php } else { ?>
        var msg = "No data found for the graph";
        $('#container1').text(msg);
<?php } ?>
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
			
        ?>

        <div class="page-title">
            <h4>Your Promoter Code <br> <?php echo $data[0]['User']['promoter_code']; ?></h4>
        </div>

        <div class="left-containr">
            <div id="side-tab-menu" class="tab-pane active">
                <!-- Primary Navigation -->               
                <nav id="primary-nav">
                    <ul>
                        <li>
                            <a class="<?php echo ( (!empty($active)) && $active =='by_day' && $this->request->action == 'earnings') ? 'active' : ''; ?>" href="<?php echo $this->Html->url(array('controller' => 'Promoters', 'action' => 'earnings'.'/by-day/'.date('Y-m-d'))); ?>"><i class="glyphicon-notes"></i>Today</a>
                        </li>
                        <li>
                            <a class="<?php echo ( (!empty($active))  && $active =='by_week' && $this->request->action == 'earnings') ? 'active' : ''; ?>" href="<?php echo $this->Html->url(array('controller' => 'Promoters', 'action' => 'earnings'.'/by-week/'.date('W/Y'))); ?>"><i class="glyphicon-table"></i>This week</a>
                        </li>
                        <li>
                            <a class="<?php echo ((!empty($active)) && $active =='by_month' && $this->request->action == 'earnings') ? 'active' : ''; ?>" href="<?php echo $this->Html->url(array('controller' => 'Promoters', 'action' => 'earnings'.'/by-month/'.date('Y-m-d'))); ?>"><i class="glyphicon-calendar"></i>This month</a>
                        </li>
                    </ul>
                </nav>
                <!-- END Primary Navigation -->
            </div>
        </div>
    </div>
    <div id="page-content-right" class="eqHight">
        <?php echo $this->element("top"); ?>
        <div class="page-title">
            <h2>Earnings</h2>
            <!--<a class="btn pull-right adNewAccountBtn" href="<?php echo $this->Html->url(array('controller' => 'Reservations', 'action' => 'reservation')); ?>"><i class="halflingicon-plus"></i></a>-->
        </div>
        <div class="right-containr">
            <div class="rignt-contain-all">
                <div class="row-fluid">
                    <div class="block block-last">
                        <div class="row-fluid">
                            <?php echo $this->Form->create('Promoter',array('url' => array('controller' => 'Promoters', 'action' => 'earnings','by-day'),'id' => 'graph_data','class'=>"form-inline")); ?>
                            <!--                            <div class="span8">
                                                            <div class="form-group">                                    
                                                                <div class="controls">
                                                                    <div class="span9 input-append date input-datepicker">
                                                  <?php echo $this->Form->input('from', array('type' => 'text', 'required' => false, 'label' => false, 'id' => 'datepicker', 'class' => 'input-medium', 'div' => false)); ?>
                                                                        -<?php echo $this->Form->input('to', array('type' => 'text', 'required' => false, 'label' => false, 'id' => 'datepicker1', 'class' => 'input-medium', 'div' => false)); ?>                                                        
                                                  <?php echo $this->Form->submit('Search',array('name' => 'search', 'title' => 'Search', 'class' => 'btn')); ?>
                             
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>-->
                            <?php 
                            if($active == 'by_month'){
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
                            }
                            
                            elseif($active == 'by_week'){
                                $prev = '/by-week/'.date("W/Y", strtotime($param_date[2] . 'W' . str_pad($param_date[1], 2, 0, STR_PAD_LEFT) . ' -1 week'));
                                $next = '/by-week/'.date("W/Y", strtotime($param_date[2] . 'W' . str_pad($param_date[1], 2, 0, STR_PAD_LEFT) . ' +1 week'));        
                            }
                            else{
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
                            <a href="<?php echo $this->Html->url(array('controller' => 'Promoters', 'action' => 'earnings'.$prev)); ?>" class="" style="float:left;margin-right:10px;"><i class="icon-chevron-left"></i></a>    
                            <?php echo $this->Form->input('from', array('type' => 'text', 'required' => false, 'label' => false, 'id' => 'datepicker', 'class' => 'input-small', 'div' => false)); ?>
                            <a href="<?php echo $this->Html->url(array('controller' => 'Promoters', 'action' => 'earnings'.$next)); ?>"style="float:left;margin:0 10px;"><i class="icon-chevron-right"></i></a>
                            <?php //echo $this->Form->submit('Search',array('name' => 'search', 'title' => 'Search', 'class' => 'btn')); ?>
                            <button type="submit" class="btn">Search</button>
                            <?php echo $this->Form->end(); ?></form>
                        </div>
                        <div class="row-fluid">
                            <div class="span12">
                                <div id="container" style="min-width: 400px; height: auto; margin: 0 auto"></div>
                            </div>
                        </div>
                        <div class="row-fluid">
                            <div class="span6">
                                <h2> Daily Snapshot </h2>
                                <div id="container1" style="min-width: 400px; height: auto; margin: 0 auto"></div>
                            </div>
                            <div class="span6">
                                <h2>Weekly Snapshot </h2>
                                <table class="table table-bordered table-hover">
                                    <thead>                                           
                                        <tr style="background-color:#E2E4E5">
                                            <th>Week ended</th>
                                            <th><b>Clients</b></th>
                                            <th>Commissions</th>
                                        </tr>
                                    </thead>    
                                    <tbody>
                                        <?php foreach ($weekly_data as $data) { ?>
                                        <tr>
                                            <td><?php echo $data[0]['date'];?></td>
                                            <td><?php echo $data[0]['tclients'];?></td>
                                            <td>$<?php echo $data[0]['commissions'];?></td>                                            
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row-fluid">
                            <div class="span12" id="dvData" style="overflow-y: auto; height:200px;">
                                <table class="table table-bordered table-hover">
                                    <tbody>
                                           <?php foreach ($output as $upRow) {
										 // pr($upRow['order_items']);
                                ?>
                                        <tr style="background-color:#E2E4E5">
                                            <td><b><?php echo date("l M. jS", strtotime($upRow['Order']['order_date'])); ?></b></td>
                                            <td><b>Action</b></td>
                                            <td><b>$<?php echo ($upRow['Order']['price']*($settings['Setting']['value']/100));?></b></td>
                                        </tr>
								<?php 
								$items1 = "";
                                
                                                                foreach ($upRow['order_items'] as $item){                                            
									$price1 = 0;
									foreach($item['OrderItem'] as $price){
                                                                            $price1+= ($price['OrderItem'][0]['totalprice']*($settings['Setting']['value']/100));
									}                                        
                                ?>								
                                        <tr>
                                            <td><?php if($item['User']['name'] == "") { echo "Unknown"; } else { echo $item['User']['name']; } ?></td>
                                            <td><?php echo "Had a night out at ".$item['Club']['club_name'];?></td>
                                            <td>$<?php echo $price1;?></td>
                                        </tr>
					<?php } }?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>    
</div>
<?php echo $this->element('sql_dump');?>