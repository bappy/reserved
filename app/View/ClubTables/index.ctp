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
        echo $this->element("sidebar-left-pricing-tables", array("club_name" => "$club_name"));
        ?>
    </div>
    <div id="page-content-right" class="eqHight">
        <?php echo $this->element("top"); ?>
        <div class="page-title">
            <h2>All Tables</h2>
            <a href="#myModal" role="button" class="btn pull-right adNewAccountBtn" data-toggle="modal543" data-load-remote="<?php echo $this->Html->url(array('controller' => 'clubTables', 'action' => 'add')); ?>" data-remote-target=".ajax-content"><i class="halflingicon-plus"></i></a> 
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
                                        <th>Minimum</th>
<!--                                        <th>Action</th>-->
                                    </tr>
                                </thead>
                                <tbody>
                            <?php if (!empty($clubTables)): ?>
                                <?php foreach ($clubTables as $key => $clubTable): ?>
                                    <tr data-remote-target=".ajax-content" data-load-remote="<?php echo $this->Html->url(array("action" => "edit",$clubTable['ClubTable']['id']));?>">
                                        <td>#<?php echo $clubTable['ClubTable']['id']; ?></td>
                                        <td><?php echo $clubTable['ClubTable']['table_name']; ?></td>
                                        <td><?php echo $clubTable['Category']['category_name']; ?></td>
                                        <td>$<?php echo $clubTable['ClubTable']['minimum_price']; ?></td>
<!--                                        <td><?php echo $clubTable['ClubTable']['status']; ?></td>
                                        <td class="actions">                                            
                                            <a data-remote-target=".ajax-content" data-load-remote="<?php echo $this->Html->url(array("action" => "edit",$clubTable['ClubTable']['id']));?>"  href="#myModal">Edit</a>                                            
                                        </td>-->
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                    <tr>
                                        <td colspan="5">No Clubs Tables Found.</td>
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
        var loader_html ="<span style='text-align:center;font-weight:700;'>loading please wait...</span>";
        $('[data-load-remote]').on('click', function(e) {
            e.preventDefault();
            var $this = $(this);
            var remote = $this.data('load-remote');
                
            if (remote) {
                $($this.data('remote-target')).html(loader_html);
                $($this.data('remote-target')).load(remote);
            }            
        });
        jQuery(document).on('click', '.btn-success', function(e) {
            var answer = confirm("Are you sure you want to publish this live to Reserved?");
            if (answer)            
                return true;
            else
                return false;          

        });

//For Duplicate Table entry

function duplicateTable()
{
    var user_id = $('#ClubTableUserId').val();
    var club_id = $('#ClubTableClubId').val();
    var table_name = $('#ClubTableTableName').val();
    var minimum_price = $('#ClubTableMinimumPrice').val();
    var category_id = $('#ClubTableCategoryId').val();
    var table_min_guy = $('#ClubTableTableMinGuy').val();
    var table_min_girls = $('#ClubTableTableMinGirls').val();
    var max_guys1 = $('#ClubTableMaxGuys1').val();
    var max_guys1_price = $('#ClubTableMaxGuys1Price').val();
    var max_guys2 = $('#ClubTableMaxGuys2').val();
    var max_guys2_price = $('#ClubTableMaxGuys2Price').val();
    var create_date = $('#ClubTableCreateDate').val();
    var status = $('#ClubTableStatus').val();
    $.ajax({
        type: "post",
        url: myBaseUrl + "/ClubTables/duplicate_table/",
        data: {user_id: user_id, club_id: club_id, table_name: table_name, minimum_price: minimum_price, category_id: category_id, table_min_guy: table_min_guy, table_min_girls: table_min_girls, max_guys1: max_guys1, max_guys1_price: max_guys1_price, max_guys2: max_guys2, max_guys2_price: max_guys2_price, create_date: create_date, status: status},
        async: true,
        success: function(data) {
            var url = myBaseUrl + "/ClubTables/edit/" + data;
            $(".ajax-content").load(url);
        }
    });
}

    });
</script>