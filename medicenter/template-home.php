<?php 
/*
Template Name: Home
*/
get_header();
$slider_id = get_post_meta(get_the_ID(), "main_slider", true);

if(substr($slider_id, 0, 10)=="medicenter")
	echo do_shortcode("[slider id='" . $slider_id . "']");
else if(substr($slider_id, 0, 10)=="revolution")
	echo do_shortcode("[rev_slider " . substr($slider_id, 27) . "]");
else
	echo do_shortcode("[layerslider id='" . substr($slider_id, 27) . "']");
?>
<div class="theme_page relative noborder">
	<?php
	if(!empty($theme_options["home_page_top_hint"])): ?>
	<div class="top_hint">
		<?php echo $theme_options["home_page_top_hint"]; ?>
	</div>
	<?php
	endif;
	if(substr($slider_id, 0, 10)=="medicenter")
		echo do_shortcode("[slider_content id='" . $slider_id . "']");
	$sidebar = get_post(get_post_meta(get_the_ID(), "page_sidebar_top", true));
	?>
	<ul class="home_box_container_list clearfix<?php echo ((substr($slider_id, 0, 10)=="revolution" || substr($slider_id, 0, 10)=="aaaaalayer") && !(int)get_post_meta($sidebar->ID, "hidden", true) && is_active_sidebar($sidebar->post_name) ? ' margin_minus' : ''); ?>">
	<?php
	if(!(int)get_post_meta($sidebar->ID, "hidden", true) && is_active_sidebar($sidebar->post_name))
		dynamic_sidebar($sidebar->post_name);
	?>
	</ul>
	<div class="clearfix">
		<?php
		if(have_posts()) : while (have_posts()) : the_post();
			the_content();
		endwhile; endif;
		?>
	</div>
</div>
<?php
get_footer(); 
?>