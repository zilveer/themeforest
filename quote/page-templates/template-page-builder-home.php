<?php
/**
 * Template Name: Page Builder Home (Blank + Welcome)
 */
get_header('fullscreen'); ?>



    <?php while ( have_posts() ) : the_post();
      ?>

            <?php the_content(); ?>


    <?php endwhile; ?>



<?php get_footer(); ?>