<?php
	
	/*
	*
	*	Swift Framework Main Class
	*	------------------------------------------------
	*	Swift Framework v2.0
	* 	Copyright Swift Ideas 2013 - http://www.swiftideas.net
	*
	*/
	
	include_once( SF_FRAMEWORK_PATH . '/sf-functions.php' );
	
	/* SWIFT PAGE BUILDER
	================================================== */  
	include_once(SF_FRAMEWORK_PATH . '/page-builder/sf-page-builder.php');
	
	
	/* META BOX FRAMEWORK
	================================================== */  
	include_once(SF_FRAMEWORK_PATH . '/meta-box/meta-box.php');
	include_once(SF_FRAMEWORK_PATH . '/meta-boxes.php');
	
	
	/* CUSTOMISER OPTIONS
	================================================== */ 
	require_once (SF_FRAMEWORK_PATH . '/sf-customizer-options.php');
	
	
	/* CONTENT FUNCTIONS
	================================================== */  
	include_once(SF_FRAMEWORK_PATH . '/sf-content-display/sf-template-parts.php');
	include_once(SF_FRAMEWORK_PATH . '/sf-content-display/sf-header.php');
	include_once(SF_FRAMEWORK_PATH . '/sf-content-display/sf-page-heading.php');
	include_once(SF_FRAMEWORK_PATH . '/sf-content-display/sf-blog.php');
	include_once(SF_FRAMEWORK_PATH . '/sf-content-display/sf-portfolio.php');
	include_once(SF_FRAMEWORK_PATH . '/sf-content-display/sf-products.php');
	include_once(SF_FRAMEWORK_PATH . '/sf-content-display/sf-post-formats.php');
	
	
	/* WOOCOMMERCE FILTERS/HOOKS
	================================================== */
	if ( sf_woocommerce_activated() ) {
	    include_once( SF_FRAMEWORK_PATH . '/sf-supersearch.php' );
	}  
	include(SF_FRAMEWORK_PATH . '/sf-woocommerce.php');
	
	
	/* MEGA MENU
	================================================== */
	include_once( SF_FRAMEWORK_PATH . '/sf-megamenu/sf-megamenu.php' );
	
	
	/* SHORTCODES
	================================================== */  
	include(SF_FRAMEWORK_PATH . '/shortcodes.php');
	
	
	/* CUSTOM STYLES
	================================================== */  
	include(SF_FRAMEWORK_PATH . '/sf-custom-styles.php');
	
	
	/* STYLESWITCHER
	================================================== */  
	include(SF_FRAMEWORK_PATH . '/sf-styleswitcher/sf-styleswitcher.php');
	
	
	/* THEME UPDATER FRAMEWORK
	================================================== */  
	require_once(SF_FRAMEWORK_PATH . '/theme_update_check.php');
	$NeighborhoodUpdateChecker = new ThemeUpdateChecker(
	    'neighborhood',
	    'https://kernl.us/api/v1/theme-updates/56547f28b731728f79f6a49c/'
	);
?>