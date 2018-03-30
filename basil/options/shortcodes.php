<?php

/**
 * Returns current year
 *
 * @uses [year]
 */
add_shortcode('year', 'basil_shortcode_year');
function basil_shortcode_year() {
	return date('Y');
}