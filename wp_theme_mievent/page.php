<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other 'pages' on your WordPress site will use a different template.
 *
 * @package WordPress
 * @subpackage Mtheme
 * @since Mtheme 1.0
 */
get_header();
the_post();

$content_wrapper=" content-wrapper";
$pageId=get_the_ID();
$event_slider= intval(MthemeCore::getPostMeta($pageId, 'page_event_slider'));
if(!empty($event_slider))
{
	$content_wrapper="";
	echo '<div id="home_slider">';
	echo do_shortcode('[hero_background slider_id="'.$event_slider.'"]');
	echo '</div>';
}

$page_title= MthemeCore::getPostMeta($pageId, 'page_title','true');
$content_post = get_post($pageId);
$content = $content_post->post_content;
?>

<div class="main-content<?php echo $content_wrapper?>">	
	<div class="container"><div class="row">
	<?php echo do_shortcode($content); ?></div></div>	
</div><!-- #main-content -->

<?php get_footer(); ?>