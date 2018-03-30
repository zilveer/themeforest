<?php
include_once( 'load.php' );
$popup = null;
if ( isset( $_GET[ 'popup' ] ) )
	$popup = 'popup/' . $_GET['popup'] . '.php';
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head></head>
<body>
	<?php include( $popup ); ?>
</body>
</html>