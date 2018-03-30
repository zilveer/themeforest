<?php
/**
 * Blog Carousel
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

<div class="posts-carousel">
    <?php if( apply_filters( 'unicase_show_posts_carousel_title', TRUE ) ) : ?>
    <h3 class="section-title"><?php echo apply_filters( 'unicase_posts_carousel_title', $title ); ?></h3>
    <?php endif; ?>
    
    <?php

    $posts = new WP_Query( apply_filters( 'unicase_blog_carousel_query', $query_args ) );
    add_filter( 'excerpt_length',               'unicase_carousel_excerpt_length' );

    if ( $posts->have_posts() ) :
        ?>
        <div id="unicase-posts-carousel-<?php echo esc_attr( $carouselID ); ?>" class="owl-carousel unicase-owl-carousel owl-outer-nav">
            <?php
            while ( $posts->have_posts() ) : $posts->the_post();
                get_template_part( 'templates/contents/content', 'blog-carousel' );
            endwhile;
            ?>
        </div>
        <script type="text/javascript">
            jQuery(document).ready(function($) {
                $("#unicase-posts-carousel-<?php echo esc_attr( $carouselID ); ?>").owlCarousel({
                    items : 3,
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
                            items:3
                        }
                    }
                });
            });
        </script>
        <?php
    endif;

    remove_filter( 'excerpt_length',               'unicase_carousel_excerpt_length' );
    wp_reset_postdata();
    ?>
</div>