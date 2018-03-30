<?php 

 add_action('init', 'add_button_videosc');
 
 function add_button_videosc() {
   if ( current_user_can('edit_posts') &&  current_user_can('edit_pages') )
   {
     add_filter('mce_external_plugins', 'add_plugin_videosc');
     add_filter('mce_buttons_2', 'register_button_videosc');
   }
}

function register_button_videosc($buttons) {
   array_push($buttons, "videosc");
   return $buttons;
}

function add_plugin_videosc($plugin_array) {
   $plugin_array['videosc'] = get_template_directory_uri() .'/framework/tinymce/videosc.js';
   return $plugin_array;
}
