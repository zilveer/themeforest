<?php

/********** Shortcode: Abbreviation *************************************************************/

$ABdevDND_shortcodes['abbr_dd'] = array(
	'hide_in_dnd' => true,
	'attributes' => array(
		'fullword' => array(
			'info' => 'e.g. Abbreviation',
			'description' => __('Full Word', 'dnd-shortcodes'),
		),
		'abbr' => array(
			'info' => 'e.g. abbr',
			'description' => __('Abbreviation', 'dnd-shortcodes'),
		),
	),
	'description' => __('Abbreviation', 'dnd-shortcodes' )
);
function ABdevDND_abbr_dd_shortcode ( $attributes, $content = null ) {
	extract(shortcode_atts(ABdevDND_extract_attributes('abbr_dd'), $attributes));
	return '<abbr class="dnd-abbr dnd_tooltip" data-gravity="s" title="' . $fullword . '">' . $abbr . '</abbr>';
}

