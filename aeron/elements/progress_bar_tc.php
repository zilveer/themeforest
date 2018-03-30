<?php

/*********** Shortcode: Progress Bar ************************************************************/

$tcvpb_elements['progress_bar_tc'] = array(
	'name' => esc_html__('Progress bar', 'ABdev_aeron' ),
	'type' => 'block',
	'icon' => 'pi-progress-bar',
	'category' =>  esc_html__('Charts', 'ABdev_aeron'),
	'attributes' => array(
		'complete' => array(
			'default' => '60',
			'description' => esc_html__('Percentage', 'ABdev_aeron'),
		),
		'text' => array(
			'description' => esc_html__('Text', 'ABdev_aeron'),
		),
		'bar_color_start' => array(
			'description' => esc_html__('Bar Color Start', 'ABdev_aeron'),
			'type' => 'color',
		),
		'bar_color_end' => array(
			'description' => esc_html__('Bar Color End', 'ABdev_aeron'),
			'type' => 'color',
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
	'description' => esc_html__('Progress Bar', 'ABdev_aeron' )
);
function tcvpb_progress_bar_tc_shortcode( $attributes, $content = null ) {
	extract(shortcode_atts(tcvpb_extract_attributes('progress_bar_tc'), $attributes));
	$id_out = ($id!='') ? 'id='.$id.'' : '';

	$bar_color_out = ($bar_color_start!='') ? 'background:linear-gradient(to right,' .esc_attr($bar_color_start).',' .esc_attr($bar_color_end).');' : 'background:' .esc_attr($bar_color_start).'; ';

	if($bar_color_start!='' && $bar_color_end!=''){
		$bar_color_out = 'background:linear-gradient(to right,' .esc_attr($bar_color_start).',' .esc_attr($bar_color_end).');';
	}
	else if($bar_color_start!='' || $bar_color_end!=''){
		$bar_color_out = 'background:' .(($bar_color_start!='') ? esc_attr($bar_color_start) : esc_attr($bar_color_end)).'; ';
	}

	return '
		<div '.esc_attr($id_out).' class="tcvpb_progress_bar '.esc_attr($class).'">
			<span class="tcvpb_meter_label">'.$text.'</span>
			<div class="tcvpb_meter">
				<div class="tcvpb_meter_percentage" data-percentage="'.esc_attr($complete).'" style="width: '.esc_attr($complete).'%;'.esc_attr($bar_color_out).'"><span>'.esc_html($complete).'%</span></div>
			</div>
		</div>';
}

