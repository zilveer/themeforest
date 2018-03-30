<?php
/**
 * @package WordPress
 * @subpackage BuddyApp
 * @author SeventhQueen <themesupport@seventhqueen.com>
 * @since 1.1
 */



/***************************************************
:: Theme options
 ***************************************************/

add_filter( 'kleo_theme_settings', 'kleo_woo_settings' );

function kleo_woo_settings( $kleo ) {
    //
    // Settings Sections
    //

    $kleo['sec']['kleo_section_woo'] = array(
        'title'    => esc_html__( 'WooCommerce', 'buddyapp' ),
        'priority' => 40
    );


    //
    // Woocommerce settings
    //

    $kleo['set'][] = array(
        'id'          => 'woo_sidebar',
        'type'        => 'select',
        'title'       => esc_html__( 'Woocommerce Pages Layout', 'buddyapp' ),
        'default'     => 'default',
        'choices' => array(
            'default' => esc_html__( 'Default site layout', 'buddyapp'),
            'no' => esc_html__( 'Full width', 'buddyapp'),
            'left' => esc_html__( 'Left Sidebar', 'buddyapp'),
            'right' => esc_html__( 'Right Sidebar', 'buddyapp'),
        ),
        'section'     => 'kleo_section_woo',
        'description' => esc_html__( 'Select the default layout to use in Woocommerce pages.', 'buddyapp' ),
        'customizer'  => false,
    );

    $kleo['set'][] = array(
        'id'          => 'woo_cat_sidebar',
        'type'        => 'select',
        'title'       => esc_html__( 'Woocommerce Category Layout', 'buddyapp' ),
        'default'     => 'default',
        'choices' => array(
            'default' => esc_html__( 'Default as set above', 'buddyapp'),
            'no' => esc_html__( 'Full width', 'buddyapp'),
            'left' => esc_html__( 'Left Sidebar', 'buddyapp'),
            'right' => esc_html__( 'Right Sidebar', 'buddyapp'),
        ),
        'section'     => 'kleo_section_woo',
        'description' => esc_html__( 'Select the layout to use in Woocommerce product listing pages.', 'buddyapp' ),
        'customizer'  => false,
    );

    $kleo['set'][] = array(
        'id'          => 'woo_catalog',
        'type'        => 'switch',
        'title'       => esc_html__( 'Enable Catalog mode', 'buddyapp' ),
        'default'     => '0',
        'section'     => 'kleo_section_woo',
        'description' => esc_html__( 'If you enable catalog mode will disable Add To Cart buttons, Checkout and Shopping cart.', 'buddyapp' ),
        'customizer'  => false,
    );

    $kleo['set'][] = array(
        'id'          => 'woo_disable_prices',
        'type'        => 'switch',
        'title'       => esc_html__( 'Disable prices', 'buddyapp' ),
        'default'     => '0',
        'section'     => 'kleo_section_woo',
        'description' => esc_html__( 'Disable prices on category pages and product page.', 'buddyapp' ),
        'customizer'  => false,
        'condition' => array( 'woo_catalog', 1 )
    );


    return $kleo;

/* TODO
        array(
            'id' => 'woo_shop_columns',
            'type' => 'select',
            'title' => __('Shop Products Columns', 'kleo_framework'),
            'subtitle' => __('Select the number of columns to use for products display.', 'kleo_framework'),
            'options' => array(
                '3' => '3',
                '4' => '4',
                '5' => '5',
                '6' => '6'
            ),
            'default' => '3'
        ),
        array(
            'id' => 'woo_shop_products',
            'type' => 'text',
            'title' => __('Shop Products per page', 'kleo_framework'),
            'subtitle' => __('How many products to show per page', 'kleo_framework'),
            'default' => '15' // 1 = checked | 0 = unchecked
        ),
        array(
            'id' => 'woo_related_columns',
            'type' => 'select',
            'title' => __('Related Products number', 'kleo_framework'),
            'subtitle' => __('Select the number of related products to show on product page.', 'kleo_framework'),
            'options' => array(
                '3' => '3',
                '4' => '4',
                '5' => '5',
                '6' => '6'
            ),
            'default' => '3'
        ),
        array(
            'id' => 'woo_upsell_columns',
            'type' => 'select',
            'title' => __('Upsell Products number', 'kleo_framework'),
            'subtitle' => __('Select the number of upsell products to show on product page.', 'kleo_framework'),
            'options' => array(
                '3' => '3',
                '4' => '4',
                '5' => '5',
                '6' => '6'
            ),
            'default' => '3'
        ),
        array(
            'id' => 'woo_cross_columns',
            'type' => 'select',
            'title' => __('Cross-sell Products number', 'kleo_framework'),
            'subtitle' => __('Select the number of Cross-sell products to show on cart page.', 'kleo_framework'),
            'options' => array(
                '3' => '3',
                '4' => '4',
                '5' => '5',
                '6' => '6'
            ),
            'default' => '3'
        )
    )
);*/
}

