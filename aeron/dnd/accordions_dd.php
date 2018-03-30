<?php

/*********** Shortcode: Accordions ************************************************************/

$ABdevDND_shortcodes['accordions_dd'] = array(
	'child' => 'accordion_dd',
	'child_button' => __('New Accordion Section', 'dnd-shortcodes'),
	'child_title' => __('Accordion Section', 'dnd-shortcodes'),
	'attributes' => array(
		'expanded' => array(
			'description' => __('Expanded accordion no.', 'dnd-shortcodes'),
			'info' => __('Which accordion section will be expanded on load, 0 for none', 'dnd-shortcodes'),
			'default' => '0',
		),
	),
	'description' => __('Accordion', 'dnd-shortcodes' )
);
function ABdevDND_accordions_dd_shortcode( $attributes, $content = null ) {
	extract(shortcode_atts(ABdevDND_extract_attributes('accordions_dd'), $attributes));
	return '<div class="dnd-accordion" data-expanded="'.$expanded.'">'.  do_shortcode($content)  . '</div>';
}

$ABdevDND_shortcodes['accordion_dd'] = array(
	'hidden' => '1',
	'attributes' => array(
		'title' => array(
			'description' => __('Title', 'dnd-shortcodes'),
		),
	),
	'content' => array(
		'description' => __('Content', 'dnd-shortcodes'),
	),
	'description' => __('Single accordion section', 'dnd-shortcodes' )
);
function ABdevDND_accordion_dd_shortcode( $attributes, $content = null ) {
	extract(shortcode_atts(ABdevDND_extract_attributes('accordion_dd'), $attributes));
	$return = '
		<h3>' . $title . '</h3>
		<div class="dnd-accordion-body">
			' . do_shortcode($content) . '
		</div>';
  
	return $return;
}


