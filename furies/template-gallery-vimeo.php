<?php
/**
 * The main template file for display fullscreen vimeo video
 *
 * Template Name: Fullscreen Vimeo Video
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

//Get content gallery
$page_vimeo_id = get_post_meta($current_page_id, 'page_vimeo_id', true);

get_header();
?>

<div id="vimeo_bg">
	<iframe frameborder="0" src="http://player.vimeo.com/video/<?php echo $page_vimeo_id; ?>?title=0&amp;byline=0&amp;portrait=0&amp;autoplay=1&amp;loop=0" webkitallowfullscreen="" allowfullscreen=""></iframe>
</div>

<?php
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