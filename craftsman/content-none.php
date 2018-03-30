<?php
/**
 * The template for displaying a "No posts found" message
 *
 */
?>

	<header class="post-entry-header">
		<h2 class="entry-title"><?php _e( 'Nothing Found', 'craftsman' ); ?></h2>
	</header>

	<div class="entry-content">
	<div class="row-inner">
		<?php if ( is_search() ) : ?>
		
		<p><?php _e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords. <br/> Type some text and hit enter.', 'craftsman' ); ?></p>
		<?php get_search_form(); ?>

		<?php else : ?>

		<p class="no-posts"><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help. <br/> Type some text and hit enter.', 'craftsman' ); ?></p>
		<?php get_search_form(); ?>

		<?php endif; ?>
	</div>	
	</div>
