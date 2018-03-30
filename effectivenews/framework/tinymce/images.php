<?php 

 add_action('init', 'add_button_images');
 
 function add_button_images() {
   if ( current_user_can('edit_posts') &&  current_user_can('edit_pages') )
   {
     add_filter('mce_external_plugins', 'add_plugin_images');
     add_filter('mce_buttons_3', 'register_button_images');
   }
}

function register_button_images($buttons) {
   array_push($buttons, "images");
   return $buttons;
}

function add_plugin_images($plugin_array) {
   $plugin_array['images'] = get_template_directory_uri().'/framework/tinymce/images.js';
   return $plugin_array;
}
