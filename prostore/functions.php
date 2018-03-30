<?php
/**
 * Theme Name: proStore
 * Theme URI: http://themeforest.net/user/gnrocks/portfolio
 * Theme demo : http://rchour.net/prostore
 * Description: A WordPress premium theme exclusively for sale on ThemeForest
 *
 * Author: gnrocks
 * Author URI: http://themeforest.net/user/gnrocks
 * License : http://codex.wordpress.org/GPL & http://wiki.envato.com/support/legal-terms/licensing-terms/
 *
 *
 * @package 	proStore/functions.php
 * @file	 	1.2
 */

require_once( get_template_directory() . '/library/theme-admin.php' );
require_once( get_template_directory() . '/library/theme-functions.php' );
require_once( get_template_directory() . '/library/theme-setup.php' );
require_once( get_template_directory() . '/library/theme-sidebar.php' );
require_once( get_template_directory() . '/library/theme-script.php' );
require_once( get_template_directory() . '/library/theme-seo.php' );
require_once( get_template_directory() . '/library/dynamic_css.php');
require_once( get_template_directory() . '/library/dynamic_js.php');
require_once( get_template_directory() . '/library/shortcodes/core.php');
require_once( get_template_directory() . '/library/theme-custom-post-type.php' );
require_once( get_template_directory() . '/library/metaboxes/metabox.php');
require_once( get_template_directory() . '/library/shortcodes/tinymce/tinymce.php');
include( get_template_directory() . '/library/widgets/adspace.php' );
include( get_template_directory() . '/library/widgets/flickr.php' );
include( get_template_directory() . '/library/widgets/portfolio.php' );
include( get_template_directory() . '/library/widgets/social-counter.php' );
include( get_template_directory() . '/library/widgets/video.php' );
include( get_template_directory() . '/library/widgets/twitter.php' );
include( get_template_directory() . '/library/widgets/testimonials.php' );
if(plugin_is_active('woocommerce/woocommerce.php')=="activated") {
	require_once( get_template_directory() . '/library/theme-woocommerce.php');
}