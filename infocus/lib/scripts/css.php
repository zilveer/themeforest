<?php
/**
 *
 */
$wp_include = '../wp-load.php';
$i = 0; while ( !file_exists( $wp_include ) && $i++ < 10 ) {
  $wp_include = "../$wp_include";
}

require_once( $wp_include );

header( 'Content-type: text/css; charset=' . get_option( 'blog_charset' ) );

$expires = 60*60*24*30;
header( "Pragma: public" );
header( "Cache-Control: maxage=" . $expires );
header( 'Expires: ' . gmdate( 'D, d M Y H:i:s', time()+$expires ) . ' GMT' );

$css_options = get_option( MYSITE_SKINS );
$color_scheme = get_option( MYSITE_ACTIVE_SKIN );
$color_scheme = str_replace( '.css', '', $color_scheme['style_variations'] );
$css = $css_options[$color_scheme];
echo mysite_decode( $css );

?>