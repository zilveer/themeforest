<?php
/**
 * Page links
 *
 * @package Total WordPress theme
 * @subpackage Partials
 * @version 3.0.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Link pages when using <!--nextpage-->
wp_link_pages( array(
	'before'      => '<div class="page-links clr">',
	'after'       => '</div>',
	'link_before' => '<span>',
	'link_after'  => '</span>'
) );