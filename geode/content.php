<?php
/**
 * @package WordPress
 * @subpackage Geode
 * @since Geode 1.0
 */

?>
<?php global $shortcodelic_blog, $shortcodelic_blog_masonry, $more; $old_more = $more; $gridder = geode_check_gridder(get_the_id()); ?>

<?php 
	if ( has_post_thumbnail() && is_search() ) {
		$has_thumb = ' has_thumb';
	} else {
		$has_thumb = '';
	}
?>
<article id="post-<?php the_ID(); ?>" <?php post_class($classes[]=$has_thumb); ?>>

		<div class="row">
			<div class="row-inside">
		<?php 
			$thumb_id = get_post_thumbnail_id(get_the_id());
			$postTh = wp_get_attachment_image_src( $thumb_id, 'full' );

			$thumbnail = get_the_post_thumbnail(get_the_id(),'full');

			if ( has_post_thumbnail() && ( !is_singular('team') ) ) {
				echo apply_filters( 'geode_print_thumb' , $thumbnail);
			}
			if ( !is_single() && get_post_format() != 'quote' ) get_template_part( 'title', 'post' ); 
		?>

		<?php if ( is_search() || geode_is_related() || geode_blog_layout_class('')!='' || $shortcodelic_blog_masonry ) : ?>
		<div class="entry-summary">
			<?php if ( !isset($gridder) || $gridder!=true ) { ?>
				<div class="row">
					<div class="row-inside">
			<?php } ?>
						<?php
							//$posted_on = (geode_blog_layout_class('')=='' && $shortcodelic_blog!=true) ? 'date' : 'category';
							if ( is_search() ) {
								$post_type = get_post_type_object( get_post_type() );
								echo '<small class="post-type">'.$post_type->labels->singular_name.'</small>';
							} else {
								if ( !geode_is_related() && get_post_format() != 'quote' ) { ?> 

									<div class="entry-meta">

										<?php 
											geode_posted_on('date');

											if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) { ?>
												<span class="comments-link"><?php comments_popup_link( __( 'Leave a comment', 'geode' ), __( '1 Comment', 'geode' ), __( '% Comments', 'geode' ) ); ?></span>
											<?php } 
											geode_posted_on('category');
										?>

									</div><!-- .entry-meta -->

								<?php }
							}

							if ( get_post_format() != 'aside' && get_post_format() != 'status' && get_post_format() != 'quote' ) {
								the_excerpt();
							} else {
								the_content();
							}
							if ( (geode_blog_layout_class('')!='' || $shortcodelic_blog_masonry) && get_post_format() != 'quote' ) echo geode_remove_more_link();
						?>
			<?php if ( !isset($gridder) || $gridder!=true ) { ?>
					</div><!-- .row-inside -->
				</div><!-- .row -->
			<?php } ?>
		</div><!-- .entry-summary -->
		<?php else : ?>
		<div class="entry-content">
			<?php if ( !isset($gridder) || $gridder!=true ) { ?>
				<div class="row">
					<div class="row-inside">
			<?php } ?>
						<div class="entry-text">
						<?php if ( !geode_is_related() ) {
							if ( is_single() ) geode_posted_on('date');

							the_content( __( 'View more', 'geode' ) );

						} ?>
						</div><!-- .entry-text -->

						<?php if ( is_single() && !geode_is_related() && get_post_type() == 'post' && !($shortcodelic_blog == true || is_array($shortcodelic_blog)) ) { ?>

							<footer class="entry-meta"><span class="cat-links"><strong><?php _e('Categories','geode'); ?>: </strong><?php the_category( ', '); ?></span></footer>
							<?php the_tags( '<footer class="entry-meta"><span class="tag-links"><strong>'.__('Tags','geode').': </strong>', ', ', '</span></footer>' ); ?>

						<?php } ?>
			<?php if ( !isset($gridder) || $gridder!=true ) { ?>
					</div><!-- .row-inside -->
				</div><!-- .row -->
			<?php } ?>
		</div><!-- .entry-content -->
		<?php endif; ?>

		<?php if ( is_single() ) edit_post_link( __( 'Edit', 'geode' ), '<span class="edit-link">', '</span>' ); ?>

		</div><!-- .row-inside -->
	</div><!-- .row -->

</article><!-- #post-## -->