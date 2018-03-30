<?php if(! defined('ABSPATH')){ return; }

// Add ajax functionality
add_action( 'wp_ajax_zn_ajax_callback', 'zn_ajax_callback' );
add_action( 'wp_ajax_zn_theme_registration', 'theme_registration_hook' );
add_action( 'wp_ajax_zn_dummy_install', 'dummy_install_hook' );

function dummy_install_hook(){
	if ( ! isset( $_POST['zn_nonce'] ) || ! wp_verify_nonce( $_POST['zn_nonce'], 'zn_dummy_install' ) ) {
		print 'Sorry, your nonce did not verify.';
		exit;
	}

	require_once( FW_PATH . '/admin/class-dummy-install.php' );

	$install_folder = isset( $_POST['install_folder'] ) ? $_POST['install_folder'] : false;

	// Get extra options
	// @since v4.1.5
	$options = isset($_POST['options']) ? $_POST['options'] : null;

	$importer = new ZnDummyDataManager( $install_folder, $options );

	wp_send_json_success();
	wp_die();
}

/**
 * Will check and save the user credentials needed for automatic theme updates
 * @return string A json formatted value
 */
function theme_registration_hook()
{
	if ( ! isset( $_POST['zn_nonce'] ) || ! wp_verify_nonce( $_POST['zn_nonce'], 'zn_theme_registration' ) ) {
		wp_send_json_error( array( 'error' => 'Sorry, your nonce did not verify.' ) );
	}

	$option_name = ZN()->theme_data['theme_id'].'_update_config';
	$tf_username = isset( $_POST['username'] ) ? esc_attr($_POST['username']) : '';
	$tf_api      = isset( $_POST['api_key'] ) ? esc_attr($_POST['api_key']) : '';

	if( ! empty( $tf_username ) && ! empty( $tf_api ) )
	{
		$config = array(
			'tf_username' => $tf_username,
			'tf_api' => $tf_api,
		);

		$theme_author = ZN()->theme_data['supports']['theme_updater'];

		//@since v4.1.4: Validate TF username + API
		$result = ZnThemeUpdater::validateThemeRegistration($tf_username, $tf_api);

		if(false === $result){
			wp_send_json_error( array( 'error' => __("An error occurred while trying to connect to Envato. Please try
			 again in a few minutes.", 'zn_framework') ) );
		}
		if(is_array($result))
		{
			// here $result will have keys: "success" & "data"
			if((bool)$result['success'])
			{
				// Check to see whether or not the client has purchased the theme
				$installed = wp_get_themes();
				$filtered = array();
				$has_purchased = false;

				foreach ($installed as $theme) {
					if ($theme_author && !in_array($theme->{'Author Name'},$theme_author)) continue;
					$filtered[$theme->Name] = $theme;
				}

				// convert to array (since 'wp-list-themes' is not really a valid object property)
				$result['data'] = (array)$result['data'];
				foreach ($result['data']['wp-list-themes'] as $theme) {
					if (isset($theme->theme_name) && isset($filtered[$theme->theme_name])) {
						$has_purchased = true;
						break;
					}
				}

				// Save the values
				if( $has_purchased ){
					update_option( $option_name, $config, false );
					wp_send_json_success(array( 'message' => __('Thank you for registering the theme.', 'zn_framework') ));
				}
				else{
					wp_send_json_error(
						array(
							'error' => __("It seems you didn't purchase the theme from the added account. Can you please check the credentials provided?", 'zn_framework')
						)
					);
				}
			}
			else {
				wp_send_json_error( array( 'error' => $result['data'] ) );
			}
		}
	}
	wp_send_json_error( array( 'error' => __('Please enter your username and API key.', 'zn_framework') ) );
}

function zn_ajax_callback() {

	check_ajax_referer( 'zn_framework', 'zn_ajax_nonce' );

	$save_action = $_POST['zn_action'];

	if ( $save_action == 'zn_save_options' ) {

		// DO ACTION FOR SAVED OPTIONS
		do_action( 'zn_save_theme_options' );

		$data = json_decode( stripslashes($_POST['data']), true );

		/* REMOVE THE HIDDEN FORM DATA */
		unset($data['action']);
		unset($data['zn_action']);
		unset($data['zn_ajax_nonce']);

		$options_field = $data['zn_option_field'];

		// Combine all options
		// Get all saved options
		$saved_options = zget_option( '' , '' , true );
		$saved_options[$options_field] = $data;

		$result = znklfw_save_theme_options( $saved_options );

		if ( $result == 0 || $result ) {
				echo 'Settings successfully save';
			die();
		}
		else {
				echo 'There was a problem while saving the options';
			die();
		}

	}
	elseif ( $save_action == 'zn_add_element' ) {

		$data = $_POST;

		if ( empty( $data['zn_elem_type'] ) ) {
			return;
		}

		$value = json_decode ( base64_decode( $data['zn_json'] ), true );
		$value['dynamic'] = true;

		echo ZN()->html()->zn_render_single_option( $value );

		die();
	}
	elseif ( $save_action == 'zn_add_google_font' ) {

		$data = $_POST;

		if ( empty( $data['zn_elem_type'] ) ) {
			return;
		}

		$value = json_decode ( base64_decode( $data['zn_json'] ), true );
		if( isset( $data['selected_font'] ) ) {
			$value['selected_font'] = $data['selected_font'];
		}
		$value['dynamic'] = true;

		echo ZN()->html()->zn_render_single_option( $value );

		die();
	}
	elseif( $save_action == 'zn_process_theme_updater' ){
		ZN()->installer->update( $_POST['step'], $_POST['data'] );
		die();
	}
	elseif( $save_action == 'zn_refresh_pb' ){
		ZN()->pagebuilder->refresh_pb_data();
		die();
	}
	else {
		die('Are you cheating ?');
	}
}
