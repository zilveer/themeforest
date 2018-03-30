<?php
	#Performing blog post layout...
	$meta_set = get_post_meta($post->ID, '_tpl_default_settings', true);
	$post_layout = !empty($meta_set['blog-post-layout']) ? $meta_set['blog-post-layout'] : 'one-column';
	
	switch($post_layout):
		case 'thumb':
			get_template_part('includes/posts-by-thumbs');
			break;

		default:
			get_template_part('includes/posts-by-columns');
			break;
	endswitch; ?>