<?php

extract( shortcode_atts( array(
			"images" => '',
			"animation_speed" => 700,
			"slideshow_speed" => 7000,
			'padding' => 0,
			"direction_nav" => "true",
			'bg_color' => '',
			'attachment' => 'scroll',
			'bg_position' => 'left top',
			'border_color' => '#eee',
			'direction' => 'horizontal',
			'bg_image' => '',
			'bg_stretch' => 'false',
			"el_class" => '',
		), $atts ) );

$id = Mk_Static_Files::shortcode_id();
$style_output = $bg_stretch_class = '';

$style_output .= !empty( $bg_image ) ? 'background-image:url('.$bg_image.'); ' : '';
$style_output .= !empty( $bg_color ) ? 'background-color:'.$bg_color.';' : '';
$style_output .= !empty( $attachment ) ? 'background-attachment:'.$attachment.';' : '';
$style_output .= !empty( $bg_position ) ? 'background-position:'.$bg_position.';' : '';
$style_output .= !empty( $border_color ) ? 'border:1px solid '.$border_color.';border-left:none;border-right:none;' : '';

if ( $bg_stretch == 'true' ) {
	$bg_stretch_class = 'mk-background-stretch ';
}

$output .= '<div id="content_scroller_'.$id.'" class="mk-content-scroller '.$bg_stretch_class.$el_class.'" style="'. $style_output.'"><div class="mk-swiper-container mk-swiper-slider" data-freeModeFluid="true" data-loop="false" data-slidesPerView="1" data-pagination="false" data-freeMode="false" data-direction="'.$direction.'" data-slideshowSpeed="'.$slideshow_speed.'" data-animationSpeed="'.$animation_speed.'" data-directionNav="'.$direction_nav.'">';
$output .= '<div class="mk-swiper-wrapper">';

$output .= wpb_js_remove_wpautop( $content );
$output .= '</div>';

if ( $direction_nav == 'true' ) {
	$output .= '<a class="mk-swiper-prev slideshow-swiper-arrows"><i class="mk-theme-icon-prev-big"></i></a>';
	$output .= '<a class="mk-swiper-next slideshow-swiper-arrows"><i class="mk-theme-icon-next-big"></i></a>';
}
$output .= '</div></div><div class="clearboth"></div>';

echo $output;



Mk_Static_Files::addCSS("
	#content_scroller_{$id} .swiper-slide {
		border: {$padding}px solid transparent; 
		box-sizing: border-box;
	}
", $id);
