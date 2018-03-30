<?php
/**
 * The template part for displaying a message that posts cannot be found.
 *
 */
?>

			<div class="post_wrap clearfix">

					<header class="entry-header">
						<h1 class="page-title"><?php _e( 'Nothing Found', 'heartfelt' ); ?></h1>
					</header><!-- .entry-header -->

					<div class="entry-meta"></div>

					<article>

						<div class="entry-content clearfix">

								<?php if ( current_user_can( 'publish_posts' ) ) : ?>

									<p><?php printf( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'heartfelt' ), esc_url( admin_url( 'post-new.php' ) ) ); ?></p>

								<?php elseif ( is_search() ) : ?>

									<p><?php _e( 'Sorry, but nothing matched your search terms. Perhaps try again.', 'heartfelt' ); ?></p>
									<?php get_search_form(); ?>

								<?php else : ?>

									<p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'heartfelt' ); ?></p>
									<?php get_search_form(); ?>

								<?php endif; ?>

						</div><!-- .entry-content -->

					</article>

			</div><!-- .post_wrap -->
