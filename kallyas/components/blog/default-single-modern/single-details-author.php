<?php if(! defined('ABSPATH')){ return; }
/**
 * Details author
 */
?>
<div class="kl-blog-post-details-author">

	<div class="kl-blog-post-author-avatar"  <?php echo WpkPageHelper::zn_schema_markup('author'); ?>>
		<?php
		/**
		 * Filter the kallyas author bio avatar size.
		 * @since 4.1
		 * @param int $size The avatar height and width size in pixels.
		 */
		$author_bio_avatar_size = apply_filters( 'zn_author_bio_avatar_size', 46 );

		echo get_avatar( get_the_author_meta( 'user_email' ), $author_bio_avatar_size );
		?>
	</div><!-- .author-avatar -->

	<div class="kl-blog-post-author-link vcard author"><span class="fn"><?php the_author_posts_link(); ?></span></div>

</div>
