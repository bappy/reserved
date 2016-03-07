<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <?php echo $this->Html->charset(); ?>
        <title>
            <?php echo __('Hooray  APP Administrator login:'); ?>
            <?php echo $title_for_layout; ?>
        </title>
        <?php
        echo $this->Html->meta('icon');
        echo $scripts_for_layout;
        ?>
        <meta name="description" content="RESERVED" />
        <meta name="author" content="RESERVED" />
        <meta name="robots" content="RESERVED" />
        <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1.0" />
        <!-- Icons -->
        <!-- The following icons can be replaced with your own, they are used by desktop and mobile browsers -->
        <link rel="shortcut icon" href="<?php echo $this->webroot; ?>img/favicon.ico" />
        <link rel="apple-touch-icon" href="<?php echo $this->webroot; ?>img/apple-touch-icon.png" />
        <link rel="apple-touch-icon" sizes="57x57" href="<?php echo $this->webroot; ?>img/apple-touch-icon-57x57-precomposed.png" />
        <link rel="apple-touch-icon" sizes="72x72" href="<?php echo $this->webroot; ?>img/apple-touch-icon-72x72-precomposed.png" />
        <link rel="apple-touch-icon" sizes="114x114" href="<?php echo $this->webroot; ?>img/apple-touch-icon-114x114-precomposed.png" />
        <link rel="apple-touch-icon-precomposed" href="<?php echo $this->webroot; ?>img/apple-touch-icon-precomposed.png" />
        <?php echo $this->Html->css(array('fonts/customfont')); ?>
        
        <!-- END Icons -->
    </head>
    <body>
        <div id="page-container" class="full-width">
            <?php echo $this->Session->flash('failue'); ?>
            <?php echo $content_for_layout; ?>
            <?php //echo $this->element('sql_dump'); ?>
        </div>		
    </body>
</html>