<?php
/**
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2010, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2010, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       cake
 * @subpackage    cake.cake.console.libs.templates.skel.views.layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <?php echo $this->Html->charset(); ?>
        <title>
            <?php echo __('Reserved APP Administrator login:'); ?>
            <?php echo $title_for_layout; ?>
        </title>
        <?php
        echo $this->Html->meta('icon');
        echo $this->Html->css(array('cake.generic','fonts/customfont'));
        echo $scripts_for_layout;
        ?>
    </head>
    <body>
        <div id="container">
            <!--		<div id="header">
                                    <h1><?php echo $this->Html->link(__('CakePHP: the rapid development php framework'), 'http://cakephp.org'); ?></h1>
                            </div>-->
            <div id="content">

			<?php echo $this->Session->flash('flash');?>

                <?php echo $content_for_layout; ?>

            </div>		
        </div>
        <?php //echo $this->element('sql_dump'); ?>
    </body>
</html>