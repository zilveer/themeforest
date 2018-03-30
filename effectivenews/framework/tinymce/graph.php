<?php 

 add_action('init', 'add_button_graph');
 
 function add_button_graph() {
   if ( current_user_can('edit_posts') &&  current_user_can('edit_pages') )
   {
     add_filter('mce_external_plugins', 'add_plugin_graph');
     add_filter('mce_buttons_3', 'register_button_graph');
   }
}

function register_button_graph($buttons) {
   array_push($buttons, "graph");
   return $buttons;
}

function add_plugin_graph($plugin_array) {
   $plugin_array['graph'] = get_template_directory_uri().'/framework/tinymce/graph.js';
   return $plugin_array;
}
