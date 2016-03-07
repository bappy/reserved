<script type="text/javascript">
    jQuery(document).ready(function() {
        jQuery("#edit_club_bottles").validationEngine('attach');
    });
</script>
<div class="row-fluid">
    <div class="span12">        
        <div class="row-fluid">
            <div class="span4 text-left">
                <h3>Edit Bottle</h3>
            </div>
            <div class="span1 offset5">
                <div class="checkbox pull-right">
                    <a href="<?php echo $this->Html->url(array('controller' => 'clubBottles', 'action' => 'index')); ?>">
                        <button type="button" class="btn btn-labeled btn-default">
                            <span class="btn-label">Cancel</span>
                        </button>
                    </a>
                </div>
            </div>
            <div class="span1 offset1">                
                <div class="checkbox pull-right">
                    <?php echo $this->Html->link(__('Delete'), array('action' => 'delete', $this->data['ClubBottle']['id']), array('class' => 'btn'), sprintf(__('Are you sure you want to delete # %s?'), $this->data['ClubBottle']['id'])); ?>    
                </div>
            </div>            
        </div>
        <?php echo $this->Form->create('ClubBottle', array('id' => 'edit_club_bottles')); 
        echo $this->Form->hidden('user_id', array('value' => $user_id));
        echo $this->Form->hidden('club_id', array('value' => $club_id));
        echo $this->Form->hidden('id');
        echo $this->Form->hidden('status');
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
                <?php echo $this->Form->input('bottle_price', array('style'=>'width:100%','type' => 'text', 'required' => false, 'label' => false, 'class' => 'validate[required] input-xxlarge', 'div' => false, 'placeholder' => 'Item Price')); ?>
            </div>                           
        </div>
        <div class="clearfix">&nbsp;</div>
        <div class="row-fluid">
            <div class="span1">
                <label for="">&nbsp;</label>
            </div>
            <div class="span10" style="position:relative; float:left;">
                <?php echo $this->Form->input('category_id', array('type' => 'select', 'label' => false, 'class' => 'validate[required] input', 'div' => false, 'required' => false, 'options' => $categories, 'empty' => 'Select a Category')); ?>
            </div>           
        </div>
        <div class="clearfix">&nbsp;</div>
        <div class="row-fluid">
            <div class="span5 offset1" style="position:relative; float:left;">
                                <?php echo $this->Form->input('upsell', array('style'=>'width:100%','type' => 'select', 'label' => false, 'class' => '', 'div' => false, 'required' => false, 'options' => $club_bottle_lists, 'empty' => 'Select an Upsell')); ?>
            </div>
            <div class="span5">
                                <?php
                                $options = array('add' => 'Add', 'replace' => 'Replace');
                                $attributes = array('legend' => false, 'hiddenField' => false, 'label' => array('class' => 'upsell_radio_label'), 'class' => 'upsell_radio_input');
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
                         <a onClick="duplicateBottle()" style="cursor:pointer">
                        <button type="button" class="btn btn-labeled btn-default">
                            <span class="btn-label"></span>Duplicate Table
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