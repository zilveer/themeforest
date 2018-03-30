<?php

//Change WC initial images sizes
if(!function_exists('a13_woocommerce_image_dimensions')){
    function a13_woocommerce_image_dimensions() {
        /**
         * Define image sizes
         */
        $catalog = array(
            'width' 	=> '350',	// px
            'height'	=> '420',	// px
            'crop'		=> 1 		// true
        );

        $single = array(
            'width' 	=> '590',	// px
            'height'	=> '810',	// px
            'crop'		=> 1 		// true
        );

        $thumbnail = array(
            'width' 	=> '190',	// px
            'height'	=> '225',	// px
            'crop'		=> 1 		// true
        );

        // Image sizes
        update_option( 'shop_catalog_image_size', $catalog ); 		// Product category thumbs
        update_option( 'shop_single_image_size', $single ); 		// Single product image
        update_option( 'shop_thumbnail_image_size', $thumbnail ); 	// Image gallery thumbs
    }
}

//remove WC bredcrumbs
if(!function_exists('a13_woocommerce_remove_wc_breadcrumbs')){
    function a13_woocommerce_remove_wc_breadcrumbs() {
        remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );
    }
}

//start html of WC templates
if(!function_exists('a13_woocommerce_theme_wrapper_start')){
    function a13_woocommerce_theme_wrapper_start() {
        add_filter( 'woocommerce_show_page_title', '__return_false');
        a13_title_bar();
        $post_ID = 0;

        $no_property_page = a13_is_no_property_page();
        if(!$no_property_page){ //not search page without results
            $post_ID = get_the_ID();
        }
        ?>

    <article id="content" class="clearfix">

        <div id="col-mask">

            <div id="post-<?php echo $post_ID; ?>" <?php
                if($no_property_page){
                    echo 'class="post-content"'; //be sure to put that class
                }
                else{
                    post_class('post-content'); //normally display all classes
                }?>>
                <div class="real-content">
    <?php
    }
}

//end html of WC templates
if(!function_exists('a13_woocommerce_theme_wrapper_end')){
    function a13_woocommerce_theme_wrapper_end() {
        ?>
        <div class="clear"></div>
                </div>
            </div>
            <?php get_sidebar(); ?>
        </div>
    </article>
    <?php
    }
}

//"add to cart" fragment from header
if(!function_exists('a13_woocommerce_header_add_to_cart_fragment')){
    function a13_woocommerce_header_add_to_cart_fragment( $fragments ) {
        ob_start();
        a13_wc_mini_cart();
        $fragments['div.header-cart-inside'] = ob_get_clean();
        return $fragments;
    }
}

//displays header cart
if(!function_exists('a13_wc_mini_cart')){
    function a13_wc_mini_cart(){
        global $woocommerce;
        ?>
    <div class="header-cart-inside">
        <a href="<?php echo $woocommerce->cart->get_cart_url(); ?>" class="cart-link"><span class="cart-info"><?php echo $woocommerce->cart->get_cart_total(); ?></span><i class="fa fa-shopping-cart"></i><span class="items-count"><?php echo $woocommerce->cart->cart_contents_count; ?></span></a>

        <div class="mini-cart">
            <?php
            if ( sizeof( WC()->cart->get_cart() ) > 0 ) : ?>
                <ul class="basket_list">
                    <?php
                    foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
                        $_product     = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
                        $product_id   = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

                        if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_widget_cart_item_visible', true, $cart_item, $cart_item_key ) ) {

                            $product_name  = apply_filters( 'woocommerce_cart_item_name', $_product->get_title(), $cart_item, $cart_item_key );
    //                        $thumbnail     = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );
                            $product_price = apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
                            $quantity      = ((int)$cart_item['quantity']) === 1 ? '' : ' <span class="quantity">' . sprintf( 'x %s', $cart_item['quantity']) . '</span>';
                            ?>
                            <li>
                                <a class="name_quantity" href="<?php echo get_permalink( $product_id ); ?>"><?php echo $product_name.$quantity ?></a>

                                <?php echo $product_price; ?>

                                <span class="remove"><?php echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf( '<a href="%s" title="%s" class="fa fa-times-circle"></a>', esc_url( WC()->cart->get_remove_url( $cart_item_key ) ), __( 'Remove this item', 'woocommerce' ) ), $cart_item_key ); ?></span>

                                <?php //echo WC()->cart->get_item_data( $cart_item ); ?>

                            </li>
                            <?php
                        }
                    }
                    ?>

                </ul><!-- end product list -->
                <?php endif; ?>

            <?php if ( sizeof( WC()->cart->get_cart() ) > 0 ) : ?>

            <p class="total"><span class="label"><?php _e( 'Subtotal', 'woocommerce' ); ?>:</span> <?php echo WC()->cart->get_cart_subtotal(); ?></p>

            <p class="buttons"><a href="<?php echo WC()->cart->get_cart_url(); ?>" class="a13-button a13-button-grey"><?php _e( 'View Cart', 'woocommerce' ); ?></a></p>
            <p class="buttons checkout"><a href="<?php echo WC()->cart->get_checkout_url(); ?>" class="a13-button"><?php _e( 'Checkout', 'woocommerce' ); ?></a></p>

            <?php else : ?>

            <p class="buttons empty"><a class="a13-button" href="<?php echo get_permalink( wc_get_page_id( 'shop' ) ); ?>"><?php _e( 'Go to the shop', 'fame' ) ?></a></p>

            <?php endif; ?>
        </div>
    </div>
    <?php
    }
}

