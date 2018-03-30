<?php
/**
 * Additional shortcodes for the theme.
 *
 * To create new shortcode, get for example the shortcode [sample] already written.
 * Replace it with your code for shortcode and for other shortcodes, duplicate the first
 * and continue following.
 *
 * CONVENTIONS:
 * - The name of function MUST be: yiw_sc_SHORTCODENAME_func.
 * - All html output of shortcode, must be passed by an hook: apply_filters( 'yiw_sc_SHORTCODENAME_html', $html ).
 * NB: SHORTCODENAME is the name of shortcode and must be written in lowercase.
 *
 * For example, we'll add new shortcode [sample], so:
 * - the function must be: yiw_sc_sample_func().
 * - the hooks to use will be: apply_filters( 'yiw_sc_sample_html', $html ).
 *
 * @package    WordPress
 * @subpackage YIW Themes
 * @since      1.0
 */


/**
 * LATEST PRODUCTS
 *
 * @description
 *    show a box with title and optional description, near the main content
 *
 * @example
 *   [yiw_latest_products title="" description="" per_page="" columns=""]
 *
 * @attr
 *    title  - the title of the box
 *    description - the text below title
 **/
function yiw_sc_yiw_latest_products_func( $atts, $content = null ) {
    global $woocommerce_loop;

    extract( shortcode_atts( array(
        'class'       => 'boxed-content',
        'title'       => null,
        'description' => null,
        'per_page'    => 4,
        'columns'     => 4,
        'orderby'     => 'date',
        'order'       => 'desc'
    ), $atts ) );

    $woocommerce_loop['loop'] = 0;
    $html                     = ''; // this is the var to use for the html output of shortcode
    remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering' );
    remove_action( 'woocommerce_pagination', 'woocommerce_pagination', 10 );

    $html .= '[boxed_content title="' . $title . '" description="' . $description . '"]
[recent_products per_page="' . $per_page . '" columns="' . $columns . '" orderby="' . $orderby . '" order="' . $order . '"]
[/boxed_content]';
    $woocommerce_loop['loop'] = 0;

    add_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10, 2 );
    add_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10, 2 );

    return apply_filters( 'yiw_sc_yiw_latest_products_html', do_shortcode( $html ) ); // this must be written for each shortcode
}

add_shortcode( 'yiw_latest_products', 'yiw_sc_yiw_latest_products_func' );


/**
 * FEATURED PRODUCTS
 *
 * @description
 *    show a box with title and optional description, near the main content
 *
 * @example
 *   [yiw_featured_products title="" description="" per_page="" columns=""]
 *
 * @attr
 *    title  - the title of the box
 *    description - the text below title
 **/
function yiw_sc_yiw_featured_products_func( $atts, $content = null ) {
    global $woocommerce_loop;

    extract( shortcode_atts( array(
        'class'       => 'boxed-content',
        'title'       => null,
        'description' => null,
        'per_page'    => 4,
        'columns'     => 4,
        'orderby'     => 'date',
        'order'       => 'desc'
    ), $atts ) );

    $html = ''; // this is the var to use for the html output of shortcode
    remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering' );
    remove_action( 'woocommerce_pagination', 'woocommerce_pagination', 10 );

    $woocommerce_loop['loop'] = 0;
    $html .= '[boxed_content title="' . $title . '" description="' . $description . '"]
[featured_products per_page="' . $per_page . '" columns="' . $columns . '"  orderby="' . $orderby . '" order="' . $order . '"]
[/boxed_content]';
    $woocommerce_loop['loop'] = 0;

    return apply_filters( 'yiw_sc_yiw_featured_products_html', do_shortcode( $html ) ); // this must be written for each shortcode
}

add_shortcode( 'yiw_featured_products', 'yiw_sc_yiw_featured_products_func' );


/**
 * BEST SELLERS
 *
 * @description
 *    show a box with best sellers
 *
 * @example
 *   [best_sellers per_page="" columns=""]
 *
 * @attr
 *    title  - the title of the box
 *    description - the text below title
 **/
