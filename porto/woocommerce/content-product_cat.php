<?php
/**
 * The template for displaying product category thumbnails within loops
 *
 * @version     2.6.1
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

global $woocommerce_loop, $porto_settings, $porto_layout, $porto_products_cols_lg, $porto_products_cols_md, $porto_products_cols_xs, $porto_products_cols_ls;

$woocommerce_loop['cat_loop']++;
$class = 'product-category ' . esc_attr( apply_filters( 'product_cat_class', '', '', $category ) );

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

if ($woocommerce_loop['cat_loop'] % $porto_products_cols_lg == 1)
    $class .= ' pcols-lg-first';
if ($woocommerce_loop['cat_loop'] % $porto_products_cols_md == 1)
    $class .= ' pcols-md-first';
if ($woocommerce_loop['cat_loop'] % $porto_products_cols_xs == 1)
    $class .= ' pcols-xs-first';
if ($woocommerce_loop['cat_loop'] % $porto_products_cols_ls == 1)
    $class .= ' pcols-ls-first';

$view_type = $porto_settings['cat-view-type'];
?>
<li class="<?php echo esc_attr($class) ?>">

	<?php
    /**
     * woocommerce_before_subcategory hook.
     *
     * @hooked woocommerce_template_loop_category_link_open - 10 : removed
     */
    do_action( 'woocommerce_before_subcategory', $category );

    ?>

    <a href="<?php echo get_term_link( $category->slug, 'product_cat' ); ?>">
        <span class="thumb-info thumb-info-hide-wrapper-bg <?php echo !$view_type ? '' : ' align-center' ?>">
            <span class="thumb-info-wrapper<?php echo !$view_type ? '' : ' tf-none' ?>">
                <?php
                /**
                 * woocommerce_before_subcategory_title hook.
                 *
                 * @hooked woocommerce_subcategory_thumbnail - 10
                 */
                do_action( 'woocommerce_before_subcategory_title', $category );
                ?>
                <?php if (!$view_type) : ?>
                    <span class="thumb-info-wrap">
                        <span class="thumb-info-title">
                            <h3 class="sub-title thumb-info-inner"><?php echo esc_html($category->name); ?></h3>
                            <?php if ( $category->count > 0 ) :
                                $count_html = apply_filters( 'woocommerce_subcategory_count_html', ' <mark class="count">' . $category->count . '</mark>', $category );
                                if ($count_html) :
                                ?>
                                <span class="thumb-info-type">
                                    <?php echo $count_html . ' ' . __( 'Products', 'woocommerce' ); ?>
                                </span>
                                <?php endif;
                            endif; ?>
                        </span>
                    </span>
                <?php endif; ?>
            </span>
        </span>
    </a>

    <?php if ($view_type == 2) : ?>
        <a href="<?php echo get_term_link( $category->slug, 'product_cat' ); ?>"><h4 class="m-t-md m-b-none"><?php echo esc_html($category->name); ?></h4></a>
        <?php if ( $category->count > 0 ) :
            $count_html = apply_filters( 'woocommerce_subcategory_count_html', ' <mark class="count">' . $category->count . '</mark>', $category );
            if ($count_html) :
            ?>
            <p class="m-b-sm"><?php echo $count_html . ' ' . __( 'Products', 'woocommerce' ); ?></p>
            <?php endif;
        endif;
    endif; ?>

    <?php
    /**
     * woocommerce_shop_loop_subcategory_title hook.
     *
     * @hooked woocommerce_template_loop_category_title - 10 : removed
     */
    do_action( 'woocommerce_shop_loop_subcategory_title', $category );

    /**
     * woocommerce_after_subcategory_title hook.
     */
    do_action( 'woocommerce_after_subcategory_title', $category );

    /**
     * woocommerce_after_subcategory hook.
     *
     * @hooked woocommerce_template_loop_category_link_close - 10 : removed
     */
    do_action( 'woocommerce_after_subcategory', $category );
    ?>
</li>