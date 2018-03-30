<?php

/*********** Shortcode: Tabs ************************************************************/

$tcvpb_elements['tabs_tc'] = array(
	'name' => esc_html__('Tabs', 'ABdev_aeron' ),
	'type' => 'block',
	'icon' => 'pi-tab',
	'category' =>  esc_html__('Content', 'ABdev_aeron'),
	'child' => 'tab_tc',
	'child_button' => esc_html__('New Tab', 'ABdev_aeron'),
	'child_title' => esc_html__('Tab no.', 'ABdev_aeron'),
	'attributes' => array(
		'tabs_position' => array(
			'default' => 'top',
			'description' => esc_html__('Tabs Position', 'ABdev_aeron'),
			'type' => 'select',
			'values' => array(
				'top' => esc_html__('Top', 'ABdev_aeron'),
				'bottom' => esc_html__('Bottom', 'ABdev_aeron'),
				'left' => esc_html__('Left', 'ABdev_aeron'),
				'right' => esc_html__('Right', 'ABdev_aeron'),
			),
			'tab' => esc_html__('Style', 'ABdev_aeron'),
		),
		'style' => array(
			'default' => 'style1',
			'description' => __('Tabs style', 'ABdev_aeron'),
			'type' => 'select',
			'values' => array(
				'style1' => __('Style 1', 'ABdev_aeron'),
				'style2' => __('Style 2', 'ABdev_aeron'),
			),
			'info' => __('Timeline tabs have tabs position top or bottom only.', 'ABdev_aeron'),
			'tab' => esc_html__('Style', 'ABdev_aeron'),
		),
		'effect' => array(
			'default' => '',
			'description' => esc_html__('Transition Effect', 'ABdev_aeron'),
			'type' => 'select',
			'values' => array(
				'' => esc_html__('None', 'ABdev_aeron'),
				'slide' => esc_html__('Slide', 'ABdev_aeron'),
				'fade' => esc_html__('Fade', 'ABdev_aeron'),
			),
			'tab' => esc_html__('Style', 'ABdev_aeron'),
		),
		'selected' => array(
			'description' => esc_html__('Selected Tab', 'ABdev_aeron'),
			'info' => esc_html__('Initially selected tab, order number', 'ABdev_aeron'),
			'default' => '1',
		),
		'break_point' => array(
			'description' => esc_html__('Break Point', 'ABdev_aeron'),
			'info' => esc_html__('Width in px. Below this width tabs will be stacked on each other.', 'ABdev_aeron'),
			'tab' => esc_html__('Break Point', 'ABdev_aeron'),
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
	)
);
function tcvpb_tabs_tc_shortcode( $attributes, $content = null ) {
	global $tabs_navigation,$tabs_content,$tabs_counter,$tabs_selected;
	extract(shortcode_atts(tcvpb_extract_attributes('tabs_tc'), $attributes));
	static $i = 0;
    $i++;

    $tabs_counter = $i;

    $tabs_selected = $selected;
    
	$id_out = ($id!='') ? 'id='.$id.'' : '';
	
	do_shortcode($content);

	$animation_classes='';
	$animation_out='';
	if($animation!=''){
		$animation_classes = 'tcvpb-animo '.esc_attr($animation).'';
		$animation_out = ' data-trigger_pt="'.esc_attr($trigger_pt).'" data-duration="'.esc_attr($duration).'" data-delay="'.esc_attr($delay).'"';
	}

	$slide_direction = ( $tabs_position == 'top' || $tabs_position == 'bottom' ) ? 'horizontal' : 'vertical';

	$return = '
		<div '.esc_attr($id_out).' class="tcvpb-tabs tcvpb-tabs-'.esc_attr($slide_direction).' tcvpb-tabs-position-'.esc_attr($tabs_position).' tcvpb-tabs-'.esc_attr($style).' '.esc_attr($class).' '.$animation_classes.'" data-selected="'.esc_attr($selected).'" role="tabpane'.$i.'" data-break_point="'.esc_attr($break_point).'" data-effect="'.esc_attr($effect).'" '.$animation_out.'>
			<ul class="nav nav-tabs tab-helper-reset tab-helper-clearfix" role="tablist">
				'.$tabs_navigation.'
			</ul>
			<div class="tab-content">
			'.$tabs_content.'
			</div>
		</div>';

	$tabs_navigation = $tabs_content = '';

	return $return;
}

	
$tcvpb_elements['tab_tc'] = array(
	'name' => esc_html__('Tab', 'ABdev_aeron' ),
	'type' => 'child',
	'attributes' => array(
		'title' => array(
			'description' => esc_html__('Tab Title', 'ABdev_aeron'),
		),
		'icon' => array(
			'type' => 'icon',
			'description' => esc_html__('Icon', 'ABdev_aeron'),
		),
	),
	'content' => array(
		'description' => esc_html__('Tab Content', 'ABdev_aeron'),
	)
);
function tcvpb_tab_tc_shortcode( $attributes, $content = null ) {
	extract(shortcode_atts(tcvpb_extract_attributes('tab_tc'), $attributes));
	
	static $tab_count = 0;
	static $tabs_counter_static=0;
	global $tabs_navigation,$tabs_content,$tabs_counter,$tabs_selected;

	$active_class = false;
	if($tabs_counter!=$tabs_counter_static){
		$tabs_counter_static = $tabs_counter;
		$tab_count = 0;
	}
    $tab_count++;
	if($tabs_selected==$tab_count){
		$active_class = true;
	}
	
	$icon_output = ( $icon!='' ) ? '<i class="'.esc_attr($icon).' tab-icon"></i> ' : '';
	
	$tabs_navigation.='<li role="presentation"'.(($active_class)?' class="active"':'').'><a class="tcvpb-tabs-tab" data-href="#tab-'.$tabs_counter.'-'.$tab_count.'" aria-controls="tab-'.$tabs_counter.'-'.$tab_count.'" role="tab" data-toggle="tab">'.$icon_output . $title . '</a></li>';
	$tabs_content.='
		<div id="tab-'.$tabs_counter.'-'.$tab_count.'" class="tab-pane'.(($active_class)?' active_pane':'').'" role="tabpanel">
			' . do_shortcode($content) . '
		</div>';
	
	$return = '';
	return $return;
}
