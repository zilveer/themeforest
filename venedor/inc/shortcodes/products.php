<?php

// Products Shortcode

add_shortcode("sw_bestseller_products", "venedor_shortcode_bestseller_products");
add_shortcode("sw_featured_products", "venedor_shortcode_featured_products");
add_shortcode("sw_sale_products", "venedor_shortcode_sale_products");
add_shortcode("sw_latest_products", "venedor_shortcode_latest_products");

function venedor_shortcode_bestseller_products($atts, $content = null) {

    global $venedor_settings;

    $sliderrandomid = rand();
    extract(shortcode_atts(array(
        "title" => '',
        "desc" => '',
        'products' => '8',
        'cats' => '',
        'view' => 'grid',
        'orderby' => 'date',
        'order' => 'desc',
        'single' => 'false',
        'arrow_pos' => '',
        'animation_type' => '',
        'animation_duration' => 1,
        'animation_delay' => 0,
        'class' => ''
    ), $atts));
    ob_start();
    ?>

    <?php
    /**
     * Check if WooCommerce is active
     **/
    if ( class_exists('WooCommerce') ) {
        ?>

        <?php
        $args = array(
            'post_type'           => 'product',
            'post_status'         => 'publish',
            'ignore_sticky_posts' => 1,
            'posts_per_page'      => $products,
            'meta_key'            => 'total_sales',
            'orderby'             => 'meta_value_num',
            'meta_query'          => WC()->query->get_meta_query()
        );

        if ($cats) {
            $cats = explode(',', $cats);
            $args['tax_query'] = array(
                array(
                    'taxonomy' => 'product_cat',
                    'field' => 'id',
                    'terms' => $cats,
                )
            );
        }

        $products = new WP_Query( $args );

        global $venedor_product_slider, $venedor_product_view;

        if ($view == 'slider')
            $venedor_product_slider = true;
        else
            $venedor_product_slider = false;

        $venedor_product_view = $view;

        if ( $products->have_posts() ) : ?>

            <div class="shortcode shortcode-products bestsellers <?php if ($view == 'slider') echo ' product-slider'; ?><?php if (!$title) echo ' notitle'; ?> <?php if ($arrow_pos) echo $arrow_pos ?> <?php if ($desc) echo ' with-desc'; ?><?php if ($single == 'true') echo ' single'; ?> <?php echo $class ?> <?php if ($animation_type) echo 'animated' ?>"
                <?php if ($animation_type) : ?>
                    animation_type="<?php echo $animation_type ?>" animation_duration="<?php echo $animation_duration ?>" animation_delay="<?php echo $animation_delay ?>"
                <?php endif; ?>>

                <?php if ($title) : ?><h2 class="entry-title"><?php echo $title; ?></h2><?php endif; ?>

                <?php if ($desc) : ?><div class="slider-desc"><?php echo $desc; ?></div><?php endif; ?>

                <?php woocommerce_product_loop_start(); ?>

                <?php while ( $products->have_posts() ) : $products->the_post(); ?>

                    <?php wc_get_template_part( 'content', 'product' ); ?>

                <?php endwhile; // end of the loop. ?>

                <?php woocommerce_product_loop_end(); ?>

            </div>

        <?php else : ?>

            <div class="shortcode shortcode-products <?php if (!$title) echo ' notitle'; ?> <?php if ($desc) echo ' with-desc'; ?> <?php echo $class ?> <?php if ($animation_type) echo 'animated' ?>"
                <?php if ($animation_type) : ?>
                    animation_type="<?php echo $animation_type ?>" animation_duration="<?php echo $animation_duration ?>" animation_delay="<?php echo $animation_delay ?>"
                <?php endif; ?>>

                <?php if ($title) : ?><h2 class="entry-title"><?php echo $title; ?></h2><?php endif; ?>

                <?php if ($desc) : ?><div class="slider-desc"><?php echo $desc; ?></div><?php endif; ?>

                <p><?php _e( 'No products were found matching your selection.', 'woocommerce' ); ?></p>
            </div>

        <?php endif;

        $venedor_product_slider = false;
        $venedor_product_view = '';
        woocommerce_reset_loop();
        wp_reset_postdata();
    }
    $str = ob_get_contents();
    ob_end_clean();
    return $str;
}

