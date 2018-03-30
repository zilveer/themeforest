<?php header("content-type: application/x-javascript"); 
	if(!isset($_GET['location']))
	{
?>
var calScreenHeight = jQuery(window).height();
var imgFlowSize = 0.6;
if(calScreenHeight > 1200)
{
	imgFlowSize = 0.45;
}
<?php
	}
	else
	{
?>
	imgFlowSize = 0.5;
<?php
	}
?>

<?php
define('WP_DEBUG', false);
@ini_set('log_errors','On'); 
@ini_set('display_errors','Off'); 
require_once( '../../../../wp-load.php' );
?>

<?php
if(isset($_GET['gallery_id']))
{
?>
imf.create("imageFlow", '<?php echo get_template_directory_uri(); ?>/image-flow.php?gallery_id=<?php echo $_GET['gallery_id']; ?>', imgFlowSize, imgFlowSize, 0, 7, 0, 0);
<?php
}
else
{
?>
imf.create("imageFlow", '<?php echo get_template_directory_uri(); ?>/image-flow.php', imgFlowSize, imgFlowSize, 0, 7, 0, 0);
<?php
}
?>