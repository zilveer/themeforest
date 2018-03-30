<?php

/*
* Toggle, Accordion shortcodes
*/

// Toggle
function ch_toggle($atts, $content = null, $code) {
	extract(shortcode_atts(array(
		'title'  => false,
		'hidden' => 'true'
	), $atts));

	$show_hidden = ($hidden != 'true')? ' in' : '';
	$random      = rand(0, 100000);
	return '
				<div id="accordion-' . $random . '" class="accordion">
					<div class="accordion-group">
						<div class="accordion-heading">
							<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion-' . $random . '" href="#collapse_' . $random . '">
								' . $title . '
							</a>
						</div>
						<div id="collapse_' . $random . '" class="accordion-body collapse ' . $show_hidden . '">
							<div class="accordion-inner">
								' . do_shortcode(trim($content)) . '
							</div>
						</div>
					</div>
                </div>';
}
add_shortcode('toggle', 'ch_toggle');

// Accordion
function ch_accordions($atts, $content = null, $code) {
	extract(shortcode_atts(array(
		'one_opened_item' => true
	), $atts));

	$random          = rand(0, 100000);
	$one_opened_item = ($one_opened_item == 'true')? ' data-parent="#accordion-' . $random . '"' : '';

	if (!preg_match_all("/(.?)\[(accordion)\b(.*?)(?:(\/))?\](?:(.+?)\[\/accordion\])?(.?)/s", $content, $matches)) {
		return do_shortcode($content);
	}

	for($i=0; $i < count($matches[0]); $i++) {
		$matches[3][$i] = shortcode_parse_atts($matches[3][$i]);
	}

	$output = '';
	$output .= '<div id="accordion-' . $random . '" class="accordion">';

	for($i=0; $i < count($matches[0]); $i++) {
		$active = '';
		if ( $i == 0 ) {
			$active = ' in';
		}
		$accordion_title = implode(' ', $matches[3][$i]);
		$accordion_title = str_replace('&#8221;', '', $accordion_title);
		$accordion_title = str_replace('&#8243;', '', $accordion_title);
		$output .= '
				<div class="accordion-group">
					<div class="accordion-heading">
						<a class="accordion-toggle" data-toggle="collapse"' . $one_opened_item . ' href="#collapse_' . $i . '">
							' . $accordion_title . '
						</a>
					</div>
					<div id="collapse_' . $i . '" class="accordion-body collapse ' . $active . '">
						<div class="accordion-inner">
							' . do_shortcode(trim($matches[5][$i])) . '
						</div>
					</div>
				</div>';
	}
	$output .= '
			</div>';
	return $output;
}
add_shortcode('accordions', 'ch_accordions');