function yiw_sc_best_sellers_func( $atts, $content = null ) {
    global $woocommerce_loop;

    extract( shortcode_atts( array(
        'per_page' => 12,
        'columns'  => 4
    ), $atts ) );

    remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering' );

    $args = array(
        'post_type'           => 'product',
        'post_status'         => 'publish',
        'ignore_sticky_posts' => 1,
        'posts_per_page'      => $per_page,
        'meta_key'            => 'total_sales',
        'orderby'             => 'meta_value'
    );

    ob_start();

    $products = new WP_Query( $args );

    $woocommerce_loop['loop']    = 0;
    $woocommerce_loop['columns'] = $columns;
    $woocommerce_loop['yiw_shortcodes'] = true;

    if ( $products->have_posts() ) : ?>

        <ul class="products <?php echo yiw_get_option( 'shop_products_style', 'ribbon' ); ?>">

            <?php while ( $products->have_posts() ) : $products->the_post(); ?>


                <?php
                if( function_exists('wc_get_template_part')){
                    wc_get_template_part( 'content', 'product' );
                }else{
                    woocommerce_get_template_part( 'content', 'product' );
                }
                ?>

            <?php endwhile; // end of the loop. ?>

        </ul>

    <?php endif;

    wp_reset_query();

    $woocommerce_loop['loop'] = 0;

    return apply_filters( 'yiw_sc_yiw_best_sellers_html', ob_get_clean() );
}

add_shortcode( 'best_sellers', 'yiw_sc_best_sellers_func' );


/**
 * BOXED BEST SELLERS
 *
 * @description
 *    show a box with title and optional description, near the main content
 *
 * @example
 *   [boxed_best_sellers title="" description="" per_page="" columns=""]
 *
 * @attr
 *    title  - the title of the box
 *    description - the text below title
 **/
function yiw_sc_boxed_best_sellers_func( $atts, $content = null ) {
    global $woocommerce_loop;

    extract( shortcode_atts( array(
        'class'       => 'boxed-content',
        'title'       => null,
        'description' => null,
        'per_page'    => 4,
        'columns'     => 4
    ), $atts ) );

    $html = ''; // this is the var to use for the html output of shortcode

    remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart' );
    remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price' );
    remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering' );

    remove_action( 'woocommerce_pagination', 'woocommerce_pagination', 10 );

    $woocommerce_loop['loop'] = 0;
    $html .= '[boxed_content title="' . $title . '" description="' . $description . '"]
[best_sellers per_page="' . $per_page . '" columns="' . $columns . '"]
[/boxed_content]';
    $woocommerce_loop['loop'] = 0;

    add_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10, 2 );
    add_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10, 2 );

    return apply_filters( 'yiw_sc_boxed_best_sellers_html', do_shortcode( $html ) ); // this must be written for each shortcode
}

add_shortcode( 'boxed_best_sellers', 'yiw_sc_boxed_best_sellers_func' );


/**
 * ITEMS
 *
 * @description
 *    show the products
 *
 * @example
 *   [items per_page="" columns="" orderby="" order=""]
 *
 * @attr
 *    per_page  - the title of the box
 *    description - the text below title
 **/
function yiw_sc_items_func( $atts ) {
    global $woocommerce_loop;

    if ( empty( $atts ) ) {
        return;
    }

    extract( shortcode_atts( array(
        'columns'  => 12,
        'per_page' => 4,
        'orderby'  => 'title',
        'order'    => 'asc'
    ), $atts ) );

    $args = array(
        'post_type'           => 'product',
        'post_status'         => 'publish',
        'posts_per_page'      => $per_page,
        'ignore_sticky_posts' => 1,
        'orderby'             => $orderby,
        'order'               => $order,
        'meta_query'          => array(
            array(
                'key'     => '_visibility',
                'value'   => array( 'catalog', 'visible' ),
                'compare' => 'IN'
            )
        )
    );

    if ( isset( $atts['skus'] ) ) {
        $skus                 = explode( ',', $atts['skus'] );
        $skus                 = array_map( 'trim', $skus );
        $args['meta_query'][] = array(
            'key'     => '_sku',
            'value'   => $skus,
            'compare' => 'IN'
        );
    }

    if ( isset( $atts['ids'] ) ) {
        $ids              = explode( ',', $atts['ids'] );
        $ids              = array_map( 'trim', $ids );
        $args['post__in'] = $ids;
    }

    $category = isset( $atts['category'] ) ? $atts['category'] : '' ;

    if ( ! empty( $category ) ) {
        $tax      = 'product_cat';
        $category = array_map( 'trim', explode( ',', $category ) );
        if ( count( $category ) == 1 ) {
            $category = $category[0];
        }
        $args['tax_query'] = array(
            array(
                'taxonomy' => $tax,
                'field'    => 'slug',
                'terms'    => $category
            )
        );
    }

    ob_start();

    $products = new WP_Query( $args );

    $woocommerce_loop['loop']    = 0;
    $woocommerce_loop['columns'] = $columns;
    $woocommerce_loop['yiw_shortcodes'] = true;

    if ( $products->have_posts() ) : ?>

        <ul class="products <?php echo yiw_get_option( 'shop_products_style', 'ribbon' ); ?>">

            <?php while ( $products->have_posts() ) : $products->the_post(); ?>

                <?php
                if( function_exists('wc_get_template_part')){
                    wc_get_template_part( 'content', 'product' );
                }else{
                    woocommerce_get_template_part( 'content', 'product' );
                }
                ?>

            <?php endwhile; // end of the loop. ?>

        </ul>

    <?php endif;

    wp_reset_query();

    $woocommerce_loop['loop'] = 0;

    return ob_get_clean();
}

