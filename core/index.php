<?php
/**
 * The main template file.
 *
 * @package WordPress
 */

session_start();

if(isset($_SESSION['pp_homepage_slideshow_style']))
{
	$pp_homepage_slideshow_style = $_SESSION['pp_homepage_slideshow_style'];
}
else
{
	$pp_homepage_slideshow_style = get_option('pp_homepage_slideshow_style');
}
if(empty($pp_homepage_slideshow_style))
{
	$pp_homepage_slideshow_style = 'flow';
}

if($pp_homepage_slideshow_style == 'youtube_video')
{
	$_GET['mode'] = 'f';
}


get_header();

$pp_homepage_slideshow_cat = get_option('pp_homepage_slideshow_cat');
$homepage_items = -1;

$args = array( 
    'post_type' => 'attachment', 
    'numberposts' => $homepage_items, 
    'post_status' => null, 
    'post_parent' => $pp_homepage_slideshow_cat,
    'order' => 'ASC',
    'orderby' => 'menu_order',
); 
$all_photo_arr = get_posts( $args );


include (TEMPLATEPATH . "/templates/template-slider-".$pp_homepage_slideshow_style.".php");

if($pp_homepage_slideshow_style != 'fullscreen')
{
	get_footer();
}
?>