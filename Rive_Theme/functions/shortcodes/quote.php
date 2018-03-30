<?php
/*
 * Quote shortcode
 */

// Quote message boxes
function ch_quote($atts, $content = null, $code) {
	extract(shortcode_atts(array(
		'author'   => '',
		'position' => ''
	), $atts));

	return '<div class="testimonials-wrapper ' . $code . '">
				<div class="testimonial">
					<div class="testimonial-description">
						<span class="blockquote-img visible-desktop">&nbsp;</span>
						' . do_shortcode($content) . '
					</div>
					<div class="clearfix"></div>
					<div class="testimonial-author"><strong>' . $author . '</strong> <span>' . $position . '</span></div>
				</div>
		    </div>';
}

add_shortcode('quote','ch_quote');