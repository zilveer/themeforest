<?php
/**
 * @package humbleshop
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	
	<div class="entry-content clearfix">
		<p>
		<?php humbleshop_posted_on(); ?>
		
			<?php if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : ?>
				<small>|  <span class="comments-link"><i class="fa fa-comments-o"></i>	<?php comments_popup_link( __( 'Leave a comment', 'humbleshop' ), __( '1 Comment', 'humbleshop' ), __( '% Comments', 'humbleshop' ) ); ?></span></small>
			<?php endif; ?>
		
		</p>

		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links pagination">' . __( 'Pages:', 'humbleshop' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content clearfix -->

	<footer class="entry-meta text-center">
		<?php
			/* translators: used between list items, there is a space after the comma */
			$category_list = get_the_category_list( __( ', ', 'humbleshop' ) );

			/* translators: used between list items, there is a space after the comma */
			$tag_list = get_the_tag_list( '', __( ', ', 'humbleshop' ) );

			if ( ! humbleshop_categorized_blog() ) {
				// This blog only has 1 category so we just need to worry about tags in the meta text
				if ( '' != $tag_list ) {
					$meta_text = __( '<hr><small>This entry was tagged %2$s. <br />Bookmark the <a href="%3$s" rel="bookmark">permalink</a>.</small><hr>', 'humbleshop' );
				} else {
					$meta_text = __( '<hr><small>Bookmark the <a href="%3$s" rel="bookmark">permalink</a>.</small><hr>', 'humbleshop' );
				}

			} else {
				// But this blog has loads of categories so we should probably display them here
				if ( '' != $tag_list ) {
					$meta_text = __( '<hr><small>This entry was posted in %1$s and tagged %2$s. <br />Bookmark the <a href="%3$s" rel="bookmark">permalink</a>.</small><hr>', 'humbleshop' );
				} else {
					$meta_text = __( '<hr><small>This entry was posted in %1$s. <br />Bookmark the <a href="%3$s" rel="bookmark">permalink</a>.</small><hr>', 'humbleshop' );
				}

			} // end check for categories on this blog

			printf(
				$meta_text,
				$category_list,
				$tag_list,
				get_permalink()
			);
		?>

		<?php edit_post_link( __( 'Edit', 'humbleshop' ), '<p class="text-center"><span class="edit-link"><small><i class="fa fa-pencil"></i> ', '</small></span></p>' ); ?>
	</footer><!-- .entry-meta -->
</article><!-- #post-## -->
