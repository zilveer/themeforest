<?php 
header("content-type: application/x-javascript"); 
$absolute_path = __FILE__;
$path_to_file = explode( 'wp-content', $absolute_path );
$path_to_wp = $path_to_file[0];
require_once( $path_to_wp.'/wp-load.php' );

if(isset($_GET['portfolio_id']) && !empty($_GET['portfolio_id']))
{
	$portfolio_mp4_url = get_post_meta($_GET['portfolio_id'], 'portfolio_mp4_url', true);
?>

jwplayer("fullscreen_self_hosted_vid").setup({
    flashplayer: "<?php echo get_template_directory_uri(); ?>/js/player.swf",
    file: "<?php echo $portfolio_mp4_url; ?>",
    width: "100%",
    height: "100%",
    autostart: "true"
});

<?php
}
?>