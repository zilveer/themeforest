<?php 

/**
	revslider plugin support
**/
if( in_array('revslider/revslider.php', get_option('active_plugins')) ){ //first check if plugin is installed

	global $wpdb;

	$sliders = $wpdb->get_results( "SELECT alias, title FROM ".GlobalsRevSlider::$table_sliders );
	
	$sliders_array = array();
	if(is_array($sliders)){
		foreach ($sliders as $slide) {
			$sliders_array[$slide->alias] = $slide->title;
		}
	}

	$tcvpb_elements['rev_slider'] = array(
		'name' => esc_html__('Revolution Slider', 'ABdev_aeron' ),
		'description' => esc_html__('Revolution Slider', 'ABdev_aeron'),
		'type' => 'block',
		'icon' => 'pi-slider',
		'category' =>  esc_html__('Media', 'ABdev_aeron'),
		'third_party' => 1, 
		'attributes' => array(
			'alias' => array(
				'description' => esc_html__('Slider Alias', 'ABdev_aeron'),
				'default' => '',
				'type' => 'select',
				'values' => $sliders_array,
			),
		),
	);
}

