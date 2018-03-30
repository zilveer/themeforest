<?php

/**
 * Template Name: Full Width
 */

get_header();

?>


<div class="container">
    <?php learn_breadcrumbs(); ?>
</div>

<?php while (have_posts()) : the_post()?>

    <?php the_content(); ?>
    
<?php endwhile; ?>

<!-- content close -->
<?php get_footer(); ?>