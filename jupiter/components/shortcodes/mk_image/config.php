<?php
extract( shortcode_atts( array(
			'heading_title' 	=> '',
			'image_width' 		=> 800,
			'image_height' 		=> 350,
			'lightbox' 			=> 'false',
			'svg' 				=> 'false',
			'crop' 				=> 'true',
			'image_size'		=> 'crop',
			'custom_lightbox' 	=> '',
			'margin_bottom' 	=> 10,
			'group' 			=> '',
			'frame_style' 		=> 'simple',
			'src' 				=> '',
			'link' 				=> '',
			'target' 			=> '_self',
			'animation' 		=> '',
			'title'				=> '',
			'desc'				=> '',
			'align' 			=> 'left',
			'caption_location' 	=> 'inside-image',
			'visibility' 		=> '',
			'el_class' 			=> '',
		), $atts ) );
Mk_Static_Files::addAssets('mk_image');

$image_size = ($crop == 'false') ? 'full' : $image_size;