<?php
/**
 * Template Name: Left Nav
 */

get_header();

get_template_part( 'template-part-page-slider', 'childtheme' ); ?>

<section id="content-container" class="clearfix">
    <div id="main-wrap" class="main-wrap-slider clearfix">
        <aside class="subnav_cont sidebar">
            <div class="subnav">
                <?php
                    global $post;
                    $custom_menu_slug = get_post_meta( $post->ID, 'truethemes_custom_sub_menu', true );

                    if ( empty( $custom_menu_slug ) ) :
                        wp_nav_menu( array( 'container' => false, 'theme_location' => 'Main Menu', 'walker' => new truethemes_sub_nav_walker() ) );
                    else :
                        echo '<ul>';
                            wp_nav_menu( array( 'container' => false, 'menu' => $custom_menu_slug, 'walker' => new truethemes_sub_nav_walker_two() ) );
                        echo '</ul>';
                    endif;
                ?>
            </div><!-- end subnav -->

            <?php // Check for selected sidebar, does not print anything if no sidebar has been selected.
                $selected_sidebar = get_post_meta( $post->ID, 'sbg_selected_sidebar_replacement', true );
                if ( ! empty( $selected_sidebar[0] ) )
                    generated_dynamic_sidebar();
            ?>
        </aside><!-- end .subnav_cont -->

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