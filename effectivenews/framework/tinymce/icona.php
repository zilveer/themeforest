<?php 

 add_action('init', 'add_button_icona');
 
 function add_button_icona() {
   if ( current_user_can('edit_posts') &&  current_user_can('edit_pages') )
   {
     add_filter('mce_external_plugins', 'add_plugin_icona');
     add_filter('mce_buttons_3', 'register_button_icona');
   }
}

function register_button_icona($buttons) {
   array_push($buttons, "icona");
   return $buttons;
}

function add_plugin_icona($plugin_array) {
   $plugin_array['icona'] = get_template_directory_uri().'/framework/tinymce/icona.js';
   return $plugin_array;
}
