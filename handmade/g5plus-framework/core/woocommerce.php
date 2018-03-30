<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 6/8/2015
 * Time: 3:24 PM
 */
if ( class_exists( 'WooCommerce' ) ) {
    global $g5plus_options;
    /*================================================
    FILTER HOOK
    ================================================== */
    remove_action('woocommerce_shop_loop_item_title','woocommerce_template_loop_product_title',10);
    add_action('woocommerce_after_shop_loop_item_title','woocommerce_template_loop_product_title',6);

    /*================================================
    RESET LOOP
    ================================================== */
    if (!function_exists('g5plus_woocommerce_reset_loop')) {
        function g5plus_woocommerce_reset_loop() {
            global $g5plus_woocommerce_loop;
            $g5plus_woocommerce_loop['layout'] = '';
            $g5plus_woocommerce_loop['single_columns'] = '';
            $g5plus_woocommerce_loop['columns'] = '';
	        $g5plus_woocommerce_loop['rating'] = '';
            $g5plus_woocommerce_loop['autoPlay'] = 'false';
            $g5plus_woocommerce_loop['transitionStyle'] = 'false';
            $g5plus_woocommerce_loop['autoHeight'] = 'false';
        }
    }

    /*================================================
    LOOP CATEGORY TEMPLATE
    ================================================== */
    if (!function_exists('g5plus_woocommerce_template_loop_category')) {
        function g5plus_woocommerce_template_loop_category() {
            wc_get_template( 'loop/category.php' );
        }
        //add_action('woocommerce_after_shop_loop_item_title','g5plus_woocommerce_template_loop_category',1);
    }

    /*================================================
    LOOP LINK TEMPLATE
    ================================================== */
    if (!function_exists('g5plus_woocomerce_template_loop_link')) {
        function g5plus_woocomerce_template_loop_link() {
            wc_get_template( 'loop/link.php' );
        }
        add_action('woocommerce_before_shop_loop_item_title','g5plus_woocomerce_template_loop_link',20);
    }

	/*================================================
    QUICK VIEW TEMPLATE
    ================================================== */
	if (!function_exists('g5plus_woocomerce_template_loop_quick_view')) {
		function g5plus_woocomerce_template_loop_quick_view() {
			wc_get_template( 'loop/quick-view.php' );
		}
		add_action('g5plus_woocommerce_product_actions','g5plus_woocomerce_template_loop_quick_view',15);
	}

    /*================================================
    WHISHLIST TEMPLATE
    ================================================== */
    if (!function_exists('g5plus_woocomerce_template_loop_wishlist')) {
        function g5plus_woocomerce_template_loop_wishlist() {
            wc_get_template( 'loop/wishlist.php' );
        }
        add_action('g5plus_woocommerce_product_actions','g5plus_woocomerce_template_loop_wishlist',10);
    }

    /*================================================
  COMPARE TEMPLATE
  ================================================== */
    if (!function_exists('g5plus_woocomerce_template_loop_compare')) {
        function g5plus_woocomerce_template_loop_compare() {
            wc_get_template( 'loop/compare.php' );
        }
        add_action('g5plus_woocommerce_product_actions','g5plus_woocomerce_template_loop_compare',5);
    }









    /*================================================
    FILTER PRODUCTS PER PAGE
    ================================================== */
    if (!function_exists('g5plus_show_products_per_page')) {
        function g5plus_show_products_per_page() {
            global $g5plus_options;
            $product_per_page = $g5plus_options['product_per_page'];
            if (empty($product_per_page)) {
                $product_per_page = 12;
            }
            $page_size = isset($_GET['page_size']) ? wc_clean($_GET['page_size']) : $product_per_page;
            return $page_size;
        }
        add_filter('loop_shop_per_page', 'g5plus_show_products_per_page');
    }


    /*================================================
    OVERWRITE LOOP PRODUCT THUMBNAIL
    ================================================== */
    if (!function_exists('woocommerce_template_loop_product_thumbnail')) {
        /**
         * Get the product thumbnail for the loop.
         *
         * @access public
         * @subpackage    Loop
         * @return void
         */
        function woocommerce_template_loop_product_thumbnail() {
            global $product;
            $attachment_ids  = $product->get_gallery_attachment_ids();
            $secondary_image = '';
            $class           = 'product-thumb-one';
            $post_thumbnail_id = '';
            if (has_post_thumbnail()) {
                $post_thumbnail_id = get_post_thumbnail_id();
            }


            $secondary_image_id = '';



            if ($product->product_type == 'variable') {
                $available_variations = $product->get_available_variations();
                if (isset($available_variations)){
                    foreach ($available_variations as $available_variation){
                        $variation_id = $available_variation['variation_id'];
                        if (has_post_thumbnail($variation_id)) {
                            $variation_image_id = get_post_thumbnail_id($variation_id);
                            if ($variation_image_id != $post_thumbnail_id) {
                                $secondary_image_id = $variation_image_id;
                                break;
                            }
                        }
                    }
                }
            }



            if (($secondary_image_id == '') && isset($attachment_ids) && isset($attachment_ids['0'])) {
                $secondary_image_id = $attachment_ids['0'];
            }



	        if (!empty($secondary_image_id)) {
		        $secondary_image    = wp_get_attachment_image( $secondary_image_id, apply_filters( 'shop_catalog', 'shop_catalog' ) );
		        if ( ! empty( $secondary_image ) ) {
			        $class = 'product-thumb-primary';
		        }
	        }
            ?>
            <?php if ( has_post_thumbnail() ) : ?>
                <div class="<?php echo esc_attr( $class ); ?>">
                    <?php echo woocommerce_get_product_thumbnail(); ?>
                </div>
                <?php if ( ! empty( $secondary_image ) ) : ?>
                    <div class="product-thumb-secondary">
                        <?php echo wp_kses_post( $secondary_image ); ?>
                    </div>
                <?php endif; ?>
            <?php endif; ?>
        <?php
        }
    }

    /*================================================
   OVERWRITE LOOP PRODUCT CREATIVE THUMBNAIL
   ================================================== */
    if (!function_exists('woocommerce_template_loop_product_creative_thumbnail')) {
        /**
         * Get the product thumbnail for the loop.
         *
         * @access public
         * @subpackage    Loop
         * @return void
         */
        function woocommerce_template_loop_product_creative_thumbnail() {
            global $product;

            $post_attachment_id = has_post_thumbnail() ?  get_post_thumbnail_id(): 0;
            $attachment_ids  = $product->get_gallery_attachment_ids();
            $secondary_image = $primary_image = '';
            $class           = 'product-thumb-one';

            $secondary_image_id = '';
            if (isset($attachment_ids) && isset($attachment_ids['0'])) {
                $secondary_image_id = $attachment_ids['0'];
            }
            $width_mobile = $width = 570;
            $height_mobile = $height = 570;


            $matrix = array(
                '2' => array(
                    array(2,1,1.5),
                    array(1,1,1)
                ),
                '3' => array(
                    array(2,1,1),
                    array(2,1,1)
                )
            );
            global $g5plus_woocommerce_loop;
            $index = $g5plus_woocommerce_loop['post_index'];
            $columns = $g5plus_woocommerce_loop['columns'];
            if($columns==2){
                $index_row = floor(($index-1) / 3)%2;
                $index_col = ($index-1) % 3;
                if($index_row==1 && $index_col==2)
                {
                    $g5plus_woocommerce_loop['post_index'] = 1;
                    $index_row = 0;
                    $index_col = 0;
                }
                if($matrix[$columns][$index_row][$index_col]==1.5){
                    $width = 270;
                    $height = 468;
                }
            }
            if (!empty($secondary_image_id)) {
                $secondary_image = matthewruddy_image_resize_id($secondary_image_id, $width, $height);
                if ( ! empty( $secondary_image ) ) {
                    $class = 'product-thumb-primary';
                }
                if($columns==2 && $matrix[$columns][$index_row][$index_col]==1.5){
                    $secondary_image_mobile =  matthewruddy_image_resize_id($secondary_image_id, $width_mobile, $height_mobile);
                }
            }
            if($post_attachment_id>0){
                $primary_image = matthewruddy_image_resize_id($post_attachment_id, $width, $height);
                if($columns==2 && $matrix[$columns][$index_row][$index_col]==1.5){
                    $primary_image_mobile =  matthewruddy_image_resize_id($post_attachment_id, $width_mobile, $height_mobile);
                }
            }else{
                $primary_image = $secondary_image;
            }
            ?>
            <?php if ( has_post_thumbnail() ) : ?>
                <div class="<?php echo esc_attr( $class ); ?>">
                   <img class="attachment-shop_catalog wp-post-image" width="<?php echo esc_attr($width) ?>" height="<?php echo esc_attr($height) ?>" alt="<?php echo esc_attr($product->get_title()) ?>" src="<?php echo esc_url($primary_image) ?>">
                   <?php if($columns==2 && $matrix[$columns][$index_row][$index_col]==1.5){?>
                       <img class="attachment-shop_catalog wp-post-image mobile-mode" width="<?php echo esc_attr($width) ?>" height="<?php echo esc_attr($height) ?>" alt="<?php echo esc_attr($product->get_title()) ?>" src="<?php echo esc_url($primary_image_mobile) ?>">
                   <?php }?>
                </div>
            <?php endif; ?>
        <?php
        }
    }

    /*================================================
    SINGLE PRODUCT
    ================================================== */


    if (!function_exists('g5plus_related_products_args')) {
        function g5plus_related_products_args() {
	        global $g5plus_options;
	        $args['posts_per_page'] = isset($g5plus_options['related_product_count']) ? $g5plus_options['related_product_count'] :  8;
	        return $args;
        }
        add_filter('woocommerce_output_related_products_args', 'g5plus_related_products_args');
    }

	if (!function_exists('g5plus_woocommerce_product_related_posts_relate_by_category')) {
		function g5plus_woocommerce_product_related_posts_relate_by_category() {
			global $g5plus_options;
			return $g5plus_options['related_product_condition']['category'] == 1 ? true : false;
		}
		add_filter('woocommerce_product_related_posts_relate_by_category','g5plus_woocommerce_product_related_posts_relate_by_category');
	}

	if (!function_exists('g5plus_woocommerce_product_related_posts_relate_by_tag')) {
		function g5plus_woocommerce_product_related_posts_relate_by_tag() {
			global $g5plus_options;
			return $g5plus_options['related_product_condition']['tag'] == 1 ? true : false;
		}
		add_filter('woocommerce_product_related_posts_relate_by_tag','g5plus_woocommerce_product_related_posts_relate_by_tag');
	}


    /*================================================
    SHOPPING CART
    ================================================== */
    remove_action('woocommerce_cart_collaterals','woocommerce_cross_sell_display');
    add_action( 'woocommerce_after_cart', 'woocommerce_cross_sell_display',15 );
    add_action('woocommerce_before_cart_totals','woocommerce_shipping_calculator',5);

    if (!function_exists('g5plus_button_continue_shopping')) {
        function g5plus_button_continue_shopping () {
            $continue_shopping =  get_permalink( wc_get_page_id( 'shop' ) );
            ?>
            <a href="<?php echo esc_url($continue_shopping); ?>" class="continue-shopping button"><?php esc_html_e( 'Continue shopping', 'g5plus-handmade' ); ?></a>
            <?php
        }
    }

    /*================================================
	SALE FLASH MODE
	================================================== */
    if (!function_exists('g5plus_woocommerce_sale_flash')) {
        function g5plus_woocommerce_sale_flash($sale_flash,$post,$product) {
            global $g5plus_options;
            $product_sale_flash_mode = isset($g5plus_options['product_sale_flash_mode']) ? $g5plus_options['product_sale_flash_mode'] : '' ;
            if ($product_sale_flash_mode == 'percent') {
                $sale_percent = 0;
                if ($product->is_on_sale() && $product->product_type != 'grouped') {
                    if ($product->product_type == 'variable') {
                        $available_variations =  $product->get_available_variations();
                        for ($i = 0; $i < count($available_variations); ++$i) {
                            $variation_id = $available_variations[$i]['variation_id'];
                            $variable_product1 = new WC_Product_Variation( $variation_id );
                            $regular_price = $variable_product1->get_regular_price();
                            $sales_price = $variable_product1->get_sale_price();
                            $price = $variable_product1->get_price();
                            if ( $sales_price != $regular_price && $sales_price == $price ) {
                                $percentage= round((( ( $regular_price - $sales_price ) / $regular_price ) * 100),1) ;
                                if ($percentage > $sale_percent) {
                                    $sale_percent = $percentage;
                                }
                            }
                        }
                    } else {
                        $sale_percent = round((( ( $product->get_regular_price() - $product->get_sale_price() ) / $product->get_regular_price() ) * 100),1) ;
                    }
                }
                if ($sale_percent > 0) {
                    return '<span class="on-sale product-flash">' . $sale_percent . '%</span>';
                } else {
                    return "";
                }

            }
            return $sale_flash;
        }
        add_filter('woocommerce_sale_flash','g5plus_woocommerce_sale_flash',10,3);
    }

	/*================================================
	QUICK VIEW
	================================================== */
	add_action('g5plus_before_quick_view_product_summary','woocommerce_show_product_sale_flash',10);

	if (!function_exists('g5plus_quick_view_product_images')) {
		function g5plus_quick_view_product_images() {
			wc_get_template('quick-view/product-image.php');
		}
		add_action('g5plus_before_quick_view_product_summary','g5plus_quick_view_product_images',20);
	}

    if (!function_exists('g5plus_template_quick_view_product_title')) {
        function g5plus_template_quick_view_product_title() {
            wc_get_template( 'quick-view/title.php' );
        }
        add_action('g5plus_quick_view_product_summary','g5plus_template_quick_view_product_title',5);
    }

    if (!function_exists('g5plus_template_quick_view_product_rating')) {
        function g5plus_template_quick_view_product_rating() {
            wc_get_template( 'quick-view/rating.php' );
        }
        add_action('g5plus_quick_view_product_summary','g5plus_template_quick_view_product_rating',15);
    }

    add_action('g5plus_quick_view_product_summary','woocommerce_template_single_price',10);
    add_action('g5plus_quick_view_product_summary','woocommerce_template_single_excerpt',20);
    add_action('g5plus_quick_view_product_summary','woocommerce_template_single_add_to_cart',30);
    add_action('g5plus_quick_view_product_summary','woocommerce_template_single_meta',40);
    add_action('g5plus_quick_view_product_summary','woocommerce_template_single_sharing',50);


    /*================================================
	CUSTOM WOOCOMERCE CATALOG ORDERING
	================================================== */
    remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
    remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );

    add_action( 'g5plus_before_shop_loop', 'woocommerce_result_count', 20 );
    add_action( 'g5plus_before_shop_loop', 'woocommerce_catalog_ordering', 30 );


    /*================================================
	CATALOG PAGE SIZE
	================================================== */
    if (!function_exists('g5plus_woocommerce_catalog_page_size')) {
        function g5plus_woocommerce_catalog_page_size() {
            wc_get_template('loop/page-size.php');
        }
        add_action('g5plus_before_shop_loop','g5plus_woocommerce_catalog_page_size',25);
    }

    /*================================================
	SHOP PAGE CONTENT
	================================================== */
    if (!function_exists('g5plus_shop_page_content')) {
        function g5plus_shop_page_content() {
            global $g5plus_options;
            $show_page_shop_content = isset($g5plus_options['show_page_shop_content']) ? $g5plus_options['show_page_shop_content'] : '0';
            if ($show_page_shop_content == '0') return;
            $page_shop_id =  wc_get_page_id('shop');
            if ($page_shop_id == -1) return;
            $myClass = array('shop-page-content-wrapper');
            $myClass[] = 'shop-page-content-'.$show_page_shop_content;
            $query = new WP_Query('page_id='.$page_shop_id);
            if ($query->have_posts()) {
                ?>
                    <div class="<?php echo join(' ',$myClass) ?>">
                        <?php while ($query->have_posts()) : $query->the_post() ; ?>
                            <?php the_content(); ?>
                        <?php endwhile; ?>
                    </div>
                <?php
            }
            wp_reset_postdata();
        }
        $show_page_shop_content = isset($g5plus_options['show_page_shop_content']) ? $g5plus_options['show_page_shop_content'] : '0';
        if ($show_page_shop_content == 'before') {
            add_action('g5plus_before_archive_product_listing','g5plus_shop_page_content',5);
        }

        if ($show_page_shop_content == 'after') {
            add_action('g5plus_after_archive_product_listing','g5plus_shop_page_content',5);
        }

    }


    /*================================================
    SINGLE PRODUCT FUNCTIONS
    ================================================== */
    if (!function_exists('g5plus_woocommerce_template_single_function')) {
        function g5plus_woocommerce_template_single_function() {
            wc_get_template( 'single-product/product-function.php' );
        }
        add_action('woocommerce_single_product_summary','g5plus_woocommerce_template_single_function',35);
    }

    /*================================================
    PRODUCT ADD TO CART OPTIONS
    ================================================== */
    $product_add_to_cart = isset($g5plus_options['product_add_to_cart']) ? $g5plus_options['product_add_to_cart'] : '1';
    if ($product_add_to_cart == '1') {
        add_action('g5plus_woocommerce_product_actions','woocommerce_template_loop_add_to_cart',20);
    }
    if ($product_add_to_cart == '0') {
        remove_action('woocommerce_single_product_summary','woocommerce_template_single_add_to_cart',30);
    }

    /*Add meta New*/
    /*================================================
    ADD META NEW - HOT
    ================================================== */
    // Display Fields
    if (!function_exists('g5plus_woocommerce_add_custom_general_fields')) {
        function g5plus_woocommerce_add_custom_general_fields() {
            echo '<div class="options_group">';
            woocommerce_wp_checkbox(
                array(
                    'id' => 'g5plus_product_new',
                    'label' => esc_html__('Product New', 'g5plus-handmade')
                )
            );
            woocommerce_wp_checkbox(
                array(
                    'id' => 'g5plus_product_hot',
                    'label' => esc_html__('Product Hot', 'g5plus-handmade')
                )
            );
            echo '</div>';
        }
        add_action('woocommerce_product_options_general_product_data', 'g5plus_woocommerce_add_custom_general_fields');
    }

    // Save Fields
    if (!function_exists('g5plus_woocommerce_add_custom_general_fields_save')) {
        function g5plus_woocommerce_add_custom_general_fields_save($post_id) {
            $g5plus_product_new = isset($_POST['g5plus_product_new']) ? 'yes' : 'no';
            update_post_meta($post_id, 'g5plus_product_new', $g5plus_product_new);

            $g5plus_product_hot = isset($_POST['g5plus_product_hot']) ? 'yes' : 'no';
            update_post_meta($post_id, 'g5plus_product_hot', $g5plus_product_hot);
        }
        add_action('woocommerce_process_product_meta', 'g5plus_woocommerce_add_custom_general_fields_save');
    }

    //Add custom column into Product Page
    if (!function_exists('g5plus_columns_into_product_list')) {
        function g5plus_columns_into_product_list($defaults) {
            $defaults['g5plus_product_new'] = esc_html__('New','g5plus-handmade');
            $defaults['g5plus_product_hot'] = esc_html__('Hot','g5plus-handmade');
            return $defaults;
        }
        add_filter('manage_edit-product_columns', 'g5plus_columns_into_product_list');
    }


    //Add rows value into Product Page
    if (!function_exists('g5plus_column_into_product_list')) {
        function g5plus_column_into_product_list($column, $post_id) {
            switch ($column) {
                case 'g5plus_product_new':
                    echo get_post_meta($post_id, 'g5plus_product_new', true);
                    break;
                case 'g5plus_product_hot':
                    echo get_post_meta($post_id, 'g5plus_product_hot', true);
                    break;
            }
        }
        add_action('manage_product_posts_custom_column', 'g5plus_column_into_product_list', 10, 2);
    }



    // Make these columns sortable
    if (!function_exists('g5plus_sortable_columns')) {
        function g5plus_sortable_columns() {
            return array(
                'g5plus_product_new' => 'g5plus_product_new',
                'g5plus_product_hot' => 'g5plus_product_hot'
            );
        }
        //add_filter("manage_edit-product_sortable_columns", "g5plus_sortable_columns");
    }

    if (!function_exists('g5plus_event_column_orderby')) {
        function g5plus_event_column_orderby($query) {
            if (!is_admin()) return;
            $orderby = $query->get('orderby');
            if ('g5plus_product_new' == $orderby) {
                $query->set('meta_key', 'g5plus_product_new');
                $query->set('orderby', 'meta_value_num');
            }

            if ('g5plus_product_hot' == $orderby) {
                $query->set('meta_key', 'g5plus_product_hot');
                $query->set('orderby', 'meta_value_num');
            }
        }
       // add_action('pre_get_posts', 'g5plus_event_column_orderby');
    }
    /*================================================
    ADD META NEW - HOT END
    ================================================== */

    /*================================================
    ADVANCED SEARCH CATEGORY
    ================================================== */
    if (!function_exists('g5plus_advanced_search_category_query')) {
        function g5plus_advanced_search_category_query($query) {
            if($query->is_search()) {
                // category terms search.
                if (isset($_GET['product_cat']) && !empty($_GET['product_cat'])) {
                    $query->set('tax_query', array(array(
                        'taxonomy' => 'product_cat',
                        'field' => 'slug',
                        'terms' => array($_GET['product_cat']) )
                    ));
                }
                return $query;
            }
        }
        add_action('pre_get_posts', 'g5plus_advanced_search_category_query', 1000);
    }

    /*================================================
    SHARE
    ================================================== */
    add_action('woocommerce_share','g5plus_share',10);

    if (!function_exists('g5plus_woocommerce_checkout_title')) {
        function g5plus_woocommerce_checkout_title() {
            wc_get_template( 'checkout/title.php');
        }
        add_action('woocommerce_before_checkout_form','g5plus_woocommerce_checkout_title',5);
    }


    if (!function_exists('g5plus_woocommerce_before_customer_login_form')) {
        function g5plus_woocommerce_before_customer_login_form() {
            echo '<div class="customer_login_form_wrap">';
        }
        add_action('woocommerce_before_customer_login_form','g5plus_woocommerce_before_customer_login_form',10);
    }

    if (!function_exists('g5plus_woocommerce_after_customer_login_form')) {
        function g5plus_woocommerce_after_customer_login_form() {
            echo '</div>';
        }
        add_action('woocommerce_after_customer_login_form','g5plus_woocommerce_after_customer_login_form',10);
    }

    /*================================================
    FIX 2.5.0
    ================================================== */
    if (  ! function_exists( 'woocommerce_template_loop_product_title' ) ) {
        /**
         * Show the product title in the product loop. By default this is an H3.
         */
        function woocommerce_template_loop_product_title() {
            wc_get_template( 'loop/title.php' );
        }
    }

    if (defined('WOOCOMMERCE_VERSION') && version_compare(WOOCOMMERCE_VERSION,'2.5.0','<')) {
        if (!function_exists('woocommerce_template_loop_add_to_cart')) {
            function woocommerce_template_loop_add_to_cart( $args = array() ) {
                global $product;
                if ( $product ) {
                    $ajax_cart_en         = 'yes' === get_option( 'woocommerce_enable_ajax_add_to_cart' );
                    $defaults = array(
                        'quantity' => 1,
                        'class'    => implode( ' ', array_filter( array(
                            'button',
                            'product_type_' . $product->product_type,
                            $product->is_purchasable() && $product->is_in_stock() ? 'add_to_cart_button' : '',
                            $ajax_cart_en ? 'ajax_add_to_cart' : ''
                        ) ) )
                    );

                    $args = apply_filters( 'woocommerce_loop_add_to_cart_args', wp_parse_args( $args, $defaults ), $product );

                    wc_get_template( 'loop/add-to-cart.php', $args );
                }
            }
        }
    }
}
