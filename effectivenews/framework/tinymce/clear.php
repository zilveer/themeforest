<?php 

 add_action('init', 'add_button_clear');
 
 function add_button_clear() {
   if ( current_user_can('edit_posts') &&  current_user_can('edit_pages') )
   {
     add_filter('mce_external_plugins', 'add_plugin_clear');
     add_filter('mce_buttons', 'register_button_clear');
   }
}

function register_button_clear($buttons) {
   array_push($buttons, "clear");
   return $buttons;
}

function add_plugin_clear($plugin_array) {
   $plugin_array['clear'] = get_template_directory_uri().'/framework/tinymce/clear.js';
   return $plugin_array;
}
