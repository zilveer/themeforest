<?php
/**
 * Blog entry standard format media
 *
 * @package Total WordPress theme
 * @subpackage Partials
 * @version 3.3.2
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Display media if thumbnail exists
if ( $thumbnail = wpex_get_blog_entry_thumbnail() ) :

	// Overlay style
	$overlay = wpex_get_mod( 'blog_entry_overlay' );
	$overlay = $overlay ? $overlay : 'none'; ?>

	<div class="blog-entry-media entry-media wpex-clr <?php echo wpex_overlay_classes( $overlay ); ?>">

		<?php
		// Lightbox style entry
		if ( wpex_get_mod( 'blog_entry_image_lightbox' ) ) :

			// Load lightbox skin stylesheet
			wpex_enqueue_ilightbox_skin();

			// Get lightbox image
			$lightbox_image = wpex_get_lightbox_image( get_post_thumbnail_id() ) ?>

			<a href="<?php echo $lightbox_image; ?>" title="<?php echo esc_attr( the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark" class="blog-entry-media-link wpex-lightbox<?php wpex_entry_image_animation_classes(); ?>" data-type="image">
				<?php echo $thumbnail; ?>
				<?php wpex_overlay( 'inside_link', $overlay, array(
					'lightbox_link' => $lightbox_image,
				) ); ?>
			</a><!-- .blog-entry-media-link -->
			<?php wpex_overlay( 'outside_link', $overlay, array(
				'lightbox_link' => $lightbox_image,
			) ); ?>

		<?php
		// Standard link to post
		else : ?>

			<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark" class="blog-entry-media-link<?php wpex_entry_image_animation_classes(); ?>">
				<?php echo $thumbnail; ?>
				<?php wpex_overlay( 'inside_link', $overlay ); ?>
			</a><!-- .blog-entry-media-link -->
			<?php wpex_overlay( 'outside_link', $overlay ); ?>
			
		<?php endif; ?>

	</div><!-- .blog-entry-media -->

<?php endif; ?>