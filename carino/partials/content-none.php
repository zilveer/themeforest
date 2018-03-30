<?php
/**
 * The template for displaying a "No posts found" message.
 *
 * @author : VanThemes ( http://www.vanthemes.com )
 */
?>
<div id="single-outer" style="margin-bottom:20px;">

	<article id="post-0" class="content post-inner post no-results not-found">

			<div class="entry-container">

				<header id="entry-header">
					<h1 class="entry-title"><?php _e( 'Nothing Found', 'van' ); ?></h1>
				</header>

				<div class="entry-content">
				
					<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

						<p><?php printf( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'van' ), admin_url( 'post-new.php' ) ); ?></p>

					<?php elseif ( is_search() ) : ?>

						<p><?php _e( 'Sorry, but nothing matched your search terms. Please try again with different keywords.', 'van' ); ?></p>
						<?php get_search_form(); ?>

					<?php else : ?>

						<p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'van' ); ?></p>
						<?php get_search_form(); ?>

					<?php endif; ?>

				</div><!-- .entry-content -->

			</div>
	</article>

</div><!-- #single-outer -->