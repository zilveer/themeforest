<?php
    /**
     * Result Count
     * Shows text: Showing x - x of x results
     *
     * @author        WooThemes
     * @package       WooCommerce/Templates
     * @version       2.0.0
     */

    if ( ! defined( 'ABSPATH' ) ) {
        exit;
    } // Exit if accessed directly

    global $woocommerce, $wp_query, $sf_options;

    $products_per_page = $sf_options['products_per_page'];

    $shop_page_url = get_permalink( wc_get_page_id( 'shop' ) );

    if ( is_tax( 'product_cat' ) ) {
        $product_category      = $wp_query->query_vars['product_cat'];
        $product_category_link = get_term_link( $product_category, 'product_cat' );

        if ( $product_category_link != "" ) {
            $shop_page_url = $product_category_link;
        } else {
            $shop_page_url = "";
        }
    }

    if ( ! woocommerce_products_will_display() ) {
        return;
    }
?>
<div class="woocommerce-count-wrap">
    <p class="woocommerce-result-count">
        <?php
            $paged    = max( 1, $wp_query->get( 'paged' ) );
            $per_page = $wp_query->get( 'posts_per_page' );
            $total    = $wp_query->found_posts;
            $first    = ( $per_page * $paged ) - $per_page + 1;
            $last     = min( $total, $wp_query->get( 'posts_per_page' ) * $paged );

            if ( 1 == $total ) {
                echo __( 'Showing the single product', 'swiftframework' );
            } elseif ( $total <= $per_page ) {
                printf( __( 'Showing all %d products', 'swiftframework' ), $total );
            } else {
                printf( __( 'Showing %1$d-%2$d of %3$d products', 'swiftframework' ), $first, $last, $total );
            }
        ?>
	</p>
    <p class="woocommerce-show-products">
        <span><?php _e( "View", "swiftframework" ); ?> </span>
        <a class="show-products-link"
           href="?show_products=<?php echo esc_attr($products_per_page); ?>"><?php echo esc_attr($products_per_page); ?></a>/<a
            class="show-products-link"
            href="?show_products=<?php echo esc_attr($products_per_page * 2); ?>"><?php echo esc_attr($products_per_page * 2); ?></a>/<a
            class="show-products-link"
            href="?show_products=<?php echo esc_attr($total); ?>"><?php _e( "All", "swiftframework" ); ?></a>
    </p>
</div>