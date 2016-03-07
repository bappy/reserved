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
        if (!empty($title_for_layout)):
            echo $title_for_layout;
        else:
            echo "Promoter";
        endif;
        ?>
    </title>
    <meta name="description" content="RESERVED" />
    <meta name="author" content="RESERVED" />
    <meta name="robots" content="RESERVED" />
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1.0" />
    <!-- Icons -->
    <!-- The following icons can be replaced with your own, they are used by desktop and mobile browsers -->
    <link rel="shortcut icon" href="<?php echo $this->webroot; ?>img/favicon.ico" />
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
    <?php echo $this->Html->css('developers-custom'); ?>
    <?php echo $this->Html->script(array('jquery-1.10.2.min', 'vendor/modernizr-2.6.2-respond-1.1.0.min', 'vendor/bootstrap.min')); ?>
    <?php echo $scripts_for_layout; ?>
</head>