<?php
/**
 * Staff entry content template part
 *
 * @package Total WordPress theme
 * @subpackage Partials
 * @version 3.3.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Return if disabled
if ( is_singular( 'staff' ) ) {

	// Disabled on related posts
	if ( ! wpex_get_mod( 'staff_related_excerpts', true ) ) {
		return;
	}

} else {

	// Disabled on archives
	if ( ! wpex_get_mod( 'staff_entry_details', true ) ) {
		return;
	}

}

// Entry content classes
$classes = 'staff-entry-details clr';
if ( wpex_staff_match_height() ) {
	$classes .= ' match-height-content';
} ?>

<div class="<?php echo esc_attr( $classes ); ?>">
	<?php get_template_part( 'partials/staff/staff-entry-title' ); ?>
	<?php get_template_part( 'partials/staff/staff-entry-position' ); ?>
	<?php get_template_part( 'partials/staff/staff-entry-excerpt' ); ?>
	<?php get_template_part( 'partials/staff/staff-entry-social' ); ?>
</div><!-- .staff-entry-details -->