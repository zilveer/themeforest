<?php

/* ************************************************************************************** 
	Enable featured image box
************************************************************************************** */

add_theme_support( 'post-thumbnails' );

/* ************************************************************************************** 
	 Add post formats / Scripts
************************************************************************************** */
 
$swm_set_post_formats = array( 'gallery','image','link','quote','video');

add_theme_support( 'post-formats', $swm_set_post_formats ); 

// Add default posts and comments RSS feed links to <head>.
add_theme_support( 'automatic-feed-links' );

// This theme styles the visual editor with editor-style.css to match the theme style.
add_editor_style();

if ( ! isset( $content_width ) ) $content_width = 960;

if (!function_exists('swm_tag_cloud_fonts')) {
  function swm_tag_cloud_fonts($args = array()) {
     $args['smallest'] = 11;
     $args['largest'] = 11;
     $args['unit'] = 'px';
     return $args;
  }
}

add_filter('widget_tag_cloud_args', 'swm_tag_cloud_fonts', 90);

/* ************************************************************************************** 
	Activation/Deactivation hook function
************************************************************************************** */

/**
 *
 * @desc registers a theme activation hook
 * @param string $code : Code of the theme. This can be the base folder of your theme. Eg if your theme is in folder 'mytheme' then code will be 'mytheme'
 * @param callback $function : Function to call when theme gets activated.
 */
function swm_wp_register_theme_activation_hook($code, $function) {
    $optionKey="theme_is_activated_" . $code;
    if(!get_option($optionKey)) {
        call_user_func($function);
        update_option($optionKey , 1);
    }
}

/**
 * @desc registers deactivation hook
 * @param string $code : Code of the theme. This must match the value you provided in swm_wp_register_theme_activation_hook function as $code
 * @param callback $function : Function to call when theme gets deactivated.
 */
function swm_wp_register_theme_deactivation_hook($code, $function) {
    // store function in code specific global
    $GLOBALS["swm_wp_register_theme_deactivation_hook_function" . $code]=$function;

    // create a runtime function which will delete the option set while activation of this theme and will call deactivation function provided in $function
    $fn=create_function('$theme', ' call_user_func($GLOBALS["swm_wp_register_theme_deactivation_hook_function' . $code . '"]); delete_option("theme_is_activated_' . $code. '");');

    // add above created function to switch_theme action hook. This hook gets called when admin changes the theme.
    // Due to wordpress core implementation this hook can only be received by currently active theme (which is going to be deactivated as admin has chosen another one.
    // Your theme can perceive this hook as a deactivation hook.
    add_action("switch_theme", $fn);    
}