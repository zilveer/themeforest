<?php
/**
 * Togglebar output
 *
 * @package Total WordPress theme
 * @subpackage Partials
 * @version 3.3.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
} ?>

<div id="toggle-bar-wrap" class="<?php echo wpex_toggle_bar_classes(); ?>">
	<div id="toggle-bar" class="container wpex-clr">
		<?php get_template_part( 'partials/togglebar/togglebar-content' ); ?>
	</div><!-- #toggle-bar -->
</div><!-- #toggle-bar-wrap -->