// Load WooCommerce custom stylesheet
if (! is_admin()) {
    if ( version_compare( WOOCOMMERCE_VERSION, "2.1" ) < 0 ) {
        define( 'WOOCOMMERCE_USE_CSS', false );
    }
    add_action( 'wp_enqueue_scripts', 'kleo_load_woocommerce_css', 20 );
}

if ( ! function_exists( 'kleo_load_woocommerce_css' ) ) {
    function kleo_load_woocommerce_css () {
        wp_deregister_style('woocommerce-layout');
        wp_deregister_style('woocommerce-smallscreen');
        wp_deregister_style('woocommerce-general');
        wp_register_style( 'kleo-woocommerce', get_template_directory_uri() . '/woocommerce/assets/css/woocommerce.css' );
        wp_enqueue_style( 'kleo-woocommerce' );
    }
}

//de-register PrettyPhoto - we will use our own
/*add_action( 'wp_print_styles', 'my_deregister_styles', 100 );

function my_deregister_styles() {
    wp_deregister_style( 'woocommerce_prettyPhoto_css' );
    wp_dequeue_script( 'prettyPhoto' );
    wp_dequeue_script( 'prettyPhoto-init' );
}*/

if ( ! function_exists( 'checked_environment' ) )
{
    // Check WooCommerce is installed first
    add_action('plugins_loaded', 'checked_environment');

    function checked_environment()
    {
        if (!class_exists('woocommerce')) wp_die('WooCommerce must be installed');
    }
}


/* Admin scripts */

if (is_admin()) {
    //remove backend options by removing them from the config array
    add_filter('woocommerce_general_settings','kleo_woocommerce_general_settings_filter');
    add_filter('woocommerce_page_settings','kleo_woocommerce_general_settings_filter');
    add_filter('woocommerce_catalog_settings','kleo_woocommerce_general_settings_filter');
    add_filter('woocommerce_inventory_settings','kleo_woocommerce_general_settings_filter');
    add_filter('woocommerce_shipping_settings','kleo_woocommerce_general_settings_filter');
    add_filter('woocommerce_tax_settings','kleo_woocommerce_general_settings_filter');

    function kleo_woocommerce_general_settings_filter($options)
    {
        $remove   = array('woocommerce_enable_lightbox', 'woocommerce_frontend_css');

        foreach ($options as $key => $option)
        {
            if( isset($option['id']) && in_array($option['id'], $remove) )
            {
                unset($options[$key]);
            }
        }

        return $options;
    }

} //end is_admin()



// Remove WC sidebar
remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );


//catalog mode
if ( sq_option( 'woo_catalog' , false )  ) {
    remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
    remove_action( 'woocommerce_simple_add_to_cart', 'woocommerce_simple_add_to_cart', 30 );
    remove_action( 'woocommerce_grouped_add_to_cart', 'woocommerce_grouped_add_to_cart', 30 );
    remove_action( 'woocommerce_variable_add_to_cart', 'woocommerce_variable_add_to_cart', 30 );
    remove_action( 'woocommerce_external_add_to_cart', 'woocommerce_external_add_to_cart', 30 );
    remove_action( 'woocommerce_single_product_modal_summary', 'woocommerce_template_single_add_to_cart', 30 );
    remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );

    //disable prices
    if ( sq_option( 'woo_disable_prices' , false ) ) {
        remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10);
        remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
        remove_action( 'woocommerce_single_product_modal_summary', 'woocommerce_template_single_price', 10 );
    }
}