//is WC activated
if(!function_exists('a13_is_woocommerce_activated')){
    function a13_is_woocommerce_activated() {
        return class_exists( 'woocommerce' );
    }
}

//is current page one of WC
if(!function_exists('a13_is_woocommerce')){
    function a13_is_woocommerce() {
        return (a13_is_woocommerce_activated() && (is_woocommerce() || is_cart() || is_account_page() || is_checkout() || is_order_received_page()));
    }
}

//is current page one of WC pages without proper title
if(!function_exists('a13_is_woocommerce_no_title_page')){
    function a13_is_woocommerce_no_title_page() {
        return (a13_is_woocommerce_activated() && (is_shop() || is_product_category() || is_product_tag()));
    }
}

//is current page one of WC pages where sidebar is useful
if(!function_exists('a13_is_woocommerce_sidebar_page')){
    function a13_is_woocommerce_sidebar_page() {
        return (a13_is_woocommerce_activated() && is_woocommerce());
    }
}

//is current product new
if(!function_exists('a13_is_product_new')){
    function a13_is_product_new() {
        global $product;
        return is_object_in_term( $product->id, 'product_tag', 'new' );
    }
}

//add labels above single product image
if(!function_exists('a13_single_product_labels')){
    function a13_single_product_labels($html) {
        global $product;

        $html = '<div class="thumb-space">'.$html;

        //labels
        //out of stock
        if(!$product->is_in_stock()){
            $html .= '<span class="ribbon out-of-stock"><em>'.__( 'Out of stock', 'woocommerce' ).'</em></span>';
        }
        else{
            //sale
            if($product->is_on_sale()){
                $html .= '<span class="ribbon sale"><em>'.__( 'Sale!', 'woocommerce' ).'</em></span>';
            }
            //new
            if(a13_is_product_new()){
                $html .= '<span class="ribbon new"><em>'.__( 'New!', 'fame' ).'</em></span>';
            }
        }

        $html .= '</div>';

        return $html;
    }
}

//change HTML of rating na d price in single product
if(!function_exists('a13_single_product_rating_price')){
    function a13_single_product_rating_price() {
        wc_get_template( 'single-product/rating_price.php' );
    }
}

//overwrite WC function
//related_products - showing number of columns depending on settings
function woocommerce_output_related_products() {
    $args = array(
        'posts_per_page' => defined('A13_FULL_WIDTH')? 4 : 3,
        'columns'        => NULL, /* empty so template will decide */
    );
    woocommerce_related_products( $args );
}

//overwrite WC function
//displays upsell products list
function woocommerce_upsell_display( $posts_per_page = '-1', $columns = NULL, $orderby = 'rand' ) {
    wc_get_template( 'single-product/up-sells.php', array(
        'posts_per_page'  => $posts_per_page,
        'orderby'    => $orderby,
        'columns'    => $columns
    ));
}

function a13_is_wishlist_active(){
	return class_exists( 'YITH_WCWL' );
}

/*
 *
 * FILTERS AND ACTIONS
 * ADDING AND REMOVING
 * Just to make it feel good:-)
 *
 */

//GLOBAL WC
//tell WC how our content wraper should look
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);
add_action('woocommerce_before_main_content', 'a13_woocommerce_theme_wrapper_start', 10);
add_action('woocommerce_after_main_content', 'a13_woocommerce_theme_wrapper_end', 10);
//no WC breadcrumbs
add_action( 'init', 'a13_woocommerce_remove_wc_breadcrumbs' );
// Ensure cart contents update when products are added to the cart via AJAX (place the following in functions.php)
add_filter('add_to_cart_fragments', 'a13_woocommerce_header_add_to_cart_fragment');
//overwrite image sizes only when theme is activated but ONLY on theme activation
global $pagenow;
if ( is_admin() && isset( $_GET['activated'] ) && $pagenow == 'themes.php' ){
    add_action( 'init', 'a13_woocommerce_image_dimensions', 1 );
}

//PRODUCTS LIST
//link opening and closing Since WooCommerce 2.5.0
remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 );
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );

//remove sale badge from loop
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash' );
//remove rating from loop
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
//remove add to cart from loop
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart');
// Display 12 products per page
add_filter( 'loop_shop_per_page', create_function( '$cols', 'return 12;' ), 20 );

//SINGLE PRODUCT
//remove sale badge from loop
remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10 );
//add navigation through products
add_action( 'woocommerce_single_product_summary', 'a13_cpt_nav', 4 );
//show rating stars
add_action( 'woocommerce_single_product_summary', 'a13_single_product_rating_price', 5 );
//remove rating from loop
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
//remove price from default place
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
//display labels on product photo
add_filter( 'woocommerce_single_product_image_html', 'a13_single_product_labels');
