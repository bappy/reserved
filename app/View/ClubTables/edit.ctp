<?php
//echo $this->Html->css('validationEngine.jquery');
//echo $this->Html->script(array('jquery.validationEngine-en', 'jquery.validationEngine'));
//echo $this->Html->script(array('main'));
?>
<script type="text/javascript">
    jQuery(document).ready(function() {
        jQuery("#edit_club_tables").validationEngine('attach');
    });
</script>
<div class="row-fluid">
    <div class="span12">        
        <div class="row-fluid">
            <div class="span3 text-left">
                <h3>Edit Table</h3>
            </div>
            <div class="span1 offset6">
                <div class="checkbox pull-right">
                    <a href="<?php echo $this->Html->url(array('controller' => 'clubTables', 'action' => 'index')); ?>">
                        <button type="button" class="btn btn-labeled btn-default">
                            <span class="btn-label">Cancel</span>
                        </button>
                    </a>
                </div>
            </div>
            <div class="span1 offset1">                
                <div class="checkbox pull-right">
                    <?php echo $this->Html->link(__('Delete'), array('action' => 'delete', $this->data['ClubTable']['id']), array('class' => 'btn'), sprintf(__('Are you sure you want to delete # %s?'), $this->data['ClubTable']['id'])); ?>    
                </div>
            </div>            
        </div>

        <?php echo $this->Form->create('ClubTable', array('id' => 'edit_club_tables')); ?>
        <?php
        echo $this->Form->hidden('user_id');
        echo $this->Form->hidden('club_id');
        ?>
        <div class="row-fluid">
            <div class="span1" for="">&nbsp;</div>
            <div class="span10" style="position:relative; float:left;">
                <?php echo $this->Form->input('table_name', array('style'=>'width:100%','type' => 'text', 'required' => false, 'label' => false, 'class' => 'input-xxlarge validate[required]', 'div' => false, 'placeholder' => 'Item Name')); ?>
            </div>
        </div>
        <div class="clearfix">&nbsp;</div>
        <div class="row-fluid">
            <div class="span1"><label class="pull-right">$ &nbsp;&nbsp;&nbsp;</label></div>
            <div class="span10" style="position:relative; float:left;">
                <?php echo $this->Form->input('minimum_price', array('style'=>'width:100%','type' => 'text', 'required' => false, 'label' => false, 'class' => 'input-xxlarge validate[required]', 'div' => false, 'placeholder' => 'Table Minimum')); ?>
            </div>
            <!--<div class="span1"><a class="alert-gry" data-original-title="Tooltip on top" title="" data-placement="right" data-toggle="tooltip" href="#">?</a></div>-->
        </div>
        <div class="clearfix">&nbsp;</div>
        <div class="row-fluid">
            <div class="span1">
                <label for="">&nbsp;</label>
            </div>
            <div class="span10" style="position:relative; float:left;">
                <?php echo $this->Form->input('category_id', array('type' => 'select', 'label' => false, 'class' => 'validate[required]', 'div' => false, 'required' => false, 'options' => $categories, 'empty' => 'Select a Category')); ?>
            </div>
            <div class="span1"><a class="alert-gry" data-original-title="Tooltip on top" title="Choose a category that the table falls into.This is how users will choose what they want  Lounge : More reluxed surrounding area (least expensive)
                                  DJ Dance Floor : On the dance floor next to the DJ(more expensive)
                                  Top Table : Best table next to the DJ and party area" data-placement="left" data-toggle="tooltip" href="#">?</a></div>
        </div>
        <div class="clearfix">&nbsp;</div>
        <div class="row-fluid">
            <div class="span5"><label class="pull-right">Max people for table minimum&nbsp;&nbsp;</label></div>
            <div class="span2">
                                <?php
                                $dropdown_array = array(
                                    "1" => "1",
                                    "2" => "2",
                                    "3" => "3",
                                    "4" => "4",
                                    "5" => "5",
                                    "6" => "6",
                                    "7" => "7",
                                    "8" => "8",
                                    "9" => "9",
                                    "10" => "10",
                                );
                                $guys = array_merge(array('Guys'), $dropdown_array  );
                                $girls = array_merge( array('Girls') , $dropdown_array );
                                ?>
                                <?php echo $this->Form->input('table_min_guy', array('type' => 'select', 'label' => false, 'class' => 'input-small', 'div' => false, 'required' => false, 'options' => $guys)); ?>
            </div>
            <div class="span4">
                                <?php echo $this->Form->input('table_min_girls', array('type' => 'select', 'label' => false, 'class' => 'input-small', 'div' => false, 'required' => false, 'options' => $girls)); ?>
            </div>
            <div class="span1"><a class="alert-gry" data-original-title="Tooltip on top" title="This is the maximum guys and girls that can come in at the minimum price(Ex:$500 upto 2 guys)" data-placement="left" data-toggle="tooltip" href="#">?</a></div>
        </div>
        <div class="clearfix">&nbsp;</div>
        <div class="row-fluid">
            <div class="span3"><label class="pull-right">If Maximum&nbsp;&nbsp;</label></div>
            <div class="span2">
                                <?php echo $this->Form->input('max_guys1', array('style'=>'width:100%','type' => 'select', 'label' => false, 'class' => 'input pull-left', 'div' => false, 'required' => false, 'options' => $guys)); ?>
            </div>
            <div class="span2">
                &nbsp;= <label style="float:right; padding-top: 7px;"> &nbsp;$</label>
            </div>
            <div class="span4">
                                <?php echo $this->Form->input('max_guys1_price', array('style'=>'width:90%','type' => 'text', 'required' => false, 'label' => false, 'class' => 'input', 'div' => false, 'placeholder' => 'Item Price')); ?>
            </div>
            <div class="span1"><a class="alert-gry" data-original-title="Tooltip on top" title="This is the higher maximum of guys that can come in at a higher price (Ex:$1000 upto 3 guys)" data-placement="left" data-toggle="tooltip" href="#">?</a></div>
        </div>
        <div class="clearfix">&nbsp;</div>
        <div class="row-fluid">
            <div class="span3"><label class="pull-right">If Maximum&nbsp;&nbsp;</label></div>
            <div class="span2">
                                <?php echo $this->Form->input('max_guys2', array('style'=>'width:100%','type' => 'select', 'label' => false, 'class' => 'input pull-left', 'div' => false, 'required' => false, 'options' => $dropdown_array)); ?>
            </div>
            <div class="span2">
                &nbsp;= <label style="float:right; padding-top: 7px;"> &nbsp;$</label>

            </div>
            <div class="span4">
                                <?php echo $this->Form->input('max_guys2_price', array('type' => 'text', 'required' => false, 'label' => false, 'class' => 'input-medium', 'div' => false, 'placeholder' => 'Item Price')); ?>
            </div>
            <div class="span1"><a class="alert-gry" data-original-title="Tooltip on top" title="This is an even higher maximum of guys that can come in at an even higher price.(Ex:$2000 upto 5 guys)" data-placement="left" data-toggle="tooltip" href="#">?</a></div>
        </div>
                        <?php
                        $create_date = date('Y-m-d H:i:s');
                        echo $this->Form->hidden('create_date', array('value' => $create_date));
                        echo $this->Form->hidden('id');
						echo $this->Form->hidden('status');
                        ?>
        <div class="clearfix">&nbsp;</div>
        <div class="row-fluid">
            <div class="span11">
                <a href="#" class="pull-right">* Need Help ? Ask us</a>
            </div>
        </div>
        <div class="clearfix">&nbsp;</div>
        <div class="row-fluid">
            <div class="span8">
                <div class="checkbox pull-right">

                </div>

            </div>
            <div class="span4">                

            </div>
        </div>
        <div class="row-fluid">           
            <div class="span12">
                <ul class="formbutton">
                    <li>
                        <a onClick="duplicateTable()" style="cursor:pointer">
                            <button type="button" class="btn btn-labeled btn-default">
                                <span class="btn-label">Duplicate Table</span>
                            </button>
                        </a>
                    </li>                    
                    <li>
                        <button type="submit" name="save_publish" class="btn btn-labeled btn-success"><span class="btn-label"></span>Save and Publish</button>
                    </li>
                </ul>
            </div>
        </div>


                        <?php echo $this->Form->end(); ?>
    </div>
