<?php
use \Handyman\Front as F;

/**
 * Template Name: Handyman Blog
 *
 * The template for displaying post archives
 */

/**
 * Inner pages header
 */
get_header('handyman-inner');

/**
 * Include Header image & main navigation
 */
get_template_part( 'partials/header' , 'page-featured' );

do_action( 'layers_before_blog_template' );
?>
    <section <?php post_class( 'content-main container archive clearfix' ); ?>>
        <div class="grid">
        <?php
        /**
         * Get left sidebar if any
         */
        get_sidebar( 'left' );


        /**
         * Are we in the middle of pagination
         */
       $paged = F\tl_get_paged();

        $wp_query_tmp = $wp_query;

        $args     = [ "post_type" => "post",  "paged" => $paged, 'publish' => true];
        $wp_query = new WP_Query($args);

        if( $wp_query->have_posts() ) : ?>
            <div <?php layers_center_column_class(); ?>>
                <?php while ( $wp_query->have_posts() ) : $wp_query->the_post();
                    global $post;
            ?>
                    <?php get_template_part( 'partials/content' , 'handy-list' ); ?>
                <?php endwhile; // while has_post(); ?>

                <?php the_posts_pagination(); ?>
            </div>
        <?php endif; // if has_post()

        wp_reset_postdata();

        $wp_query = $wp_query_tmp;

        /**
         * Get right sidebar if any
         */
        get_sidebar( 'right' ); ?>
        </div>
    </section>
<?php

do_action( 'layers_after_blog_template' );



/**
 * Layers sidebar before footer
 */
get_template_part('partials/content-section', 'prefooter');

/**
 * Footer
 */
get_footer();