<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 * @package cakephp
 * @name Reserver Layout for Backend
 */
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <script type="text/javascript">var myBaseUrl = '<?php echo $this->base;?>';</script>
    <?php echo $this->element("header"); ?>
    <body>        
        <div id="page-container" class="full-width">
            <?php echo $content_for_layout; ?>
            <?php echo $this->element("footer"); ?>
            <?php //echo $this->element('sql_dump');?>
        </div>
    </body>
</html>