</div>

<script type="text/javascript">
    $(function() {
        $('#ClubTableTableMinGuy').change(function() {
            var maxIndex = this.options.length - 1;
            var diff = maxIndex - this.selectedIndex;
            switch (diff) {
                case 0:
                    $('#ClubTableMaxGuys1').val(parseInt($(this).val()));
                    $('#ClubTableMaxGuys2').val(parseInt($(this).val()));
                    break;
                case 1:
                    $('#ClubTableMaxGuys1').val(parseInt($(this).val()) + 1);
                    $('#ClubTableMaxGuys2').val(parseInt($(this).val()) + 1);
                    break;

                default:
                    $('#ClubTableMaxGuys1').val(parseInt($(this).val()) + 1);
                    $('#ClubTableMaxGuys2').val(parseInt($(this).val()) + 2);
            }
        });

        $('#ClubTableMaxGuys1').change(function() {
            if (this.selectedIndex < $('#ClubTableTableMinGuy').prop('selectedIndex')) {
                $(this).val(parseInt($('#ClubTableTableMinGuy').val()));
            }
            var maxIndex = this.options.length - 1;
            var diff = maxIndex - this.selectedIndex;
            switch (diff) {
                case 0:
                    $('#ClubTableMaxGuys2').val(parseInt($(this).val()));
                    break;

                default:
                    $('#ClubTableMaxGuys2').val(parseInt($(this).val()) + 1);
            }
        });

        $('#ClubTableMaxGuys2').change(function() {

            var maxIndex = this.options.length - 1;
            var diff = maxIndex - this.selectedIndex;
            var nextIndex = $('#ClubTableMaxGuys1').prop('selectedIndex') + 1
            if (this.selectedIndex < $('#ClubTableMaxGuys1').prop('selectedIndex')) {
                nextIndex = (nextIndex > maxIndex) ? maxIndex : nextIndex;
                this.selectedIndex = nextIndex;
            }
        });


    });
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
</script>
<?php //echo $this->element('footer_Club') ?>