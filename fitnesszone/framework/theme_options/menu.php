<?php ob_start();
/** create_admin_menu()
  * Objective:
  *		Hook to create thme option page at back end.
**/
function create_admin_menu() {
	
	$role = get_role('administrator');
	if(!$role->has_cap('manage_theme')) $role->add_cap('manage_theme');

    if( function_exists('add_menu_page') ) 
		add_menu_page (IAMD_THEME_NAME.' - '.__('settings','iamd_text_domain'),IAMD_THEME_NAME,'manage_theme','parent','dt_theme_options_page', '', 25);

	if(function_exists('add_submenu_page'))
	 	add_submenu_page ('parent',IAMD_THEME_NAME.' - '.__("options",'iamd_text_domain'),__('Options','iamd_text_domain'),'manage_theme','parent','dt_theme_options_page');		

}
### --- ****  create_admin_menu() *** --- ###
add_action('admin_menu', 'create_admin_menu');
require_once(get_template_directory().'/framework/theme_options/settings.php');
#ob_flush();?>