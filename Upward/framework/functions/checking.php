<?php if ( !defined( 'ABSPATH' ) ) exit;

/*

	1 - CHECKING

		1.1 - ST Kit

*/

/*===============================================

	C H E C K I N G
	Compatibility

===============================================*/

	/*-------------------------------------------
		1.1 - ST Kit
	-------------------------------------------*/

	global
		$kit_,
		$st_Kit,
		$st_Options;

		if ( !empty($st_Kit) && isset($st_Options['general']['stkit-min']) && version_compare( $st_Kit['version'], $st_Options['general']['stkit-min'] ) < 0 ) {

			$kit['plugins-page'] = 'plugins.php';

			$st_['fallback_theme_notice'] = __( "You're using ST Kit plugin v.", 'strictthemes' ) . $st_Kit['version'] . ', ' . __( 'however', 'strictthemes' ) . ' ' . $st_Options['general']['label'] . ' ' . __( 'theme requires ST Kit v.', 'strictthemes' ) . $st_Options['general']['stkit-min'] . ' ' . __( 'or higher. Update plugin', 'strictthemes' ) . ' <a href="' . $kit['plugins-page'] . '"><strong>' . __( 'here', 'strictthemes' ) . '</strong></a>.';

			add_action( 'admin_notices', 'st_fallback_theme_notice' );

		}


?>