<?php
/**
 * Outputs the portfolio entry excerpt
 *
 * @package Total WordPress theme
 * @subpackage Partials
 * @version 3.0.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Get excerpt length
$excerpt_length = wpex_get_mod( 'portfolio_entry_excerpt_length', '20' );

// Return if excerpt length is set to 0
if ( '0' == $excerpt_length ) {
	return;
} ?>

<div class="portfolio-entry-excerpt clr">
	<?php wpex_excerpt( array(
		'length'   => $excerpt_length,
		'readmore' => false,
	) ); ?>
</div><!-- .portfolio-entry-excerpt -->