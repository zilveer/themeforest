
<?php
/*
Template Name: Home page with Elastic Slider
*/
?>

<?php get_header(); ?>

<div id="main_content" class="home_page"> 

<?php if (get_option('op_featured_area') == 'on') { ?>
<?php $r_home_slider_layout = get_post_meta($post->ID, "r_home_slider_layout", $single = true); ?>

<?php if($r_home_slider_layout == 'Full width') { ?>
<div class="inner">
<?php get_template_part('includes/elastic_slider'); ?>
</div>
<?php } ?>

<?php if($r_home_slider_layout == 'Boxed width') { ?>
<div class="inner">
<?php get_template_part('includes/elastic_slider_small'); ?>
<?php get_sidebar('top'); ?>
</div>
<?php } ?>
<?php } ?>

<div class="inner">

<?php get_sidebar('fw-top'); ?>

<div id="home_content" class="EqHeightDiv">		

<div class="clear"></div>

<div id="home_content_inner">
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

	<?php the_content(''); ?>

<?php endwhile; ?>
<?php endif; ?> 	
</div>
	
</div>

	
<?php get_sidebar('right'); ?>	
	

	
</div>	
</div>	
<div class="clear"></div>
	
<?php if (get_option('op_home_testimonials') == 'on') { ?>
<?php get_template_part('includes/home_testimonials'); ?>
<?php } ?>		
	
<?php get_footer(); ?>