add_shortcode( 'items', 'yiw_sc_items_func' );

/**
 * ADD TO CART
 *
 * @description
 *    Add a simple add to cart of a product
 *
 * @example
 *   [add_to_cart id=""]
 *
 * @attr
 *    id - the id of product
 **/
function yiw_sc_add_to_cart_func( $atts, $content = null ) {
    if ( empty( $atts ) ) {
        return;
    }

    global $wpdb, $woocommerce;

    if ( $atts['id'] ) :
        $product_data = get_post( $atts['id'] );
    elseif ( $atts['sku'] ) :
        $product_id   = $wpdb->get_var( $wpdb->prepare( "SELECT post_id FROM $wpdb->postmeta WHERE meta_key='_sku' AND meta_value='%s' LIMIT 1", $atts['sku'] ) );
        $product_data = get_post( $product_id );
    else :
        return;
    endif;

    if ( $product_data->post_type !== 'product' ) {
        return;
    }

    $product = ( function_exists( 'wc_setup_product_data' ) ) ? wc_setup_product_data( $product_data ) : $woocommerce->setup_product_data( $product_data );

    if ( ! $product->is_visible() ) {
        return;
    }

    ob_start();

    // do not show "add to cart" button if product's price isn't announced
    if ( $product->get_price() === '' ) {
        return;
    }

    switch ( $product->product_type ) :
        case "variable" :
            $link  = get_permalink( $post->ID );
            $label = apply_filters( 'variable_add_to_cart_text', __( 'Select options', 'woocommerce' ) );
            break;
        case "grouped" :
            $link  = get_permalink( $post->ID );
            $label = apply_filters( 'grouped_add_to_cart_text', __( 'View options', 'woocommerce' ) );
            break;
        case "external" :
            $link  = get_permalink( $post->ID );
            $label = apply_filters( 'external_add_to_cart_text', __( 'Read More', 'woocommerce' ) );
            break;
        default :
            $link  = esc_url( $product->add_to_cart_url() );
            $label = apply_filters( 'add_to_cart_text', yiw_get_option( 'shop_button_addtocart_label', __( 'Add to cart', 'woocommerce' ) ) );
            break;
    endswitch;

    ?><a href="<?php echo $link; ?>" class="button"><?php echo $label; ?></a><?php

    $html = ob_get_clean();

    return apply_filters( 'yiw_sc_add_to_cart_html', $html );
}

add_shortcode( 'add_to_cart', 'yiw_sc_add_to_cart_func' );


/**
 * RESET WOOCOMMERCE LOOP
 *
 * @description
 *    set the loop to 0
 *
 * @example
 *   [reset_woocommerce_loop]
 **/
function yiw_sc_reset_woocommerce_loop_func( $atts ) {
    global $woocommerce_loop;

    $woocommerce_loop['loop'] = 0;
}

add_shortcode( 'reset_woocommerce_loop', 'yiw_sc_reset_woocommerce_loop_func' );

/**
 * RATING
 *
 * @description
 *    Print rating star of product id
 *
 * @example
 *   [rating id=""]
 **/
