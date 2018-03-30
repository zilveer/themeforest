<?php 	
	get_header();
	
	if( is_date() ){
		
		if ( is_day() ){
			$title = get_the_date();
		} elseif ( is_month() ){
			$title = get_the_date('F Y' );
		} elseif ( is_year() ){
		    $title = get_the_date('Y');
		}
		
	} else {
		
		$term = get_queried_object();
		if(isset($term)){
			$title = esc_html__('In: ','foundry') . $term->name;
		}
		
	}
	
	echo ebor_get_page_title( 
		$title, 
		$subtitle = $term->description, 
		$icon = false, 
		$thumbnail = ( get_option('foundry_blog_header_image') ) ? '<img src="'. get_option('foundry_blog_header_image') .'" alt="Blog Header" class="background-image" />' : false, 
		$layout = get_option('foundry_blog_header_layout', 'left-short-grey')
	);
	
	get_template_part('loop/loop-post', get_option('blog_layout','masonry-sidebar-right'));
	
	get_footer();