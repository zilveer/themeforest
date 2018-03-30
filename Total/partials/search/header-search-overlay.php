<?php
/**
 * Site header search dropdown HTML
 *
 * @package Total WordPress theme
 * @subpackage Partials
 * @version 3.5.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
} ?>

<div id="searchform-overlay" class="header-searchform-wrap clr">
	<div id="searchform-overlay-title"><?php esc_html_e( 'Search', 'total' ); ?></div>
	<?php get_search_form( true ); ?>
</div><!-- #searchform-overlay -->