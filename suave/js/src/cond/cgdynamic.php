<?php
$root = dirname(dirname(dirname(dirname(dirname(dirname(dirname(__FILE__)))))));
if ( file_exists( $root.'/wp-load.php' ) ) {
    require_once( $root.'/wp-load.php' );
    require_once( $root.'/wp-config.php' );
}

header('Content-type: application/x-javascript');

?>

var root = '<?php echo home_url(); ?>/';