<?php
/**
 * The main template file for display fullscreen self-hosted video
 *
 * @package WordPress
 */

wp_enqueue_script("jwplayer", get_template_directory_uri()."/js/jwplayer.js", false, THEMEVERSION, true);

//important to apply dynamic header & footer style
$grandportfolio_homepage_style = grandportfolio_get_homepage_style();
grandportfolio_set_homepage_style('fullscreen_video');

get_header();
?>

<div id="youtube_bg">
	<div id="fullscreen_self_hosted_vid"></div>
</div>

<?php
	//Print javascript code
	$portfolio_mp4_url = get_post_meta($_GET['portfolio_id'], 'portfolio_mp4_url', true);
?>
jQuery(window).load(function(){ 
	jwplayer("fullscreen_self_hosted_vid").setup({
	    flashplayer: "<?php echo get_template_directory_uri(); ?>/js/player.swf",
	    file: "<?php echo esc_js($portfolio_mp4_url); ?>",
	    width: "100%",
	    height: "100%",
	    autostart: "true"
	});
});

<?php
	get_footer();
?>