<?php 

 add_action('init', 'add_button_newspics');
 
 function add_button_newspics() {
   if ( current_user_can('edit_posts') &&  current_user_can('edit_pages') )
   {
     add_filter('mce_external_plugins', 'add_plugin_newspics');
     add_filter('mce_buttons_3', 'register_button_newspics');
   }
}

function register_button_newspics($buttons) {
   array_push($buttons, "newspics");
   return $buttons;
}

function add_plugin_newspics($plugin_array) {
   $plugin_array['newspics'] = get_template_directory_uri().'/framework/tinymce/newspics.js';
   return $plugin_array;
}
