<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * Override this template by copying it to yourtheme/woocommerce/content-single-product.php
 *
 * @author      WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */
if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

/**
 * woocommerce_before_single_product hook
 *
 * @hooked woocommerce_show_messages - 10
 */
do_action('woocommerce_before_single_product');
$class = array();
$catalog_mode = 0;
if ((isset($_GET['catalog_mode']) && $_GET['catalog_mode'] == 'on') || (jwOpt::get_option('woo_catalog') == '1')) {
    $catalog_mode = 1;
    $class[] = 'catalog_mode_on';
    jaw_template_set_var('catalog_mode', 'on');
}
$woo_signedin_price=true;
if(jwOpt::get_option("woo_signedin_price",0) == 1 && !is_user_logged_in()) {
    $woo_signedin_price=false;
}
$class[] = 'jw-description-style-'. jwOpt::get_option('woo_tabs_style', 'tabs');


?>

<div itemscope itemtype="http://schema.org/Product" id="product-<?php the_ID(); ?>" <?php post_class($class); ?>>

    <?php
    /**
     * woocommerce_show_product_images hook
     *
     * @hooked woocommerce_show_product_sale_flash - 10
     * @hooked woocommerce_show_product_images - 20
     */
    if (is_plugin_active('gema75_woocommerce_badges/woocommerce_badges.php')) {
        $get_saved_display_option =get_option('gema75_wc_badge_displaysettings');
        if(isset($get_saved_display_option['displaysingleproduct'])){
                if($get_saved_display_option['displaysingleproduct']=='yes'){
                        gema75_show_product_loop_new_badge();
                }
        }
    }
    do_action('woocommerce_before_single_product_summary');
    ?>

    <div class="summary entry-summary">

        <?php
        if (function_exists('wc_get_template')) {

            global $post, $product;

            wc_get_template('single-product/title.php');
            
            if($woo_signedin_price) {
                echo '<div class="price-container">';
                wc_get_template('single-product/price.php');
                echo '</div>';
            }

            $class_dr = '';
            $rating = jwRender::metaRating();
            if (strlen(trim($rating))) {
                $class_dr = 'rating-show';
                echo '<div class="rating" itemprop="aggregateRating" itemscope="" itemtype="http://schema.org/AggregateRating">';
                echo $rating;
                echo '<meta itemprop="ratingValue" content="'. $product->get_average_rating() .'" />';
                echo '<meta itemprop="bestRating" content="5" />';
                echo '<meta itemprop="ratingCount" content="'. $product->get_rating_count() .'" />';
                echo '<meta itemprop="reviewCount" content="'. $product->get_review_count() .'" />';
                echo '<div class="clear"></div>';
                echo '</div>';
            }

            echo '<div class="clear"></div>';

            if ($catalog_mode == 0) {
                echo '<div class="description-container">';
                wc_get_template('single-product/short-description.php');
                echo '</div>';
            } else if ($catalog_mode == 1) {
                echo '<div class="description-container ' . $class_dr . '">';
                echo do_shortcode(get_post_meta(get_the_ID(), '_prod_product_custom_desc', true));
                echo '</div>';
            }

            $product_link_product = get_post_meta(get_the_ID(), '_prod_product_link', true);
            if (strlen($product_link_product) == 0) {
                $product_link_product = '2';
            }

            $product_link = jwOpt::get_option('woo_product_product_link', 'on');

            $link_to_product = get_permalink();
            $custom_link = get_post_meta(get_the_ID(), '_prod_product_custom_link', true);

            if (strlen($custom_link) > 0) {
                $link_to_product = trim($custom_link);
            }

            if (($catalog_mode == 1 && $product_link_product == '1') || ($catalog_mode == 1 && $product_link == '1' && $product_link_product == '2')) {
                echo '<div class="no-catalog-product-page">';
                echo '<a class="button" href="' . $link_to_product . '" target="' . jwOpt::get_option('woo_product_product_target', '_self') . '" >' . __('View product', 'jawtemplates') . '</a>';
                echo '</div>';
            }
            
            if($woo_signedin_price) {
                switch ($product->product_type) {
                    case 'variable':
                        remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30);
                        // Enqueue variation scripts
                        wp_enqueue_script('wc-add-to-cart-variation');
    
                        // Load the template
                        wc_get_template('single-product/add-to-cart/variable.php', array(
                            'available_variations' => $product->get_available_variations(),
                            'attributes' => $product->get_variation_attributes(),
                            'selected_attributes' => $product->get_variation_default_attributes()
                        ));
                        break;
                    case 'grouped':
                        remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30);
                        wc_get_template('single-product/add-to-cart/grouped.php', array(
                            'grouped_product' => $product,
                            'grouped_products' => $product->get_children(),
                            'quantites_required' => false
                        ));
                        break;
                    case 'simple':
                        if(class_exists('YITH_YWRAQ_Frontend') && get_option('ywraq_hide_add_to_cart') == 'yes'){
                            break;
                        }
                        remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30);
                        wc_get_template('single-product/add-to-cart/simple.php');
                        break;
                    case 'external':
                        remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30);
                        if (!$product->get_product_url()) {
                            break;
                        }
                        wc_get_template('single-product/add-to-cart/external.php', array(
                            'product_url' => $product->get_product_url(),
                            'button_text' => $product->get_button_text()
                        ));
                        break;
                    case 'bundle':
                        /*
                         * bundle add to cart se zobrazoval 2x - proto byl tento do_action zakomentovan
                         * - je hooknutej na woocommerce_template_single_add_to_cart
                         */
                        //do_action('woocommerce_bundle_add_to_cart');
                        break;
                    case 'composite':  	                
                        add_action('woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30); 	                
                        break;
                }
            remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_title', 5);
            remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10);
            remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 10);
            remove_action('woocommerce_variable_add_to_cart', 'woocommerce_variable_add_to_cart', 30);
            remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20);
            remove_action('woocommerce_swoocommerce_single_product_summaryingle_product_summary', 'woocommerce_template_single_meta', 40);
            remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50);
            remove_action('woocommerce_single_product_summary', 'gema75_show_product_loop_new_badge', 30);

            do_action('woocommerce_single_product_summary');
            }
            if (is_plugin_active('yith-woocommerce-wishlist/init.php')) {
                echo '<div class="addtowishlist">';
                echo '<span class="icon-plus-circle2"></span>' . do_shortcode('[yith_wcwl_add_to_wishlist]');
                echo '</div>';
            }

            if (is_plugin_active('yith-woocommerce-compare/init.php')) {
                echo '<div class="comparebutton">';
                echo '<span class="icon-plus-circle2"></span>' . do_shortcode('[yith_compare_button]');
                echo '</div>';
            }

            echo '<div class="clear"></div>';

            wc_get_template('single-product/meta.php');

            if (jwOpt::get_option('woo_social_share', '1') == '1') {
                wc_get_template('single-product/share.php');
                get_template_part('woocommerce/single-product/socialshare');
            }
        }
        ?>

    </div><!-- .summary -->
    <div class="clear"></div>

<?php
/**
 * woocommerce_after_single_product_summary hook
 *
 * @hooked woocommerce_output_product_data_tabs - 10
 * @hooked woocommerce_output_related_products - 20
 */
do_action('woocommerce_after_single_product_summary');
?>
<meta itemprop="url" content="<?php echo get_permalink(); ?>" />
</div><!-- #product-<?php the_ID(); ?> -->

<?php
do_action('woocommerce_after_single_product');
