<?php header("content-type: application/x-javascript"); ?> 

<?php
define('WP_DEBUG', false);
@ini_set('log_errors','On'); 
@ini_set('display_errors','Off'); 
require_once( '../../../../wp-load.php' );
?>

<?php
if(isset($_GET['id']) && !empty($_GET['id']))
{
?>

$j(document).ready(function(){
	jwplayer("<?php echo $_GET['id']; ?>").setup({
	    flashplayer: "<?php echo get_template_directory_uri(); ?>/js/player.swf",
	    file: "<?php echo $_GET['file']; ?>",
	    image: "<?php echo $_GET['image']; ?>",
	    width: <?php echo $_GET['width']; ?>,
	    height: <?php echo $_GET['height']; ?>,
	});
});

<?php
}
?>