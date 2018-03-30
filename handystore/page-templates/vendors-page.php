<?php
/**
 * Template Name: WC Vendors Page Template
 */
?>

<?php get_header(); ?>

    <main class="site-content pt-vendors<?php if (function_exists('pt_main_content_class')) pt_main_content_class(); ?>" itemscope="itemscope" itemprop="mainContentOfPage"><!-- Main content -->

        <?php if ( have_posts() ) : ?>
            <?php while ( have_posts() ) : the_post(); ?>
              <div class="entry-content">
                  <?php the_content(); ?>
              </div>
            <?php endwhile; ?>
        <?php endif; ?>

    </main><!-- end of Main content -->
        
    <?php get_sidebar(); ?>

<?php get_footer(); ?>
