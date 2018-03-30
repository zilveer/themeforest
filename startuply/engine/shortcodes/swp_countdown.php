<?php

/*-----------------------------------------------------------------------------------*/
/*	Countdown VC Mapping (Backend)
/*-----------------------------------------------------------------------------------*/
			vc_map(array(
				'name' => __('Countdown', 'vivaco'),
				'base' => 'vsc-countdown',
				'description' => 'Countdown',
				'weight' => 15,
				'class' => 'vsc_countdown',
				'category' => __('Content', 'vivaco'),
				'params' => array(
					array(
						'type' => 'dropdown',
						'heading' => __('Style', 'vivaco'),
						'param_name' => 'layout',
						'value' => array(
							__('Default','js_composer') => 'normal',
							__('Inline','js_composer') => 'line',
							/*__('Boxed','js_composer') => 'boxed',*/
						),
					),
					array(
						'type' => 'dropdown',
						'heading' => __('Count Type ( down or up )', 'vivaco'),
						'param_name' => 'count',
						'value' => array(
							__('Down','js_composer') => 'down',
							__('Up','js_composer') => 'up',
						),
						'std' => 'down',
					),
					array(
						'type' => 'textfield',
						'param_name' => 'notice_countdown',
						'description' => '<p class="alert alert-info">Yeah, You choose countup, be sure for date. you must write a older date. eg for 1 day ago. <strong>'. date( 'M d Y', strtotime('-1 days') ) .'</strong></p>',
						'dependency' => array(
							'element' => 'count',
							'value' => 'up'
						),
					),
					array(
						'type' => 'textfield',
						'heading' => __('Date', 'vivaco'),
						'param_name' => 'date',
						'value' => date( 'M d Y' ),
						'description' => __('Currently value is today, change date, write your own upcoming date', 'vivaco'),
					),
					array(
						'type' => 'textfield',
						'heading' => __('Format', 'vivaco'),
						'param_name' => 'format',
						'value' => 'yowdhms',
						'description' => __('Currently value is today, change date, write your own upcoming date', 'vivaco'),
					),
					array(
						'type' => 'textfield',
						'param_name' => 'notice_countdown_format',
						'description' => '
							<p class="alert alert-info">
								<strong>y</strong>: year <strong>o</strong>: month <strong>w</strong>: week <strong>d</strong>: day <strong>h</strong>: hour <strong>m</strong>: minuites <strong>s</strong>: second<br /><br />
								if you write <strong>YOWDHMS</strong> as uppercase this is mean optional if there is year it will show else hide.<br />
								Eg. Formats: <strong>dhms</strong> or <strong>wdh</strong> or <strong>od</strong> you know...
							</p>',
					),
					array(
						'type' => 'textfield',
						'heading' => __('Timer end message', 'vivaco'),
						'param_name' => 'message',
						'value' => 'Countdown target date/time reached! Counter is hidden now',
						'description' => __('Set custom message to show after timer reaches the targer fate/time', 'vivaco'),
					),
					array(
						'type' => 'textfield',
						'heading' => __('Date font size in px', 'vivaco'),
						'param_name' => 'num_size',
						'value' => '',
						'description' => __('Adjust number text size here', 'vivaco'),
					),
					array(
						'type' => 'textfield',
						'heading' => __('Text font size in px', 'vivaco'),
						'param_name' => 'txt_size',
						'value' => '',
						'description' => __('Adjust number text size here', 'vivaco'),
					),
					array(
						'type' => 'colorpicker',
						'group' => 'Change color',
						'heading' => __('Custom Number Color', 'vivaco'),
						'param_name' => 'number_color',
					),
					array(
						'type' => 'colorpicker',
						'group' => 'Change color',
						'heading' => __('Custom Text Color', 'vivaco'),
						'param_name' => 'text_color',
					),

					array(
						'type' => 'colorpicker',
						'group' => 'Change color',
						'heading' => __('Custom Separator Color', 'vivaco'),
						'param_name' => 'separator_color',
					),
				)
			));





/*-----------------------------------------------------------------------------------*/
/*	Countdown Render (Front-end)
/*-----------------------------------------------------------------------------------*/
function vsc_countdown($atts, $content = null) {
	extract( shortcode_atts( array(
		'layout' => '',
		'count' => 'down',
		'notice_countdown' => '',
		'date' => '',
		'format' => '',
		'notice_countdown_format' => '',
		'number_color' => '',
		'text_color' => '',
		'separator_color' => '',
		'num_size' => '',
		'txt_size' => '',
		'message' => '',
	), $atts ) );

	wp_enqueue_script( 'vsc-countdown' );

	$format = ( $format ) ? ' data-format="'. $format .'"' : '';
	$count = ( $count ) ? ' data-count="'. $count .'"' : '';

	$uniqid_class = '';
	$endTxt = '';
	$output = '';

	if ( $number_color || $text_color || $separator_color || $num_size || $txt_size) {
		$uniqid = uniqid();
		$uniqid_class = ' vsc-countdown-'. $uniqid;
		$custom_style = '';

		$custom_style .= ( $number_color ) ? '.vsc-countdown.vsc-countdown-'. $uniqid .' .countdown-section .countdown-amount{color:'. $number_color .';}' : '';
		$custom_style .= ( $text_color ) ? '.vsc-countdown.vsc-countdown-'. $uniqid .' .countdown-section .countdown-period{color:'. $text_color .';}' : '';
		$custom_style .= ( $separator_color ) ? '.vsc-countdown.vsc-countdown-'. $uniqid .' .countdown-section:after{background-color:'. $separator_color .';}' : '';
		$custom_style .= ( $num_size ) ? '.vsc-countdown.vsc-countdown-'. $uniqid .' .countdown-section .countdown-amount {font-size:'. $num_size .';}' : '';
		$custom_style .= ( $txt_size ) ? '.vsc-countdown.vsc-countdown-'. $uniqid .' .countdown-section .countdown-period {font-size:'. $txt_size .';}' : '';

		$output .= '<style id="custom-shortcode-css-'.$uniqid.'" type="text/css">'. vsc_css_compress( $custom_style ) .'</style>';
	}
	
	$countdownDate = new DateTime($date);
	$now = new DateTime();
	
	if($countdownDate < $now) {
		$endTxt = '<p class="text-center">'.$message.'</p>';
	}

	$output .= '<span class="vsc-countdown vsc-countdown-'. $layout . $uniqid_class .'" data-date="'. $date .'"'. $format . $count .'></span>';
	return $output.$endTxt;
}
add_shortcode("vsc-countdown", "vsc_countdown");
