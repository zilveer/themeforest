<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive.
 *
 * Override this template by copying it to yourtheme/woocommerce/archive-product.php
 * @version     2.0.0
 */

if ( !defined( 'ABSPATH' ) )
    exit; // Exit if accessed directly
//$sidebar is used to set sidebar
//$wish_wc_sidebar will set sidebar position. options are right, left, none
get_header();
$redux_wish = wish_redux();

$wish_wc_sidebar = $redux_wish["wish-woocommerce-archive-layout"];

$taxonomy = '';
$term_id = '';
$sidebar = 'yes';
// $wish_wc_sidebar = 'none';
?>


<div class="container">
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <?php
            /**
             * woocommerce_before_main_content hook
             *
             * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
             * @hooked woocommerce_breadcrumb - 20
             */
            do_action( 'woocommerce_before_main_content' );
            ?>
        </div>
    </div>
   <div class="row">
 <?php
 
 
			
        if ( $sidebar == 'yes' ) {
            
            if ( $wish_wc_sidebar == 'none' ) { ?>
                <div class="product-listing-wrapper col-lg-12">
            <?php } elseif ( $wish_wc_sidebar == 'left' ) { ?>
                <div class="product-listing-wrapper col-lg-9 col-lg-push-3">
            <?php } elseif ( $wish_wc_sidebar == 'right') { ?>
                <div class="product-listing-wrapper col-lg-9"> 
            <?php } 
        } 
        ?>
    
                    <?php
                    // Get our custom category banner if it exists 
					global $post;
                    $queried_object = '';
                    $taxonomy = '';
                    $term_id = '';
                    $queried_object = get_queried_object();
                   
                    ?>    
                        <div class="product-page-title">
                            <h1 class="page-title"><?php woocommerce_page_title(); ?></h1>
                        </div>
                            
                       
                   
                    <?php
                    /**
                     * woocommerce_before_shop_loop hook
                     * overridden in woocommerce-config.php
                     */
                    do_action( 'woocommerce_before_shop_loop' );
                    ?>
                    <div class="clearfix"/></div>
                    <?php if ( have_posts() ) : ?>
                        <?php woocommerce_product_loop_start(); ?>
                        <?php woocommerce_product_subcategories(); ?>
                        <?php while ( have_posts() ) : the_post(); ?>
                            <?php woocommerce_get_template_part( 'content', 'product' ); ?>
                        <?php endwhile; // end of the loop.  ?>
                        <?php woocommerce_product_loop_end(); ?>
                        <div class="clearfix"/></div>
                        
                        <?php
                        /**
                         * woocommerce_after_shop_loop hook
                         *
                         * @hooked woocommerce_pagination - 10
                         */
                        do_action( 'woocommerce_after_shop_loop' );
						
                        ?>
                        </div>
                        
                    <?php elseif ( !woocommerce_product_subcategories( array( 'before' => woocommerce_product_loop_start( false ), 'after' => woocommerce_product_loop_end( false ) ) ) ) : ?>
                        <?php woocommerce_get_template( 'loop/no-products-found.php' ); ?>
                    <?php endif; ?>
               

                <?php
                    if ( $sidebar == 'yes' ) {

                        if ( $wish_wc_sidebar == 'left' ) { ?>
                            <div class="col-lg-3 col-lg-pull-9 shop-sidebar-left">
                        <?php } elseif ( $wish_wc_sidebar == 'right') { ?>
                            <div class="col-lg-3 shop-sidebar-right"> 
                        <?php } 
                        if ( ( $wish_wc_sidebar == 'left' ) || ( $wish_wc_sidebar == 'right' ) ) {
                            dynamic_sidebar( 'shop-sidebar' );
                            ?>
                        </div>
                        <?php }
                    }

                    /**
                     * woocommerce_after_main_content hook
                     *
                     * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
                     */
                    do_action( 'woocommerce_after_main_content' );
                    ?>
                </div>
                <!-- close row -->
            </div><!--close container -->
            <?php get_footer(); ?>