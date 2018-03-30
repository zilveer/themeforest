<?php
/**
 * Slider
 *
 * This outputs the homepage slider
 */

// slider is enabled
if ( risen_option( 'slider_enabled' ) ) :

	// get slider items
	$slider_query = new WP_Query( array(
		'post_type'			=> 'risen_slide',
		'posts_per_page'	=> -1, // unlimited (pagination is via JavaScript show/hide)
		'order'				=> 'ASC',
		'orderby'			=> 'menu_order'
	) );
	
	// slider has items
	if ( $slider_query->have_posts() ) :

?>

<div id="slider">

	<div class="flexslider">
	
		<ul class="slides">
	  
			<?php while ( $slider_query->have_posts() ) : $slider_query->the_post(); // loop slides ?>

				<?php
				
				// we have at least an image
				if ( has_post_thumbnail() ) :
				
					// slide data
					$caption = trim( get_post_meta( $post->ID, '_risen_slide_caption', true ) );
					$click_url = trim( get_post_meta( $post->ID, '_risen_slide_click_url', true ) );
					$video_url = trim( get_post_meta( $post->ID, '_risen_slide_video_url', true ) );
				
				?>

				<li<?php if ( $video_url ) : ?> class="flex-video-slide"<?php endif; ?>>
				
					<div class="flex-image-container">
					
						<?php if ( $click_url || $video_url ) : // image is linked ?>
						<a href="<?php echo esc_url( do_shortcode( $video_url ? $video_url : $click_url ) ); //use video URL if is video slide ?>">
						<?php endif; ?>
						
							<?php the_post_thumbnail( 'risen-slider', array( 'alt' => '', 'title' => '', 'class' => '' ) ); ?>
							
							<?php if ( $video_url ) : // show play button hover overlay for video slide ?>
							<div class="flex-play-overlay"></div>
							<?php endif; ?>

						<?php if ( $click_url || $video_url ) : // image is linked ?>
						</a>
						<?php endif; ?>

					</div>

					<?php if ( $caption ) : // caption provided ?>
					
						<?php if ( $click_url ) : // caption is linked ?>
						<a href="<?php echo do_shortcode( $click_url ); ?>" class="flex-caption"><?php echo force_balance_tags( $caption ); ?></a>
						
						<?php else : // caption not linked ?>
						<div class="flex-caption"><?php echo force_balance_tags( $caption ); // auto-close <b> tag to rpevent messing up whole page ?></div>
						
						<?php endif; ?>
					
					<?php endif; ?>
					
				</li>

				<?php endif; ?>

			<?php endwhile; ?>

		</ul>
		
	</div>
	
</div>

<?php

		// destroy previous query
		wp_reset_postdata();

	endif; // end have items

endif; // end slider enabled
