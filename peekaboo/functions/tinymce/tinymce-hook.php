<?php
/*
 * Credit to GavickPro
 */

add_action('admin_head', 'pkb_add_tinymce_button');
add_action('admin_enqueue_scripts', 'pkb_tinymce_css');

function pkb_add_tinymce_button() {
    global $typenow;
    if ( !current_user_can('edit_posts') && !current_user_can('edit_pages') ) {
   	return;
    }
    if( ! in_array( $typenow, array( 'post', 'page' ) ) )
        return;
	if ( get_user_option('rich_editing') == 'true') {
		add_filter("mce_external_plugins", "pkb_add_tinymce_plugin");
		add_filter('mce_buttons', 'pkb_register_tinymce_button');
	}
}

function pkb_add_tinymce_plugin($plugin_array) {
   	$plugin_array['shortcode_tinymce_button'] = get_template_directory_uri().'/functions/tinymce/ui-button.js';
   	return $plugin_array;
}

function pkb_register_tinymce_button($buttons) {
   array_push($buttons, "shortcode_tinymce_button");
   return $buttons;
}

function pkb_tinymce_css() {
	wp_enqueue_style('tinymce-hook', get_template_directory_uri(). '/functions/tinymce/style.css');
}
