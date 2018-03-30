<?php
/**
 * The template for displaying product content within loops
 *
 * @version 2.6.1
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

global $woocommerce_loop, $product, $porto_settings;

$porto_woo_version = porto_get_woo_version_number();

// Ensure visibility
if ( ! $product || ! $product->is_visible() ) {
	return;
}

$woocommerce_loop['product_loop']++;

// Extra post classes
$classes = array();

if (!$porto_settings['category-hover'])
    $classes[] = 'hover';

if (isset($woocommerce_loop['addlinks_pos']) && $woocommerce_loop['addlinks_pos'] == 'onimage')
    $classes[] = 'show-links-onimage';

if (isset($woocommerce_loop['addlinks_pos']) && $woocommerce_loop['addlinks_pos'] == 'wq_onimage')
    $classes[] = 'show-wq-onimage';

if ($woocommerce_loop['product_loop'] == 1)
    $classes[] = 'product-first';

global $porto_layout, $porto_products_cols_lg, $porto_products_cols_md, $porto_products_cols_xs, $porto_products_cols_ls;

if (!$porto_products_cols_lg) {
    $cols = $porto_settings['product-cols'];
    if ($porto_layout == 'wide-left-sidebar' || $porto_layout == 'wide-right-sidebar' || $porto_layout == 'left-sidebar' || $porto_layout == 'right-sidebar') {
        if ($cols == 8 || $cols == 7)
            $cols = 6;
    }
    switch ($cols) {
        case 1: $cols_md = 1; $cols_xs = 1; $cols_ls = 1; break;
        case 2: $cols_md = 2; $cols_xs = 2; $cols_ls = 1; break;
        case 3: $cols_md = 3; $cols_xs = 2; $cols_ls = 1; break;
        case 4: $cols_md = 4; $cols_xs = 2; $cols_ls = 1; break;
        case 5: $cols_md = 4; $cols_xs = 2; $cols_ls = 1; break;
        case 6: $cols_md = 5; $cols_xs = 3; $cols_ls = 2; break;
        case 7: $cols_md = 6; $cols_xs = 3; $cols_ls = 2; break;
        case 8: $cols_md = 6; $cols_xs = 3; $cols_ls = 2; break;
        default: $cols = 4; $cols_md = 4; $cols_xs = 2; $cols_ls = 1;
    }
}

if ($woocommerce_loop['product_loop'] % $porto_products_cols_lg == 1)
    $classes[] = 'pcols-lg-first';
if ($woocommerce_loop['product_loop'] % $porto_products_cols_md == 1)
    $classes[] = 'pcols-md-first';
if ($woocommerce_loop['product_loop'] % $porto_products_cols_xs == 1)
    $classes[] = 'pcols-xs-first';
if ($woocommerce_loop['product_loop'] % $porto_products_cols_ls == 1)
    $classes[] = 'pcols-ls-first';

$more_link = apply_filters( 'the_permalink', get_permalink() );
$more_target = '';
if (isset($porto_settings['catalog-enable']) && $porto_settings['catalog-enable']) {
    if ($porto_settings['catalog-admin'] || (!$porto_settings['catalog-admin'] && !(current_user_can( 'administrator' ) && is_user_logged_in())) ) {
        if (!$porto_settings['catalog-cart']) {
            if ($porto_settings['catalog-readmore'] && $porto_settings['catalog-readmore-archive'] === 'all') {
                $link = get_post_meta(get_the_id(), 'product_more_link', true);
                if ($link)
                    $more_link = $link;
                $more_target = $porto_settings['catalog-readmore-target'] ? 'target="'.$porto_settings['catalog-readmore-target'].'"' : '';
            }
        }
    }
}
?>
<li <?php post_class( $classes ); ?>>

	<?php
    /**
     * woocommerce_before_shop_loop_item hook.
     *
     * @hooked woocommerce_template_loop_product_link_open - 10 : removed
     */
    do_action( 'woocommerce_before_shop_loop_item' ); ?>

    <div class="product-image">
        <a <?php echo $more_target ?> href="<?php echo $more_link ?>">
            <?php
                /**
                 * woocommerce_before_shop_loop_item_title hook.
                 *
                 * @hooked woocommerce_show_product_loop_sale_flash - 10
                 * @hooked woocommerce_template_loop_product_thumbnail - 10 : removed
                 */
                do_action( 'woocommerce_before_shop_loop_item_title' );
            ?>
        </a>

        <div class="links-on-image">
            <?php woocommerce_template_loop_add_to_cart() ?>
        </div>
    </div>

    <?php if ( version_compare($porto_woo_version, '2.4', '<') ) : ?>
        <a class="product-loop-title" <?php echo $more_target ?> href="<?php echo $more_link ?>">
            <h3><?php the_title(); ?></h3>
        </a>
    <?php else : ?>
        <?php
        /**
         * woocommerce_shop_loop_item_title hook.
         *
         * @hooked woocommerce_template_loop_product_title - 10
         */
        do_action( 'woocommerce_shop_loop_item_title' );
        ?>
    <?php endif; ?>

    <?php
        /**
         * woocommerce_after_shop_loop_item_title hook.
         *
         * @hooked woocommerce_template_loop_rating - 5
         * @hooked woocommerce_template_loop_price - 10
         */
        do_action( 'woocommerce_after_shop_loop_item_title' );
    ?>

    <?php
        /**
        * woocommerce_after_shop_loop_item hook.
        *
        * @hooked woocommerce_template_loop_product_link_close - 5 : removed
        * @hooked woocommerce_template_loop_add_to_cart - 10
        */
        do_action( 'woocommerce_after_shop_loop_item' );
    ?>

</li>