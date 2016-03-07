<?php
echo $this->Html->css(array("http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css", 'http://netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css', 'http://bdmdesign.github.io/bootstrap-switch/static/stylesheets/flat-ui-fonts.css'));
?>
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
        <?php echo $this->element("admin_top"); ?>
        <div class="page-title">
            <h2>Turn Table Into Deals</h2>
            <a class="btn pull-right adNewAccountBtn" href="<?php echo $this->Html->url(array('controller' => 'deals', 'action' => 'make_deal')); ?>"><i class="halflingicon-plus"></i></a>
        </div>
        <div class="right-containr">
            <div class="rignt-contain-all">
                <div class="row-fluid">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Table</th>
                                <th>Status</th>
                                <th>Category</th>
                                <th>Standard Min</th>
                                <th>Deal Price</th>
                                <th>Time</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($clubTables)): ?>
                                <?php 
                                 $i = 1; foreach ($clubTables as $club_table): 
                                  //pr($club_table);
				  $color="";  
                                  //if($club_table['ClubTable']['club_id'] == $club_id ){
                                    if(!empty($club_table['Deal']))
                                    {
                                            if(isset($club_table['Deal']['status']) && $club_table['Deal']['status'] == '0')
                                            {
                                                    $color = "#ededed";
                                            }
                                            else
                                            {
                                                    $color = '#FFF';
                                            }
                                    }
								 
				   ?>
                                    <tr bgcolor="<?php echo $color; ?>">
                                <td><strong> <?php echo $i; ?># &nbsp;&nbsp;&nbsp;<span><?php echo $club_table['ClubTable']['table_name']; ?></span></strong></td>
                                <td>
                                            <?php 
                                            if(isset($club_table['Deal']['status']) && $club_table['Deal']['status']!="")
                                            {
                                                if($club_table['Deal']['status']==1)
                                                {
                                                    echo "ON"; 
                                                }
                                                else
                                                {
                                                   echo "OFF";
                                                }
                                            }
                                            ?>
                                </td>
                                <td><?php echo $club_table['ClubTable']['Category']['category_name']; ?></td>
                                <td><?php echo $club_table['ClubTable']['minimum_price']; ?></td>
                                <td>
                                            <?php
                                            if (isset($club_table['Deal']['deal_price']) && !empty($club_table['Deal']['deal_price'])):
                                                echo $club_table['Deal']['deal_price'];
                                            endif;
                                            ?>
                                </td>
                                <td>
                                    <?php
                                    //if (isset($club_table['Deal']['deal_date']) && !empty($club_table['Deal']['deal_date'])):                          
                                    if($club_table['Deal']['status']=='1' && $club_table['Deal']['deal_date']==date('Y-m-d'))
                                    {
                                        echo "Now";
                                    }
                                    else
                                    {
                                        echo date("D, M j, Y", strtotime($club_table['Deal']['deal_date']));
                                    }
                                    //endif;
                                    ?>
                                </td>
                                <td>
                                    <?php 
                                        echo '<b><font color=green>DEAL!</font></b>'; echo " "."||"." ";
                                        echo $this->Html->link(__('Edit'), array('controller' => 'Deals', 'action' => 'edit', $club_table['Deal']['id']));
                                    ?>
                                </td>
                            </tr>
                                    <?php
                                    $i++;
                                  //}
                                endforeach;
                            else:
                                ?>
                            <tr>
                                <td colspan="4">No Deal's Found!</td>
                            </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>

                    <?php //if (!empty($clubTables)): 
                        /**
                         * Pagination block 
                         */
                    
                        ?>
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

                    <?php //endif;
                     /*
                      * End pagination block 
                      */
                    ?>
                   

                </div>
            </div>
        </div>
    </div>
</div>