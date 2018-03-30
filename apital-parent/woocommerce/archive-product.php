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

get_header( 'shop' );?>
<div class="w-section inner-banner" id="top" data-ix="show-top-btn">
    <div class="w-container">
        <div class="w-row">
            <div class="w-col w-col-9">
                <div class="breadcrumb">
                    <?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>
                        <?php woocommerce_page_title(); ?>
                    <?php endif; ?>

                    <?php do_action( 'woocommerce_archive_description' ); ?>
                </div>
            </div>
            <div class="w-col w-col-3 left-aglin-column cetner">
                <?php
                if( function_exists('fw_ext_breadcrumbs') ) {
                    fw_ext_breadcrumbs();
                }
                ?>
            </div>
        </div>
    </div>
</div>

<?php $sidebar_position = (function_exists('fw_ext_sidebars_get_current_position')) ? fw_ext_sidebars_get_current_position() : 'right';?>
<section class="w-section section">
    <div class="w-container">
        <div class="w-row">
            <div class="w-col <?php echo ($sidebar_position == null || $sidebar_position == 'full') ? 'w-col-12' : 'w-col-9'; ?> w-col-stack">
                <?php
                    /**
                     * woocommerce_before_main_content hook
                     *
                     * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
                     * @hooked woocommerce_breadcrumb - 20
                     */
                    do_action( 'woocommerce_before_main_content' );
                ?>
                <?php if ( have_posts() ) : ?>

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

                <?php
                    /**
                     * woocommerce_after_main_content hook
                     *
                     * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
                     */
                    do_action( 'woocommerce_after_main_content' );
                ?>
            </div>
            <?php if($sidebar_position == 'left' || $sidebar_position == 'right'):?>
            <div class="w-col w-col-3 w-col-stack">
                <div class="sidebar">
                    <?php
                        /**
                         * woocommerce_sidebar hook
                         *
                         * @hooked woocommerce_get_sidebar - 10
                         */
                        do_action( 'woocommerce_sidebar' );
                    ?>

                </div>
            </div>
        <?php endif;?>
        </div>
    </div>
</section>
<?php get_footer( 'shop' ); ?>
