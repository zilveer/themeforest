<?php
/**
 * The main template file for display fullscreen vimeo video
 *
 * @package WordPress
 */

$portfolio_video_id = get_post_meta($post->ID, 'portfolio_video_id', true);

//important to apply dynamic header & footer style
$grandportfolio_homepage_style = grandportfolio_get_homepage_style();
grandportfolio_set_homepage_style('fullscreen_video');

get_header();
?>

<div id="vimeo_bg">
	<iframe frameborder="0" src="http://player.vimeo.com/video/<?php echo esc_attr($portfolio_video_id); ?>?title=0&amp;byline=0&amp;portrait=0&amp;autoplay=1&amp;loop=0" webkitallowfullscreen="" allowfullscreen=""></iframe>
</div>

<?php
	get_footer();
?>