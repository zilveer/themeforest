<?php
/**
 * Template Name: Sitemap
 */

get_header();

get_template_part( 'template-part-page-slider', 'childtheme' ); ?>

<section id="content-container" class="clearfix">
    <div id="main-wrap" class="main-wrap-slider clearfix">
        <?php get_template_part( 'template-part-page-banner', 'childtheme' ); ?>
        <div class="sitemap-col s-one">
            <p class="sitemap-title"><?php _e( 'Pages List', 'tt_theme_framework' ); ?></p>
            <ul>
                <?php wp_nav_menu( array( 'container' => false, 'theme_location' => 'Main Menu', 'depth' => 0 ) ); ?>
            </ul>
        </div><!-- end .sitemap-col -->

        <div class="sitemap-col s-two">
            <p class="sitemap-title"><?php _e( 'Latest Blog Posts', 'tt_theme_framework' ); ?></p>
            <?php echo do_shortcode( '[hardcode_blog_posts count="3" character_count="150" post_category=""]' ); ?>
        </div><!-- end .sitemap-col -->

        <div class="sitemap-col s-three">
            <p class="sitemap-title"><?php _e( 'Blog Archives', 'tt_theme_framework' ); ?></p>
            <ul>
                <?php wp_get_archives( 'type=monthly&show_post_count=true' ); ?>
            </ul>
        </div><!-- end .sitemap-col -->
    </div><!-- end #main-wrap -->

<?php get_footer(); ?>