<?php
/**
 * Customizer => WooCommerce
 *
 * @package Total WordPress Theme
 * @subpackage Customizer
 * @version 3.3.5
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Strings
$refresh_desc = esc_html__( 'You must save your options and refresh your live site to preview changes to this setting. You may have to also add or remove an item from the cart to clear the WooCommerce cache.', 'total' );

// General
$this->sections['wpex_woocommerce_general'] = array(
	'title' => esc_html__( 'General', 'total' ),
	'panel' => 'wpex_woocommerce',
	'settings' => array(
		array(
			'id' => 'woo_custom_sidebar',
			'default' => true,
			'control' => array(
				'label' => esc_html__( 'Custom WooCommerce Sidebar', 'total' ),
				'type' => 'checkbox',
			),
		),
		array(
			'id' => 'woo_menu_icon_display',
			'default' => 'icon_count',
			'transport' => 'postMessage',
			'control' => array(
				'label' => esc_html__( 'Menu Cart: Display', 'total' ),
				'type' => 'select',
				'choices' => array(
					'disabled' => esc_html__( 'Disabled', 'total' ),
					'icon' => esc_html__( 'Icon', 'total' ),
					'icon_total' => esc_html__( 'Icon And Cart Total', 'total' ),
					'icon_count' => esc_html__( 'Icon And Cart Count', 'total' ),
				),
				'desc' => $refresh_desc,
			),
		),
		array(
			'id' => 'woo_menu_icon_class',
			'default' => 'drop_down',
			'transport' => 'postMessage',
			'control' => array(
				'label' => esc_html__( 'Menu Cart: Icon', 'total' ),
				'type' => 'select',
				'choices' => array(
					'shopping-cart' => esc_html__( 'Shopping Cart', 'total' ),
					'shopping-bag' => esc_html__( 'Shopping Bag', 'total' ),
					'shopping-basket' => esc_html__( 'Shopping Basket', 'total' ),
				),
				'desc' => $refresh_desc,
			),
		),
		array(
			'id' => 'woo_menu_icon_style',
			'default' => 'drop_down',
			'transport' => 'postMessage',
			'control' => array(
				'label' => esc_html__( 'Menu Cart: Style', 'total' ),
				'type' => 'select',
				'choices' => array(
					'drop_down' => esc_html__( 'Drop-Down', 'total' ),
					'overlay' => esc_html__( 'Open Cart Overlay', 'total' ),
					'store' => esc_html__( 'Go To Store', 'total' ),
					'custom-link' => esc_html__( 'Custom Link', 'total' ),
				),
				'desc' => $refresh_desc,
			),
		),
		array(
			'id' => 'woo_menu_icon_custom_link',
			'transport' => 'postMessage',
			'control' => array(
				'label' => esc_html__( 'Menu Cart: Custom Link', 'total' ),
				'type' => 'text',
				'desc' => $refresh_desc,
			),
		),
	)
);

// Archives
$this->sections['wpex_woocommerce_archives'] = array(
	'title' => esc_html__( 'Archives', 'total' ),
	'panel' => 'wpex_woocommerce',
	'settings' => array(
		array(
			'id' => 'woo_shop_title',
			'default' => 'on',
			'control' => array(
				'label' => esc_html__( 'Shop Title', 'total' ),
				'type' => 'checkbox',
			),
		),
		array(
			'id' => 'woo_shop_slider',
			'control' => array(
				'label' => esc_html__( 'Shop Slider', 'total' ),
				'type' => 'text',
			),
		),
		array(
			'id' => 'woo_shop_posts_per_page',
			'default' => '12',
			'control' => array(
				'label' => esc_html__( 'Shop Posts Per Page', 'total' ),
				'type' => 'text',
				'desc' => esc_html__( 'You must save your options and refresh your live site to preview changes to this setting.', 'total' ),
			),
		),
		array(
			'id' => 'woo_shop_layout',
			'default' => 'full-width',
			'control' => array(
				'label' => esc_html__( 'Layout', 'total' ),
				'type' => 'select',
				'choices' => $post_layouts,
			),
		),
		array(
			'id' => 'woocommerce_shop_columns',
			'default' => '4',
			'control' => array(
				'label' => esc_html__( 'Shop Columns', 'total' ),
				'type' => 'select',
				'choices' => wpex_grid_columns(),

			),
		),
		array(
			'id' => 'woo_category_description_position',
			'default' => 'under_title',
			'control' => array(
				'label' => esc_html__( 'Category Description Position', 'total' ),
				'type' => 'select',
				'choices' => array(
					'under_title' => esc_html__( 'Under Title', 'total' ),
					'above_loop' => esc_html__( 'Above Loop', 'total' ),
				),

			),
		),
		array(
			'id' => 'woo_shop_sort',
			'default' => 'on',
			'transport' => 'postMessage',
			'control' => array(
				'label' => esc_html__( 'Shop Sort', 'total' ),
				'type' => 'checkbox',
				'desc' => esc_html__( 'You must save your options and refresh your live site to preview changes to this setting.', 'total' ),
			),
		),
		array(
			'id' => 'woo_shop_result_count',
			'default' => 'on',
			'transport' => 'postMessage',
			'control' => array(
				'label' => esc_html__( 'Shop Result Count', 'total' ),
				'type' => 'checkbox',
				'desc' => esc_html__( 'You must save your options and refresh your live site to preview changes to this setting.', 'total' ),
			),
		),
		array(
			'id' => 'woo_product_entry_style',
			'default' => 'image-swap',
			'control' => array(
				'label' => esc_html__( 'Product Entry Media', 'total' ),
				'type' => 'select',
				'choices' => array(
					'featured-image' => esc_html__( 'Featured Image', 'total' ),
					'image-swap' => esc_html__( 'Image Swap', 'total' ),
					'gallery-slider' => esc_html__( 'Gallery Slider', 'total' ),
				),
			),
		),
	)
);

// Single
$this->sections['wpex_woocommerce_single'] = array(
	'title' => esc_html__( 'Single', 'total' ),
	'panel' => 'wpex_woocommerce',
	'settings' => array(
		array(
			'id' => 'woo_shop_single_title',
			'default' => esc_html__( 'Store', 'total' ),
			'control' => array(
				'label' => esc_html__( 'Page Header Title', 'total' ),
				'type' => 'text',
			),
		),
		array(
			'id' => 'woo_product_layout',
			'default' => 'full-width',
			'control' => array(
				'label' => esc_html__( 'Layout', 'total' ),
				'type' => 'select',
				'choices' => $post_layouts,
			),
		),
		array(
			'id' => 'woocommerce_upsells_count',
			'default' => '4',
			'control' => array(
				'label' => esc_html__( 'Up-Sells Count', 'total' ), 
				'type' => 'text',
			),
		),
		array(
			'id' => 'woocommerce_upsells_columns',
			'default' => '4',
			'control' => array(
				'label' => esc_html__( 'Up-Sells Columns', 'total' ), 
				'type' => 'select',
				'choices' => wpex_grid_columns(),
			),
		),
		array(
			'id' => 'woocommerce_related_count',
			'default' => '4',
			'control' => array(
				'label' => esc_html__( 'Related Items Count', 'total' ), 
				'type' => 'text',
			),
		),
		array(
			'id' => 'woocommerce_related_columns',
			'default' => '4',
			'control' => array(
				'label' => esc_html__( 'Related Products Columns', 'total' ),
				'type' => 'select',
				'choices' => wpex_grid_columns(),
			),
		),
		array(
			'id' => 'woo_single_gallery_include_thumbnail',
			'default' => true,
			'control' => array(
				'label' => esc_html__( 'Include Featured Image in Gallery', 'total' ),
				'type' => 'checkbox',
			),
		),
		array(
			'id' => 'woo_product_meta',
			'default' => 'on',
			'control' => array(
				'label' => esc_html__( 'Product Meta', 'total' ),
				'type' => 'checkbox',
				'desc' => esc_html__( 'You must save your options and refresh your live site to preview changes to this setting.', 'total' ),
			),
		),
		array(
			'id' => 'woo_next_prev',
			'default' => 'on',
			'control' => array(
				'label' => esc_html__( 'Next & Previous Links', 'total' ),
				'type' => 'checkbox',
			),
		),
	),
);

// Cart
$this->sections['wpex_woocommerce_cart'] = array(
	'title' => esc_html__( 'Cart', 'total' ),
	'panel' => 'wpex_woocommerce',
	'settings' => array(
		array(
			'id' => 'woocommerce_cross_sells_count',
			'default' => '2',
			'control' => array(
				'label' => esc_html__( 'Cross-Sells Count', 'total' ),
				'type' => 'text',
			),
		),
		array(
			'id' => 'woocommerce_cross_sells_columns',
			'default' => '2',
			'control' => array(
				'label' => esc_html__( 'Cross-Sells Columns', 'total' ),
				'type' => 'select',
				'choices' => wpex_grid_columns(),
			),
		),
	),
);


// Styling
$this->sections['wpex_woocommerce_styling'] = array(
	'title' => esc_html__( 'Styling', 'total' ),
	'panel' => 'wpex_woocommerce',
	'settings' => array(
		array(
			'id' => 'onsale_bg',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'On Sale Background', 'total' ),
			),
			'inline_css' => array(
				'target' => '.woocommerce span.onsale',
				'alter' => 'background-color',
			),
		),
		array(
			'id' => 'onsale_color',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'On Sale Color', 'total' )
			),
			'inline_css' => array(
				'target' => '.woocommerce span.onsale',
				'alter' => 'color',
			),
		),
		array(
			'id' => 'woo_product_title_link_color',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Product Entry Title Color', 'total' )
			),
			'inline_css' => array(
				'target' => array(
					'.woocommerce ul.products li.product h3',
					'.woocommerce ul.products li.product h3 mark',
				),
				'alter' => 'color',
			),
		),
		array(
			'id' => 'woo_product_title_link_color_hover',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Product Entry Title Color: Hover', 'total' )
			),
			'inline_css' => array(
				'target' => array(
					'.woocommerce ul.products li.product h3:hover',
					'.woocommerce ul.products li.product h3:hover mark',
				),
				'alter' => 'color',
			),
		),
		array(
			'id' => 'woo_price_color',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Global Price Color', 'total' )
			),
			'inline_css' => array(
				'target' => array(
					'.price',
					'.amount',
					'.woocommerce ul.products li.product .price .amount',
				),
				'alter' => 'color',
			),
		),
		array(
			'id' => 'woo_product_entry_price_color',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Product Entry Price Color', 'total' )
			),
			'inline_css' => array(
				'target' => array(
					'.woocommerce ul.products li.product .price',
					'.woocommerce ul.products li.product .price .amount',
				),
				'alter' => 'color',
			),
		),
		array(
			'id' => 'woo_single_price_color',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Single Product Price Color', 'total' )
			),
			'inline_css' => array(
				'target' => array(
					'.woocommerce .summary .price',
					'.woocommerce .summary .amount',
				),
				'alter' => 'color',
			),
		),
		array(
			'id' => 'woo_stars_color',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Star Ratings Color', 'total' )
			),
			'inline_css' => array(
				'target' => array(
					'.woocommerce p.stars a',
					'.woocommerce .star-rating',
				),
				'alter' => 'color',
			),
		),
		array(
			'id' => 'woo_single_tabs_active_border_color',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Product Tabs Active Border Color', 'total' )
			),
			'inline_css' => array(
				'target' => array(
					'.woocommerce div.product .woocommerce-tabs ul.tabs li.active a',
				),
				'alter' => 'border-color',
			),
		),
		array(
			'id' => 'woo_button_bg',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Woo Button Background', 'total' )
			),
			'inline_css' => array(
				'target' => array(
					'.woocommerce input#submit',
					'.woocommerce .button',
					'a.wc-forward',
				),
				'alter' => 'background',
				'important' => true,
			),
		),
		array(
			'id' => 'woo_button_color',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Woo Button Color', 'total' )
			),
			'inline_css' => array(
				'target' => array(
					'.woocommerce input#submit',
					'.woocommerce .button',
					'a.wc-forward',
				),
				'alter' => 'color',
				'important' => true,
			),
		),
		array(
			'id' => 'woo_button_border_radius',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Woo Button Border Radius', 'total' )
			),
			'inline_css' => array(
				'target' => array(
					'.woocommerce input#submit',
					'.woocommerce .button',
					'a.wc-forward',
				),
				'alter' => 'border-radius',
				'important' => true,
			),
		),
		array(
			'id' => 'woo_button_bg_hover',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Woo Button Hover: Background', 'total' )
			),
			'inline_css' => array(
				'target' => array(
					'.woocommerce input#submit:hover',
					'.woocommerce .button:hover',
					'a.wc-forward:hover',
				),
				'alter' => 'background',
				'important' => true,
			),
		),
		array(
			'id' => 'woo_button_color_hover',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Woo Button Hover: Color', 'total' )
			),
			'inline_css' => array(
				'target' => array(
					'.woocommerce input#submit:hover',
					'.woocommerce .button:hover',
					'a.wc-forward:hover',
				),
				'alter' => 'color',
				'important' => true,
			),
		),
	),
);