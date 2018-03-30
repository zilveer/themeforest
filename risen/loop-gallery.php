<?php
/**
 * Gallery Loop
 *
 * This outputs images and videos for gallery templates
 */

global $gallery_query;

// if no query given, use default
$gallery_query = isset( $gallery_query ) ? $gallery_query : $wp_query;

?>

<?php if ( $gallery_query->have_posts() ) : ?>

	<div id="gallery-items">

		<div class="thumb-grid">

			<?php while ( $gallery_query->have_posts() ) : $gallery_query->the_post(); ?>
				
			<?php if ( has_post_thumbnail() ) : ?>
				
			<div id="post-<?php the_ID(); ?>" <?php post_class( 'thumb-grid-item gallery-item image-frame' ); ?>>
			
				<div class="thumb-grid-image-container">
				
					<a href="<?php echo get_permalink(); ?>" data-rel="lightbox[gallery]">
					
						<div class="thumb-grid-buttons">

							<div class="thumb-grid-buttons-inner">
							
								<?php
								$image_src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'risen-gallery' ); // full-size image
								$image_url = $image_src[0];
								$video_url = trim( get_post_meta( $post->ID, '_risen_gallery_video_url', true ) );
								if ( $video_url ) :
								?>
								<span data-href="<?php echo esc_url( $video_url ); ?>" class="thumb-grid-lightbox-button thumb-grid-button-play" title="<?php esc_attr_e( 'Play Video', 'risen' ); ?>"><?php _e( 'Play Video', 'risen' ); ?></span>
								<?php else : ?>
								<span data-href="<?php echo esc_url( $image_url ); ?>" class="thumb-grid-lightbox-button thumb-grid-button-enlarge" title="<?php esc_attr_e( 'Enlarge Image', 'risen' ); ?>"><?php _e( 'Enlarge Image', 'risen' ); ?></span>
								<?php endif; ?>
								<span data-href="<?php echo get_permalink(); ?>" class="thumb-grid-details-button" title="<?php esc_attr_e( 'View Details', 'risen' ); ?>"><?php _e( 'View Details', 'risen' ); ?></span>
								
							</div>
							
						</div>
						
						<img src="<?php echo apply_filters( 'risen_thumb_placeholder_url', RISEN_THEME_URI . '/images/thumb-placeholder.png' ); ?>" class="thumb-grid-item-placeholder" alt="<?php the_title_attribute(); ?>" title="<?php the_title_attribute(); ?>">

						<?php
						the_post_thumbnail( 'risen-big-thumb', array(
							'class' => 'thumb-grid-image',
							'title' => '' // suppress title on hover
						) );
						?>
						
					</a>
					
				</div>
				
			</div>
			
			<?php endif; ?>

			<?php endwhile; ?>
			
			<div class="clear"></div>

		</div>
		
	</div>

<?php endif; ?>

<?php wp_reset_postdata(); ?>
