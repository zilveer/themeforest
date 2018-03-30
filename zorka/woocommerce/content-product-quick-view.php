<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 3/31/15
 * Time: 3:19 PM
 */
global $product;
?>

<div id="popup-product-quick-view-wrapper" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog"  aria-hidden="true">
    <a class="popup-close" data-dismiss="modal" href="javascript:;"><i class="pe-7s-close"></i></a>
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-body">
                <div itemscope itemtype="<?php echo woocommerce_get_product_schema(); ?>" id="product-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <div class="single-product-info">
                        <div class="row">
                            <div class="col-md-6 col-lg-6 col-sm-6">
                                <div class="single-product-left-wrapper">
                                    <?php
                                    /**
                                     * g5plus_before_quick_view_product_summary hook
                                     *
                                     * @hooked woocommerce_show_product_sale_flash - 10
                                     * @hooked woocommerce_show_product_images_quick_view - 20
                                     */
                                    do_action( 'g5plus_before_quick_view_product_summary' );
                                    ?>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-6 col-sm-6">
                                <div class=" summary-product entry-summary">
                                    <?php
                                    /**
                                     * g5plus_quick_view_product_summary hook
                                     *
                                     * @hooked g5plus_template_quick_view_product_title - 5
                                     * @hooked g5plus_template_quick_view_product_rating - 10
                                     * @hooked woocommerce_template_single_price - 15
                                     * @hooked woocommerce_template_single_excerpt - 20
                                     * @hooked woocommerce_template_single_add_to_cart - 30
                                     * @hooked woocommerce_template_single_meta - 40
                                     * @hooked woocommerce_template_single_sharing - 50
                                     */
                                    do_action( 'g5plus_quick_view_product_summary' );
                                    ?>
                                </div>
                            </div><!-- .summary -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
    $suffix               = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
    $assets_path          = str_replace( array( 'http:', 'https:' ), '', WC()->plugin_url() ) . '/assets/';
    $frontend_script_path = $assets_path . 'js/frontend/';
    $add_to_cart_url = $frontend_script_path . 'add-to-cart' . $suffix . '.js';
    $add_to_cart_variation_url = $frontend_script_path . 'add-to-cart-variation' . $suffix . '.js';
    $underscore_url = HOME_URL . 'wp-includes/js/underscore.min.js';
    $wp_util_url = HOME_URL. 'wp-includes/js/wp-util.min.js';
    ?>
    <script type="text/javascript" src="<?php echo esc_url($add_to_cart_url); ?>"></script>
    <?php if ($product->product_type == 'variable') : ?>
        <?php if (defined('WOOCOMMERCE_VERSION') && version_compare(WOOCOMMERCE_VERSION,'2.5.0','>=')) : ?>
            <?php wc_get_template( 'single-product/add-to-cart/variation.php' ); ?>
            <script type="text/javascript" src="<?php echo esc_url($underscore_url); ?>"></script>
            <script type="text/javascript" src="<?php echo esc_url($wp_util_url); ?>"></script>
            <script>
                if (typeof(wc_add_to_cart_variation_params) === 'undefined') {
                    var wc_add_to_cart_variation_params = {
                        'i18n_no_matching_variations_text' : '<?php echo esc_attr__( 'Sorry, no products matched your selection. Please choose a different combination.', 'woocommerce' ); ?>',
                        'i18n_make_a_selection_text' : '<?php echo esc_attr__( 'Select product options before adding this product to your cart.', 'woocommerce' ); ?>',
                        'i18n_unavailable_text' : '<?php echo esc_attr__( 'Sorry, this product is unavailable. Please choose a different combination.', 'woocommerce' ); ?>'
                    };
                }
            </script>
        <?php endif; ?>
        <script type="text/javascript" src="<?php echo esc_url($add_to_cart_variation_url); ?>"></script>
        <script>
            (function ($) {
                "use strict";
                $('.variations_form').wc_variation_form();
                $('.variations_form .variations select').change();
            })(jQuery);
        </script>
    <?php endif; ?>
</div>
