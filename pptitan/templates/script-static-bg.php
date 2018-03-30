<?php header("content-type: application/x-javascript"); ?> 

<?php
define('WP_DEBUG', false);
@ini_set('log_errors','On'); 
@ini_set('display_errors','Off'); 
require_once( '../../../../wp-load.php' );
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