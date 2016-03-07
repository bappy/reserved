<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <title>Reserved APP Administrator login</title>
        <meta name="robots" content="noindex, nofollow">
        
        
        <?php
        echo $this->Html->meta('icon');
        ?>
        <!-- Stylesheets -->
        <!-- The roboto font is included from Google Web Fonts -->
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,400italic,700,700italic">



        <?php
        echo $this->Html->css('cake.generic');
        //echo $this->Html->css(array('bootstrap', 'main','plugin','themes'));
        echo $scripts_for_layout;
        ?>

     
    </head>

    <body class="login">      

        <?php echo $content_for_layout; ?>



        <!-- Bootstrap.js -->
        
<?php
       // echo $this->Html->script(array('bootstrap.min',));
       ?>

        <!-- Javascript code only for this page -->
        
        <?php //echo $this->element('sql_dump'); ?>
    </body>
</html>