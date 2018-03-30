<?php
if(!function_exists('theme_shortcode_image')){
/**
 * size: small, medium, blog
 * icon:zoom, doc, play
 */
function theme_shortcode_image($atts, $content = null, $code) {
	extract(shortcode_atts(array(
		'size' => 'medium',
		'link' => '#',
		'source_type' => false,
		'source_value' =>false,
		'linktarget' => false,
		'icon' => false,
		'lightbox' => 'false',
		'lightbox_fittoview' => 'true',
		'title' => '',
		'align' => false,
		'group' => '',
		'width' => false,
		'height' => false,
		'effect'=>'icon',//grayscale,icon
		'autoheight' => 'false',
		'quality' => false,
		'caption' => false,
		'fitmobile' => 'false',
		'alt' => '',
		'class' => '',
	), $atts));
	// compatible code
	if(isset($atts['lightbox_restrict']) && !isset($atts['lightbox_fittoview'])){
		$lightbox_fittoview = $atts['lightbox_restrict'];
	}
	// end compatible

	if(!$width){
		$width = theme_get_option('image', $size.'_width');
		if(!$width){
			$width = '150';
		}
	}
	if(!$height){
		$height = theme_get_option('image', $size.'_height');
		if(!$height){
			$height = '150';
		}
	}
	if($autoheight=='true'){
		$height = '';
	}
	$content = trim(strip_tags($content));
	if(!empty($content)){
		$source_type = 'src';
		$source_value = $content;
		$height = '';
	}
	$no_link = '';
	if($lightbox == 'true'){
		if($link == '#'){
			$link = theme_get_image_src(array('type'=>$source_type,'value'=>$source_value));
		}
		if($lightbox_fittoview == 'false'){
			$lightbox_fittoview = ' data-fittoview="false"';
		}else{
			$lightbox_fittoview = ' data-fittoview="true"';
		}
	}else{
		$lightbox_fittoview = '';
		if($link == '#'){
			$no_link = ' image_no_link';
		}
	}
	$data_thumbnail = '';
	if($source_type === 'attachment_id'){
		$data_thumbnail = ' data-thumbnail="'.$source_value.'"';
	}

	$linktarget = $linktarget?' target="'.$linktarget.'"':'';

	if($caption != false){
		$caption_str = '<span class="image_caption">'.$caption.'</span>';
	}else{
		$caption_str = '';
	}
	$image_src = theme_get_image_src(array('type'=>$source_type,'value'=>$source_value), array($width, $height),$quality);
	if(!$image_src){ //dont show image if not exists
		return '';
	}
	if($alt == '' && $source_type == 'attachment_id') {
		$alt = get_post_meta($source_value, '_wp_attachment_image_alt', true);
	}
	if($alt=='') {
		$alt = $title;
	}
	if ( is_feed() ) {
		if($link == '#'){
			return '<img width="'.$width.'" '.((empty($height))?'':'height="'.$height.'"'). 'alt="'.$alt.'" src="'. $image_src.'" />';
		}else{
			return '<a href="'.$link.'"'.$linktarget.'><img width="'.$width.'" '.((empty($height))?'':'height="'.$height.'"'). ' alt="'.$alt.'" src="'.$image_src.'" /></a>';
		}
	}else{
		if($class){
			$class = ' '.$class;
		}

		$content = '<img alt="'.$alt.'" src="'.$image_src.'"'.$data_thumbnail.' />';
		return '<figure class="image_styled'.$class.($align?' align'.$align:'').($fitmobile?' image_fit_mobile':'').'" style="width:'.($width+2).'px;">
		<div class="image_frame effect-'.$effect.'"><div class="image_shadow_wrap">
		<a'.($group?' rel="'.$group.'"':'').$linktarget.$lightbox_fittoview.' class="image_size_'.$size.$no_link.($icon?' image_icon_'.$icon:'').($lightbox =='true'?' lightbox':'').'" title="'.$title.'" href="'.$link.'">' . $content . '</a>
		</div></div>'.$caption_str.'</figure>';
	}
}
}
add_shortcode('image', 'theme_shortcode_image');

if(!function_exists('theme_shortcode_picture_frame')){
function theme_shortcode_picture_frame($atts, $content = null) {
	extract(shortcode_atts(array(
		'title' => '',
		'source_type' => false,
		'source_value' =>false,
		'align' => false
	), $atts));
	
	$content = trim($content);
	if(!empty($content)){
		$source_type = 'src';
		$source_value = $content;
	}
	$image_src = theme_get_image_src(array('type'=>$source_type,'value'=>$source_value), array(106, 126));
	return '<div class="picture_frame'.($align?' align'.$align:'').'"><img width ="106" height="126" alt="'.$title.'" src="'.$image_src.'" /></div>';
}
}
add_shortcode('picture_frame', 'theme_shortcode_picture_frame');
