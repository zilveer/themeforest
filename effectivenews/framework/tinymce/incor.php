<?php 

 add_action('init', 'add_button_incor');
 
 function add_button_incor() {
   if ( current_user_can('edit_posts') &&  current_user_can('edit_pages') )
   {
     add_filter('mce_external_plugins', 'add_plugin_incor');
     add_filter('mce_buttons_2', 'register_button_incor');
   }
}

function register_button_incor($buttons) {
   array_push($buttons, "incor");
   return $buttons;
}

function add_plugin_incor($plugin_array) {
   $plugin_array['incor'] = get_template_directory_uri().'/framework/tinymce/incor.js';
   return $plugin_array;
}
