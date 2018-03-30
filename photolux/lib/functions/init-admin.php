<?php
/**
 * This file contain some general functions:
 * -enqueuing CSS and JS files
 * -inserting the JavaScript init code into the head
 *
 * @author Pexeto
 */


/**
 * ADD THE ACTIONS
 */
add_action('admin_enqueue_scripts', 'pexeto_admin_init');
add_action('admin_head', 'pexeto_admin_head_add');
add_action('admin_menu', 'pexeto_add_theme_menu');

/**
 * Enqueues the JavaScript files needed depending on the current section.
 */
function pexeto_admin_init(){
	global $current_screen, $pexeto_data;

	if($current_screen->base=='post'){
		//enqueue the script and CSS files for the TinyMCE editor formatting buttons and Upload functionality
		wp_enqueue_script('jquery');
		wp_enqueue_script('jquery-ui-dialog');
		wp_enqueue_script('pexeto-colorpicker',PEXETO_SCRIPT_URL.'colorpicker.js');
		wp_enqueue_script('pexeto-page-options',PEXETO_SCRIPT_URL.'page-options.js');

		//set the style files
		add_editor_style('lib/formatting-buttons/custom-editor-style.css');
		wp_enqueue_style('pexeto-page-style',PEXETO_CSS_URL.'page_style.css');
		wp_enqueue_style('pexeto-colorpicker-style',PEXETO_CSS_URL.'colorpicker.css');

		wp_enqueue_media();
	}

	if(isset($_GET['page']) && $_GET['page']==PEXETO_OPTIONS_PAGE){
		//enqueue the scripts for the Options page
		wp_enqueue_script('jquery');
		wp_enqueue_script('jquery-ui-core');
		wp_enqueue_script('jquery-ui-sortable');
		wp_enqueue_script('jquery-ui-dialog');
		wp_enqueue_script('pexeto-jquery-co',PEXETO_SCRIPT_URL.'jquery-co.js');
		wp_enqueue_script('pexeto-colorpicker',PEXETO_SCRIPT_URL.'colorpicker.js');
		wp_enqueue_script('pexeto-page-options',PEXETO_SCRIPT_URL.'page-options.js');
		wp_enqueue_script('pexeto-options',PEXETO_SCRIPT_URL.'options.js');

		//enqueue the styles for the Options page
		wp_enqueue_style('pexeto-admin-style',PEXETO_CSS_URL.'admin_style.css');
		wp_enqueue_style('pexeto-colorpicker-style',PEXETO_CSS_URL.'colorpicker.css');

		wp_enqueue_media();
	}

	if(isset($_GET['page']) && (in_array($_GET['page'], $pexeto_data->custom_posttypes) || $_GET['page']==PEXETO_PORTFOLIO_POST_TYPE)){
		wp_enqueue_script('jquery');
		wp_enqueue_script('jquery-ui-core');
		wp_enqueue_script('jquery-ui-widget');
		wp_enqueue_script('jquery-ui-sortable');
		wp_enqueue_script('jquery-ui-dialog');
		wp_enqueue_script('pexeto-page-options',PEXETO_SCRIPT_URL.'page-options.js');
		wp_enqueue_script('pexeto-custom-page',PEXETO_SCRIPT_URL.'custom-page.js');
		//enqueue the styles for the Options page
		wp_enqueue_style('pexeto-admin-style',PEXETO_CSS_URL.'custom_page.css');
		wp_enqueue_style('jquery-ui-dialog');

		wp_enqueue_media();
	}


	if(isset($_GET['page']) && ($_GET['page']=='theme-update-notifier')){
		//enqueue the scripts for the Update notifier page
		wp_enqueue_script('jquery');
		wp_enqueue_script('jquery-ui-dialog');
		wp_enqueue_script('pexeto-update',PEXETO_SCRIPT_URL.'update-notifier.js');

		//enqueue the styles for the Update notifier page
		wp_enqueue_style('pexeto-update-style',PEXETO_CSS_URL.'update-notifier.css');
		wp_enqueue_style('pexeto-admin-style',PEXETO_CSS_URL.'custom_page.css');
	}

	if ( strpos( $current_screen->base, PexetoOrderManager::slug ) ) {
		//it is a custom order page
		wp_enqueue_script('jquery');
		wp_enqueue_script('jquery-ui-core');
		wp_enqueue_script('jquery-ui-sortable');
		wp_enqueue_script('jquery-ui-widget');
		wp_enqueue_script('underscore');
		wp_enqueue_script('pexeto-custom-order', PEXETO_SCRIPT_URL.'custom-order.js', array(
		'jquery',
		'jquery-ui-core',
		'jquery-ui-widget',
		'jquery-ui-sortable',
		'underscore' ) );

		wp_enqueue_style('pexeto-custom-order-style', PEXETO_CSS_URL.'custom-order.css');
	}
}

if (is_admin() && isset($_GET['activated'] ) && $pagenow == "themes.php" ) {
    //Do redirect
    header( 'Location: '.admin_url().'admin.php?page='.PEXETO_OPTIONS_PAGE.'&activated=true' ) ;
}


/**
 * Inserts scripts for initializing the JavaScript functionality for the relevant section.
 */
function pexeto_admin_head_add(){
	
	//create JavaScript variables that will be accessible globally from all scripts
	if(isset($_GET['page']) && $_GET['page']==PEXETO_OPTIONS_PAGE){
		//init the options js functionality
		echo '<script>jQuery(document).ready(function($) {
				pexetoOptions.init({cookie:true});
		});</script>';
	}
}

/**
 * Add the main setting menu for the theme.
 */
function pexeto_add_theme_menu(){
	add_menu_page( PEXETO_THEMENAME, PEXETO_THEMENAME, 'edit_theme_options', PEXETO_OPTIONS_PAGE, 'pexeto_theme_admin', PEXETO_LIB_URL.'/images/pex_icon.png');
	add_submenu_page(PEXETO_OPTIONS_PAGE, PEXETO_THEMENAME." Settings", "".PEXETO_THEMENAME." Options", 'edit_theme_options', PEXETO_OPTIONS_PAGE, 'pexeto_theme_admin');
}



function pexeto_print_admin_scripts(){
	
	$script = '<script type="text/javascript">var PEXETO = PEXETO || {};</script>';
	echo $script;
}

add_action( 'admin_print_scripts', 'pexeto_print_admin_scripts' );



if ( !function_exists( 'pexeto_init_portfolio_custom_order' ) ) {
	/**
	 * Registers an order manager to add an easy order functionality to the
	 * portfolio items.
	 */
	function pexeto_init_portfolio_custom_order() {
		$order_manager = new PexetoOrderManager( PEXETO_PORTFOLIO_POST_TYPE );
		$order_manager->init();
	}
}

if ( is_admin() ) {
	pexeto_init_portfolio_custom_order();
}