<?php
/**
 * The template for displaying all pages.
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
} // Exit if accessed directly

get_header(); ?>
<?php if ( have_posts() ) : the_post(); ?>

<?php a13_title_bar(); ?>

<article id="content" class="clearfix">

    <div id="col-mask">

        <div id="post-<?php the_ID(); ?>" <?php post_class('post-content'); ?>>
            <?php
                a13_top_image_video();
            ?>

            <div class="real-content">
                <?php the_content(); ?>

                <div class="clear"></div>

                <?php
                wp_link_pages( array(
                        'before' => '<div id="page-links">'.__( 'Pages: ', 'fame' ),
                        'after'  => '</div>')
                );
                ?>
            </div>

        </div>

        <?php get_sidebar(); ?>

    </div>

</article>

<?php endif; ?>

<?php get_footer(); ?>