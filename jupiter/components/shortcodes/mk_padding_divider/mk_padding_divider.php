<?php

$phpinfo =  pathinfo( __FILE__ );
$path = $phpinfo['dirname'];
include( $path . '/config.php' );

$id = Mk_Static_Files::shortcode_id();
?>

<div id="padding-<?php echo $id; ?>" class="mk-padding-divider <?php echo $visibility; ?>  clearfix"></div>

<?php
/**
 * Custom CSS Output
 * ==================================================================================
 */

$app_styles= '
	#padding-'.$id.' {
		height: '.$size.'px;
	}
';
Mk_Static_Files::addCSS($app_styles, $id);
