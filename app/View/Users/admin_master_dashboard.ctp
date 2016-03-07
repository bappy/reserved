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
            <h2>User dashboard</h2>
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
                                        <th>Top Users</th>
                                        <th>Last Reserved</th>
                                        <th>Venues Visited</th>
                                        <th>Promoter</th>
                                        <th>Phone#</th>
                                        <th>Email</th>
                                        <th><?php echo $this->Number->currency($total_comission[0][0]['totalprice'], "USD");?></th>
                                    </tr>                            
                                </thead>
                                <tbody>
                            <?php  if (!empty($users)): ?>
                                <?php foreach ($users as $row):                                   
                                    $items = ""; 
                                    $category = "";                                   
                                    $promoter = "";
                                    $last_visited = "";
                                    if(isset($row['UserVenue']) && count($row['UserVenue']) > 0)    
                                    {
                                        $last_visited = date("m/d/Y",strtotime($row['UserVenue'][0]['Order']['order_date']));
                                        foreach ($row['UserVenue'] as $item){
                                            $items.= $item['Club']['club_name'].", ";                                        
                                        
                                            if(isset($item['UserP']['first_name'])){
                                                $promoter.= $item['UserP']['first_name']." ".$item['UserP']['last_name'].", ";
                                            }
                                        }
                                    }
                                    

                                    ?>
                                    
                                    <tr>
                                        <td>
                                            <a  target="_blank" href="<?php echo $this->Html->url(array('controller' => 'Users', 'action' => 'set_users', $row['UserInfo']['User']['id'])); ?>">
                                            <?php echo $row['UserInfo']['User']['first_name']." ".$row['UserInfo']['User']['first_name']; ?>
                                            </a>
                                        </td>
                                        <td><?php echo $last_visited; ?></td>
                                        <td><?php echo trim($items,", "); ?></td>                                        
                                        <td><?php if($promoter == "") echo "none"; else echo trim($promoter,", ");?></td>                                        
                                        <td><?php echo $row['UserInfo']['UserInfo']['phone_no'];?></td>                                        
                                        <td><?php echo $row['UserInfo']['User']['email_address'];?></td>                                        
                                        <td><?php echo $this->Number->currency($row['UserComission'][0][0]['totalprice'], "USD"); ?></td>                                        
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                    <tr>
                                        <td colspan="6">No Users Found.</td>
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