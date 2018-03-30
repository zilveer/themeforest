<?php
/**
 * Template Name: Homepage - jQuery + Sidebar
 */

get_header();

//get post meta for custom sliders, if set, we show them, if not we show jQuery slider.
global $post;
$post_id            = $post->ID;
$slider_shortcode   = get_post_meta( $post_id, 'truethemes_slider_shortcode', true );
$slider_cu3er       = get_post_meta( $post_id, 'truethemes_slider_cu3er', true );

if(!empty($slider_shortcode) || !empty($slider_cu3er)):

get_template_part( 'template-part-page-slider', 'childtheme' );

else: ?>

<section class="banner-slider">
    <div class="center-wrap">
        <div id="slides">
            <div class="slides_container">
            	<?php get_template_part( 'template-part-home-slider', 'childtheme' ); ?>
            </div><!-- end .slides_container -->
        </div><!-- end #slides -->
    </div><!-- end .center-wrap -->
    <div class="shadow top"></div>
    <div class="shadow bottom"></div>
    <div class="tt-overlay"></div>

    <?php
    // Display navigation arrows if set to true.
    global $ttso;
    $truethemes_jslide_nav_arrows = esc_attr( stripslashes( $ttso->st_jslide_navarrows ) );
    if ( 'true' == $ttso->st_jslide_navarrows ) { ?>
        <a href="#" class="next"><?php _e( 'Next', 'tt_theme_framework' ); ?></a>
        <a href="#" class="prev"><?php _e( 'Prev', 'tt_theme_framework' ); ?></a>
    <?php } ?>
</section>

<?php endif; ?>

<section id="content-container" class="clearfix">
    <div id="main-wrap" class="main-wrap-slider clearfix">
        <div class="two_thirds">
            <?php
            wp_reset_query(); if ( have_posts() ) : while ( have_posts() ) : the_post();
                the_content();
                truethemes_link_pages();
            endwhile; endif;
            comments_template( '/page-comments.php', true );
            get_template_part( 'template-part-inline-editing', 'childtheme' );
            ?>
        </div><!-- end .two_thirds -->

        <div class="one_third">
            <div class="home-vertical-sidebar">
                <?php dynamic_sidebar( 'Homepage Sidebar' ); ?>
            </div><!-- end .home-vertical-sidebar -->
        </div><!-- end .one_third -->
    </div><!-- end .main-wrap -->

<?php get_footer(); ?>