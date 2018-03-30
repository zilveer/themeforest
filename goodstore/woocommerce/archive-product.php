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
global $wp_query;

$content_width = jwLayout::content_width();


if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

get_header('shop');

echo '<div id="content" class="' . implode(' ', $content_width) . ' ' . jwLayout::content_layout() . ' archive-content">';
?>
<div class="row">
    <?php
    $term_id = $wp_query->get_queried_object_id();
    $term = get_term($term_id, 'shop_vendor');

    if (isset($term->description)) {
        if (strlen($term->description) > 0) {
            echo '<div class="' . implode(' ', $content_width) . ' builder-section ">';
            echo '<div class="row">';
            echo '<div class="' . implode(' ', $content_width) . '">';
            ?>

            <?php echo do_shortcode($term->description); ?>

            <?php
            echo '</div>';
            echo '</div>';
            echo '</div>';
        }
    }
    ?>

    <?php if (apply_filters('woocommerce_show_page_title', true)) : ?>

    <div class="<?php echo implode(' ', $content_width); ?> builder-section"> 
        <?php
        $col = jwLayout::parseColWidth();
        ?>
        <div class="row">
            <div class="col-lg-<?php echo $col; ?>">
                <?php
                $name = woocommerce_page_title(false);
                jaw_template_set_var('bar_type', jwOpt::get_option('woo_bar_type', 'big'));
                jaw_template_set_var('box_title', $name);
                echo jaw_get_template_part('section_bar', 'simple-shortcodes');
                ?>

            </div>
        </div>

    <?php endif; ?>    

    <?php if (have_posts()) : ?>

        <?php
        /**
         * woocommerce_before_shop_loop hook
         *
         * @hooked woocommerce_result_count - 20
         * @hooked woocommerce_catalog_ordering - 30
         */
        //do_action('woocommerce_before_shop_loop');
        ?>
        
        <div class="row category-bar">
                <div class="col-lg-3">
                    <?php wc_get_template('loop/result-count.php'); ?>
                </div>
                <div class="col-lg-<?php echo $col - 6; ?> pagination-header">
                    <?php if (jwLayout::content_layout() == 'fullwidth_sidebar' && jwOpt::get_option('blog_pagination', 'number') == 'number') { ?>
                        <?php echo jwRender::pagination(jaw_template_get_var('pagination', jwOpt::get_option('blog_pagination', 'number')), null, 0); ?>
                    <?php } ?>
                </div>
                <div class="col-lg-3">
                    <div class="woo-sort-cat-form">
                        <?php woocommerce_catalog_ordering(); ?>
                    </div>
                </div>
            </div>
        
        <div class="row">
                <div class="col-lg-<?php echo $col; ?>">

                    <?php woocommerce_product_loop_start(); ?>

                    <?php woocommerce_product_subcategories(); ?>

                    <?php while (have_posts()) : the_post(); ?>

                        <?php wc_get_template_part('content', 'product'); ?>

                    <?php endwhile; // end of the loop.  ?>

                    <?php woocommerce_product_loop_end(); ?>

                </div>
            </div>
        
        <div class="clear"></div>
        <?php echo jwRender::pagination(jaw_template_get_var('pagination', jwOpt::get_option('blog_pagination', 'number'))); ?>
    

    <?php elseif (!woocommerce_product_subcategories(array('before' => woocommerce_product_loop_start(false), 'after' => woocommerce_product_loop_end(false)))) : ?>

        <?php wc_get_template('loop/no-products-found.php'); ?>

    <?php endif; ?>
        </div>
   </div> 
</div>
    <?php
    /**
     * woocommerce_sidebar hook
     *
     * @hooked woocommerce_get_sidebar - 10
     */
    do_action('woocommerce_sidebar');
    ?>

    <?php get_footer('shop'); ?>

 