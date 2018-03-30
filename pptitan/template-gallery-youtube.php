<?php
/**
 * The main template file for display fullscreen youtube video
 *
 * Template Name: Fullscreen Youtube Video
 * @package WordPress
 */
/**
*	Get Current page object
**/
$page = get_page($post->ID);
$current_page_id = '';

if(isset($page->ID))
{
    $current_page_id = $page->ID;
}

//Check if password protected
$portfolio_password = get_post_meta($current_page_id, 'portfolio_password', true);
if(!empty($portfolio_password))
{
	session_start();
	
	if(!isset($_SESSION['gallery_page_'.$current_page_id]) OR empty($_SESSION['gallery_page_'.$current_page_id]))
	{
		get_template_part("/templates/template-password");
		exit;
	}
}

get_header();

?>

<div class="page_control">
    <a class="tubular-play" href="#">
    	<img src="<?php echo get_template_directory_uri(); ?>/images/icon_play.png" alt=""/>
    </a>
    <a class="tubular-pause" href="#">
    	<img src="<?php echo get_template_directory_uri(); ?>/images/icon_pause.png" alt=""/>
    </a>
</div>

<?php

wp_enqueue_script("jquery.tubular.1.0", get_template_directory_uri()."/js/jquery.tubular.1.0.js", false, THEMEVERSION, true);

//Get content gallery
$page_youtube_id = get_post_meta($current_page_id, 'page_youtube_id', true);
wp_enqueue_script("script-youtube-bg", get_template_directory_uri()."/templates/script-youtube-bg.php?youtube_id=".$page_youtube_id, false, THEMEVERSION, true);

//Setup Google Analyric Code
get_template_part ("google-analytic");
?>

<?php
	/* Always have wp_footer() just before the closing </body>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to reference JavaScript files.
	 */

	wp_footer();
?>
</body>
</html>