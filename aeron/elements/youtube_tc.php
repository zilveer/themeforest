<?php

/*********** Shortcode: Youtube ************************************************************/

$tcvpb_elements['youtube_tc'] = array(
	'name' => esc_html__('Youtube', 'ABdev_aeron' ),
	'type' => 'block',
	'icon' => 'pi-youtube',
	'category' =>  esc_html__('Media', 'ABdev_aeron'),
	'attributes' => array(
		'url' => array(
			'description' => esc_html__('Video ID or URL', 'ABdev_aeron'),
		),
		'fullscreen_button' => array(
			'default' => '0',
			'type' => 'checkbox',
			'description' => esc_html__('Fullscreen Button', 'ABdev_aeron'),
		),
		'autoplay' => array(
			'default' => '0',
			'type' => 'checkbox',
			'description' => esc_html__('Autoplay', 'ABdev_aeron'),
		),
		'modestbranding' => array(
			'default' => '0',
			'type' => 'checkbox',
			'description' => esc_html__('Modest Branding', 'ABdev_aeron'),
		),
		'controls' => array(
			'default' => '0',
			'type' => 'checkbox',
			'description' => esc_html__('Controls', 'ABdev_aeron'),
			'divider' => 'true',
		),
		'showinfo' => array(
			'default' => '0',
			'type' => 'checkbox',
			'description' => esc_html__('Show Info Before Play', 'ABdev_aeron'),
		),
		'related' => array(
			'default' => '0',
			'type' => 'checkbox',
			'description' => esc_html__('Show Related When Video Ends', 'ABdev_aeron'),
			'divider' => 'true',
		),
		'start' => array(
			'description' => esc_html__('Start Playing at (in seconds)', 'ABdev_aeron'),
		),
		'end' => array(
			'description' => esc_html__('Stop Playing at (in seconds)', 'ABdev_aeron'),
		),
		'animation' => array(
			'default'     => '',
			'description' => esc_html__('Entrance Animation', 'ABdev_aeron'),
			'type'        => 'select',
			'tab'         => esc_html__('Animation', 'ABdev_aeron'),
			'values'      => array(
				''                  => esc_html__('None', 'ABdev_aeron'),
				'animate_fade'      => esc_html__('Fade', 'ABdev_aeron'),
				'animate_afc'       => esc_html__('Zoom', 'ABdev_aeron'),
				'animate_afl'       => esc_html__('Fade to Right', 'ABdev_aeron'),
				'animate_afr'       => esc_html__('Fade to Left', 'ABdev_aeron'),
				'animate_aft'       => esc_html__('Fade Down', 'ABdev_aeron'),
				'animate_afb'       => esc_html__('Fade Up', 'ABdev_aeron'),
			),
		),
		'trigger_pt' => array(
			'description' => esc_html__('Trigger Point (in px)', 'ABdev_aeron'),
			'info'        => esc_html__('Amount of pixels from bottom to start animation', 'ABdev_aeron'),
			'default'     => '0',
			'tab'         => esc_html__('Animation', 'ABdev_aeron'),
		),
		'duration' => array(
			'description' => esc_html__('Animation Duration (in ms)', 'ABdev_aeron'),
			'default'     => '1000',
			'tab'         => esc_html__('Animation', 'ABdev_aeron'),
		),
		'delay' => array(
			'description' => esc_html__('Animation Delay (in ms)', 'ABdev_aeron'),
			'default'     => '0',
			'tab'         => esc_html__('Animation', 'ABdev_aeron'),
		),
		'id' => array(
			'description' => esc_html__('ID', 'ABdev_aeron'),
			'info' => esc_html__('Additional custom ID', 'ABdev_aeron'),
			'tab' => esc_html__('Advanced', 'ABdev_aeron'),
		),
		'class' => array(
			'description' => esc_html__('Class', 'ABdev_aeron'),
			'info' => esc_html__('Additional custom classes for custom styling', 'ABdev_aeron'),
			'tab' => esc_html__('Advanced', 'ABdev_aeron'),
		),
	),
);
function tcvpb_youtube_tc_shortcode($attributes) {
	extract(shortcode_atts(tcvpb_extract_attributes('youtube_tc'), $attributes));
	$id_out = ($id!='') ? 'id='.$id.'' : '';

	$animation_classes='';
	$animation_out='';
	if($animation!=''){
		$animation_classes = 'tcvpb-animo '.esc_attr($animation).'';
		$animation_out = ' data-trigger_pt="'.esc_attr($trigger_pt).'" data-duration="'.esc_attr($duration).'" data-delay="'.esc_attr($delay).'"';
	}

	$options_output = '?autoplay='.$autoplay.'&amp;modestbranding='.$modestbranding.'&amp;controls='.$controls.'&amp;fs='.$fullscreen_button.'&amp;start='.$start.'&amp;end='.$end.'&amp;showinfo='.$showinfo.'&amp;rel='.$related;

	if(strlen($id)==11){
		$video_src='http://www.youtube.com/embed/'.$url.$options_output;
	}
	else{
		parse_str( parse_url( $url, PHP_URL_QUERY ), $my_array_of_vars );
		$video_src='http://www.youtube.com/embed/'.$my_array_of_vars['v'].$options_output;
	}

	return '<div '.esc_attr($id_out).' class="tcvpb-videoWrapper-youtube '.esc_attr($class).' '.$animation_classes.'" '.$animation_out.'><iframe src="'.esc_url($video_src).'" frameborder="0" allowfullscreen></iframe></div>';
}


