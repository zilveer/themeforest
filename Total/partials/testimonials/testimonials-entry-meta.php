<?php
/**
 * Outputs the testimonial entry meta data
 *
 * @package Total WordPress theme
 * @subpackage Partials
 * @version 3.5.3
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
} ?>

<div class="testimonial-entry-meta clr"><?php

	// Display rating author
	get_template_part( 'partials/testimonials/testimonials-entry-author' );

	// Display testimonial company
	get_template_part( 'partials/testimonials/testimonials-entry-company' );

	// Display testimonial star rating
	get_template_part( 'partials/testimonials/testimonials-entry-rating' );

?></div>