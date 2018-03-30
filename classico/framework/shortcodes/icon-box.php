<?php  if ( ! defined('ET_FW')) exit('No direct script access allowed');

// **********************************************************************// 
// ! Icon Box
// **********************************************************************// 

add_shortcode('icon_box','etheme_icon_box_shortcode');

function etheme_icon_box_shortcode($atts, $content) {
    $output = $btn = $style = '';
    extract(shortcode_atts(array(
    	'title' => '',
    	'icon' => '',
    	'color' => '',
    	'position' => '',
    	'link' => '',
    	'btn_text' => '',
    	'design' => '',
    	'animation' => '',
        'class'  => '',
    ), $atts));
    
    if($title != '') {
	    $title = '<h3>' . $title . '</h3>';
    }
     
    if($color != '') {
	    $style .= 'color:' . $color . ';';
    }
    
    if($icon != '') {
	    $icon = '<i class="fa fa-' . $icon . '" style="' . $style . '"></i>';
    }
    
    $class .= ' ' . $position . '-icon';
     
    if($design != '') {
	    $class .= ' design-' . $design;
    }
    
    if($animation != '') {
	    $class .= ' animation-' . $animation;
    }
    if($link != '' && $btn_text != '') {
	    $btn = '<a href="' . $link . '" class="read-more-btn">' . $btn_text . '</a>';
    }

    $box_id = rand(1000,10000);

	$output .= '<div class="icon-box ' . $class . '">';
		$output .= '<div class="icon">';
			$output .= $icon;
		$output .= '</div>';
		$output .= '<div class="icon-content">';
			$output .= $title;
			$output .= '<hr class="divider short">';
			$output .= '<div class="icon-text">'.$content.'</div>';
		$output .= '</div>';
		$output .= $btn;
	$output .= '</div>';
    
    return $output;
}

// **********************************************************************// 
// ! Register New Element: Icon Box
// **********************************************************************//
add_action( 'init', 'et_register_vc_icon_box');
if(!function_exists('et_register_vc_icon_box')) {
	function et_register_vc_icon_box() {
		if(!function_exists('vc_map')) return;
	    $params = array(
	      'name' => '[8THEME] Icon Box',
	      'base' => 'icon_box',
	      'icon' => 'icon-wpb-etheme',
	      'category' => 'Eight Theme',
	      'params' => array(
	        array(
	          "type" => "textfield",
	          "heading" => "Title",
	          "param_name" => "title"
	        ),
	        array(
	          "type" => "icon",
	          "heading" => "Choose icon",
	          "param_name" => "icon"
	        ),
	        array(
	          'type' => 'colorpicker',
	          "heading" => __("Icon color", ET_DOMAIN),
	          "param_name" => "color"
	        ),
	        array(
	          "type" => "textarea_html",
	          "holder" => "div",
	          "heading" => "Content text",
	          "param_name" => "content"
	        ),
	        array(
	          "type" => "dropdown",
	          "heading" => __("Position of the icon", ET_DOMAIN),
	          "param_name" => "position",
	          "value" => array( 
	          	__("Left", ET_DOMAIN) => 'left', 
	          	__("Top", ET_DOMAIN) => 'top',
	          	__("Right", ET_DOMAIN) => 'right'
          	 )
	        ),
	        array(
	          "type" => "textfield",
	          "heading" => "Button text",
	          "param_name" => "btn_text"
	        ),
	        array(
	          "type" => "textfield",
	          "heading" => "Button link",
	          "param_name" => "link"
	        ),
	        array(
	          "type" => "dropdown",
	          "heading" => __("Design", ET_DOMAIN),
	          "param_name" => "design",
	          "value" => array( 
	          	"",
	          	__("Design 1", ET_DOMAIN) => 1, 
	          	__("Design 2", ET_DOMAIN) => 2,
	          	__("Design 3", ET_DOMAIN) => 3
          	 )
	        ),
	        array(
	          "type" => "dropdown",
	          "heading" => __("Animation", ET_DOMAIN),
	          "param_name" => "animation",
	          "value" => array( 
	          	"",
	          	__("Animation 1", ET_DOMAIN) => 1, 
	          	__("Animation 2", ET_DOMAIN) => 2,
	          	__("Animation 3", ET_DOMAIN) => 3
          	 )
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
