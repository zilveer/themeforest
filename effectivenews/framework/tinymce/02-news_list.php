<?php 

 add_action('init', 'add_button_newslist');
 
 function add_button_newslist() {
   if ( current_user_can('edit_posts') &&  current_user_can('edit_pages') )
   {
     add_filter('mce_external_plugins', 'add_plugin_newslist');
     add_filter('mce_buttons_3', 'register_button_newslist');
   }
}

function register_button_newslist($buttons) {
   array_push($buttons, "newslist");
   return $buttons;
}

function add_plugin_newslist($plugin_array) {
   $plugin_array['newslist'] = get_template_directory_uri().'/framework/tinymce/news_list.js';
   return $plugin_array;
}