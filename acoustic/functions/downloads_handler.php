<?php
// Let's call this early, so that no unnecessary processing is done in case it's a file download.
add_action('init', 'ci_check_get_for_downloads', 1 );
if( !function_exists('ci_check_get_for_downloads') ):
function ci_check_get_for_downloads() {

	// Check that the needed GET parameter is set and not empty.
	if( !isset($_GET['force_download']) ) return;
	$file_url = trim( urldecode( $_GET['force_download'] ) );
	if ( empty( $file_url ) ) {
		ci_force_download_throw_404();

		return;
	}

	// You can provide an array of safe local paths that downloads can fetch files from.
	// Top elements have priority over last, i.e. smaller index.
	// Add URLs like this:
	//	add_filter( 'ci_downloads_handler_safe_path', 'ci_mod_add_downloads_handler_safe_path' );
	//	function ci_mod_add_downloads_handler_safe_path( $paths ) {
	//		$paths[] = array(
	//			'dir' => '/home/user/public_html/downloads/',
	//			'url' => 'http://www.yourdomain.com/downloads/'
	//		);
	//		return $paths;
	//	}
	$uploads      = wp_upload_dir();
	$safe_paths   = array();
	$safe_paths[] = array(
		'dir' => $uploads['basedir'],
		'url' => $uploads['baseurl']
	);
	$safe_paths = apply_filters( 'ci_downloads_handler_safe_path', $safe_paths );

	$found_in_safe_path = false; // Holds the key to the first matched safe path in the $save_paths array.
	$redirect           = true; // We want to redirect by default, i.e. let the server handle permissions to unknown destinations.
	$throw_404          = false; // We only force 404 if a file matches a safe URL but isn't accessible by the filesystem.

	foreach( $safe_paths as $safe_key => $safe_path ) {
		// Let's check that it's a "local" file, i.e. inside one of the safe paths. If not, redirect to the "external" URL.
		if( strpos( $file_url, $safe_path['url'] ) !== false ) {
			$found_in_safe_path = $safe_key;
			$redirect = false;
			break;
		}
	}

	if( $found_in_safe_path !== false ) {
		$safe_path = $safe_paths[ $found_in_safe_path ];

		// Let's get the relative file path.
		$rel_file_url = mb_str_replace( $safe_path['url'], '', $file_url );

		// Resolve the path (in case it contains '..' etc)
		$abs_file_path = realpath( $safe_path['dir'] . $rel_file_url );

		// Check again it's inside the safe path, using the local dir this time.
		if ( empty( $abs_file_path ) or strpos( $abs_file_path, $safe_path['dir'] ) === false ) {
			$throw_404 = true;
			$redirect = false;
		} else {

			$file_info = pathinfo( $abs_file_path );

			// OK, we are pretty certain that this request is legitimate. Let's see if we can actually read the file.
			// Oh, and we shouldn't allow .php files, duh!
			if ( $file_info['extension'] == '.php' or !is_readable( $abs_file_path ) ) {
				die( __( 'Download Handler: Access to this file is not permitted.', 'ci_theme' ) );
			}

			// Finally. Let's send the damn file. Force the browser to download.
			header( 'Content-type: application/octet-stream' );
			header( 'Content-Disposition: attachment; filename="' . $file_info['basename'] . '"' );
			readfile( $abs_file_path ); // Completely Safe. Forces browser to download instead of opening the passed download URL.
			exit;
		}
	}

	if ( $redirect ) {
		wp_redirect( $file_url );
		exit;
	} elseif ( $throw_404 ) {
		ci_force_download_throw_404();
		return;
	} else {
		echo 'Download Handler: Unknown error.';
		exit;
	}

}
endif;

if( !function_exists('ci_force_download_throw_404') ):
function ci_force_download_throw_404() {
	add_action('parse_query','ci_force_download_throw_404_handler', 1);
}
endif;

if( !function_exists('ci_force_download_throw_404_handler') ):
function ci_force_download_throw_404_handler() {
	global $wp_query;
	$wp_query->set_404();
	status_header( 404 );
}
endif;
?>