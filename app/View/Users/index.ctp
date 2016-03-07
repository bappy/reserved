<div class="row-fluid">
    <?php
    echo $this->element("sidebar", array("club_name" => "$club_name"));
    ?>
    <div id="page-content-right" class="eqHight">
        <?php echo $this->element("top"); ?>
        <div class="page-title">
            <h2>All Users</h2>
            <a class="btn pull-right adNewAccountBtn" href="<?php echo $this->Html->url(array('controller' => 'UserRoles', 'action' => 'add')); ?>"><i class="halflingicon-plus"></i></a>
        </div>
        <div class="right-containr">
            <div class="rignt-contain-all">
                <div class="row-fluid">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                            <tr>
                                <th>Name &amp; Title</th>
                                <th>Email</th>
                                <th>Permission</th>
                                <th>Edit</th>
                            </tr>
                        </thead>
                        </tr>
                        </thead>
                        <tbody>

                            <?php
                            foreach ($users as $user) {
                                ?>
                                <tr>

                                    <td><?php echo $user['User']['first_name'] . ' ' . $user['User']['last_name'];
                            ; ?>&nbsp;</td>
                                    <td><?php echo $user['User']['email_address']; ?>&nbsp;</td>


                                    <td>
                                        <?php
                                        $name = '';
                                        $permission = $this->requestAction('/UserRoles/userpermission/' . $user['User']['id']);
                                        
                                        $flag = 0;
                                        foreach ($permission as $perm) {
                                            if ($perm['UserRole']['name'] == "*") {
                                                $name = "Super Admin";
                                                echo $name;
                                                $flag = 1;
                                                break;
                                            }
                                            $name.= $perm['UserRole']['name'] . ', ';
                                        }
                                        if ($flag == 0)
                                            echo rtrim($name,', ');
                                        ?>
                                    </td>

                                    <td>
                                        <?php
                                        echo $this->Html->link(__('Edit'), array('action' => 'edit', $user['User']['id']));
                                    }
                                    ?>
                                </td>

                            </tr>
<?php
echo '<h1>' . $this->Session->flash('failue') . '</h1>';
?>
                        </tbody>
                    </table>
                    <p>
<?php
echo $this->Paginator->counter(array(
    'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%')
));
?>	</p>


                </div>
            </div>
        </div>
    </div>
</div>