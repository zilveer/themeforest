<?php
/**
 * The Template for displaying all single posts.
 *
 * @package Listify
 */

get_header(); ?>

    <?php if ( get_option( 'page_for_posts' ) ) : ?>
    <div <?php echo apply_filters( 'listify_cover', 'page-cover', array( 'size' => 'full' ) ); ?>>
        <h1 class="page-title cover-wrapper"><?php echo get_the_title( get_option( 'page_for_posts', _x( 'Blog', 'blog page title', 'listify' ) ) ); ?></h1>
    </div>
    <?php endif; ?>

    <div id="primary" class="container">
        <div class="row content-area">

            <?php if ( 'left' == esc_attr( listify_theme_mod( 'content-sidebar-position', 'right' ) ) ) : ?>
                <?php get_sidebar(); ?>
            <?php endif; ?>

            <main id="main" class="site-main col-xs-12 <?php if ( 'none' != esc_attr( listify_theme_mod( 'content-sidebar-position', 'right' ) ) ) : ?>col-sm-7 col-md-8<?php endif; ?>" role="main">

                <?php while ( have_posts() ) : the_post(); ?>

                    <?php get_template_part( 'content' ); ?>

                    <?php comments_template(); ?>

                <?php endwhile; ?>

            </main>

            <?php if ( 'right' == esc_attr( get_theme_mod( 'content-sidebar-position', 'right' ) ) ) : ?>
                <?php get_sidebar(); ?>
            <?php endif; ?>

        </div>
    </div>

<?php get_footer(); ?>
