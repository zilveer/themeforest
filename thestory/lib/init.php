<?php
/**
 * INIT - Inits the main functionality of the Pexeto theme library. This file includes:
 * - including the main files that are required for the library
 * - initializing valriables and constants that will be used globally in the library files
 */

global $pagenow;

require_once 'utils/aq_resizer.php';

//general functionality
if(is_admin()){

	require_once 'utils/class-tgm-plugin-activation.php';
	require_once 'admin-scripts-and-styles.php';
	require_once 'ajax.php';
	require_once 'demo-importer/class-pexeto-import-manager.php';

	if($pagenow!='update-core.php'){
		require_once 'class-pexeto-update-notifier.php';
	}
}
require_once 'functions-general.php';
require_once 'class-pexeto-order-manager.php';
require_once 'class-pexeto-data-fields.php';
require_once 'class-pexeto-widgets-builder.php';


//meta
require_once 'meta/class-pexeto-meta.php';
require_once 'meta/class-pexeto-meta-builder.php';
require_once 'meta/class-pexeto-meta-manager.php';


//custom pages
require_once 'custom-pages/class-pexeto-custom-page.php';
if(is_admin()){
	require_once 'custom-pages/class-pexeto-custom-page-ajax.php';
}


//options
require_once 'options/class-pexeto-options.php';
require_once 'options/class-pexeto-options-builder.php';
require_once 'options/class-pexeto-options-manager.php';
require_once 'theme-customizer/class-pexeto-theme-customizer.php';


if (is_admin() && isset($_GET['activated'] ) && $pagenow == "themes.php" ) {
    //Redirect to the options page if the theme has been just activated
    header( 'Location: '.admin_url().'admin.php?page='.PEXETO_OPTIONS_PAGE.'&activated=true' ) ;
}
