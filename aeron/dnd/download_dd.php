<?php

/*********** Shortcode: Download Button ************************************************************/

$ABdevDND_shortcodes['download_dd'] = array(
	'attributes' => array(
		'text' => array(
			'description' => __('Link Text', 'dnd-shortcodes'),
		),
		'url' => array(
			'description' => __('URL to File', 'dnd-shortcodes'),
		),
		'filename' => array(
			'info' => __('Forces this filename, use full name with extension or leave blank for original file name', 'dnd-shortcodes'),
			'description' => __('Filename', 'dnd-shortcodes'),
		),
		'icon' => array(
			'default' => '1',
			'type' => 'checkbox',
			'description' => __('With Icon', 'dnd-shortcodes'),
		),
	),
	'description' => __('Download Button', 'dnd-shortcodes'),
	'info' => __('This shortcode will generate link that forces download, even if browser can open that file type, e.g. .txt or .jpg file', 'dnd-shortcodes' )
);
function ABdevDND_download_dd_shortcode( $attributes, $content = null ) {
	extract(shortcode_atts(ABdevDND_extract_attributes('download_dd'), $attributes));

	$download = ($filename!='') ? 'download="'.$filename.'"' : 'download';
	$text = ($text=='') ? basename($url) : $text;
	$icon_output = ($icon==1) ? '<i class="ABdev_icon-download-alt"></i> ' :'';

	return $icon_output.'<a href="'.$url.'" '.$download.'>'.$text.'</a>';
}
