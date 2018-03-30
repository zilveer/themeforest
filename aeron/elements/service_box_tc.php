<?php

/*********** Shortcode: Service box ************************************************************/

$tcvpb_elements['service_box_tc'] = array(
	'name' => esc_html__('Service box', 'ABdev_aeron' ),
	'type' => 'block',
	'icon' => 'pi-service-box',
	'category' =>  esc_html__('Content', 'ABdev_aeron'),
	'attributes' => array(
		'title' => array(
			'description' => esc_html__('Title', 'ABdev_aeron'),
		),
		'type' => array(
			'description' => esc_html__('Type', 'ABdev_aeron'),
			'default' => 'round',
			'type' => 'select',
			'values' => array(
				'square' =>  __('Square', 'ABdev_aeron'),
				'square_aside' => __('Square Aside', 'ABdev_aeron'),
				'square_aside_right' => __('Square Aside With Icon Right', 'ABdev_aeron'),
			),
			'divider' => 'true',
		),
		'link' => array(
			'description' => esc_html__('Link', 'ABdev_aeron'),
			'type' => 'url',
		),
		'target' => array(
			'description' => esc_html__('Target', 'ABdev_aeron'),
			'default' => '_self',
			'type' => 'select',
			'values' => array(
				'_self' =>  esc_html__('Self', 'ABdev_aeron'),
				'_blank' => esc_html__('Blank', 'ABdev_aeron'),
			),
			'divider' => 'true',
		),
		'icon' => array(
			'description' => esc_html__('Icon', 'ABdev_aeron'),
			'type' => 'icon',
			'divider' => 'true',
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
	'content' => array(
		'description' => esc_html__('Content', 'ABdev_aeron'),
	),
);
function tcvpb_service_box_tc_shortcode( $attributes, $content = null ) {
	extract(shortcode_atts(tcvpb_extract_attributes('service_box_tc'), $attributes));
	$id_out = ($id!='') ? 'id='.$id.'' : '';

	$animation_classes='';
	$animation_out='';
	if($animation!=''){
		$animation_classes = 'tcvpb-animo '.esc_attr($animation).'';
		$animation_out = ' data-trigger_pt="'.esc_attr($trigger_pt).'" data-duration="'.esc_attr($duration).'" data-delay="'.esc_attr($delay).'"';
	}

	$class = ' tcvpb_service_box_'.$type . ' ' . $class;

	$return = '
		<div '.esc_attr($id_out).' class="tcvpb_service_box'.esc_attr($class).' '.$animation_classes.'" '.$animation_out.'>
			<div class="tcvpb_service_box_header">';

			$return .= ($link!='') ? '<a href="'.esc_url($link).'" target="'.$target.'" class="tcvpb_icon_boxed"><i class="'.esc_attr($icon).'"></i></a>' : '<div class="tcvpb_icon_boxed"><i class="'.esc_attr($icon).'"></i></div>';
			$return .= ($link!='') ? '<a href="'.esc_url($link).'" target="'.$target.'"><h4>'.$title.'</h4></a>' : '<h4>'.$title.'</h4>';
			
			$return .= '</div>
			'.do_shortcode($content).'
		</div>';

	return $return;
}

