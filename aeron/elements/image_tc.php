<?php

/*********** Shortcode: Image ************************************************************/

$tcvpb_elements['image_tc'] = array(
	'name' => esc_html__('Image', 'ABdev_aeron' ),
	'type' =>  'block',
	'icon' => 'pi-image',
	'category' =>  esc_html__('Media', 'ABdev_aeron'),
	'attributes' => array(
		'url' => array(
			'type' => 'image',
			'description' => esc_html__('Select Image', 'ABdev_aeron'),
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
		'lightbox' => array(
			'description' => esc_html__( 'Lightbox', 'ABdev_aeron' ),
			'default' => '0',
			'type' => 'checkbox',
		),
		'lightbox_icon' => array(
			'description' => esc_html__( 'Lightbox Icon', 'ABdev_aeron' ),
			'info' => esc_html__('Choose Lightbox Icon that will be shown on hover', 'ABdev_aeron'),
			'type' => 'icon',
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
function tcvpb_image_tc_shortcode( $attributes, $content = null ) {
	extract(shortcode_atts(tcvpb_extract_attributes('image_tc'), $attributes));
	$id_out = ($id!='') ? 'id='.$id.'' : '';

	$classes=array();

	$animation_classes='';
	$animation_out='';
	if($animation!=''){
		$animation_classes = 'tcvpb-animo '.esc_attr($animation).'';
		$animation_out = ' data-trigger_pt="'.esc_attr($trigger_pt).'" data-duration="'.esc_attr($duration).'" data-delay="'.esc_attr($delay).'"';
	}

	if($class!=''){
		$classes[] = $class;
	}

	$classes = implode(' ', $classes);

	$lightbox_icon = ($lightbox_icon!='') ? '<i class="'.esc_attr($lightbox_icon).'"></i>' : '';
	
              
	$return = '<div '.esc_attr($id_out).' class="tcvpb-image '.esc_attr($classes).' '.$animation_classes.'" '.$animation_out.'>';

	if($lightbox == '1') {
		$return .= '<a href="'.esc_url($url).'" class="lightbox" data-lightbox="image"><img src="'.esc_url($url).'">
			<canvas class="grey-effect"></canvas>
			'.$lightbox_icon.'
		</a>';
	}
	else if($link != '') {
		$return .= '<a href="'.esc_url($link).'" target="'.esc_attr($target).'"><img src="'.esc_url($url).'"></a>';
			// $return .= ($overlay_text !='') ? '<canvas class="grey-effect"></canvas><span>'.$overlay_text.'</span>' :'';
		// $return .= '</a>';
	}
	else{
		$return .= '<img src="'.esc_url($url).'">';
	}

	$return .= '</div>';

	return $return;
}
