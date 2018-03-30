<?php

/*
Loading the Curvy Slider
This file will be included in the add_action('init','xr_options_load') function. That function exists in the options_loader.php

*/

//Define globals
define('CURVY_DIR',get_template_directory().'/rock-options/curvy-slider/');
define('CURVY_URI',get_template_directory_uri().'/rock-options/curvy-slider/');
define('CURVY_USER_CAPABILITY','manage_options');

include_once(CURVY_DIR.'curvy_functions.php');

if ( !(defined( 'WP_ADMIN' ) && WP_ADMIN ) &&  !( defined( 'DOING_AJAX' ) && DOING_AJAX )) return;


//Curvy Standalone version
//define('CURVY_STANDALONE',true);

//Load files only for admin
function curvy_slider_load(){
	//Only load settings page if the user is admin
	global $pagenow;
	

	if($pagenow == 'admin.php' && isset($_REQUEST['page']) && $_REQUEST['page'] == 'curvy_slider'){
		
		$current_slider_id = isset($_REQUEST['editSliderID']) ? $_REQUEST['editSliderID'] : false;
		$duplicate_slider_id = isset($_REQUEST['duplicateSliderID']) ? $_REQUEST['duplicateSliderID'] : false;
		$add_new_slider_id = isset($_REQUEST['addSliderID']) ? $_REQUEST['addSliderID'] : false;
		
		if($current_slider_id !== false || $duplicate_slider_id !== false || $add_new_slider_id !== false){		
		wp_enqueue_script('json', CURVY_URI.'js/json2.js', array('javascript'), '');
		
		//Wordpress default jquery ui and jquery ui slider does not work properly. Thus we load jquery ui custom for jquery ui slider
		wp_enqueue_style( 'jquery-ui-css', CURVY_URI.'css/smoothness/jquery-ui-1.9.1.custom.css', '', '', 'all' );
		
		//jQuery UI
		wp_enqueue_script('jquery-ui-core');
		
		
		//load wordpress's new colorpicker
		wp_enqueue_style( 'wp-color-picker' );
		wp_enqueue_script('wp-color-picker');
		wp_enqueue_media();
		
		$http = is_ssl() ? 'https' : 'http';
		wp_enqueue_script('google-webfont-api', $http.'://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js', array());
		
		//Font Loader
		wp_enqueue_style( 'google-fonts-js-css', CURVY_URI.'google-fonts-loader/fontselect.css', '', '', 'all' );
		wp_enqueue_script('google-fonts-js', CURVY_URI.'google-fonts-loader/jquery.fontselect.min.js', array(), '');
		
		wp_enqueue_script('rockthemes-curvy-slider-caat', CURVY_URI.'js/caat.min.js', array('jquery'), '');
		wp_enqueue_script('rockthemes-curvy-slider', CURVY_URI.'js/curvy-slider.min.js', array('jquery', 'google-webfont-api'), '');
		}
		
		//FontAwesome 
		wp_enqueue_style('font-awesome-css',  CURVY_URI.'css/font-awesome.min.css', '','', 'all');

		wp_enqueue_style('rockthemes-curvy-slider-foundation',  CURVY_URI.'css/foundation-curvy-admin.css', '','', 'all');
		wp_enqueue_style('rockthemes-curvy-slider-style',  CURVY_URI.'css/curvy-slider-style.css', '','', 'all');
	
		include_once(CURVY_DIR.'curvy_slider_ui.php');
	}
	
}
add_action('admin_init','curvy_slider_load');

include_once(CURVY_DIR.'curvy-slider-import-export.php');



//Register Curvy Slider in Menu
add_action( 'admin_menu', 'curvy_slider_add_menu' ); 

function curvy_slider_add_menu() {
	$user_can = 'manage_options';
	
	add_menu_page( 'RockThemes Curvy Slider', 'Curvy Slider', $user_can, 'curvy_slider', 'curvy_slider_do_ui', CURVY_URI.'images/cury-slider-wp-icon.png' );
	
	add_submenu_page( 
			  'curvy_slider' 
			, 'Import / Export' 
			, 'Import / Export'
			, $user_can
			, 'curvy_slider_i_e'
			, 'curvy_slider_import_export_ui'
		);
}


?>