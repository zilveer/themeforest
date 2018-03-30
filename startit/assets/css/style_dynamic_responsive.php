<?php
$root = dirname(dirname(dirname(dirname(dirname(__FILE__)))));

if ( file_exists( $root.'/wp-load.php' ) ) {
	require_once( $root.'/wp-load.php' );
} else {
	$root = dirname(dirname(dirname(dirname(dirname(dirname(__FILE__))))));
	if ( file_exists( $root.'/wp-load.php' ) ) {
		require_once( $root.'/wp-load.php' );
	}
}

header("Content-type: text/css; charset=utf-8");

?>

@media only screen and (min-width: 480px) and (max-width: 768px){
	<?php do_action('qode_startit_style_dynamic_responsive_480_768'); ?>
}

@media only screen and (max-width: 480px){
	<?php do_action('qode_startit_style_dynamic_responsive_480'); ?>
}