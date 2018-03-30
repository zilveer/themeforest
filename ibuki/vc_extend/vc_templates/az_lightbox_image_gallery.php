<?php
$output = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$el_class = $this->getExtraClass($el_class);

$img_id = preg_replace('/[^\d]/', '', $image);
$img_popup_id = preg_replace('/[^\d]/', '', $image_popup);
$images = explode(',', $images_gallery);

$thumb_widht_to = (!empty($thumb_widht) ? ' style="width:'.$thumb_widht.'px; display: table-cell;"' : '');
$thumb_display_to = (!empty($thumb_widht) ? ' style="display: inline-block;"' : '');
$thumb_width_img = (!empty($thumb_widht) ? ' width='.$thumb_widht.' ' : '');

$fancy_gallery = (!empty($gallery_name) ? ' data-fancybox-group="'.$gallery_name.'" ' : '');

$image_string = wp_get_attachment_image_src( $img_id, 'full');
$image_string = $image_string[0];

$image_popup_string = wp_get_attachment_image_src( $img_popup_id, 'full');
$image_popup_string = $image_popup_string[0];

$alt = get_post_meta($image, '_wp_attachment_image_alt', true);
if ( !empty($alt) ){
	$alt = get_post_meta($image, '_wp_attachment_image_alt', true);
} else {
	$alt = '';
}

$customImgPopUp = (!empty($image_popup_string)) ? $image_popup_string : $image_string;

$animation_loading_class = null;
if ($animation_loading == "yes") {
	$animation_loading_class = 'animated-content';
}

$animation_effect_class = null;
if ($animation_loading == "yes") {
	$animation_effect_class = $animation_loading_effects;
} else {
	$animation_effect_class = '';
}

$animation_delay_class = null;
if ($animation_loading == "yes" && !empty($animation_delay)) {
	$animation_delay_class = ' data-delay="'.$animation_delay.'"';
}

$css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG,'lightbox lightbox-gallery'.$el_class, $this->settings['base']);
$class = setClass(array($css_class, $animation_loading_class, $animation_effect_class, $responsive_lg, $responsive_md, $responsive_sm, $responsive_xs));

$output .= '<div'.$class.''.$animation_delay_class.''.$thumb_display_to.'>';
$output .= '<a class="fancy-wrap fancybox-thumb" title="'.$alt.'" href="'.$customImgPopUp.'" '.$fancy_gallery.$thumb_widht_to.'>';
$output .= '<span class="overlay-bg-fancy"></span><i class="lightbox-icon fancy-image"></i>';
$output .= '<img class="img-full-responsive" alt="'.$alt.'" src="'.$image_string.'" '.$thumb_width_img.' />';
$output .= '</a>';
// FancyBox Gallery
if(!empty($images_gallery)){
	foreach($images as $image):
		$src = wp_get_attachment_image_src( $image, 'full' );
		$alt = ( get_post_meta($image, '_wp_attachment_image_alt', true) ) ? get_post_meta($image, '_wp_attachment_image_alt', true) : 'Insert Alt Text';
		$output .= '<span class="fancybox-thumb hidden" title="'.$alt.'" href="'.$src[0].'" '.$fancy_gallery.'></span>';
	endforeach;
}
$output .= '</div>'.$this->endBlockComment('az_lightbox_image_gallery')."\n";

echo $output;
