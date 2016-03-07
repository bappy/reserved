<div class="row-fluid">
    <div id="page-sidebar-left" class="eqHight">
        <?php
            if (isset($club_name) && !empty($club_name)) {
                    $club_name = $club_name;
                    } else {
                    $club_name = "";
            }			
        ?>
        <div class="page-title">
            <h4>Your Promoter Code <br> <?php echo $data[0]['User']['promoter_code']; ?></h4>
        </div>
    </div>
    <div id="page-content-right" class="eqHight">
        <?php echo $this->element("top"); ?>
        <div class="page-title">
            <h2>Promoting tools</h2>
            <div class="pull-right"></div>
        </div>
        <div class="right-containr">
            <div class="rignt-contain-all">                                
                <div class="row-fluid">
                    <div class="span7">
                        <!-- Go to www.addthis.com/dashboard to customize your tools -->
                        <p>To receive credit as a promoter have people enter in your promoter code:<b><?php echo $data[0]['User']['promoter_code']; ?></b> when signing up for Reserved.</p>
                        <p>As a result, you will earn 5% commissions on all purchases they make from now on AND they will receive 10% off their first bottle using Reserved.</p>
                        <h4>Share the your promoter code with your social connects!</h4>
                        <div class="addthis_sharing_toolbox" data-url="http://www.reservedapp.com/" data-title="Use this promoter code to get discount: <?php echo $data[0]['User']['promoter_code']; ?>"  addthis:title="Use this promoter code to get discount <?php echo $data[0]['User']['promoter_code']; ?>" addthis:title="An Example Title"
     addthis:description="An Example Description"></div>
                    </div>
                </div>	
            </div>
        </div>
    </div>
</div>    

<?php echo $this->element('footer_Club') ?>			
<!-- Go to www.addthis.com/dashboard to customize your tools -->


<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-4f687fd259161236"></script>

<script type="text/javascript">
var addthis_share = {
   url: "http://www.reservedapp.com/"
   title: "Use this promoter code to get discount <?php echo $data[0]['User']['promoter_code']; ?>"
}

</script>
<?php //echo $this->element('footer_Club') ?>