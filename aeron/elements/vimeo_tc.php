<?php

/*********** Shortcode: Vimeo ************************************************************/

$tcvpb_elements['vimeo_tc'] = array(
	'name' => esc_html__('Vimeo', 'ABdev_aeron' ),
	'type' => 'block',
	'icon' => 'pi-vimeo',
	'category' =>  esc_html__('Media', 'ABdev_aeron'),
	'attributes' => array(
		'id' => array(
			'description' => esc_html__('Video ID or URL', 'ABdev_aeron'),
			'divider' => 'true',
		),
		'title' => array(
				'description' => esc_html__('Video Title', 'ABdev_aeron'),
		),
		'title' => array(
			'default' => '0',
			'type' => 'checkbox',
			'description' => esc_html__('Show Title', 'ABdev_aeron'),
		),
		'byline' => array(
			'default' => '0',
			'type' => 'checkbox',
			'description' => esc_html__('Show By Line', 'ABdev_aeron'),
		),
		'portrait' => array(
			'default' => '0',
			'type' => 'checkbox',
			'description' => esc_html__('Show Portrait', 'ABdev_aeron'),
			'divider' => 'true',
		),
		'autoplay' => array(
			'default' => '0',
			'type' => 'checkbox',
			'description' => esc_html__('Autoplay', 'ABdev_aeron'),
		),
		'loop' => array(
			'default' => '0',
			'type' => 'checkbox',
			'description' => esc_html__('Loop Playing', 'ABdev_aeron'),
			'divider' => 'true',
		),
		'color' => array(
			'type' => 'color',
			'default' => '#00ADEF',
			'description' => esc_html__('Controls Color', 'ABdev_aeron'),
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
		'ids' => array(
			'description' => esc_html__('ID', 'ABdev_aeron'),
			'info' => esc_html__('Additional custom ID', 'ABdev_aeron'),
			'tab' => esc_html__('Advanced', 'ABdev_aeron'),
		),
		'class' => array(
			'description' => esc_html__('Class', 'ABdev_aeron'),
			'info' => esc_html__('Additional custom classes for custom styling', 'ABdev_aeron'),
			'tab' => esc_html__('Advanced', 'ABdev_aeron'),
		),
	)
);
function tcvpb_vimeo_tc_shortcode($attributes) {
	extract(shortcode_atts(tcvpb_extract_attributes('vimeo_tc'), $attributes));
	$ids_out = ($ids!='') ? 'id='.$ids.'' : '';

	$animation_classes='';
	$animation_out='';
	if($animation!=''){
		$animation_classes = 'tcvpb-animo '.esc_attr($animation).'';
		$animation_out = ' data-trigger_pt="'.esc_attr($trigger_pt).'" data-duration="'.esc_attr($duration).'" data-delay="'.esc_attr($delay).'"';
	}

	$color = trim($color, '#');

	if (strpos($id,'http') !== false)
		$id = strtok(basename($id), '_');

	$video_src='http://player.vimeo.com/video/'.$id.'?title='.$title.'&amp;byline='.$byline.'&amp;portrait='.$portrait.'&amp;autoplay='.$autoplay.'&amp;loop='.$loop.'&amp;color='.$color;

	return '<div '.esc_attr($ids_out).' class="tcvpb-videoWrapper-vimeo '.esc_attr($class).' '.$animation_classes.'" '.$animation_out.'><iframe src="'.esc_url($video_src).'" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe></div>';
}



