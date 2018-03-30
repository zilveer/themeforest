<?php
/**
 * The Template for displaying all single products.
 *
 * Override this template by copying it to yourtheme/woocommerce/single-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

get_header( 'shop' ); ?>
<div class="w-section inner-banner" id="top" data-ix="show-top-btn">
    <div class="w-container">
        <div class="w-row">
            <div class="w-col w-col-9">
                <div class="breadcrumb">
                    <?php the_title(); ?>
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
<?php $sidebar_position = (function_exists('fw_ext_sidebars_get_current_position')) ? fw_ext_sidebars_get_current_position() : 'right'; ?>
<div class="w-section section">
    <div class="w-container">
        <div class="w-row">
            <div class="w-col <?php echo ($sidebar_position == null || $sidebar_position == 'full') ? 'w-col-12' : 'w-col-9'; ?> w-col-stack">
                <div class="portfolio-pagination blog-pag">
                    <div class="w-row">
                        <div class="w-col w-col-6 right-aglin-column">
                            <span class="w-inline-block p-pagination">
                                <?php previous_post_link('%link', '<span class="w-embed"><i class="fa fa-chevron-left"></i></span>', false); ?>
                            </span>
                        </div>
                        <div class="w-col w-col-6 left-aglin-column">
                            <span class="w-inline-block p-pagination">
                                <?php next_post_link('%link', '<span class="w-embed"><i class="fa fa-chevron-right"></i></span>', false); ?>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="normal-blog-wrapper">
                    <?php
                        /**
                         * woocommerce_before_main_content hook
                         *
                         * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
                         * @hooked woocommerce_breadcrumb - 20
                         */
                        do_action( 'woocommerce_before_main_content' );
                    ?>

                    <?php while ( have_posts() ) : the_post(); ?>

                        <?php wc_get_template_part( 'content', 'single-product' ); ?>

                    <?php endwhile; // end of the loop. ?>

                    <?php
                        /**
                         * woocommerce_after_main_content hook
                         *
                         * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
                         */
                        do_action( 'woocommerce_after_main_content' );
                    ?>
                </div>
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
</div>
<?php get_footer( 'shop' ); ?>
