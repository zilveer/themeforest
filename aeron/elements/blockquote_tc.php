<?php

/*********** Shortcode: Blockquote ************************************************************/

$tcvpb_elements['blockquote_tc'] = array(
	'name' => esc_html__('Blockquote Block', 'ABdev_aeron' ),
	'type' => 'block',
	'icon' => 'pi-blockquote',
	'category' => esc_html__('Content', 'ABdev_aeron' ),
	'attributes' => array(
		'author' => array(
			'description' => esc_html__('Author', 'ABdev_aeron'),
		),
		'url' => array(
			'description' => esc_html__('URL', 'ABdev_aeron'),
		),
		'source' => array(
			'description' => __('Source', 'ABdev_aeron'),
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
		'description' => esc_html__('Blockquote', 'ABdev_aeron'),
	),
);
function tcvpb_blockquote_tc_shortcode( $attributes, $content = null ) {
	extract(shortcode_atts(tcvpb_extract_attributes('blockquote_tc'), $attributes));
	$id_out = ($id!='') ? 'id='.$id.'' : '';

	$animation_classes='';
	$animation_out='';
	if($animation!=''){
		$animation_classes = 'tcvpb-animo '.esc_attr($animation).'';
		$animation_out = ' data-trigger_pt="'.esc_attr($trigger_pt).'" data-duration="'.esc_attr($duration).'" data-delay="'.esc_attr($delay).'"';
	}
	
	$quote ='';
	if($source!='')
		$source='<cite title="'.esc_attr($source).'">'.esc_attr($source).'</cite>';
	if($author!='' && $url!='')
		$content.='<small><a href="'.esc_url($url).'">'.esc_attr($author).'</a> '.esc_attr($source).'</small>';
	if($author!='' && $url=='')
		$content.='<small>'.esc_attr($author).' '.esc_attr($source).'</small>';
	return '<blockquote '.esc_attr($id_out).' class="tcvpb_blockquote '.esc_attr($class).' '.$animation_classes.'" '.$animation_out.'>
		'.$quote.'
		<p>'.$content.'</p>
	</blockquote>';
}
