<?php
use Handyman\Front as F;
/**
 * Standard blog index page
 *
 * @package Layers
 * @since Layers 1.0.0
 */

    /**
     * Inner pages header
     */
    get_header('handyman-inner');

    /**
     * Include Header image & main navigation
     */
    get_template_part( 'partials/header' , 'page-featured' );

?>
    <section <?php post_class( 'list-grid content-main container archive clearfix' ); ?>>
        <div class="grid">
            <?php get_sidebar( 'left' ); ?>

            <?php if( have_posts() ) : ?>
                <div <?php layers_center_column_class(); ?>>
                    <?php while( have_posts() ) : the_post(); ?>
                        <?php get_template_part( 'partials/content' , 'handy-list' ); ?>
                    <?php endwhile; // while has_post(); ?>
                    <?php F\tl_the_posts_pagination(); ?>
                </div>
            <?php endif; // if has_post() ?>

            <?php get_sidebar( 'right' ); ?>
        </div>
    </section>

<?php

    /**
     * Layers sidebar before footer
     */
    get_template_part('partials/content-section', 'prefooter');

    /**
     * Footer
     */
    get_footer();