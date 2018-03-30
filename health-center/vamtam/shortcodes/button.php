<?php

/**
 * displays a button
 */

function wpv_shortcode_button($atts, $content = null, $code) {
	extract(shortcode_atts(array(
		'id' => false,
		'class' => false,
		'font' => '',
		'link' => '',
		'linktarget' => '',
		'bgcolor' => '',
		'hover_color' => 'accent1',
		'align' => false,
		'icon' => '',
		'icon_placement' => 'left',
		'icon_color' => '',
		'style' => 'filled',
	), $atts));

	$id = $id ? ' id="' . $id . '"' : '';
	$class = $class ? ' '.$class : '';
	$link = $link ? ' href="' . $link . '"' : '';
	$linktarget = $linktarget ? ' target="' . $linktarget . '"' : '';

	// inline styles for the button
	if ( ! empty( $font ) ) {
		if ( substr( $font, -2 ) !== 'em' ) {
			$font .= 'px';
		}

		$font = "font-size: {$font};";
	}

	$class .= ' button-'.$style;

	$class .= ' hover-'.$hover_color;

	$style = ($font != '')? " style='$font'" : '';

	$aligncss = ($align && $align != 'center') ? ' align'.$align : '';

	$icon = empty($icon) ? '' : do_shortcode('[icon name="'.$icon.'" color="'.$icon_color.'"]');
	$icon_b = $icon_a = '';
	if($icon_placement == 'left') {
		$icon_b = $icon;
	} else {
		$icon_a = $icon;
	}

	$content = '<a'.
					$id.
					$link.
					$linktarget.
					$style.
					' class="button vamtam-button '.
					"$bgcolor $class $aligncss".
				'">'.$icon_b.'<span class="btext">' . trim(do_shortcode($content)) . '</span>'.$icon_a.'</a>';

	$content = $content;

	if($align === 'center')
		return '<p class="textcenter">'.$content.'</p>';
	else
		return $content;
}
add_shortcode('button', 'wpv_shortcode_button');