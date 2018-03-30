<?php

extract( shortcode_atts( array(
	'author' 		=> '',
	'posts' 			=> '',
	'cat' 			=> '',
	'offset' 			=> 0,
	'order'			=> 'DESC',
	'orderby'		=> 'date',
	'excerpt_length' 	=> 200,
	'el_class' 		=> '',
), $atts ) );
Mk_Static_Files::addAssets('mk_blog_showcase');