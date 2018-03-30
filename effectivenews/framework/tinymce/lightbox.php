<?php 

 add_action('init', 'add_button_lightbox');
 
 function add_button_lightbox() {
   if ( current_user_can('edit_posts') &&  current_user_can('edit_pages') )
   {
     add_filter('mce_external_plugins', 'add_plugin_lightbox');
     add_filter('mce_buttons_3', 'register_button_lightbox');
   }
}

function register_button_lightbox($buttons) {
   array_push($buttons, "lightbox");
   return $buttons;
}

function add_plugin_lightbox($plugin_array) {
   $plugin_array['lightbox'] = get_template_directory_uri().'/framework/tinymce/lightbox.js';
   return $plugin_array;
}
