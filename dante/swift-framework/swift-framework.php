<?php

	/*
	*
	*	Swift Framework Main Class
	*	------------------------------------------------
	*	Swift Framework v2.0
	* 	Copyright Swift Ideas 2016 - http://www.swiftideas.net
	*
	*/

	$options = get_option('sf_dante_options');
	$disable_spb = false;
	if (isset($options['disable_spb']) && $options['disable_spb'] == 1) {
	$disable_spb = true;
	}


	/* SWIFT FUNCTIONS
	================================================== */
	include_once(SF_FRAMEWORK_PATH . '/sf-functions.php');


	/* CUSTOM POST TYPES
	================================================== */
	require_once(SF_FRAMEWORK_PATH . '/custom-post-types/portfolio-type.php');
	require_once(SF_FRAMEWORK_PATH . '/custom-post-types/gallery-type.php');
	require_once(SF_FRAMEWORK_PATH . '/custom-post-types/team-type.php');
	require_once(SF_FRAMEWORK_PATH . '/custom-post-types/clients-type.php');
	require_once(SF_FRAMEWORK_PATH . '/custom-post-types/testimonials-type.php');
	require_once(SF_FRAMEWORK_PATH . '/custom-post-types/jobs-type.php');
	require_once(SF_FRAMEWORK_PATH . '/custom-post-types/faqs-type.php');
	require_once(SF_FRAMEWORK_PATH . '/custom-post-types/sf-post-type-permalinks.php');


	/* SWIFT PAGE BUILDER
	================================================== */
	if (!$disable_spb) {
	include_once(SF_FRAMEWORK_PATH . '/page-builder/sf-page-builder.php');
	}


	/* WOOCOMMERCE FILTERS/HOOKS
	================================================== */
	include_once(SF_FRAMEWORK_PATH . '/sf-woocommerce.php');


	/* SHORTCODES
	================================================== */
	include_once(SF_FRAMEWORK_PATH . '/shortcodes.php');


	/* MEGA MENU
	================================================== */
	include_once(SF_FRAMEWORK_PATH . '/sf-megamenu/sf-megamenu.php');


	/* SUPER SEARCH
	================================================== */
	if (sf_woocommerce_activated()) {
	include_once(SF_FRAMEWORK_PATH . '/sf-supersearch.php');
	}


	/* WIDGETS
	================================================== */
	include_once(SF_FRAMEWORK_PATH . '/widgets/widget-twitter.php');
	include_once(SF_FRAMEWORK_PATH . '/widgets/widget-flickr.php');
	include_once(SF_FRAMEWORK_PATH . '/widgets/widget-video.php');
	include_once(SF_FRAMEWORK_PATH . '/widgets/widget-posts.php');
	include_once(SF_FRAMEWORK_PATH . '/widgets/widget-portfolio.php');
	include_once(SF_FRAMEWORK_PATH . '/widgets/widget-portfolio-grid.php');
	include_once(SF_FRAMEWORK_PATH . '/widgets/widget-advertgrid.php');
	include_once(SF_FRAMEWORK_PATH . '/widgets/widget-infocus.php');
	include_once(SF_FRAMEWORK_PATH . '/widgets/widget-comments.php');


	/* TEXT DOMAIN
	================================================== */
	load_theme_textdomain( 'swift-framework-admin', get_template_directory() . '/swift-framework/language' );

?>