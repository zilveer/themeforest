<?php 

 add_action('init', 'add_button_gmap');
 
 function add_button_gmap() {
   if ( current_user_can('edit_posts') &&  current_user_can('edit_pages') )
   {
     add_filter('mce_external_plugins', 'add_plugin_gmap');
     add_filter('mce_buttons_2', 'register_button_gmap');
   }
}

function register_button_gmap($buttons) {
   array_push($buttons, "gmap");
   return $buttons;
}

function add_plugin_gmap($plugin_array) {
   $plugin_array['gmap'] = get_template_directory_uri().'/framework/tinymce/gmap.js';
   return $plugin_array;
}
