<?php  if ( ! defined('ET_FW')) exit('No direct script access allowed');

// **********************************************************************// 
// ! Banner With mask
// **********************************************************************// 

add_shortcode('banner','etheme_banner_shortcode');

function etheme_banner_shortcode($atts, $content) {
    $image = $mask = $output = '';
    extract(shortcode_atts(array(
        'align'  => 'left',
        'valign'  => 'top',
        'class'  => '',
        'link'  => '',
        'hover'  => '',
        'title'  => '',  
        'font_style'  => '',  
        'type'  => 1,  
        'img' => '',
        'img_src' => '',
        'img_size' => '270x170'
    ), $atts));

    $src = '';
    $alt = '';
    $img_size = explode('x', $img_size);

    $width = $img_size[0];
    $height = $img_size[1];

    if($img != '') {
        $src = etheme_get_image($img, $width, $height);
        $alt = get_post_meta( $img, '_wp_attachment_image_alt', true);
    }elseif ($img_src != '') {
        $src = do_shortcode($img_src);
    }

    if ($type != '') {
      $class .= ' banner-type-'.$type;
    }

    if ($align != '') {
      $class .= ' align-'.$align;
    }

    if ($valign != '') {
      $class .= ' valign-'.$valign;
    }

    if ($font_style != '') {
      $class .= ' font-style-'.$font_style;
    }

    $onclick = '';
    if($link != '') {
        $class .= ' cursor-pointer';
        $onclick = 'onclick="window.location=\''.$link.'\'"';
    }
    
    $output .= '<div class="banner '.$class.'" '.$onclick.'>';
	    $output .= '<img src="'.$src.'" alt=" '.$alt.' " width="'.$width.'" height="'.$height.'">';
	    $output .= '<div class="banner-content">';
		    $output .= '<h3>'.$title.'</h3>';
		    $output .= '<p>'.do_shortcode($content).'</p>';
	    $output .= '</div>';
    $output .= '</div>';
    
    return $output;
}

// **********************************************************************// 
// ! Register New Element: Banner with mask
// **********************************************************************//
add_action( 'init', 'et_register_vc_banner');
if(!function_exists('et_register_vc_banner')) {
	function et_register_vc_banner() {
		if(!function_exists('vc_map')) return;
	    $banner_params = array(
	      'name' => '[8THEME] Banner with mask',
	      'base' => 'banner',
	      'icon' => 'icon-wpb-etheme',
	      'category' => 'Eight Theme',
	      'params' => array(
	        array(
	          'type' => 'attach_image',
	          "heading" => __("Banner Image", ET_DOMAIN),
	          "param_name" => "img"
	        ),
	        array(
	          "type" => "textfield",
	          "heading" => __("Banner size", "js_composer"),
	          "param_name" => "img_size",
	          "description" => __("Enter image size. Example in pixels: 200x100 (Width x Height).", ET_DOMAIN)
	        ),
	        array(
	          "type" => "textfield",
	          "heading" => __("Link", ET_DOMAIN),
	          "param_name" => "link"
	        ),
	        array(
	          "type" => "textfield",
	          "heading" => "Title",
	          "param_name" => "title"
	        ),
	        array(
	          "type" => "textarea_html",
	          "holder" => "div",
	          "heading" => "Banner Mask Text",
	          "param_name" => "content",
	          "value" => "Some promo words"
	        ),
	        /*array(
	          "type" => "dropdown",
	          "heading" => __("Horizontal align", ET_DOMAIN),
	          "param_name" => "align",
	          "value" => array( "", __("Left", ET_DOMAIN) => "left", __("Center", ET_DOMAIN) => "center", __("Right", ET_DOMAIN) => "right")
	        ),
	        array(
	          "type" => "dropdown",
	          "heading" => __("Vertical align", ET_DOMAIN),
	          "param_name" => "valign",
	          "value" => array( __("Top", ET_DOMAIN) => "top", __("Middle", ET_DOMAIN) => "middle", __("Bottom", ET_DOMAIN) => "bottom")
	        ),*/
	        array(
	          "type" => "dropdown",
	          "heading" => __("Banner design", ET_DOMAIN),
	          "param_name" => "type",
	          "value" => array( "", 
		          	__("Design 1", ET_DOMAIN) => 1, 
		          	__("Design 2", ET_DOMAIN) => 2, 
		          	__("Design 3", ET_DOMAIN) => 3, 
		          	__("Design 4", ET_DOMAIN) => 4, 
		          	__("Design 5", ET_DOMAIN) => 5, 
		          	__("Design 6", ET_DOMAIN) => 6
          		)
	        ),
	        array(
	          "type" => "dropdown",
	          "heading" => __("Font style", ET_DOMAIN),
	          "param_name" => "font_style",
	          "value" => array( "", __("light", ET_DOMAIN) => "light", __("dark", ET_DOMAIN) => "dark")
	        ),
	        /*array(
	          "type" => "dropdown",
	          "heading" => __("Hover effect", ET_DOMAIN),
	          "param_name" => "hover",
	          "value" => array( "", __("zoom", ET_DOMAIN) => "zoom", __("fade", ET_DOMAIN) => "fade")
	        ),*/
	        array(
	          "type" => "textfield",
	          "heading" => __("Extra Class", ET_DOMAIN),
	          "param_name" => "class",
	          "description" => __('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', ET_DOMAIN)
	        )
	      )
	
	    );  
	
	    vc_map($banner_params);
	}
}
