<?php
/**
 * Blog entry avatar
 *
 * @package Total WordPress theme
 * @subpackage Partials
 * @version 3.0.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( $tags = wpex_get_category_tags() ) : ?>

	<div class="entry-media-term-tags clr">
		<?php echo wpex_get_category_tags(); ?>
	</div><!-- .entry-media-term-tags -->

<?php endif; ?>