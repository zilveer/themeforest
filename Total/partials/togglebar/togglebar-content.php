<?php
/**
 * Togglebar content output
 *
 * @package Total WordPress theme
 * @subpackage Partials
 * @version 3.3.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Display content if defined
if ( $content = get_post_field( 'post_content', wpex_global_obj( 'toggle_bar_content_id' ) ) ) : ?>

	<div class="entry wpex-clr">
		<?php echo apply_filters( 'the_content', $content ); ?>		
	</div><!-- .entry -->

<?php endif; ?>