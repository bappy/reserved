<?php
    echo $this->Html->script(array('jquery-1.10.2.min.js','vendor/bootstrap.min', "ui/jquery.ui.core", "ui/jquery.ui.widget", "ui/jquery.ui.datepicker", 'basic/js/jquery.simplemodal', 'clubsettings', 'vendor/modernizr-2.6.2-respond-1.1.0.min', 'vendor/js/bootstrap-switch', 'docs/vendor/prism', 'docs/index'));
    echo $this->Html->css(array("http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css", 'bootstrap', 'plugins', 'themes', 'castom', 'main', 'bootstrap-switch', 'http://netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css', 'http://bdmdesign.github.io/bootstrap-switch/static/stylesheets/flat-ui-fonts.css', 'basic/css/basic'));
    echo $this->Html->css(array('basic/basic', 'basic/basic_ie', 'utility', 'developers-custom'));
?>
<style>
   #profile_img img
    {
        height: 85px !important;
    }
    .phoneBanner img
    {
        height:150px !important;
        width:100%   !important ;
    }
    
</style>
<script type="text/javascript">
    $(document).on('click', '#edit_exception', function(e) {
        e.preventDefault();
        $('.basic-modal-content-edit' + $(this).attr("exc")).modal();
        $(".datepicker").datepicker(
                {
                    dateFormat: "yy-mm-dd",
                    onSelect: function(date)
                    {
                        alert("Hey there!");
                    }
                });
        $("#clubExceptionID").val($(this).attr("exc"));
    });

    $(document).on('click', '#ajax_btn', function(e) {
        e.preventDefault();
        var id = $(this).attr("add");
        showajax();
        var data = $('#editException' + id).serialize();
        console.log(data);

        $.ajax({
            type: "POST",
            url: "../ClubExceptions/ajaxEdit",
            data: data
        }).done(function(msg) {
            //alert(msg);
            $("#Redirecting").show();
            $(location).attr('href', '<?php echo $this->Form->url('/Clubs/add') ?>')
            $.modal.close();
            hideajax();
        });
        return false;
    });
