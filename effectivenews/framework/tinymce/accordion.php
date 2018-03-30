<?php 

 add_action('init', 'add_button_acc');
 
 function add_button_acc() {
   if ( current_user_can('edit_posts') &&  current_user_can('edit_pages') )
   {
     add_filter('mce_external_plugins', 'add_plugin_acc');
     add_filter('mce_buttons_3', 'register_button_acc');
   }
}

function register_button_acc($buttons) {
   array_push($buttons, "acc");
   return $buttons;
}

function add_plugin_acc($plugin_array) {
   $plugin_array['acc'] = get_template_directory_uri().'/framework/tinymce/accordion.js';
   return $plugin_array;
}
