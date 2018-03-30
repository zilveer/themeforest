<?php
	if( in_array(get_post_format(), array('aside', 'link', 'quote')) ){
		get_template_part('single/content', get_post_format());
	}else{
		
		global $gdlr_post_settings;
		if( empty($gdlr_post_settings['blog-style']) || $gdlr_post_settings['blog-style'] == 'blog-full' ){
			get_template_part('single/content-full');
		}else if( $gdlr_post_settings['blog-style'] == 'blog-medium' ){
			get_template_part('single/content-medium');
		}else if( strpos($gdlr_post_settings['blog-style'], 'blog-widget') !== false ){
			get_template_part('single/content-widget');
		}else{
			get_template_part('single/content-grid');
		}
		
	} 
?>