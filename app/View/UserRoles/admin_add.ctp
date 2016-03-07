<?php
echo $this->Html->script(array('jquery-1.10.2.min.js', "ui/jquery.ui.core", "ui/jquery.ui.widget", "ui/jquery.ui.datepicker", 'basic/js/jquery.simplemodal', 'clubsettings', 'vendor/modernizr-2.6.2-respond-1.1.0.min', 'vendor/js/bootstrap-switch', 'docs/vendor/prism', 'docs/index'));
//echo $this->Html->script(array('jquery-1.10.2.min.js','uploadify/js/jquery.uploadify.min', "ui/jquery.ui.core", "ui/jquery.ui.widget", "ui/jquery.ui.datepicker", 'basic/js/jquery.simplemodal', 'basic/js/basic', 'vendor/modernizr-2.6.2-respond-1.1.0.min', 'vendor/js/bootstrap-switch', 'docs/index'));
echo $this->Html->css(array("http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css", 'bootstrap', 'plugins', 'main', 'themes', 'castom', 'bootstrap-switch', 'http://netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css', 'http://bdmdesign.github.io/bootstrap-switch/static/stylesheets/flat-ui-fonts.css', 'fonts/customfont', 'basic/css/basic', 'developers-custom'));
echo $this->Html->css(array('basic/basic', 'basic/basic_ie', 'utility'));
?>

            <!---------------------------------->
            <div class="row-fluid">
                <div id="page-sidebar-left" class="eqHight">
                    <div class="topNav">
                        <ul class="nav">
                            <li><a href="#">RESERVED</a></li>
                        </ul>
                        <div class="clear">&nbsp;</div>
                    </div>
                    <div class="page-title">
                        <h2><?php echo $club_name; ?></h2>
                    </div>
                    <div class="left-containr">
                        <div id="side-tab-menu" class="tab-pane active">
                            <!-- Primary Navigation -->
                            <nav id="primary-nav">
                                <ul>
                                    <li>
                                        <a class="<?php echo (($this->request->controller == 'Clubs')) ? 'active' : ''; ?>" href="<?php echo $this->Html->url(array('controller' => 'Clubs', 'action' => 'add')); ?>"><i class="glyphicon-cogwheels"></i>Club Setting</a>
                                    </li>
                                    <li>
                                        <a class="<?php echo (($this->request->controller == 'UserRoles')) ? 'active' : ''; ?>" href="<?php echo $this->Html->url(array('controller' => 'UserRoles', 'action' => 'add')); ?>"><i class="glyphicon-vcard"></i>Account Settings<i class="halflingicon-plus pull-right"></i></a>
                                    </li>
                                    <li>
                                        <a class="<?php echo (($this->request->controller == 'Users')) ? 'active' : ''; ?>" href="<?php echo $this->Html->url(array('controller' => 'Users', 'action' => 'index')); ?>"><i class="glyphicon-old_man"></i>Account</a>
                                    </li>

                                </ul>
                            </nav>
                            <!-- END Primary Navigation -->
                        </div>
                    </div>
                </div>
                <div id="page-content-right" class="eqHight">
                    <?php echo $this->element("top"); ?>
                    <div class="page-title">
                        <h2>New User</h2>
                        <div class="pull-right">
                            <form class="form-inline">
                                <label class="checkbox">
                                    <a href="#">Reset Password</a> &nbsp;&nbsp;
                                </label>
                            </form>
                        </div>
                    </div>
                    <div class="basickInfirmation">
                        <h4>User Details</h4>
                    </div>
                    <?php echo $this->Form->create('UserRole'); ?>
                    <div class="right-containr">
                        <div class="rignt-contain-all">
                            <div class="row-fluid">
                                <div class="span8">
                                    <div class="row-fluid">
                                        <div class="span6">
                                            <div class="form-group">
                                                <label class="span3" for="inputUsernameName">First Name :</label>
                                                <?php
                                                echo $this->Form->input('User.first_name', array("class" => "span9", "label" => false));
                                                ?>
                                               <!-- <input type="text" name="" class="span9" placeholder="">-->
                                            </div>
                                        </div>
                                        <div class="span6">
                                            <div class="form-group">
                                                <label class="span3" for="inputUsernameName">Last Name :</label>

                                                <?php
                                                echo $this->Form->input('User.last_name', array("class" => "span9", "label" => false));
                                                ?>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="row-fluid">
                                        <div class="span6">
                                            <div class="form-group">
                                                <label class="span3" for="inputUsernameName">Email :</label>
                                                <?php
                                                echo $this->Form->input('User.email_address', array("class" => "span9", "label" => false));
                                                ?>
                                                <!--<input type="text" name="emailAddress" class="span9" placeholder="">-->
                                            </div>
                                        </div>
                                        <div class="span6">
                                            <div class="form-group">
                                                <label class="span3" for="inputUsernameName">Job Title :</label>
                                                <?php echo $this->Form->input('job_title_id', array('type' => 'select', 'label' => false, 'class' => 'span9', 'div' => false, 'required' => false, 'options' => $job_title_lists, 'empty' => 'Select a Job Title')); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="clearfix">&nbsp;</div>
                                    <div class="row-fluid">
                                        <div class="span3">
                                            <div class="form-group">
                                                <label class="" for="inputUsernameEmail">Access to :</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row-fluid">

                                        <div class="span9 offset2">
                                            <label class="checkbox">
                                                Earnings Page
                                                <?php
                                                echo $this->Form->checkbox('UserRole.0.role_id', array('value' => "Earnings", 'id' => 'create-switch'));
                                                ?>
                                            </label>
                                            <label class="checkbox">
                                                Reservations Page
                                                <?php
                                                echo $this->Form->checkbox('UserRole.1.role_id', array('value' => "Reservations", 'id' => 'create-switch'));
                                                ?>
                                            </label>
                                            <label class="checkbox">
                                                Menu &amp; Pricing Page
                                                <?php
                                                echo $this->Form->checkbox('UserRole.2.role_id', array('value' => "MenuePricing", 'id' => 'create-switch'));
                                                ?>
                                            </label>
                                            <label class="checkbox">
                                                Orders
                                                <?php
                                                echo $this->Form->checkbox('UserRole.3.role_id', array('value' => "Orders", 'id' => 'create-switch'));
                                                ?>

                                            </label>
                                            <label class="checkbox">
                                                Club Settings Page
                                                <?php
                                                echo $this->Form->checkbox('UserRole.4.role_id', array('value' => "Clubs", 'id' => 'create-switch'));
                                                ?>
                                            </label>
                                            <label class="checkbox">
                                                Admin Accounts Page
                                                <?php
                                                echo $this->Form->checkbox('UserRole.5.role_id', array('value' => "UserRoles", 'id' => 'create-switch'));
                                                ?>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="clearfix">&nbsp;</div>
                                    <div class="row-fluid">
                                        <div class="span4">                                            
                                                <b>Create Waitress App Account ?</b>                                            
                                        </div>
                                    </div>
                                    <div class="row-fluid">
                                        <div class="span8 offset1">
                                            <label class="checkbox">
                                                <?php echo $this->Form->checkbox('UserRole.6.role_id', array('value' => "Waitress", 'id' => 'create-switch','div'=>false,'label'=>false));?> <span>This gives waitresses their own Reserved App account for your venue so that they can take customer’s orders through their app. This is necessary for all waitresses to accept orders themselves and is only meant for waitresses.</span></label>
                                        </div>
                                    </div>
                                    <div class="clearfix">&nbsp;</div>
                                    <div class="row-fluid">
                                        <div class="span9">
                                            <div class="form-group">
                                              <!-- <input type="button" class="btn btn-primary pull-right" value="Save">-->
                                                <?php echo $this->Form->button("Submit", array("class" => "btn btn-primary pull-right")); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="clearfix">&nbsp;</div>
                                    <div class="row-fluid">
                                        <div class="span9">
                                            <p class="pull-right"><span class="pull-right">Save Will send the user their login details</span></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php echo $this->Form->end(); ?>
                </div>
            </div>
           
        <!-- END Page Container -->
        <!-- Scroll to top link, check main.js - scrollToTop() -->
        <a href="#" id="to-top"><i class="icon-chevron-up"></i></a>
        <?php echo $this->Html->script(array('jquery-1.9.1', 'build/js/bootstrap-switch', 'docs/vendor/prism', 'docs/index', 'vendor/bootstrap.min', 'vendor/modernizr-2.6.2-respond-1.1.0.min', 'plugins', 'main', "ui/jquery.ui.core")); ?>
        <script type="text/javascript">
            $(function() {
                var dashChart = $('#dashboard-chart');
                var dashMap = $('#dashboard-map');
                var componentHeight = '300px';

                // Initialize Slimscroll
                $('.scrollable').slimScroll({
                    height: componentHeight,
                    color: '#333',
                    size: '10px',
                    alwaysVisible: true,
                    railVisible: true,
                    railColor: '#333',
                    railOpacity: 0.1
                });

                // Initialize Timeline Slimscroll
                $('.timeline-scrollable').slimScroll({
                    height: '500px',
                    color: '#333',
                    size: '10px',
                    alwaysVisible: true,
                    railVisible: true,
                    railColor: '#333',
                    railOpacity: 0.1
                });

                /* Dashboard Timeline - Adding content demostration */
                var timelineSpeed = 300;

                setTimeout(function() {
                    $('<li>' +
                        '<i class="timeline-meta-cat glyphicon-circle_plus themed-background-ocean"></i>' +
                        '<span class="timeline-meta-time">just now</span>' +
                        '<span class="timeline-title">Twitter</span>' +
                        '<span class="timeline-text">+1 Follower</span>' +
                        '</li>').prependTo('.timeline').hide().slideDown(timelineSpeed);
                }, 2000);

                setTimeout(function() {
                    $('<li class="clearfix">' +
                        '<i class="timeline-meta-cat icon-comments themed-background-leaf"></i>' +
                        '<span class="timeline-meta-time">just now</span>' +
                        '<img src="img/template/avatar2.jpg" alt="Avatar" class="timeline-avatar">' +
                        '<span class="timeline-title"><a href="page_ready_user_profile.html">Estelle</a> just commented on an <a href="page_ready_product.html">Product</a></span>' +
                        '<span class="timeline-text">Yes, I like this product too!</span>' +
                        '</li>').prependTo('.timeline').hide().slideDown(timelineSpeed);
                }, 6000);

                setTimeout(function() {
                    $('<li class="clearfix">' +
                        '<i class="timeline-meta-cat glyphicon-picture themed-background-wood"></i>' +
                        '<span class="timeline-meta-time">just now</span>' +
                        '<img src="img/template/avatar.jpg" alt="Avatar" class="timeline-avatar">' +
                        '<span class="timeline-title"><a href="page_ready_user_profile.html">John Doe</a> just added 2 new photos</span>' +
                        '<a href="img/placeholders/image_720x450_light.png" data-toggle="lightbox-image"><img src="img/placeholders/image_160x120_light.png" alt="image"></a> ' +
                        '<a href="img/placeholders/image_720x450_light.png" data-toggle="lightbox-image"><img src="img/placeholders/image_160x120_light.png" alt="image"></a>' +
                        '</li>').prependTo('.timeline').hide().slideDown(timelineSpeed);

                    // Re Initialize Image Popup for new image content
                    $('[data-toggle="lightbox-image"]').magnificPopup({type: 'image'});
                }, 10000);

                setTimeout(function() {
                    $('<li>' +
                        '<i class="timeline-meta-cat glyphicon-circle_plus themed-background-default"></i>' +
                        '<span class="timeline-meta-time">just now</span>' +
                        '<span class="timeline-title">Facebook page</span>' +
                        '<span class="timeline-text">+1 Like</span>' +
                        '</li>').prependTo('.timeline').hide().slideDown(timelineSpeed);
                }, 14000);

                setTimeout(function() {
                    $('<li class="clearfix">' +
                        '<i class="timeline-meta-cat glyphicon-brush themed-background-dawn"></i>' +
                        '<span class="timeline-meta-time">just now</span>' +
                        '<img src="img/template/pixelcave.png" alt="pixelcave" class="timeline-avatar">' +
                        '<span class="timeline-title">Thank you!</span>' +
                        '<span class="timeline-text">This was just a demonstration of how loading updates could happen! You can use all the available color themes as well as any icon for your category!</span>' +
                        '</li>').prependTo('.timeline').hide().slideDown(timelineSpeed);

                    // Remove loading spinner
                    $('#dash-timeline-icon').removeClass('icon-spin').removeClass('icon-spinner').addClass('icon-ok');
                }, 16000);

                /* Dashboard Chart */
                var dashData1 = [[0, 620], [1, 500], [2, 900], [3, 650], [4, 1250], [5, 850], [6, 1700]];
                var dashData2 = [[0, 110], [1, 80], [2, 320], [3, 250], [4, 550], [5, 520], [6, 600]];

                dashChart.css('height', componentHeight);

                // Initialize Classic Chart
                $.plot(dashChart, [
                    {data: dashData1, lines: {show: true, fill: true, fillColor: {colors: [{opacity: 0.25}, {opacity: 0.25}]}}, points: {show: true}, label: 'New Users'},
                    {data: dashData2, lines: {show: true, fill: true, fillColor: {colors: [{opacity: 0.1}, {opacity: 0.1}]}}, points: {show: true}, label: 'New Projects'}],
                {
                    legend: {
                        position: 'nw',
                        backgroundColor: null
                    },
                    colors: ['#a8db39', '#333'],
                    grid: {
                        borderWidth: 0,
                        color: '#999999',
                        labelMargin: 10,
                        hoverable: true,
                        clickable: true
                    },
                    yaxis: {
                        ticks: 0,
                        tickColor: '#fff'
                    },
                    xaxis: {
                        tickSize: 1,
                        tickColor: '#fff',
                        ticks: [[0, 'MON'], [1, 'TUE'], [2, 'WED'], [3, 'THU'], [4, 'FRI'], [5, 'SAT'], [6, 'SUN']]
                    }
                }
            );

                // Creating and attaching a tooltip
                var previousPoint = null;
                dashChart.bind("plothover", function(event, pos, item) {

                    $("#x").text(pos.x.toFixed(2));
                    $("#y").text(pos.y.toFixed(2));

                    if (item) {
                        if (previousPoint !== item.dataIndex) {
                            previousPoint = item.dataIndex;

                            $("#tooltip").remove();
                            var x = item.datapoint[0],
                            y = item.datapoint[1];

                            $('<div id="tooltip" class="chart-tooltip"><strong>' + y + '</strong></div>')
                            .css({top: item.pageY - 30, left: item.pageX - 20})
                            .appendTo("body")
                            .show();
                        }
                    }
                    else {
                        $("#tooltip").remove();
                        previousPoint = null;
                    }
                });

                // Initialize general map when tab is shown
                $('a[href="#dashboard-maps"]').on('shown', function() {
                    dashMap.css('height', componentHeight).css('width', '100%');

                    new GMaps({
                        div: '#dashboard-map',
                        lat: 0,
                        lng: 0,
                        zoom: 1
                    });
                });
            });
        </script>
        <!-- ISO CHECK BOX -->
        <!-- END ISO CHECK BOX -->
        <!-- equalHeight JS -->
        <script>
            function equalHeight(group) {
                tallest = 0;
                group.each(function() {
                    thisHeight = $(this).height();
                    if(thisHeight > tallest) {
                        tallest = thisHeight;
                    }
                });
                group.height(tallest);
            }
            $(document).ready(function() {
                equalHeight($(".eqHight"));
            });
        </script>
   