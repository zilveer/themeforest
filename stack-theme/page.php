<?php 
	if( get_post_meta($post->ID, '_general_page_layout', true) ) {
		get_template_part('layout', get_post_meta($post->ID, '_general_page_layout', true) );
	} else {
		get_template_part('layout', theme_options('page', 'default_layout', 'full-width') );
	}
?>