<?php
/**
 * Staff single comments
 *
 * @package Total WordPress theme
 * @subpackage Partials
 * @version 3.0.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Display comments if enabled
if ( comments_open() ) : ?>
	<div id="staff-post-comments" class="clr">
		<?php comments_template(); ?>
	</div><!-- #staff-post-comments -->
<?php endif; ?>