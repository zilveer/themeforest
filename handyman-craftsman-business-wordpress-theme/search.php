<?php
/**
 * The template for displaying post archives
 *
 * @package Layers
 * @since Layers 1.0.0
 */


get_header('handyman-inner');

/**
 * Include Header image & main navigation
 */


get_template_part('partials/header', 'page-title');

/**
 * Header section for inner pages except pages with blank template
 */
//get_template_part('partials/header','page-featured' );

$details = layers_get_page_title(); ?>
    <section <?php post_class('content-main container archive clearfix'); ?>>
        <div class="grid">
            <div class="column span-12">
                <header class="section-title large">
                    <?php do_action('layers_before_single_title'); ?>
                    <h1 class="heading"><?php _e('Search Result for', TL_DOMAIN); ?>
                        : <?php echo esc_html($details['excerpt']); ?></h1>
                    <?php do_action('layers_after_single_title'); ?>
                </header>

                <?php if (have_posts()) : ?>
                    <?php while (have_posts()) : the_post(); ?>
                        <?php get_template_part('partials/content', 'handy-list'); ?>
                    <?php endwhile; // while has_post(); ?>

                    <?php the_posts_pagination(); ?>
                <?php endif; // if has_post() ?>

                <div class="search-wrapper">
                    <div class="story">
                        <p><?php _e('If you didn\'t find what you were looking for, try a new search!', TL_DOMAIN); ?></p>
                        <?php get_search_form(); ?>
                    </div>
                </div>
            </div>
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