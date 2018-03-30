<?php 

 add_action('init', 'add_button_quote');
 
 function add_button_quote() {
   if ( current_user_can('edit_posts') &&  current_user_can('edit_pages') )
   {
     add_filter('mce_external_plugins', 'add_plugin_quote');
     add_filter('mce_buttons_2', 'register_button_quote');
   }
}

function register_button_quote($buttons) {
   array_push($buttons, "quote");
   return $buttons;
}

function add_plugin_quote($plugin_array) {
   $plugin_array['quote'] = get_template_directory_uri().'/framework/tinymce/quote.js';
   return $plugin_array;
}