function yiw_rating( $atts ) {
    global $woocommerce_loop;

    extract( shortcode_atts( array(
        'id' => null,
    ), $atts ) );

    global $wpdb;

    $count = $wpdb->get_var( $wpdb->prepare( "
		SELECT COUNT(meta_value) FROM $wpdb->commentmeta
		LEFT JOIN $wpdb->comments ON $wpdb->commentmeta.comment_id = $wpdb->comments.comment_ID
		WHERE meta_key = 'rating'
		AND comment_post_ID = %d
		AND comment_approved = '1'
		AND meta_value > 0
	", $id ) );

    $rating = $wpdb->get_var( $wpdb->prepare( "
		SELECT SUM(meta_value) FROM $wpdb->commentmeta
		LEFT JOIN $wpdb->comments ON $wpdb->commentmeta.comment_id = $wpdb->comments.comment_ID
		WHERE meta_key = 'rating'
		AND comment_post_ID = %d
		AND comment_approved = '1'
	", $id ) );

    if ( $count > 0 ) {

        $average = number_format( $rating / $count, 2 );

        echo '<div class="star-rating shortcode" title="' . sprintf( __( 'Rated %s out of 5', 'yiw' ), $average ) . '"><span style="width:' . ( ( $average / 5 ) * 100 ) . '%"><strong itemprop="ratingValue" class="rating">' . $average . '</strong> ' . __( 'out of 5', 'yiw' ) . '</span></div>';

    }
    else {

        _e( 'No Rating', 'yiw' );

    }

    wp_reset_query();

    return;
}

add_shortcode( 'rating', 'yiw_rating' );

/**
 * Add t cart (with variations)
 *
 * @description
 *    Print add to cart and price
 *
 * @example
 *   [yiw_add_to_cart id="" attribute_id="" show_price="yes|no" show_cart="yes|no" ]
 **/
function yiw_add_to_cart( $atts ) {
    global $woocommerce_loop;

    extract( shortcode_atts( array(
        'id'           => null,
        'attribute_id' => null,
        'show_price'   => 'yes',
        'show_cart'    => 'yes',
    ), $atts ) );

    global $woocommerce, $product;

    $id           = ( isset( $id ) ) ? (int) $id : '';
    $attribute_id = ( isset( $attribute_id ) ) ? (int) $attribute_id : '';
    $show_price   = ( isset( $show_price ) && $show_price == 'yes' ) ? true : false;
    $show_cart    = ( isset( $show_cart ) && $show_cart == 'yes' ) ? true : false;


    $product = get_product( $id );
    if ( ! $product->is_purchasable() ) {
        return;
    }
    ?>


    <?php if ( $product->is_in_stock() ) : ?>
        <div class="sc_addcart">
            <?php if ( $product->product_type == 'simple' ) : ?>
                <?php if ( $show_price ) {
                    echo $product->get_price_html();
                } ?>
                <?php if ( $show_cart ) : ?>
                    <form action="<?php echo esc_url( $product->add_to_cart_url() ); ?>" class="cart" method="post" enctype='multipart/form-data'>
                        <button type="submit" class="single_add_to_cart_button button"><?php echo apply_filters( 'single_add_to_cart_text', __( 'Add to cart', 'yiw' ), $product->product_type ); ?></button>
                    </form>
                <?php endif ?>
            <?php elseif ( $product->product_type == 'variable' && $attribute_id != '' ) : ?>
                <?php
                $attributes = $product->get_available_variations();
                foreach ( $attributes as $key ) {
                    if ( $key['variation_id'] == $attribute_id ):
                        $select = '';
                        foreach ( $key['attributes'] as $key => $value ) {
                            $select .= '<select name="' . $key . '" style="display: none;">
							    				<option value="' . $value . '" class="active" selected="selected"></option>
							    			</select>';
                        }
                    endif;
                }
                ?>
                <?php if ( $show_price ) :
                    $variation = $product->get_child( $attribute_id );
                    echo $variation->get_price_html();
                endif ?>
                <?php if ( $show_cart ) : ?>
                    <form data-product_id="<?php echo $id ?>" enctype="multipart/form-data" method="post" class="variations_form cart group" action="<?php echo esc_url( $product->add_to_cart_url() ); ?>">
                        <input type="hidden" value="1" name="quantity">

                        <div class="variations">
                            <?php echo $select ?>
                        </div>
                        <input type="hidden" value="<?php echo $attribute_id ?>" name="variation_id">
                        <button class="single_add_to_cart_button button" type="submit">Add to cart</button>
                        <input type="hidden" value="<?php echo $id ?>" name="product_id">
                    </form>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    <?php endif;

    return;
}

add_shortcode( 'yiw_add_to_cart', 'yiw_add_to_cart' );

?>