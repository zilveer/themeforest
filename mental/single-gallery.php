<?php
/**
 * Single Gallery item template, includes appropriate subtemplates
 * based on settings
 *
 * @author Vedmant <vedmant@gmail.com>
 * @package Mental WP
 * @link http://azelab.com
 */
defined( 'ABSPATH' ) OR exit( 'restricted access' ); // Protect against direct call
?>

<?php

$page_type = get_mental_option( 'gallery_single_type' );


if ( get_post_format() != 'audio' ) {
	if ( $page_type == 'full-1' ) {
		get_template_part( 'single-gallery-full1' );
	} elseif ( $page_type == 'full-2' ) {
		get_template_part( 'single-gallery-full2' );
	} elseif ( $page_type == 'full-thumbs' ) {
		get_template_part( 'single-gallery-full-thumb' );
	} elseif ( $page_type == 'full-video' ) {
		get_template_part( 'single-gallery-full-video' );
	} else {
		get_template_part( 'single-gallery-descr' );
	}
} else {
	get_template_part( 'single-gallery-descr' );
}


