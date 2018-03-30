<?php

$secret_file     = '../cache/less-spawn-secret';
$expected_secret = file_get_contents( $secret_file );

if ( ! empty( $expected_secret ) && $expected_secret === $_POST['secret'] ) {
	@unlink( $secret_file );

	define('BASEPATH', realpath(dirname(__FILE__).'/../') . '/');
	$path  = realpath(dirname(__FILE__).'/../vamtam/classes/').'/';

	// increase memory limit using the standard WP functions
	if ( isset( $_POST['abspath'] ) && file_exists( $_POST['abspath'] . '/wp-includes/default-constants.php' ) ) {
		define( 'ABSPATH', $_POST['abspath'] );

		include $_POST['abspath'] . '/wp-includes/load.php';
		include $_POST['abspath'] . '/wp-includes/default-constants.php';
		wp_initial_constants();
	}

	require $path."lessc.php";

	$l = new WpvLessc();
	$l->importDir = '.';

	include '../vamtam/helpers/lessphp-extensions.php';

	try {
		$l->compileFile( $_POST['input'], $_POST['output'] );
		echo json_encode( array( 'status' => 'ok', 'memory' => memory_get_peak_usage()/1024/1024 ) ); // xss ok
	} catch ( Exception $e ) {
		echo json_encode( array( 'status' => 'error', 'message' => $e->getMessage(), 'memory' => memory_get_peak_usage()/1024/1024 ) ); // xss ok
	}
}