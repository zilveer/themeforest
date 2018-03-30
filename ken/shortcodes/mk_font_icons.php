<?php
extract( shortcode_atts( array(
			'size' => 'small',
			'style' => 'default',
			'icon' => '',
			'color' => '',
			'bg_color' => '',
			'border_color' => '',
			'hover_color' => '',
			'bg_hover_color' => '',
			'border_hover_color' => '',
			'padding_horizental' => 4,
			'padding_vertical' => 4,
			'align' => 'none',
			'animation' => '',
			'infinite_animation' => '',
			'link' => '',
			'remove_frame' => 'false',
			'border_width' => 2,
			'el_class' => '',
		), $atts ) );

global $mk_accent_color;

$icon_css = '';


$infinite_animation = !empty($infinite_animation) ? (' mk-'.$infinite_animation) : '';
$animation_css = ($animation != '') ? ' mk-animate-element ' . $animation . ' ' : '';
$style_id = Mk_Static_Files::shortcode_id();

if(!empty( $icon )) {
    $icon = (strpos($icon, 'mk-') !== FALSE) ? ( $icon ) : ( 'mk-'.$icon );
} else {
    $icon = '';
}


if ( $style == 'default' ) {

    Mk_Static_Files::addCSS('
        #icon-font-'.$style_id.' i{
            color:'.$mk_accent_color.';
        }
    ', $style_id);

}else if($style == 'filled'){

	Mk_Static_Files::addCSS('
        #icon-font-'.$style_id.' i{
            background-color:'.$mk_accent_color.';
            color:'.$color.';
        }
    ', $style_id);

}else if($style == 'custom'){

	Mk_Static_Files::addCSS('
        #icon-font-'.$style_id.' i {
            background-color:'.$bg_color.';
            color:'.$color.';
            border-color:'.$border_color.';
        }
        #icon-font-'.$style_id.' i:hover {
            background-color:'.$bg_hover_color.';
            color:'.$hover_color.';
            border-color:'.$border_hover_color.';
        }
    ', $style_id);
    
}

	$remove_frame_css = ($remove_frame == 'true') ? ' remove-frame' : '';


$output = '<span id="icon-font-'.$style_id.'" class="mk-font-icons mk-shortcode icon-align-'.$align.$remove_frame_css.' '.$animation_css.$el_class.'">';
if ( $link ) {
	$output .= '<a class="mk-smooth" href="'.$link.'">';
}
$output .= '<i style="margin:'.$padding_vertical.'px '.$padding_horizental.'px; border-width:'.$border_width.'px; '.$icon_css.'" class="'.$icon.' '.$style.'-font-icon mk-size-'.$size.$infinite_animation.'"></i>';

if ( $link ) {
	$output .= '</a>';
}
$output .= '</span>';

echo $output;

