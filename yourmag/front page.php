
<?php
/*
Template Name: Home page
*/
?>

<?php get_header(); ?>

<div id="main_content" class="home_page"> 

<?php if (get_option('op_featured_area') == 'on') { ?>
<?php $r_home_slider_layout = get_post_meta($post->ID, "r_home_slider_layout", $single = true); ?>

<?php if($r_home_slider_layout == 'Full width') { ?>
<?php get_template_part('includes/home_royal_slider'); ?>
<?php } ?>

<?php if($r_home_slider_layout == 'Boxed width') { ?>
<div id="featured_area">
<?php wp_enqueue_script('stellar', BASE_URL . 'js/jquery.stellar.js', false, '', true); ?>

<?php $parallax_image = (get_option('op_parallax_image') <> '') ? get_option('op_parallax_image') : get_template_directory_uri() . '/images/new-york-city.jpg'; ?>

<div class="photo" style="background-image: url(<?php echo $parallax_image ?>);" data-stellar-background-ratio="0.5">
<div class="featured_area_bg">

<div class="inner">
<?php get_template_part('includes/home_royal_slider'); ?>
</div>

</div>
</div>	
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