<?php
/**
 * The template used for displaying page content
 *
 * @package Pile
 * @since   Pile 1.0
 */

//this global tells us if a Google Map is being displayed in the hero area
global $is_gmap;
?>

<article id="post-<?php the_ID(); ?>"  <?php post_class( 'entry--page  pr  clearfix' ); ?>>

	<div class="entry-content  js-post-gallery  clearfix">

		<?php the_content();

		global $numpages;
		if ( $numpages > 1 ) : ?>

			<div class="entry__meta-box  meta-box--pagination">
				<span class="meta-box__title"><?php esc_html_e( 'Pages', 'pile' ); ?></span>

				<?php
				$args = array(
					'before'           => '<ol class="nav  pagination--single">',
					'after'            => '</ol>',
					'next_or_number'   => 'next_and_number',
					'previouspagelink' => esc_html__( '&laquo;', 'pile' ),
					'nextpagelink'     => esc_html__( '&raquo;', 'pile' )
				);
				wp_link_pages( $args ); ?>

			</div><!-- .entry__meta-box.meta-box-pagination -->

		<?php endif; ?>

	</div><!-- .entry-content -->

	<?php
	// @todo maybe we could use the same meta key here
	if ( get_post_meta( get_the_ID(), '_pile_page_enabled_social_share', true ) || get_post_meta( get_the_ID(), '_pile_gmap_enabled_social_share', true ) ) : ?>

		<div class="entry-footer">

			<div class="metabox">
				<button class="share-button  js-popup-share">
					<i class="icon icon-share-alt"></i> <?php esc_html_e( 'Share', 'pile' ) ?>
				</button>
			</div><!-- .metabox -->

		</div><!--entry-footer-->
	<?php endif; ?>

</article><!-- .entry-page -->
