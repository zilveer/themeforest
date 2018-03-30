<?php
$style = '';
$args = array(
    "columns" => "three_columns",
    "style"   => "",
);

$html = "";

extract(shortcode_atts($args, $atts));

if( $style == 'style_two' ) { $style = 'style3'; $no_margin = ''; } else { $style = ''; $no_margin = 'no-margin'; }

echo '<div class="houzez-module service-blocks-main services-module '.esc_attr( $columns ).' '.esc_attr( $style ).'"><div class="row '.esc_attr( $no_margin ).'">';

echo do_shortcode($content);

echo '</div></div>';