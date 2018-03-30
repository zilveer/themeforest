<?php

/*********** Shortcode: Download Button ************************************************************/

$tcvpb_elements['download_tc'] = array(
	'name' => esc_html__('Download Button', 'ABdev_aeron'),
	'type' => 'block',
	'icon' => 'pi-download',
	'category' =>  esc_html__('Content', 'ABdev_aeron'),
	'attributes' => array(
		'text' => array(
			'description' => esc_html__('Link Text', 'ABdev_aeron'),
		),
		'url' => array(
			'description' => esc_html__('URL to File', 'ABdev_aeron'),
		),
		'filename' => array(
			'info' => esc_html__('Forces this filename, use full name with extension or leave blank for original file name', 'ABdev_aeron'),
			'description' => esc_html__('Filename', 'ABdev_aeron'),
		),
		'icon' => array(
			'type' => 'icon',
			'description' => esc_html__('Icon', 'ABdev_aeron'),
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
function tcvpb_download_tc_shortcode( $attributes, $content = null ) {
	extract(shortcode_atts(tcvpb_extract_attributes('download_tc'), $attributes));
	$id_out = ($id!='') ? 'id='.$id.'' : '';
	$class_out = ($class!='') ? 'class='.$class.'' : '';

	$download = ($filename!='') ? 'download="'.esc_attr($filename).'"' : 'download';
	$text = ($text=='') ? basename($url) : $text;
	$icon_output = ($icon!='') ? '<i class="'.esc_attr($icon).'"></i> ' :'';

	return $icon_output.'<a href="'.esc_url($url).'" '.esc_attr($id_out).' '.esc_attr($class_out).' '.$download.'>'.esc_html($text).'</a>';
}
