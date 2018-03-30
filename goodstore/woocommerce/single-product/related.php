<?php
/**
 * Related Products
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */
global $product, $woocommerce_loop;

$related = "";
if (function_exists('is_product') && is_product()) {
    $related = $product->get_related(jwOpt::get_option('woo_number_related_produts', 5));
} else if (jwUtils::woocommerce_activate() == true) {
    $related = (get_post_meta(get_the_ID(), 'post_connect_woo', true));
    if (!is_array($related)) {
        $related = explode(',', $related);
    }
    $orderby = 'ACK';
    $posts_per_page = '-1';
}

if ($related == "" || empty($related) || (isset($related[0]) && $related[0] == ''))
    return;

$args = apply_filters('woocommerce_related_products_args', array(
    'post_type' => 'product',
    'ignore_sticky_posts' => 1,
    'no_found_rows' => 1,
        ));

$args['count'] = jwOpt::get_option('woo_number_related_produts', 6);

$args['post__in'] = $related;

$args['orderby'] = $orderby;

$args['carousel_style'] = 'bar';

$woocommerce_loop['columns'] = jwOpt::get_option('woo_related_type');
?>

<div class="releated-product woocommerce">
    <div class="row section-header box">
        <div class="section-big-wrapper">
            <h3 class="section-big"><?php _e('Related Products', 'jawtemplates'); ?></h3>
        </div>
    </div>
    <?php
    global $jaw_shortcodes;

    $catalog_mode = 'off';
    if (isset($_GET['catalog_mode']) && $_GET['catalog_mode'] == 'on') {
        $catalog_mode = 'on';
    }

    $cv = jwLayout::content_width();
    if (isset($jaw_shortcodes['jaw_woo_carousel'])) {
        if ($cv['desktop'] == 'col-lg-12') {
            $args['post_in_slide'] = 4;
            $args['extra_class'] = 'related-small';
            $args['catalog_mode'] = $catalog_mode;
        } else {
            $args['post_in_slide'] = 3;
            $args['catalog_mode'] = $catalog_mode;
        }
        $args['box_style'] = jwOpt::get_option('woo_related_type');
        echo $jaw_shortcodes['jaw_woo_carousel']->jaw_woo_carousel_shortcode($args);
    }
    ?>

</div>
<?php
wp_reset_postdata();
