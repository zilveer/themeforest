<?php
/**
 * The template for displaying product category thumbnails within loops.
 *
 * Override this template by copying it to yourtheme/woocommerce/content-product_cat.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.6.1
 */
if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

global $woocommerce_loop;

// Store loop count we're currently on
if (empty($woocommerce_loop['loop']))
    $woocommerce_loop['loop'] = 0;

// Increase loop count
$woocommerce_loop['loop'] ++;

$thumbnail_id = get_woocommerce_term_meta($category->term_id, 'thumbnail_id', true);
$cat = 'no_image';
if ($thumbnail_id) {
    $cat = 'has_image';
}
?>
<div class="product-category product col-lg-3 element <?php echo $cat; ?>">



    <a href="<?php echo get_term_link($category->slug, 'product_cat'); ?>">

        <?php
        /**
         * woocommerce_before_subcategory_title hook
         *
         * @hooked woocommerce_subcategory_thumbnail - 10
         */
        if ($thumbnail_id) {
            $image = wp_get_attachment_image_src($thumbnail_id, 'woo-size-category');
            echo '<img src="' . esc_url($image[0]) . '" alt="' . esc_attr($category->name) . '"  />';
        }
        ?>

        <div class="category-info">
            <h2><?php echo jwUtils::crop_length($category->name, jwOpt::get_option('letter_excerpt_cat_title', -1)); ?></h2>
            <?php if (jwOpt::get_option('woo_number_of_items', '1') == '1') {
                if($category->count > 1) {
                    ?><span class="count_items"><?php echo $category->count . ' ' . __('Items', 'jawtemplates'); ?></span><?php
                } else {
                    ?><span class="count_items"><?php echo $category->count . ' ' . __('Item', 'jawtemplates'); ?></span><?php
                }
                ?>
            <?php } ?>
        </div>


    </a>


</div>