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
$cg_chosen_status = '';

if ( isset( $cg_options['wc_chosen_variation'] ) ) {
    $cg_chosen_status = $cg_options['wc_chosen_variation'];
}

get_header( 'shop' );
?>

<?php if ( $cg_chosen_status == 'wc_chosen_variation_enabled' ) { ?>
<script type="text/javascript">
    jQuery(document).ready(function($) {
        $( "table.variations select" ).chosen( { width: "100%" } );
    });
</script>
<?php } ?>

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

    <div class="product-title-wrapper">
        <div class="container">
            <div class="row cg-back-to-prev-wrap">
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <span class="cg-back-to-prev"><a class="cg-back-to" href="javascript: history.go(-1)"><span>‹</span> <?php _e( 'Back to previous page', 'commercegurus' ); ?></a></span>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
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