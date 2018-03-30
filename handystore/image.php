<?php /* The template for displaying image attachments */

get_header(); ?>

	<main class="site-content<?php if (function_exists('pt_main_content_class')) pt_main_content_class(); ?>" itemscope="itemscope" itemprop="mainContentOfPage"><!-- Main content -->

		<?php // Start the Loop.
			while ( have_posts() ) : the_post(); ?>
			
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> itemscope="itemscope" itemprop="ImageObject"><!-- Article ID-<?php the_ID(); ?> -->
				
				<aside class="attachment-img"><!-- Img Wrapper -->
					<?php echo wp_get_attachment_image( $post->ID, 'attach-page-image-thumb', false, array('itemprop' => 'thumbnail') ); ?>
				</aside><!-- end of Img Wrapper -->

				<div class="attachment-description">
					<header class="entry-header"><!-- Article's Header -->
						<?php the_title( '<h1 class="entry-title" itemprop="name">', '</h1>' ); ?>
					</header><!-- end of Article's Header -->

					<div class="entry-content"><!-- Content -->

						<?php if ( has_excerpt() ) : ?>
							<div class="entry-caption" itemprop="caption">
								<?php the_excerpt(); ?>
							</div>
						<?php endif; ?>

						<?php if ( ! empty( $post->post_content ) ) : ?>
							<div class="entry-description">
								<?php echo $post->post_content; ?>
							</div>
						<?php endif; ?>

					</div><!-- end of Content -->

					<footer class="entry-meta"><!-- Article's Footer -->
						<div class="date">
							<strong><?php _e('Date:&nbsp;&nbsp;&nbsp;', 'plumtree'); ?></strong>
							<?php pt_entry_publication_time();?>
						</div>

						<?php if ( $post->portfolio_filter ) { ?>
							<div class="tags">
								<strong><?php _e('Tags:&nbsp;&nbsp;&nbsp;', 'plumtree'); ?></strong>
								<?php echo esc_attr($post->portfolio_filter); ?>
							</div>
						<?php }?>

						<div class="comments">
							<strong><?php _e('Comments:&nbsp;&nbsp;&nbsp;', 'plumtree'); ?></strong>
							<?php pt_entry_comments_counter(); ?>
						</div>

						<div class="source">
							<strong><?php _e('Source Image:&nbsp;&nbsp;&nbsp;', 'plumtree'); ?></strong>
							<?php 
								$metadata = wp_get_attachment_metadata();
								printf( '<span class="attachment-meta full-size-link"><a href="%1$s" title="%2$s" itemprop="contentUrl">%3$s (%4$s &times; %5$s)</a></span>',
									esc_url( wp_get_attachment_url() ),
									__( 'Link to full-size image', 'plumtree' ),
									__( 'Full resolution', 'plumtree' ),
									esc_attr($metadata['width']),
									esc_attr($metadata['height'])
								);
							 ?>
						</div>
					</footer><!-- end of Article's Footer -->
				</div>

				<aside class="entry-meta-bottom"><!-- Additional Meta -->
					<?php if ( function_exists( 'pt_share_buttons_output' ) ) { pt_share_buttons_output(); } ?>
					<?php if ( function_exists( 'pt_entry_post_views' ) ) { pt_entry_post_views(); } ?>
					<?php if ( function_exists( 'pt_output_like_button' ) ) { pt_output_like_button( get_the_ID() ); } ?>
				</aside><!-- end of Additional Meta -->

			</article><!-- end of Article ID-<?php the_ID(); ?> -->

			<?php comments_template(); ?>

		<?php endwhile; // end of the loop. ?>

	</main><!-- end of Main content -->

	<?php get_sidebar(); ?>

<?php get_footer(); ?>
