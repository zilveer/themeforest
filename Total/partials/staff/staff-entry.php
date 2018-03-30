<?php
/**
 * Main staff entry template part
 *
 * @package Total WordPress theme
 * @subpackage Partials
 * @version 3.3.2
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Sanitize loop
$wpex_loop = ! empty( $wpex_loop ) ? $wpex_loop : 'archive';

// Make sure $wpex_count is defined
if ( ! isset( $wpex_count ) ) {
	global $wpex_count;
}

// Add Standard Classes
$classes   = array();
$classes[] = 'staff-entry';
$classes[] = 'col';
$classes[] = wpex_staff_column_class( $wpex_loop );
$classes[] = 'col-'. $wpex_count;

// Get grid style
$wpex_grid_style = wpex_get_mod( 'staff_archive_grid_style', 'fit-rows' );

// Masonry Classes
if ( 'archive' == $wpex_loop && in_array( $wpex_grid_style, array( 'masonry', 'no-margins' ) ) ) {
	$classes[] = ' isotope-entry';
} ?>

<article id="#post-<?php the_ID(); ?>" <?php post_class( $classes ); ?>>
	<div class="staff-entry-inner wpex-clr">
		<?php
		// Include entry media, include is required to pass along $wpex_loop var
		if ( $template = locate_template( 'partials/staff/staff-entry-media.php' ) ) {
			include( $template );
		}
		// Get entry content
		get_template_part( 'partials/staff/staff-entry-content' ); ?>
	</div>
</article>