<?php /* Template Name: Placeholder */ ?>

<?php get_header(); ?>
    
    <!-- BEGIN LOOP -->
    <?php while ( have_posts() ) : the_post(); ?>

        <?php get_template_part('inc/templates/pagebuilder_output'); ?>

        
    <?php endwhile; ?>

<?php get_footer(); ?>