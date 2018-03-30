<?php

/*********** Shortcode: RSS feed ************************************************************/

$tcvpb_elements['rss_tc'] = array(
	'name' => esc_html__('RSS', 'ABdev_aeron' ),
	'type' => 'block',
	'icon' => 'pi-rss',
	'category' =>  esc_html__('Social', 'ABdev_aeron'),
	'attributes' => array(
		'feed' => array(
			'description' => esc_html__('Feed URL', 'ABdev_aeron'),
		),
		'num' => array(
			'default' => '5',
			'description' => esc_html__('Number of Posts', 'ABdev_aeron'),
		),
		'target' => array(
			'description' => esc_html__('Target', 'ABdev_aeron'),
			'default' => '_self',
			'type' => 'select',
			'values' => array(
				'_self' =>  esc_html__('Self', 'ABdev_aeron'),
				'_blank' => esc_html__('Blank', 'ABdev_aeron'),
			),
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
include_once(ABSPATH.WPINC.'/feed.php');
function tcvpb_rss_tc_shortcode($attributes) {
    extract(shortcode_atts(tcvpb_extract_attributes('rss_tc'), $attributes));
	$id_out = ($id!='') ? 'id='.$id.'' : '';

	$animation_classes='';
	$animation_out='';
	if($animation!=''){
		$animation_classes = 'tcvpb-animo '.esc_attr($animation).'';
		$animation_out = ' data-trigger_pt="'.esc_attr($trigger_pt).'" data-duration="'.esc_attr($duration).'" data-delay="'.esc_attr($delay).'"';
	}

	$maxitems = $rss_items = '';
	$rss = fetch_feed($feed);
	if (!is_wp_error( $rss ) ) {
		$maxitems = $rss->get_item_quantity($num);
		$rss_items = $rss->get_items(0, $maxitems);
	}

	if($target!='')
		$target_output=' target="'.esc_attr($target).'"';

	$return='<ul '.esc_attr($id_out).' class="tcvpb_rss '.esc_attr($class).' '.$animation_classes.'" '.$animation_out.'>';
	if ($maxitems == 0){
		$return .= '<li>'.esc_html__('No RSS items loaded','ABdev_aeron').'</li>';
	}
	else{
		foreach ( $rss_items as $item )
			$return.='<li><a href="'. esc_url( $item->get_permalink() ).'" title="'.esc_attr__('Posted','ABdev_aeron').' '.$item->get_date('j F Y | g:i a').'"'.$target_output.'>'.esc_html( $item->get_title() ).'</a></li>';
	}
	$return.='</ul>';

	return $return;
}

