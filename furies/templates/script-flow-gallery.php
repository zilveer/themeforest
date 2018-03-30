<?php header("content-type: application/x-javascript"); ?>
<?php
require_once( '../../../../wp-load.php' );
?>
<?php
if(isset($_GET['gallery_id']))
{
?>
imf.create("imageFlow", '<?php echo get_stylesheet_directory_uri(); ?>/imageFlowXML.php?gallery_id=<?php echo $_GET['gallery_id']; ?>', 0.5, 0.3, 0, 0, 8, 4);
<?php
}
else
{
?>
imf.create("imageFlow", '<?php echo get_stylesheet_directory_uri(); ?>/imageFlowXML.php', 0.5, 0.3, 0, 0, 8, 4);
<?php
}
?>