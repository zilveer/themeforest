<?php

/**
 * Set some basic info
 */
function zilla_admin_init()
{
    // Redirect if theme has just been activated
    if(zilla_is_theme_activated()){
    	flush_rewrite_rules();
    	header( 'Location: '. home_url() .'/wp-admin/admin.php?page=zillaframework&activated=true' );
    }
    
    // Enable sessions
    if( !isset( $_SESSION ) ){
        session_start();
    }
    
    // Get theme and framework info
    $data = get_option( 'zilla_framework_options' );
	
    if( is_child_theme() ) {
        $temp_obj = wp_get_theme();
        $theme_obj = wp_get_theme( $temp_obj->get('Template') );
    } else {
        $theme_obj = wp_get_theme();    
    }
    
    $data['theme_name'] = $theme_obj->get('Name');
    $data['theme_version'] = $theme_obj->get('Version');


	$data['framework_version'] = ZILLA_FRAMEWORK_VERSION;
    $data['zilla_framework'] = array();
	update_option( 'zilla_framework_options', $data );
    
    // Incase it is first install and option doesn't exist
    $zilla_values = get_option( 'zilla_framework_values' );
    if( !is_array($zilla_values) ) update_option( 'zilla_framework_values', array() );
}
add_action( 'init', 'zilla_admin_init', 2 );

/**
 * Load admin CSS
 */
function zilla_admin_styles() {
	wp_enqueue_style('zilla_admin_css', ZILLA_URL .'/styles/zilla-admin.css');
	wp_enqueue_style('zilla_jgrowl', ZILLA_URL .'/scripts/jgrowl/jquery.jgrowl.css');
	wp_enqueue_style('farbtastic');
}
add_action('admin_print_styles', 'zilla_admin_styles');
 
/**
 * Load admin JS
 */
function zilla_admin_scripts() {
    wp_register_script('zilla-ajaxupload', ZILLA_URL .'/scripts/ajaxupload.js', array('jquery'));
    wp_enqueue_script('zilla-ajaxupload');  
    wp_register_script('zilla-jgrowl', ZILLA_URL .'/scripts/jgrowl/jquery.jgrowl_min.js', array('jquery'));
    wp_enqueue_script('zilla-jgrowl'); 
    wp_register_script('zilla-framework-admin', ZILLA_URL .'/scripts/zilla-admin.js', array('jquery','farbtastic'));
    wp_enqueue_script('zilla-framework-admin'); 
    wp_enqueue_script('jquery');
    wp_enqueue_style('farbtastic');
}
add_action('admin_enqueue_scripts', 'zilla_admin_scripts');


/**
 * Add the Framework to the menu
 */
function zilla_menu(){
	$zilla_options = get_option('zilla_framework_options');
	$icon = ZILLA_URL .'/images/favicon.png';

	// Theme Options page
    add_object_page( $zilla_options['theme_name'], $zilla_options['theme_name'], 'update_core', 'zillaframework', 'zilla_options_page', $icon );
	add_submenu_page( 'zillaframework', __( 'Theme Options', 'zilla' ), __( 'Theme Options', 'zilla' ), 'update_core', 'zillaframework', 'zilla_options_page' );
	
	// Update Theme page
	$menu_title = __( 'Theme Updates', 'zilla' );
	if($xml = zilla_get_theme_changelog()){
	    
	    $theme_version = '';
	    
	    if( function_exists( 'wp_get_theme' ) ) {
            if( is_child_theme() ) {
                $temp_obj = wp_get_theme();
                $theme_obj = wp_get_theme( $temp_obj->get('Template') );
            } else {
                $theme_obj = wp_get_theme();    
            }
        
            $theme_version = $theme_obj->get('Version');
        } else {
            $template_path = get_template_directory();
            $theme_data = get_theme_data( $template_path . '/style.css' );
            $theme_version = $theme_data['Version'];
        }
        
		if( version_compare( $theme_version, $xml->latest ) == -1 ){
			$menu_title = __( 'Theme Updates <span class="update-plugins count-1"><span class="update-count">1</span></span>', 'zilla' );
		}
	}
	add_submenu_page( 'zillaframework', __( 'Theme Updates', 'zilla' ), $menu_title, 'update_core', 'zillaframework-update', 'zilla_update_page' );

	// Theme Collection page
//	add_submenu_page( 'zillaframework', __( 'More Themes', 'zilla' ), __( 'More Themes', 'zilla' ), 'update_core', 'zillaframework-themes', 'zilla_themes_page' );
	
	// Support link/page
	add_submenu_page( 'zillaframework', __( 'Support Forums', 'zilla'), __('Support Forums', 'zilla'), 'update_core', 'zillaframework-support', 'zilla_support_page');
}
add_action('admin_menu', 'zilla_menu');


/**
 * Output custom styles CSS file
 */
function zilla_link_custom_styles() {
    $output = '';
    if( apply_filters('zilla_custom_styles', $output) ) {
    	$permalink_structure = get_option('permalink_structure');
    	$url = site_url() .'/zilla-custom-styles.css?'. time();
    	if(!$permalink_structure) $url = site_url() .'/?page_id=zilla-custom-styles.css';
        echo '<link rel="stylesheet" href="'. $url .'" type="text/css" media="screen" />' . "\n";
    }
}
add_action( 'wp_head', 'zilla_link_custom_styles', 12 );

/**
 * Create custom styles CSS file
 */
function zilla_create_custom_styles() {
	$permalink_structure = get_option('permalink_structure');
	$show_css = false;

	if($permalink_structure){
		if( !isset($_SERVER['REQUEST_URI']) ){
		    $_SERVER['REQUEST_URI'] = substr($_SERVER['PHP_SELF'], 1);
		    if(isset($_SERVER['QUERY_STRING'])){ $_SERVER['REQUEST_URI'].='?'.$_SERVER['QUERY_STRING']; }
		}
		$url = (isset($GLOBALS['HTTP_SERVER_VARS']['REQUEST_URI'])) ? $GLOBALS['HTTP_SERVER_VARS']['REQUEST_URI'] : $_SERVER["REQUEST_URI"];
		if(preg_replace('/\\?.*/', '', basename($url)) == 'zilla-custom-styles.css') $show_css = true;
	} else {
		if(isset($_GET['page_id']) && $_GET['page_id'] == 'zilla-custom-styles.css') $show_css = true;
	}

	if($show_css){
	    $output = '';
		header('Content-Type: text/css');
		echo apply_filters('zilla_custom_styles', $output);
		exit;
	}
}
add_action( 'init', 'zilla_create_custom_styles' );

?>