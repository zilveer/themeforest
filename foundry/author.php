<?php 	
	get_header();
	
	$author = get_user_by( 'slug', get_query_var( 'author_name' ) );
	
	echo ebor_get_page_title( 
		esc_html__('By: ','foundry') . $author->display_name, 
		$subtitle = false, 
		$icon = false, 
		$thumbnail = ( get_option('foundry_blog_header_image') ) ? '<img src="'. get_option('foundry_blog_header_image') .'" alt="Blog Header" class="background-image" />' : false, 
		$layout = get_option('foundry_blog_header_layout', 'left-short-grey')
	);
	
	get_template_part('loop/loop-post', get_option('blog_layout','masonry-sidebar-right'));
	
	get_footer();