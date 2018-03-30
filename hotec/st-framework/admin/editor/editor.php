<?php


define('PL_SA_URL',ST_ADMIN_URL.'/editor');  // this plugin url
define('PL_SA_PATH',dirname(__FILE__));  // this plugin PATH


function st_tinymce_addbuttons() {
   // Don't bother doing this stuff if the current user lacks permissions
   if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') )
     return;
 
   // Add only in Rich Editor mode
   if ( get_user_option('rich_editing') == 'true') {
     add_filter("mce_external_plugins", "st_add_tinymce_plugin");
     add_filter('mce_buttons', 'st_register_tinymce_button');
   }
}
 
function st_register_tinymce_button($buttons) {
   array_push($buttons, "separator", "stshorcode");
   return $buttons;
}
 
// Load the TinyMCE plugin : editor_plugin.js (wp2.5)
function st_add_tinymce_plugin($plugin_array) {
   $plugin_array['stshorcode'] = PL_SA_URL.'/edittor_plugin.js';
   return $plugin_array;
}

 function  sa_test_init(){
    wp_enqueue_script('sa_test',PL_SA_URL.'cutom.js','jquery');
    wp_localize_script('jquery','sa_test',array('sa_url'=>PL_SA_URL));
 }
 // thêm các script vào  header của trang admin
 // add_action('admin_init','sa_test_init');
 
 
 // gọi hộp loại thông qua ajax
 function st_editor_dialog(){
    include(PL_SA_PATH.'/dialog.php'); die();
}
// thêm action ajax để gọi hộp  thoại
add_action('wp_ajax_editor_dialog', 'st_editor_dialog');
 
 


 
 
// init process for button control
add_action('init', 'st_tinymce_addbuttons');