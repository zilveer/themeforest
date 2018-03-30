<?php
$skin = null;
if ( isset( $_GET['skin'] ) && preg_match( '#^[a-zA-Z0-9\/]+$#' , $_GET['skin'] ) ) {
	$skin = htmlentities( $_GET['skin'], ENT_QUOTES );
	if ( function_exists( 'wolf_theme_customizer_skin' ) )
		wolf_theme_customizer_skin( $skin );
}
wp_redirect( admin_url( 'customize.php' ) );
exit;