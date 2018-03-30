<?php

$el_class = $width = $el_position = '';

extract( shortcode_atts( array(
			'el_class' => '',
			'border_color' => '',
			'bg_color' => '',
			'bg_image' => '',
			'bg_position' => 'left top',
			'bg_repeat' => 'repeat',
			'bg_stretch' => 'false',
			'padding_horizental' => '20',
			'padding_vertical' => '30',
			'margin_bottom' => '20',
			'drop_shadow' => 'false',
			'animation' => '',
			'visibility' => ''
		), $atts ) );

$output = $bg_stretch_class = $animation_css = $drop_shadow_css = '';
$id = Mk_Static_Files::shortcode_id();

if ( $bg_stretch == 'true' ) {
	$bg_stretch_class = 'mk-background-stretch';
}
if($drop_shadow == 'true') {
	$drop_shadow_css = 'drop-outer-shadow';
}
if ( $animation != '' ) {
	$animation_css = 'mk-animate-element ' . $animation . ' ';
}

$backgroud_image = !empty( $bg_image ) ? 'background-image:url('.$bg_image.'); ' : '';
$border = !empty( $border_color ) ? ( 'border:2px solid '.$border_color.';' ) : '';

$output .= '<div id="mk-custom-box-'.$id.'" class="mk-custom-boxed mk-shortcode '.$drop_shadow_css.' '.$bg_stretch_class.' '.$visibility.' '.$animation_css.$el_class.'">';
$output .= wpb_js_remove_wpautop( $content );
$output .= '<div class="clearboth"></div></div>';



Mk_Static_Files::addCSS('

	#mk-custom-box-'.$id.' {
	    padding:'.$padding_vertical.'px '.$padding_horizental.'px;
	    margin-bottom:'.$margin_bottom.'px;
	    '. $backgroud_image.'
	    background-attachment:scroll;
	    background-repeat:'.$bg_repeat.';
	    background-color:'.$bg_color.';
	    background-position:'.$bg_position.';
	    '.$border.'

	}
	#mk-custom-box-'.$id.' .mk-divider .divider-inner i{
	    background-color: '.$bg_color.' !important;
	}
	
', $id);


echo $output;
