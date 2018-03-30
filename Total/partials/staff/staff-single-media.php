<?php
/**
 * Staff single media template part
 *
 * @package Total WordPress theme
 * @subpackage Partials
 * @version 3.5.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Get attachments ( gallery images )
$attachments = wpex_get_gallery_ids( get_the_ID() );

// Get thumbnail if attachments is empty
$thumbnail = ! $attachments ? wpex_get_staff_post_thumbnail() : '';

if ( $attachments || $thumbnail ) : ?>

	<div id="staff-single-media" class="clr">

		<?php if ( $attachments ) : ?>

			<?php get_template_part( 'partials/staff/staff-single-gallery' ); ?>

		<?php elseif( $thumbnail ) : ?>

			<?php wpex_enqueue_ilightbox_skin(); ?>

			<a href="<?php wpex_lightbox_image(); ?>" title="<?php wpex_esc_title(); ?>" class="wpex-lightbox" data-show_title="false"><?php echo $thumbnail; ?></a>

		<?php endif; ?>
		
	</div><!-- .staff-entry-media -->

<?php endif; ?>