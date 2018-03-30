<?php

// Load WordPress Bootstrap
$wp_include = '../wp-load.php';
$i = 0; while ( !file_exists( $wp_include ) && $i++ < 10 ) {
  $wp_include = "../$wp_include";
}
require_once( $wp_include );

// Make sure user is logged in
if( !is_user_logged_in() ) {
	die( __( 'This is not a vaild request.', MYSITE_TEXTDOMAIN ) );
}

// Get the themes style directory
if( is_multisite() ) {
	
	global $blog_id;
	if( is_main_site( $blog_id ) )
		$styles_dir = THEME_STYLES_DIR;
	else
		$styles_dir = mysite_upload_dir() . '/styles';
					
} else {
	$styles_dir = THEME_STYLES_DIR;
}

// Make sure the file download request is only for the 'skin_zip' directory 
$skin_dir = $styles_dir . '/skin_zip';

$file = $_POST['_mysite_download_skin'];
$request_dir = pathinfo( $file );

if( strpos( $request_dir['dirname'], $skin_dir ) === false ) {
	die( __( 'This is not a vaild request.', MYSITE_TEXTDOMAIN ) );
}

// Check our wpnonce to make sure form request came from the current site and not somewhere else.
check_ajax_referer( MYSITE_SETTINGS . '_wpnonce', '_mysite_skin_wpnonce' );

// If we're here this is a valid skin download request.
if (file_exists($file)) {
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename='.basename($file));
    header('Content-Transfer-Encoding: binary');
    header('Expires: 0');
    header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
    header('Pragma: public');
    header('Content-Length: ' . filesize($file));
    ob_clean();
    flush();
    readfile($file);

    rrmdir($_POST['_mysite_delete_skin_zip']);
    exit;
}


function rrmdir($dir) {
  if (is_dir($dir)) {
    $objects = scandir($dir);
    foreach ($objects as $object) {
      if ($object != "." && $object != "..") {
        if (filetype($dir."/".$object) == "dir") rrmdir($dir."/".$object); else unlink($dir."/".$object);
      }
    }
    reset($objects);
    rmdir($dir);
  }
}

?>