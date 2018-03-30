<?php 

 add_action('init', 'add_button_highlight');
 
 function add_button_highlight() {
   if ( current_user_can('edit_posts') &&  current_user_can('edit_pages') )
   {
     add_filter('mce_external_plugins', 'add_plugin_highlight');
     add_filter('mce_buttons', 'register_button_highlight');
   }
}

function register_button_highlight($buttons) {
   array_push($buttons, "highlight");
   return $buttons;
}

function add_plugin_highlight($plugin_array) {
   $plugin_array['highlight'] = get_template_directory_uri().'/framework/tinymce/highlight.js';
   return $plugin_array;
}
