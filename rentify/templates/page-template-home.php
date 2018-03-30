<?php 
/**
 * Template Name: Home Page
 *
 */
 ?>


<?php get_template_part('templates/header','construction');?>
<?php echo do_shortcode(apply_filters('the_content',$post->post_content)); ?>
<?php get_footer();