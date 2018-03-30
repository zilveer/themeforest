			<?php 
				wp_reset_query();
				
			    $post_id = isset( $post->ID ) ? $post->ID : 0;
				
				$extra_content = do_shortcode( get_post_meta( $post_id, '_page_extra_content', true ) );
				
				if( get_post_meta( $post_id, '_page_extra_content_autop', true ) ) 
					$extra_content = wpautop( $extra_content );
			
				if( $extra_content != '' ) : ?>
			
				<div class="extra-content group"><?php echo $extra_content ?></div>   
				
			<?php endif; ?>           
		
			<?php do_action( 'yiw_after_extra-content' ) ?> 
			<?php do_action( 'yiw_after_extra-content_' . yiw_get_current_pagename() ) ?>  