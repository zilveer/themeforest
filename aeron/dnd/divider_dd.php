<?php

/*********** Shortcode: Content Divider ************************************************************/

$ABdevDND_shortcodes['divider_dd'] = array(
	'attributes' => array(
		'text' => array(
			'description' => __('Text', 'dnd-shortcodes'),
			'info' => __('e.g. Go to top', 'dnd-shortcodes'),
		),
		'icon' => array(
			'default' => '0',
			'type' => 'checkbox',
			'description' => __('With Icon', 'dnd-shortcodes'),
		),
		'style' => array(
			'default' => 'style1',
			'description' => __('Divider Style', 'dnd-shortcodes'),
			'type' => 'select',
			'values' => array(
				'solid' => 'Solid Line',
				'dashed' => 'Dashed Line',
				'dotted' => 'Dotted Line',
			),
		),
		'animation' => array(
			'default' => 'none',
			'description' => __('Entrance Animation', 'dnd-shortcodes'),
			'type' => 'select',
			'values' => array(
				'none' => __('None', 'dnd-shortcodes'),
				'flip' => __('Flip', 'dnd-shortcodes'),
				'flipInX' => __('Flip In X', 'dnd-shortcodes'),
				'flipInY' => __('Flip In Y', 'dnd-shortcodes'),
				'fadeIn' => __('Fade In', 'dnd-shortcodes'),
				'fadeInUp' => __('Fade In Up', 'dnd-shortcodes'),
				'fadeInDown' => __('Fade In Down', 'dnd-shortcodes'),
				'fadeInLeft' => __('Fade In Left', 'dnd-shortcodes'),
				'fadeInRight' => __('Fade In Right', 'dnd-shortcodes'),
				'fadeInUpBig' => __('Fade In Up Big', 'dnd-shortcodes'),
				'fadeInDownBig' => __('Fade In Down Big', 'dnd-shortcodes'),
				'fadeInLeftBig' => __('Fade In Left Big', 'dnd-shortcodes'),
				'fadeInRightBig' => __('Fade In Right Big', 'dnd-shortcodes'),
				'slideInLeft' => __('Slide In Left', 'dnd-shortcodes'),
				'slideInRight' => __('Slide In Right', 'dnd-shortcodes'),
				'bounceIn' => __('Bounce In', 'dnd-shortcodes'),
				'bounceInDown' => __('Bounce In Down', 'dnd-shortcodes'),
				'bounceInUp' => __('Bounce In Up', 'dnd-shortcodes'),
				'bounceInLeft' => __('Bounce In Left', 'dnd-shortcodes'),
				'bounceInRight' => __('Bounce In Right', 'dnd-shortcodes'),
				'rotateIn' => __('Rotate In', 'dnd-shortcodes'),
				'rotateInDownLeft' => __('Rotate In Down Left', 'dnd-shortcodes'),
				'rotateInDownRight' => __('Rotate In Down Right', 'dnd-shortcodes'),
				'rotateInUpLeft' => __('Rotate In Up Left', 'dnd-shortcodes'),
				'rotateInUpRight' => __('Rotate In Up Right', 'dnd-shortcodes'),
				'lightSpeedIn' => __('Light Speed In', 'dnd-shortcodes'),
				'rollIn' => __('Roll In', 'dnd-shortcodes'),
				'flash' => __('Flash', 'dnd-shortcodes'),
				'bounce' => __('Bounce', 'dnd-shortcodes'),
				'shake' => __('Shake', 'dnd-shortcodes'),
				'tada' => __('Tada', 'dnd-shortcodes'),
				'swing' => __('Swing', 'dnd-shortcodes'),
				'wobble' => __('Wobble', 'dnd-shortcodes'),
				'pulse' => __('Pulse', 'dnd-shortcodes'),
			),
		),
		'duration' => array(
			'description' => __('Animation Duration (ms)', 'dnd-shortcodes'),
			'default' => '1100',
		),		
	),
	'description' => __('Content Divider', 'dnd-shortcodes' )
);
function ABdevDND_divider_dd_shortcode( $attributes ) {
    extract(shortcode_atts(ABdevDND_extract_attributes('divider_dd'), $attributes));
	$icon_output=($icon=='1')?' <i class="ABdev_icon-chevron-up"></i>':'';
	$divider_style = ($style != '') ? 'dnd_divider_'.$style.'' : '';

	$animation_class = $animation_animation = $animation_duration = '';
	if (!empty($animation) && $animation!='none'){
		$animation_class = ' dnd-animo';
		$animation_animation = ' data-animation="'.$animation.'"';
		$animation_duration = ($duration!='') ? ' data-duration="'.$duration.'"' : ' data-duration="1"';
	}

	return '<div class="dnd_divider '.$divider_style.'"><a href="#" class="backtotop'.$animation_class.'"'.$animation_animation.$animation_duration.'>'.$text.$icon_output.'</a></div>';
}


