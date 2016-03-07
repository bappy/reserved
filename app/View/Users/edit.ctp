<div class="row-fluid">
    <?php
    $club_name = "Club Name";
    echo $this->element("sidebar", array("club_name" => "$club_name"));
    ?>
    <div id="page-content-right" class="eqHight">
        <?php echo $this->element("top"); ?>
        <div class="page-title">
            <h2>Update user</h2>
            <a class="btn pull-right adNewAccountBtn" href="<?php echo $this->Html->url(array('controller' => 'UserRoles', 'action' => 'add')); ?>"><i class="halflingicon-plus"></i></a>
        </div>
        <div class="right-containr">
            <div class="rignt-contain-all">
                <div class="row-fluid">
                    
                    <?php echo $this->Form->create('User'); ?>
                    <div class="span6">
                        <?php
                        echo $this->Form->hidden('id');
                        echo $this->Form->input('first_name');
                        echo $this->Form->input('last_name');
                        echo $this->Form->input('email_address');
                        echo $this->Form->input('phone_number');
                        echo $this->Form->input('job_title_id');
                        ?>
                    </div>
                    <div class="span5">
                        <div class="form-group">
                            <label class="" for="inputUsernameEmail">Access to :</label>
                        </div>
                        <label class="checkbox">
                            <?php
                            $array = array("Clubs", "Users", "UserRoles", "Orders", "Reservations", "MenuandPricing");
                            $hasElement = array();
                            $i = 0;
                            foreach ($UserRoles as $Role) {
                                $hasElement[] = $Role['UserRole']["name"];
                                echo "<p>";
                                echo $Role['UserRole']["name"];

                                echo $this->Form->checkbox('UserRole.' . $i . '.role_id', array('value' => $Role['UserRole']["name"], 'id' => 'create-switch', "checked" => "checked"));
                                $i++;
                            }
                            $result = array_diff($array, $hasElement);

                            foreach ($result as $res) {
                                echo "<p>";
                                echo $res;

                                echo $this->Form->checkbox('UserRole.' . $i . '.role_id', array('value' => $res, 'id' => 'create-switch'));
                                $i++;
                            }
                            ?>
                        </label>
                    </div>
                    <div class="clearfix">&nbsp;</div>
                    <div class="form-group" style="margin-left:520px;">
                        <?php echo $this->Form->end(__('Submit'), array("class" => "btn btn-primary pull-right")); ?>  
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>