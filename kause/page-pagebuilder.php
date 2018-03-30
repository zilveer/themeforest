<?php /* Template Name: Pagebuilder*/ ?>

<?php get_header(); ?>
    
    <!-- Start Outter Wrapper -->   
    <div class="outter-wrapper feature pb_hr">
        <hr>
    </div>
    <!-- End Outter Wrapper --> 
    	
    <!-- BEGIN LOOP -->
    <?php while ( have_posts() ) : the_post(); ?>

        <?php get_template_part('inc/templates/pagebuilder_output'); ?>

    	
    <?php endwhile; ?>

<?php get_footer(); ?>