<?php 

 add_action('init', 'add_button_scrollbox');
 
 function add_button_scrollbox() {
   if ( current_user_can('edit_posts') &&  current_user_can('edit_pages') )
   {
     add_filter('mce_external_plugins', 'add_plugin_scrollbox');
     add_filter('mce_buttons_3', 'register_button_scrollbox');
   }
}

function register_button_scrollbox($buttons) {
   array_push($buttons, "scrollbox");
   return $buttons;
}

function add_plugin_scrollbox($plugin_array) {
   $plugin_array['scrollbox'] = get_template_directory_uri().'/framework/tinymce/scrolling_box.js';
   return $plugin_array;
}