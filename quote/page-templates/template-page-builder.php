<?php
/**
 * Template Name: Page Builder (Blank)
 */
get_header(); ?>



    <?php while ( have_posts() ) : the_post();
      ?>

            <?php the_content(); ?>


    <?php endwhile; ?>



<?php get_footer(); ?>