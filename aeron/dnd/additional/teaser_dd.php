<?php

/*********** Shortcode: Teaser ************************************************************/

$ABdevDND_shortcodes['teaser_dd'] = array(
	'name' => __( 'Teaser', 'dnd-shortcodes' ),
	'description' => __( 'Teaser', 'dnd-shortcodes' ),
	'type' => 'block',
	'category' => __('Content', 'the-creator-vpb' ),
	'attributes' => array(
		'title' => array(
			'description' => __( 'Title', 'dnd-shortcodes' ),
		),
		'teaser_icon' => array(
			'description' => __('Teaser Icon', 'dnd-shortcodes'),
			'info' => __('Optional icon', 'dnd-shortcodes'),
		),
		'url' => array(
			'type' => 'image',
			'description' => __('Select Image', 'dnd-shortcodes'),
		),
		'class' => array(
			'description' => __('Class', 'dnd-shortcodes'),
			'info' => __('Additional custom classes for custom styling', 'dnd-shortcodes'),
		),
	),
	'content' => array(
		'description' => __( 'Content', 'dnd-shortcodes' ),
	),
);

function ABdevDND_teaser_dd_shortcode( $atts, $content = null ) {
	extract( shortcode_atts( ABdevDND_extract_attributes('teaser_dd'), $atts ) );

		return '<div class="dnd-teaser">
			<div class="container">
				<span class="dnd_teaser_title">' .$title. '</span>
				<p>'.do_shortcode($content).'</p>
				<i class="' .$teaser_icon. '"></i>
				<img src="'.$url.'">
			</div>
		</div>';
}



