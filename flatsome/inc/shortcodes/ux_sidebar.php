<?php


function flatsome_sidebar_shortcode( $atts ){
  
  extract( shortcode_atts( array(
    'id' => 'sidebar-main',
    'class' => '',
    'style' => ''
  ), $atts ) );

	if($style) $style = 'widgets-'.$style;

	ob_start();
	dynamic_sidebar($id);
	$sidebar = trim( ob_get_clean() );

	 return '<div class="sidebar-wrapper '.$style.'">'.$sidebar.'</div>';

}
add_shortcode('ux_sidebar', 'flatsome_sidebar_shortcode');