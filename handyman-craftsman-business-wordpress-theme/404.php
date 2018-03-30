<?php
/**
 * The template for displaying the 404 page
 *
 * @package Layers
 * @since Layers 1.0.0
 */

/**
 * Header for inner pages
 */
get_header('handyman-inner');

/**
 * Header section for inner pages
 */
get_template_part('partials/header', 'page-title');
?>
    <section class="post content-main clearfix container">
        <div class="grid">
        <article class="span-12 column-flush">
            <?php get_template_part('partials/content', 'handy-empty'); ?>
        </article>
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