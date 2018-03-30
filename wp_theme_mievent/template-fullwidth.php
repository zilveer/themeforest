<?php
/**
Template Name: Full width template
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

	<div class="container">
		<?php if(!empty($page_title) && $page_title=='true'){ ?>
		<section class="page-heading">
			<h1><?php echo $content_post->post_title; ?></h1>
		</section>
		<?php }?>	
		
	</div><!-- #container -->
	
</div><!-- #main-content -->

<?php echo do_shortcode($content); ?>
<?php
get_footer();