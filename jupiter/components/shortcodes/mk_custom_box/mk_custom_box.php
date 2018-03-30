<?php

$phpinfo =  pathinfo( __FILE__ );
$path = $phpinfo['dirname'];
include( $path . '/config.php' );

$html = file_get_contents( $path . '/template.php' );
$html = phpQuery::newDocument( $html );

$id = Mk_Static_Files::shortcode_id();

// Main logic here
$custom_box = pq('.mk-custom-box');
$custom_box->addClass($visibility);
$custom_box->addClass($el_class);

$custom_box_container = $custom_box->find('.box-holder');

$custom_box->attr( 'id', 'box-'.$id ); 
if ( !empty( $bg_image ) ) {
	$custom_box->addClass('hover-effect-image');
}else {
	$custom_box->addClass('hover-effect-'.$background_hov_color_style);
}

if ($background_hov_color_style == 'image' && $bg_image_hov_effect != 'none') {
	$custom_box->addClass('image-effect-'.$bg_image_hov_effect);
}

if ( $animation != '' ) {
	$custom_box->addClass(get_viewport_animation_class($animation));
}

if( !empty($overlay_color) ){
	$custom_box_container->append('<div class="mk-custom-box--overlay"></div>');
}

$custom_box_container->prepend(wpb_js_remove_wpautop( $content ));

/**
 * Custom CSS Output
 * ==================================================================================*/
if($border_color_style == 'gradient_color') {
	$gradients_border = mk_gradient_option_parser($border_gradient_color_style, $border_gradient_color_angle);
	Mk_Static_Files::addCSS('
		#box-'.$id.'{
	 		padding: '.$border_width.'px;
	    	background: '.$bg_grandient_color_fallback.';
			background: -webkit-'.$gradients_border['type'].'-gradient('.$gradients_border['angle_1'].''.$border_grandient_color_from.' 0%, '.$border_grandient_color_to.' 100%);
			background: '.$gradients_border['type'].'-gradient('.$gradients_border['angle_2'].''.$border_grandient_color_from.' 0%, '.$border_grandient_color_to.' 100%);
	    }
	', $id);

}else if($border_color_style == 'single_color'){
	Mk_Static_Files::addCSS('
		#box-'.$id.' .box-holder{
			border: '.$border_width.'px '.$border_style.' '.$border_color.';
		}
	', $id);
}

// Delete after first update this css for
// before v5 added background image
if ( !empty( $bg_image ) ) {
	Mk_Static_Files::addCSS('
		#box-'.$id.' .box-holder::after,
		#box-'.$id.'.hover-effect-image.image-effect-blur .box-holder::before{
			content: "";
			background-image: url('.$bg_image.');
			background-position: '.$bg_position.';
			background-repeat: '.$bg_repeat.';
		}
	', $id);
}
if( !empty($overlay_color) ){
	Mk_Static_Files::addCSS('
		#box-'.$id.' .box-holder .mk-custom-box--overlay {
			background-color: '.$overlay_color.'; 
		}
	', $id);
}


if($background_style == 'gradient_color') {
	$gradients = mk_gradient_option_parser($bg_gradient_color_style, $bg_gradient_color_angle);
	Mk_Static_Files::addCSS('
		#box-'.$id.' .box-holder {
	    	background: '.$bg_grandient_color_fallback.';
			background: -webkit-'.$gradients['type'].'-gradient('.$gradients['angle_1'].''.$bg_grandient_color_from.' 0%, '.$bg_grandient_color_to.' 100%);
			background: '.$gradients['type'].'-gradient('.$gradients['angle_2'].''.$bg_grandient_color_from.' 0%, '.$bg_grandient_color_to.' 100%);
	    }
	', $id);
}else if ($background_style == 'image') {
	if ( !empty( $bg_image ) ) {
		Mk_Static_Files::addCSS('
			#box-'.$id.' .box-holder::after,
			#box-'.$id.'.hover-effect-image.image-effect-blur .box-holder::before{
				content: "";
				background-image: url('.$bg_image.');
				background-position: '.$bg_position.';
				background-repeat: '.$bg_repeat.';
			}
		', $id);
	}

		Mk_Static_Files::addCSS('
			#box-'.$id.' .box-holder{
				background-color: '.$bg_color.';
			}
		', $id);

	if($bg_stretch == 'true') {
		Mk_Static_Files::addCSS('
			#box-'.$id.' .box-holder::after, 
			#box-'.$id.'.hover-effect-image.image-effect-blur .box-holder::before{
				background-size: cover;
				-webkit-background-size: cover;
				-moz-background-size: cover;
			}
		', $id);
	}

}


if( $corner_radius > 0 ) {
	Mk_Static_Files::addCSS('
		#box-'.$id.', 
		#box-'.$id.' .box-holder,
		#box-'.$id.' .mk-custom-box--overlay{
			border-radius: '.$corner_radius.'px;
		}
	', $id);
	if($border_color_style == 'single_color') {
		Mk_Static_Files::addCSS('
			#box-'.$id.' .box-holder::after,
			#box-'.$id.' .box-holder::before,
			#box-'.$id.' .mk-custom-box--overlay{
				border-radius: '.($corner_radius - 4).'px;
			}
		', $id);
	}else if($border_color_style == 'gradient_color') {
		Mk_Static_Files::addCSS('
			#box-'.$id.' .box-holder,
			#box-'.$id.' .box-holder::after,
			#box-'.$id.' .box-holder::before,
			#box-'.$id.' .mk-custom-box--overlay{
				border-radius: '.($corner_radius - 5).'px;
			}
		', $id);
	}else if($border_color_style == 'none') {
		Mk_Static_Files::addCSS('
			#box-'.$id.' .box-holder::after,
			#box-'.$id.' .box-holder::before,
			#box-'.$id.' .mk-custom-box--overlay{
				border-radius: '.$corner_radius.'px;
			}
		', $id);
	}
}

Mk_Static_Files::addCSS('
	#box-'.$id.'{
		margin-bottom: '.$margin_bottom.'px;
	}
	#box-'.$id.' .box-holder{
		min-height: '.$min_height.'px;
		padding: '.$padding_vertical.'px '.$padding_horizental.'px;
	}
', $id);

if ($background_hov_color_style == 'image') {
	Mk_Static_Files::addCSS('
		#box-'.$id.' .box-holder:hover{
			background-color: '.$bg_hov_color.';
		}
	', $id);
}else if($background_hov_color_style == 'gradient_color') {
	$gradients_hover = mk_gradient_option_parser($bg_gradient_hov_color_style, $bg_gradient_hov_color_angle);
	Mk_Static_Files::addCSS('
		#box-'.$id.' .box-holder::after {
	    	background: '.$bg_grandient_hov_color_fallback.';
			background: -webkit-'.$gradients_hover['type'].'-gradient('.$gradients_hover['angle_1'].''.$bg_grandient_hov_color_from.' 0%, '.$bg_grandient_hov_color_to.' 100%);
			background: '.$gradients_hover['type'].'-gradient('.$gradients_hover['angle_2'].''.$bg_grandient_hov_color_from.' 0%, '.$bg_grandient_hov_color_to.' 100%);
	    }
	', $id);
}


print $html;
