<?php
/**
 * Template Name: Left Sidebar
 */

get_header();

get_template_part( 'template-part-page-slider', 'childtheme' ); ?>

<section id="content-container" class="clearfix">
    <div id="main-wrap" class="main-wrap-slider clearfix">
        <aside class="sidebar left-sidebar">
            <?php generated_dynamic_sidebar(); ?>
        </aside><!-- end sidebar-->
        <div class="page_content_right sub-content">
            <?php
                get_template_part( 'template-part-page-banner', 'childtheme' );
                if ( have_posts() ) : while ( have_posts() ) : the_post();
                    the_content();
                    truethemes_link_pages();
                endwhile; endif;
                comments_template( '/page-comments.php', true );
                get_template_part( 'template-part-inline-editing', 'childtheme' );
            ?>
        </div><!-- end .page_content_right -->
    </div><!-- end #main-wrap -->
<?php get_footer(); ?>