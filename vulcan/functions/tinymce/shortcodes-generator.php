<?php
add_action('init', 'add_button'); 

function add_button() {  
	if ( current_user_can('edit_posts') &&  current_user_can('edit_pages') )  {  
	add_filter('mce_external_plugins', 'add_plugin');  
	add_filter('mce_buttons', 'register_columns');
	add_filter('mce_buttons', 'register_elements');
	add_filter('mce_buttons', 'register_liststyle');
	add_filter('mce_buttons', 'register_content');
	}  
}  

//FIRST ROW OF BUTTONS 
function register_columns($buttons) {   	
    array_push($buttons, "columns");  	
    return $buttons;  
} 

//SECOND ROW OF BUTTONS 
function register_elements($buttons) {   	
    array_push($buttons,"elements");  	
    return $buttons;  
}

//SECOND ROW OF BUTTONS 
function register_liststyle($buttons) {   	
    array_push($buttons,"list");  	
    return $buttons;  
}

function register_content($buttons) {   	
    array_push($buttons,"content");  	
    return $buttons;  
}

function add_plugin($plugin_array) {  
	$plugin_array['IndonezShortcodes'] = get_template_directory_uri().'/functions/tinymce/shortcodes.js';  
	return $plugin_array;  
}  

/*global $wp_version;
if ( $wp_version >= 3.9 ) {

	function add_plugin($plugin_array) {  
		$plugin_array['IndonezShortcodes'] = get_template_directory_uri().'/functions/tinymce/shortcodes.js';  
		return $plugin_array;  
	}  
	
}else{

	function add_plugin($plugin_array) {  
		$plugin_array['IndonezShortcodes'] = get_template_directory_uri().'/functions/tinymce/shortcodes-fallback.js';  
		return $plugin_array;  
	}  
}*/
?>