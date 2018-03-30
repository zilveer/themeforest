<?php

extract(shortcode_atts(array(
	'image_width' => 500,
	'image_height' => 350,
	'crop' => 'true',
	'hover_style' => 'style1',
	'margin_bottom' => 10,
	'src' => '',
	'animation' => '',
	'align' => 'left',
	'custom_url' => '',
	'target' => '_self',
	'hover' => 'true',
	'custom_lightbox_url' => '',
	'group' => 'shortcode',
	'el_class' => '',
	'lightbox_ifarme' => 'false',
	'visibility' => '',
	'circular' => 'false',
), $atts));

$output = '';


require_once THEME_INCLUDES . "/image-cropping.php";	

$animation_css = ($animation != '') ? (' mk-animate-element ' . $animation . ' ') : '';

$image_id = mk_get_attachment_id_from_url($src);
$alt = get_post_meta($image_id, '_wp_attachment_image_alt', true);
$title = get_the_title($image_id);

$output .= '<div class="mk-image circular-'.$circular.' align-' . $align . ' ' . $hover_style . '-image ' . $visibility . ' ' . $animation_css . $el_class . '" style="max-width: ' . $image_width . 'px; margin-bottom:' . $margin_bottom . 'px" onClick="return true">';


if ($crop == 'true') {
	$image_src = bfi_thumb($src, array('width' => $image_width, 'height' => $image_height, 'crop' => true));
	$output .= '<img alt="' . $alt . '" title="' . $title . '" src="' . $image_src . '" />';
} else {
	$output .= '<img alt="' . $alt . '" title="' . $title . '" src="' . $src . '" />';
}

$output .= ($custom_url != '') ? '<a target="' . $target . '" href="' . $custom_url . '" title="' . $title . '" class="full-cover-link">&nbsp</a>' : '';

if ($hover != 'false') {
	$output .= '<div class="hover-overlay"></div>';

	$output .= '<div class="mk-image-hover">';

	//if ($custom_url == ''){
		$lightbox_src = !empty($custom_lightbox_url) ? $custom_lightbox_url : $src;
		$lightbox_ifarme = ($lightbox_ifarme == 'true') ? ' fancybox.iframe' : '';
		$output .= ($hover != 'false') ? '<a href="' . $lightbox_src . '" title="' . $title . '" rel="image-' . $group . '" class="mk-lightbox' . $lightbox_ifarme . '"><i class="mk-theme-icon-plus"></i></a>' : '';
	//}

	if (!empty($title)) {
		$output .= '<div class="mk-image-caption">' . $title . '</div>';
	}

	$output .= '</div>';
}


$output .= '<div class="clearboth"></div></div>';

echo $output;
