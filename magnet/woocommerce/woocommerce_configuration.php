<?php

// Adds theme support for woocommerce 
add_theme_support('woocommerce');

if(!function_exists('qode_woo_related_products_args')) {
    /**
     * Function that sets number of displayed related products. Hooks to woocommerce_output_related_products_args filter
     * @param $args array array of args for the query
     * @return mixed array of changed args
     */
    function qode_woo_related_products_args( $args ) {
        $args['posts_per_page'] = 4;
        return $args;
    }

    add_filter( 'woocommerce_output_related_products_args', 'qode_woo_related_products_args' );
}

// Display 8 products per page. Goes in functions.php
add_filter( 'loop_shop_per_page', create_function( '$cols', 'return 8;' ), 20 );

if ( ! function_exists( 'woocommerce_content' ) ) {

    /**
     * Output WooCommerce content.
     *
     * This function is only used in the optional 'woocommerce.php' template
     * which people can add to their themes to add basic woocommerce support
     * without hooks or modifying core templates.
     *
     * @access public
     * @return void
     */
    function woocommerce_content() {

        if ( is_singular( 'product' ) ) {

            while ( have_posts() ) : the_post();

                woocommerce_get_template_part( 'content', 'single-product' );

            endwhile;

        } else {

            ?>

            <?php do_action( 'woocommerce_archive_description' ); ?>

            <?php if ( have_posts() ) : ?>

                <?php do_action('woocommerce_before_shop_loop'); ?>

                <?php woocommerce_product_loop_start(); ?>

                    <?php woocommerce_product_subcategories(); ?>

                    <?php while ( have_posts() ) : the_post(); ?>

                        <?php woocommerce_get_template_part( 'content', 'product' ); ?>

                    <?php endwhile; // end of the loop. ?>

                <?php woocommerce_product_loop_end(); ?>

                <?php do_action('woocommerce_after_shop_loop'); ?>

            <?php elseif ( ! woocommerce_product_subcategories( array( 'before' => woocommerce_product_loop_start( false ), 'after' => woocommerce_product_loop_end( false ) ) ) ) : ?>

                <?php woocommerce_get_template( 'loop/no-products-found.php' ); ?>

            <?php endif;

        }
    }
}

// Ensure cart contents update when products are added to the cart via AJAX (place the following in functions.php)
add_filter('add_to_cart_fragments', 'woocommerce_header_add_to_cart_fragment');
if ( ! function_exists( 'woocommerce_header_add_to_cart_fragment' ) ) {
    function woocommerce_header_add_to_cart_fragment( $fragments ) {
    global $woocommerce;
        if($woocommerce->cart->cart_contents_count > 0 ){
            ob_start();
            ?>
            <a class="cart-contents" href="<?php echo $woocommerce->cart->get_cart_url(); ?>" title="<?php _e('View your shopping cart', 'woothemes'); ?>">
                <img src="<?php echo get_template_directory_uri(); ?>/img/woocommerce_cart_image.png" />
                <?php echo sprintf(_n('%d item', '%d items', $woocommerce->cart->cart_contents_count, 'woothemes'), $woocommerce->cart->cart_contents_count);?> - <?php echo $woocommerce->cart->get_cart_total(); ?>
            </a>
            <?php
            $fragments['a.cart-contents'] = ob_get_clean();
            return $fragments;
        }
    }
}