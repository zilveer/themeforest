<?php get_header(); ?>
	
		<div id="container" class="<?php if (wp_kses_post(get_post_meta( get_the_ID(), 'portfolio_layout', true )) == 'full-width' ) {echo 'no-sidebar';} else {echo 'row-inner';} ?>" >
				<div id="content">
				
				<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>		
					<article id="post-<?php the_ID(); ?>" <?php post_class('post-entry clearfix'); ?> role="article">
											
						<div class="entry-content">
							<?php if (wp_kses_post(get_post_meta( get_the_ID(), 'portfolio_featured_image', true )) == 'on' ) : ?>
								<div class="portfolio-fetured-img">
									<?php
									$img_url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); 									
									echo '<img src="'. aq_resize(esc_attr($img_url), wp_kses_post(get_post_meta( get_the_ID(), 'portfolio_image_width', true )), wp_kses_post(get_post_meta( get_the_ID(), 'portfolio_image_height', true )), true, true, true) .'" />';
									?>
								</div>
							<?php endif; ?>
							<?php the_content(); ?>
						</div><!-- .entry-content -->

					</article><!-- #post -->
				<?php endwhile; ?>
					
				</div><!-- #content -->
		</div><!-- #container -->

<?php get_footer(); ?>