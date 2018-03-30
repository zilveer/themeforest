<?php
/**
 * Image Swap style thumbnail
 *
 * @package Total Wordpress Theme
 * @subpackage Templates/WooCommerce
 * @version 3.3.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Return dummy image if no featured image is defined
if ( ! has_post_thumbnail() ) {
	wpex_woo_placeholder_img();
	return;
}

// Globals
global $product;

// Get first image
$attachment = get_post_thumbnail_id();

// Get Second Image in Gallery
$attachment_ids   = $product->get_gallery_attachment_ids();
$attachment_ids[] = $attachment; // Add featured image to the array
$secondary_img_id = '';

if ( ! empty( $attachment_ids ) ) {
	$attachment_ids = array_unique( $attachment_ids ); // remove duplicate images
	if ( count( $attachment_ids ) > '1' ) {
		if ( $attachment_ids['0'] !== $attachment ) {
			$secondary_img_id = $attachment_ids['0'];
		} elseif ( $attachment_ids['1'] !== $attachment ) {
			$secondary_img_id = $attachment_ids['1'];
		}
	}
}
			
// Return thumbnail
if ( $secondary_img_id ) : ?>

	<div class="woo-entry-image-swap wpex-clr">
		<?php
		// Main IMage
		wpex_post_thumbnail( array(
			'attachment' => $attachment,
			'size'       => 'shop_catalog',
			'alt'        => wpex_get_esc_title(),
			'class'      => 'woo-entry-image-main',
		) ); ?>
		<?php
		// Secondary Image
		wpex_post_thumbnail( array(
			'attachment' => $secondary_img_id,
			'size'       => 'shop_catalog',
			'class'      => 'woo-entry-image-secondary',
		) ); ?>
	</div><!-- .woo-entry-image-swap -->

<?php else : ?>

	<?php
	// Single Image
	wpex_post_thumbnail( array(
		'attachment' => $attachment,
		'size'       => 'shop_catalog',
		'alt'        => wpex_get_esc_title(),
		'class'      => 'woo-entry-image-main',
	) ); ?>

<?php endif; ?>