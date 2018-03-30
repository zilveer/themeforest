<?php
/**
 * Setup theme specific admin functions
 *
 * WARNING: This file is part of the PrimaShop parent theme.
 * Please do all modifications in the form of a child theme.
 *
 * @category   PrimaShop
 * @package    Setup
 * @subpackage Admin
 * @author     PrimaThemes
 * @link       http://www.primathemes.com
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

add_action( 'admin_notices', 'prima_child_theme_style_check_v17' );
function prima_child_theme_style_check_v17() {
    if ( is_child_theme() ) {
    	$style = file_get_contents( THEME_DIR . '/style.css' );
    	$style_check = strpos( $style, '@import url("../primashop-wc/style.css");' );
    	if ( $style_check !== false ) {
			echo '<div class="notice-error error"><p>';
			printf( __( 'Please remove %s from %s file in your child theme directory. <br/> It will be auto-loaded from parent theme for better performance.', 'primathemes' ), '<code>@import url("../primashop-wc/style.css");</code>', 'style.css' );
			echo '</p></div>';
		}
    	$style_res = file_get_contents( THEME_DIR . '/style-responsive.css' );
    	$style_res_check = strpos( $style_res, '@import url("../primashop-wc/style-responsive.css");' );
    	if ( $style_res_check !== false ) {
			echo '<div class="notice-error error"><p>';
			printf( __( 'Please remove %s from %s file in your child theme directory. <br/> It will be auto-loaded from parent theme for better performance.', 'primathemes' ), '<code>@import url("../primashop-wc/style-responsive.css");</code>', 'style-responsive.css' );
			echo '</p></div>';
		}
    }
}
