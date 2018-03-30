<?php
/**
 * Footer Builder Content
 *
 * @package Total WordPress Theme
 * @subpackage Partials
 * @version 3.5.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
} ?>

<?php wpex_hook_footer_before(); ?>

	<?php
	// Display footer builder
	if ( $page_id = wpex_global_obj( 'footer_builder' ) ) : ?>

		<div id="footer-builder" class="footer-builder clr">
			<div class="footer-builder-content clr container entry">
				<?php echo do_shortcode( get_post_field( 'post_content', $page_id ) ); ?>
			</div><!-- .footer-builder-content -->
		</div><!-- .footer-builder -->

	<?php endif; ?>

<?php wpex_hook_footer_after(); ?>