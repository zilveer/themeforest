<?php

/*********** Shortcode: Vimeo ************************************************************/

$ABdevDND_shortcodes['vimeo_dd'] = array(
	'attributes' => array(
		'id' => array(
			'description' => __('Video ID or URL', 'dnd-shortcodes'),
		),
		'title' => array(
			'default' => '0',
			'type' => 'checkbox',
			'description' => __('Show Title', 'dnd-shortcodes'),
		),
		'byline' => array(
			'default' => '0',
			'type' => 'checkbox',
			'description' => __('Show By Line', 'dnd-shortcodes'),
		),
		'portrait' => array(
			'default' => '0',
			'type' => 'checkbox',
			'description' => __('Show Portrait', 'dnd-shortcodes'),
		),
		'autoplay' => array(
			'default' => '0',
			'type' => 'checkbox',
			'description' => __('Autoplay', 'dnd-shortcodes'),
		),
		'loop' => array(
			'default' => '0',
			'type' => 'checkbox',
			'description' => __('Loop Playing', 'dnd-shortcodes'),
		),
		'color' => array(
			'type' => 'color',
			'default' => '#00ADEF',
			'description' => __('Controls Color', 'dnd-shortcodes'),
		),
	),
	'description' => __('Vimeo Video', 'dnd-shortcodes' )
);
function ABdevDND_vimeo_dd_shortcode($attributes) {
	extract(shortcode_atts(ABdevDND_extract_attributes('vimeo_dd'), $attributes));

	$color = trim($color, '#');
	
	if (strpos($id,'http') !== false) 
		$id = strtok(basename($id), '_');

	$video_src='http://player.vimeo.com/video/'.$id.'?title='.$title.'&amp;byline='.$byline.'&amp;portrait='.$portrait.'&amp;autoplay='.$autoplay.'&amp;loop='.$loop.'&amp;color='.$color;

	return '<div class="dnd-videoWrapper-vimeo"><iframe src="'.$video_src.'" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe></div>';
}



