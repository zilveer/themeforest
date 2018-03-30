<?php 

 add_action('init', 'add_button_box');
 
 function add_button_box() {
   if ( current_user_can('edit_posts') &&  current_user_can('edit_pages') )
   {
     add_filter('mce_external_plugins', 'add_plugin_box');
     add_filter('mce_buttons_3', 'register_button_box');
   }
}

function register_button_box($buttons) {
   array_push($buttons, "box");
   return $buttons;
}

function add_plugin_box($plugin_array) {
   $plugin_array['box'] = get_template_directory_uri().'/framework/tinymce/box.js';
   return $plugin_array;
}
