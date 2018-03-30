<?php
/**
 * Displays a tag archive
 * @package Smartbox
 * @subpackage Frontend
 * @since 0.1
 *
 * @copyright (c) 2013 Oxygenna.com
 * @license http://wiki.envato.com/support/legal-terms/licensing-terms/
 * @version 1.5.8
 */

get_header();
?>
<?php oxy_create_hero_section( null, __('Search', THEME_FRONT_TD) . ' ' . '<span class="lighter">' . get_search_query()  . '</span>'  ); ?>
<section class="section section-padded">
    <div class="container-fluid">
        <div class="row-fluid">
            <div class="span9">
                <?php if ( have_posts() ) : ?>

                    <?php while ( have_posts() ) : the_post(); ?>

                    <?php get_template_part( 'partials/content', get_post_format() ); ?>

                    <?php endwhile; ?>

                    <?php oxy_pagination($wp_query->max_num_pages); ?>
                <?php else: ?>
                        <article id="post-0" class="post no-results not-found">
                            <header class="entry-header">
                                <h1 class="entry-title"><?php _e( 'Nothing Found', THEME_FRONT_TD ); ?></h1>
                            </header>

                            <div class="entry-content">
                                <p><?php _e( 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.', THEME_FRONT_TD ); ?></p>
                                <?php get_search_form(); ?>
                            </div><!-- .entry-content -->
                        </article><!-- #post-0 -->
                <?php endif; ?>

            </div>
            <aside class="span3 sidebar">
                <?php get_sidebar(); ?>
            </aside>
        </div>
    </div>
</section>
<?php get_footer();