<?php
/**
 * Search entry layout
 *
 * @package Total WordPress theme
 * @subpackage Partials
 * @version 3.3.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
} ?>

<article id="search-no-results" class="clr">
	<?php esc_html_e( 'Sorry, no results were found for this query.', 'total' ); ?>
</article><!-- #search-no-results -->