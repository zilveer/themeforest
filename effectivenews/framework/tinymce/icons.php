<?php 

 add_action('init', 'add_button_icons');
 
 function add_button_icons() {
   if ( current_user_can('edit_posts') &&  current_user_can('edit_pages') )
   {
     add_filter('mce_external_plugins', 'add_plugin_icons');
     add_filter('mce_buttons_3', 'register_button_icons');
   }
}

function register_button_icons($buttons) {
   array_push($buttons, "icons");
   return $buttons;
}

function add_plugin_icons($plugin_array) {
   $plugin_array['icons'] = get_template_directory_uri().'/framework/tinymce/icons.js';
   return $plugin_array;
}
