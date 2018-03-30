<?php
/**
 * Template Name: Left &amp; Right Sidebar
 *
 * The template for displaying a full width page
 *
 * @package Layers
 * @since Layers 1.0.0
 */

/**
 * Header for inner pages
 */
get_header('handyman-inner');

/**
 * Include Header image & main navigation
 */
//get_template_part( 'partials/header' , 'page-title' );
/**
 * Header section for inner pages except pages with blank template
 */
get_template_part('partials/header','page-featured' );
?>
<section id="post-<?php the_ID(); ?>" <?php post_class( 'content-main container clearfix' ); ?>>
    <div class="grid">
        <?php get_sidebar( 'left' ); ?>
        <?php if( have_posts() ) : ?>
            <?php while( have_posts() ) : the_post(); ?>
                <article <?php layers_center_column_class(); ?>>
                    <?php get_template_part( 'partials/content', 'handy-single' ); ?>
                </article>
            <?php endwhile; // while has_post(); ?>
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