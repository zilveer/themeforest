<?php

$el_class = $width = $el_position = '';

extract( shortcode_atts( array(
			'el_class' => '',
			'box_border_width' => 2,
			'button_border_width' => 2,
			'text' => '',
			'button_style' => 'outline',
			'button_text' => '',
			'button_url' => '',
			'outline_hover_skin' => '#fff',
			'outline_skin' => '#444',
			'style' => 'default',
			'layout_style' => 'expended',
			'bg_color' => '',
			'border_color' => '',
			'text_size' => 18,
			'font_weight' => 'inherit',
			'text_transform' => '',
			'text_color' => '',
		), $atts ) );

$custom_box_css = $output = $custom_box_title_css = $default_border = '';

global $mk_accent_color, $mk_settings;

$text_color = ($text_color == $mk_settings['accent-color']) ? $mk_accent_color : $text_color;
$bg_color = ($bg_color == $mk_settings['accent-color']) ? $mk_accent_color : $bg_color;
$border_color = ($border_color == $mk_settings['accent-color']) ? $mk_accent_color : $border_color;

if($style == 'custom') {
	$custom_box_css = ' style="background-color:'.$bg_color.';border:'.$box_border_width.'px solid '.$border_color.';"';
	$custom_box_title_css = ' style="font-size:'.$text_size.'px;font-weight:'.$font_weight.';text-transform:'.$text_transform.';color:'.$text_color.';"';
}
if($style == 'default') {
	$default_border = ' style="border-width:'.$box_border_width.'px ;"';
}

if($layout_style == 'expended'){
	$output .= '<div'.$custom_box_css.$default_border.' class="mk-call-to-action '.$el_class.'"><div class="mk-inner-grid">';
	if ( $button_text ) {
		$output .= do_shortcode( '[mk_button style="'.$button_style.'" outline_border_width="'.$button_border_width.'" size="medium" target="_self" align="right" margin_bottom="0" outline_skin="'.$outline_skin.'" outline_hover_skin="'.$outline_hover_skin.'" url="'.$button_url.'"]'.$button_text.'[/mk_button]' );
	}

	$output .= '<div class="callout-desc"><div class="callout-desc-holder">';
	$output .= '<h4'.$custom_box_title_css.' class="callout-title">'.$text.'</h4><div class="clearboth"></div>';
	$output .='</div></div>';

	$output .= '</div><div class="clearboth"></div></div>';
}else{
	$output .= '<div'.$custom_box_css.$default_border.' class="mk-call-to-action '.$el_class.'"><div class="mk-inner-grid">';
	$output .='<div class="mk-col-1-2" style="text-align:right;">';
	$output .= '<div class="callout-desc" style="width:100%;"><span class="callout-desc-holder">';
	$output .= '<h4'.$custom_box_title_css.' class="callout-title">'.$text.'</h4><div class="clearboth"></div>';
	$output .='</span></div>';
	$output .='</div>';
	if ( $button_text ) {
		$output .='<div class="mk-col-1-2">';
		$output .= do_shortcode( '[mk_button style="'.$button_style.'" outline_border_width="'.$button_border_width.'" size="medium" target="_self" align="left" margin_bottom="0" outline_skin="'.$outline_skin.'" bg_color="'.$outline_skin.'" txt_color="'.$outline_hover_skin.'"  outline_hover_skin="'.$outline_hover_skin.'" url="'.$button_url.'"]'.$button_text.'[/mk_button]' );
		$output .='</div>';
	}

	$output .= '</div><div class="clearboth"></div></div>';
}

echo $output;