function venedor_shortcode_featured_products($atts, $content = null) {

    global $venedor_settings;

    $sliderrandomid = rand();
    extract(shortcode_atts(array(
        "title" => '',
        "desc" => '',
        'products' => '8',
        'cats' => '',
        'view' => 'grid',
        'orderby' => 'date',
        'order' => 'desc',
        'single' => 'false',
        'arrow_pos' => '',
        'animation_type' => '',
        'animation_duration' => 1,
        'animation_delay' => 0,
        'class' => ''
    ), $atts));
    ob_start();
    ?>

    <?php
    /**
     * Check if WooCommerce is active
     **/
    if ( class_exists('WooCommerce') ) {
        ?>

        <?php

        $meta_query   = WC()->query->get_meta_query();
        $meta_query[] = array(
            'key'   => '_featured',
            'value' => 'yes'
        );

        $args = array(
            'post_type'           => 'product',
            'post_status'         => 'publish',
            'ignore_sticky_posts' => 1,
            'posts_per_page'      => $products,
            'orderby'             => $orderby,
            'order'               => $order == 'asc' ? 'asc' : 'desc',
            'meta_query'          => $meta_query
        );

        if ($cats) {
            $cats = explode(',', $cats);
            $args['tax_query'] = array(
                array(
                    'taxonomy' => 'product_cat',
                    'field' => 'id',
                    'terms' => $cats,
                )
            );
        }

        $products = new WP_Query( $args );

        global $venedor_product_slider, $venedor_product_view;

        if ($view == 'slider')
            $venedor_product_slider = true;
        else
            $venedor_product_slider = false;

        $venedor_product_view = $view;

        if ( $products->have_posts() ) : ?>

            <div class="shortcode shortcode-products featureds <?php if ($view == 'slider') echo ' product-slider'; ?><?php if (!$title) echo ' notitle'; ?> <?php if ($arrow_pos) echo $arrow_pos ?> <?php if ($desc) echo ' with-desc'; ?><?php if ($single == 'true') echo ' single'; ?> <?php echo $class ?> <?php if ($animation_type) echo 'animated' ?>"
                <?php if ($animation_type) : ?>
                    animation_type="<?php echo $animation_type ?>" animation_duration="<?php echo $animation_duration ?>" animation_delay="<?php echo $animation_delay ?>"
                <?php endif; ?>>

                <?php if ($title) : ?><h2 class="entry-title"><?php echo $title; ?></h2><?php endif; ?>

                <?php if ($desc) : ?><div class="slider-desc"><?php echo $desc; ?></div><?php endif; ?>

                <?php woocommerce_product_loop_start(); ?>

                <?php while ( $products->have_posts() ) : $products->the_post(); ?>

                    <?php wc_get_template_part( 'content', 'product' ); ?>

                <?php endwhile; // end of the loop. ?>

                <?php woocommerce_product_loop_end(); ?>

            </div>

        <?php else : ?>

            <div class="shortcode shortcode-products <?php if (!$title) echo ' notitle'; ?> <?php if ($desc) echo ' with-desc'; ?> <?php echo $class ?> <?php if ($animation_type) echo 'animated' ?>"
                <?php if ($animation_type) : ?>
                    animation_type="<?php echo $animation_type ?>" animation_duration="<?php echo $animation_duration ?>" animation_delay="<?php echo $animation_delay ?>"
                <?php endif; ?>>

                <?php if ($title) : ?><h2 class="entry-title"><?php echo $title; ?></h2><?php endif; ?>

                <?php if ($desc) : ?><div class="slider-desc"><?php echo $desc; ?></div><?php endif; ?>

                <p><?php _e( 'No products were found matching your selection.', 'woocommerce' ); ?></p>
            </div>

        <?php endif;

        $venedor_product_slider = false;
        $venedor_product_view = '';
        woocommerce_reset_loop();
        wp_reset_postdata();
    }
    $str = ob_get_contents();
    ob_end_clean();
    return $str;
}

