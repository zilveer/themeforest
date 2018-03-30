<?php 

 add_action('init', 'add_button_review');
 
 function add_button_review() {
   if ( current_user_can('edit_posts') &&  current_user_can('edit_pages') )
   {
     add_filter('mce_external_plugins', 'add_plugin_review');
     add_filter('mce_buttons_3', 'register_button_review');
   }
}

function register_button_review($buttons) {
   array_push($buttons, "review");
   return $buttons;
}

function add_plugin_review($plugin_array) {
   $plugin_array['review'] = get_template_directory_uri().'/framework/tinymce/review.js';
   return $plugin_array;
}
