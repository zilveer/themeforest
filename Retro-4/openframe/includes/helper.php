<?php
/*
*	openframe
*	written by stefano giliberti (stfno@me.com),
*	opendept.net
*/

define( 'op_theme_version', wp_get_theme()->get( 'Version' ) );

function op_config( $name ) {
	global $openframe;
	return isset( $openframe[ $name ] ) ? $openframe[ $name ] : null;
}

function op_theme_opt_default( $option ) {
	global $theme_defaults;
	return isset( $theme_defaults[ $option ] ) ? $theme_defaults[ $option ] : null;
}

function op_is_wp_edit() {
	return in_array( $GLOBALS['pagenow'], array( 'post.php', 'post-new.php' ) );
}

function op_theme_opt( $key ) {
	$option = get_option( op_config( 'theme' ) );
	if ( is_array( $option ) ) {
		if ( isset( $option[ $key ] ) ) {
			$option = stripslashes( $option[ $key ] );
		}
		elseif ( op_theme_opt_default( $key ) !== true ) {
			$option = op_theme_opt_default( $key );
		}
		else {
			$option = null;
		}
	}
	elseif ( op_theme_opt_default( $key ) === true ) {
		$option = $key;
	}
	else {
		$option = op_theme_opt_default( $key );
	}
	return $option;
}

function op_file_contents( $url ) {
	$request = curl_init( $url );
	curl_setopt( $request, CURLOPT_FAILONERROR, true );
	curl_setopt( $request, CURLOPT_FRESH_CONNECT, true );
	curl_setopt( $request, CURLOPT_RETURNTRANSFER, true );
	curl_setopt( $request, CURLOPT_TIMEOUT, 5 );
	$content = curl_exec( $request );
	curl_close( $request );
	return $content;
}

function op_version_check() {
	require_once( op_config( 'includes' ) . '/update.php' );
}

?>