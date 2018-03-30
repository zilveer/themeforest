<?php 

 add_action('init', 'add_button_animate');
 
 function add_button_animate() {
   if ( current_user_can('edit_posts') &&  current_user_can('edit_pages') )
   {
     add_filter('mce_external_plugins', 'add_plugin_animate');
     add_filter('mce_buttons_2', 'register_button_animate');
   }
}

function register_button_animate($buttons) {
   array_push($buttons, "animate");
   return $buttons;
}

function add_plugin_animate($plugin_array) {
   $plugin_array['animate'] = get_template_directory_uri().'/framework/tinymce/animate.js';
   return $plugin_array;
}
