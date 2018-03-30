<?php header("content-type: application/x-javascript"); ?> 

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
imf.create("imageFlow", '<?php echo get_template_directory_uri(); ?>/imageFlowXML.php?gallery_id=<?php echo $_GET['gallery_id']; ?>', 0.6, 0.2, 0, 0, 8, 4);
<?php
}
else
{
?>
imf.create("imageFlow", '<?php echo get_template_directory_uri(); ?>/imageFlowXML.php', 0.6, 0.2, 0, 0, 8, 4);
<?php
}
?>