// WooCommerce layout overrides
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );

if ( ! function_exists( 'kleo_woocommerce_before_content' ) ) {
    // WooCommerce layout overrides
    add_action( 'woocommerce_before_main_content', 'kleo_woocommerce_before_content', 10 );

    function kleo_woocommerce_before_content() {
        get_template_part( 'page-parts/general-before-wrap' );

        get_template_part( 'page-parts/page-title' );

        echo '<div class="main-content ' . Kleo::get_config('container_class') .'">';
    }
}

if ( ! function_exists( 'kleo_woocommerce_after_content' ) )
{
    // WooCommerce layout overrides
    add_action( 'woocommerce_after_main_content', 'kleo_woocommerce_after_content', 20 );

    function kleo_woocommerce_after_content()
    {
        echo '</div> <!-- end .main-content -->';
        get_template_part('page-parts/general-after-wrap');
    }
}


//Remove woo breadcrumb
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );

add_action( 'wp', 'sq_woo_actions' );

function sq_woo_actions() {
    if ( is_woocommerce() ) {
        //Remove SQ breadcrumb
        remove_action( 'kleo_page_title_section', 'kleo_show_breadcrumb', 16 );

        //Add modified Woo breadcrumb in our theme location
        add_action( 'kleo_page_title_section', 'sq_woo_breadcrumb', 20 );

        //Remove Shop page title
        add_filter( 'woocommerce_show_page_title',  '__return_false' );

        //Add woocommerce title in our theme location
        add_filter( 'kleo_title_override', 'sq_woo_title' );
    }
}

function sq_woo_breadcrumb() {
    $args = array();
    $args['delimiter'] = '';
    $args['wrap_before'] = '<ol class="breadcrumb" ' . (is_single() ? 'itemprop="breadcrumb"' : '') . '>';
    $args['wrap_after'] = '</ol>';
    $args['before'] = '<li>';
    $args['after'] = '</li>';
    woocommerce_breadcrumb($args);
}

function sq_woo_title() {
    return woocommerce_page_title( false );
}


//Change page layout to match theme options settings
add_filter( 'site_layout', 'kleo_woo_change_layout' );

function kleo_woo_change_layout( $layout ) {

    $tpl_map = Kleo::get_config( 'tpl_map' );

    if ( is_woocommerce() ) {
        $shop_id = wc_get_page_id( 'shop' );
        $shop_template = get_post_meta( $shop_id, '_wp_page_template', true );

        if ( is_shop() && $shop_id && $shop_template && $shop_template != 'default'
            && isset( $tpl_map[$shop_template] ) ) {

            $layout = $tpl_map[$shop_template];

        }
        elseif ( is_product() && get_cfield('post_layout') && get_cfield('post_layout') != 'default') {
            $layout = get_cfield('post_layout');
        }
        elseif( (is_product_category() || is_product_tag()) && sq_option('woo_cat_sidebar', 'default') != 'default' ) {
            $layout = sq_option('woo_cat_sidebar', 'default');
        }
        else {
            //switch to the general set in Theme options
            $woo_template = sq_option( 'woo_sidebar', 'default' );
            if ( $woo_template != 'default' ) {
                $layout = $woo_template;
            }
        }

        //change default sidebar with Shop sidebar
        add_filter('kleo_sidebar_name', create_function('', 'return "Shop";'));
    }

    return $layout;
}


// Number of products per page
$woo_per_page = sq_option( 'woo_shop_products', 15 );
add_filter( 'loop_shop_per_page', create_function( '$cols', 'return ' . $woo_per_page . ';' ) );




/***************************************************
:: Wishlist
 ***************************************************/

add_action( 'woocommerce_before_shop_loop_item', 'kleo_woo_wishlist', 11 );

function kleo_woo_wishlist() {
    if ( in_array( 'yith-woocommerce-wishlist/init.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
        echo do_shortcode('[yith_wcwl_add_to_wishlist]');
    }
}
