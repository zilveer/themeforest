<?php
/* ---------------------------------------------------------------------------
 * Custom CSS from THeme option panel
 * --------------------------------------------------------------------------- */

if ( ! defined( 'ABSPATH' ) ) exit;

if( ($custom_css = veda_option('layout','customcss-content')) &&  veda_option('layout','enable-customcss')){
	echo stripcslashes( $custom_css )."\n";
}?>