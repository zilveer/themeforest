<?php 

 add_action('init', 'add_button_ads');
 
 function add_button_ads() {
   if ( current_user_can('edit_posts') &&  current_user_can('edit_pages') )
   {
     add_filter('mce_external_plugins', 'add_plugin_ads');
     add_filter('mce_buttons_3', 'register_button_ads');
   }
}

function register_button_ads($buttons) {
   array_push($buttons, "ads");
   return $buttons;
}

function add_plugin_ads($plugin_array) {
   $plugin_array['ads'] = get_template_directory_uri().'/framework/tinymce/ads.js';
   return $plugin_array;
}
