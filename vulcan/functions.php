<?php

/*-----------------------------------------------------------------------------------*/
/* Options Framework Functions
/*-----------------------------------------------------------------------------------*/

/* Set the file path based on whether the Options Framework is in a parent theme or child theme */

define('OF_FILEPATH', get_template_directory());
define('OF_DIRECTORY', get_template_directory_uri());

/* These files build out the options interface.  Likely won't need to edit these. */

require_once (OF_FILEPATH . '/admin/admin-functions.php');		// Custom functions and plugins
require_once (OF_FILEPATH . '/admin/admin-interface.php');		// Admin Interfaces (options,framework, seo)

/* These files build out the theme specific options and associated functions. */

require_once (OF_FILEPATH . '/admin/theme-options.php'); 		// Options panel settings and custom settings

require_once (OF_FILEPATH . '/functions/theme-functions.php'); 	// Theme actions based on options settings
require_once (OF_FILEPATH . '/functions/metabox.php'); 	
require_once (OF_FILEPATH . '/functions/post-types.php'); 	
require_once (OF_FILEPATH . '/functions/theme-widgets.php');
require_once (OF_FILEPATH . '/functions/aqua_resizer.php');
require_once (OF_FILEPATH . '/functions/shortcodes.php');
require_once (OF_FILEPATH . '/functions//tinymce/shortcodes-generator.php');


// Load static framework options pages 
$functions_path = OF_FILEPATH . '/admin/';

function optionsframework_add_admin() {

    global $query_string;
    
    $themename =  get_option('of_themename');      
    $shortname =  get_option('of_shortname'); 
   
    if ( isset($_REQUEST['page']) && $_REQUEST['page'] == 'optionsframework' ) {
		if (isset($_REQUEST['of_save']) && 'reset' == $_REQUEST['of_save']) {
			$options =  get_option('of_template'); 
			of_reset_options($options,'optionsframework');
			header("Location: admin.php?page=optionsframework&reset=true");
			die;
		}
    }
		
    //$of_page = add_submenu_page('themes.php', $themename, 'Theme Options', 'edit_theme_options', 'optionsframework','optionsframework_options_page'); // Default
    $of_page = add_menu_page($themename." Options", $themename, 'edit_themes', 'optionsframework', 'optionsframework_options_page');
	
	// Add framework functionaily to the head individually
	add_action("admin_print_scripts-$of_page", 'of_load_only');
	add_action("admin_print_styles-$of_page",'of_style_only');
} 

add_action('admin_menu', 'optionsframework_add_admin');
?>