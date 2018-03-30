<?php 
header("content-type: application/x-javascript");
$absolute_path = __FILE__;
$path_to_file = explode( 'wp-content', $absolute_path );
$path_to_wp = $path_to_file[0];
require_once( $path_to_wp.'/wp-load.php' );
?>

<?php
if(isset($_GET['bg_url']) && !empty($_GET['bg_url']))
{
?>
jQuery.backstretch( "<?php echo $_GET['bg_url']; ?>", {speed: 'slow'} );
<?php
}
else
{
?>
jQuery.backstretch( "<?php echo get_template_directory_uri(); ?>/example/bg.jpg", {speed: 'slow'} );
<?php
}
?>