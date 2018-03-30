<?php

/********** Shortcode: Text *************************************************************/

$ABdevDND_shortcodes['text_dd'] = array(
	'attributes' => array(
		'class' => array(
			'description' => __('Class', 'dnd-shortcodes'),
			'info' => __('Additional custom classes for custom styling', 'dnd-shortcodes'),
		),
	),
	'content' => array(
		'default' => '',
		'description' => __('Content', 'dnd-shortcodes'),
	),
	'description' => __('Text / HTML', 'dnd-shortcodes'),
	'info' => __('This shortcode is used by drag and drop builder to wrap text content inside column, so it can be manipulated as element', 'dnd-shortcodes'),
);
function ABdevDND_text_dd_shortcode ( $attributes, $content = null ) {
	extract(shortcode_atts(ABdevDND_extract_attributes('text_dd'), $attributes));
	$return = ($class!='') ? '<div class="'.$class.'">'.do_shortcode($content).'</div>' : do_shortcode($content);
	return $return;
}
