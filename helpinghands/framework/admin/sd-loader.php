<?php

// SD Redux Extension Loader

if ( !function_exists( 'sd_extension_loader' ) ) :
	function sd_extension_loader( $ReduxFramework ) {
		$path = dirname( __FILE__ ) . '/extensions/';
		$folders = scandir( $path, 1 );		   
		foreach ( $folders as $folder ) {
			if ( $folder === '.' or $folder === '..' or !is_dir( $path . $folder ) ) {
				continue;	
			} 
			$extension_class = 'ReduxFramework_Extension_' . $folder;
			if( !class_exists( $extension_class ) ) {
				// In case you wanted override your override, hah.
				$class_file = $path . $folder . '/extension_' . $folder . '.php';
				$class_file = apply_filters( 'redux/extension/' . $ReduxFramework->args['opt_name'] . '/' . $folder, $class_file );
				if( $class_file ) {
					require_once( $class_file );
					$extension = new $extension_class( $ReduxFramework );
				}
			}
		}
	}
	// Modify {$redux_opt_name} to match your opt_name
	add_action( "redux/extensions/sd_data/before", 'sd_extension_loader', 0 );
endif;