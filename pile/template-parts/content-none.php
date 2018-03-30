<?php
/**
 * The template used when something is not found or no results were found for the search query.
 * @package Pile
 * @since   Pile 1.0
 */
?>
<div class="content-area">
	<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>
		<p><?php printf( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'pile' ), admin_url( 'post-new.php' ) ); ?></p>
	<?php elseif ( is_search() ) : ?>
		<p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with different keywords.', 'pile' ); ?></p>
		<div class="search-form">
			<?php get_search_form(); ?>
		</div>
	<?php else : ?>
		<p><?php esc_html_e( "It seems we can't find what you're looking for. Perhaps searching can help.", 'pile' ); ?></p>
		<div class="search-form  search-form--404">
			<?php get_search_form(); ?>
		</div>
	<?php endif; ?>
</div>