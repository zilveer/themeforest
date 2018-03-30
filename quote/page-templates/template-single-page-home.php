<?php
/**
 * Template Name: Single Page Home (Blank + Welcome)
 */
get_header('single-page'); ?>



    <?php while ( have_posts() ) : the_post();
      ?>

            <?php the_content(); ?>


    <?php endwhile; ?>



<?php get_footer(); ?>