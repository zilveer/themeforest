<?php
#-----------------------------------------
#	RT-Theme custom_posts.php
#	version: 1.0
#-----------------------------------------

#
#	Flush rewrite rules
#	 
function rt_rewrite_rules(){ 
	if( get_option("rt_rewrite_rules") == "" ){
		add_action('init', 'flush_rewrite_rules');		 
		update_option("rt_rewrite_rules","flushed");
	}
}
add_action('init','rt_rewrite_rules',1);


#
# 	Custom Post Types
#

function rt_theme_custom_posts(){
	
	#
	#	Permalink slugs for the custom post types
	#
	
	$portfolio_slug			    = get_option(THEMESLUG."_portfolio_single_slug"); 	// singular portfolio item
	$portfolio_categories_slug 	= get_option(THEMESLUG."_portfolio_category_slug"); 	// portfolio categories
	$product_slug 				= get_option(THEMESLUG."_product_single_slug"); 		// singular product item
	$product_categories_slug 	= get_option(THEMESLUG."_product_category_slug");		// product categories 
	
	#
	#	Portfolio
	#
	
	$labels = array(
		'name' 				=> _x('Portfolio', 'portfolio', 'rt_theme_admin'),
		'singular_name' 		=> _x('portfolio', 'portfolio', 'rt_theme_admin'),
		'add_new' 			=> _x('Add New', 'portfolio item', 'rt_theme_admin'),
		'add_new_item' 		=> __('Add New portfolio item', 'rt_theme_admin'),
		'edit_item' 			=> __('Edit Portfolio Item', 'rt_theme_admin'),
		'new_item' 			=> __('New Portfolio Item', 'rt_theme_admin'),
		'view_item' 			=> __('View Portfolio Item', 'rt_theme_admin'),
		'search_items' 		=> __('Search Portfolio Item', 'rt_theme_admin'),
		'not_found' 			=>  __('No portfolio item found', 'rt_theme_admin'),
		'not_found_in_trash' 	=> __('No portfolio item found in Trash', 'rt_theme_admin'), 
		'parent_item_colon' 	=> ''
	);
	
	$args = array(
		'labels' 				=> $labels,
		'public' 				=> true,
		'publicly_queryable' 	=> true,
		'exclude_from_search' 	=> false,
		'show_ui' 			    => true, 
		'query_var' 			=> false,
		'can_export' 			=> true,
		'show_in_nav_menus' 	=> true,		
		'capability_type' 		=> 'post',
		'menu_position' 		=> null, 
		'rewrite'               => array( 'slug' => _x( $portfolio_slug, 'URL slug', 'rt_theme' ), 'with_front' => true, 'pages' => true, 'feeds'=>false ),
		'menu_icon' 			=> THEMEADMINURI .'/images/portfolio-icon.png', // 16px16
		'supports' 		    	=> array('title','editor','author','thumbnail','comments')
	);
	
	register_post_type('portfolio',$args);
	
	// Portfolio Categories
	$labels = array(
		'name' 				=> _x( 'Portfolio Categories', 'taxonomy general name' , 'rt_theme_admin'),
		'singular_name' 		=> _x( 'Portfolio Category', 'taxonomy singular name' , 'rt_theme_admin'),
		'search_items' 		=>  __( 'Search Portfolio Category' , 'rt_theme_admin'),
		'all_items' 			=> __( 'All Portfolio Categories' , 'rt_theme_admin'),
		'parent_item'			=> __( 'Parent Portfolio Category' , 'rt_theme_admin'),
		'parent_item_colon' 	=> __( 'Parent Portfolio Category:' , 'rt_theme_admin'),
		'edit_item' 			=> __( 'Edit Portfolio Category' , 'rt_theme_admin'), 
		'update_item' 			=> __( 'Update Portfolio Category' , 'rt_theme_admin'),
		'add_new_item' 		=> __( 'Add New Portfolio Category' , 'rt_theme_admin'),
		'new_item_name' 		=> __( 'New Genre Portfolio Category' , 'rt_theme_admin'),
	); 	
	
	register_taxonomy('portfolio_categories',array('portfolio'), array(
		'has_archive'   => true,
		'hierarchical' 	=> true,
		'labels' 		=> $labels,
		'show_ui' 	    => true,
		'query_var' 	=> false,
		'_builtin' 	    => false,
		'paged'		    =>true,
		'rewrite'       => array('slug'=> _x( $portfolio_categories_slug, 'URL slug', 'rt_theme' ), 'with_front'=>false ),
	));
	
	
	
	
	#
	#	Products
	#
	if ( ! class_exists( 'Woocommerce' ) ) {
		$labels = array(
			'name' 				=> _x('Product', 'product', 'rt_theme_admin'),
			'singular_name' 		=> _x('product', 'product', 'rt_theme_admin'),
			'add_new' 			=> _x('Add New', 'product item', 'rt_theme_admin'),
			'add_new_item' 		=> __('Add New Product Item', 'rt_theme_admin'),
			'edit_item' 			=> __('Edit Product Item', 'rt_theme_admin'),
			'new_item'			=> __('New Product Item', 'rt_theme_admin'),
			'view_item' 			=> __('View Product Item', 'rt_theme_admin'),
			'search_items' 		=> __('Search Product Item', 'rt_theme_admin'),
			'not_found' 			=>  __('No Product Item Iound', 'rt_theme_admin'),
			'not_found_in_trash' 	=> __('No product item found in trash', 'rt_theme_admin'), 
			'parent_item_colon'	 	=> ''
		);
	}else{
		$labels = array(
			'name' 				=> _x('Product Showcase', 'product', 'rt_theme_admin'),
			'singular_name' 		=> _x('product', 'product', 'rt_theme_admin'),
			'add_new' 			=> _x('Add New', 'product item', 'rt_theme_admin'),
			'add_new_item' 		=> __('Add New Product Item', 'rt_theme_admin'),
			'edit_item' 			=> __('Edit Product Item', 'rt_theme_admin'),
			'new_item'			=> __('New Product Item', 'rt_theme_admin'),
			'view_item' 			=> __('View Product Item', 'rt_theme_admin'),
			'search_items' 		=> __('Search Product Item', 'rt_theme_admin'),
			'not_found' 			=>  __('No Product Item Iound', 'rt_theme_admin'),
			'not_found_in_trash' 	=> __('No product item found in trash', 'rt_theme_admin'), 
			'parent_item_colon'	 	=> ''
		);
	}

	$args = array(
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => true,
		'exclude_from_search' => false,
		'show_ui' => true, 
		'query_var' => false,
		'can_export' => true,
		'show_in_nav_menus' => true,		
		'capability_type' => 'post',
		'menu_position' => null,   
		'rewrite'  => array( 'slug' => _x( $product_slug, 'URL slug', 'rt_theme' ), 'with_front' => true, 'pages' => true, 'feeds'=>false ),
		'menu_icon' => THEMEADMINURI .'/images/product-icon.png', // 16px16
		'supports' => array('title','editor','author','comments')
	);
	
	register_post_type('products',$args);
	
	// Product Categories
	$labels = array(
		'name' => _x( 'Product Categories', 'taxonomy general name' , 'rt_theme_admin'),
		'singular_name' => _x( 'Product Category', 'taxonomy singular name' , 'rt_theme_admin'),
		'search_items' =>  __( 'Search Product Category' , 'rt_theme_admin'),
		'all_items' => __( 'All Product Categories' , 'rt_theme_admin'),
		'parent_item' => __( 'Parent Product Category' , 'rt_theme_admin'),
		'parent_item_colon' => __( 'Parent Product Category:' , 'rt_theme_admin'),
		'edit_item' => __( 'Edit Product Category' , 'rt_theme_admin'), 
		'update_item' => __( 'Update Product Category' , 'rt_theme_admin'),
		'add_new_item' => __( 'Add New Product Category' , 'rt_theme_admin'),
		'new_item_name' => __( 'New Genre Product Category' , 'rt_theme_admin'),
	); 	
	
	register_taxonomy('product_categories',array('products'), array(
		'hierarchical' => true,
		'labels' => $labels,
		'show_ui' => true,
		'query_var' => false,
		'_builtin' => false,
		'paged'=>true,
		'rewrite'      => array('slug'=>_x( $product_categories_slug, 'URL slug', 'rt_theme' ),'with_front'=>false),
	));



	#
	#	Home Page Slider
	#	
	
	$labels = array(
		'name' => _x('Slider', 'slider', 'rt_theme_admin'),
		'singular_name' => _x('slider', 'slider', 'rt_theme_admin'),
		'add_new' => _x('Add New', 'slider', 'rt_theme_admin'),
		'add_new_item' => __('Add New Slide', 'rt_theme_admin'),
		'edit_item' => __('Edit Slide', 'rt_theme_admin'),
		'new_item' => __('New Slide', 'rt_theme_admin'),
		'view_item' => __('View Slide', 'rt_theme_admin'),
		'search_items' => __('Search Slide', 'rt_theme_admin'),
		'not_found' =>  __('No slide found', 'rt_theme_admin'),
		'not_found_in_trash' => __('No slide found in Trash', 'rt_theme_admin'), 
		'parent_item_colon' => ''
	);
	$args = array(
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true, 
		'query_var' => true, 
		'capability_type' => 'post', 
		'menu_position' => null,
		'rewrite' => array('slug'=>'slide','with_front'=>false),
		'menu_icon' => THEMEADMINURI .'/images/slides.png', // 16px16
		'supports' => array( 'title', 'thumbnail' )
	); 
	register_post_type('slider',$args);
	
	#
	#	Home Page Contents
	#	
	$labels = array(
		'name' => _x('Home Page', 'home_page', 'rt_theme_admin'),
		'singular_name' => _x('home_page', 'home_page', 'rt_theme_admin'),
		'add_new' => _x('Add New Box', 'home_page', 'rt_theme_admin'),
		'add_new_item' => __('Add New Box', 'rt_theme_admin'),
		'edit_item' => __('Edit Content', 'rt_theme_admin'),
		'new_item' => __('New Content', 'rt_theme_admin'),
		'view_item' => __('View Content', 'rt_theme_admin'),
		'search_items' => __('Search Content', 'rt_theme_admin'),
		'not_found' =>  __('No result found', 'rt_theme_admin'),
		'not_found_in_trash' => __('No result found in Trash', 'rt_theme_admin'), 
		'parent_item_colon' => ''
	);
	$args = array(
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true, 
		'query_var' => true, 
		'capability_type' => 'post', 
		'menu_position' => null,
		'menu_icon' => THEMEADMINURI .'/images/home_contents.png', // 16px16
		'supports' => array( 'title','editor','author','thumbnail')
	); 
	register_post_type('home_page',$args); 	
	
}

add_action('init','rt_theme_custom_posts',0);


#
# 	add productID column in product post types
#

if(is_admin()){
	// ADD NEW COLUMN
	function ST4_columns_head($defaults) {
	 $defaults['product-id'] = 'Product ID';
	 return $defaults;
	}
	
	// SHOW INFO IN THE NEW COLUMN
	function ST4_columns_content($column_name, $post_ID) { 
	   echo $post_ID;
	}
	
	add_filter('manage_products_posts_columns', 'ST4_columns_head', 10);
	add_action('manage_products_posts_custom_column', 'ST4_columns_content', 10, 2);
}



?>