
<script type="text/javascript">
    jQuery(document).ready(function() {
        jQuery("#add_club_bottles").validationEngine('attach');
    });
</script>
<div class="row-fluid">
    <div class="span12">
        <h3>New Bottle</h3>
        <?php echo $this->Form->create('ClubBottle',array('id' => 'add_club_bottles')); ?>
        <?php
        echo $this->Form->hidden('user_id', array('value' => $user_id));
        echo $this->Form->hidden('club_id', array('value' => $club_id));
        ?>
        <div class="row-fluid">
            <div class="span1" for="">&nbsp;</div>
            <div class="span10" style="position:relative; float:left;">
                <?php echo $this->Form->input('bottle_name', array('style'=>'width:100%','type' => 'text', 'required' => false, 'label' => false, 'class' => 'validate[required] input', 'div' => false, 'placeholder' => 'Item Name')); ?>
            </div>
        </div>
        <div class="clearfix">&nbsp;</div>
        <div class="row-fluid">
            <div class="span1"><label class="pull-right">$ &nbsp;&nbsp;&nbsp;</label></div>
            <div class="span10" style="position:relative; float:left;">
                <?php echo $this->Form->input('bottle_price', array('style'=>'width:100%','type' => 'text', 'required' => false, 'label' => false, 'class' => 'validate[required] input', 'div' => false, 'placeholder' => 'Item Price')); ?>
            </div>   
        </div>
        <div class="clearfix">&nbsp;</div>
        <div class="row-fluid">
            <div class="span1">
                <label for="">&nbsp;</label>
            </div>
            <div class="span10" style="position:relative; float:left;">
                <?php echo $this->Form->input('category_id', array('style'=>'width:100%','type' => 'select', 'label' => false, 'class' => 'input validate[required]', 'div' => false, 'required' => false, 'options' => $categories, 'empty' => 'Select a Category')); ?>
            </div>

        </div>
        <div class="clearfix">&nbsp;</div>
        <div class="row-fluid">
            <div class="span5 offset1" style="position:relative; float:left;">
                <?php echo $this->Form->input('upsell', array('style'=>'width:100%','type' => 'select', 'label' => false, 'class' => '', 'div' => false, 'required' => false, 'options' => $club_bottle_lists, 'default' => '0', 'empty' => 'Select an Upsell')); ?>
            </div>
            <div class="span5" style="position:relative; float:left;">
                <?php
                $options = array('add' => 'Add', 'replace' => 'Replace');
                $attributes = array('legend' => false,'hiddenField' => false, 'label' => array('class' => 'upsell_radio_label'), 'class' => 'upsell_radio_input');
                echo $this->Form->radio('upsell_type', $options, $attributes);
                ?>
            </div>
            <div class="span1"><a class="alert-gry" data-original-title="Tooltip on top" title="Changes what upsell does(either gets added to order or replaces order as an upgrade)" data-placement="right" data-toggle="tooltip" href="#">?</a></div>
        </div>
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
                        <a href="<?php echo $this->Html->url(array('controller' => 'clubBottles', 'action' => 'index')); ?>">
                            <button type="button" class="btn btn-labeled btn-default">
                                <span class="btn-label">Cancel</span>
                            </button>
                        </a></li>
                    <!--                    <li>
                                            <button type="submit" name="save" class="btn btn-labeled btn-success"><span class="btn-label">Save</span></button>         
                                        </li>-->
                    <li>
                        <button type="submit" name="save_publish" id="bottlepublish" class="btn btn-labeled btn-success"><span class="btn-label">Save and Publish</span></button>
                    </li>
                </ul>
            </div>
        </div>
       <?php echo $this->Form->end(); ?>
    </div>
</div>