<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( function_exists( 'is_woocommerce' ) ) {

/* Order Tracking */
vc_map(
	array(
		'name' => __( 'Shop categories', 'wolf' ),
		'base' => 'wolf_woocommerce_categories',
		'icon' => 'wolf-vc-icon wolf-vc-woocommerce',
		'category' => 'by WolfThemes',
		'allowed_container_element' => 'vc_row',
		'params' => array(
			array(
				'type' => 'dropdown',
				'holder' => 'div',
				'class' => '',
				'heading' => __( 'Type', 'wolf' ),
				'param_name' => 'layout',
				'description' => '',
				'value' => array(
					__( 'portrait', 'wolf' ) => 'portrait',
					__( 'classic', 'wolf' ) => 'classic-thumb',
					__( 'square', 'wolf' ) => 'square',
					__( 'mosaic', 'wolf' ) => 'mosaic',
				),
			),

			array(
				'type' => 'textfield',
				'holder' => 'div',
				'class' => '',
				'heading' => __( 'Include', 'wolf' ),
				'param_name' => 'include',
				'description' => __( 'Category slug to include (separate by a comma)', 'wolf' )
			),

			array(
				'type' => 'textfield',
				'holder' => 'div',
				'class' => '',
				'heading' => __( 'Exclude', 'wolf' ),
				'param_name' => 'exclude',
				'description' => __( 'Category slug to exclude (separate by a comma)', 'wolf' )
			),

			array(
				'type' => 'dropdown',
				'class' => '',
				'heading' => __( 'Columns', 'wolf' ),
				'param_name' => 'columns',
				'value' => array(
					3,1,2,4,5,6
				),
				'description' => '',
				'dependency' => array( 'element' => 'layout', 'value' => array( 'classic-thumb', 'portrait', 'square' ) ),
			),

			array(
				'type' => 'dropdown',
				'class' => '',
				'heading' => __( 'Padding', 'wolf' ),
				'param_name' => 'padding',
				'value' => array(
					__( 'Yes', 'wolf' ) => 'yes',
					__( 'No', 'wolf' ) => 'no',
				),
				'description' => '',
				'dependency' => array( 'element' => 'layout', 'value' => array( 'classic-thumb', 'portrait', 'square' ) ),
			),
		)
	)
);

/* Order Tracking */
vc_map(
	array(
		'name' => __( 'Order Tracking', 'wolf' ),
		'base' => 'woocommerce_order_tracking',
		'icon' => 'wolf-vc-icon wolf-vc-woocommerce',
		'category' => 'WooCommerce',
		'allowed_container_element' => 'vc_row',
		 'show_settings_on_create' => false
	)
);

/* Product price/cart button */
vc_map(
	array(
		'name' => __( 'Product price/cart button', 'wolf' ),
		'base' => 'add_to_cart',
		'icon' => 'wolf-vc-icon wolf-vc-woocommerce',
		'category' => 'WooCommerce',
		'allowed_container_element' => 'vc_row',
		'params' => array(
			array(
				'type' => 'textfield',
				'holder' => 'div',
				'class' => '',
				'heading' => 'ID',
				'param_name' => 'id',
				'description' => ''
			),
			array(
				'type' => 'textfield',
				'holder' => 'div',
				'class' => '',
				'heading' => 'SKU',
				'param_name' => 'sku',
				'description' => ''
			)
		),
	)
);

/* Product by SKU/ID */
vc_map(
	array(
		'name' => __( 'Product by SKU/ID', 'wolf' ),
		'base' => 'product',
		'icon' => 'wolf-vc-icon wolf-vc-woocommerce',
		'category' => 'WooCommerce',
		'allowed_container_element' => 'vc_row',
		'params' => array(
			array(
				'type' => 'textfield',
				'holder' => 'div',
				'class' => '',
				'heading' => 'ID',
				'param_name' => 'id',
				'description' => ''
			),
			array(
				'type' => 'textfield',
				'holder' => 'div',
				'class' => '',
				'heading' => 'SKU',
				'param_name' => 'sku',
				'description' => ''
			)
		)
	)
);


/* Products by SKU/ID */
vc_map(
	array(
		'name' => __( 'Products by SKU/ID', 'wolf' ),
		'base' => 'products',
		'icon' => 'wolf-vc-icon wolf-vc-woocommerce',
		'category' => 'WooCommerce',
		'allowed_container_element' => 'vc_row',
		'params' => array(
			array(
				'type' => 'textfield',
				'holder' => 'div',
				'class' => '',
				'heading' => 'IDS',
				'param_name' => 'ids',
				'description' => ''
			),
			array(
				'type' => 'textfield',
				'holder' => 'div',
				'class' => '',
				'heading' => 'SKUS',
				'param_name' => 'skus',
				'description' => ''
			)
		)
	)
);

/* Product categories */
vc_map(
	array(
		'name' => __( 'Product categories', 'wolf' ),
		'base' => 'product_categories',
		'icon' => 'wolf-vc-icon wolf-vc-woocommerce',
		'category' => 'WooCommerce',
		'allowed_container_element' => 'vc_row',
		'params' => array(
			array(
				'type' => 'textfield',
				'holder' => 'div',
				'class' => '',
				'heading' => __( 'Number', 'wolf' ),
				'param_name' => 'number',
				'description' => ''
			)
		)
	)
);

/* Products by category slug */
vc_map(
	array(
		'name' => __( 'Products by category slug', 'wolf' ),
		'base' => 'product_category',
		'icon' => 'wolf-vc-icon wolf-vc-woocommerce',
		'category' => 'WooCommerce',
		'allowed_container_element' => 'vc_row',
		'params' => array(
			array(
				'type' => 'textfield',
				'holder' => 'div',
				'class' => '',
				'heading' => __( 'Category', 'wolf' ),
				'param_name' => 'category',
				'description' => ''
			),
			array(
				'type' => 'textfield',
				'holder' => 'div',
				'class' => '',
				'heading' => __( 'Per page', 'wolf' ),
				'param_name' => 'per_page',
				'value' => '12'
			),
			array(
				'type' => 'dropdown',
				'class' => '',
				'heading' => __( 'Columns', 'wolf' ),
				'param_name' => 'columns',
				'value' => array(
					4,3,2,
				),
				'description' => '',
			),
			array(
				'type' => 'dropdown',
				'holder' => 'div',
				'class' => '',
				'heading' => __( 'Order by', 'wolf' ),
				'param_name' => 'order_by',
				'value' => array(
					'Date' => 'date',
					'Title' => 'title',
				),
				'description' => ''
			),
			array(
				'type' => 'dropdown',
				'holder' => 'div',
				'class' => '',
				'heading' => __( 'Order', 'wolf' ),
				'param_name' => 'order',
				'value' => array(
					'DESC' => 'desc',
					'ASC' => 'asc'
				),
				'description' => ''
			)
		)
	)
);

/* Recent products */
vc_map(
	array(
		'name' => __( 'Recent products', 'wolf' ),
		'base' => 'recent_products',
		'icon' => 'wolf-vc-icon wolf-vc-woocommerce',
		'category' => 'WooCommerce',
		'allowed_container_element' => 'vc_row',
		'params' => array(
			array(
				'type' => 'textfield',
				'holder' => 'div',
				'class' => '',
				'heading' => __( 'Per page', 'wolf' ),
				'param_name' => 'per_page',
				'value' => '12'
			),
			array(
				'type' => 'dropdown',
				'class' => '',
				'heading' => __( 'Columns', 'wolf' ),
				'param_name' => 'columns',
				'value' => array(
					4,3,2,
				),
				'description' => '',
			),

			array(
				'type' => 'dropdown',
				'holder' => 'div',
				'class' => '',
				'heading' => __( 'Order by', 'wolf' ),
				'param_name' => 'order_by',
				'value' => array(
					'Date' => 'date',
					'Title' => 'title',
				),
				'description' => ''
			),
			array(
				'type' => 'dropdown',
				'holder' => 'div',
				'class' => '',
				'heading' => __( 'Order', 'wolf' ),
				'param_name' => 'order',
				'value' => array(
					'DESC' => 'desc',
					'ASC' => 'asc'
				),
				'description' => ''
			),
		)
	)
);

/* Featured products */
vc_map(
	array(
		'name' => __( 'Featured products', 'wolf' ),
		'base' => 'featured_products',
		'icon' => 'wolf-vc-icon wolf-vc-woocommerce',
		'category' => 'WooCommerce',
		'allowed_container_element' => 'vc_row',
		'params' => array(
			array(
				'type' => 'textfield',
				'holder' => 'div',
				'class' => '',
				'heading' => __( 'Per page', 'wolf' ),
				'param_name' => 'per_page',
				'value' => '12'
			),
			array(
				'type' => 'dropdown',
				'class' => '',
				'heading' => __( 'Columns', 'wolf' ),
				'param_name' => 'columns',
				'value' => array(
					4,3,2,
				),
				'description' => '',
			),
			array(
				'type' => 'dropdown',
				'holder' => 'div',
				'class' => '',
				'heading' => __( 'Order by', 'wolf' ),
				'param_name' => 'order_by',
				'value' => array(
					'Date' => 'date',
					'Title' => 'title',
				),
				'description' => ''
			),
			array(
				'type' => 'dropdown',
				'holder' => 'div',
				'class' => '',
				'heading' => __( 'Order', 'wolf' ),
				'param_name' => 'order',
				'value' => array(
					'DESC' => 'desc',
					'ASC' => 'asc'
				),
				'description' => ''
			),
		)
	)
);


} // end woocommerce check