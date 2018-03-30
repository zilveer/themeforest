<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}
/**
 * LOAD THE JAVASCRIPT FOR THE MAP
 */
if ( !is_admin() ) {

	$ext_instance = fw()->extensions->get( 'woffice-directory' );

	/* GET GEOCODE FOR THIS LOCATION */
    $key_option = (function_exists('fw_get_db_settings_option')) ? fw_get_db_settings_option('gmap_api_key') : '';
	if (!empty($key_option)){
		$key = $key_option;
	}
	else {
		$key = "AIzaSyAyXqXI9qYLIWaD9gLErobDccodaCgHiGs";
	}
	
	if((is_page_template("page-templates/page-directory.php") || is_singular("directory") || is_tax( 'directory-category' )) && !wp_script_is('google-maps-api-v3')) {
		$language = substr( get_locale(), 0, 2 );
		wp_enqueue_script(
			'google-maps-api-v3',
			'https://maps.googleapis.com/maps/api/js?'. http_build_query(array(
				'v' => '3.23',
				'libraries' => 'places',
				'language' => $language,
				'key' => $key,
			)),
			true
		);
	}
	
	// LOAD PROJECTS SCRIPTS
	wp_enqueue_script(
		'fw-directory',
		$ext_instance->get_declared_URI( '/static/js/directory.js' ),
		array( 'jquery' ),
		'1.0',
		true
	);
	
}