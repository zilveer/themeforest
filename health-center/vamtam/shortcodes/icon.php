<?php

function wpv_shortcode_icon($atts, $content = null) {
	extract(shortcode_atts(array(
		'name' => '',
		'style' => '',
		'color' => '',
		'size' => '',
		'lheight' => 1,
	), $atts));

	$size_int = array(
		'small' => 16,
		'medium' => 24,
		'large' => 32,
	);

	$icon_char = wpv_get_icon($name);

	$theme = '';

	if ( strpos( $name, 'theme-' ) === 0 ) {
		$theme = 'theme';
	} elseif ( strpos( $name, 'custom-' ) === 0 ) {
		$theme = 'custom';
	}

	$color = wpv_sanitize_accent($color);

	if(isset($size_int[$size]))
		$size = $size_int[$size];

	$style_slug = $style;

	if(!empty($color)) {
		$style = "color:$color;";
		if($style_slug == 'inverted-colors' || $style_slug == 'box') {
			$l = new WpvLessc();
			$l->importDir = '.';
			$l->setFormatter("compressed");

			$style = $l->compile(
				WpvTemplates::readable_color_mixin() .
				"
				.readable-color($color);
				background: $color;
				"
			);
		}
	}

	$lheight = ((int)$lheight != 1 && (int)$lheight != (int)$size) ? "line-height:{$lheight};" : '';

	if(!empty($size))
		$size = "font-size:{$size}px !important;";

	return "<span class='icon shortcode $theme $style_slug' style='{$lheight}{$size}{$style}'>$icon_char</span>";
}
add_shortcode('icon', 'wpv_shortcode_icon');

function wpv_all_icons($atts, $content = null) {
	$icons = array_keys(wpv_get_icons_extended());

	ob_start();

	echo '<table class="vamtam-styled"><tr>';
	foreach($icons as $i=>$icon) {
		echo do_shortcode('<td>[icon name="'.$icon.'" size="24"]</td><td>'.$icon.'</td>');
		if($i%3 == 2)
			echo '</tr><tr>';
	}
	echo '</tr></table>';

	return ob_get_clean();
}
add_shortcode('all_vamtam_icons', 'wpv_all_icons');