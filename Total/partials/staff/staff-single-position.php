<?php
/**
 * Staff post title
 *
 * @package Total WordPress theme
 * @subpackage Partials
 * @version 3.5.0
 *
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Display if position is defined
if ( $position = get_post_meta( get_the_ID(), 'wpex_staff_position', true ) ) : ?>
	<div id="staff-single-position" class="single-staff-position wpex-em-14px wpex-clr"><?php echo $position; ?></div>
<?php endif; ?>