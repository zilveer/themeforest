<?php 

 add_action('init', 'add_button_gap');
 
 function add_button_gap() {
   if ( current_user_can('edit_posts') &&  current_user_can('edit_pages') )
   {
     add_filter('mce_external_plugins', 'add_plugin_gap');
     add_filter('mce_buttons', 'register_button_gap');
   }
}

function register_button_gap($buttons) {
   array_push($buttons, "gap");
   return $buttons;
}

function add_plugin_gap($plugin_array) {
   $plugin_array['gap'] = get_template_directory_uri().'/framework/tinymce/gap.js';
   return $plugin_array;
}