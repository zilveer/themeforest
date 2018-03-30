<?php  if ( ! defined('ET_FW')) exit('No direct script access allowed');

// **********************************************************************// 
// ! Divider
// **********************************************************************// 

add_shortcode('hr','etheme_divider_shortcode');
add_shortcode('divider','etheme_divider_shortcode');

function etheme_divider_shortcode($atts, $content) {
    $output = $style = '';
    extract(shortcode_atts(array(
    	'divider' => 'short',
    	'align' => 'center',
    	'mtop' => '',
    	'mbottom' => '',
        'class'  => '',
    ), $atts));
    
    if($align != '') {
	    $class .= ' divider-' . $align . '';
    }
    
    if($mtop != '') {
	    $style .= 'margin-top: ' . $mtop . 'px;';
    }
    
    if($mbottom != '') {
	    $style .= 'margin-bottom: ' . $mbottom . 'px;';
    }
    
    $output = '<hr class="divider ' . $divider . $class . '" style="' . $style . '">';
    
    return $output;
}

// **********************************************************************// 
// ! Register New Element: Divider
// **********************************************************************//
add_action( 'init', 'et_register_vc_divider');
if(!function_exists('et_register_vc_divider')) {
	function et_register_vc_divider() {
		if(!function_exists('vc_map')) return;
	    $params = array(
	      'name' => '[8THEME] Divider',
	      'base' => 'divider',
	      'icon' => 'icon-wpb-etheme',
	      'category' => 'Eight Theme',
	      'params' => array(
	        array(
	          "type" => "dropdown",
	          "heading" => __("Type", ET_DOMAIN),
	          "param_name" => "divider",
	          "value" => array( "", __("Short", ET_DOMAIN) => "short", __("Wide", ET_DOMAIN) => "wide")
	        ),
	        array(
	          "type" => "dropdown",
	          "heading" => __("Position of the small divider", ET_DOMAIN),
	          "param_name" => "align",
	          "value" => array( "", __("Left", ET_DOMAIN) => "left", __("Center", ET_DOMAIN) => "center", __("Right", ET_DOMAIN) => "right")
	        ),
	        array(
	          "type" => "textfield",
	          "heading" => __("Margin top", ET_DOMAIN),
	          "param_name" => "mtop",
	          "description" => __('Margin from top in pixels. Ex. 50', ET_DOMAIN)
	        ),
	        array(
	          "type" => "textfield",
	          "heading" => __("Margin bottom", ET_DOMAIN),
	          "param_name" => "mbottom",
	          "description" => __('Margin from bottom in pixels. Ex. 50', ET_DOMAIN)
	        ),
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
