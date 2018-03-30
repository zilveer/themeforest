<?php
/**
 * Load here all the individual widgets
 *
 * @package Organique
 */


/**
 * Require the individual widgets
 */
$files_to_require = array(
	'widget-opening-time',
	'widget-featured-link',
	'widget-centered-title',
	'widget-google-map',
	'widget-alternative-text',
	'widget-title-with-icon',
	'widget-bootstrap-menu',
	'widget-newsletter-banner',
	'widget-testimonials',
	'widget-team-slider',
	'widget-shop-category-filter',
	'widget-theme-products',
	'widget-theme-top-rated-products',
);

foreach( $files_to_require as $file ) {
	locate_template ( "inc/widgets/{$file}.php", true, true );
}