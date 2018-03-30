<?php

/*********** Shortcode: Search ************************************************************/

$tcvpb_elements['search_tc'] = array(
	'name' => esc_html__('Search Field', 'ABdev_aeron' ),
	'type' => 'block',
	'icon' => 'pi-search',
	'category' => esc_html__('Content', 'ABdev_aeron' ),
	'attributes' => array(
		'placeholder' => array(
			'description' => esc_html__('Placeholder', 'ABdev_aeron'),
			'default' => esc_html__('Search', 'ABdev_aeron'),
		),
		'input_background' => array(
			'description' => esc_html__('Background Color on input', 'ABdev_aeron'),
			'type' => 'coloralpha',
			'info' => esc_html__('Pick a color for input background.', 'ABdev_aeron'),
			'divider' => 'true',
		),
		'border_color' => array(
			'description' => esc_html__('Border Color', 'ABdev_aeron'),
			'type' => 'coloralpha',
			'info' => esc_html__('Pick a color for input border.', 'ABdev_aeron'),
		),
		'border_radius' => array(
			'description' => esc_html__('Border Radius (px)', 'ABdev_aeron'),
			'type' => 'string',
			'default' => '0',
			'info' => esc_html__('Set a number for border radius on input.', 'ABdev_aeron'),
			'divider' => 'true',
		),
		'icon' => array(
			'description' => esc_html__('Icon', 'ABdev_aeron'),
			'type' => 'icon',
		),
		'icon_color' => array(
			'description' => esc_html__('Icon Color', 'ABdev_aeron'),
			'type' => 'color',
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
function tcvpb_search_tc_shortcode( $attributes, $content = null ) {
	extract(shortcode_atts(tcvpb_extract_attributes('search_tc'), $attributes));
	$id_out = ($id!='') ? 'id='.$id.'' : '';

	$animation_classes='';
	$animation_out='';
	if($animation!=''){
		$animation_classes = 'tcvpb-animo '.esc_attr($animation).'';
		$animation_out = ' data-trigger_pt="'.esc_attr($trigger_pt).'" data-duration="'.esc_attr($duration).'" data-delay="'.esc_attr($delay).'"';
	}

	$border_color_output = ($border_color!='') ? 'border-color:' .$border_color.'; ' : '';
	$border_radius_output = ($border_radius!='') ? 'border-radius:' .$border_radius.'px; ' : '';
	$input_background_output = ($input_background!='') ? 'background:' .$input_background.'; ' : '';
	$input_background_output = ($input_background!='') ? 'background:' .$input_background.'; ' : '';
	$icon_color = ($icon_color!='') ? 'color: '.$icon_color.';' : '';

	$return = '
		<div '.esc_attr($id_out).' class="tcvpb_search '.esc_attr($class).' '.$animation_classes.'" '.$animation_out.'>
			<form name="search" id="search" method="get" action="'.esc_url(home_url()).'">
				<input name="s" type="text" placeholder="'.esc_attr($placeholder).'" value="'.esc_attr(get_search_query()).'" style="'.esc_attr($border_color_output).' '.esc_attr($border_radius_output).' '.esc_attr($input_background_output).'">
				<a class="submit" style="'.esc_attr($icon_color).'"><i class="'.esc_attr($icon).'"></i></a>
			</form>
		</div>';

	return $return;
}

