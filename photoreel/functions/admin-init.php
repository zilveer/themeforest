<?php 

/*-----------------------------------------------------------------------------------*/
/* Themnific Framework  & Theme Version */
/*-----------------------------------------------------------------------------------*/


function themnific_version(){
    
    $theme_data = wp_get_theme();
	
}
add_action('wp_head','themnific_version');

/*-----------------------------------------------------------------------------------*/
/* Load the required Framework Files */
/*-----------------------------------------------------------------------------------*/

$functions_path = get_template_directory() . '/functions/';

get_template_part('/functions/admin-setup');			// Options panel variables and functions
get_template_part('/functions/admin-functions');		// Custom functions and plugins
get_template_part('/functions/admin-interface');		// Admin Interfaces
get_template_part('/functions/admin-hooks');			// Definition of Themnific Hooks


?>