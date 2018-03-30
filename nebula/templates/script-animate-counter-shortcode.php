<?php 
header("content-type: application/x-javascript"); 
$absolute_path = __FILE__;
$path_to_file = explode( 'wp-content', $absolute_path );
$path_to_wp = $path_to_file[0];
require_once( $path_to_wp.'/wp-load.php' );

?>
window.odometerOptions = {
  format: '(ddd).dd'
};

setTimeout(function(){
    jQuery('#<?php echo $_GET['id']; ?>').html(<?php echo $_GET['end']; ?>);
}, 1000);