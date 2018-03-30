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

<div id="youtube_bg">
	<iframe src="//www.youtube.com/embed/<?php echo esc_attr($portfolio_video_id); ?>?autoplay=1&hd=1&rel=0&showinfo=0&wmode=opaque" frameborder="0" allowfullscreen></iframe>
</div>

<?php
	get_footer();
?>