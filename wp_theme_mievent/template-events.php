<?php
/*
Template Name: Events template
*/

the_post();

$post_pre='event_';
$homeSectionC=0;
$menu=$heading='';
$out=$category='';
$img_gal_active=$video_active='hide';

$event_slider= intval(MthemeCore::getPostMeta(get_the_ID(), 'page_event_slider'));
$category=intval(MthemeCore::getPostMeta(get_the_ID(), 'page_event_category'));

if(!empty($event_slider)){
	$menu.='<li class="hidden"><a href="#home_slider">Home</a></li>';
}
?>
<?php get_header('banner-logo'); ?>
<?php 

if(!empty($event_slider) )
{
	echo '<div id="home_slider">';
	echo do_shortcode('[hero_background height="650px" logo_position="banner" slider_id="'.$event_slider.'"]');
	echo '</div>';
}?>
<div id="events" class="section-padding">
	<div class="col-lg-12 align-center nopadding">
		<?php echo do_shortcode('[events category="'.$category.'" columns="4"]'); ?>		
	</div>
</div>
<?php get_footer(); ?>