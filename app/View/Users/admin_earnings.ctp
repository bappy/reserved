<?php
echo $this->Html->script(array("ui/jquery.ui.core", "ui/jquery.ui.widget",'ui/jquery.ui.datepicker'));
echo $this->Html->css(array("http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css"));
?>
<script src="<?php echo $this->webroot; ?>js/highcharts.js"></script>
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
             {'x':Date.UTC(<?php echo $date[0];?>, <?php echo (int)($date[1]-1)?>, <?php echo (int)$date[2]; ?>), 'y':<?php echo ($rows['Order']['price']); ?>} <?php  if($i!=$count) { echo ","; } ?>
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
                    $price.= ($rows['Order']['price']).",";
                }
         ?>
            $(function() {
                $('#container').highcharts({
                    title: {
                        text: 'User paymentss',
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
        <div class="page-title">
            <h4>Master CMS<br> <?php //echo $promoter_code; ?></h4>
        </div>

        <div class="left-containr">
            <div id="side-tab-menu" class="tab-pane active">
                <!-- Primary Navigation -->               
                <nav id="primary-nav">
                    <ul>
                        <li>
                            <a class="<?php echo ( (!empty($active)) && $active =='by_day' && $this->request->action == 'earnings') ? 'active' : ''; ?>" href="<?php echo $this->Html->url(array('controller' => 'Users', 'action' => 'earnings'.'/by-day/'.date('Y-m-d'))); ?>"><i class="glyphicon-notes"></i>Today</a>
                        </li>
                        <li>
                            <a class="<?php echo ( (!empty($active))  && $active =='by_week' && $this->request->action == 'earnings') ? 'active' : ''; ?>" href="<?php echo $this->Html->url(array('controller' => 'Users', 'action' => 'earnings'.'/by-week/'.date('W/Y'))); ?>"><i class="glyphicon-table"></i>This week</a>
                        </li>
                        <li>
                            <a class="<?php echo ((!empty($active)) && $active =='by_month' && $this->request->action == 'earnings') ? 'active' : ''; ?>" href="<?php echo $this->Html->url(array('controller' => 'Users', 'action' => 'earnings'.'/by-month/'.date('Y-m-d'))); ?>"><i class="glyphicon-calendar"></i>This month</a>
                        </li>
                    </ul>
                </nav>
                <!-- END Primary Navigation -->

                <h3><?php echo $data['User']['name'];?></h3>
                <p><?php echo $data['UserInfo']['city']; if ($data['UserInfo']['state'] !="" ) echo ",".$data['UserInfo']['state'];?>
                    <br /><?php echo $data['User']['phone_number'];?>
                    <br /><a href="mailto:<?php echo $data['User']['email_address'];?>"><?php echo $data['User']['email_address'];?></a>
                </p>


            </div>
        </div>
    </div>
    <div id="page-content-right" class="eqHight">
        <?php echo $this->element("admin_user_top", array("user_id", $user_id)); ?>
        <div class="page-title">
            <h2>Earnings</h2>            
			</div>
        <div class="right-containr">
            <div class="rignt-contain-all">
                <div class="row-fluid">
                    <div class="block block-last">
                        <div class="row-fluid">
                            <?php echo $this->Form->create('User',array('url' => array('controller' => 'Users', 'action' => 'earnings','by-day'),'id' => 'graph_data','class'=>"form-inline")); ?>
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
                            <a href="<?php echo $this->Html->url(array('controller' => 'Users', 'action' => 'earnings'.$prev)); ?>" class="" style="float:left;margin-right:10px;"><i class="icon-chevron-left"></i></a>    
                            <?php echo $this->Form->input('from', array('type' => 'text', 'required' => false, 'label' => false, 'id' => 'datepicker', 'class' => 'input-small', 'div' => false)); ?>
                            <a href="<?php echo $this->Html->url(array('controller' => 'Users', 'action' => 'earnings'.$next)); ?>"style="float:left;margin:0 10px;"><i class="icon-chevron-right"></i></a>
                            <?php //echo $this->Form->submit('Search',array('name' => 'search', 'title' => 'Search', 'class' => 'btn')); ?>
                            <button type="submit" class="btn">Search</button>
                            <?php echo $this->Form->end(); ?></form>
                        </div>
                        <div class="row-fluid">
                            <div class="span12">
                                <div id="container" style="min-width: 400px; height: auto; margin: 0 auto"></div>
                            </div>
                        </div>
                        <div class="" style="clear:both;">&nbsp;</div>

                        <div class="clear">&nbsp;</div>
                        <div class="row-fluid">
                            <div class="span12" id="dvData" style="overflow-y: auto; height:350px;">
                                <table class="table table-bordered table-hover">
                                    <tbody>
                                           <?php foreach ($details as $row) { 
											   
											 foreach($output as $orders){
												 if($orders['Order']['order_date'] == $row['Order']['order_date'])
													$price = $orders['Order']['price'];
												}  
											 ?>
                                        <tr style="background-color:#E2E4E5">
                                            <td><b><?php echo date("l M. jS", strtotime($row['Order']['order_date'])); ?></b></td>
                                            <td><b>Sales</b></td>
                                            <td><b><?php echo $this->Number->currency($price, "USD");?></b></td>
                                        </tr>
                                        <?php 
                                        $items = "";
                                        $price1 = 0;
                                        foreach ($row['OrderItem'] as $item){
                                            if(isset($item['ClubBottle']['bottle_name']))
                                            $items.= $item['quantity']." ".$item['ClubBottle']['bottle_name'].", ";
                                            $price1+= ($item['OrderItem'][0]['totalprice']);
                                        }	                                        
                                        ?>								
                                        <tr>
                                            <td><?php  echo $row['Club']['club_name'];  ?><br>
                                            <?php  if(isset($row['UserP']['Promoter_code']))
                                                echo "(".$row['UserP']['Promoter_code'].")";
                                                else
                                                    echo"(none)";
                                            ?>
                                            </td>
                                            <td><?php echo trim($items,", ");?></td>
                                            <td>$<?php echo $price1;?></td>
                                        </tr>
					<?php } ?>
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