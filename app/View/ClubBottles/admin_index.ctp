<?php

echo $this->Html->css('validationEngine.jquery');
echo $this->Html->script(array('jquery.validationEngine-en', 'jquery.validationEngine'));
//echo $this->Html->script(array('main'));
?>
<div class="row-fluid">
    <div id="page-sidebar-left" class="eqHight">
        <?php
        if (isset($club_name) && !empty($club_name)) {
            $club_name = $club_name;
        } else {
            $club_name = "";
        }
        echo $this->element("sidebar-left-pricing-bottles", array("club_name" => "$club_name"));
        ?>
    </div>
    <div id="page-content-right" class="eqHight">
        <?php echo $this->element("admin_top"); ?>
        <div class="page-title">
            <h2>All Bottles</h2>            
            <a href="#myModal" role="button" class="btn pull-right adNewAccountBtn" data-toggle="modal543" data-load-remote="<?php echo $this->Html->url(array('controller' => 'clubBottles', 'action' => 'add')); ?>" data-remote-target=".ajax-content"><i class="halflingicon-plus"></i></a> 
        </div>
        <div class="right-containr">
            <div class="rignt-contain-all">
                <div class="row-fluid">
                    <div class="span6">
                        <div class="responsive club_table">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Item</th>
                                        <th>&nbsp;</th>
                                        <th>Category</th>
                                        <th>Price</th>
                                        <th>Upsell and Type</th>
<!--                                        <th>Status</th>
                                        <th>Action</th>-->
                                    </tr>
                                </thead>
                                <tbody>
                            <?php if (!empty($clubBottles)): ?>
                                <?php $i=1; foreach ($clubBottles as $clubBottle): ?>
                                    <tr data-remote-target=".ajax-content" data-load-remote="<?php echo $this->Html->url(array("action" => "edit",$clubBottle['ClubBottle']['id']));?>">
                                        <td><?php echo $i; ?></td>
                                        <td><span><?php echo $clubBottle['ClubBottle']['bottle_name']; ?></span></td>
                                        <td><?php echo $clubBottle['Category']['category_name']; ?></td>
                                        <td>$<?php echo $clubBottle['ClubBottle']['bottle_price']; ?></td>
                                        <td><?php echo $clubBottle['ClubBottle']['upsell']; ?> - <?php echo $clubBottle['ClubBottle']['upsell_type']; ?></td>
<!--                                        <td><?php echo $clubBottle['ClubBottle']['status']; ?></td>
                                        <td>
                                            <a data-remote-target=".ajax-content" data-load-remote="<?php echo $this->Html->url(array("action" => "edit",$clubBottle['ClubBottle']['id']));?>"  href="#myModal">Edit</a>
                                        </td>-->
                                    </tr>
                                <?php $i++; endforeach; ?>
                            <?php else: ?>
                                    <tr>
                                        <td colspan="6" style="text-align:center;">No Clubs Bottles Found.</td>
                                    </tr>
                            <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="span6">
                        <div class="ajax-content">

                        </div>
                    </div>
                </div>
                <div class="row-fluid">
                    <div class="span12">
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
</div>
<script type="text/javascript">
    jQuery(document).ready(function() {
        var loader_html = "<span style='text-align:center;font-weight:700;'>loading please wait...</span>";
        $('[data-load-remote]').on('click', function(e) {
            e.preventDefault();
            var $this = $(this);
            var remote = $this.data('load-remote');

            if (remote) {
                $($this.data('remote-target')).html(loader_html);
                $($this.data('remote-target')).load(remote);
            }

        });
        jQuery(document).on('click', '#bottlepublish', function(e) {
            var answer = confirm("Are you sure you want to publish this live to Reserved?");
            if (answer)
                return true;
            else
                return false;
        });

    });
    
    function duplicateBottle()
    {
        var user_id = $('#ClubBottleUserId').val();
        var club_id = $('#ClubBottleClubId').val();
        var category_id = $('#ClubBottleCategoryId').val();
        var bottle_name = $('#ClubBottleBottleName').val();
        var bottle_price = $('#ClubBottleBottlePrice').val();
        var upsell = $('#ClubBottleUpsell').val();
        var upsell_type = $('input[name="data[ClubBottle][upsell_type]"]:checked').val();
        var status = $('#ClubBottleStatus').val();
        $.ajax({
            type: "post",
            url: myBaseUrl + "/admin/ClubBottles/duplicate_bottle/",
            data: {user_id: user_id, club_id: club_id, category_id: category_id, bottle_name: bottle_name, bottle_price: bottle_price, bottle_price:bottle_price, upsell: upsell, upsell_type: upsell_type, status: status},
            async: true,
            success: function(data) {
                var url = myBaseUrl + "/admin/ClubBottles/edit/" + data;
                $(".ajax-content").load(url);
            }
        });
    }
</script>
