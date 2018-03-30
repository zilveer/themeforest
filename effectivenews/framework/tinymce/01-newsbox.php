<?php 

 add_action('init', 'add_button_newsbox');
 
 function add_button_newsbox() {
   if ( current_user_can('edit_posts') &&  current_user_can('edit_pages') )
   {
     add_filter('mce_external_plugins', 'add_plugin_newsbox');
     add_filter('mce_buttons_3', 'register_button_newsbox');
   }
}

function register_button_newsbox($buttons) {
   array_push($buttons, "newsbox");
   return $buttons;
}

function add_plugin_newsbox($plugin_array) {
   $plugin_array['newsbox'] = get_template_directory_uri().'/framework/tinymce/newsbox.js';
   return $plugin_array;
}
