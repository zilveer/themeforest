<?php 
/*
Template Name: Home
*/
get_header(); 
echo do_shortcode("[slider]");
?>
<div class="theme_page relative">
	<?php if($theme_options["home_page_top_hint"]!=""): ?>
	<div class="top_hint">
		<?php echo $theme_options["home_page_top_hint"]; ?>
	</div>
	<?php
	endif;
	echo do_shortcode("[slider_content]");
	?>
	<ul class="home_box_container clearfix">
	<?php
	if(is_active_sidebar('home-top'))
		get_sidebar('home-top');
	?>
	</ul>
	<div class="page_layout clearfix horizontal">
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