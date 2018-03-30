<?php
/**
 * Template Name: No Slider
 */

get_header('no-slider'); ?>

    <?php while ( have_posts() ) : the_post();
      ?>

            <?php the_content(); ?>


    <?php endwhile; ?>



<?php get_footer(); ?>