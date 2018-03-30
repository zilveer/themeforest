<?php
/**
 * The template for displaying a "No posts found" message.
 */
?>
<article class="page">
	<header class="entry-header text-center">
		<h1 class="entry-title"><?php _e( 'Nothing Found', 'wolf' ); ?></h1>
	</header><!-- .page-header -->

	<div class="entry-content nothing-found text-center">
		<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

		<p><?php printf( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'wolf' ), admin_url( 'post-new.php' ) ); ?></p>

		<?php elseif ( is_search() ) : ?>

		<p><?php _e( 'Sorry, but nothing matched your search terms. Please try again with different keywords.', 'wolf' ); ?></p>
		<?php get_search_form(); ?>
		<div class="clear"></div>
		<?php wolf_top_tags( __( 'Most used tags : ', 'wolf' ) ); ?>

		<?php else : ?>

		<p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'wolf' ); ?></p>
		<?php get_search_form(); ?>
		<div class="clear"></div>
		<?php wolf_top_tags( __( 'Most used tags : ', 'wolf' ) ); ?>

		<?php endif; ?>
	</div><!-- .page-content -->
</article>