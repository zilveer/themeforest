<?php 

 add_action('init', 'add_button_featureslider');
 
 function add_button_featureslider() {
   if ( current_user_can('edit_posts') &&  current_user_can('edit_pages') )
   {
     add_filter('mce_external_plugins', 'add_plugin_featureslider');
     add_filter('mce_buttons_3', 'register_button_featureslider');
   }
}

function register_button_featureslider($buttons) {
   array_push($buttons, "featureslider");
   return $buttons;
}

function add_plugin_featureslider($plugin_array) {
   $plugin_array['featureslider'] = get_template_directory_uri().'/framework/tinymce/feature_slider.js';
   return $plugin_array;
}