<?php

/*********** Shortcode: UL Wrapper ************************************************************/

$ABdevDND_shortcodes['ul_dd'] = array(
	'child' => 'li_dd',
	'child_title' => __('List Item', 'dnd-shortcodes'),
	'child_button' => __('Add List Item', 'dnd-shortcodes'),
	'attributes' => array(
		'class' => array(
			'description' => __('Class', 'dnd-shortcodes'),
			'info' => __('Additional custom classes for custom styling', 'dnd-shortcodes'),
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
		'delay' => array(
			'description' => __('Inner Delay (ms)', 'dnd-shortcodes'),
			'default' => '200',
		),		
	),
	'description' => __('Unordered List', 'dnd-shortcodes' )
);
function ABdevDND_ul_dd_shortcode( $attributes, $content = null ) {
	extract(shortcode_atts(ABdevDND_extract_attributes('ul_dd'), $attributes));

	$animation_class = $animation_animation = $animation_duration = $animation_delay = '';
	if (!empty($animation) && $animation!='none'){
		$animation_class = ' dnd-animo-children';
		$animation_animation = ' data-animation="'.$animation.'"';
		$animation_duration = ($duration!='') ? ' data-duration="'.$duration.'"' : ' data-duration="1"';
		$animation_delay = ($delay!='') ? ' data-delay="'.$delay.'"' : ' data-delay="200"';
	}

	return '<ul class="dnd_shortcode_ul '.$class.$animation_class.'"'.$animation_animation.$animation_duration.$animation_delay.'>'.do_shortcode($content).'</ul>';
}


$ABdevDND_shortcodes['li_dd'] = array(
	'hidden' => '1',
	'attributes' => array(
		'icon' => array(
			'default' => 'chevron-right',
			'description' => __('Icon Name', 'dnd-shortcodes'),
		),
		'icon_color' => array(
			'default' => '#666',
			'type' => 'color',
			'description' => __('Icon Color', 'dnd-shortcodes'),
		),
	),
	'content' => array(
		'description' => __('Item Content', 'dnd-shortcodes'),
	),
	'description' => __('List Item', 'dnd-shortcodes' )
);
function ABdevDND_li_dd_shortcode( $attributes, $content = null ) {
	extract(shortcode_atts(ABdevDND_extract_attributes('li_dd'), $attributes));
	$icon_color_out = ($icon_color!='') ? ' style="color:'.$icon_color.';"' : '';
	$icon_out = ($icon!='') ? '<i class="'.$icon.'"'.$icon_color_out.'></i> ' : '';
	return '<li>'.$icon_out.do_shortcode($content).'</li>';
}


