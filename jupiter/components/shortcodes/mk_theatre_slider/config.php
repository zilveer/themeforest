<?php
extract( shortcode_atts( array(
	'background_style' 		=> 'desktop_style',
	'max_width' 			=> 900,
	'host' 				=> 'self_hosted',
	'mp4' 				=> '',
	'webm' 			=> '',
	'ogv'				=> '',
	'poster_image' 		=> '',
	'stream_host_website' 	=> 'youtube',
	'stream_video_id' 		=> '',
	'video_controls' 		=> 'true',
	'align' 				=> 'left',
	'margin_bottom' 		=> '25',
	'el_class' 				=> '',

), $atts ) );
Mk_Static_Files::addAssets('mk_theatre_slider');
