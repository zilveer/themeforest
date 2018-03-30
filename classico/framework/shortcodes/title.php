<?php  if ( ! defined('ET_FW')) exit('No direct script access allowed');

// **********************************************************************// 
// ! Title
// **********************************************************************// 

add_shortcode('title','etheme_title_shortcode');

function etheme_title_shortcode($atts, $content) {
    $output = $style1 = $style2 = '';
    extract(shortcode_atts(array(
    	'subtitle' => '',
    	'title' => 'Title',
    	'divider' => '',
    	'title_color' => '',
    	'subtitle_color' => '',
    	'align' => 'center',
    	'design' => 1,
        'class'  => '',
    ), $atts));
    
    if($title_color != '') {
	    $style1 = ' style="color:'.$title_color.';"';
    }
    
    if($subtitle_color != '') {
	    $style2 = ' style="color:'.$subtitle_color.';"';
    }
    
    if($subtitle != '') {
	    $subtitle = '<h3'.$style2.'>' . $subtitle . '</h3>';
    }
    
    if($divider != '') {
	    $divider = '<hr class="divider ' . $divider . '">';
    }
    
    if($align != '') {
	    $class .= ' title-' . $align . '';
    }

    $class .= ' design-'.$design;

    $output .= ' <div class="title ' . $class . '">';
	    $output .= $subtitle;
	    $output .= '<h1'.$style1.'>'.$title.'</h1>';
	    $output .= $divider;
    $output .= '</div>';
    
    return $output;
}

// **********************************************************************// 
// ! Register New Element: title
// **********************************************************************//
add_action( 'init', 'et_register_vc_title');
if(!function_exists('et_register_vc_title')) {
	function et_register_vc_title() {
		if(!function_exists('vc_map')) return;
	    $params = array(
	      'name' => '[8THEME] Title with text',
	      'base' => 'title',
	      'icon' => 'icon-wpb-etheme',
	      'category' => 'Eight Theme',
	      'params' => array(
	        array(
	          "type" => "textfield",
	          "heading" => "Title",
	          "param_name" => "title"
	        ),
	        array(
	          "type" => "colorpicker",
	          "heading" => "Title color",
	          "param_name" => "title_color"
	        ),
	        array(
	          "type" => "textfield",
	          "heading" => "Subtitle text",
	          "param_name" => "subtitle"
	        ),
	        array(
	          "type" => "colorpicker",
	          "heading" => "Subtitle color",
	          "param_name" => "subtitle_color"
	        ),
	        array(
	          "type" => "dropdown",
	          "heading" => __("Divider", ET_DOMAIN),
	          "param_name" => "divider",
	          "value" => array( "", __("Short", ET_DOMAIN) => "short", __("Wide", ET_DOMAIN) => "wide")
	        ),
	        array(
	          "type" => "dropdown",
	          "heading" => __("Design", ET_DOMAIN),
	          "param_name" => "design",
	          "value" => array( "", 
	          	__("Design 1", ET_DOMAIN) => 1, 
	          	__("Design 2", ET_DOMAIN) => 2
          		)
	        ),
	        array(
	          "type" => "dropdown",
	          "heading" => __("Text align", ET_DOMAIN),
	          "param_name" => "align",
	          "value" => array( "", __("Left", ET_DOMAIN) => "left", __("Center", ET_DOMAIN) => "center", __("Right", ET_DOMAIN) => "right")
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
