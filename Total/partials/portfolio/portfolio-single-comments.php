<?php
/**
 * Portfolio single comments
 *
 * @package Total WordPress theme
 * @subpackage Partials
 * @version 3.0.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Return if comments are disabled
if ( ! comments_open() ) {
	return;
} ?>

<div id="portfolio-post-comments" class="clr">
	<?php comments_template(); ?>
</div><!-- #portfolio-post-comments -->