<?php

/** Shortcodes **/

function ubermenu_shortcode( $atts ){

	extract(shortcode_atts(array(
		'instance_id'		=> '',		//deprecated
		'config_id'			=> 'main',

		'theme_location' 	=> '',
		'menu'				=> '',
	), $atts));

	//If an instance_id (deprecated) was passed, use it as the config_id
	if( $instance_id != '' ) $config_id = $instance_id;

	$args = array(
		'echo'	=> false,
	);

	if( $theme_location ){
		$args['theme_location'] = $theme_location;
	}
	if( $menu ){
		$args['menu'] = $menu;
	}

	return ubermenu( $config_id , $args );
}
add_shortcode( 'ubermenu' , 'ubermenu_shortcode' );



function ubermenu_direct_shortcode( $atts ){
	extract(shortcode_atts(array(
		'theme_location' => 'ubermenu'
	), $atts));

	return uberMenu_direct( $theme_location , false , false );
}
add_shortcode( 'uberMenu_direct' , 'ubermenu_direct_shortcode' );


function uberMenu_easyIntegrate_shortcode( $atts = array(), $data = '' ){
	extract(shortcode_atts(array(
		'echo'	=>	'true',
	), $atts));

	$echo = $echo == 'false' ? false : true;

	$args = array(
		'echo'	=> $echo
	);

	return uberMenu_easyIntegrate( $config_id = 'main' , $args );

}
add_shortcode( 'uberMenu_easyIntegrate' , 'uberMenu_easyIntegrate_shortcode');