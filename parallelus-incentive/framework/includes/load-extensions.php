<?php
//-----------------------------------------------------------------
// Load extensions
//-----------------------------------------------------------------
// Include report manager
$report_manager_load_file = get_template_directory().'/framework/includes/report-manager/load.php';
if(file_exists($report_manager_load_file)){
	include_once($report_manager_load_file);
}
// Include extensions manager
//................................................................
global $settings;
$ext_manager_load_file = get_template_directory().'/framework/includes/extensions-manager/load.php';

if ( file_exists( $ext_manager_load_file ) ) {
	include_once $ext_manager_load_file;

	// including core extensions
	$core_exts_list = $extm->get_extensions_list( $extm->core_extensions );
	foreach ( (array) $core_exts_list as $ext => $ext_info ) {
		if ( file_exists( $extm->core_extensions.$ext ) )
			include_once $extm->core_extensions.$ext;
	}

	// including additional extensions
	if (get_template() != 'runway-framework') {

		// Added check for template parent. If the template isn't Runway we're using a 
		// standalone theme. This loads all extensions for standalone themes without 
		// requiring activation.

		// TODO: We'll need to make sure that standalone themes ONLY get activated 
		// extensions copied to their package or this will cause chaos.
		$all_exts_list = $extm->get_extensions_list( $extm->extensions_dir );
		foreach ( (array) $all_exts_list as $ext => $ext_info ) {
			if ( file_exists( $extm->extensions_dir.$ext ) )
				include_once $extm->extensions_dir.$ext;
		}
	} else {

		// Default method, only load activated extensions
		if(isset($extm->admin_settings['extensions'][$extm->theme_name]['active']))
		foreach ( (array) $extm->admin_settings['extensions'][$extm->theme_name]['active'] as $ext ) {
			if ( file_exists( $extm->extensions_dir.$ext ) && $ext != '' ) {
				include_once $extm->extensions_dir.$ext;
			}
		}
	}
}

//out(get_options_data('formsbuilder_headers', 'field-bj7TdpYKc5vX'));

// Including extensions for child themes
//................................................................

//if ( !file_exists( get_stylesheet_directory().'/framework/' ) ) {
// $extm->is_child( true );
// $extensions_dir = get_template_directory() . '/extensions/';
// $admin_settings = get_option( 'runway_extensions_manager' );
// if ( !empty( $admin_settings ) ) {
//  $exts = $admin_settings['extensions'][$extm->theme_name];
//  if ( !empty( $exts ) ) {
//   foreach ( $exts as $ext ) {
//    if ( file_exists( $extensions_dir.$ext ) && $ext != '' )
//     include_once $extensions_dir.$ext;
//   }
//  }
// }
//}
?>
