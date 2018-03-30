<?php
/**
 * Page subheading output
 *
 * @package Total WordPress theme
 * @subpackage Partials
 * @version 3.5.3
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Display subheading if there is one
if ( $subheading = wpex_global_obj( 'get_page_subheading' ) ) : ?>
	<div class="page-subheading clr"><?php echo do_shortcode( wp_kses_post( $subheading ) ); ?></div>
<?php endif; ?>