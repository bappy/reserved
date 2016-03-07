<div class="row-fluid">
    <div id="page-sidebar-left" class="eqHight">
        <div class="topNav">
            <ul class="nav">
                <li><a href="#">RESERVED</a></li>
            </ul>
            <div class="clear">&nbsp;</div>
        </div>
        <div class="page-title">
            <h2> Master CMS</h2>
        </div>
        <div class="left-containr">
            <div id="side-tab-menu" class="tab-pane active">
                <!-- Primary Navigation -->
                <nav id="primary-nav">
                    <ul>
                        <li>
                            <a class="<?php echo (($this->request->controller == 'Users')) ? 'active' : ''; ?>" href="<?php echo $this->Html->url(array('controller' => 'Users', 'action' => 'masterprofile')); ?>"><i class="glyphicon-cogwheels"></i>Profile Setting</a>
                        </li>
                        <li>
                            <a class="<?php echo (($this->request->controller == 'Settings')) ? 'active' : ''; ?>" href="<?php echo $this->Html->url(array('controller' => 'Settings', 'action' => 'index')); ?>"><i class="glyphicon-vcard"></i>Site Settings</a>
                        </li>                    
                    </ul>
                </nav>
                <!-- END Primary Navigation -->

            <?php echo $this->element("sidebar_master_cms", array('club_lists' => $club_lists)); ?>
            </div>
        </div>
    </div>
    
    <div id="page-content-right" class="eqHight">
        <?php if(isset($club_id)) $club_name="master"; else $club_name = "";echo $this->element("admin_top", array("club_name" => $club_name)); ?>
        <div class="page-title">
            <h2>Promoter dashboard</h2>
            <div class="pull-right"></div>
        </div>
        <div class="right-containr">
            <div class="rignt-contain-all">

                <div class="row-fluid">
                    <div class="span12">                        
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Top Promoters</th>
                                        <th>Promotion Venues</th>
                                        <th>Location</th>
                                        <th>Phone#</th>
                                        <th>Email</th>
                                        <th><?php echo $this->Number->currency($total_comission[0][0]['totalprice']*($settings['Setting']['value']/100), "USD");?></th>
                                    </tr>                            
                                </thead>
                                <tbody>
                            <?php if (!empty($promoters)): ?>
                                <?php foreach ($promoters as $row):                                   
                                    $items = ""; 
                                    $category = "";                                   
                                   
                                    if(isset($row['PromoterVenue']) && count($row['PromoterVenue']) > 0)    
                                    {
                                        foreach ($row['PromoterVenue'] as $item){                                            
                                            $items.= $item['Club']['club_name'].", ";                                            
                                        }
                                    }
                                    ?>
                                    
                                    <tr>
                                        <td>
                                            <a target="_blank" href="<?php echo $this->Html->url(array('controller' => 'Promoters', 'action' => 'set_promoters', $row['PromoterInfo']['User']['id'])); ?>">
                                            <?php echo $row['PromoterInfo']['User']['first_name']." ".$row['PromoterInfo']['User']['first_name']; ?>
                                            </a>
                                        </td>
                                        <td><?php echo trim($items,", "); ?></td>
                                        <td><?php echo $row['PromoterInfo']['UserInfo']['state'].", ".$row['PromoterInfo']['UserInfo']['city']; ?></td>
                                        <td><?php echo $row['PromoterInfo']['UserInfo']['phone_no'];?></td>                                        
                                        <td><?php echo $row['PromoterInfo']['User']['email_address'];?></td>
                                        <td><?php echo $this->Number->currency($row['PromoterComission'][0][0]['totalprice']*($settings['Setting']['value']/100), "USD"); ?></td>                                        
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                    <tr>
                                        <td colspan="6">No Promoters Found.</td>
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
</div>
<?php echo $this->element('footer_Club') ?>			