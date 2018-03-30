<?php
/**
 * The template for displaying a "No posts found" message.
 *
 * @package WordPress
 * @subpackage InTouch
 * @since InTouch 1.0
 */
?>

<article id="post-0" class="post no-results not-found">
	<header class="entry-header">
		<h1 class="archive-title"><?php _e( 'Nothing Found', 'color-theme-framework' ); ?></h1>
	</header>

	<div class="entry-content clearfix">
		<?php if ( is_search() ) : ?>
			<p><?php _e( 'Sorry, but nothing matched your search terms. Please try again with different keywords.', 'color-theme-framework' ); ?></p>
			<?php get_search_form(); ?>
		<?php else : ?>	
			<p><?php _e( 'Apologies, but no results were found. Perhaps searching will help find a related post.', 'color-theme-framework' ); ?></p>
			<?php get_search_form(); ?>
		<?php endif; ?>
	</div><!-- .entry-content -->
</article><!-- #post-0 -->