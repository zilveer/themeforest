<?php
/**
 * Custom Post Type Entry Media
 *
 * @package Total WordPress theme
 * @subpackage Partials
 * @version 3.3.0
 *
 * @todo Add support for post featured video ? No one has requested it yet.
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Thumbnail args
$args = apply_filters( 'wpex_'. get_post_type() .'_entry_thumbnail_args', array(
	'size'          => 'full',
	'alt'           => wpex_get_esc_title(),
	'schema_markup' => true
) );

// Get thumbnail
$thumbnail = wpex_get_post_thumbnail( $args );

// Display featured image
if ( $thumbnail ) : ?>

	<?php
	// Get overlay style
	$overlay = apply_filters( 'wpex_'. get_post_type() .'_entry_overlay_style', null ); ?>

	<div class="blog-entry-media entry-media clr <?php echo wpex_overlay_classes( $overlay ); ?>">
		<a href="<?php wpex_permalink(); ?>" title="<?php wpex_esc_title(); ?>" rel="bookmark" class="custom-posttype-entry-media-link <?php wpex_entry_image_animation_classes(); ?>">
			<?php echo $thumbnail; ?>
			<?php wpex_overlay( 'inside_link', $overlay ); ?>
		</a>
		<?php wpex_overlay( 'outside_link', $overlay ); ?>
	</div><!-- cpt-entry-media -->

<?php endif; ?>