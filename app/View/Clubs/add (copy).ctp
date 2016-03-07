<?php

echo $this->Html->script(array('jquery-1.10.2.min.js','vendor/bootstrap.min', "ui/jquery.ui.core", "ui/jquery.ui.widget", "ui/jquery.ui.datepicker", 'basic/js/jquery.simplemodal', 'clubsettings', 'vendor/modernizr-2.6.2-respond-1.1.0.min', 'vendor/js/bootstrap-switch', 'docs/vendor/prism', 'docs/index'));
echo $this->Html->css(array("http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css", 'bootstrap', 'plugins', 'themes', 'castom', 'plugins', 'main', 'bootstrap-switch', 'http://netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css', 'http://bdmdesign.github.io/bootstrap-switch/static/stylesheets/flat-ui-fonts.css', 'basic/css/basic'));
echo $this->Html->css(array('basic/basic', 'basic/basic_ie', 'utility', 'developers-custom'));
?>
<script type="text/javascript">

    $(document).on('click', '#edit_exception', function(e) {
        e.preventDefault();

        $('.basic-modal-content-edit' + $(this).attr("exc")).modal();
        //        $("#modal_edit_date_picker"+$(this).attr("exc")).datepicker({ showOn: "button",
        //            buttonImage: '<?php echo $this->webroot ?>img/calendar.gif',
        //            buttonImageOnly: true});
        //$("#modal_edit_date_picker"+$(this).attr("exc")).datepicker( "option", "dateFormat", "yy-mm-dd" );
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
        var id = $(this).attr("add")
        //var open_time_edit=($("#open_time_edit"+id).val());alert(open_time_edit);
        //var close_time_edit=$("#close_time_edit"+id).val();
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
            </div>
            <div class="right-containr">
                <div class="rignt-contain-all">
                    <div class="rignt-contain-forms">
                        <div class="row-fluid">
                            <h4 style="color:red">
                                <?php echo $this->Session->flash('failue'); ?>
                            </h4>
                            <div class="row-fluid">
                                <div class="span12">
                                    <ul class="venueSettingsInputs">
                                        <li>
                                            <div class="form-group">
                                                <label class="" for="inputClubName">Name of Club</label>
                                                <?php
													if (isset($clubs[0]['Club']["id"]))
                                                    echo $this->Form->hidden('club_id', array("value" => $clubs[0]['Club']["id"], "id" => "ClubId"));
													else
                                                    echo $this->Form->hidden('club_id', array("value" => $clubs_id['User']["club_id"], "id" => "ClubId"));
													if (isset($clubs[0]['Club']["club_name"]))
                                                    echo $this->Form->input('club_name', array("value" => $clubs[0]['Club']["club_name"], "class" => "input-medium", "label" => false));
													else
                                                    echo $this->Form->input('club_name', array("value" => "", "class" => "input-medium", "label" => false));
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
                                    <ul class="venueSettingsInputs last">
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
                                                &nbsp;&nbsp;&nbsp;
                                                <?php // $this->Form->button("submit", array("id" => "sub",'class'=>'btn btn-success')); ?>
                                                <!--<a href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="" class="alert-gry">?</a>-->
                                            </div>


                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="row-fluid">
                                <div class="span12">
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
                                    <input type="button" name="submit" value="Submit" class="btn btn-success" id="sub_new">
                                </div>
                            </div>
                            <div class="row-fluid">
                                <div class="form-group">
                                    <label class="span8">Add Venue Photos (Maximum of 8)</label>
                                </div>
                            </div>
                            <div class="row-fluid">
                                <div class="form-group">
                                    <?php echo $this->Utility->uploader($clubs, "Photo", $photos); ?>
                                </div>
                            </div>

                            <div id="profile_img" class="row-fluid row-items">
								<?php $this->Utility->profile_image($profile_photo, $photos); ?>  
                            </div>

                        </div>
                        <div class="clear">&nbsp;</div>
                        <div class="basickInfirmation">
                            <h4>Days Open</h4>
                        </div>
                        <div class="row-fluid">
                            <div class="row-fluid">
                                <div class="span12">
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
                            <div id="EditModal">
                                <?php echo $this->Utility->Editmodal($clubExceptions); ?>
                            </div>
                            <div class="row-fluid">
                                <br>
                                <div class="row-fluid">
                                    <div class="span12">
                                        <?php echo $this->Utility->exceptionLoad($clubExceptions); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" id="clubExceptionID" value="" />
                    </div>
                    <div class="rignt-contain-phons">
                        <div class="phoneView">
                            <div class="row-fluid">
                                <div class="span12">
                                    <div class="btn-bar">
                                        <a href="#" class="btn btnBack"><img src="<?php echo $this->webroot; ?>img/iconBack.png" width="18" height="12" ></a>
                                        <h1 class="btnTitle"><a href="#" >Bootsy Bellows</a></h1>
                                    </div>
                                </div>
                            </div>
                            <div class="row-fluid">
                                <div class="span12">
                                    <div class="phoneBanner">
                                        <img src="<?php echo $this->webroot; ?>img/phoneBanner.jpg" width="203" height="120" >
                                    </div>
                                    <div class="phoneBannerCaps">
                                        <h3>Lorem Ipsum is simply dummy text of the printing and typesetting</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="row-fluid">
                                <div class="span12">
                                    <div class="phoneDateCaps">
                                        <h3>Lorem Ipsum is simply dummy text of the printing and typesetting</h3>
                                    </div>
                                    <div class="phoneDateBar">
                                        <ul>
                                            <li>
                                                <h2>Date :</h2>
                                                <h1>Mar 09</h1>
                                            </li>
                                            <li>
                                                <h2>Doors :</h2>
                                                <h1>8:00PM</h1>
                                            </li>
                                            <li>
                                                <h2>Club :</h2>
                                                <h1>DANCE</h1>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="phoneBtn">
                                        <a href="#" class="btn  btn-block btn-primary btn-inverse">BOOK IT</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</cake:nocache>
<!-- Footer -->
<?php echo $this->element("footer_Club"); ?>