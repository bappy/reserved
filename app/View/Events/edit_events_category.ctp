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
        echo $this->element("sidebar-left-night-details-events-cat-edit", array("club_name" => "$club_name"));
        ?>
    </div>
    <div id="page-content-right" class="eqHight">
        <?php echo $this->element("top"); ?>
        <div class="page-title">
            <h2>Club Night Details</h2>
            <a href="<?php echo $this->Html->url(array('controller' => 'Events', 'action' => 'add')); ?>" class="btn pull-right adNewAccountBtn"><i class="halflingicon-plus"></i></a>
        </div>
        <div class="right-containr">
            <div class="rignt-contain-all">
                <div class="row-fluid">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Performer/DJ</th>
                                <th>Type of Music</th>
                                <th>Table Price Multiplier</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (!empty($events)):
                                foreach ($events as $event):
                                    ?>
                                    <tr>
                                        <td><?php echo $event['Event']['event_date']; ?></td>
                                        <td><?php echo $event['Event']['performer']; ?></td>
                                        <td><?php echo $event['Category']['category_name']; ?></td>
                                        <td><?php echo $event['Event']['price_multiplier']; ?></td>
                                        <td>
                                            <?php echo $this->Html->link(__('Edit'), array('controller' => 'NightDetails', 'action' => 'booking_edit', $event['Event']['id'])); ?>
                                        </td>
                                    </tr>
                                    <?php
                                endforeach;
                            else:
                                ?>
                                <tr>
                                    <td colspan="5">No Special Events Found.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
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
                </div>
            </div>
        </div>
    </div>
</div>