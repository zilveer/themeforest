<?php 

 add_action('init', 'add_button_portfolio');
 
 function add_button_portfolio() {
   if ( current_user_can('edit_posts') &&  current_user_can('edit_pages') )
   {
     add_filter('mce_external_plugins', 'add_plugin_portfolio');
     add_filter('mce_buttons_3', 'register_button_portfolio');
   }
}

function register_button_portfolio($buttons) {
   array_push($buttons, "portfolio");
   return $buttons;
}

function add_plugin_portfolio($plugin_array) {
   $plugin_array['portfolio'] = get_template_directory_uri().'/framework/tinymce/portfolio.js';
   return $plugin_array;
}
