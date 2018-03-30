<?php  if ( ! defined('ET_FW')) exit('No direct script access allowed');

// **********************************************************************// 
// ! scslug
// **********************************************************************// 

add_shortcode('scslug','etheme_scslug_shortcode');

function etheme_scslug_shortcode($atts, $content) {
    $output = '';
    extract(shortcode_atts(array(
        'class'  => '',
    ), $atts));
    
    $output .= '';
    
    return $output;
}

// **********************************************************************// 
// ! Register New Element: scslug
// **********************************************************************//
add_action( 'init', 'et_register_vc_scslug');
if(!function_exists('et_register_vc_scslug')) {
	function et_register_vc_scslug() {
		if(!function_exists('vc_map')) return;
	    $params = array(
	      'name' => '[8THEME] scslug',
	      'base' => 'scslug',
	      'icon' => 'icon-wpb-etheme',
	      'category' => 'Eight Theme',
	      'params' => array(
	        array(
	          "type" => "textfield",
	          "heading" => __("Extra Class", ET_DOMAIN),
	          "param_name" => "class",
	          "description" => __('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', ET_DOMAIN)
	        )
	      )
	
	    );  
	
	    vc_map($params);
	}
}