function venedor_shortcode_sale_products($atts, $content = null) {

    global $venedor_settings;

    $sliderrandomid = rand();
    extract(shortcode_atts(array(
        "title" => '',
        "desc" => '',
        'products' => '8',
        'cats' => '',
        'view' => 'grid',
        'orderby' => 'date',
        'order' => 'desc',
        'single' => 'false',
        'arrow_pos' => '',
        'animation_type' => '',
        'animation_duration' => 1,
        'animation_delay' => 0,
        'class' => ''
    ), $atts));
    ob_start();
    ?>

    <?php
    /**
     * Check if WooCommerce is active
     **/
    if ( class_exists('WooCommerce') ) {
        ?>

        <?php

        $args = array(
            'post_type' => 'product',
            'post_status' => 'publish',
            'no_found_rows' => 1,
            'posts_per_page' => $products,
            'order' => $order == 'asc' ? 'asc' : 'desc',
            'orderby' => $orderby
        );

        $args['meta_query'] = array();
        $args['meta_query'][] = WC()->query->get_meta_query();
        $args['meta_query']   = array_filter( $args['meta_query'] );

        $product_ids_on_sale = wc_get_product_ids_on_sale();
        $product_ids_on_sale[] = 0;
        $args['post__in'] = $product_ids_on_sale;

        if ($cats) {
            $cats = explode(',', $cats);
            $args['tax_query'] = array(
                array(
                    'taxonomy' => 'product_cat',
                    'field' => 'id',
                    'terms' => $cats,
                )
            );
        }

        $products = new WP_Query( $args );

        global $venedor_product_slider, $venedor_product_view;

        if ($view == 'slider')
            $venedor_product_slider = true;
        else
            $venedor_product_slider = false;

        $venedor_product_view = $view;

        if ( $products->have_posts() ) : ?>

            <div class="shortcode shortcode-products sales <?php if ($view == 'slider') echo ' product-slider'; ?><?php if (!$title) echo ' notitle'; ?> <?php if ($arrow_pos) echo $arrow_pos ?> <?php if ($desc) echo ' with-desc'; ?><?php if ($single == 'true') echo ' single'; ?> <?php echo $class ?> <?php if ($animation_type) echo 'animated' ?>"
                <?php if ($animation_type) : ?>
                    animation_type="<?php echo $animation_type ?>" animation_duration="<?php echo $animation_duration ?>" animation_delay="<?php echo $animation_delay ?>"
                <?php endif; ?>>

                <?php if ($title) : ?><h2 class="entry-title"><?php echo $title; ?></h2><?php endif; ?>

                <?php if ($desc) : ?><div class="slider-desc"><?php echo $desc; ?></div><?php endif; ?>

                <?php woocommerce_product_loop_start(); ?>

                <?php while ( $products->have_posts() ) : $products->the_post(); ?>

                    <?php wc_get_template_part( 'content', 'product' ); ?>

                <?php endwhile; // end of the loop. ?>

                <?php woocommerce_product_loop_end(); ?>

            </div>

        <?php else : ?>

            <div class="shortcode shortcode-products <?php if (!$title) echo ' notitle'; ?> <?php if ($desc) echo ' with-desc'; ?> <?php echo $class ?> <?php if ($animation_type) echo 'animated' ?>"
                <?php if ($animation_type) : ?>
                    animation_type="<?php echo $animation_type ?>" animation_duration="<?php echo $animation_duration ?>" animation_delay="<?php echo $animation_delay ?>"
                <?php endif; ?>>

                <?php if ($title) : ?><h2 class="entry-title"><?php echo $title; ?></h2><?php endif; ?>

                <?php if ($desc) : ?><div class="slider-desc"><?php echo $desc; ?></div><?php endif; ?>

                <p><?php _e( 'No products were found matching your selection.', 'woocommerce' ); ?></p>
            </div>

        <?php endif;

        $venedor_product_slider = false;
        $venedor_product_view = '';
        woocommerce_reset_loop();
        wp_reset_postdata();
    }
    $str = ob_get_contents();
    ob_end_clean();
    return $str;
}

