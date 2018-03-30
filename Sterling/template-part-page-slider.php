<?php
// Check if we are on the main posts archive or not.
if ( is_home() ) {
    $post_id            = get_option( 'page_for_posts' );
    $slider_shortcode   = get_post_meta( $post_id, 'truethemes_slider_shortcode', true );
    $slider_cu3er       = get_post_meta( $post_id, 'truethemes_slider_cu3er', true );
} else {
    global $post;
    $post_id          			 = $post->ID;
    $slider_shortcode   		 = get_post_meta( $post_id, 'truethemes_slider_shortcode', true );
    $slider_cu3er                = get_post_meta( $post_id, 'truethemes_slider_cu3er', true );
	$activate_jquery_slider      = get_post_meta( $post_id, 'truethemes_activate_jquery_slider', true );
	
}

// if custom 3rd-party slider then display it
if(!empty($slider_shortcode) || !empty($slider_cu3er)): ?>
<section class="banner-slider tt-custom-slider-wrap">
        <div class="center-wrap">
            <?php
                if ( '' != $slider_cu3er ) {
                    if ( function_exists( 'display_cu3er' ) )
                        display_cu3er( '' . $slider_cu3er . '' );
                } else {
                    echo do_shortcode( '' . strip_tags(html_entity_decode($slider_shortcode)) . '' );
                }
            ?>
        </div><!-- end .center-wrap -->
        <div class="shadow top"></div>
        <div class="shadow bottom"></div>
        <div class="tt-overlay"></div>
    </section>


<?php 
// if jquery slider then display it
elseif(!empty($activate_jquery_slider)): ?>
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
        <a href="#" class="next tt-sliderbutton"><?php _e( 'Next', 'tt_theme_framework' ); ?></a>
        <a href="#" class="prev tt-sliderbutton"><?php _e( 'Prev', 'tt_theme_framework' ); ?></a>
    <?php } ?>
</section>


<?php else : ?>
    <section class="small_banner">
        <?php get_template_part( 'template-part-small-banner', 'childtheme' ); ?>
    </section>
<?php endif; ?>