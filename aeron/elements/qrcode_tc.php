<?php

/*********** Shortcode: QR Code ************************************************************/

$tcvpb_elements['qrcode_tc'] = array(
	'name' => esc_html__('QR Code', 'ABdev_aeron' ),
	'type' => 'block',
	'icon' => 'pi-qrcode',
	'category' =>  esc_html__('E-Commerce', 'ABdev_aeron'),
	'attributes' => array(
		'alt' => array(
			'description' => esc_html__('Alt Text', 'ABdev_aeron'),
		),
		'size' => array(
			'default' => '150',
			'description' => esc_html__('Size (px)', 'ABdev_aeron'),
		),
		'align' => array(
			'default' => '',
			'description' => esc_html__('Align', 'ABdev_aeron'),
			'type' => 'select',
			'values' => array(
				'' => esc_html__('None', 'ABdev_aeron'),
				'left' => esc_html__('Left', 'ABdev_aeron'),
				'right' => esc_html__('Right', 'ABdev_aeron'),
			),
			'divider' => 'true',
		),
		'mecard_name' => array(
			'description' => esc_html__('MeCard Name', 'ABdev_aeron'),
		),
		'mecard_address' => array(
			'description' => esc_html__('MeCard Address', 'ABdev_aeron'),
		),
		'mecard_tel' => array(
			'description' => esc_html__('MeCard Telephone', 'ABdev_aeron'),
		),
		'mecard_email' => array(
			'description' => esc_html__('MeCard Email', 'ABdev_aeron'),
		),
		'mecard_url' => array(
			'description' => esc_html__('MeCard URL', 'ABdev_aeron'),
			'divider' => 'true',
		),
		'quality' => array(
			'default' => 'H',
			'description' => esc_html__('Quality', 'ABdev_aeron'),
			'type' => 'select',
			'values' => array(
				'H' => esc_html__('H', 'ABdev_aeron'),
				'L' => esc_html__('L', 'ABdev_aeron'),
				'M' => esc_html__('M', 'ABdev_aeron'),
				'Q' => esc_html__('Q', 'ABdev_aeron'),
			),
		),
		'border' => array(
			'default' => '1',
			'type' => 'checkbox',
			'description' => esc_html__('Border', 'ABdev_aeron'),
		),
		'content' => array(
			'default' => 'http://'.$_SERVER['HTTP_HOST'],
			'description' => esc_html__('Content', 'ABdev_aeron'),
		),
		'current_url' => array(
			'default' => '0',
			'type' => 'checkbox',
			'description' => esc_html__('Use current page/post URL', 'ABdev_aeron'),
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
function tcvpb_qrcode_tc_shortcode($attributes, $content = null) {
	extract(shortcode_atts(tcvpb_extract_attributes('qrcode_tc'), $attributes));
	$id_out = ($id!='') ? 'id='.$id.'' : '';

	$animation_classes='';
	$animation_out='';
	if($animation!=''){
		$animation_classes = 'tcvpb-animo '.esc_attr($animation).'';
		$animation_out = ' data-trigger_pt="'.esc_attr($trigger_pt).'" data-duration="'.esc_attr($duration).'" data-delay="'.esc_attr($delay).'"';
	}

	if($current_url=='1')
		$content = tcvpb_current_page_url();

	if($mecard_name!='' || $mecard_address!='' || $mecard_tel!='' || $mecard_email!='' || $mecard_url!=''){
		$mecard="MECARD:";
		if($mecard_name!='')
			$mecard.="N:$mecard_name;";
		if($mecard_address!='')
			$mecard.="ADR:$mecard_address;";
		if($mecard_tel!='')
			$mecard.="TEL:$mecard_tel;";
		if($mecard_email!='')
			$mecard.="EMAIL:$mecard_email;";
		if($mecard_url!='')
			$mecard.="URL:$mecard_url;";
		if($content!='')
			$mecard.="NOTE:$content;";
		$content=$mecard;
	}

	$content = urlencode($content);

	if (empty($align) && $align !==0)
		$align = "";
	else
		$align = strip_tags(trim($align));

	$image = 'http://chart.apis.google.com/chart?cht=qr&amp;chld='.$quality.'|'.$border.'&amp;chs=' . $size . 'x' . $size . '&amp;chl=' . $content;

	if ($align == "right")
		$align = ' align="right"';
	if ($align == "left")
		$align = ' align="left"';

	return '<img '.esc_attr($id_out).' class="'.esc_attr($class).' '.$animation_classes.'" src="' . esc_url($image) . '" alt="' . esc_attr($alt) . '" title="' . esc_attr($alt) . '" width="' . esc_attr($size) . '" height="' . esc_attr($size) . '"' . $align .' '.$animation_out.'/>';
}

