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

$galleries = get_posts(array('parent' => -1, 'post_type' => 'gallery', 'numberposts' => -1));
$wp_galleries = array(
	0		=> "Choose a gallery"
);
foreach ($galleries as $gallery_list ) {
       $wp_galleries[$gallery_list->ID]['title'] = $gallery_list->post_title;
       $wp_galleries[$gallery_list->ID]['desc'] = $gallery_list->post_content;
}

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
$count_photo = count($all_photo_arr);

//Check browser and version for performance tuning
$isIE8 = ereg('MSIE 8',$_SERVER['HTTP_USER_AGENT']);

if($pp_homepage_style == 'kenburns')
{
	include (get_template_directory() . "/templates/template-homepage-kenburns.php");
	
} // End if homepage as slideshow
else if($pp_homepage_style == 'f')
{
	include (get_template_directory() . "/templates/template-homepage-f.php");
	
} // End if homepage as slideshow
else if($pp_homepage_style == 'flip')
{
	include (get_template_directory() . "/templates/template-homepage-flip.php");
}
else if($pp_homepage_style == 'flow')
{
	include (get_template_directory() . "/templates/template-homepage-flow.php");
} 
else
{
	include (get_template_directory() . "/templates/template-homepage-static.php");
} // End if homepage as static image

get_footer(); 
?>