<?php
function couponxl_sidebar_func( $atts, $content ){
	extract( shortcode_atts( array(
		'home_sidebar' => '',
	), $atts ) );

	ob_start();
	if( is_active_sidebar( $home_sidebar ) ){
		dynamic_sidebar( $home_sidebar );
	}
	$content = ob_get_contents();
	ob_end_clean();

	return $content;
}

add_shortcode( 'sidebar', 'couponxl_sidebar_func' );

function couponxl_sidebar_params(){
	$home_sidebars = couponxl_get_option( 'home_sidebars' );
	if( empty( $home_sidebars ) ){
		$home_sidebars = 2;
	}

	$sidebars = array();

	for( $i=1; $i<=$home_sidebars; $i++ ){
		$sidebars[__( 'Home Sidebar ', 'couponxl' ).$i] = 'home-sidebar-'.$i;
	}
	return array(
		array(
			"type" => "dropdown",
			"value" => $sidebars,
			"holder" => "div",
			"class" => "",
			"heading" => __("Home Sidebar","couponxl"),
			"param_name" => "home_sidebar",
			"description" => __("Select Sidebar To Show","couponxl")
		),
	);
}
?>