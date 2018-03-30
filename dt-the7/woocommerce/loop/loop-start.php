<?php
/**
 * Product Loop Start
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/loop-start.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woothemes.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

do_action( 'dt_wc_loop_start' );

do_action( 'presscore_before_loop' );

// fullwidth wrap open
if ( presscore_config()->get( 'full_width' ) ) { echo '<div class="full-width-wrap">'; }

// masonry container open
echo '<div ' . presscore_masonry_container_class( array( 'wf-container', 'woo-hover' ) ) . presscore_masonry_container_data_atts() . '>';
