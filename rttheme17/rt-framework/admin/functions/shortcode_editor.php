<?php
#-----------------------------------------
#	RT-Theme shortcode_editor.php
#	version: 1.0
#-----------------------------------------

#
#	RT-Theme editor shortcodes button 
#
/// add the shorcode button
function rt_theme_shortcode_button() {
	if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') )
		return;

	// Add only in Rich Editor mode
	if ( get_user_option('rich_editing') == 'true') {
		add_filter("mce_external_plugins", "rt_theme_add_shortcode_tinymce_plugin");
		add_filter('mce_buttons_3', 'rt_theme_register_shortcode_button');
	}
}
 
function rt_theme_register_shortcode_button($buttons) {
	
	array_push($buttons, "", "rt_themeshortcode");
	array_push($buttons, "", "rt_themeshortcode_2");
	array_push($buttons, "", "rt_themeshortcode_4"); 
	array_push($buttons, "|", "rt_themeshortcode_6");
	array_push($buttons, "", "rt_themeshortcode_7");
	array_push($buttons, "", "rt_themeshortcode_8");
	array_push($buttons, "", "rt_themeshortcode_9");
	array_push($buttons, "|", "rt_themeshortcode_10");
	array_push($buttons, "", "rt_themeshortcode_11");
	array_push($buttons, "", "rt_themeshortcode_12");
	array_push($buttons, "|", "rt_themeshortcode_5");
	array_push($buttons, "", "rt_themeshortcode_13");
	return $buttons;
}

// load the js file
function rt_theme_add_shortcode_tinymce_plugin($plugin_array) {
   $plugin_array['rt_themeshortcode'] = THEMEURI . '/rt-framework/admin/js/shortcodes.js';
   return $plugin_array;
}

//refresh the editor 
function refresh_editor($ver) {
  $ver += 3;
  return $ver;
}

// init process for button control
add_filter( 'tiny_mce_version', 'refresh_editor');
add_action( 'init', 'rt_theme_shortcode_button' );
?>