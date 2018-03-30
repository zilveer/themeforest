<?php
extract( shortcode_atts( array(
	'el_width' => '',
	'style' => '',
	'color' => '',
	'accent_color' => '',
	'el_class' => '',
        'el_align' => '',
        'border_width' => ''
), $atts ) );

echo do_shortcode( '[vc_text_separator style="' . $style . '" color="' . $color . '" accent_color="' . $accent_color . '" el_width="' . $el_width . '" el_class="' . $el_class . '" el_align="' . $el_align . '" border_width="' . $border_width . '"]' );