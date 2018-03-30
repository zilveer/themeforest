<?php
/**
 * The template used for displaying content in attachment.php
 */
?>
<div class="article-wrap attachment">
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<header class="entry-header">
			<h1 class="entry-title"><?php themeblvd_the_title(); ?></h1>
		</header><!-- .entry-header -->
		<div class="entry-content">
			<?php if( wp_attachment_is_image( get_the_ID() ) ) : ?>
				<p class="attachment">
					<a href="<?php echo wp_get_attachment_url( get_the_ID() ); ?>" title="<?php the_title(); ?>" rel="attachment">
						<?php echo wp_get_attachment_image( get_the_id(), 'full' ); ?>
					</a>
				</p>
			<?php endif; ?>
			<?php the_content(); ?>
			<div class="clear"></div>
			<?php wp_link_pages( array( 'before' => '<div class="page-link">' . themeblvd_get_local('pages').': ', 'after' => '</div>' ) ); ?>
			<?php edit_post_link( themeblvd_get_local( 'edit_post' ), '<span class="edit-link">', '</span>' ); ?>
		</div><!-- .entry-content -->
	</article><!-- #post-<?php the_ID(); ?> -->
</div><!-- .article-wrap (end) -->