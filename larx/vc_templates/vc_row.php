<?php
$output = $el_class = $bg_image = $bg_color = $bg_overlay_class = $bg_image_repeat = $section_class = $font_color = $padding = $margin_bottom = $css = '';
extract(shortcode_atts(array(
    'el_class'        	=> '',
    'bg_image'        	=> '',
    'bg_color'        	=> '',
    'bg_image_repeat' 	=> '',
    'font_color'      	=> '',
    'padding'         	=> '',
    'margin_bottom'   	=> '',
    'css' 				=> '',
    'el_id' 			=> '',
    'th_text_align'		=> 'text-center',
    'customcolor_heading' 	=> '',
    'customcolor_text' 	=> '',
    'bg_overlay'		=> '',
    'content_width'		=> 'container',
    'parallax'			=> '',
    'fullscreen'		=> '',
    'bg_section_color'  => '',
), $atts));

//wp_enqueue_style('js_composer_front');
wp_enqueue_script('wpb_composer_front_js');
//wp_enqueue_style('js_composer_custom_css');

if(!$el_id) $el_id = rand(1,9999);

$el_class = $this->getExtraClass($el_class);


$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, ' '. ( $this->settings('base')==='vc_row_inner' ? 'vc_inner ' : '' ) . get_row_css_class() . $el_class . vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );

//$row_after = '';

global $post;


$section_width_class = '';
$container_class = '';
if($content_width == 'container') {
	$section_width_class = 'container';
}
if($content_width == 'container-fluid') {
    $section_width_class = 'container-fluid';
}

// Background overlay
if($bg_overlay == 'dark') {
    $bg_overlay_class = ' soft-bg';
}elseif($bg_overlay == 'darker') {
    $bg_overlay_class = ' soft-black-bg';
}elseif($bg_overlay == 'light') {
    $bg_overlay_class = ' soft-white-bg';
}elseif($bg_overlay == 'dots_dark') {
    $bg_overlay_class = ' pattern-black soft-black-bg';
}elseif($bg_overlay == 'dots_white') {
    $bg_overlay_class = ' pattern-white';
}


// Parallax
$parallax_class = '';
if($parallax == 'yes') {
	$parallax_class = ' parallax parallax-overlay';
}

// Page Layout


$page_layout = get_post_meta(th_get_id(), 'page_layout', true);
if(!$page_layout || get_post_type(th_get_id()) == 'portfolio') $page_layout = 'fullwidth';

$row_content_before = '<div class="inner container"><div class="row">';
$row_content_after = '</div></div>';

$page_width = get_post_meta(th_get_id(), 'page_width', true);
if(!$page_width) $page_width = 'content';

if( !is_page_template('template-onepager.php') AND !is_page_template('template-multipage.php') ) {
	if($page_width == 'content' || $page_layout != 'fullwidth') {

		// Default page.php

		$row_content_before = '';
		$row_content_after = '';
		$container_class = '';

	}
}

if($fullscreen == 'yes') {
	$row_content_before = '';
	$row_content_after = '';
	$parallax_class .= ' p-section';
	$container_class = '';
}

$th_paddings = 'padding-top-x2 padding-bottom';

//Background Section
$bg_section_color_class = '';
if($bg_section_color =='grey'){
    $bg_section_color_class = 'bg-color';
}
if($bg_section_color =='dark'){
    $bg_section_color_class = 'footer-big';
    $th_paddings = '';
}



$style = $this->buildStyle($bg_image, $bg_color, $bg_image_repeat, $font_color, $padding, $margin_bottom);

if($fullscreen == 'yes' && $content_width == 'fullwidth'){
    $output .= '<section id="'.$el_id.'">';
}
$th_add_row = '';
if($fullscreen == 'yes' && $content_width == 'container-fluid'){
    $output .= '<section id="'.$el_id.'" class="container-fluid projects '.$bg_section_color_class.' '.$th_text_align.' '.$el_class.'">';
    $th_add_row = 'row';
}else{
    $output .= '<section id="'.$el_id.'" class="'.$css_class.$bg_overlay_class.$parallax_class.$container_class.' '.$th_paddings.' '.$th_text_align.' '.$section_class.$section_width_class.' '.$bg_section_color_class.'">';
}


$output .= '<div class=" '.$th_add_row.'" '.$style.'>';
//$output .= $row_video_before;
$output .= $row_content_before;
$output .= wpb_js_remove_wpautop($content);
$output .= $row_content_after;
$output .= '</div>'.$this->endBlockComment('row');
$output .= '</section>';

echo $output;