<?php 

 add_action('init', 'add_button_blog');
 
 function add_button_blog() {
   if ( current_user_can('edit_posts') &&  current_user_can('edit_pages') )
   {
     add_filter('mce_external_plugins', 'add_plugin_blog');
     add_filter('mce_buttons_3', 'register_button_blog');
   }
}

function register_button_blog($buttons) {
   array_push($buttons, "blog");
   return $buttons;
}

function add_plugin_blog($plugin_array) {
   $plugin_array['blog'] = get_template_directory_uri().'/framework/tinymce/blog.js';
   return $plugin_array;
}