function venedor_shortcode_latest_products($atts, $content = null) {

    global $venedor_settings;

    $sliderrandomid = rand();
    extract(shortcode_atts(array(
        "title" => '',
        "desc" => '',
        'products' => '8',
        'cats' => '',
        'view' => 'grid',
        'orderby' => 'date',
        'order' => 'desc',
        'single' => 'false',
        'arrow_pos' => '',
        'animation_type' => '',
        'animation_duration' => 1,
        'animation_delay' => 0,
        'class' => ''
    ), $atts));
    ob_start();
    ?>

    <?php
    /**
     * Check if WooCommerce is active
     **/
    if ( class_exists('WooCommerce') ) {
        ?>

        <?php
        $args = array(
            'post_type' => 'product',
            'post_status' => 'publish',
            'ignore_sticky_posts' => 1,
            'posts_per_page' => $products,
            'orderby' => $orderby,
            'order' => $order
        );

        $args['meta_query'][] = WC()->query->get_meta_query();
        $args['meta_query']   = array_filter( $args['meta_query'] );

        if ($cats) {
            $cats = explode(',', $cats);
            $args['tax_query'] = array(
                array(
                    'taxonomy' => 'product_cat',
                    'field' => 'id',
                    'terms' => $cats,
                )
            );
        }

        $products = new WP_Query( $args );

        global $venedor_product_slider, $venedor_product_view;

        if ($view == 'slider')
            $venedor_product_slider = true;
        else
            $venedor_product_slider = false;

        $venedor_product_view = $view;

        if ( $products->have_posts() ) : ?>

            <div class="shortcode shortcode-products latests <?php if ($view == 'slider') echo ' product-slider'; ?><?php if (!$title) echo ' notitle'; ?> <?php if ($arrow_pos) echo $arrow_pos ?> <?php if ($desc) echo ' with-desc'; ?><?php if ($single == 'true') echo ' single'; ?> <?php echo $class ?> <?php if ($animation_type) echo 'animated' ?>"
                <?php if ($animation_type) : ?>
                    animation_type="<?php echo $animation_type ?>" animation_duration="<?php echo $animation_duration ?>" animation_delay="<?php echo $animation_delay ?>"
                <?php endif; ?>>

                <?php if ($title) : ?><h2 class="entry-title"><?php echo $title; ?></h2><?php endif; ?>

                <?php if ($desc) : ?><div class="slider-desc"><?php echo $desc; ?></div><?php endif; ?>

                <?php woocommerce_product_loop_start(); ?>

                <?php while ( $products->have_posts() ) : $products->the_post(); ?>

                    <?php wc_get_template_part( 'content', 'product' ); ?>

                <?php endwhile; // end of the loop. ?>

                <?php woocommerce_product_loop_end(); ?>

            </div>

        <?php else : ?>

            <div class="shortcode shortcode-products <?php if (!$title) echo ' notitle'; ?> <?php if ($desc) echo ' with-desc'; ?> <?php echo $class ?> <?php if ($animation_type) echo 'animated' ?>"
                <?php if ($animation_type) : ?>
                    animation_type="<?php echo $animation_type ?>" animation_duration="<?php echo $animation_duration ?>" animation_delay="<?php echo $animation_delay ?>"
                <?php endif; ?>>

                <?php if ($title) : ?><h2 class="entry-title"><?php echo $title; ?></h2><?php endif; ?>

                <?php if ($desc) : ?><div class="slider-desc"><?php echo $desc; ?></div><?php endif; ?>

                <p><?php _e( 'No products were found matching your selection.', 'woocommerce' ); ?></p>
            </div>

        <?php endif;

        $venedor_product_slider = false;
        $venedor_product_view = '';
        woocommerce_reset_loop();
        wp_reset_postdata();
    }
    $str = ob_get_contents();
    ob_end_clean();
    return $str;
}

