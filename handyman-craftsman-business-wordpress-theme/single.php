<?php
/**
 * Handyman template for displaying a single post
 */

global $post;
$post_type = get_post_type();

/**
 * Inner pages header
 */
get_header('handyman-inner');

/**
 * Include Header image & main navigation
 */
get_template_part( 'partials/header' , 'page-featured' );
?>
    <section id="post-<?php the_ID(); ?>" <?php post_class( 'content-main clearfix' ); ?>>
        <?php do_action('layers_before_post_loop'); ?>
            <div class="grid">
                    <?php
                    /**
                     * Left sidebar if any
                     */

                    get_sidebar( 'left' ); ?>

                    <?php if( have_posts() ) : ?>

                            <?php while( have_posts() ) : the_post(); ?>
                             <article <?php layers_center_column_class(); ?>>
                                <?php get_template_part('partials/content', 'handy-single'); ?>
                             </article>
                        <?php endwhile; // while has_post(); ?>
                    <?php endif; // if has_post() ?>

                    <?php
                    /**
                     * Rigth sidebar if any
                     */
                    get_sidebar( 'right' );
                    ?>
            </div>
        <?php do_action('layers_after_post_loop'); ?>
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