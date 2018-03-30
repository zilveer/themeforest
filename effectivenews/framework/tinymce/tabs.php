<?php 

 add_action('init', 'add_button_tabs');
 
 function add_button_tabs() {
   if ( current_user_can('edit_posts') &&  current_user_can('edit_pages') )
   {
     add_filter('mce_external_plugins', 'add_plugin_tabs');
     add_filter('mce_buttons_3', 'register_button_tabs');
   }
}

function register_button_tabs($buttons) {
   array_push($buttons, "tabs");
   return $buttons;
}

function add_plugin_tabs($plugin_array) {
   $plugin_array['tabs'] = get_template_directory_uri().'/framework/tinymce/tabs.js';
   return $plugin_array;
}
