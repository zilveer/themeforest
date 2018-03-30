<?php
/**
 * Start Theme Options
 * -----------------------------------------------------------------------------
 */

// Setting dev mode to true allows you to view the class settings/info in the panel.
// Default: true
$args['dev_mode'] = false;

// Set the class for the dev mode tab icon.
// This is ignored unless $args['icon_type'] = 'iconfont'
// Default: null
$args['dev_mode_icon_class'] = 'icon-large';

// Set a custom option name. Don't forget to replace spaces with underscores!
$args['opt_name'] = 'oi_options';

// Setting system info to true allows you to view info useful for debugging.
// Default: false
//$args['system_info'] = true;

$theme = wp_get_theme();

$args['display_name'] = $theme->get('Name');
//$args['database'] = "theme_mods_expanded";
$args['display_version'] = $theme->get('Version');

// If you want to use Google Webfonts, you MUST define the api key.
$args['google_api_key'] = 'AIzaSyAX_2L_UzCDPEnAHTG7zhESRVpMPS4ssII';

// Define the option panel stylesheet. Options are 'standard', 'custom', and 'none'
// If only minor tweaks are needed, set to 'custom' and override the necessary styles through the included custom.css stylesheet.
// If replacing the stylesheet, set to 'none' and don't forget to enqueue another stylesheet!
// Default: 'standard'
//$args['admin_stylesheet'] = 'standard';

// Set the class for the import/export tab icon.
// This is ignored unless $args['icon_type'] = 'iconfont'
// Default: null
$args['import_icon_class'] = 'icon-large';

/**
 * Set default icon class for all sections and tabs
 * @since 3.0.9
 */
$args['default_icon_class'] = 'icon-large';


// Set a custom menu icon.
//$args['menu_icon'] = '';

// Set a custom title for the options page.
// Default: Options
$args['menu_title'] = __('Theme Options', "orangeidea");

// Set a custom page title for the options page.
// Default: Options
$args['page_title'] = __('Theme Options', "orangeidea");

// Set a custom page slug for options page (wp-admin/themes.php?page=***).
// Default: redux_options
$args['page_slug'] = 'redux_options';

$args['default_show'] = true;
$args['default_mark'] = '*';

add_filter('redux/options/oi_options/compiler', 'compiler_action', 10, 3);
// Add HTML before the form.
if (!isset($args['global_variable']) || $args['global_variable'] !== false ) {
	if (!empty($args['global_variable'])) {
		$v = $args['global_variable'];
	} else {
		$v = str_replace("-", "_", $args['opt_name']);
	}
	$args['intro_text'] = sprintf( __('<p>Welcome to the <strong>BUILDER THEME</strong> options panel!</p>', "orangeidea" ), $v );
} else {
	$args['intro_text'] = __('<p>This text is displayed above the options panel. It isn\'t required, but more info is always better! The intro_text field accepts all HTML.</p>', "orangeidea");
}

$sections = array();              

//Background Patterns Reader
$sample_patterns_path = ReduxFramework::$_dir . '../sample/patterns/';
$sample_patterns_url  = ReduxFramework::$_url . '../sample/patterns/';

/*$sample_patterns_path = get_template_directory_uri() . '/img/bg/';
$sample_patterns_url = get_template_directory_uri() . '/img/bg/';*/

$ct_bg_type = array( "none" => "None" , "upload" => "Upload" , "predefined" => "Predefined" );
$ct_bg_repeat = array( "repeat" => "repeat" , "repeat-x" => "repeat-x", "repeat-y" => "repeat-y", "no-repeat" => "no-repeat" );
$ct_bg_position = array( "top left" => "top left", "top center" => "top center", "top right" => "top right", "center left" => "center left", "center center" => "center center", "center right" => "center right", "bottom left" => "bottom left", "bottom center" => "bottom center", "bottom right" => "bottom right");
$ct_type_animation = array( "fade" => "Fade", "scale_up" => "Scale Up", "scale_down" => "Scale Down", "slide_top" => "Slide Top", "slide_bottom" => "Slide Bottom", "slide_right" => "Slide Right", "slide_left" => "Slide Left" );
$type_of_pagination = array( "standard" => "Standard", "numeric" => "Numeric", "load_more" => "Load More button" );
$type_of_pagination_cat = array( "standard" => "Standard", "numeric" => "Numeric" );

