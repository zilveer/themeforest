<?php



global $ql_options;



if ( is_admin () && ( ! is_multisite () || is_multisite () && ( "yes" != $ql_options [ "only_superadmins" ] || is_super_admin () ) ) ) {

  require_once "ql_edit.php";
  require_once "ql_export.php";
  require_once "ql_import.php";
  require_once "ql_settings.php";

  add_action ( 'admin_notices', 'ql_admin_notices' );
  add_action ( 'admin_menu', 'ql_add_menu_pages' );

}



function ql_admin_notices () {
	$ql_options = get_option ( 'ql_options' );
	if ( $ql_options [ 'version' ] !== QL_VERSION ) {
		echo '<div id="notice" class="updated fade"><p>';
		echo sprintf ( __ ( "<b>QL Version (%s):</b> upgraded successfully.", "QL" ), QL_VERSION );
		echo '</p></div>', "\n";
		$ql_options [ 'version' ] = QL_VERSION;
		update_option ( 'ql_options', $ql_options);
	}

	if(isset( $collect_draft_translations_fe ) && isset($collect_draft_translations_be)) {if ( ( "yes" == $ql_options [ 'collect_draft_translations_fe' ] || "yes" == $ql_options [ 'collect_draft_translations_be' ] ) && ! isset ( $_POST [ 'ql_save' ] ) ) {
		echo '<div id="notice" class="updated fade"><p>' . sprintf ( __ ( 'You are currently gathering <code>gettext</code> localisation entries. Go to the <a href="%s/wp-admin/admin.php?page=ql-settings">Settings</a> page to turn it off.', "QL" ), get_option ( 'home' ) ) . '</p></div>', "\n";
	} }
}



function ql_add_menu_pages () {
	add_menu_page ( __ ( "Localisation", "QL" ),	__ ( "Localisation", "QL" ),	'add_users', 'ql-home', 	'ql_edit_page', get_template_directory_uri().'/includes/quick-localization/images/select-language-16.png' );
	add_submenu_page ( 'ql-home', __ ( "Edit", "QL" ),	__ ( "Edit", "QL" ),			'add_users', 'ql-home',		'ql_edit_page' );
	add_submenu_page ( 'ql-home', __ ( "Export", "QL" ),	__ ( "Export", "QL" ),		'add_users', 'ql-export',	'ql_export_page' );
	add_submenu_page ( 'ql-home', __ ( "Import", "QL" ),	__ ( "Import", "QL" ),		'add_users', 'ql-import',	'ql_import_page' );
	add_submenu_page ( 'ql-home', __ ( "Settings", "QL" ),	__ ( "Settings", "QL" ),		'add_users', 'ql-settings',	'ql_settings_page' );
}



?>