<?php 

 add_action('init', 'add_button_login');
 
 function add_button_login() {
   if ( current_user_can('edit_posts') &&  current_user_can('edit_pages') )
   {
     add_filter('mce_external_plugins', 'add_plugin_login');
     add_filter('mce_buttons_2', 'register_button_login');
   }
}

function register_button_login($buttons) {
   array_push($buttons, "login");
   return $buttons;
}

function add_plugin_login($plugin_array) {
   $plugin_array['login'] = get_template_directory_uri().'/framework/tinymce/log.js';
   return $plugin_array;
}
