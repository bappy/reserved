<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
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
        <?php //echo $this->element("sidebar_master_cms", array('club_lists' => $club_lists)); ?>
    </div>
    <div id="page-content-right" class="eqHight">
        <?php echo $this->element("admin_top"); ?>
        <div class="page-title">
            <h2>Club Night Details</h2>
        </div>
        <div class="right-containr">
            <div class="rignt-contain-all">
                <div class="row-fluid">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Table</th>
                                <th>Status</th>
                                <th>Client Booking</th>
                                <th>Booking Method</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($bookings)): ?>
                                <?php $i=1; foreach ($bookings as $night): ?>
                                    <tr>
                                        <td><strong> # <?php echo $i; ?> &nbsp;&nbsp;&nbsp;<span><?php echo $night['ClubTable']['table_name']; ?></span></strong></td>
                                        <td><?php echo $night['Booking']['status']; ?></td>
                                        <td><?php echo $night['Booking']['client_name']; ?></td>
                                        <td><?php echo $night['Booking']['booking_method']; ?> 
                                            <?php if ($night['Booking']['booking_method'] == 'Manually Added'): ?>
                                                <a href="javascript:void(0)" class="pull-right">Invite client to order through <br>Reserved for the night ?</a>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php echo $this->Html->link(__('Edit'), array('controller' => 'NightDetails', 'action' => 'booking_edit', $night['Booking']['id'])); ?>
                                        </td>
                                    </tr>
                                    <?php
                                    $i++;
                                endforeach;
                            else:
                                ?>
                                <tr>
                                    <td colspan="4">No Clubs Night Details Found.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                    <p>
                        <?php
                        echo $this->Paginator->counter(array(
                            'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%')
                        ));
                        ?>	</p>

                    <div class="paging">
                        <?php echo $this->Paginator->prev('<< ' . __('previous'), array(), null, array('class' => 'disabled')); ?>
                        | 	<?php echo $this->Paginator->numbers(); ?>
                        |
                        <?php echo $this->Paginator->next(__('next') . ' >>', array(), null, array('class' => 'disabled')); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>