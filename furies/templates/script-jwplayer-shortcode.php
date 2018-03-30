<?php header("content-type: application/x-javascript"); ?>
<?php
require_once( '../../../../wp-load.php' );
?>
<?php
if(isset($_GET['id']) && !empty($_GET['id']))
{
?>
$j(document).ready(function(){
	jwplayer("<?php echo $_GET['id']; ?>").setup({
	    flashplayer: "<?php echo get_stylesheet_directory_uri(); ?>/js/player.swf",
	    file: "<?php echo $_GET['file']; ?>",
	    image: "<?php echo $_GET['image']; ?>",
	    width: <?php echo $_GET['width']; ?>,
	    height: <?php echo $_GET['height']; ?>,
	});
});
<?php
}
?>