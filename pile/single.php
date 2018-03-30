<?php
/**
 * The template for displaying all single posts and attachments
 *
 * @package Pile
 * @since   Pile 1.0
 */

get_header(); ?>

<div id="djaxHero" class="djax-updatable djax--hidden"></div>

<?php do_action( 'pile_djax_container_start' ); ?>

	<div class="site-content wrapper">
		<div class="content-width">

			<div id="primary" class="content-area">
				<div id="main" class="site-main" role="main">

					<?php
					// Start the loop.
					while ( have_posts() ) : the_post();

						// Include the single post content template.
						get_template_part( 'template-parts/content', 'single' );

						if ( pile_option( 'blog_single_show_share_links' ) ) { ?>
							<div class="share-container addthis_default_style"
							     addthis:url="<?php echo get_permalink(); ?>"
							     addthis:title="<?php wp_title( '|', true, 'right' ); ?>"
							     addthis:description="<?php echo trim( strip_tags( get_the_excerpt() ) ) ?>" >
								<?php get_template_part( 'template-parts/addthis-social-popup' ); ?>
							</div>
						<?php }

						if ( is_singular( 'attachment' ) ) {
							// Parent post navigation.
							the_post_navigation( array(
								'prev_text' => _x( '<span class="meta-nav">Published in</span><span class="post-title">%title</span>', 'Parent post link', 'pile' ),
							) );
						} elseif ( is_singular( 'post' ) ) {
							// Previous/next post navigation.
							the_post_navigation( array(
								'next_text' => '<span class="meta-nav" aria-hidden="true">' . esc_html__( 'Next: ', 'pile' ) . '</span> ' .
								               '<span class="screen-reader-text">' . esc_html__( 'Next post:', 'pile' ) . '</span> ' .
								               '<span class="post-title">%title</span>',
								'prev_text' => '<span class="meta-nav" aria-hidden="true">' . esc_html__( 'Previous: ', 'pile' ) . '</span> ' .
								               '<span class="screen-reader-text">' . esc_html__( 'Previous post:', 'pile' ) . '</span> ' .
								               '<span class="post-title">%title</span>',
							) );
						}

						// If comments are open or we have at least one comment, load up the comment template.
						if ( comments_open() || get_comments_number() ) {
							comments_template();
						}

						// End of the loop.
					endwhile;
					?>

				</div><!-- .site-main -->
			</div><!-- .content-area -->

		</div>
	</div><!-- .site-content -->

<?php do_action('pile_djax_container_end' );

get_footer(); ?>