// Register Shortcodes in Visual Composer Editor
if (function_exists('vc_set_as_theme')) {

    function venedor_vc_shortcode_sw_bestseller_products() {
        $vc_icon = venedor_vc_icon().'product.png';
        $animation_type = venedor_vc_animation_type();
        $animation_duration = venedor_vc_animation_duration();
        $animation_delay = venedor_vc_animation_delay();
        $custom_class = venedor_vc_custom_class();

        vc_map( array(
            "name" => "SW Bestseller Products",
            "base" => "sw_bestseller_products",
            "category" => "Venedor",
            "icon" => $vc_icon,
            "params" => array(
                array(
                    "type" => "textfield",
                    "heading" => "Title",
                    "param_name" => "title",
                    "admin_label" => true
                ),
                array(
                    "type" => "textarea",
                    "heading" => "Description",
                    "param_name" => "desc"
                ),
                array(
                    "type" => "textfield",
                    "heading" => "Products Count",
                    "param_name" => "products",
                    "value" => "8",
                    "admin_label" => true
                ),
                array(
                    "type" => "textfield",
                    "heading" => "Category IDs",
                    "param_name" => "cats",
                    "value" => "",
                    "admin_label" => true
                ),
                array(
                    "type" => "view_mode",
                    "heading" => "View Mode",
                    "param_name" => "view",
                    "value" => "grid",
                    "admin_label" => true
                ),
                array(
                    "type" => "boolean",
                    "heading" => "Single View",
                    "param_name" => "single",
                    "value" => "false"
                ),
                array(
                    'type' => 'dropdown',
                    'heading' => "Arrow Position",
                    'param_name' => 'arrow_pos',
                    'value' => array("" => "", "Top" => "arrow-top", "Bottom" => "arrow-bottom"),
                    'description' => ''
                ),
                $animation_type,
                $animation_duration,
                $animation_delay,
                $custom_class
            )
        ) );

        if ( class_exists( 'WPBakeryShortCodes' ) ) {
            class WPBakeryShortCode_Sw_Bestseller_Products extends WPBakeryShortCodes {
            }
        }
    }

    function venedor_vc_shortcode_sw_featured_products() {
        $vc_icon = venedor_vc_icon().'product.png';
        $animation_type = venedor_vc_animation_type();
        $animation_duration = venedor_vc_animation_duration();
        $animation_delay = venedor_vc_animation_delay();
        $custom_class = venedor_vc_custom_class();

        vc_map( array(
            "name" => "SW Featured Products",
            "base" => "sw_featured_products",
            "category" => "Venedor",
            "icon" => $vc_icon,
            "params" => array(
                array(
                    "type" => "textfield",
                    "heading" => "Title",
                    "param_name" => "title",
                    "admin_label" => true
                ),
                array(
                    "type" => "textarea",
                    "heading" => "Description",
                    "param_name" => "desc"
                ),
                array(
                    "type" => "textfield",
                    "heading" => "Products Count",
                    "param_name" => "products",
                    "value" => "8",
                    "admin_label" => true
                ),
                array(
                    "type" => "textfield",
                    "heading" => "Category IDs",
                    "param_name" => "cats",
                    "value" => "",
                    "admin_label" => true
                ),
                array(
                    "type" => "view_mode",
                    "heading" => "View Mode",
                    "param_name" => "view",
                    "value" => "grid",
                    "admin_label" => true
                ),
                array(
                    "type" => "orderby",
                    "heading" => "Order By",
                    "param_name" => "orderby"
                ),
                array(
                    "type" => "order",
                    "heading" => "Order",
                    "param_name" => "order"
                ),
                array(
                    "type" => "boolean",
                    "heading" => "Single View",
                    "param_name" => "single",
                    "value" => "false"
                ),
                array(
                    'type' => 'dropdown',
                    'heading' => "Arrow Position",
                    'param_name' => 'arrow_pos',
                    'value' => array("" => "", "Top" => "arrow-top", "Bottom" => "arrow-bottom"),
                    'description' => ''
                ),
                $animation_type,
                $animation_duration,
                $animation_delay,
                $custom_class
            )
        ) );

        if ( class_exists( 'WPBakeryShortCodes' ) ) {
            class WPBakeryShortCode_Sw_Featured_Products extends WPBakeryShortCodes {
            }
        }
    }

    function venedor_vc_shortcode_sw_sale_products() {
        $vc_icon = venedor_vc_icon().'product.png';
        $animation_type = venedor_vc_animation_type();
        $animation_duration = venedor_vc_animation_duration();
        $animation_delay = venedor_vc_animation_delay();
        $custom_class = venedor_vc_custom_class();

        vc_map( array(
            "name" => "SW Sale Products",
            "base" => "sw_sale_products",
            "category" => "Venedor",
            "icon" => $vc_icon,
            "params" => array(
                array(
                    "type" => "textfield",
                    "heading" => "Title",
                    "param_name" => "title",
                    "admin_label" => true
                ),
                array(
                    "type" => "textarea",
                    "heading" => "Description",
                    "param_name" => "desc"
                ),
                array(
                    "type" => "textfield",
                    "heading" => "Products Count",
                    "param_name" => "products",
                    "value" => "8",
                    "admin_label" => true
                ),
                array(
                    "type" => "textfield",
                    "heading" => "Category IDs",
                    "param_name" => "cats",
                    "value" => "",
                    "admin_label" => true
                ),
                array(
                    "type" => "view_mode",
                    "heading" => "View Mode",
                    "param_name" => "view",
                    "value" => "grid",
                    "admin_label" => true
                ),
                array(
                    "type" => "orderby",
                    "heading" => "Order By",
                    "param_name" => "orderby"
                ),
                array(
                    "type" => "order",
                    "heading" => "Order",
                    "param_name" => "order"
                ),
                array(
                    "type" => "boolean",
                    "heading" => "Single View",
                    "param_name" => "single",
                    "value" => "false"
                ),
                array(
                    'type' => 'dropdown',
                    'heading' => "Arrow Position",
                    'param_name' => 'arrow_pos',
                    'value' => array("" => "", "Top" => "arrow-top", "Bottom" => "arrow-bottom"),
                    'description' => ''
                ),
                $animation_type,
                $animation_duration,
                $animation_delay,
                $custom_class
            )
        ) );

        if ( class_exists( 'WPBakeryShortCodes' ) ) {
            class WPBakeryShortCode_Sw_Sale_Products extends WPBakeryShortCodes {
            }
        }
    }

    function venedor_vc_shortcode_sw_latest_products() {
        $vc_icon = venedor_vc_icon().'product.png';
        $animation_type = venedor_vc_animation_type();
        $animation_duration = venedor_vc_animation_duration();
        $animation_delay = venedor_vc_animation_delay();
        $custom_class = venedor_vc_custom_class();

        vc_map( array(
            "name" => "SW Latest Products",
            "base" => "sw_latest_products",
            "category" => "Venedor",
            "icon" => $vc_icon,
            "params" => array(
                array(
                    "type" => "textfield",
                    "heading" => "Title",
                    "param_name" => "title",
                    "admin_label" => true
                ),
                array(
                    "type" => "textarea",
                    "heading" => "Description",
                    "param_name" => "desc"
                ),
                array(
                    "type" => "textfield",
                    "heading" => "Products Count",
                    "param_name" => "products",
                    "value" => "8",
                    "admin_label" => true
                ),
                array(
                    "type" => "textfield",
                    "heading" => "Category IDs",
                    "param_name" => "cats",
                    "value" => "",
                    "admin_label" => true
                ),
                array(
                    "type" => "view_mode",
                    "heading" => "View Mode",
                    "param_name" => "view",
                    "value" => "grid",
                    "admin_label" => true
                ),
                array(
                    "type" => "orderby",
                    "heading" => "Order By",
                    "param_name" => "orderby"
                ),
                array(
                    "type" => "order",
                    "heading" => "Order",
                    "param_name" => "order"
                ),
                array(
                    "type" => "boolean",
                    "heading" => "Single View",
                    "param_name" => "single",
                    "value" => "false"
                ),
                array(
                    'type' => 'dropdown',
                    'heading' => "Arrow Position",
                    'param_name' => 'arrow_pos',
                    'value' => array("" => "", "Top" => "arrow-top", "Bottom" => "arrow-bottom"),
                    'description' => ''
                ),
                $animation_type,
                $animation_duration,
                $animation_delay,
                $custom_class
            )
        ) );

        if ( class_exists( 'WPBakeryShortCodes' ) ) {
            class WPBakeryShortCode_Sw_Latest_Products extends WPBakeryShortCodes {
            }
        }
    }
}