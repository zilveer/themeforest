<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 6/8/2015
 * Time: 3:24 PM
 */
if ( class_exists( 'WooCommerce' ) ) {
    /*================================================
    FILTER HOOK
    ================================================== */
    remove_action('woocommerce_after_shop_loop_item_title','woocommerce_template_loop_rating',5);
    remove_action('woocommerce_after_shop_loop_item_title','woocommerce_template_loop_price', 10);
    add_action('woocommerce_shop_loop_item_title','woocommerce_template_loop_price', 15);

    /*================================================
    RESET LOOP
    ================================================== */
    if (!function_exists('g5plus_woocommerce_reset_loop')) {
        function g5plus_woocommerce_reset_loop() {
            $g5plus_woocommerce_loop = &G5Plus_Global::get_woocommerce_loop();
            $g5plus_woocommerce_loop['layout'] = '';
            $g5plus_woocommerce_loop['single_columns'] = '';
            $g5plus_woocommerce_loop['columns'] = '';
	        $g5plus_woocommerce_loop['rating'] = '';
            $g5plus_woocommerce_loop['autoPlay'] = 'false';
            $g5plus_woocommerce_loop['animateOut'] = 'false';
            $g5plus_woocommerce_loop['animateIn'] = 'false';
            $g5plus_woocommerce_loop['autoHeight'] = 'false';
            $g5plus_woocommerce_loop['nav'] = 'false';
            $g5plus_woocommerce_loop['dots'] = 'false';
            $g5plus_woocommerce_loop['view'] = null;
        }
    }

    /*================================================
    RESET SINGLE PRODUCT
    ================================================== */
    if (!function_exists('g5plus_woocommerce_reset_single')) {
        function g5plus_woocommerce_reset_single() {
            global $g5plus_woocommerce_single;
            $g5plus_woocommerce_single['has_sidebar'] = false;
        }
    }

    /*================================================
    LOOP COURSE INFO TEMPLATE
    ================================================== */
    if (!function_exists('g5plus_woocomerce_template_loop_course_info')) {
        function g5plus_woocomerce_template_loop_course_info() {
            wc_get_template( 'loop/course-info.php' );
        }
        add_action('woocommerce_after_shop_loop_item_title','g5plus_woocomerce_template_loop_course_info',20);

    }

    /*================================================
    LOOP LINK TEMPLATE
    ================================================== */
    if (!function_exists('g5plus_woocomerce_template_loop_link')) {
        function g5plus_woocomerce_template_loop_link() {
            wc_get_template( 'loop/link.php' );
        }
        add_action('woocommerce_before_shop_loop_item_title','g5plus_woocomerce_template_loop_link',20);
        add_action('g5plus_woocommerce_after_product_widget_thumb','g5plus_woocomerce_template_loop_link',20);
    }


    /*================================================
     WHISHLIST TEMPLATE
     ================================================== */
    if (!function_exists('g5plus_woocomerce_template_loop_extra')) {
        function g5plus_woocomerce_template_loop_extra() {
            wc_get_template( 'loop/course-extra.php' );
        }
        add_action('g5plus_woocommerce_product_actions','g5plus_woocomerce_template_loop_extra',10);
        add_action('g5plus_woocommerce_product_actions','woocommerce_template_loop_rating',20);
    }
    /*================================================
    FILTER PRODUCTS PER PAGE
    ================================================== */
    if (!function_exists('g5plus_show_products_per_page')) {
        function g5plus_show_products_per_page() {
            $g5plus_options = &G5Plus_Global::get_options();
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

            ?>
            <?php if ( has_post_thumbnail() ) : ?>
                <div class="<?php echo esc_attr( $class ); ?>">
                    <?php echo woocommerce_get_product_thumbnail(); ?>
                </div>
            <?php endif; ?>
        <?php
        }
    }

    /*================================================
    OVERWRITE LOOP PRODUCT TITLE
   ================================================== */
    if (  ! function_exists( 'woocommerce_template_loop_product_title' ) ) {

        /**
         * Show the product title in the product loop. By default this is an H3.
         */
        function woocommerce_template_loop_product_title() {
            echo '<h3 class="product-name"><a href="'.get_permalink().'">' . get_the_title() . '</a></h3>';
        }
    }

    /*================================================
    SINGLE PRODUCT
    ================================================== */


    if (!function_exists('g5plus_related_products_args')) {
        function g5plus_related_products_args() {
	        $g5plus_options = &G5Plus_Global::get_options();
	        $args['posts_per_page'] = isset($g5plus_options['related_product_count']) ? $g5plus_options['related_product_count'] :  8;
	        return $args;
        }
        add_filter('woocommerce_output_related_products_args', 'g5plus_related_products_args');
    }

	if (!function_exists('g5plus_woocommerce_product_related_posts_relate_by_category')) {
		function g5plus_woocommerce_product_related_posts_relate_by_category() {
			$g5plus_options = &G5Plus_Global::get_options();
			return $g5plus_options['related_product_condition']['category'] == 1 ? true : false;
		}
		add_filter('woocommerce_product_related_posts_relate_by_category','g5plus_woocommerce_product_related_posts_relate_by_category');
	}

	if (!function_exists('g5plus_woocommerce_product_related_posts_relate_by_tag')) {
		function g5plus_woocommerce_product_related_posts_relate_by_tag() {
			$g5plus_options = &G5Plus_Global::get_options();
			return $g5plus_options['related_product_condition']['tag'] == 1 ? true : false;
		}
		add_filter('woocommerce_product_related_posts_relate_by_tag','g5plus_woocommerce_product_related_posts_relate_by_tag');
	}

    if (!function_exists('g5plus_woocommerce_product_description_heading')) {
        function g5plus_woocommerce_product_description_heading() {
            return '';
        }
        add_filter('woocommerce_product_description_heading','g5plus_woocommerce_product_description_heading');
    }


    if (!function_exists('g5plus_woocommerce_product_additional_information_heading')) {
        function g5plus_woocommerce_product_additional_information_heading() {
            return '';
        }
        add_filter('woocommerce_product_additional_information_heading','g5plus_woocommerce_product_additional_information_heading');
    }


    if(!function_exists('g5plus_woocommerce_product_share')){
        function g5plus_woocommerce_product_share(){
            remove_action('woocommerce_single_product_summary','woocommerce_template_single_title', 5);
            remove_action('woocommerce_single_product_summary','woocommerce_template_single_rating', 10);
            remove_action('woocommerce_single_product_summary','woocommerce_template_single_price', 10);
            remove_action('woocommerce_single_product_summary','woocommerce_template_single_excerpt', 20);
            remove_action('woocommerce_single_product_summary','woocommerce_template_single_add_to_cart', 30);
            remove_action('woocommerce_single_product_summary','woocommerce_template_single_meta', 40);
            do_action('woocommerce_single_product_summary');
        }
    }

    if (!function_exists('g5plus_woocommerce_review_gravatar_size')) {
        function g5plus_woocommerce_review_gravatar_size() {
            return 100;
        }
        add_filter('woocommerce_review_gravatar_size','g5plus_woocommerce_review_gravatar_size');
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
            <a href="<?php echo esc_url($continue_shopping); ?>" class="continue-shopping button"><?php esc_html_e( 'Continue shopping', 'g5plus-academia' ); ?></a>
            <?php
        }
    }

    /*================================================
	SALE FLASH MODE
	================================================== */
    if (!function_exists('g5plus_woocommerce_sale_flash')) {
        function g5plus_woocommerce_sale_flash($sale_flash,$post,$product) {
	        $g5plus_options = &G5Plus_Global::get_options();
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
	FILTER CATEGORY TEMPLATE
	================================================== */
    if(!function_exists('g5plus_woocommerce_filter_category')){
        function g5plus_woocommerce_filter_category() {
            wc_get_template( 'loop/filter-category.php' );
        }
        remove_action('woocommerce_before_shop_loop','woocommerce_catalog_ordering',30);
        add_action('g5plus_woocommerce_before_shop_filter','g5plus_woocommerce_filter_category',10);
    }

    /*================================================
	FILTER SIDEBAR
	================================================== */
    if (!function_exists('g5plus_woocommerce_filter_sidebar')) {
        function g5plus_woocommerce_filter_sidebar() {
	        $g5plus_options = &G5Plus_Global::get_options();
            $filter_sidebar = $g5plus_options['archive_product_filter_sidebar'];
            ?>
                <div id="product-filter-overlay"></div>
                <div id="product-filter-wrap" class="sidebar">
                    <?php dynamic_sidebar( $filter_sidebar );?>
                </div>
            <?php
        }
    }

    /*================================================
	SHOP PAGE CONTENT
	================================================== */
    if (!function_exists('g5plus_shop_page_content')) {
        function g5plus_shop_page_content() {
	        $g5plus_options = &G5Plus_Global::get_options();
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
                    'label' => esc_html__('Product New', 'g5plus-academia')
                )
            );
            woocommerce_wp_checkbox(
                array(
                    'id' => 'g5plus_product_hot',
                    'label' => esc_html__('Product Hot', 'g5plus-academia')
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
            $defaults['g5plus_product_new'] = esc_html__('New','g5plus-academia');
            $defaults['g5plus_product_hot'] = esc_html__('Hot','g5plus-academia');
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
            if($query->is_search() && !is_admin()) {
                // category terms search.
                if (isset($_GET['product_cat']) && !empty($_GET['product_cat'])) {
                    $query->set('tax_query', array(array(
                        'taxonomy' => 'product_cat',
                        'field' => 'slug',
                        'terms' => array($_GET['product_cat']) )
                    ));
                }
                $course_meta = array();
                if(isset($_GET['location']) && !empty($_GET['location'])){
                    array_push($course_meta,array(
                        'key' => 'location_name',
                        'value' => $_GET['location'],
                        'compare' => 'LIKE'
                    ));
                }
                if(isset($_GET['level']) && !empty($_GET['level'])){
                    array_push($course_meta, array(
                        'key' => 'level',
                        'value' => $_GET['level'],
                        'compare' => '='
                    ));
                }

                if(count($course_meta)>0){
                    $query->set('meta_query', $course_meta);
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



    if(!function_exists('g5plus_after_single_product_summary')){
        function g5plus_after_single_product_summary(){
            $tabs = apply_filters( 'woocommerce_product_tabs', array() );
            $tab_display = array('description','reviews');
            foreach ( $tabs as $key => $tab ) :
                if(in_array($key,$tab_display)):
            ?>
                <div id="tab-<?php echo esc_attr( $key ); ?>">
                    <?php call_user_func( $tab['callback'], $key, $tab ); ?>
                </div>
            <?php
                endif;
                endforeach;
        }
        remove_action('woocommerce_after_single_product_summary','woocommerce_output_product_data_tabs',10);
        remove_action('woocommerce_after_single_product_summary','woocommerce_upsell_display',15);
        remove_action('woocommerce_after_single_product_summary','woocommerce_output_related_products',20);
        add_action( 'woocommerce_after_single_product_summary', 'g5plus_after_single_product_summary', 10 );
    }

    // Change single button text add to cart
    add_filter( 'woocommerce_product_single_add_to_cart_text', 'g5plus_custom_cart_button_text' );    // 2.1 +
    function g5plus_custom_cart_button_text() {
        return esc_html__( 'Enroll this Course Now', 'g5plus-academia' );
    }

    if(!function_exists('g5plus_course_filter_start_date_query')){
        function g5plus_course_filter_start_date_query($query){
            $is_product_seach = is_tax( 'product_cat' ) ||  $query->get('post_type')=='product';
            if( !is_admin() && $is_product_seach){
                $meta = array(
                    array(
                        'key' => 'start',
                        'value'=>date("Y-m-d"),
                        'compare'=>'>',
                        'type'=>'date',
                    ),
                );
                $query->set('meta_query',$meta);
            }
        }
        $g5plus_options = G5Plus_Global::get_options();
        if(isset($g5plus_options['filter_archive_product_start_date']) && $g5plus_options['filter_archive_product_start_date']=='1'){
            add_action('pre_get_posts', 'g5plus_course_filter_start_date_query', 10);
        }
    }

    function get_course_level(){
        $g5plus_options = G5Plus_Global::get_options();
        if(array_key_exists('course_level',$g5plus_options)){
            $levels = explode('|',$g5plus_options['course_level']);
            $course_level = array();
            foreach($levels as $level){
                $course_level[$level] = $level;
            }
            return $course_level;
        }else
            return array();

    }

    function get_course_location(){
        $g5plus_options = G5Plus_Global::get_options();
        if(array_key_exists('course_location',$g5plus_options)){
            $locations = explode('|',$g5plus_options['course_location']);
            $course_location = array();
            foreach($locations as $location){
                $course_location[$location] = $location;
            }
            return $course_location;
        }else{
            return array();
        }

    }
}
