<?php
/**
 * Main Loop
 *
 * @package Total WordPress theme
 * @subpackage Partials
 * @version 3.0.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Add to counter
global $wpex_count;
$wpex_count++;

	// Include template part
	get_template_part( 'partials/portfolio/portfolio-entry' );

// Clear Counter
if ( wpex_portfolio_archive_columns() == $wpex_count ) {
	$wpex_count=0;
}