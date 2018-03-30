<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive.
 *
 * Override this template by copying it to yourtheme/woocommerce/archive-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
global $woocommerce_loop;
$g5plus_woocommerce_loop = &G5Plus_Global::get_woocommerce_loop();

$layout_style = isset($_GET['layout']) ? $_GET['layout'] : '';
if (!in_array($layout_style, array('full','container','container-fluid'))) {
    $layout_style =  G5Plus_Global::get_option('archive_product_layout');
}


$left_sidebar = G5Plus_Global::get_option('archive_product_left_sidebar');
$right_sidebar = G5Plus_Global::get_option('archive_product_right_sidebar');
$filter_sidebar = G5Plus_Global::get_option('archive_product_filter_sidebar');

$archive_display_columns = 3;
$archive_display_columns = isset($_GET['columns']) ? $_GET['columns'] : '';
if (!in_array($archive_display_columns, array('2','3','4'))) {
    $archive_display_columns = G5Plus_Global::get_option('product_display_columns','3');
}

$g5plus_woocommerce_loop['columns'] = $archive_display_columns;

$product_rating = isset($_GET['rating']) ? $_GET['rating'] : '';
if (!in_array($product_rating,array('0','1'))) {
	$product_rating = G5Plus_Global::get_option('product_show_rating',1);
}

$g5plus_woocommerce_loop['rating'] = $product_rating;

$content_col_number = 12;

$content_col = 'col-md-' . $content_col_number;

$archive_class = array('archive-product-wrap','clearfix');
$archive_class[] = 'layout-' . $layout_style;

$catalog_filter_class = array('catalog-filter clearfix s-font');

$product_show_result_count = G5Plus_Global::get_option('product_show_result_count');
$product_show_catalog_ordering = G5Plus_Global::get_option('product_show_catalog_ordering',1);


if (($product_show_result_count == 0) && ($product_show_catalog_ordering == 0) ) {
    $catalog_filter_class[] = 'catalog-filter-disable';
} else {
    if ($product_show_result_count == 0) {
        $catalog_filter_class[] = 'result-count-disable';
    }

    if ($product_show_catalog_ordering == 0) {
        $catalog_filter_class[] = 'catalog-ordering-disable';
    }
}

get_header( 'shop' ); ?>
<?php
/**
 * @hooked - g5plus_archive_product_heading - 5
 **/
do_action('g5plus_before_archive_product');
?>
<main  class="site-content-archive-product">
    <?php
    /**
     * @hooked - g5plus_shop_page_content - 5
     **/
    do_action('g5plus_before_archive_product_listing');
    ?>

    <?php if ($layout_style != 'full'): ?>
        <div class="<?php echo esc_attr($layout_style) ?> clearfix">
    <?php endif;?>

            <?php if (($content_col_number != 12) || ($layout_style != 'full')): ?>
                <div class="row clearfix">
            <?php endif;?>
                    <div class="<?php echo esc_attr($content_col) ?>">
                        <div class="<?php echo join(' ',$archive_class); ?>">
                            <?php if ( have_posts() ) : ?>

                                <div class="<?php echo join(' ',$catalog_filter_class) ?>">
                                    <?php
                                        /**
                                         * woocommerce_before_shop_loop hook
                                         *
                                         * @hooked g5plus_woocommerce_filter_button - 10
                                         */
                                        do_action( 'g5plus_woocommerce_before_shop_loop' );
                                    ?>
                                    <?php if(is_search()){ ?>
                                        <div class="archive-search-result">
                                            <h6 class="fs-24">
                                                <?php echo sprintf(esc_html__('Search Results for : "%s"','g5plus-academia'),$_GET['s']); ?>
                                            </h6>
                                        </div>
                                    <?php }else{ ?>
                                        <div class="catalog-filter-inner t-bg clearfix">
                                            <?php
                                            /**
                                             * woocommerce_before_shop_loop hook
                                             *
                                             * @hooked woocommerce_result_count - 20
                                             * @hooked woocommerce_catalog_ordering - 30
                                             */
                                            //remove_action('woocommerce_before_shop_loop','woocommerce_catalog_ordering',30);
                                            do_action( 'g5plus_woocommerce_before_shop_filter' );
                                            do_action( 'woocommerce_before_shop_loop' );
                                            ?>
                                        </div>
                                    <?php } ?>
                                </div>

                                <?php woocommerce_product_loop_start(); ?>

                                <?php while ( have_posts() ) : the_post(); ?>

                                    <?php wc_get_template_part( 'content', 'product' ); ?>

                                <?php endwhile; // end of the loop. ?>

                                <?php woocommerce_product_loop_end(); ?>

                                <?php
                                /**
                                 * woocommerce_after_shop_loop hook
                                 *
                                 * @hooked woocommerce_pagination - 10
                                 */
                                do_action( 'woocommerce_after_shop_loop' );
                                ?>
                            <?php elseif ( ! woocommerce_product_subcategories( array( 'before' => woocommerce_product_loop_start( false ), 'after' => woocommerce_product_loop_end( false ) ) ) ) : ?>

                                <?php wc_get_template( 'loop/no-products-found.php' ); ?>

                            <?php endif; ?>
                        </div>
                    </div>
            <?php if (($content_col_number != 12) || ($layout_style != 'full')): ?>
                </div>
            <?php endif;?>

    <?php if ($layout_style != 'full'): ?>
        </div>
    <?php endif;?>
    <?php
        /**
         * @hooked - g5plus_shop_page_content - 5
         **/
        do_action('g5plus_after_archive_product_listing');
    ?>
</main>

<?php
if (is_active_sidebar( $filter_sidebar ) && ($product_show_filter == 1)) {
    add_action('g5plus_after_page_wrapper','g5plus_woocommerce_filter_sidebar',10);
}
?>
<?php get_footer( 'shop' ); ?>

