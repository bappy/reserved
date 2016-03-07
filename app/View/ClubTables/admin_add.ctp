<?php
//echo $this->Html->css('validationEngine.jquery');
//echo $this->Html->script(array('jquery.validationEngine-en', 'jquery.validationEngine'));
?>
<script type="text/javascript">
    jQuery(document).ready(function() {
        jQuery("#add_club_tables").validationEngine('attach');
    });
</script>
<div class="row-fluid">
    <div class="span12">
        <h3>New Table</h3>

                        <?php echo $this->Form->create('ClubTable', array('id' => 'add_club_tables')); ?>
                        <?php
                        echo $this->Form->hidden('user_id', array('value' => $user_id));
                        echo $this->Form->hidden('club_id', array('value' => $club_id));
                        ?>

        <div class="row-fluid">
            <div class="span1" for="">&nbsp;</div>
            <div class="span10" style="position:relative; float:left;">
                                <?php echo $this->Form->input('table_name', array('style'=>'width:100%','type' => 'text', 'required' => false, 'label' => false, 'id' => 'table_name', 'class' => 'input-large validate[required]', 'div' => false, 'placeholder' => 'Item Name')); ?>
            </div>
        </div>
        <div class="clearfix">&nbsp;</div>
        <div class="row-fluid">
            <div class="span1"><label class="pull-right">$ &nbsp;&nbsp;&nbsp;</label></div>
            <div class="span10" style="position:relative; float:left;">
                <?php echo $this->Form->input('minimum_price', array('style'=>'width:100%','type' => 'text', 'required' => false, 'label' => false, 'class' => 'input-large validate[required]', 'div' => false, 'placeholder' => 'Table Minimum')); ?>
            </div>            
        </div>
        <div class="clearfix">&nbsp;</div>
        <div class="row-fluid">
            <div class="span1">
                <label for="">&nbsp;</label>
            </div>
            <div class="span9" style="position:relative; float:left;">
                <?php echo $this->Form->input('category_id', array('type' => 'select', 'label' => false, 'class' => 'input-large validate[required]', 'div' => false, 'required' => false, 'options' => $categories, 'empty' => 'Select a Category')); ?>
            </div>
            <div class="span1"><a class="alert-gry" data-original-title="Tooltip on top" title="Choose a category that the table falls into.This is how users will choose what they want
                                  Lounge : More reluxed surrounding area (least expensive)
                                  DJ Dance Floor : On the dance floor next to the DJ(more expensive)
                                  Top Table : Best table next to the DJ and party area" data-placement="left" data-toggle="tooltip" href="#">?</a></div>
        </div>
        <div class="clearfix">&nbsp;</div>
        <div class="row-fluid">
            <div class="span5"><label class="pull-right">Max people for table minimum&nbsp;&nbsp;</label></div>
            <div class="span2">
                                <?php
                                $dd_guys = $dropdown_array = array(
                                    0 => "Guys",                                    
                                    "1" => "1",
                                    "2" => "2",
                                    "3" => "3",
                                    "4" => "4",
                                    "5" => "5",
                                    "6" => "6",
                                    "7" => "7",
                                    "8" => "8",
                                    "9" => "9",
                                    "10" => "10"
                                );
                                ?>
                                <?php echo $guys = $this->Form->input('table_min_guy', array('type' => 'select', 'label' => false, 'class' => 'input-small', 'div' => false, 'required' => false, 'options' => $dropdown_array, 'selected' => 0)); ?>
            </div>
            <div class="span4">
                                <?php
                                $dropdown_array[0] = 'Girls';
                                echo $girls = $this->Form->input('table_min_girls', array('type' => 'select', 'label' => false, 'class' => 'input-small', 'div' => false, 'required' => false, 'options' => $dropdown_array, 'selected' => 0));
                                ?>
            </div>
            <div class="span1"><a class="alert-gry" data-original-title="Tooltip on top" title="This is the maximum guys and girls that can come in at the minimum price(Ex:$500 upto 2 guys)" data-placement="left" data-toggle="tooltip" href="#">?</a></div>
        </div>
        <div class="clearfix">&nbsp;</div>
        <div class="row-fluid">
            <div class="span3"><label class="pull-right">If Maximum&nbsp;&nbsp;</label></div>
            <div class="span2">
                <?php

                echo $this->Form->input('max_guys1', array('style'=>'width:100%','type' => 'select', 'label' => false, 'class' => 'pull-left', 'div' => false, 'required' => false, 'options' => $dd_guys, 'selected' => '1')); 
                ?>
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
                <?php

                echo $this->Form->input('max_guys2', array('style'=>'width:100%','type' => 'select', 'label' => false, 'class' => 'input pull-left', 'div' => false, 'required' => false, 'options' => $dd_guys, 'selected' => '1')); 
                ?>
            </div>
            <div class="span2">
                &nbsp;= <label style="float:right; padding-top: 7px;"> &nbsp;$</label>
            </div>

            <div class="span4">
                        <?php echo $this->Form->input('max_guys2_price', array('style'=>'width:90%','type' => 'text', 'required' => false, 'label' => false, 'class' => 'input', 'div' => false, 'placeholder' => 'Item Price')); ?>
            </div>
            <div class="span1"><a class="alert-gry" data-original-title="Tooltip on top" title="This is an even higher maximum of guys that can come in at an even higher price.(Ex:$2000 upto 5 guys)" data-placement="left" data-toggle="tooltip" href="#">?</a></div>
        </div>
        <?php
        $create_date = date('Y-m-d H:i:s');
        echo $this->Form->hidden('create_date', array('value' => $create_date));
        ?>
        <div class="clearfix">&nbsp;</div>
        <div class="row-fluid">
            <div class="span11">
                <a href="#" class="pull-right">* Need Help ? Ask us</a>
            </div>
        </div>
        <div class="clearfix">&nbsp;</div>
        <div class="row-fluid">           
            <div class="span12">
                <ul class="formbutton">
                    <li>
                        <a href="<?php echo $this->Html->url(array('controller' => 'clubTables', 'action' => 'index')); ?>">
                            <button type="button" class="btn btn-labeled btn-default">
                                <span class="btn-label">Cancel</span>
                            </button>
                        </a>
                    </li>
<!--                    <li>
                        <button type="submit" name="save" class="btn btn-labeled btn-success"><span class="btn-label">Save</span></button>         
                    </li>-->
                    <li>
                        <button type="submit" name="save_publish" class="btn btn-labeled btn-success"><span class="btn-label">Save and Publish</span></button>
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

//            if( diff <= 0 )   this.selectedIndex = maxIndex;                
        });


    });
</script>
<?php //echo $this->element('footer_Club') ?>