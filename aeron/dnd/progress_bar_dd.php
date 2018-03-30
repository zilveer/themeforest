<?php

/*********** Shortcode: Progress Bar ************************************************************/

$ABdevDND_shortcodes['progress_bar_dd'] = array(
	'attributes' => array(
		'complete' => array(
			'default' => '60',
			'description' => __('Percentage', 'dnd-shortcodes'),
		),
		'text' => array(
			'description' => __('Text', 'dnd-shortcodes'),
		),
		'bar_color' => array(
			'description' => __('Bar Color', 'dnd-shortcodes'),
			'type' => 'color',
			'default' => '#128ae0',
		),
		'class' => array(
			'description' => __('Class', 'dnd-shortcodes'),
			'info' => __('Additional custom classes for custom styling', 'dnd-shortcodes'),
		),
	),
	'description' => __('Progress Bar', 'dnd-shortcodes' )
);
function ABdevDND_progress_bar_dd_shortcode( $attributes, $content = null ) {
	extract(shortcode_atts(ABdevDND_extract_attributes('progress_bar_dd'), $attributes));

	$bar_color_out = ($bar_color!='') ? 'background:'.$bar_color.';' : '';

	return '
		<div class="dnd_progress_bar '.$class.'">
			<span class="dnd_meter_label">'.$text.'</span>
			<div class="dnd_meter">
				<div class="dnd_meter_percentage" data-percentage="'.$complete.'" style="width: '.$complete.'%;'.$bar_color_out.'"><span>'.$complete.'%</span></div>
			</div>
		</div>';
}

