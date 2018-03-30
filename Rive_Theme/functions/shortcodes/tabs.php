<?php
/*
* Show tabs
*/

function ch_tabs($atts, $content = null, $code) {
	extract(shortcode_atts(array(), $atts));
	$output = '';

	if (!preg_match_all("/(.?)\[(tab)\b(.*?)(?:(\/))?\](?:(.+?)\[\/tab\])?(.?)/s", $content, $matches)) {
		return do_shortcode($content);
	}

	for($i = 0; $i < count($matches[0]); $i++) {
		$matches[3][$i] = shortcode_parse_atts($matches[3][$i]);
	}

	global $tabs_shown;
	if($tabs_shown) {
		$tabs_shown++;
	} else {
		$tabs_shown = 1;
	}

	$rand = 'tabs-' . $tabs_shown . rand(0, 100000);

	$output .= '<ul class="nav nav-tabs" id="' . $rand . '">';
	for($i=0; $i<count($matches[0]); $i++) {
		$active = '';
		if ( $i == 0 ) {
			$active = ' class="active"';
		}
		$tab_title = implode(' ', $matches[3][$i]);
		$tab_title = str_replace('&#8221;', '', $tab_title);
		$tab_title = str_replace('&#8243;', '', $tab_title);
		$output .= '<li' . $active . '><a href="#' . $rand . $i . '">' . $tab_title . '</a></li>';
	}
	$output .= '</ul>';

	$output .= '<div class="tab-content">';
	for($i=0; $i<count($matches[0]); $i++) {
		$active = '';
		if ( $i == 0 ) {
			$active = ' active in';
		}
		$output .= '<div class="tab-pane fade' . $active . '" id="' . $rand . $i . '">' . do_shortcode(trim($matches[5][$i])) . '</div>';
	}
	$output .= '</div>';

	return '<div class="tabs">' . $output . '</div>
	<script type="text/javascript">
		jQuery("#' . $rand . ' a").click(function (e) {
			e.preventDefault();
			jQuery(this).tab(\'show\');
		});
	</script>';
}
add_shortcode('tabs', 'ch_tabs');