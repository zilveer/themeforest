<?php
/**
 * Product Carousel 1
 *
 * @author 		Transvelo
 * @package 	Unicase/Templates
 * @version     1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$carouselID = uniqid();
?>

<div class="products-carousel">
    <?php if( apply_filters( 'unicase_show_product_carousel_1_title', TRUE ) ) : ?>
    <h3 class="section-title"><?php echo apply_filters( 'unicase_product_carousel_1_title', $title ); ?></h3>
    <?php endif; ?>
    
    <?php
    if( $product_content == 'top_rated_products' ) {
        add_filter( 'posts_clauses',  array( WC()->query, 'order_by_rating_post_clauses' ) );
    }

    $products = new WP_Query( apply_filters( 'unicase_products_carousel_query', $query_args ) );

    if ( $products->have_posts() ) :
        ?>
        <div id="unicase-products-carousel-<?php echo esc_attr( $carouselID ); ?>" class="owl-carousel unicase-owl-carousel owl-outer-nav has-grid products">
            <?php
            while ( $products->have_posts() ) : $products->the_post();
                unicase_get_template( 'sections/products-carousel-item.php' );
            endwhile;
             ?>
        </div>
        <script type="text/javascript">
            jQuery(document).ready(function($) {
                $("#unicase-products-carousel-<?php echo esc_attr( $carouselID ); ?>").owlCarousel({
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
            });
        </script>
        <?php
    endif;

    if( $product_content == 'top_rated_products' ) {
        remove_filter( 'posts_clauses', array( WC()->query, 'order_by_rating_post_clauses' ) );
    }

    wp_reset_postdata();
    ?>
</div>