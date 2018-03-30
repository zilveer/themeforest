<?php

class EB_Products {

	function __construct( $framework ) {

		$this->framework = $framework;
		add_action( 'init', array( $this, 'setup_products' ) );

	}

	function setup_products() {

		$labels = array(
			'name' => 'Products',
			'singular_name' => 'Product',
			'add_new' => 'Add New',
			'add_new_item' => 'Add New Product',
			'edit_item' => 'Edit Product',
			'new_item' => 'New Product',
			'all_items' => 'All Products',
			'view_item' => 'View Product',
			'search_items' => 'Search Products',
			'not_found' =>  'No products found',
			'not_found_in_trash' => 'No products found in trash',
			'menu_name' => 'Products'
		);

		$args = array(
			'labels' => $labels,
			'public' => true,
			'publicly_queryable' => true,
			'show_ui' => true,
			'show_in_menu' => true,
			'query_var' => true,
			'rewrite' => array( 'slug' => 'eb_product' ),
			'capability_type' => 'post',
			'has_archive' => true,
			'hierarchical' => false,
			'menu_position' => null,
			'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt' )
		);

		register_post_type( 'eb_product', $args );


		$labels = array(
			'name' => 'Product Lists',
			'singular_name' => 'Product List',
			'add_new' => 'Add New',
			'add_new_item' => 'Add New Product List',
			'edit_item' => 'Edit Product List',
			'new_item' => 'New Product List',
			'all_items' => 'All Product List',
			'view_item' => 'View Product List',
			'search_items' => 'Search Product List',
			'not_found' =>  'No product lists found',
			'not_found_in_trash' => 'No product lists found in trash',
			'menu_name' => 'Product Lists'
		);

		$args = array(
			'labels' => $labels,
			'public' => true,
			'publicly_queryable' => true,
			'show_ui' => true,
			'show_in_menu' => true,
			'query_var' => true,
			'rewrite' => array( 'slug' => 'eb_product_list' ),
			'capability_type' => 'post',
			'has_archive' => true,
			'hierarchical' => false,
			'menu_position' => null,
			'supports' => array( 'title', 'editor', 'thumbnail' )
		);

		register_post_type( 'eb_product_list', $args );


		$labels = array(
			'name' => 'Product Categories',
			'singular_name' => 'Product Category',
			'search_items' =>  ' Search Product Categories',
			'all_items' => 'All Product Categories',
			'parent_item' => 'Parent Product Category',
			'parent_item_colon' => 'Parent Product Category:',
			'edit_item' => 'Edit Product Categories',
			'update_item' => 'Edit Product Category',
			'add_new_item' => 'Add New Product Category',
			'new_item_name' => 'New Product Categories Name',
			'menu_name' => __( 'Product Categories' ),
		);

		register_taxonomy( 'eb_product_category' ,array('eb_product'), array(
			'hierarchical' => true,
			'labels' => $labels,
			'show_ui' => true,
			'show_admin_column' => true,
			'query_var' => true,
			'rewrite' => array( 'slug' => 'eb_product_category' ),
		));



	}



	function display_price( $price, $currency = '', $position = ''  ) {
		if( !empty( $price ) ){
		if( empty( $currency ) ) {
			$currency = $this->framework->options['currency'];
		}
		if( empty( $position ) ) {
			$position = $this->framework->options['currency_position'];
		}

		if( $position == 'before' ) {
			echo $currency . $price;
		}
		else {
			echo $price . $currency;
		}
		}
	}

}


?>