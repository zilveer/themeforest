<?php
/**
 * RMS WordPress Framework
 *
 * Copyright (c) 2014, ThemeOnLab,(http://themeonlab.com)
 */
//======================================
// Activate Shortcode
//======================================

if(isset($ThemePageShortcode) && !empty($ThemePageShortcode))
{
    foreach($ThemePageShortcode as $short)
    {
        require RMS_FRAMEWORK_DIR.'/shortcodes/'.$short.'/load.php';
    }
}

//======================================
// Register Shortcode Buttons In TinyMce
//======================================

function register_button( $buttons ) {
   global $ThemePageShortcode;
   if(isset($ThemePageShortcode) && !empty($ThemePageShortcode))
   {
       foreach ($ThemePageShortcode as $shortcode)
       {
           array_push( $buttons, "|", $shortcode );
       }
   }
   return $buttons;
}

function add_plugin( $plugin_array ) {
   global $ThemePageShortcode;
   if(isset($ThemePageShortcode) && !empty($ThemePageShortcode))
   {
       foreach ($ThemePageShortcode as $shortcode)
       {
           $plugin_array[$shortcode] = RMS_FRAMEWORK_URL.'/shortcodes/'.$shortcode.'/rms-'.$shortcode.'.js';
       }
   }
   return $plugin_array;
}

function my_recent_posts_button() {

   if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') ) {
      return;
   }

   if ( get_user_option('rich_editing') == 'true' ) {
      add_filter( 'mce_external_plugins', 'add_plugin' );
      add_filter( 'mce_buttons', 'register_button' );
   }

}
add_action('init', 'my_recent_posts_button');

add_action( 'init','rms_rewrite_rules' );
function rms_rewrite_rules() {
	$ver = filemtime( __FILE__ );
	$defaults = array( 'version' => 0, 'time' => time() );
	$r = wp_parse_args( get_option( __CLASS__ . '_flush', array() ), $defaults );
        if ( $r['version'] != $ver || $r['time'] + 172800 < time() ) { 
		flush_rewrite_rules();
		$args = array( 'version' => $ver, 'time' => time() );
		if ( ! update_option( __CLASS__ . '_flush', $args ) )
                {
                    add_option( __CLASS__ . '_flush', $args );
                }
	}
}