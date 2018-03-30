<?php
/**
 * displays some content in a lightbox
 *
 * icons: zoom, doc, play
 */
function wpv_shortcode_lightbox($atts, $content = null, $code) {
	extract(shortcode_atts(array(
		'href' => '#',
		'title' => '',
		'group' => '',
		'iframe' => 'false',
	), $atts));

	$content = do_shortcode($content);

	return '<a title="'.$title.'" href="'.$href.'"'.($group?' rel="'.$group.'"':'').' class="vamtam-lightbox" data-iframe="'.$iframe.'">'.$content.'</a>';
}

add_shortcode('lightbox', 'wpv_shortcode_lightbox');