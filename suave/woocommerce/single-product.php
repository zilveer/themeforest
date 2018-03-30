<?php
/**
 * The Template for displaying all single products.
 *
 * Override this template by copying it to yourtheme/woocommerce/single-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */
if ( !defined( 'ABSPATH' ) )
    exit; // Exit if accessed directly
global $cg_options;
$cg_shop_sidebar = '';
$wc_product_banner_img = '';
$wc_product_banner_img_css = '';

get_header( 'shop' );
?>

<section>

    <?php
    /**
     * woocommerce_before_main_content hook
     *
     * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
     * @hooked woocommerce_breadcrumb - 20
     */
    do_action( 'woocommerce_before_main_content' );
    ?>

    <?php 

    if ( ( isset( $cg_options['wc_product_banner_img'] ) && $cg_options['wc_product_banner_img'] == 'yes' ) ) {
        $wc_product_banner_img = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );
        $wc_product_banner_img_css = ' style="background-image: url(' . $wc_product_banner_img['0'] . ')"';    
    }

    ?>

    <div class="product-title-wrapper"<?php echo $wc_product_banner_img_css; ?>>
    <div class="overlay"></div>
        <div class="container">
            <div class="row cg-back-to-prev-wrap">
                <div class="col-lg-9 col-md-9 col-sm-9">
                 <?php
                        if ( function_exists( 'yoast_breadcrumb' ) && (!is_front_page() ) ) {
                            yoast_breadcrumb( '
                            <p class="animate sub-title" data-animate="fadeInDown">', '</p>
                        ' );
                        }
                 ?>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="next-prev-nav">

                        <?php next_post_link_product( '%link', 'next-product', true ); ?>
                        <?php previous_post_link_product( '%link', 'prev-product', true ); ?>
                    </div>
                </div>
            </div>
        </div>
    </div><!--/product-title-wrapper -->

    <div class="row cg-product-detail">
        <div class="container">
            <div class="col-lg-12">

                <?php while ( have_posts() ) : the_post(); ?>

                    <?php
                    if ( isset( $_GET['itemsidebar'] ) ) {
                        $cg_shop_sidebar = $_GET['itemsidebar'];
                    }
                    ?>

                    <?php
                    if ( $cg_shop_sidebar == 'none' ) {
                        wc_get_template_part( 'content', 'single-product-no-sidebar' );
                    } elseif ( ( $cg_options['wc_product_sidebar'] == "wc_product_right_sidebar" ) || ( $cg_shop_sidebar == 'right') ) {
                        wc_get_template_part( 'content', 'single-product-sidebar-right' );
                    } elseif ( ( $cg_options['wc_product_sidebar'] == "wc_product_left_sidebar" ) || ( $cg_shop_sidebar == 'left' ) ) {
                        wc_get_template_part( 'content', 'single-product-sidebar-left' );
                    } else {
                        wc_get_template_part( 'content', 'single-product-no-sidebar' );
                    }
                    ?>

                <?php endwhile; // end of the loop.  ?>

                <?php
                /**
                 * woocommerce_after_main_content hook
                 *
                 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
                 */
                do_action( 'woocommerce_after_main_content' );
                ?>
            </div>
        </div>

<?php
/**
 * woocommerce_sidebar hook
 *
 * @hooked woocommerce_get_sidebar - 10
 */
//do_action('woocommerce_sidebar');
?>

    </div>
    <!-- / row -->
</section>

<?php get_footer( 'shop' ); ?>