<?php

/**
 * Columns content
 */

function ch_column($atts, $content = null, $code) {
	return '<div class="' . $code . '">' . do_shortcode(trim($content)) . '</div>';
}

function ch_column_last($atts, $content = null, $code) {
	return '<div class="' . str_replace('_last','',$code) . ' column-last">' .
				do_shortcode(trim($content)) .
			'</div>
			<div class="clearer"></div>';
}

add_shortcode('one_half', 'ch_column');
add_shortcode('one_third', 'ch_column');
add_shortcode('one_fourth', 'ch_column');
add_shortcode('one_fifth', 'ch_column');
add_shortcode('one_sixth', 'ch_column');

add_shortcode('two_thirds', 'ch_column');
add_shortcode('three_fourths', 'ch_column');
add_shortcode('two_fifths', 'ch_column');
add_shortcode('three_fifths', 'ch_column');
add_shortcode('four_fifths', 'ch_column');
add_shortcode('five_sixths', 'ch_column');

add_shortcode('one_half_last', 'ch_column_last');
add_shortcode('one_third_last', 'ch_column_last');
add_shortcode('one_fourth_last', 'ch_column_last');
add_shortcode('one_fifth_last', 'ch_column_last');
add_shortcode('one_sixth_last', 'ch_column_last');

add_shortcode('two_thirds_last', 'ch_column_last');
add_shortcode('three_fourths_last', 'ch_column_last');
add_shortcode('two_fifths_last', 'ch_column_last');
add_shortcode('three_fifths_last', 'ch_column_last');
add_shortcode('four_fifths_last', 'ch_column_last');
add_shortcode('five_sixths_last', 'ch_column_last');