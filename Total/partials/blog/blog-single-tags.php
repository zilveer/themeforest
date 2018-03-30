<?php
/**
 * Single blog tags
 *
 * @package Total WordPress theme
 * @subpackage Partials
 * @version 3.0.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Display tags
the_tags( '<div class="post-tags clr">','','</div>' );