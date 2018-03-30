			<?php 
				wp_reset_query();

                global $post;

                $post_id = yiw_post_id();
				
				$extra_content = do_shortcode( get_post_meta( $post_id, '_page_extra_content', true ) );
				
				if( get_post_meta( $post_id, '_page_extra_content_autop', true ) ) 
					$extra_content = apply_filters( 'the_content', $extra_content );
			
				if( $extra_content != '' ) : ?>
			
				<div class="extra-content group"><?php echo $extra_content ?></div>   
				
			<?php endif; ?>           
		
			<?php do_action( 'yiw_after_extra-content' ) ?> 
			<?php do_action( 'yiw_after_extra-content_' . yiw_get_current_pagename() ) ?>  