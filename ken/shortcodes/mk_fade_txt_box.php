<?php 

extract( shortcode_atts( array(
            "animation_speed" => 700,
            "slideshow_speed" => 5000,
            'padding' => 20,
			'el_class' => '',
		), $atts ) );


$output = '';

$style_id = Mk_Static_Files::shortcode_id();

$output .= '<div id="mk-fade-txt-box-' . $style_id . '" data-loop="true" data-autoplayStop="false" data-slidesPerView="1" data-direction="horizontal" data-mousewheelControl="false" data-freeModeFluid="true" data-slideshowSpeed="' . $slideshow_speed . '" data-animationSpeed="' . $animation_speed . '" data-animation="fade" class="mk-fade-txt-box mk-swiper-container mk-swiper-slider ' . $el_class . '">';
$output .= '	<div class="mk-swiper-wrapper">';
$output .= "		\n\t\t\t".wpb_js_remove_wpautop( $content, true );
$output .= '	</div>';
$output .= '</div>';


Mk_Static_Files::addCSS('
	#mk-fade-txt-box-' . $style_id . ' .swiper-slide { 
	  padding: '.$padding.'px 0;
	}
', $style_id);	

echo $output;


