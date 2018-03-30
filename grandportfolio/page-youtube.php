<?php
/**
 * Template Name: Fullscreen Youtube Video
 * The main template file for display viemo video fullscreen.
 *
 * @package WordPress
 */

/**
*	Get Current page object
**/
$obj_page = get_page($post->ID);
$current_page_id = '';

if(isset($obj_page->ID))
{
    $current_page_id = $obj_page->ID;
}

$page_ft_youtube = get_post_meta($obj_page->ID, 'page_ft_youtube', true);

//important to apply dynamic header & footer style
$grandportfolio_homepage_style = grandportfolio_get_homepage_style();
grandportfolio_set_homepage_style('fullscreen');

get_header();
?>

<div id="youtube_bg">
	<iframe src="//www.youtube.com/embed/<?php echo esc_attr($page_ft_youtube); ?>?autoplay=1&hd=1&rel=0&showinfo=0&wmode=opaque" frameborder="0" allowfullscreen></iframe>
</div>

<?php
	get_footer();
?>