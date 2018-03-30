<?php

/*********** Shortcode: Google Map ************************************************************/

$tcvpb_elements['map_tc'] = array(
	'name' => esc_html__('Google Map', 'ABdev_aeron' ),
	'type' => 'block',
	'icon' => 'pi-google-map',
	'category' =>  esc_html__('Content', 'ABdev_aeron'),
	'child' 		=> 'map_marker_tc',
	'child_button' 		=> esc_html__('Add New Marker', 'ABdev_aeron'),
	'child_title' 		=> esc_html__('Marker', 'ABdev_aeron'),
	'attributes' => array(
		'h' => array(
			'default' => '400px',
			'tab' => esc_html__('Customize', 'ABdev_aeron'),
			'description' => esc_html__('Height', 'ABdev_aeron'),
		),
		'map_type' => array(
			'type' => 'select',
			'tab' => esc_html__('Customize', 'ABdev_aeron'),
			'default' => 'ROADMAP',
			'description' => esc_html__('Map Type', 'ABdev_aeron'),
			'values' => array(
				'ROADMAP' => esc_html__('ROADMAP', 'ABdev_aeron'),
				'SATELLITE' => esc_html__('SATELLITE', 'ABdev_aeron'),
				'HYBRID' => esc_html__('HYBRID', 'ABdev_aeron'),
				'TERRAIN' => esc_html__('TERRAIN', 'ABdev_aeron'),
			),
		),
		'lat' => array(
			'default' => '40.7782201',
			'description' => esc_html__('Map Center Latitude', 'ABdev_aeron'),
		),
		'lng' => array(
			'default' => '-73.9733317',
			'description' => esc_html__('Map Center Longitude', 'ABdev_aeron'),
		),
		'auto_center_zoom' => array(
			'default' => '0',
			'type' => 'checkbox',
			'description' => esc_html__('Auto Center and Zoom to Show all Markers', 'ABdev_aeron'),
		),
		'zoom' => array(
			'type' => 'select',
			'tab' => esc_html__('Customize', 'ABdev_aeron'),
			'default' => '16',
			'description' => esc_html__('Zoom Level', 'ABdev_aeron'),
			'values' => array(
				'1' => esc_html__('1', 'ABdev_aeron'),
				'2' => esc_html__('2', 'ABdev_aeron'),
				'3' => esc_html__('3', 'ABdev_aeron'),
				'4' => esc_html__('4', 'ABdev_aeron'),
				'5' => esc_html__('5', 'ABdev_aeron'),
				'6' => esc_html__('6', 'ABdev_aeron'),
				'7' => esc_html__('7', 'ABdev_aeron'),
				'8' => esc_html__('8', 'ABdev_aeron'),
				'9' => esc_html__('9', 'ABdev_aeron'),
				'10' => esc_html__('10', 'ABdev_aeron'),
				'11' => esc_html__('11', 'ABdev_aeron'),
				'12' => esc_html__('12', 'ABdev_aeron'),
				'13' => esc_html__('13', 'ABdev_aeron'),
				'14' => esc_html__('14', 'ABdev_aeron'),
				'15' => esc_html__('15', 'ABdev_aeron'),
				'16' => esc_html__('16', 'ABdev_aeron'),
				'17' => esc_html__('17', 'ABdev_aeron'),
				'18' => esc_html__('18', 'ABdev_aeron'),
				'19' => esc_html__('19', 'ABdev_aeron'),
				'20' => esc_html__('20', 'ABdev_aeron'),
				'21' => esc_html__('21', 'ABdev_aeron'),
			),
		),
		'scrollwheel' => array(
			'tab' => esc_html__('Customize', 'ABdev_aeron'),
			'default' => '0',
			'type' => 'checkbox',
			'description' => esc_html__('Enable Scrollweel', 'ABdev_aeron'),
		),
		'maptypecontrol' => array(
			'default' => '1',
			'tab' => esc_html__('Customize', 'ABdev_aeron'),
			'type' => 'checkbox',
			'description' => esc_html__('Show Map Type Controls', 'ABdev_aeron'),
		),
		'pancontrol' => array(
			'default' => '1',
			'tab' => esc_html__('Customize', 'ABdev_aeron'),
			'type' => 'checkbox',
			'description' => esc_html__('Show Pan Controls', 'ABdev_aeron'),
		),
		'zoomcontrol' => array(
			'default' => '1',
			'tab' => esc_html__('Customize', 'ABdev_aeron'),
			'type' => 'checkbox',
			'description' => esc_html__('Show Zoom Controls', 'ABdev_aeron'),
		),
		'scalecontrol' => array(
			'default' => '1',
			'tab' => esc_html__('Customize', 'ABdev_aeron'),
			'type' => 'checkbox',
			'description' => esc_html__('Show Scale Controls', 'ABdev_aeron'),
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
	),
);

function tcvpb_map_tc_shortcode( $attributes, $content = null ) {
	extract(shortcode_atts(tcvpb_extract_attributes('map_tc'), $attributes));
	static $i = 0;
	$i++;
	
	$map_data = ' '
		.'data-map_type="'.$map_type.'" '
		.'data-auto_center_zoom="'.esc_attr($auto_center_zoom).'" '
		.'data-lat="'.esc_attr($lat).'" '
		.'data-lng="'.esc_attr($lng).'" '
		.'data-zoom="'.$zoom.'" '
		.'data-scrollwheel="'.$scrollwheel.'" '
		.'data-maptypecontrol="'.$maptypecontrol.'" '
		.'data-pancontrol="'.$pancontrol.'" '
		.'data-zoomcontrol="'.$zoomcontrol.'" '
		.'data-scalecontrol="'.$scalecontrol.'" ';


	$animation_classes='';
	$animation_out='';
	if($animation!=''){
		$animation_classes = 'tcvpb-animo '.esc_attr($animation).'';
		$animation_out = ' data-trigger_pt="'.esc_attr($trigger_pt).'" data-duration="'.esc_attr($duration).'" data-delay="'.esc_attr($delay).'"';
	}

	return '
			<div class="tcvpb_google_map_wrapper '.$animation_classes.'" '.$animation_out.'>
				<div id="tcvpb_google_map_'.$i.'" '.$map_data.' class="tcvpb_google_map" style="height:'.esc_attr($h).';width:100%;"></div>
				'.do_shortcode($content).'
			</div>';
	
}

$tcvpb_elements['map_marker_tc'] = array(
	'name' => esc_html__('Single marker section', 'ABdev_aeron' ),
	'type' => 'child',
	'attributes' => array(
		'add_markertitle' => array(
			'default' => 'Our Company',
			'description' => esc_html__('Marker Title', 'ABdev_aeron'),
		),
		'add_marker_subtitle' => array(
			'description' => esc_html__('Marker Subtitle', 'ABdev_aeron'),
		),
		'add_markericon' => array(
			'type' => 'image',
			'description' => esc_html__('Custom Marker Image', 'ABdev_aeron'),
		),
		'add_markerlat' => array(
			'description' => esc_html__('Marker Latitude', 'ABdev_aeron'),
		),
		'add_markerlng' => array(
			'description' => esc_html__('Marker Longitude', 'ABdev_aeron'),
		),
		'add_adress' => array(
			'description' => esc_html__('Marker Adress', 'ABdev_aeron'),
		),
		'add_telephone1' => array(
			'description' => esc_html__('Marker Telephone 1', 'ABdev_aeron'),
		),
		'add_telephone2' => array(
			'description' => esc_html__('Marker Telephone 2', 'ABdev_aeron'),
		),
		'add_faxnumber' => array(
			'description' => esc_html__('Marker Fax', 'ABdev_aeron'),
		),
		'add_email' => array(
			'description' => esc_html__('Marker E-mail', 'ABdev_aeron'),
		),
	),
);

function tcvpb_map_marker_tc_shortcode( $attributes, $content = null ) {
	extract(shortcode_atts(tcvpb_extract_attributes('map_marker_tc'), $attributes));
	$marker_attr = 'data-title="'.esc_attr($add_markertitle).'" data-icon="'.esc_attr($add_markericon).'" data-lat="'.esc_attr($add_markerlat).'" data-lng="'.esc_attr($add_markerlng).'"';
	$return = '<div class="tcvpb_google_map_marker" style="display:none;" '.$marker_attr.'>';
	$return .= ($add_marker_subtitle!='') ? '<h5>'.esc_html($add_marker_subtitle).'</h5>' : '';
	$return .= ($add_adress!='') ? '<p class="no_margin_bottom">'.esc_html($add_adress).'</p>' : '';
	$return .= ($add_telephone1!='') ? '<p class="no_margin_bottom">Tel: '.esc_html($add_telephone1).'</p>' : '';
	$return .= ($add_telephone2!='') ? '<p class="no_margin_bottom">Tel(2): '.esc_html($add_telephone2).'</p>' : '';
	$return .= ($add_faxnumber!='') ? '<p class="no_margin_bottom">Fax: '.esc_html($add_faxnumber).'</p>' : '';
	$return .= ($add_email!='') ? '<p class="no_margin_bottom">E-mail: <a href="mailto:'.esc_url($add_email).'">'.esc_html($add_email).'</a></p>' : '';
	$return .= '</div>';

	return $return;

}