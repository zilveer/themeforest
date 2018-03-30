<?php
/* 
 * Plugin Name:   Quick Localization (Quick Localisation)
 * Version:       0.0.6
 * Plugin URI:    http://name.ly/plugins/
 * Description:   Quick Localisation allows site admins to patch Wordpress translations of any theme and any plugin without leaving the control panel
 * Author:        Name.ly
 * Author URI:    http://namely.pro/
 */



if ( ! defined ( 'ABSPATH' ) ) { exit (); }



require_once ( "ql_class.php" );
global $QLC;
$QLC = new QL (); 



global $ql_options;
$ql_options = get_option ( 'ql_options' );



if ( is_admin () ) {
  require_once ( "ql_admin.php" );
}



register_activation_hook ( __FILE__, 'ql_activate' );
//register_deactivation_hook ( __FILE__, 'ql_deactivate' ); // N.B. this will clear the settings and the table in the database



function ql_activate () {
	// done automatically in $QLC constructor
}
	
function ql_deactivate () {
	global $QLC;
	$ql_new = $QLC -> uninstall ();
}



global $ql_footer_textarea;



add_filter ( "gettext", "ql_gettext_filter", 1000, 3 );

function ql_gettext_filter ( $new, $old, $domain ) {
	global $ql_options;
	global $QLC;
	global $ql_footer_textarea;

	$ql_new = $QLC -> translate ( $old, $domain );
	if ( false !== $ql_new ) {
		return $ql_new;
	} else {
		return $new;
	}
}



add_action ( "init", "ql_init_action" );

function ql_init_action () {
	global $ql_options;
	if (	function_exists ( "current_user_can" ) && current_user_can ( "administrator" )
		&& is_array ( $ql_options ) && is_array ( $_POST )
		&& isset ( $ql_options [ "footer_textarea" ] )
		&& ( "yes" == $ql_options [ "footer_textarea" ] && ! isset ( $_POST [ 'qlsnonce' ] ) || isset ( $_POST [ 'qlsnonce' ] ) && $_POST [ "ql_settings_footer_textarea" ] ) 
	) {
		add_action ( "wp_footer", "ql_wp_footer_action", 1000 );
		add_action ( "admin_footer", "ql_wp_footer_action", 1000 );
	}
}



function ql_wp_footer_action () {
	global $ql_footer_textarea;
	echo '<center><textarea style="width:90%;color:#DDD;background:#000;z-index:999999;position:absolute;bottom:0;left:5%;right:5%;">' . ( ! $ql_footer_textarea && $_POST [ "ql_settings_footer_textarea" ] ? __ ( "You have just enabled the debugging mode! Browse through the pages and see all used translations in this box.", "QL" ) : esc_textarea ( $ql_footer_textarea ) ) . '</textarea></center>';
}



?>