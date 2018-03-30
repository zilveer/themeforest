<?php
$output = $el_class = $row_style = $custom_image = $fix_video = $video_url_webm = $video_url = $removepadding = $custombgcolor = $image_repeat = $css_background = $image_url = $img_id = $img = $image_ratio = $parallax_settings = $css_slider = $b_size = '';
extract(shortcode_atts(array(
    'el_class' 	   => '',
    'row_style'    => '',
	'video_img'    => '',
	'video_url'    => '',
	'video_url_webm' => '',
	'video_url_ogv' => '',
    'custombgcolor'=> '', 
    'custom_image' => '', 
    'image_repeat' => '',
    'image_ratio'  => '',
    'addpadding'   => '',
    'removepadding' => '',
    'b_size' => '',
), $atts));

wp_enqueue_style( 'js_composer_front' );
wp_enqueue_script( 'wpb_composer_front_js' );
wp_enqueue_style('js_composer_custom_css');

$el_class = $this->getExtraClass($el_class)
;$css_class =  apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'wpb_row '.get_row_css_class().$el_class, $this->settings['base']);

if ( $addpadding == 'yes') {
	$space = 'padding: 40px 0;';
}

else {
	$space = 'padding: 0;';
}

if ( $removepadding == 'yes') {
    $removepadding = ' padding: 0;';
}

else {
    $removepadding = ';';
}

if ( $row_style == 'bg-color' ) {
$css_background = ' style="background-color:'.$custombgcolor.';'.$removepadding.'"';
}

if ( $b_size == 'yes') {
$b_size = ' background-size=100% 100%;';	
}

else { $b_size = ''; }

if ( $row_style == 'image' ) {
$img_id = preg_replace('/[^\d]/', '', $custom_image);
$image_url = wp_get_attachment_image_src( $img_id, 'full');
$image_url = $image_url[0];	
$css_background = ' style="background-image: url('.$image_url.'); background-repeat:'.$image_repeat.';'.$b_size.'"';
}

if ( $row_style == 'parallax' ) {
$img_id = preg_replace('/[^\d]/', '', $custom_image);
$image_url = wp_get_attachment_image_src( $img_id, 'full');
$image_url = $image_url[0];	
$css_background = ' style="background-image: url('.$image_url.'); background-repeat: no-repeat; background-attachment:fixed; border-bottom: none; '.$space.'"';
$parallax_settings = ' data-stellar-background-ratio="'.$image_ratio.'"';
$css_slider = ' m_parallax';	
}

if ( $row_style == 'slider') {
$css_slider = ' slider';
$output .= '<div class="bg-color'.$css_slider.'"'.$css_background.''.$parallax_settings .'>';
}

if ( $row_style == 'asset-bg') {
$css_slider = ' asset-bg';
}

if ( $row_style == 'blog-content') {
$css_slider = ' blog-content';
}

if ( $row_style == 'video' ) {
$img_id = preg_replace('/[^\d]/', '', $video_img);
$image_url = wp_get_attachment_image_src( $img_id, 'full');
$image_url = $image_url[0];	
$parallax_settings = '';
$css_background = ' style="padding: 0; overflow: hidden; background:url('.$image_url.');"';
$css_slider = ' mukam_video';
$fix_video = ' style="position: relative;"';
}

if ( $row_style != 'slider') {
$output .= '<div class="bg-color'.$css_slider.'"'.$css_background.''.$parallax_settings .'>';
		if ( $row_style == 'video') {
		$output .= '<div class = "video_back"><video poster="'.$image_url.'" preload autoplay="autoplay" loop="loop">
		<source src="'.$video_url.'" type="video/mp4">		
		<source src="'.$video_url_webm.'" type="video/webm; codecs=vp8,vorbis">
		<source src="'.$video_url_ogv.'" type="video/ogg; codecs=theora,vorbis"></video></div>';
		}
$output .= '<div class="container"'.$fix_video.'>';
}
$output .= '<div class="'.$css_class.'">';
$output .= wpb_js_remove_wpautop($content);
if ( $row_style != 'slider') {
$output .= '</div>';
}
$output .= '</div></div>'.$this->endBlockComment('row');

echo $output;