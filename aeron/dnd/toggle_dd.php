<?php

/*********** Shortcode: Toggle ************************************************************/
$ABdevDND_shortcodes['toggle_dd'] = array(
	'attributes' => array(
		'title' => array(
			'description' => __('Title', 'dnd-shortcodes'),
		),
		'expanded' => array(
			'description' => __('Expanded', 'dnd-shortcodes'),
			'default' => '0',
			'type' => 'checkbox',
		),
	),
	'content' => array(
		'description' => __('Content', 'dnd-shortcodes'),
	),
	'description' => __('Toggle Content', 'dnd-shortcodes' )
);
function ABdevDND_toggle_dd_shortcode( $attributes, $content = null ) {
	extract(shortcode_atts(ABdevDND_extract_attributes('toggle_dd'), $attributes));
	$return = '
		<div class="dnd-accordion dnd-toggle" data-expanded="'.$expanded.'">
			<h3>' . $title . '</h3>
			<div class="dnd-accordion-body">
				' . do_shortcode($content) . '
			</div>
		</div>
		';
  
	return $return;
}

