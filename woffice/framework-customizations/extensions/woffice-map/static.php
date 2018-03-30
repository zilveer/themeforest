<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}
/**
 * LOAD THE JAVASCRIPT FOR THE MAP
 */
if ( !is_admin() ) {

	$ext_instance = fw()->extensions->get( 'woffice-map' );
	
	if (function_exists('bp_is_active')):
		/*GET BUDDYPRESS AND CURENT POST INFO*/
		global $bp;
		global $post;
		/*THE MEMBERS SLUG SET IN THE SETTINGS*/
		$members_root = BP_MEMBERS_SLUG;
		/*THE CURRENT POST SLUG*/
		if (is_page()){
			$post_name = get_post( $post )->post_title;
		}
		else {
			$post_name = "nothing";
		}
		$current_slug = sanitize_title($post_name);
		/*THEN WE CHECK
			DOESNT WORK ! -> WIDGET ISSUE ... NO API
		*/
		//if($members_root == $current_slug) {

		/* GET THE API KEY */
        $key_option = (function_exists('fw_get_db_settings_option')) ? fw_get_db_settings_option('gmap_api_key') : '';
		if (!empty($key_option)){
			$key = $key_option;
		}
		else {
			$key = "AIzaSyAyXqXI9qYLIWaD9gLErobDccodaCgHiGs";
		}
		
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
		
		//}
	endif;
	
}