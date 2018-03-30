<?php
/**
 * This file belongs to the YIT Plugin Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

/**
 * Return the list of shortcode and their settings
 *
 * @package Yithemes
 * @autor Francesco Licandro  <francesco.licandro@yithemes.com>
 * @since   1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
} // Exit if accessed directly


$shop_categories    = yit_get_shop_categories();
$shop_categories_id = yit_get_shop_categories_by_id();
$animate            = yit_get_animate_effects();

return array(

    /* === SHOW REVIEW === */
    'review_slider'              => array(
        'title'              => __( 'Show reviews', 'yit' ),
        'description'        => __( 'Show review of the users', 'yit' ),
        'tab'                => 'shop',
        'has_content'        => false,
        'in_visual_composer' => true,
        'attributes'         => array(
            'title'       => array(
                'title' => __( 'Title', 'yit' ),
                'type'  => 'text',
                'std'   => ''
            ),
            'description' => array(
                'title' => __( 'Description', 'yit' ),
                'type'  => 'text',
                'std'   => ''
            ),
            'items'       => array(
                'title'       => __( 'N. of items', 'yit' ),
                'description' => __( 'Leave blank to show all', 'yit' ),
                'type'        => 'number',
                'std'         => '8'
            ),
            'id'          => array(
                'title'       => __( 'Product', 'yit' ),
                'description' => __( 'Add a single id product. Show all with 0', 'yit' ),
                'type'        => 'text',
                'std'         => '0'
            ),
            'show_avatar' => array(
                'title' => __( 'Show avatar', 'yit' ),
                'type'  => 'checkbox',
                'std'   => 'yes'
            ),
            'show_rating' => array(
                'title' => __( 'Show rating', 'yit' ),
                'type'  => 'checkbox',
                'std'   => 'yes'
            ),
            'speed'       => array(
                'title' => __( 'Speed (ms)', 'yit' ),
                'type'  => 'number',
                'std'   => '500'
            ),
            'timeout'     => array(
                'title' => __( 'Time out (ms)', 'yit' ),
                'type'  => 'number',
                'std'   => '5000'
            ),
        )
    ),

    /* === SHOW PRODUCTS === */
    'show_products'              => array(
        'title'              => __( 'Show the products', 'yit' ),
        'description'        => __( 'Show the products', 'yit' ),
        'tab'                => 'shop',
        'has_content'        => false,
        'in_visual_composer' => true,
        'attributes'         => array(
            'per_page'        => array(
                'title'       => __( 'N. of items', 'yit' ),
                'description' => __( 'Show all with -1', 'yit' ),
                'type'        => 'number',
                'std'         => '8'
            ),
            'layout'          => array(
                'title'   => __( 'Layout', 'yit' ),
                'type'    => 'select',
                'options' => array(
                    'default' => __( 'Default', 'yit' ),
                    'slideup' => __( 'Slide-Up', 'yit' ),
                    'classic' => __( 'Classic', 'yit' )
                ),
                'std'     => 'default'
            ),
            'category'        => array(
                'title'    => __( 'Category', 'yit' ),
                'type'     => 'select',
                'multiple' => true,
                'options'  => yit_get_shop_categories( false ),
                'std'      => serialize( array() )
            ),
            'show'            => array(
                'title'   => __( 'Show', 'yit' ),
                'type'    => 'select',
                'options' => array(
                    'all'      => __( 'All Products', 'yit' ),
                    'featured' => __( 'Featured Products', 'yit' ),
                    'on_sale'  => __( 'On Sale Products', 'yit' ),

                ),
                'std'     => 'all'
            ),
            'orderby'         => array(
                'title'   => __( 'Order by', 'yit' ),
                'type'    => 'select',
                'options' => apply_filters( 'woocommerce_catalog_orderby', array(
                    'rand'  => __( 'Random', 'yit' ),
                    'title' => __( 'Sort alphabetically', 'yit' ),
                    'date'  => __( 'Sort by most recent', 'yit' ),
                    'price' => __( 'Sort by price', 'yit' ),
                    'sales' => __( 'Sort by sales', 'yit' )
                ) ),
                'std'     => 'rand'
            ),
            'order'           => array(
                'title'   => __( 'Sorting', 'yit' ),
                'type'    => 'select',
                'options' => array(
                    'desc' => __( 'Descending', 'yit' ),
                    'asc'  => __( 'Crescent', 'yit' )
                ),
                'std'     => 'desc'
            ),
            'hide_free'       => array(
                'title' => __( 'Hide free products', 'yit' ),
                'type'  => 'checkbox',
                'std'   => 'no'
            ),
            'show_hidden'     => array(
                'title' => __( 'Show hidden products', 'yit' ),
                'type'  => 'checkbox',
                'std'   => 'no'
            ),
            'animate'         => array(
                'title'   => __( 'Animation', 'yit' ),
                'type'    => 'select',
                'options' => $animate,
                'std'     => ''
            ),
            'animation_delay' => array(
                'title' => __( 'Animation Delay', 'yit' ),
                'type'  => 'text',
                'desc'  => __( 'This value determines the delay to which the animation starts once it\'s visible on the screen.', 'yit' ),
                'std'   => '0'
            )
        )
    ),

    /* === RESET WOOCOMMERCE LOOP === */
    'reset_woocommerce_loop'     => array(
        'title'              => __( 'Reset woocommerce loop', 'yit' ),
        'description'        => __( 'Reset woocommerce loop', 'yit' ),
        'tab'                => 'shop',
        'has_content'        => false,
        'in_visual_composer' => true,
        'attributes'         => array()
    ),


    /* === PRODUCTS TABS === */
    'products_tabs'              => array(
        'title'              => __( 'Products Tabs', 'yit' ),
        'description'        => __( 'List products in tabs', 'yit' ),
        'tab'                => 'shop',
        'multiple'           => true,
        'unlimited'          => true,
        'has_content'        => false,
        'in_visual_composer' => false,
        'attributes'         => array(
            'title_1'         => array(
                'title'    => __( 'Title', 'yit' ),
                'type'     => 'text',
                'std'      => '',
                'multiple' => true
            ),
            'per_page_1'      => array(
                'title'       => __( 'N. of items', 'yit' ),
                'description' => __( 'Show all with -1', 'yit' ),
                'type'        => 'number',
                'std'         => '10',
                'multiple'    => true
            ),
            'category_1'      => array(
                'title'    => __( 'Category', 'yit' ),
                'type'     => 'select',
                'options'  => $shop_categories,
                'std'      => serialize( array() ),
                'multiple' => true
            ),
            'show_1'          => array(
                'title'    => __( 'Show', 'yit' ),
                'type'     => 'select',
                'options'  => array(
                    'all'      => __( 'All', 'yit' ),
                    'featured' => __( 'Featured', 'yit' ),
                    'onsale'   => __( 'On sale', 'yit' ),
                ),
                'std'      => serialize( array( 'all' ) ),
                'multiple' => true
            ),
            'orderby_1'       => array(
                'title'    => __( 'Order by', 'yit' ),
                'type'     => 'select',
                'options'  => apply_filters( 'woocommerce_catalog_orderby', array(
                    'rand'  => __( 'Random', 'yit' ),
                    'title' => __( 'Sort alphabetically', 'yit' ),
                    'date'  => __( 'Sort by most recent', 'yit' ),
                    'price' => __( 'Sort by price', 'yit' ),
                    'sales' => __( 'Sort by sales', 'yit' )
                ) ),
                'std'      => serialize( array( 'rand' ) ),
                'multiple' => true
            ),
            'order_1'         => array(
                'title'    => __( 'Sorting', 'yit' ),
                'type'     => 'select',
                'options'  => array(
                    'desc' => __( 'Descending', 'yit' ),
                    'asc'  => __( 'Crescent', 'yit' )
                ),
                'std'      => serialize( array( 'desc' ) ),
                'multiple' => true
            ),
            'animate'         => array(
                'title'   => __( 'Animation', 'yit' ),
                'type'    => 'select',
                'options' => $animate,
                'std'     => ''
            ),
            'animation_delay' => array(
                'title' => __( 'Animation Delay', 'yit' ),
                'type'  => 'text',
                'desc'  => __( 'This value determines the delay to which the animation starts once it\'s visible on the screen.', 'yit' ),
                'std'   => '0'
            ),
            'z_index'         => array(
                'title' => __( 'Z-Index', 'yit' ),
                'type'  => 'text',
                'desc'  => __( 'This value determines the style z-index value of the slider container', 'yit' ),
                'std'   => ''
            )
        )
    ),

    /* === PRODUCTS SLIDER === */
    'products_slider'            => array(
        'title'              => __( 'Products slider', 'yit' ),
        'description'        => __( 'Add a products slider', 'yit' ),
        'tab'                => 'shop',
        'has_content'        => false,
        'in_visual_composer' => true,
        'attributes'         => array(
            'title'           => array(
                'title' => __( 'Title', 'yit' ),
                'type'  => 'text',
                'std'   => ''
            ),
            'per_page'        => array(
                'title' => __( 'Items', 'yit' ),
                'type'  => 'number',
                'std'   => '12'
            ),
            'category'        => array(
                'title'    => __( 'Category', 'yit' ),
                'type'     => 'select',
                'options'  => yit_get_shop_categories( false ),
                'std'      => serialize( array() ),
                'multiple' => true
            ),
            'layout'          => array(
                'title'   => __( 'Layout', 'yit' ),
                'type'    => 'select',
                'options' => array(
                    'default' => __( 'Default', 'yit' ),
                    'slideup' => __( 'Slide-Up', 'yit' ),
                    'classic' => __( 'Classic', 'yit' )
                ),
                'std'     => 'default'
            ),
            'product_type'    => array(
                'title'   => __( 'Product Type', 'yit' ),
                'type'    => 'select',
                'options' => array(
                    'all'      => __( 'All products', 'yit' ),
                    'featured' => __( 'Featured Products', 'yit' ),
                    'on_sale'  => __( 'On Sale Products', 'yit' )
                ),
                'std'     => 'all'
            ),
            'orderby'         => array(
                'title'   => __( 'Order by', 'yit' ),
                'type'    => 'select',
                'options' => apply_filters( 'woocommerce_catalog_orderby', array(
                    'rand'  => __( 'Random', 'yit' ),
                    'title' => __( 'Sort alphabetically', 'yit' ),
                    'date'  => __( 'Sort by most recent', 'yit' ),
                    'price' => __( 'Sort by price', 'yit' ),
                    'sales' => __( 'Sort by sales', 'yit' )
                ) ),
                'std'     => 'rand'
            ),
            'order'           => array(
                'title'   => __( 'Sorting', 'yit' ),
                'type'    => 'select',
                'options' => array(
                    'desc' => __( 'Descending', 'yit' ),
                    'asc'  => __( 'Crescent', 'yit' )
                ),
                'std'     => 'desc'
            ),
            'hide_free'       => array(
                'title' => __( 'Hide free products', 'yit' ),
                'type'  => 'checkbox',
                'std'   => 'no'
            ),
            'show_hidden'     => array(
                'title' => __( 'Show hidden products', 'yit' ),
                'type'  => 'checkbox',
                'std'   => 'no'
            ),
            'autoplay'        => array(
                'title'   => __( 'Autoplay', 'yit' ),
                'type'    => 'select',
                'options' => array(
                    'true'  => __( 'True', 'yit' ),
                    'false' => __( 'False', 'yit' ),
                ),
                'std'     => 'true'
            ),
            'animate'         => array(
                'title'   => __( 'Animation', 'yit' ),
                'type'    => 'select',
                'options' => $animate,
                'std'     => ''
            ),
            'animation_delay' => array(
                'title' => __( 'Animation Delay', 'yit' ),
                'type'  => 'text',
                'desc'  => __( 'This value determines the delay to which the animation starts once it\'s visible on the screen.', 'yit' ),
                'std'   => '0'
            ),
            'z_index'         => array(
                'title' => __( 'Z-Index', 'yit' ),
                'type'  => 'text',
                'desc'  => __( 'This value determines the style z-index value of the slider container', 'yit' ),
                'std'   => ''
            )
        )
    ),

    /* === PRODUCTS CATEGORY SLIDER === */
    'products_categories_slider' => array(
        'title'              => __( 'Categories slider', 'yit' ),
        'description'        => __( 'List all (or limited) product categories', 'yit' ),
        'tab'                => 'shop',
        'has_content'        => false,
        'in_visual_composer' => true,
        'attributes'         => array(
            'title'           => array(
                'title' => __( 'Title', 'yit' ),
                'type'  => 'text',
                'std'   => ''
            ),
            'category'        => array(
                'title'   => __( 'Category', 'yit' ),
                'type'    => 'checklist',
                'options' => $shop_categories_id,
                'std'     => ''
            ),
            'show_counter'    => array(
                'title' => __( 'Show Counter', 'yit' ),
                'type'  => 'checkbox',
                'std'   => 'yes'
            ),
            'hide_empty'      => array(
                'title' => __( 'Hide empty', 'yit' ),
                'type'  => 'checkbox',
                'std'   => 'yes'
            ),
            'style'           => array(
                'title'   => __( 'Style', 'yit' ),
                'type'    => 'select',
                'options' => array(
                    'white' => __( 'White', 'yit' ),
                    'black' => __( 'Black', 'yit' )
                ),
                'std'     => 'black'
            ),
            'discovery_text'  => array(
                'title' => __( 'Discovery text', 'yit' ),
                'type'  => 'text',
                'std'   => 'DISCOVERY NOW'
            ),
            'orderby'         => array(
                'title'   => __( 'Order by', 'yit' ),
                'type'    => 'select',
                'options' => apply_filters( 'woocommerce_catalog_orderby', array(
                    'menu_order' => __( 'Default sorting', 'yit' ),
                    'title'      => __( 'Sort alphabetically', 'yit' ),
                    'count'      => __( 'Sort by products count', 'yit' )
                ) ),
                'std'     => 'menu_order'
            ),
            'order'           => array(
                'title'   => __( 'Sorting', 'yit' ),
                'type'    => 'select',
                'options' => array(
                    'desc' => __( 'Descending', 'yit' ),
                    'asc'  => __( 'Crescent', 'yit' )
                ),
                'std'     => 'desc'
            ),
            'animate'         => array(
                'title'   => __( 'Animation', 'yit' ),
                'type'    => 'select',
                'options' => $animate,
                'std'     => ''
            ),
            'animation_delay' => array(
                'title' => __( 'Animation Delay', 'yit' ),
                'type'  => 'text',
                'desc'  => __( 'This value determines the delay to which the animation starts once it\'s visible on the screen.', 'yit' ),
                'std'   => '0'
            ),
            'autoplay'        => array(
                'title'   => __( 'Autoplay', 'yit' ),
                'type'    => 'select',
                'options' => array(
                    'true'  => __( 'True', 'yit' ),
                    'false' => __( 'False', 'yit' ),
                ),
                'std'     => 'true'
            )
        )
    ),

    /* === PRODUCTS CATEGORY === */
    'products_categories'        => array(
        'title'              => __( 'Product Categories', 'yit' ),
        'description'        => __( 'List all (or limited) product categories', 'yit' ),
        'tab'                => 'shop',
        'has_content'        => false,
        'in_visual_composer' => true,
        'attributes'         => array(
            'category'        => array(
                'title'   => __( 'Category', 'yit' ),
                'type'    => 'checklist',
                'options' => $shop_categories_id,
                'std'     => ''
            ),
            'hide_empty'      => array(
                'title' => __( 'Hide empty', 'yit' ),
                'type'  => 'checkbox',
                'std'   => 'yes'
            ),
            'show_counter'    => array(
                'title' => __( 'Show Counter', 'yit' ),
                'type'  => 'checkbox',
                'std'   => 'yes'
            ),
            'style'           => array(
                'title'   => __( 'Style', 'yit' ),
                'type'    => 'select',
                'options' => array(
                    'white' => __( 'White', 'yit' ),
                    'black' => __( 'Black', 'yit' )
                ),
                'std'     => 'black'
            ),
            'discovery_text'  => array(
                'title' => __( 'Discovery text', 'yit' ),
                'type'  => 'text',
                'std'   => 'DISCOVERY NOW'
            ),
            'orderby'         => array(
                'title'   => __( 'Order by', 'yit' ),
                'type'    => 'select',
                'options' => apply_filters( 'woocommerce_catalog_orderby', array(
                    'menu_order' => __( 'Default sorting', 'yit' ),
                    'title'      => __( 'Sort alphabetically', 'yit' ),
                    'date'       => __( 'Sort by most recent', 'yit' ),
                    'price'      => __( 'Sort by price', 'yit' )
                ) ),
                'std'     => 'menu_order'
            ),
            'order'           => array(
                'title'   => __( 'Sorting', 'yit' ),
                'type'    => 'select',
                'options' => array(
                    'desc' => __( 'Descending', 'yit' ),
                    'asc'  => __( 'Crescent', 'yit' )
                ),
                'std'     => 'desc'
            ),
            'animate'         => array(
                'title'   => __( 'Animation', 'yit' ),
                'type'    => 'select',
                'options' => $animate,
                'std'     => ''
            ),
            'animation_delay' => array(
                'title' => __( 'Animation Delay', 'yit' ),
                'type'  => 'text',
                'desc'  => __( 'This value determines the delay to which the animation starts once it\'s visible on the screen.', 'yit' ),
                'std'   => '0'
            )
        )
    ),


    /* === Add to Cart=== */
    'yit_add_to_cart'            => array(
        'title'              => __( 'Add to cart', 'yit' ),
        'description'        => __( 'Print add to cart button', 'yit' ),
        'tab'                => 'shop',
        'has_content'        => false,
        'in_visual_composer' => true,
        'attributes'         => array(
            'id'           => array(
                'title' => __( 'Product ID', 'yit' ),
                'type'  => 'text',
                'std'   => ''
            )
        )
    )


);