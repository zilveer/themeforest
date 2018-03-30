<?php
/**
 * The template for displaying a "No posts found" message.
 */
?>
<article id="post-0" class="post no-results not-found">
	<div class="post-entry">
		<h2 class="post-title"><?php _e( 'Nothing Found', 'mediacenter' ); ?></h2>
		<div class="entry-content">
			<p><?php _e( 'Apologies, but no results were found. Perhaps searching will help find a related post.', 'mediacenter' ); ?></p>
			<div class="blog-sidebar">
				<div class="widget widget-search">
					<?php get_search_form(); ?>	
				</div>
			</div>
		</div><!-- .entry-content -->
	</div><!-- /.post-entry -->
</article><!-- #post-0 -->