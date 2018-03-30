<div class="flexslider singleslider body2">
        <ul class="slides">
			<?php    
				$large_image =  wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'fullsize', false, '' ); 

				$args = array(
                    'orderby' => 'menu_order',
                    'post_type' => 'attachment',
                    'post_parent' => get_the_ID(),
                    'post_mime_type' => 'image',
                    'post_status' => null,
                    'posts_per_page' => -1
				);
				
				$attachments = get_posts( $args );
				 if ( $attachments ) {
					foreach ( $attachments as $attachment ) {
					   echo '<li>';
					   echo wp_get_attachment_image( $attachment->ID, 'format-image' );
					   echo '</li>';
					  }
				 }
             ?>
             
        </ul>
    </div>