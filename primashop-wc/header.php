<?php
/**
 * The template for displaying header. 
 *
 * WARNING: This file is part of the PrimaShop parent theme.
 * Please do all modifications in the form of a child theme.
 *
 * @category PrimaShop
 * @package  Templates
 * @author   PrimaThemes
 * @link     http://www.primathemes.com
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

do_action( 'prima_html_before' );

?><!DOCTYPE html>
<!--[if lt IE 7]>
<html class="ie6 oldie" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 7]>
<html class="ie7 oldie" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie8 oldie" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 6) | !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
<?php wp_head(); ?>
</head>

<body <?php body_class('no-js'); ?>>
  
<?php do_action( 'prima_before' ); ?>

  <div id="container" class="sb-site-container site-container">
  <div class="container-inner group">

  <?php do_action( 'prima_header' ); ?>
