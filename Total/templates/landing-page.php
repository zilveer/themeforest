<?php
/**
 * Template Name: Landing Page
 *
 * @package Total WordPress Theme
 * @subpackage Templates
 */

// Get site header
get_header(); ?>

    <div id="content-wrap" class="container clr">

        <?php wpex_hook_primary_before(); ?>

        <div id="primary" class="content-area clr">

            <?php wpex_hook_content_before(); ?>

            <div id="content" class="clr site-content" role="main">

                <?php wpex_hook_content_top(); ?>

                <?php while ( have_posts() ) : the_post(); ?>

                    <article class="entry-content entry clr">

                        <?php the_content(); ?>

                    </article><!-- #post -->

                 <?php endwhile; ?>

                <?php get_template_part( 'partials/post-edit' ); ?>

                <?php wpex_hook_content_bottom(); ?>

            </div><!-- #content -->

            <?php wpex_hook_content_after(); ?>

        </div><!-- #primary -->

        <?php wpex_hook_primary_after(); ?>

    </div><!-- #content-wrap -->

<?php
// Get site footer
get_footer(); ?>