<?php 	
	get_header();
	
	global $wp_query;
	$total_results = $wp_query->found_posts;
	$items = ( $total_results == '1' ) ? __(' Item','foundry') : __(' Items','foundry'); 
	
	echo ebor_get_page_title( 
		get_search_query(), 
		esc_html__('Found ' ,'foundry') . $total_results . $items, 
		false, 
		false, 
		$layout = 'left-large-grey' 
	);
	
	get_template_part('loop/loop-post', get_option('blog_layout','masonry-sidebar-right'));
	
	get_footer();