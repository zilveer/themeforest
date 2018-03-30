<?php
/**
 * Metabox Attachments Ajax Update.
 */
function mega_gallery_metabox_ajax_update() {
	if ( !empty( $_POST['post_id'] ) )  {
			$args = array(
					'post_type' => 'attachment',
					'post_status' => 'inherit',
					'post_parent' => $_POST['post_id'],
					'post_mime_type' => 'image',
					'posts_per_page' => '-1',
					'order' => 'ASC',
					'orderby' => 'menu_order',
					'exclude' => get_post_thumbnail_id($_POST['post_id'])
				);				
				
			$attachments = get_posts( $args );
			$return = '';						
			if( empty( $attachments ) )
				$return .= '<p>'. __( 'No images.', 'mega' ). '</p>';	
			else {	
					foreach( $attachments as $image ):
						$thumbnail = wp_get_attachment_image_src( $image->ID, 'thumbnail');
						$return .= '<img style="margin-right:5px;" width="100" height="100" src="' . $thumbnail[0] . '" alt="' . apply_filters('the_title', $image->post_title). '"/>';
					endforeach;
			}			
			echo $return;
			exit();
	}
}

add_action( 'wp_ajax_refresh_metabox', 'mega_gallery_metabox_ajax_update' );
