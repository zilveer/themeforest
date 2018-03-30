<?php
/**
 * The main template file.
 *
 * Template Name: Gallery Kenburns
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

//Get content gallery
$gallery_id = get_post_meta($current_page_id, 'page_gallery_id', true);

wp_enqueue_script("kenburns", get_template_directory_uri()."/js/kenburns.js", false, THEMEVERSION, true);
wp_enqueue_script("script-kenburns-gallery", get_template_directory_uri()."/templates/script-kenburns-gallery.php?gallery_id=".$gallery_id, false, THEMEVERSION, true);

?>

<div id="kenburns_overlay"></div>
<canvas id="kenburns">
    <p>Your browser doesn't support canvas!</p>
</canvas>

<?php
$pp_homepage_music_mp3 = get_option('pp_homepage_music_mp3');

if(!empty($pp_homepage_music_mp3))
{
?>
<div class="page_audio">
	<?php echo do_shortcode('[audio width="30" height="30" src="'.$pp_homepage_music_mp3.'"]'); ?>
</div>
<?php
}
?>

<?php
//Setup Google Analytic Code
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