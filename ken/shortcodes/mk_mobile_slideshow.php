<?php

extract( shortcode_atts( array(
			"mobile_color" => 'black',
            "orientation" => 'landscape',
			"images" => '',
			"animation_speed" => 700,
			"slideshow_speed" => 7000,
			"pause_on_hover" => "false",
			'animation' => '',
			"el_class" => '',
		), $atts ) );

require_once THEME_INCLUDES . "/image-cropping.php";	

if ( $images == '' ) return null;
$animation_css = '';
if ( $animation != '' ) {
	$animation_css = ' mk-animate-element ' . $animation . ' ';
}

if($orientation == 'landscape') {
    $width = 635;
    $height = 357;
    $container_width = 902;
    $container_height = 436;
} else {
    $width = 295;
    $height = 520;
    $container_width = 357; 
    $container_height = 741;
}



$output = '';
$images = explode( ',', $images );
$i = -1;


foreach ( $images as $attach_id ) {
	$i++;
	$image_src_array = wp_get_attachment_image_src( $attach_id, 'full', true );
	$image_src       = bfi_thumb($image_src_array[0], array(
        'width' => $width,
        'height' => $height,
        'crop' => true
    ));

	$output .= '<li>';
	$output .= '<img alt="" src="' . mk_thumbnail_image_gen($image_src, $width, $height) .'" />';
	$output .= '</li>'. "\n\n";

}

echo '<div data-animation="fade" data-easing="swing" data-direction="horizontal" data-smoothHeight="false" data-slideshowSpeed="'.$slideshow_speed.'" data-animationSpeed="'.$animation_speed.'" data-pauseOnHover="'.$pause_on_hover.'" data-controlNav="false" data-directionNav="true" data-isCarousel="false" style="max-width:'.$container_width.'px;max-height:'.$container_height.'px" class="mk-mobile-slideshow '.$orientation.'-style mk-flexslider mk-script-call '.$animation_css.$el_class.'"><img style="display:none" class="mk-mobile-image" src="'.THEME_IMAGES.'/mobile-'.$mobile_color.'-'.$orientation.'.png" alt="" /><div class="slideshow-container"><ul class="mk-flex-slides" style="max-width:100%;max-height:100%;">' . $output . '</ul></div></div>';

