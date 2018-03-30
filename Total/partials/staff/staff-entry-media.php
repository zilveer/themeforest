<?php
/**
 * Staff entry media template part
 *
 * @package Total WordPress theme
 * @subpackage Partials
 * @version 3.3.2
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Get loop
$wpex_loop = isset( $wpex_loop ) ? $wpex_loop : 'archive';

// Get thumbnail and if it exists display the entry meta
if ( $thumbnail	= wpex_get_staff_entry_thumbnail( $wpex_loop ) ) :

	// Classes
	$classes = array( 'staff-entry-media', 'clr' );
	if ( $overlay = wpex_overlay_classes() ) {
		$classes[] =	$overlay;
	}
	$classes = implode( ' ', $classes ); ?>

	<div class="<?php echo $classes; ?>">

		<?php
		// Open link around staff members if enabled
		if ( wpex_get_mod( 'staff_links_enable', true ) ) : ?>

			<a href="<?php wpex_permalink(); ?>" title="<?php wpex_esc_title(); ?>" rel="bookmark">

		<?php endif; ?>

			<?php echo $thumbnail; ?>

			<?php
			// Inside overlay HTML
			wpex_overlay( 'inside_link' ); ?>

		<?php
		// Close link around staff item if enabled
		if ( wpex_get_mod( 'staff_links_enable', true ) ) echo '</a>'; ?>

		<?php
		// Outside overlay HTML
		wpex_overlay( 'outside_link' ); ?>

	</div><!-- .staff-entry-media -->

<?php endif; ?>