$theme_bg_type = array ( "uploaded" => "Uploaded", "predefined" => "Predefined" , "color" => "Color" );
$theme_bg_attachment = array ( "scroll" => "Scroll" , "fixed" => "Fixed" );
$theme_bg_position = array ( "left" => "Left" , "right" => "Right", "centered" => "Centered" , "full_screen" => "Full Screen" );
$theme_bg_color = array ( "bg_image" => "Background Image", "color" => "Color", "upload" => "Upload" );

$blog_sidebar_position = array ( "Right Sidebar" => "Right Sidebar", "Left Sidebar" => "Left Sidebar");
$sl_port_style = array ( "Random Thumbnails" => "Random Thumbnails", "Standard Thumbnails" => "Standard Thumbnails");



$sample_patterns = array();

if ( is_dir( $sample_patterns_path ) ) :
	
  if ( $sample_patterns_dir = opendir( $sample_patterns_path ) ) :
  	$sample_patterns = array();

    while ( ( $sample_patterns_file = readdir( $sample_patterns_dir ) ) !== false ) {

      if( stristr( $sample_patterns_file, '.png' ) !== false || stristr( $sample_patterns_file, '.jpg' ) !== false ) {
      	$name = explode(".", $sample_patterns_file);
      	$name = str_replace('.'.end($name), '', $sample_patterns_file);
      	$sample_patterns[] = array( 'alt'=>$name,'img' => $sample_patterns_url . $sample_patterns_file );
      }
    }
  endif;
endif;






$theme_path_images = get_template_directory_uri() . '/framework/images/';

















$theme_path_images = get_template_directory_uri() . '/framework/images/';
/**************************/
//THEME OPTIONS
/**************************/
$uri = get_template_directory();
include($uri.'/theme-options/options/general.php');
include($uri.'/theme-options/options/top-line.php');
include($uri.'/theme-options/options/logo-menu.php');
include($uri.'/theme-options/options/tag-line.php');
include($uri.'/theme-options/options/typography.php');
include($uri.'/theme-options/options/blog.php');
include($uri.'/theme-options/options/footer.php');
include($uri.'/theme-options/options/footer-i.php');
include($uri.'/theme-options/options/footer-ii.php');
include($uri.'/theme-options/options/bottom_line.php');
include($uri.'/theme-options/options/woo.php');




global $ReduxFramework;
if ( !isset( $tabs ) ) $tabs = 0;
$ReduxFramework = new ReduxFramework($sections, $args, $tabs);

// END Sample Config

function generate_options_css( $newdata ) {
    $smof_data = $newdata;
    $css_dir = get_stylesheet_directory() . '/framework/css/';
    $css_php_dir = get_template_directory() . '/framework/css/';
    ob_start();
    require( $css_php_dir . '/style.php' );
    $css = ob_get_clean();
    global $wp_filesystem;
    WP_Filesystem();
    if ( ! $wp_filesystem->put_contents( $css_dir . '/options.css', $css, 0644 ) ) {
        return true;
    }
}

function oi_theme_css_compiler() {
	global $oi_options;
	generate_options_css( $oi_options );
}

function compiler_action($options, $css, $changed_values) {
    global $wp_filesystem;
 
    $filename = dirname(__FILE__) . '/style.css';
 
    if( empty( $wp_filesystem ) ) {
        require_once( ABSPATH .'/wp-admin/includes/file.php' );
        WP_Filesystem();
    }
 
    if( $wp_filesystem ) {
        $wp_filesystem->put_contents(
            $filename,
            $css,
            FS_CHMOD_FILE // predefined mode settings for WP files
        );
    }
}



add_action('redux-compiler-oi_options', 'oi_theme_css_compiler');