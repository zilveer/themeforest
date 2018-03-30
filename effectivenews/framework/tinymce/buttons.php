<?php 
 add_action('init', 'add_button_mbutton');
 
 function add_button_mbutton() {
   if ( current_user_can('edit_posts') &&  current_user_can('edit_pages') )
   {
     add_filter('mce_external_plugins', 'add_plugin_mbutton');
     add_filter('mce_buttons_3', 'register_button_mbutton');
   }
}

function register_button_mbutton($buttons) {
   array_push($buttons, "mbutton");
   return $buttons;
}

function add_plugin_mbutton($plugin_array) {
   $plugin_array['mbutton'] = get_template_directory_uri().'/framework/tinymce/mbuttons.js';
   return $plugin_array;
}
