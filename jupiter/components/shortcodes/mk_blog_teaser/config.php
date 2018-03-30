<?php
	extract(shortcode_atts(array(
		'image_height'      	=> 350,
		'slideshow_cat'     	=> '',
		'side_thumb_cat'   	=> '',
		'orderby'           	=> 'date',
		'order'             		=> 'DESC',
		'el_class'          	=> ''
	), $atts));
Mk_Static_Files::addAssets('mk_blog_teaser');
Mk_Static_Files::addAssets('mk_swipe_slideshow');