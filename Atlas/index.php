<?php
/**
 * The main template file.
 *
 * @package WordPress
 */

get_header(); 

if(isset($_SESSION['pp_homepage_style']))
{
    $pp_homepage_style = $_SESSION['pp_homepage_style'];
}
else
{
    $pp_homepage_style = get_option('pp_homepage_style');
}

$pp_homepage_slideshow_cat = get_option('pp_homepage_slideshow_cat');

$homepage_items = -1;

$pp_slideshow_timer = get_option('pp_slideshow_timer'); 
if(empty($pp_slideshow_timer))
{
    $pp_slideshow_timer = 5;
}

$args = array( 
    'post_type' => 'attachment', 
    'numberposts' => $homepage_items, 
    'post_status' => null, 
    'post_parent' => $pp_homepage_slideshow_cat,
    'order' => 'ASC',
	'orderby' => 'menu_order',
); 
$all_photo_arr = get_posts( $args );

if($pp_homepage_style == 'f')
{
	include (TEMPLATEPATH . "/templates/template-homepage-f.php");
	
} // End if homepage as slideshow
else if($pp_homepage_style == 'fn')
{
	include (TEMPLATEPATH . "/templates/template-homepage-fn.php");
}// End if homepage as slideshow with no thumbnails
else if($pp_homepage_style == 'kenburns')
{
	include (TEMPLATEPATH . "/templates/template-homepage-kenburns.php");
}
else if($pp_homepage_style == 'flip')
{
	include (TEMPLATEPATH . "/templates/template-homepage-flip.php");
}
else if($pp_homepage_style == 'youtube_video')
{
	include (TEMPLATEPATH . "/templates/template-homepage-youtube_video.php");
}// End if homepage as youtube video
else
{
	include (TEMPLATEPATH . "/templates/template-homepage-static.php");
} // End if homepage as static image

get_footer(); 
?>