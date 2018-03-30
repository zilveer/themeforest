<?php
/**
 * Topbar content
 *
 * @package Total WordPress Theme
 * @subpackage Partials
 * @version 3.5.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Get topbar content
$content = wpex_global_obj( 'top_bar_content' );

// Display topbar content
if ( $content || has_nav_menu( 'topbar_menu' ) ) : ?>

	<div id="top-bar-content" class="<?php echo wpex_top_bar_classes(); ?>">

		<?php
		// Get topbar menu
		get_template_part( 'partials/topbar/topbar-menu' ); ?>

		<?php
		// Check if there is content for the topbar
		if ( $content ) : ?>

			<?php
			// Display top bar content
			echo do_shortcode( $content ); ?>

		<?php endif; ?>

	</div><!-- #top-bar-content -->

<?php endif; ?>