<?php
/**
 * Template Name: Homepage - Lightbox
 */

get_header();

global $ttso;
$primaryimage                   = esc_url( $ttso->st_home_lightbox_primary_image );
$secondaryimage                 = esc_url( $ttso->st_home_lightbox_secondary_image );
$home_lightbox                  = esc_attr( stripslashes( $ttso->st_home_lightbox ) );
$home_lightbox_content          = esc_html( $ttso->st_home_lightbox_content );
$home_lightbox_banner_content   = stripslashes( $ttso->st_home_lightbox_banner_content );

//get post meta for custom sliders, if set, we show them, if not we show lightbox.
global $post;
$post_id            = $post->ID;
$slider_shortcode   = get_post_meta( $post_id, 'truethemes_slider_shortcode', true );
$slider_cu3er       = get_post_meta( $post_id, 'truethemes_slider_cu3er', true );

if(!empty($slider_shortcode) || !empty($slider_cu3er)):

get_template_part( 'template-part-page-slider', 'childtheme' );

else: ?>

<section class="banner">
    <div class="center-wrap">
        <div class="home-lightbox-banner-content">
            <?php echo html_entity_decode( $home_lightbox_banner_content, ENT_QUOTES ); ?>
        </div><!-- end .home-lightbox-banner-content -->

        <div class="hero-wrap">
            <?php
                if ( 'true' == $home_lightbox ) :
                    echo '<a href="' . esc_url( $home_lightbox_content ) . '" data-gal="prettyPhoto" title="" class="lightbox-link">' . __( 'View Details', 'tt_theme_framework' ) . '</a>' . '<img src="' . esc_url( $primaryimage ) . '" height="316" width="450" class="home-primary-image" />';
                else :
                    echo '<img src="' . esc_url( $primaryimage ) . '" height="316" width="450" class="home-primary-image" />';
                endif;

                echo '<img src="' . esc_url( $secondaryimage ) . '" height="271" width="450" class="home-secondary-image" />';
            ?>
        </div><!-- end .hero-wrap -->
    </div><!-- end .center-wrap -->
    <div class="shadow top"></div>
    <div class="shadow bottom"></div>
    <div class="tt-overlay"></div>
</section>

<?php endif; ?>

<section id="content-container" class="clearfix">
    <div id="main-wrap" class="main-wrap-home-lightbox clearfix">
        <?php
        if ( have_posts() ) : while ( have_posts() ) : the_post();
            the_content();
            truethemes_link_pages();
        endwhile; endif;
        comments_template( '/page-comments.php', true );
        get_template_part( 'template-part-inline-editing', 'childtheme' );
        ?>
    </div><!-- end #main-wrap -->

<?php get_footer(); ?>