<?php
function import($file) {

		require_once(ABSPATH . 'wp-admin/includes/file.php');
		WP_Filesystem();
		global $wp_filesystem;
		$file_contents = $wp_filesystem->get_contents( $file );	
		$import_data = json_decode( $file_contents, true );

		$options_to_import = $import_data['options']['of_options_buler_pmc'];


		$option_value = maybe_unserialize( $options_to_import );

			delete_option( 'of_options_buler_pmc' );
			add_option( 'of_options_buler_pmc', $option_value, '', 'no' );

	
}




