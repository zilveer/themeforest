<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive.
 *
 * Override this template by copying it to yourtheme/woocommerce/archive-product.php
 *
 * @author         WooThemes
 * @package     WooCommerce/Templates
 * @version     2.0.0
 */

if (!defined('ABSPATH')) exit; // Exit if accessed directly
?>

<?php get_template_part('templates/header/top', 'woocommerce'); ?>

<section id="layout">
    <div class="row module dfd-woo-archive">
        <div class="nine columns">
			
			<h2 class="widget-title  text-left woo-page-title">
				<span><?php _e('The best offers', 'dfd'); ?></span>
			</h2>
			
			<div class="clear"></div>
			
            <?php
            global $post;
            $shop_page_id = woocommerce_get_page_id( 'shop' );
            $shop_page    = get_post( $shop_page_id );


            if ( is_post_type_archive() && !empty($shop_page) && is_object($shop_page) ){
                echo '<div class="shop__main_desc">';
					$content = apply_filters('the_content', $shop_page->post_content);
					echo $content;
                echo '</div>';
            }

            ?>
			
			<div class="clear"></div>
			
            <?php if (have_posts()) : ?>

            <?php
            /**
             * woocommerce_before_shop_loop hook
             *
             * @hooked woocommerce_result_count - 20
             * @hooked woocommerce_catalog_ordering - 30
             */

            remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );

            do_action('woocommerce_before_shop_loop');

            ?>

            <?php woocommerce_product_loop_start(); ?>

            <?php woocommerce_product_subcategories(); ?>

			<?php
				global $woocommerce_loop;
				$woocommerce_loop['columns'] = 3;
			?>
            <?php while (have_posts()) : the_post(); ?>

                <?php woocommerce_get_template_part('content', 'product'); ?>

                <?php endwhile; // end of the loop. ?>

            <?php woocommerce_product_loop_end(); ?>

            <?php
            /**
             * woocommerce_after_shop_loop hook
             *
             * @hooked woocommerce_pagination - 10
             */
            do_action('woocommerce_after_shop_loop');
            ?>

            <?php elseif (!woocommerce_product_subcategories(array('before' => woocommerce_product_loop_start(false), 'after' => woocommerce_product_loop_end(false)))) : ?>

            <?php woocommerce_get_template('loop/no-products-found.php'); ?>

            <?php endif; ?>

        </div>


        <div class="three columns">
            <?php dynamic_sidebar('shop-sidebar-product-list'); ?>
        </div>


    </div>
</section>

