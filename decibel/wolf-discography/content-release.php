<?php
/**
 * The discography loop
 *
 */
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

$layout = wolf_get_theme_option( 'release_type' );

if ( 'full' == $layout || 'full-alt' == $layout || 'sidebar' == $layout || '' == $layout ) {
	$layout = 'classic';
}

wolf_discography_get_template_part( 'content', 'release-' . $layout );
