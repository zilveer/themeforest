<?php

/*********** Shortcode: Alert Box ************************************************************/

$ABdevDND_shortcodes['alert_box_dd'] = array(
	'attributes' => array(
		'style' => array(
			'default' => 'info',
			'type' => 'select',
			'values' => array( 
				'info' => 'Info',
				'warning' => 'Warning',
				'error' => 'Error',
				'success' => 'Success',
			),
			'description' => __('Style', 'dnd-shortcodes'),
		),
		'no_icon' => array(
			'default' => '0',
			'type' => 'checkbox',
			'description' => __('No Icon', 'dnd-shortcodes'),
		),
		'no_close' => array(
			'default' => '0',
			'type' => 'checkbox',
			'description' => __('No Close Button', 'dnd-shortcodes'),
		),
	),
	'content' => array(
		'description' => __('Message', 'dnd-shortcodes'),
	),
	'description' => __('Alert Box', 'dnd-shortcodes' )
);
function ABdevDND_alert_box_dd_shortcode( $attributes, $content = null ) {
	extract(shortcode_atts(ABdevDND_extract_attributes('alert_box_dd'), $attributes));
	$allowed_styles = array('warning','error','info','success');
	$style = (in_array($style, $allowed_styles)) ? $style : 'info';
	$style_out = 'dnd_alert_' . $style;
	$icons = array(
		'warning' => 'warning-sign',
		'error' => 'remove',
		'info' => 'comment',
		'success' => 'ok',
	);
	$icon_out = ($no_icon != '1') ? '<i class="ABdev_icon-' . $icons[$style] . '"></i> ' : '';
	$close_button = ( $no_close != 1 ) ? '<a class="dnd_alert_box_close" title="' . __('Close', 'dnd-shortcodes' ) . '">&#10005;</a>' : '';
	return '<div class="'. $style_out . '">
		' . $icon_out . $content . $close_button . '
	</div>';
}


