<?php
/**
 * Product Tabs Carousel
 *
 * @author      Transvelo
 * @package     Unicase/Templates
 * @version     1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$tabsID = uniqid();
?>

<div class="products-tabs-carousel">
    <?php if( apply_filters( 'unicase_show_product_tabs_carousel_title', TRUE ) ) : ?>
    <h3 class="section-title"><?php echo apply_filters( 'unicase_product_tabs_carousel_title', $title ); ?></h3>
    <?php endif; ?>
    
    <?php
    if( $product_content == 'top_rated_products' ) {
        add_filter( 'posts_clauses',  array( WC()->query, 'order_by_rating_post_clauses' ) );
    }

    ?>
    <div class="nav-tabs-wrapper">
        <ul class="nav nav-tabs" role="tablist">
            <?php foreach( $tabs as $key => $tab ) : ?>
                <li role="presentation" <?php if( $key == 0 ){ echo 'class="active"'; } ?>><a href="#<?php echo esc_attr( 'homepage-tab-carousel-' . $tabsID . '-' . $key );?>" aria-controls="<?php echo esc_attr( 'homepage-tab-carousel-' . $tabsID . '-' . $key );?>" role="tab" data-toggle="tab"><?php echo apply_filters( 'homepage_tab_carousel_title_'. $key , $tab['title'] ); ?></a></li>
            <?php endforeach; ?>
        </ul><!-- /.nav-tabs -->
    </div><!-- /.nav-tabs-wrapper -->

    <div class="tab-content">
        <?php foreach( $tabs as $key => $tab ) : ?>
       
            <div role="tabpanel" class="tab-pane <?php if( $key == 0 ) { echo esc_attr( 'active' ); } ?>" id="<?php echo esc_attr( 'homepage-tab-carousel-' . $tabsID . '-' . $key ); ?>">

                <?php
                    $products = new WP_Query( apply_filters( 'unicase_product_tabs_carousel_query'. $key, $tab['content'] ) );

                    if ( $products->have_posts() ) :
                        $carouselID = uniqid();
                        ?>
                        <div id="unicase-tabs-carousel-<?php echo esc_attr( $carouselID ); ?>" class="owl-carousel unicase-owl-carousel owl-outer-nav has-grid products">
                            <?php
                            while ( $products->have_posts() ) : $products->the_post();
                                unicase_get_template( 'sections/products-carousel-item.php' );
                            endwhile;
                             ?>
                        </div>
                        <script type="text/javascript">

                            jQuery(document).ready(function($) {

                                function makeHomePageTabsCarousel() {
                                    $("#unicase-tabs-carousel-<?php echo esc_attr( $carouselID ); ?>").owlCarousel({
                                        items : <?php echo ( !empty( $carousel_items ) && intval( $carousel_items ) ? $carousel_items : 4 ); ?>,
                                        nav : true,
                                        slideSpeed : 300,
                                        dots: false,
                                        <?php if( is_rtl() ) : ?>
                                        rtl: true,
                                        <?php endif; ?>
                                        paginationSpeed : 400,
                                        navText: ["", ""],
                                        margin: 30,
                                        <?php if( $disable_touch_drag ) : ?>
                                        touchDrag: false,
                                        <?php endif; ?>
                                        responsive:{
                                            0:{
                                                items:1
                                            },
                                            480:{
                                                items:3
                                            },
                                            768:{
                                                items:2
                                            },
                                            992:{
                                                items:3
                                            },
                                            1200:{
                                                items:<?php echo ( !empty( $carousel_items ) && intval( $carousel_items ) ? $carousel_items : 4 ); ?>
                                            }
                                        }
                                    });
                                }
                                
                                makeHomePageTabsCarousel();
                                
                                $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
                                    var target = $(e.target).attr("href");
                                    var $owl  = $(target).find('#unicase-tabs-carousel-<?php echo esc_attr( $carouselID ); ?>');
                                    $owl.trigger('destroy.owl.carousel');
                                    $owl.html($owl.find('.owl-stage-outer').html()).removeClass('owl-loaded');
                                    makeHomePageTabsCarousel();    
                                });
                            });
                        </script>
                        <?php
                    endif;
                ?>
                
            </div><!-- /.tab-pane -->

        <?php endforeach; ?>

    </div><!-- /.tab-content -->
    <?php

    if( $product_content == 'top_rated_products' ) {
        remove_filter( 'posts_clauses', array( WC()->query, 'order_by_rating_post_clauses' ) );
    }

    wp_reset_postdata();
    ?>
</div>