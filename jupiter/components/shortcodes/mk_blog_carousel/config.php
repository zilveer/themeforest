<?php
	extract(shortcode_atts(array(
		'title'             		=> '',
		'view_all'          	=> '',
		'count'             		=> 10,
		'author'            		=> '',
		'post_type'         	=> 'post',
		'posts'             		=> '',
		'offset'            		=> 0,
		'cat'               		=> '',
		'order'             		=> 'DESC',
		'orderby'           	=> 'date',
		'el_class'          	=> '',
		'enable_excerpt'    	=> 'false'
	), $atts));
Mk_Static_Files::addAssets('mk_blog_carousel');