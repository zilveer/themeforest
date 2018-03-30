<?php 

 add_action('init', 'add_button_dropcap');
 
 function add_button_dropcap() {
   if ( current_user_can('edit_posts') &&  current_user_can('edit_pages') )
   {
     add_filter('mce_external_plugins', 'add_plugin_dropcap');
     add_filter('mce_buttons', 'register_button_dropcap');
   }
}

function register_button_dropcap($buttons) {
   array_push($buttons, "dropcap");
   return $buttons;
}

function add_plugin_dropcap($plugin_array) {
   $plugin_array['dropcap'] = get_template_directory_uri().'/framework/tinymce/dropcap.js';
   return $plugin_array;
}
