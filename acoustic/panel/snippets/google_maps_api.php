<?php global $ci, $ci_defaults, $load_defaults; ?>
<?php if ($load_defaults===TRUE): ?>
<?php

	$ci_defaults['google_maps_api_enable'] = '';
	$ci_defaults['google_maps_api_key']    = '';

	add_action( 'init', 'ci_register_google_maps_api' );
	function ci_register_google_maps_api() {
		$args = array(
			'v' => '3',
		);

		$key = trim( ci_setting( 'google_maps_api_key' ) );

		if ( $key ) {
			$args['key'] = $key;
		}

		$google_url = add_query_arg( $args, '//maps.googleapis.com/maps/api/js' );

		wp_register_script( 'google-maps', esc_url_raw( $google_url ), array(), null, false );
	}

?>
<?php else: ?>

	<fieldset id="ci-panel-google-maps-api" class="set">
		<p class="guide"><?php _e( 'The Google Maps API must be loaded only once in each page. Since many plugins may try to load it as well, you might want to disable it from the theme to avoid potential errors.', 'ci_theme' ); ?></p>
		<?php ci_panel_checkbox( 'google_maps_api_enable', 'on', __( 'Load Google Maps API.', 'ci_theme' ) ); ?>

		<p class="guide"><?php echo sprintf( __( 'Paste here your Google Maps API Key. Maps will <strong>not</strong> be displayed without an API key. You need to issue a key from <a href="%1$s" target="_blank">Google Accounts</a>, and make sure the <strong>Google Maps JavaScript API</strong> is enabled. For instructions on issuing an API key, <a href="%2$s" target="_blank">read this article</a>.', 'ci_theme' ),
				'https://code.google.com/apis/console/',
				'http://www.cssigniter.com/docs/article/generate-a-google-maps-api-key/'
		); ?></p>
		<?php ci_panel_input( 'google_maps_api_key', __( 'Google Maps API Key', 'ci_theme' ) ); ?>
	</fieldset>

<?php endif; ?>