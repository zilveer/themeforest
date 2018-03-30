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

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

get_header('shop'); ?>

<?php
/**
 * woocommerce_before_main_content hook
 *
 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
 * @hooked woocommerce_breadcrumb - 20
 */
do_action('woocommerce_before_main_content');

if ( have_posts() ) : ?>

<div class="row">
                            <div class="col-xs-6">
                            </div>
                            <div class="col-xs-6">
                                <div class="grid-list-buttons">
                                    <ul class="list-inline">
                                        <li class="active"><a class="grid_view" href="#grid-view"><i class="fa fa-th-large"></i> <?php _e('Grid','cb-modello');?></a></li>
                                        <li class=""><a class="list_view" href="#list-view"><i class="fa fa-th-list"></i> <?php _e('List','cb-modello');?></a></li>

                                    </ul>
                                </div>
                            </div>
   </div>
<?php
/**
 * woocommerce_before_shop_loop hook
 *
 * @hooked woocommerce_result_count - 20
 * @hooked woocommerce_catalog_ordering - 30
 */
do_action( 'woocommerce_before_shop_loop' );
?>

<?php woocommerce_product_loop_start(); ?>

<?php woocommerce_product_subcategories(); ?>





    <div class="product-grid no-move-down">
<?php while ( have_posts() ) : the_post(); ?>

<?php woocommerce_get_template_part( 'content', 'product' ); ?>

<?php endwhile; // end of the loop. ?>
    </div>
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

<?php woocommerce_get_template( 'loop/no-products-found.php' ); ?>

<?php endif; ?>

<?php
/**
 * woocommerce_after_main_content hook
 *
 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
 */
do_action('woocommerce_after_main_content');
?>

<?php
/**
 * woocommerce_sidebar hook
 *
 * @hooked woocommerce_get_sidebar - 10
 */
do_action('woocommerce_sidebar');
?>

<?php get_footer('shop'); ?>