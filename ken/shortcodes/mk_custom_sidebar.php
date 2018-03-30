<?php

$el_class = $width = $el_position = '';

extract( shortcode_atts( array(
         'el_class' => '',
         'sidebar' => '',
      ), $atts ) );

$output = '';

$output .= '<div class=" '.$el_class.'">';
$output .= '<aside id="mk-sidebar"><div class="sidebar-wrapper" style="padding:0;">';
ob_start();
dynamic_sidebar( $sidebar );
$output .= ob_get_contents();
ob_end_clean();
$output .= '</div></aside>';
$output .= '</div>';

echo $output;
