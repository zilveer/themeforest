<?php
/**
 * Load here all the individual widgets
 *
 * @package BuildPress
 */


/**
 * Require the individual widgets
 */
$files_to_require = array(
	'widget-icon-box',
	'widget-social-icons',
	'widget-banner',
	'widget-brochure-box',
	'widget-testimonials',
	'widget-google-map',
	'widget-featured-page',
	'widget-facebook',
);

foreach( $files_to_require as $file ) {
	locate_template ( "inc/widgets/{$file}.php", true, true );
}