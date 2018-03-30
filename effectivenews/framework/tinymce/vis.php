<?php 

 add_action('init', 'add_button_visibility');
 
 function add_button_visibility() {
   if ( current_user_can('edit_posts') &&  current_user_can('edit_pages') )
   {
     add_filter('mce_external_plugins', 'add_plugin_visibility');
     add_filter('mce_buttons_2', 'register_button_visibility');
   }
}

function register_button_visibility($buttons) {
   array_push($buttons, "visibility");
   return $buttons;
}

function add_plugin_visibility($plugin_array) {
   $plugin_array['visibility'] = get_template_directory_uri().'/framework/tinymce/vis.js';
   return $plugin_array;
}
