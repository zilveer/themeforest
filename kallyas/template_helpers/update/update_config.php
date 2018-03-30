<?php if(! defined('THEME_BASE')) { exit('Invalid Request');}

add_filter( 'zn_theme_update_scripts', 'zn_kallyas_updater_scripts' );
add_filter( 'zn_theme_normal_update_scripts', 'zn_kallyas_normal_updates_scripts' );

/**
 *	Updates that requires DB updates ( Normally it should only be the V3 to V4 update )
 */
function zn_kallyas_updater_scripts(){
	$updates = array(
			'4.0.0' => array(
				'file' => THEME_BASE .'/template_helpers/update/scripts/kallyas-update-4.0.0.php',
				'function' => 'zn_cnv_perform_updatev4'
			)
		);

	return $updates;
}

function zn_kallyas_normal_updates_scripts(){
	$updates = array(
		'4.0.5' => array(
			'function' => 'zn_update_405'
		),
		'4.0.9' => array(
			'function' => 'zn_update_409'
		),
		'4.0.12' => array(
			'function' => 'zn_update_4012'
		),
		'4.1.5' => array(
			'function' => 'zn_update_415'
		),
		'4.3.1' => array(
			'function' => 'zn_update_431'
		),
	);

	return $updates;
}

/**
 *	Sets the theme version to 3.6.10 if this is an old installation
 *	The priority should be bellow 5 - at this point, the install script check for the version
 */
add_action( 'admin_init', 'zn_check_old_kallyas', 2 );
function zn_check_old_kallyas(){

	// Get the old field for kallyas options
	$saved_options = get_option( 'zn_kallyas_options' );
	if( ! empty( $saved_options ) ){

		$current_theme_version	= get_option( 'zn_kallyas_version' );
		$saved_options = get_option( 'zn_kallyas_optionsv4' );

		// This is possible to be an old installation of kallyas
		if( empty( $current_theme_version ) && empty( $saved_options ) ){
			// Update the theme versions
			update_option( 'zn_kallyas_version', '3.6.10', false );
			update_option( 'zn_kallyas_optionsv4', array('dummy_array'), false );
		}
	}
}

/*
 *	4.0.5 Update
 */
function zn_update_405(){

	$uploads = wp_upload_dir();
	$file_path = trailingslashit( $uploads['basedir'] ) . 'zn_custom_css.css';
	// Change the custom css saving from file to DB
	if ( file_exists( $file_path ) ){
		$saved_css = file_get_contents( $file_path );
		if( ! empty( $saved_css ) ){
			update_option( 'zn_'.ZN()->theme_data['theme_id'].'_custom_css', $saved_css, false );
		}
		@unlink( $file_path );
	}
}

/*
 * 4.0.9 update
 */
function zn_update_409(){

	$config = array(
		'tf_username' => zget_option( 'zn_theme_username', 'advanced_options', false, null ),
		'tf_api' => zget_option( 'zn_theme_api', 'advanced_options', false, null ),
	);

	update_option( 'kallyas_update_config', $config );
}

/*
 * 4.0.12 update
 */
function zn_update_4012(){
	// Remove the favicon option and set it as site_icon
	$favicon 	= zget_option( 'custom_favicon', 'general_options' );
	$site_icon 	= get_option( 'site_icon' );
	if( ! empty( $favicon ) && empty( $site_icon ) ){
		$favicon_image_id = ZngetAttachmentIdFromUrl( $favicon );
		update_option( 'site_icon', $favicon_image_id );
	}
}

/*
 * 4.1.5 update
 * "Fixes" the hide footer option ( see #1396 )
 */
function zn_update_415(){
	// Check if we need to change something
	$show_footer = zget_option( 'footer_show', 'general_options', false, 'yes' );
	$config = zn_get_pb_template_config( 'footer' );
	if( $show_footer == 'no' && $config['template'] !== 'no_template' && $config['location'] === 'replace' ){
		$all_options = zget_option( '', '', true );
		$all_options['general_options']['footer_show'] = 'yes';
		update_option( 'zn_kallyas_optionsv4', $all_options );
	}
}

function zn_update_431(){
	$permalinks = get_option( 'zn_permalinks' );
	$new_permalinks = array();

	// Convert old permalinks values
	if( is_array( $permalinks ) ){
		// Portfolio item
		if( ! empty( $permalinks['port_item'] ) ){
			$new_permalinks['portfolio'] = $permalinks['port_item'];
		}

		// Portfolio category
		if( ! empty( $permalinks['port_tax'] ) ){
			$new_permalinks['project_category'] = $permalinks['port_tax'];
		}

		// Documentation item
		if( ! empty( $permalinks['doc_item'] ) ){
			$new_permalinks['documentation'] = $permalinks['doc_item'];
		}

		// Documentation category
		if( ! empty( $permalinks['doc_tax'] ) ){
			$new_permalinks['documentation_category'] = $permalinks['doc_tax'];
		}

		update_option( 'zn_permalinks', $new_permalinks );

	}
}