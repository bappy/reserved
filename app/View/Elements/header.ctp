<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 * @package cakephp
 * @name Header for Reserver Layout for Backend
 */
?>
<head>
    <meta charset="utf-8">
    <title>
        <?php
        echo $title_for_layout;
        ?>
    </title>
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
    <!-- END Icons -->
    <!-- Stylesheets -->
    <!-- Bootstrap is included in its original form, unaltered -->
    <?php echo $this->Html->css('bootstrap'); ?>
    <!-- Related styles of various icon packs and javascript plugins -->
    <?php echo $this->Html->css('plugins'); ?>
    <!-- The main stylesheet of this template. All Bootstrap overwrites are defined in here -->
    <?php echo $this->Html->css('main'); ?>
    <!-- Load a specific file here from css/themes/ folder to alter the default theme of all the template -->
    <!-- The themes stylesheet of this template (for using specific theme color in individual elements (must included last) -->
    <?php echo $this->Html->css('themes'); ?>
    <!-- The main castom stylesheet of this admin. kb-->
    <?php echo $this->Html->css('castom'); ?>
    <!-- The fonts stylesheet of admin. kb -->
    <?php //echo $this->Html->css('fonts/customfont'); ?>
    <!-- END Stylesheets -->
    <!-- ISO CHECK BOX -->
    <?php //echo $this->Html->css('bootstrap-switch'); ?>
    <?php echo $this->Html->css('utility'); ?>
    <?php echo $this->Html->css('developers-custom'); ?>
    <!-- END ISO CHECK BOX -->
    <?php echo $this->Html->script(array('jquery-1.10.2.min')); ?>
    <?php echo $this->Html->css(array('fonts/customfont')); ?>
    <?php echo $scripts_for_layout; ?>
</head>