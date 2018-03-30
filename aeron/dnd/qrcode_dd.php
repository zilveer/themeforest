<?php

/*********** Shortcode: QR Code ************************************************************/

$ABdevDND_shortcodes['qrcode_dd'] = array(
	'attributes' => array(
		'alt' => array(
			'description' => __('Alt Text', 'dnd-shortcodes'),
		),
		'size' => array(
			'default' => '150',
			'description' => __('Size px', 'dnd-shortcodes'),
		),
		'align' => array(
			'default' => '',
			'description' => __('Align', 'dnd-shortcodes'),
			'type' => 'select',
			'values' => array(
				'' => __('None', 'dnd-shortcodes'),
				'left' => __('Left', 'dnd-shortcodes'),
				'right' => __('Right', 'dnd-shortcodes'),
			),
		),
		'mecard_name' => array(
			'description' => __('MeCard Name', 'dnd-shortcodes'),
		),
		'mecard_address' => array(
			'description' => __('MeCard Address', 'dnd-shortcodes'),
		),
		'mecard_tel' => array(
			'description' => __('MeCard Telephone', 'dnd-shortcodes'),
		),
		'mecard_email' => array(
			'description' => __('MeCard Email', 'dnd-shortcodes'),
		),
		'mecard_url' => array(
			'description' => __('MeCard URL', 'dnd-shortcodes'),
		),
		'quality' => array(
			'default' => 'H',
			'description' => __('Quality', 'dnd-shortcodes'),
			'type' => 'select',
			'values' => array(
				'H' => __('H', 'dnd-shortcodes'),
				'L' => __('L', 'dnd-shortcodes'),
				'M' => __('M', 'dnd-shortcodes'),
				'Q' => __('Q', 'dnd-shortcodes'),
			),
		),
		'border' => array(
			'default' => '1',
			'type' => 'checkbox',
			'description' => __('Border', 'dnd-shortcodes'),
		),
		'content' => array(
			'default' => 'http://'.$_SERVER['HTTP_HOST'],
			'description' => __('Content', 'dnd-shortcodes'),
		),
		'current_url' => array(
			'default' => '0',
			'type' => 'checkbox',
			'description' => __('Use current page/post URL', 'dnd-shortcodes'),
		),
	),
	'description' => __('QR Code', 'dnd-shortcodes' )
);
function ABdevDND_qrcode_dd_shortcode($attributes, $content = null) {
	extract(shortcode_atts(ABdevDND_extract_attributes('qrcode_dd'), $attributes));
	
	if($current_url=='1')
		$content = ABdevDND_current_page_url();

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

	return '<img src="' . $image . '" alt="' . $alt . '" title="' . $alt . '" width="' . $size . '" height="' . $size . '"' . $align .' />';
}

