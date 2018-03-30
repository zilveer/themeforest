<?php
/**
 * Staff entry title template part
 *
 * @package Total WordPress theme
 * @subpackage Partials
 * @version 3.0.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Return if disabled via the Customizer
if ( ! wpex_get_mod( 'staff_entry_position', true ) ) {
	return;
}

// Display position
if ( $position = get_post_meta( get_the_ID(), 'wpex_staff_position', true ) ) : ?>
	<div class="staff-entry-position clr">
		<?php echo $position; ?>
	</div><!-- .staff-entry-position -->
<?php endif; ?>