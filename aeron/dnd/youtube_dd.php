<?php

/*********** Shortcode: Youtube ************************************************************/

$ABdevDND_shortcodes['youtube_dd'] = array(
	'attributes' => array(
		'id' => array(
			'description' => __('Video ID or URL', 'dnd-shortcodes'),
		),
		'fullscreen_button' => array(
			'default' => '0',
			'type' => 'checkbox',
			'description' => __('Fullscreen Button', 'dnd-shortcodes'),
		),
		'autoplay' => array(
			'default' => '0',
			'type' => 'checkbox',
			'description' => __('Autoplay', 'dnd-shortcodes'),
		),
		'modestbranding' => array(
			'default' => '0',
			'type' => 'checkbox',
			'description' => __('Modest Branding', 'dnd-shortcodes'),
		),
		'controls' => array(
			'default' => '0',
			'type' => 'checkbox',
			'description' => __('Controls', 'dnd-shortcodes'),
		),
		'showinfo' => array(
			'default' => '0',
			'type' => 'checkbox',
			'description' => __('Show Info Before Play', 'dnd-shortcodes'),
		),
		'related' => array(
			'default' => '0',
			'type' => 'checkbox',
			'description' => __('Show Related When Video Ends', 'dnd-shortcodes'),
		),
		'start' => array(
			'description' => __('Start Playing at (in seconds)', 'dnd-shortcodes'),
		),
		'end' => array(
			'description' => __('Stop Playing at (in seconds)', 'dnd-shortcodes'),
		),
	),
	'description' => __('Youtube Video Embed', 'dnd-shortcodes' )
);
function ABdevDND_youtube_dd_shortcode($attributes) {
	extract(shortcode_atts(ABdevDND_extract_attributes('youtube_dd'), $attributes));
	
	$options_output = '?autoplay='.$autoplay.'&amp;modestbranding='.$modestbranding.'&amp;controls='.$controls.'&amp;fs='.$fullscreen_button.'&amp;start='.$start.'&amp;end='.$end.'&amp;showinfo='.$showinfo.'&amp;rel='.$related;
	
	if(strlen($id)==11){ 
		$video_src='http://www.youtube.com/embed/'.$id.$options_output;
	}
	else{
		parse_str( parse_url( $id, PHP_URL_QUERY ), $my_array_of_vars );
		$video_src='http://www.youtube.com/embed/'.$my_array_of_vars['v'].$options_output;
	}
	
	return '<div class="dnd-videoWrapper-youtube"><iframe src="'.$video_src.'" frameborder="0" allowfullscreen></iframe></div>';
}