</script>
<cake:nocache>
    <div class="row-fluid">
        <?php echo $this->element("sidebar"); ?>
        <div id="page-content-right" class="eqHight">
            <?php echo $this->element('top', array("club_name" => $club_name)); ?>
            <div class="page-title">
                <h2>Club Settings</h2>                
            </div>
            <div class="basickInfirmation">
                <h4>Basic Information</h4>            
                <div class="row-fluid">
                    <div class="span12">
                        <h4 style="color:red">
							<?php echo $this->Session->flash('failue'); ?>
                        </h4>
                        <div class="row-fluid">
                            <div class="span8">
                                <ul class="venueSettingsInputs">
                                    <li>
                                        <div class="form-group">
                                            <label class="" for="inputClubName">Name of Club</label>
                                                <?php                                                        
                                                        echo $this->Form->hidden('club_id', array("value" => $clubs[0]['Club']["id"], "id" => "ClubId"));
                                                                                                                
                                                        echo $this->Form->input('club_name', array("value" => $clubs[0]['Club']["club_name"], "class" => "input-medium", "label" => false));                                                        
                                                ?>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="form-group">
                                            <label class="" for="clubType">Club Type</label>
											<?php if (isset($clubs[0]['Club']["club_type_id"]) && ($clubs[0]['Club']["club_type_id"] == 1)):?>
                                            <input type="checkbox" checked="checked" class="switch-small" id="club_type_add" data-on-label="Club" data-off-label="Lounge">
											<?php else:?>
                                            <input type="checkbox" class="switch-small" id="club_type_add" data-on-label="Club" data-off-label="Lounge">
											<?php endif;?>
                                        </div>
                                    </li>
                                </ul>
                                <ul class="venueSettingsInputs">
                                    <li>
                                        <div class="form-group">
                                            <label class="" for="clubAutoApprove">Auto-Approve Reservations ?</label>
											<?php if (isset($clubs[0]['Club']["approve_auto_purchase"]) && ($clubs[0]['Club']["approve_auto_purchase"] == "yes")):?>
                                            <input id="club_auto_approve_reservation" type="checkbox" checked="checked" data-on-label="Yes" data-off-label="No">
											<?php else:?>
                                            <input id="club_auto_approve_reservation" type="checkbox" data-on-label="Yes" data-off-label="No">
											<?php endif;?>
                                            &nbsp;&nbsp;&nbsp;
                                            <a href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="ON allows users to book tables and get an instant confirmation.OFF requires someone to approve each table purchase request.We recommend keeping this ON" class="alert-gry">?</a>
                                        </div>
                                    </li>
                                </ul>
                                <!--ul class="venueSettingsInputs last">
                                    <li>
                                        <div class="form-group">
                                        <?php
                                                if (isset($clubs[0]['Club']["tip_service_fee"])):
                                                $tip_service_fee = $clubs[0]['Club']["tip_service_fee"];
                                                else:
                                                $tip_service_fee = "";
                                                endif;
                                                $tips_array = array(
                                                "select 1" => "select 1",
                                                "select 2" => "select2",
                                                "select 3" => "select 3",
                                                "select 4" => "select 4",
                                                "select 5" => "select 5",
                                                );
                                        ?>
                                            <label class="" for="clubTip">Tip and Service Fee Total</label>
                                            <select class="input-medium" id="club_tip">
												<?php foreach ($tips_array as $key => $value) { ?>
													<?php if ($value == $tip_service_fee): ?>
                                                <option value="<?php echo $key; ?>" selected="<?php echo $tip_service_fee; ?>"><?php echo $value; ?></option>
													<?php else: ?>
                                                <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
													<?php endif; ?>
												<?php } ?>?>
                                            </select>                                            
                                        </div>


                                    </li>
                                </ul-->
                                <div class="form-group">

                                    <label class="span8" for="inputUsernameEmail">Short Description</label>
                                    <div class="clear">&nbsp;</div>
									<?php
										if (isset($clubs[0]['Club']["short_description"])) {
										?>
                                    <textarea id="short_des" rows="3" cols=""
                                              class="input-xxlarge"><?php echo $clubs[0]['Club']["short_description"]; ?></textarea>
										<?php
											} else {
										?>
                                    <textarea id="short_des" rows="3" cols=""
                                              class="input-xxlarge"></textarea>
										<?php
										}
									?>
                                </div>
                                <input type="button" name="submit" value="Submit" class="btn btn-success" id="sub_new" />

                                <div class="row-fluid">
                                    <div class="form-group">
                                        <label class="span8">Add Venue Photos (Maximum of 8)</label>
                                    </div>
                                </div>

                                <div class="row-fluid">
                                    <div class="form-group">
                                        <?php echo $this->Utility->uploader($clubs, "Photo", $clubs[0]['Photo']); ?>
                                    </div>
                                </div>								
                                <div id="profile_img" class="row-fluid row-items">
                                    <?php $this->Utility->profile_image($profile_photo, $clubs[0]['Photo']); ?>  
                                </div>

                            </div>
                            <div class="span4">
                                <div class="rignt-contain-phons">
                                    <div class="phoneView">
                                        <div class="row-fluid">
                                            <div class="span12">
                                                <div class="btn-bar">
                                                    <a href="javascript:void(0);" class="btn btnBack"><img src="<?php echo $this->webroot; ?>img/iconBack.png" width="18" height="12" ></a>
                                                    <h1 class="btnTitle"><a href="javascript:void(0);"><?php echo $club_name;  ?></a> </h1>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row-fluid">
                                            <div class="span12">
                                                <div class="phoneBanner">                                                    
                                                    <?php if(is_array($profile_photo) && count($profile_photo) > 0) {?>
                                                    <img style="margin:0;" height="75px" src="<?php echo $this->webroot . 'img/profile/' . $profile_photo["photos"];?>" />
                                                    <?php } else echo "Upload a picture."?>
                                                </div>
                                                <div class="phoneBannerCaps">
                                                    <h3><?php echo $clubs[0]['Club']["short_description"]; ?></h3>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row-fluid">
                                            <div class="span12">
                                                <?php 
                                                    $show_deal = "no";
                                                    if (isset($clubs[0]['Deal'])) {
                                                        foreach ($clubs[0]['Deal'] as $deal) {
                                                            if ($deal['recur'] == "no" && ( $deal['deal_date'] == date("Y-m-d") )) {
                                                                $show_deal = "yes";                                                                
                                                            }
                                                            if ($deal['recur'] == "yes" && ( date("D", strtotime($deal['deal_date'])) == date("D") )) {
                                                                $show_deal = "yes";                                                                
                                                            }
                                                        }
                                                    }
                                                ?>
                                                <div class="phoneDateCaps">
                                                   <?php 
                                                   $dance = "DANCE";
                                                   if (isset($events)) {
                                                        $dance = $events['Category']['category_name'];
                                                        if (isset($events['Category']['performer']) && $events['Category']['performer'] != "")
                                                            echo '<h3>'.$events['Category']['performer'].'</h3>';
                                                    }
                                                    
                                                    if ($show_deal == "no" && $clubs[0]['Club']['approve_auto_purchase'] == "no")
                                                        echo'<h3>All reservations require approval at this venue</h3>';
                                                    else if ($show_deal == "yes") {
                                                        echo'<h3>Tonight: 1 Special Offer</h3>';
                                                    }                                                    
                                                    ?>

                                                </div>
                                                <div class="phoneDateBar">
                                                    <?php  $open_time="";
                                                    foreach($clubs[0]['ClubOpenDay'] as $key => $ClubOpenDay){
                                                        if($ClubOpenDay['days'] == date("l"))
                                                            $open_time = $ClubOpenDay['open_time'];
                                                    }
                                                    ?>
                                                    <ul>
                                                        <li>
                                                            <h2>Date :</h2>
                                                            <h1><?php echo date("M d");?></h1>
                                                        </li>
                                                        <li>
                                                            <h2>Doors :</h2>
                                                            <h1><?php echo $open_time;?></h1>
                                                        </li>
                                                        <li>
                                                            <h2>Club :</h2>
                                                            <h1><?php echo $dance;?></h1>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="phoneBtn">
                                                    <a href="javascript:void(0);" class="btn  btn-block btn-primary btn-inverse">BOOK IT</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="clear">&nbsp;</div>

                <div class="row-fluid">
                    <div class="span12">
                        <div class="basickInfirmation">
                            <h4>Days Open</h4>
                        </div>								
			<?php echo $this->Utility->OpenClose($daysArr); ?>
                        <div class="clearfix">&nbsp;</div>
                        <div class="row-fluid">
                            <div id='content'>
                                <div id='basic-modal'>
                                    <span>Exception</span>&nbsp;<input type="button" id='basic' class="btn" value="Add New Exception"> &nbsp; 
                                    <a href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="Adding any exception will override the schedule made above for certain days. Any special events that effect the schedule will go here" class="alert-gry">?</a>
                                    <div id="Redirecting" style="font-weight:bold;color:#ff0000;font-size:18px;display:none">Redirecting.Please Wait..................</div>
                                </div>
                                <!-- modal content -->
                                <div id="basic-modal-content">
                                    <?php $this->Utility->basicmodal(); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row-fluid">
                    <div class="span12">
                        <div id="EditModal">
                            <?php echo $this->Utility->Editmodal($clubExceptions); ?>
                        </div>
                    </div>							
                </div>
                <div class="row-fluid">
                    <div class="span12">
			<?php echo $this->Utility->exceptionLoad($clubExceptions); ?>
                    </div>
                </div>
                <input type="hidden" id="clubExceptionID" value="" />				
            </div>
        </div>
    </div>
</cake:nocache>
<!-- Footer -->
<?php echo $this->element("footer_Club"); ?>		