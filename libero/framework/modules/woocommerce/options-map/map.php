<?php

if ( ! function_exists('libero_mikado_woocommerce_options_map') ) {

	/**
	 * Add Woocommerce options page
	 */
	function libero_mikado_woocommerce_options_map() {

		libero_mikado_add_admin_page(
			array(
				'slug' => '_woocommerce_page',
				'title' => 'Woocommerce',
				'icon' => 'icon_cart_alt'
			)
		);

		/**
		 * Product List Settings
		 */
		$panel_product_list = libero_mikado_add_admin_panel(
			array(
				'page' => '_woocommerce_page',
				'name' => 'panel_product_list',
				'title' => 'Product List'
			)
		);

		libero_mikado_add_admin_field(array(
			'name'        	=> 'mkd_woo_products_list_full_width',
			'type'        	=> 'yesno',
			'label'       	=> 'Enable Full Width Template',
			'default_value'	=> 'no',
			'description' 	=> 'Enabling this option will enable full width template for shop page',
			'parent'      	=> $panel_product_list,
		));

		libero_mikado_add_admin_field(array(
			'name'        	=> 'mkd_woo_product_list_columns',
			'type'        	=> 'select',
			'label'       	=> 'Product List Columns',
			'default_value'	=> 'mkd-woocommerce-columns-3',
			'description' 	=> 'Choose number of columns for product listing and related products on single product',
			'options'		=> array(
				'mkd-woocommerce-columns-3' => '3 Columns (2 with sidebar)',
				'mkd-woocommerce-columns-4' => '4 Columns (3 with sidebar)'
			),
			'parent'      	=> $panel_product_list,
		));

		libero_mikado_add_admin_field(array(
			'name'        	=> 'mkd_woo_products_per_page',
			'type'        	=> 'text',
			'label'       	=> 'Number of products per page',
			'default_value'	=> '',
			'description' 	=> 'Set number of products on shop page',
			'parent'      	=> $panel_product_list,
			'args' 			=> array(
				'col_width' => 3
			)
		));

		libero_mikado_add_admin_field(array(
			'name'        	=> 'mkd_products_list_title_tag',
			'type'        	=> 'select',
			'label'       	=> 'Products Title Tag',
			'default_value'	=> '',
			'description' 	=> '',
			'options'		=> array(
				'' => 'Default',
				'h1' => 'h1',
				'h2' => 'h2',
				'h3' => 'h3',
				'h4' => 'h4',
				'h5' => 'h5',
				'h6' => 'h6',
			),
			'parent'      	=> $panel_product_list,
		));

	}

	add_action( 'libero_mikado_options_map', 'libero_mikado_woocommerce_options_map',16);

}