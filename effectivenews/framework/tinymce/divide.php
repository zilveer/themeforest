<?php 

 add_action('init', 'add_button_divide');
 
 function add_button_divide() {
   if ( current_user_can('edit_posts') &&  current_user_can('edit_pages') )
   {
     add_filter('mce_external_plugins', 'add_plugin_divide');
     add_filter('mce_buttons', 'register_button_divide');
   }
}

function register_button_divide($buttons) {
   array_push($buttons, "divide");
   return $buttons;
}

function add_plugin_divide($plugin_array) {
   $plugin_array['divide'] = get_template_directory_uri().'/framework/tinymce/divide.js';
   return $plugin_array;
}
