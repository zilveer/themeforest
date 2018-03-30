<?php if ( ! have_posts() ) : ?>
	<?php get_template_part( 'framework/parts/not-found' ); ?>
<?php

else : 
	global $loop_layout;
	
	if( empty( $loop_layout ) )
		$loop_layout = tie_get_option( 'blog_display' );
	
	if( $loop_layout == 'full_thumb' ){
	
		get_template_part( 'framework/loops/loop-wide-featured' );
		
	}
	elseif( $loop_layout == 'content' ){
	
		get_template_part( 'framework/loops/loop-content' );
		
	}
	elseif( $loop_layout == 'masonry' ){
	
		get_template_part( 'framework/loops/loop-masonry' );
		
	}
	elseif( $loop_layout == 'timeline' ){
	
		get_template_part( 'framework/loops/loop-timeline' );
		
	}
	else{
	
		get_template_part( 'framework/loops/loop-default' );

	}

endif;
?>