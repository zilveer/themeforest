<?php 
/**
* TinyMce Functions.
*
* @author : VanThemes ( http://www.vanthemes.com )
* 
*/

/**
*  Register  tinymce Buttons
*****************************************/
function register_buttons($buttons){
	array_push($buttons,'van_button','van_box',	'van_tooltip', 'van_columns','van_toggle','van_tabs','van_accordions','van_author','van_video', 'van_flickr','van_twitter','van_googlemap','van_private',  'van_checklist','van_errorlist','van_bulletlist','van_dropcap', 'van_highlight','van_divider','van_clear','van_ads','van_social');
	return $buttons;
}

/**
*  Add  tinymce Buttons
*****************************************/
add_action('init','add_buttons');
function add_buttons(){
          if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') )
            return;
          if ( get_user_option('rich_editing') == 'true' && is_admin() ) {
                  add_filter('mce_external_plugins', 'add_plugin');  
                  add_filter('mce_buttons_3', 'register_buttons');  
          }
}
/**
*  Add  tinymce plugin
*****************************************/
function add_plugin($plugins){
          $plugins['van_shortcodes'] = VAN_ADMIN_URI . "/tinymce/tinymce.js";
          return $plugins;
}