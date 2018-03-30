<?php
/**
 * Outputs the testimonial entry avatar
 *
 * @package Total WordPress theme
 * @subpackage Partials
 * @version 3.5.3
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Display thumbnail if defined
if ( $thumbnail = wpex_get_testimonials_entry_thumbnail() ) : ?>
	<div class="testimonial-entry-thumb"><?php echo $thumbnail; // Already sanitized ?></div>
<?php endif; ?>