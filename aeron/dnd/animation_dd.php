<?php

/*********** Shortcode: Animation Box ************************************************************/
$ABdevDND_shortcodes['animation_dd'] = array(
	'attributes' => array(
		'animation' => array(
			'default' => 'none',
			'description' => __('Entrance Animation', 'dnd-shortcodes'),
			'type' => 'select',
			'values' => array(
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
			'description' => __('Animation Duration (in ms)', 'dnd-shortcodes'),
			'default' => '1000',
		),		
		'delay' => array(
			'description' => __('Animation Delay (in ms)', 'dnd-shortcodes'),
			'default' => '0',
		),		
		'class' => array(
			'description' => __('Class', 'dnd-shortcodes'),
			'info' => __('Additional custom classes for custom styling', 'dnd-shortcodes'),
		),
	),
	'content' => array(
		'description' => __('Animated Content', 'dnd-shortcodes'),
	),
	'description' => __('Animation Box', 'dnd-shortcodes' )
);
function ABdevDND_animation_dd_shortcode( $attributes, $content = null ) {
	extract(shortcode_atts(ABdevDND_extract_attributes('animation_dd'), $attributes));
	$animation = ($animation!='') ? $animation  : 'fadeIn';
	$duration = ($duration!='') ? $duration : '1000';

	return '<div class="dnd-animo '.$class.'" data-animation="'.$animation.'" data-duration="'.$duration.'" data-delay="'.$delay.'">'.do_shortcode($content).'</div>';
}

