<?php
extract( shortcode_atts( array(
			'title' => __( "Section", "mk_framework" ),
			'icon' => '',
			'icon_color' => '',
		), $atts ) );


if(!empty( $icon )) {
    $icon = (strpos($icon, 'mk-') !== FALSE) ? ( $icon ) : ( 'mk-'.$icon);    
} else {
    $icon = '';
}


$output = '';
$icon = !empty( $icon ) ? '<i style="color:'.$icon_color.'" class="' . $icon . '"></i>' : '';
$output .= "\n\t\t\t\t" . '<div class="mk-accordion-single"><div class="mk-accordion-tab">'.$icon.$title.'</div>';
$output .= "\n\t\t\t\t" . '<div class="mk-accordion-pane"><div class="inner-box">';
$output .= ($content=='' || $content==' ') ? __("Empty section. Edit page to add content here.", "mk_framework") : "\n\t\t\t\t" . wpb_js_remove_wpautop($content);
$output .= "\n\t\t\t\t" . '<div class="clearboth"></div></div></div></div>';

echo $output;
