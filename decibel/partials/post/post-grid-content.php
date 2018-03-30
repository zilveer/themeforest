<?php
/**
 * The home page post loop
 */
$post_id = get_the_ID();
$format = get_post_format() ? get_post_format() : 'standard';
$is_instagram = 'image' == $format && preg_match( wolf_get_regex( 'instagram' ), get_the_content() );

$thumb_size = wolf_get_image_size( '2x2' );

$link = wolf_get_first_url();
$quote = 'quote' == $format && wolf_featured_quote();
$permalink = ( 'link' == $format && $link ) ? $link : get_permalink();
$no_views = array( 'status', 'aside', 'link', 'quote' );
$views = wolf_format_number( absint( get_post_meta( $post_id, '_wolf_views', true ) ) );
$likes =wolf_format_number( absint( get_post_meta( $post_id, '_wolf_likes', true ) ) );
$comments = get_comments_number();
?>
<article <?php post_class( 'clearfix' ); ?>  id="post-<?php the_ID(); ?>" data-post-id="<?php the_ID(); ?>">
	<div class="post-square-container">
		<div class="post-square">
			<?php if ( wolf_featured_tweet( false ) && ( 'status' == $format || 'aside' == $format ) ) : ?>

				<?php echo wolf_featured_tweet(); ?>

			<?php elseif ( $is_instagram ) : ?>
				<?php echo wolf_featured_instagram(); ?>
			<?php else : ?>
				<a href="<?php echo esc_url( $permalink ); ?>" class="entry-thumbnail entry-link">
					<?php the_post_thumbnail( $thumb_size ); ?>
					<span class="post-square-caption-container">
						<span class="post-square-caption entry-content">
							<?php
							$format_to_show_meta = array( 'standard', 'video', 'gallery', 'image', 'audio' );

							if ( in_array( $format, $format_to_show_meta ) ) :
								// Translators: used between list items, there is a space after the comma.
								$categories_list = get_the_category_list( __( ', ', 'wolf' ) );
								if ( $categories_list ) {
									echo '<span class="category">' . strip_tags( $categories_list ) . '</span>';
								}
								?>
								<h2 class="entry-title"><?php the_title(); ?></h2>
								<span class="entry-meta">
									<span class="meta"><span class="by-author"><span class="pre-meta"><?php _e( 'by', 'wolf' ); ?></span> <?php echo esc_attr( get_the_author() ); ?></span></span>
									<span class="meta"><span class="pre-meta"><?php _e( 'on', 'wolf' ); ?></span> <?php echo esc_html( get_the_date() ); ?></span>
								</span>

							<?php elseif( 'status' == $format || 'aside' == $format ) : ?>

								<?php the_content(); ?>

							<?php elseif( $quote ) : ?>

								<?php echo preg_replace( '#<a.*?>(.*?)</a>#i', '\1', wolf_featured_quote() ) ; ?>

							<?php elseif( 'link' == $format ) : ?>

								<h2 class="entry-title"><?php the_title(); ?></h2>
								<?php if ( $link ) : ?>
									<p><?php echo esc_url( $link ); ?></p>
								<?php endif; ?>

							<?php elseif( 'chat' == $format ) : ?>

								<?php the_excerpt(); ?>

							<?php endif; ?>
						</span><!-- .entry-caption -->
					</span><!-- .entry-caption-container -->
				</a>
			<?php endif ?>
		</div>
	</div>
</article><!-- article -->
