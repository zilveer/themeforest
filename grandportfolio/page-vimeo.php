<?php
/**
 * Template Name: Fullscreen Vimeo Video
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

$page_ft_vimeo = get_post_meta($obj_page->ID, 'page_ft_vimeo', true);

//important to apply dynamic header & footer style
$grandportfolio_homepage_style = grandportfolio_get_homepage_style();
grandportfolio_set_homepage_style('fullscreen');

get_header();
?>

<div id="vimeo_bg">
	<iframe frameborder="0" src="http://player.vimeo.com/video/<?php echo esc_attr($page_ft_vimeo); ?>?title=0&amp;byline=0&amp;portrait=0&amp;autoplay=1&amp;loop=1" webkitallowfullscreen="" allowfullscreen=""></iframe>
</div>

<?php
	get_footer();
?>