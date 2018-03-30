<?php if(! defined('ABSPATH')){ return; }
/*
 * Get post details, avatar and category
 * @since v4.0.12
 */

$date_format = zget_option( 'blog_date_format', 'blog_options', false, 'l, d F Y' );
?>
<div class="itemHeader kl-blog-item-header">

	<ul class="kl-blog-item-actions">
		<li>
			<a href="<?php the_permalink(); ?>" class="kl-blog-item-comments-link" title="<?php comments_number( __( 'No Comments', 'zn_framework'), __( '1 Comment', 'zn_framework' ), __( '% Comments', 'zn_framework' ) ); ?>">
				<svg width="25px" height="25px" viewBox="0 0 25 25" version="1.1" class="kl-blog-item-comments-icon" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
					<path d="M12.5,3 C7.26,3 3,6.72 3,11.31 C3.05035307,13.9260822 4.38555598,16.3496438 6.57,17.79 L6.57,22 L11.43,19.57 C11.78,19.6 12.14,19.62 12.5,19.62 C17.75,19.62 22,15.9 22,11.31 C22,6.72 17.75,3 12.5,3 L12.5,3 Z" stroke="#343434" stroke-width="2" fill="none"></path>
				</svg>
				<span><?php comments_number( __( '0', 'zn_framework'), __( '1', 'zn_framework' ), __( '%', 'zn_framework' ) ); ?></span>
			</a>
		</li>
		<!-- add like button here -->
		<li>
			<div class="hg-postlove-container">
				<!-- Display the postlove plugin here -->
				<?php do_action( 'znkl_love_post_area' ); ?>
			</div>
		</li>
	</ul>

	<div class="post_details kl-blog-item-details clearfix">

		<div class="kl-blog-item-author-avatar">
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

		<div class="catItemAuthor kl-blog-item-author"  <?php echo WpkPageHelper::zn_schema_markup('author'); ?>><?php the_author_posts_link(); ?></div>

		<div class="kl-blog-item-meta">
			<span class="catItemDateCreated kl-blog-item-date updated"><?php the_time( $date_format );?></span>
			<span class="kl-blog-details-sep"><?php echo __( '/', 'zn_framework' );?></span>
			<span class="kl-blog-item-category-text"><?php echo __( 'Published in', 'zn_framework' );?></span> <?php the_category( ", " ); ?>
		</div>

	</div>
	<!-- end post details -->

</div>
