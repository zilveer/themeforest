<?php 

 add_action('init', 'add_button_customLists');
 
 function add_button_customLists() {
   if ( current_user_can('edit_posts') &&  current_user_can('edit_pages') )
   {
     add_filter('mce_external_plugins', 'add_plugin_customLists');
     add_filter('mce_buttons_3', 'register_button_customLists');
   }
}

function register_button_customLists($buttons) {
   array_push($buttons, "customLists");
   return $buttons;
}

function add_plugin_customLists($plugin_array) {
   $plugin_array['customLists'] = get_template_directory_uri().'/framework/tinymce/lists.js';
   return $plugin_array;
}
