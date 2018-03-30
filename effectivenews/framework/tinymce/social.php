<?php 

 add_action('init', 'add_button_social');
 
 function add_button_social() {
   if ( current_user_can('edit_posts') &&  current_user_can('edit_pages') )
   {
     add_filter('mce_external_plugins', 'add_plugin_social');
     add_filter('mce_buttons_3', 'register_button_social');
   }
}

function register_button_social($buttons) {
   array_push($buttons, "social");
   return $buttons;
}

function add_plugin_social($plugin_array) {
   $plugin_array['social'] = get_template_directory_uri().'/framework/tinymce/social.js';
   return $plugin_array;
}
