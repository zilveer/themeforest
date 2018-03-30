<?php
function import($file) {

		require_once(ABSPATH . 'wp-admin/includes/file.php');
		WP_Filesystem();
		global $wp_filesystem;
		$file_contents = $wp_filesystem->get_contents( $file );	
		$import_data = json_decode( $file_contents, true );

		$options_to_import = $import_data['options']['of_options_pmc'];
		$options_to_import_instagram = $import_data['options']['alpine-photo-tile-for-instagram-settings'];
		$options_to_import_widget_text = $import_data['options']['widget_text'];
		$options_to_import_sidebars_widgets = $import_data['options']['sidebars_widgets'];		
		
		$option_value = maybe_unserialize( $options_to_import );
		$option_value_instagram = maybe_unserialize( $options_to_import_instagram );
		$option_value_widget_text = maybe_unserialize( $options_to_import_widget_text );	
		$option_value_widget_sidebars_widgets = maybe_unserialize( $options_to_import_sidebars_widgets );	
		
		
		delete_option( 'of_options_pmc' );
		add_option( 'of_options_pmc', $option_value, '', 'no' );

		delete_option( 'alpine-photo-tile-for-instagram-settings' );
		add_option( 'alpine-photo-tile-for-instagram-settings', $option_value_instagram, '', 'no' );	

		delete_option( 'widget_text' );
		add_option( 'widget_text', $option_value_widget_text, '', 'no' );
		
		//delete_option( 'sidebars_widgets' );
		//add_option( 'sidebars_widgets', $option_value_widget_sidebars_widgets, '', 'no' );	
}




