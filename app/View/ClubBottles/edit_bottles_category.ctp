<div class="row-fluid">
    <div id="page-sidebar-left" class="eqHight">
        <?php
        if (isset($club_name) && !empty($club_name)) {
            $club_name = $club_name;
        } else {
            $club_name = "";
        }
        echo $this->element("sidebar-left-pricing-bottles-cat-edit", array("club_name" => "$club_name"));
        ?>
    </div>
    <div id="page-content-right" class="eqHight">
        <?php echo $this->element("top"); ?>
        <div class="page-title">
            <h2>All Bottles</h2>
            <a class="btn pull-right adNewAccountBtn" href="<?php echo $this->Html->url(array('controller' => 'clubBottles', 'action' => 'add')); ?>"><i class="halflingicon-plus"></i></a>
        </div>
        <div class="right-containr">
            <div class="rignt-contain-all">
                <div class="row-fluid">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Item</th>
                                <th>Category</th>
                                <th>Price</th>
                                <th>Upsell and Type</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($clubBottles)): ?>
                                <?php $i=1; foreach ($clubBottles as $clubBottle): ?>
                                    <tr>
                                        <td><?php echo $i; ?>&nbsp;<span>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $clubBottle['ClubBottle']['bottle_name']; ?></span></td>
                                        <td><?php echo $clubBottle['Category']['category_name']; ?></td>
                                        <td>$<?php echo $clubBottle['ClubBottle']['bottle_price']; ?></td>
                                        <td><?php echo $clubBottle['ClubBottle']['upsell']; ?> - <?php echo $clubBottle['ClubBottle']['upsell_type']; ?></td>
                                        <td><?php echo $clubBottle['ClubBottle']['status']; ?></td>
                                        <td>
                                            <?php echo $this->Html->link(__('Edit |'), array('action' => 'edit', $clubBottle['ClubBottle']['id'])); ?>
                                            <?php echo $this->Html->link(__('Delete'), array('action' => 'delete', $clubBottle['ClubBottle']['id']), null, sprintf(__('Are you sure you want to delete # %s?'), $clubBottle['ClubBottle']['id'])); ?>
                                        </td>
                                    </tr>
                                <?php $i++; endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="6" style="text-align:center;">No Clubs Bottles Found.</td>
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