<?php 
	global $wp_query, $post;
	
	//$tmp_query = $wp_query;
	
	if ( have_posts() ) : 

	    while ( have_posts() ) : the_post();
	    	
			add_filter( 'the_title', 'yiw_get_convertTags' ); 
			
			$wpautop = get_post_meta( get_the_ID(), '_page_remove_wpautop', true );
			
			if( $wpautop )
				remove_filter( 'the_content', 'wpautop' );
			
			$_active_title = get_post_meta( get_the_ID(), '_show_title_page', true );
			
			if( $_active_title == 'yes' || !$_active_title ) 
				the_title( '<h1 class="title">', '</h1>' );
                
            //$content = apply_filters( 'the_content', $post->post_content );   
			if ( !empty( $post->post_content ) || in_array( 'buddypress', get_body_class() ) ) : ?>
			<div id="post-<?php the_ID(); ?>" <?php post_class('group'); ?>><?php
				the_content();?>
			</div><?php
			endif;
		
			if( $wpautop )
				add_filter( 'the_content', 'wpautop' ); 
		
		    break;
		endwhile; 
	
	endif; 
	
	//$wp_query = $tmp_query;      
	wp_link_pages();
	wp_reset_query();
?>                    