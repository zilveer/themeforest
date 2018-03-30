<?php
if( !function_exists('vc_map') ){
	return;
}

add_action( 'vc_before_init', 'wd_vc_generator' );
function wd_vc_generator(){
	
	vc_remove_param('vc_tta_tabs', 'color');
	vc_remove_param('vc_tta_tabs', 'style');
	vc_remove_param('vc_tta_tabs', 'shape');
	vc_remove_param('vc_tta_tabs', 'no_fill_content_area');
	vc_remove_param('vc_tta_tabs', 'spacing');
	vc_remove_param('vc_tta_tabs', 'gap');
	vc_remove_param('vc_tta_tabs', 'alignment');
	vc_remove_param('vc_tta_tabs', 'pagination_style');
	vc_remove_param('vc_tta_tabs', 'pagination_color');
	
	vc_remove_param('vc_tta_accordion', 'color');
	vc_remove_param('vc_tta_accordion', 'style');
	vc_remove_param('vc_tta_accordion', 'shape');
	vc_remove_param('vc_tta_accordion', 'no_fill');
	vc_remove_param('vc_tta_accordion', 'spacing');
	vc_remove_param('vc_tta_accordion', 'gap');
	vc_remove_param('vc_tta_accordion', 'alignment');
	vc_remove_param('vc_tta_accordion', 'pagination_style');
	vc_remove_param('vc_tta_accordion', 'pagination_color');
	
	vc_remove_param( 'vc_row', 'el_id' );
	
	vc_add_param( 'vc_row', array(
		'type' => 'textfield'
		,'class' => ''
		,'show_settings_on_create' => true
		,'heading' => __('Row ID', 'wpdance')
		,'param_name' => 'row_id'
		,'value' => ''
	));

	/* Custom Product */
	vc_map( array(
		'name' => __( 'Custom Product', 'wpdance' )
		,'base' => 'custom_product'
		,'category' => __( 'WD Product', 'wpdance')
		,'params' => array(
			array(
				'type' => 'textfield'
				,'heading' => __( 'Block title', 'wpdance' )
				,'param_name' => 'title'
				,'admin_label' => true
				,'value' => ''
				,'description' => ''
			)
			,array(
				'type' => 'dropdown'
				,'heading' => __( 'Style', 'wpdance' )
				,'param_name' => 'style'
				,'admin_label' => true
				,'value' => array(
					'1'		=> '1'
					,'2'	=> '2'
					,'Big'	=> 'big'
					)
				,'description' => ''
			 )
			 ,array(
				'type' => 'textfield'
				,'heading' => __( 'Product ID', 'wpdance' )
				,'param_name' => 'id'
				,'admin_label' => true
				,'value' => ''
				,'description' => ''
			 )
			 ,array(
				'type' => 'textfield'
				,'heading' => __( 'Product SKU', 'wpdance' )
				,'param_name' => 'sku'
				,'admin_label' => true
				,'value' => ''
				,'description' => ''
			 )
			 ,array(
				'type' => 'dropdown'
				,'heading' => __( 'Show add to cart button', 'wpdance' )
				,'param_name' => 'show_add_to_cart'
				,'admin_label' => true
				,'value' => array(
					'Yes'		=> 1
					,'No'		=> 0
					)
				,'description' => ''
			 )
			 ,array(
				'type' => 'dropdown'
				,'heading' => __( 'Show SKU', 'wpdance' )
				,'param_name' => 'show_sku'
				,'admin_label' => true
				,'value' => array(
					'Yes'		=> 1
					,'No'		=> 0
					)
				,'description' => ''
			 )
			 ,array(
				'type' => 'dropdown'
				,'heading' => __( 'Show rating', 'wpdance' )
				,'param_name' => 'show_rating'
				,'admin_label' => true
				,'value' => array(
					'Yes'		=> 1
					,'No'		=> 0
					)
				,'description' => ''
			 )
			 ,array(
				'type' => 'dropdown'
				,'heading' => __( 'Show label', 'wpdance' )
				,'param_name' => 'show_label'
				,'admin_label' => true
				,'value' => array(
					'Yes'		=> 1
					,'No'		=> 0
					)
				,'description' => ''
			 )
			 ,array(
				'type' => 'dropdown'
				,'heading' => __( 'Show categories', 'wpdance' )
				,'param_name' => 'show_categories'
				,'admin_label' => true
				,'value' => array(
					'No'		=> 0
					,'Yes'		=> 1
					)
				,'description' => ''
			 )
			 ,array(
				'type' => 'dropdown'
				,'heading' => __( 'Show short description', 'wpdance' )
				,'param_name' => 'show_short_desc'
				,'admin_label' => true
				,'value' => array(
					'No'		=> 0
					,'Yes'		=> 1
					)
				,'description' => ''
			 )
		)
	));
	
	/* Custom Products */
	vc_map( array(
		'name' => __( 'Custom Products', 'wpdance' )
		,'base' => 'custom_products'
		,'category' => __( 'WD Product', 'wpdance')
		,'params' => array(
			array(
				'type' => 'dropdown'
				,'heading' => __( 'Style', 'wpdance' )
				,'param_name' => 'style'
				,'admin_label' => true
				,'value' => array(
					'1'		=> '1'
					,'2'	=> '2'
					)
				,'description' => ''
			 )
			 ,array(
				'type' => 'textfield'
				,'heading' => __( 'Product IDs', 'wpdance' )
				,'param_name' => 'ids'
				,'admin_label' => true
				,'value' => ''
				,'description' => __('A comma separated list of product ids', 'wpdance')
			 )
			 ,array(
				'type' => 'textfield'
				,'heading' => __( 'Product SKUs', 'wpdance' )
				,'param_name' => 'skus'
				,'admin_label' => true
				,'value' => ''
				,'description' => __('A comma separated list of product skus', 'wpdance')
			 )
			 
			 ,array(
				'type' => 'dropdown'
				,'heading' => __( 'Show SKU', 'wpdance' )
				,'param_name' => 'show_sku'
				,'admin_label' => true
				,'value' => array(
					'Yes'		=> 1
					,'No'		=> 0
					)
				,'description' => ''
			 )
			 ,array(
				'type' => 'dropdown'
				,'heading' => __( 'Show rating', 'wpdance' )
				,'param_name' => 'show_rating'
				,'admin_label' => true
				,'value' => array(
					'Yes'		=> 1
					,'No'		=> 0
					)
				,'description' => ''
			 )
			 ,array(
				'type' => 'dropdown'
				,'heading' => __( 'Show product title', 'wpdance' )
				,'param_name' => 'show_title'
				,'admin_label' => true
				,'value' => array(
					'Yes'		=> 1
					,'No'		=> 0
					)
				,'description' => ''
			 )
			 ,array(
				'type' => 'dropdown'
				,'heading' => __( 'Show price', 'wpdance' )
				,'param_name' => 'show_price'
				,'admin_label' => true
				,'value' => array(
					'Yes'		=> 1
					,'No'		=> 0
					)
				,'description' => ''
			 )
			 ,array(
				'type' => 'dropdown'
				,'heading' => __( 'Show short description', 'wpdance' )
				,'param_name' => 'show_short_desc'
				,'admin_label' => true
				,'value' => array(
					'Yes'		=> 1
					,'No'		=> 0
					)
				,'description' => ''
			 )
			 ,array(
				'type' => 'dropdown'
				,'heading' => __( 'Show label', 'wpdance' )
				,'param_name' => 'show_label'
				,'admin_label' => true
				,'value' => array(
					'Yes'		=> 1
					,'No'		=> 0
					)
				,'description' => ''
			 )
			 ,array(
				'type' => 'dropdown'
				,'heading' => __( 'Show label before product title', 'wpdance' )
				,'param_name' => 'show_label_title'
				,'admin_label' => true
				,'value' => array(
					'No'		=> 0
					,'Yes'		=> 1
					)
				,'description' => ''
			 )
			 ,array(
				'type' => 'dropdown'
				,'heading' => __( 'Show categories', 'wpdance' )
				,'param_name' => 'show_categories'
				,'admin_label' => true
				,'value' => array(
					'No'		=> 0
					,'Yes'		=> 1
					)
				,'description' => ''
			 )
			 ,array(
				'type' => 'dropdown'
				,'heading' => __( 'Show add to cart button', 'wpdance' )
				,'param_name' => 'show_add_to_cart'
				,'admin_label' => true
				,'value' => array(
					'Yes'		=> 1
					,'No'		=> 0
					)
				,'description' => ''
			 )
		)
	));
	
	/* Featured Product */
	vc_map( array(
		'name' => __( 'Featured Product', 'wpdance' )
		,'base' => 'featured_product'
		,'category' => __( 'WD Product', 'wpdance')
		,'params' => array(
			array(
				'type' => 'textfield'
				,'heading' => __( 'Block title', 'wpdance' )
				,'param_name' => 'title'
				,'admin_label' => true
				,'value' => ''
				,'description' => ''
			)
			,array(
				'type' => 'textfield'
				,'heading' => __( 'Icon before title', 'wpdance' )
				,'param_name' => 'icon_title_class'
				,'admin_label' => true
				,'value' => ''
				,'description' => __('Use icon (FontAwesome class) instead of image. Ex: fa-home', 'wpdance')
			)
			,array(
				'type' => 'textarea'
				,'heading' => __( 'Block description', 'wpdance' )
				,'param_name' => 'desc'
				,'admin_label' => true
				,'value' => ''
				,'description' => ''
			)
			,array(
				'type' => 'dropdown'
				,'heading' => __( 'Style', 'wpdance' )
				,'param_name' => 'style'
				,'admin_label' => true
				,'value' => array(
					'1'		=> '1'
					,'2'	=> '2'
					)
				,'description' => ''
			 )
			,array(
				'type' => 'textfield'
				,'heading' => __( 'Columns', 'wpdance' )
				,'param_name' => 'columns'
				,'admin_label' => true
				,'value' => '4'
				,'description' => ''
			)
			,array(
				'type' => 'textfield'
				,'heading' => __( 'Number of products', 'wpdance' )
				,'param_name' => 'per_page'
				,'admin_label' => true
				,'value' => '8'
				,'description' => ''
			)
			,array(
				'type' => 'textarea'
				,'heading' => __( 'Product Categories', 'wpdance' )
				,'param_name' => 'product_cats'
				,'admin_label' => true
				,'value' => ''
				,'description' => __('A comma separated list of product category slugs', 'wpdance')
			 )
			 ,array(
				'type' => 'dropdown'
				,'heading' => __( 'Show product image', 'wpdance' )
				,'param_name' => 'show_image'
				,'admin_label' => true
				,'value' => array(
					'Yes'		=> 1
					,'No'		=> 0
					)
				,'description' => ''
			 )
			 ,array(
				'type' => 'dropdown'
				,'heading' => __( 'Show product title', 'wpdance' )
				,'param_name' => 'show_title'
				,'admin_label' => true
				,'value' => array(
					'Yes'		=> 1
					,'No'		=> 0
					)
				,'description' => ''
			 )
			 ,array(
				'type' => 'dropdown'
				,'heading' => __( 'Show SKU', 'wpdance' )
				,'param_name' => 'show_sku'
				,'admin_label' => true
				,'value' => array(
					'No'		=> 0
					,'Yes'		=> 1
					)
				,'description' => ''
			 )
			 ,array(
				'type' => 'dropdown'
				,'heading' => __( 'Show price', 'wpdance' )
				,'param_name' => 'show_price'
				,'admin_label' => true
				,'value' => array(
					'Yes'		=> 1
					,'No'		=> 0
					)
				,'description' => ''
			 )
			 ,array(
				'type' => 'dropdown'
				,'heading' => __( 'Show short description', 'wpdance' )
				,'param_name' => 'show_short_desc'
				,'admin_label' => true
				,'value' => array(
					'Yes'		=> 1
					,'No'		=> 0
					)
				,'description' => ''
			 )
			 ,array(
				'type' => 'dropdown'
				,'heading' => __( 'Show rating', 'wpdance' )
				,'param_name' => 'show_rating'
				,'admin_label' => true
				,'value' => array(
					'Yes'		=> 1
					,'No'		=> 0
					)
				,'description' => ''
			 )
			 ,array(
				'type' => 'dropdown'
				,'heading' => __( 'Show label', 'wpdance' )
				,'param_name' => 'show_label'
				,'admin_label' => true
				,'value' => array(
					'Yes'		=> 1
					,'No'		=> 0
					)
				,'description' => ''
			 )
			 ,array(
				'type' => 'dropdown'
				,'heading' => __( 'Show label before product title', 'wpdance' )
				,'param_name' => 'show_label_title'
				,'admin_label' => true
				,'value' => array(
					'No'		=> 0
					,'Yes'		=> 1
					)
				,'description' => ''
			 )
			 ,array(
				'type' => 'dropdown'
				,'heading' => __( 'Show categories', 'wpdance' )
				,'param_name' => 'show_categories'
				,'admin_label' => true
				,'value' => array(
					'No'		=> 0
					,'Yes'		=> 1
					)
				,'description' => ''
			 )
			 ,array(
				'type' => 'dropdown'
				,'heading' => __( 'Show add to cart button', 'wpdance' )
				,'param_name' => 'show_add_to_cart'
				,'admin_label' => true
				,'value' => array(
					'Yes'		=> 1
					,'No'		=> 0
					)
				,'description' => ''
			 )
			 ,array(
				'type' => 'dropdown'
				,'heading' => __( 'Show load more button', 'wpdance' )
				,'param_name' => 'show_load_more'
				,'admin_label' => true
				,'value' => array(
					'No'		=> 0
					,'Yes'		=> 1
					)
				,'description' => ''
			 )
		)
	));
	
	/* Featured Product slider */
	vc_map( array(
		'name' => __( 'Featured Product Slider', 'wpdance' )
		,'base' => 'featured_product_slider'
		,'category' => __( 'WD Product', 'wpdance')
		,'params' => array(
			array(
				'type' => 'textfield'
				,'heading' => __( 'Block title', 'wpdance' )
				,'param_name' => 'title'
				,'admin_label' => true
				,'value' => ''
				,'description' => ''
			)
			,array(
				'type' => 'textfield'
				,'heading' => __( 'Icon before title', 'wpdance' )
				,'param_name' => 'icon_title_class'
				,'admin_label' => true
				,'value' => ''
				,'description' => __('Use icon (FontAwesome class) instead of image. Ex: fa-home', 'wpdance')
			)
			,array(
				'type' => 'textarea'
				,'heading' => __( 'Block description', 'wpdance' )
				,'param_name' => 'desc'
				,'admin_label' => true
				,'value' => ''
				,'description' => ''
			)
			,array(
				'type' => 'dropdown'
				,'heading' => __( 'Style', 'wpdance' )
				,'param_name' => 'style'
				,'admin_label' => true
				,'value' => array(
					'1'		=> '1'
					,'2'	=> '2'
					)
				,'description' => ''
			 )
			,array(
				'type' => 'textfield'
				,'heading' => __( 'Columns', 'wpdance' )
				,'param_name' => 'columns'
				,'admin_label' => true
				,'value' => '4'
				,'description' => ''
			)
			,array(
				'type' => 'textfield'
				,'heading' => __( 'Number of products', 'wpdance' )
				,'param_name' => 'per_page'
				,'admin_label' => true
				,'value' => '8'
				,'description' => ''
			)
			,array(
				'type' => 'textarea'
				,'heading' => __( 'Product Categories', 'wpdance' )
				,'param_name' => 'product_cats'
				,'admin_label' => true
				,'value' => ''
				,'description' => __('A comma separated list of product category slugs', 'wpdance')
			 )
			 ,array(
				'type' => 'dropdown'
				,'heading' => __( 'Show product image', 'wpdance' )
				,'param_name' => 'show_image'
				,'admin_label' => true
				,'value' => array(
					'Yes'		=> 1
					,'No'		=> 0
					)
				,'description' => ''
			 )
			 ,array(
				'type' => 'dropdown'
				,'heading' => __( 'Show product title', 'wpdance' )
				,'param_name' => 'show_title'
				,'admin_label' => true
				,'value' => array(
					'Yes'		=> 1
					,'No'		=> 0
					)
				,'description' => ''
			 )
			 ,array(
				'type' => 'dropdown'
				,'heading' => __( 'Show SKU', 'wpdance' )
				,'param_name' => 'show_sku'
				,'admin_label' => true
				,'value' => array(
					'No'		=> 0
					,'Yes'		=> 1
					)
				,'description' => ''
			 )
			 ,array(
				'type' => 'dropdown'
				,'heading' => __( 'Show price', 'wpdance' )
				,'param_name' => 'show_price'
				,'admin_label' => true
				,'value' => array(
					'Yes'		=> 1
					,'No'		=> 0
					)
				,'description' => ''
			 )
			 ,array(
				'type' => 'dropdown'
				,'heading' => __( 'Show short description', 'wpdance' )
				,'param_name' => 'show_short_desc'
				,'admin_label' => true
				,'value' => array(
					'Yes'		=> 1
					,'No'		=> 0
					)
				,'description' => ''
			 )
			 ,array(
				'type' => 'dropdown'
				,'heading' => __( 'Show rating', 'wpdance' )
				,'param_name' => 'show_rating'
				,'admin_label' => true
				,'value' => array(
					'Yes'		=> 1
					,'No'		=> 0
					)
				,'description' => ''
			 )
			 ,array(
				'type' => 'dropdown'
				,'heading' => __( 'Show label', 'wpdance' )
				,'param_name' => 'show_label'
				,'admin_label' => true
				,'value' => array(
					'Yes'		=> 1
					,'No'		=> 0
					)
				,'description' => ''
			 )
			 ,array(
				'type' => 'dropdown'
				,'heading' => __( 'Show label before product title', 'wpdance' )
				,'param_name' => 'show_label_title'
				,'admin_label' => true
				,'value' => array(
					'No'		=> 0
					,'Yes'		=> 1
					)
				,'description' => ''
			 )
			 ,array(
				'type' => 'dropdown'
				,'heading' => __( 'Show categories', 'wpdance' )
				,'param_name' => 'show_categories'
				,'admin_label' => true
				,'value' => array(
					'No'		=> 0
					,'Yes'		=> 1
					)
				,'description' => ''
			 )
			 ,array(
				'type' => 'dropdown'
				,'heading' => __( 'Show add to cart button', 'wpdance' )
				,'param_name' => 'show_add_to_cart'
				,'admin_label' => true
				,'value' => array(
					'Yes'		=> 1
					,'No'		=> 0
					)
				,'description' => ''
			 )
			 ,array(
				'type' => 'dropdown'
				,'heading' => __( 'Show navigation buttons', 'wpdance' )
				,'param_name' => 'show_nav'
				,'admin_label' => true
				,'value' => array(
					'Yes'		=> 1
					,'No'		=> 0
					)
				,'description' => ''
			 )
		)
	));
	
	/* Popular Product */
	vc_map( array(
		'name' => __( 'Popular Product', 'wpdance' )
		,'base' => 'popular_product'
		,'category' => __( 'WD Product', 'wpdance')
		,'params' => array(
			array(
				'type' => 'textfield'
				,'heading' => __( 'Block title', 'wpdance' )
				,'param_name' => 'title'
				,'admin_label' => true
				,'value' => ''
				,'description' => ''
			)
			,array(
				'type' => 'textfield'
				,'heading' => __( 'Icon before title', 'wpdance' )
				,'param_name' => 'icon_title_class'
				,'admin_label' => true
				,'value' => ''
				,'description' => __('Use icon (FontAwesome class) instead of image. Ex: fa-home', 'wpdance')
			)
			,array(
				'type' => 'textarea'
				,'heading' => __( 'Block description', 'wpdance' )
				,'param_name' => 'desc'
				,'admin_label' => true
				,'value' => ''
				,'description' => ''
			)
			,array(
				'type' => 'dropdown'
				,'heading' => __( 'Style', 'wpdance' )
				,'param_name' => 'style'
				,'admin_label' => true
				,'value' => array(
					'1'		=> '1'
					,'2'	=> '2'
					)
				,'description' => ''
			 )
			,array(
				'type' => 'textfield'
				,'heading' => __( 'Columns', 'wpdance' )
				,'param_name' => 'columns'
				,'admin_label' => true
				,'value' => '4'
				,'description' => ''
			)
			,array(
				'type' => 'textfield'
				,'heading' => __( 'Number of products', 'wpdance' )
				,'param_name' => 'per_page'
				,'admin_label' => true
				,'value' => '8'
				,'description' => ''
			)
			,array(
				'type' => 'textarea'
				,'heading' => __( 'Product Categories', 'wpdance' )
				,'param_name' => 'product_cats'
				,'admin_label' => true
				,'value' => ''
				,'description' => __('A comma separated list of product category slugs', 'wpdance')
			 )
			 ,array(
				'type' => 'dropdown'
				,'heading' => __( 'Show product image', 'wpdance' )
				,'param_name' => 'show_image'
				,'admin_label' => true
				,'value' => array(
					'Yes'		=> 1
					,'No'		=> 0
					)
				,'description' => ''
			 )
			 ,array(
				'type' => 'dropdown'
				,'heading' => __( 'Show product title', 'wpdance' )
				,'param_name' => 'show_title'
				,'admin_label' => true
				,'value' => array(
					'Yes'		=> 1
					,'No'		=> 0
					)
				,'description' => ''
			 )
			 ,array(
				'type' => 'dropdown'
				,'heading' => __( 'Show SKU', 'wpdance' )
				,'param_name' => 'show_sku'
				,'admin_label' => true
				,'value' => array(
					'No'		=> 0
					,'Yes'		=> 1
					)
				,'description' => ''
			 )
			 ,array(
				'type' => 'dropdown'
				,'heading' => __( 'Show price', 'wpdance' )
				,'param_name' => 'show_price'
				,'admin_label' => true
				,'value' => array(
					'Yes'		=> 1
					,'No'		=> 0
					)
				,'description' => ''
			 )
			 ,array(
				'type' => 'dropdown'
				,'heading' => __( 'Show short description', 'wpdance' )
				,'param_name' => 'show_short_desc'
				,'admin_label' => true
				,'value' => array(
					'Yes'		=> 1
					,'No'		=> 0
					)
				,'description' => ''
			 )
			 ,array(
				'type' => 'dropdown'
				,'heading' => __( 'Show rating', 'wpdance' )
				,'param_name' => 'show_rating'
				,'admin_label' => true
				,'value' => array(
					'Yes'		=> 1
					,'No'		=> 0
					)
				,'description' => ''
			 )
			 ,array(
				'type' => 'dropdown'
				,'heading' => __( 'Show label', 'wpdance' )
				,'param_name' => 'show_label'
				,'admin_label' => true
				,'value' => array(
					'Yes'		=> 1
					,'No'		=> 0
					)
				,'description' => ''
			 )
			 ,array(
				'type' => 'dropdown'
				,'heading' => __( 'Show label before product title', 'wpdance' )
				,'param_name' => 'show_label_title'
				,'admin_label' => true
				,'value' => array(
					'No'		=> 0
					,'Yes'		=> 1
					)
				,'description' => ''
			 )
			 ,array(
				'type' => 'dropdown'
				,'heading' => __( 'Show categories', 'wpdance' )
				,'param_name' => 'show_categories'
				,'admin_label' => true
				,'value' => array(
					'No'		=> 0
					,'Yes'		=> 1
					)
				,'description' => ''
			 )
			 ,array(
				'type' => 'dropdown'
				,'heading' => __( 'Show add to cart button', 'wpdance' )
				,'param_name' => 'show_add_to_cart'
				,'admin_label' => true
				,'value' => array(
					'Yes'		=> 1
					,'No'		=> 0
					)
				,'description' => ''
			 )
			 ,array(
				'type' => 'dropdown'
				,'heading' => __( 'Show load more button', 'wpdance' )
				,'param_name' => 'show_load_more'
				,'admin_label' => true
				,'value' => array(
					'No'		=> 0
					,'Yes'		=> 1
					)
				,'description' => ''
			 )
		)
	));
	
	/* Popular Product slider */
	vc_map( array(
		'name' => __( 'Popular Product Slider', 'wpdance' )
		,'base' => 'popular_product_slider'
		,'category' => __( 'WD Product', 'wpdance')
		,'params' => array(
			array(
				'type' => 'textfield'
				,'heading' => __( 'Block title', 'wpdance' )
				,'param_name' => 'title'
				,'admin_label' => true
				,'value' => ''
				,'description' => ''
			)
			,array(
				'type' => 'textfield'
				,'heading' => __( 'Icon before title', 'wpdance' )
				,'param_name' => 'icon_title_class'
				,'admin_label' => true
				,'value' => ''
				,'description' => __('Use icon (FontAwesome class) instead of image. Ex: fa-home', 'wpdance')
			)
			,array(
				'type' => 'textarea'
				,'heading' => __( 'Block description', 'wpdance' )
				,'param_name' => 'desc'
				,'admin_label' => true
				,'value' => ''
				,'description' => ''
			)
			,array(
				'type' => 'dropdown'
				,'heading' => __( 'Style', 'wpdance' )
				,'param_name' => 'style'
				,'admin_label' => true
				,'value' => array(
					'1'		=> '1'
					,'2'	=> '2'
					)
				,'description' => ''
			 )
			,array(
				'type' => 'textfield'
				,'heading' => __( 'Columns', 'wpdance' )
				,'param_name' => 'columns'
				,'admin_label' => true
				,'value' => '4'
				,'description' => ''
			)
			,array(
				'type' => 'textfield'
				,'heading' => __( 'Number of products', 'wpdance' )
				,'param_name' => 'per_page'
				,'admin_label' => true
				,'value' => '8'
				,'description' => ''
			)
			,array(
				'type' => 'textarea'
				,'heading' => __( 'Product Categories', 'wpdance' )
				,'param_name' => 'product_cats'
				,'admin_label' => true
				,'value' => ''
				,'description' => __('A comma separated list of product category slugs', 'wpdance')
			 )
			 ,array(
				'type' => 'dropdown'
				,'heading' => __( 'Show product image', 'wpdance' )
				,'param_name' => 'show_image'
				,'admin_label' => true
				,'value' => array(
					'Yes'		=> 1
					,'No'		=> 0
					)
				,'description' => ''
			 )
			 ,array(
				'type' => 'dropdown'
				,'heading' => __( 'Show product title', 'wpdance' )
				,'param_name' => 'show_title'
				,'admin_label' => true
				,'value' => array(
					'Yes'		=> 1
					,'No'		=> 0
					)
				,'description' => ''
			 )
			 ,array(
				'type' => 'dropdown'
				,'heading' => __( 'Show SKU', 'wpdance' )
				,'param_name' => 'show_sku'
				,'admin_label' => true
				,'value' => array(
					'No'		=> 0
					,'Yes'		=> 1
					)
				,'description' => ''
			 )
			 ,array(
				'type' => 'dropdown'
				,'heading' => __( 'Show price', 'wpdance' )
				,'param_name' => 'show_price'
				,'admin_label' => true
				,'value' => array(
					'Yes'		=> 1
					,'No'		=> 0
					)
				,'description' => ''
			 )
			 ,array(
				'type' => 'dropdown'
				,'heading' => __( 'Show short description', 'wpdance' )
				,'param_name' => 'show_short_desc'
				,'admin_label' => true
				,'value' => array(
					'Yes'		=> 1
					,'No'		=> 0
					)
				,'description' => ''
			 )
			 ,array(
				'type' => 'dropdown'
				,'heading' => __( 'Show rating', 'wpdance' )
				,'param_name' => 'show_rating'
				,'admin_label' => true
				,'value' => array(
					'Yes'		=> 1
					,'No'		=> 0
					)
				,'description' => ''
			 )
			 ,array(
				'type' => 'dropdown'
				,'heading' => __( 'Show label', 'wpdance' )
				,'param_name' => 'show_label'
				,'admin_label' => true
				,'value' => array(
					'Yes'		=> 1
					,'No'		=> 0
					)
				,'description' => ''
			 )
			 ,array(
				'type' => 'dropdown'
				,'heading' => __( 'Show label before product title', 'wpdance' )
				,'param_name' => 'show_label_title'
				,'admin_label' => true
				,'value' => array(
					'No'		=> 0
					,'Yes'		=> 1
					)
				,'description' => ''
			 )
			 ,array(
				'type' => 'dropdown'
				,'heading' => __( 'Show categories', 'wpdance' )
				,'param_name' => 'show_categories'
				,'admin_label' => true
				,'value' => array(
					'No'		=> 0
					,'Yes'		=> 1
					)
				,'description' => ''
			 )
			 ,array(
				'type' => 'dropdown'
				,'heading' => __( 'Show add to cart button', 'wpdance' )
				,'param_name' => 'show_add_to_cart'
				,'admin_label' => true
				,'value' => array(
					'Yes'		=> 1
					,'No'		=> 0
					)
				,'description' => ''
			 )
			 ,array(
				'type' => 'dropdown'
				,'heading' => __( 'Show navigation buttons', 'wpdance' )
				,'param_name' => 'show_nav'
				,'admin_label' => true
				,'value' => array(
					'Yes'		=> 1
					,'No'		=> 0
					)
				,'description' => ''
			 )
		)
	));
	
	/* Recent Product */
	vc_map( array(
		'name' => __( 'Recent Product', 'wpdance' )
		,'base' => 'recent_product'
		,'category' => __( 'WD Product', 'wpdance')
		,'params' => array(
			array(
				'type' => 'textfield'
				,'heading' => __( 'Block title', 'wpdance' )
				,'param_name' => 'title'
				,'admin_label' => true
				,'value' => ''
				,'description' => ''
			)
			,array(
				'type' => 'textfield'
				,'heading' => __( 'Icon before title', 'wpdance' )
				,'param_name' => 'icon_title_class'
				,'admin_label' => true
				,'value' => ''
				,'description' => __('Use icon (FontAwesome class) instead of image. Ex: fa-home', 'wpdance')
			)
			,array(
				'type' => 'textarea'
				,'heading' => __( 'Block description', 'wpdance' )
				,'param_name' => 'desc'
				,'admin_label' => true
				,'value' => ''
				,'description' => ''
			)
			,array(
				'type' => 'dropdown'
				,'heading' => __( 'Style', 'wpdance' )
				,'param_name' => 'style'
				,'admin_label' => true
				,'value' => array(
					'1'		=> '1'
					,'2'	=> '2'
					)
				,'description' => ''
			 )
			,array(
				'type' => 'textfield'
				,'heading' => __( 'Columns', 'wpdance' )
				,'param_name' => 'columns'
				,'admin_label' => true
				,'value' => '4'
				,'description' => ''
			)
			,array(
				'type' => 'textfield'
				,'heading' => __( 'Number of products', 'wpdance' )
				,'param_name' => 'per_page'
				,'admin_label' => true
				,'value' => '8'
				,'description' => ''
			)
			,array(
				'type' => 'textarea'
				,'heading' => __( 'Product Categories', 'wpdance' )
				,'param_name' => 'product_cats'
				,'admin_label' => true
				,'value' => ''
				,'description' => __('A comma separated list of product category slugs', 'wpdance')
			 )
			 ,array(
				'type' => 'dropdown'
				,'heading' => __( 'Show product image', 'wpdance' )
				,'param_name' => 'show_image'
				,'admin_label' => true
				,'value' => array(
					'Yes'		=> 1
					,'No'		=> 0
					)
				,'description' => ''
			 )
			 ,array(
				'type' => 'dropdown'
				,'heading' => __( 'Show product title', 'wpdance' )
				,'param_name' => 'show_title'
				,'admin_label' => true
				,'value' => array(
					'Yes'		=> 1
					,'No'		=> 0
					)
				,'description' => ''
			 )
			 ,array(
				'type' => 'dropdown'
				,'heading' => __( 'Show SKU', 'wpdance' )
				,'param_name' => 'show_sku'
				,'admin_label' => true
				,'value' => array(
					'No'		=> 0
					,'Yes'		=> 1
					)
				,'description' => ''
			 )
			 ,array(
				'type' => 'dropdown'
				,'heading' => __( 'Show price', 'wpdance' )
				,'param_name' => 'show_price'
				,'admin_label' => true
				,'value' => array(
					'Yes'		=> 1
					,'No'		=> 0
					)
				,'description' => ''
			 )
			 ,array(
				'type' => 'dropdown'
				,'heading' => __( 'Show short description', 'wpdance' )
				,'param_name' => 'show_short_desc'
				,'admin_label' => true
				,'value' => array(
					'Yes'		=> 1
					,'No'		=> 0
					)
				,'description' => ''
			 )
			 ,array(
				'type' => 'dropdown'
				,'heading' => __( 'Show rating', 'wpdance' )
				,'param_name' => 'show_rating'
				,'admin_label' => true
				,'value' => array(
					'Yes'		=> 1
					,'No'		=> 0
					)
				,'description' => ''
			 )
			 ,array(
				'type' => 'dropdown'
				,'heading' => __( 'Show label', 'wpdance' )
				,'param_name' => 'show_label'
				,'admin_label' => true
				,'value' => array(
					'Yes'		=> 1
					,'No'		=> 0
					)
				,'description' => ''
			 )
			 ,array(
				'type' => 'dropdown'
				,'heading' => __( 'Show label before product title', 'wpdance' )
				,'param_name' => 'show_label_title'
				,'admin_label' => true
				,'value' => array(
					'No'		=> 0
					,'Yes'		=> 1
					)
				,'description' => ''
			 )
			 ,array(
				'type' => 'dropdown'
				,'heading' => __( 'Show categories', 'wpdance' )
				,'param_name' => 'show_categories'
				,'admin_label' => true
				,'value' => array(
					'No'		=> 0
					,'Yes'		=> 1
					)
				,'description' => ''
			 )
			 ,array(
				'type' => 'dropdown'
				,'heading' => __( 'Show add to cart button', 'wpdance' )
				,'param_name' => 'show_add_to_cart'
				,'admin_label' => true
				,'value' => array(
					'Yes'		=> 1
					,'No'		=> 0
					)
				,'description' => ''
			 )
			 ,array(
				'type' => 'dropdown'
				,'heading' => __( 'Show load more button', 'wpdance' )
				,'param_name' => 'show_load_more'
				,'admin_label' => true
				,'value' => array(
					'No'		=> 0
					,'Yes'		=> 1
					)
				,'description' => ''
			 )
		)
	));
	
	/* Recent Product slider */
	vc_map( array(
		'name' => __( 'Recent Product Slider', 'wpdance' )
		,'base' => 'recent_product_slider'
		,'category' => __( 'WD Product', 'wpdance')
		,'params' => array(
			array(
				'type' => 'textfield'
				,'heading' => __( 'Block title', 'wpdance' )
				,'param_name' => 'title'
				,'admin_label' => true
				,'value' => ''
				,'description' => ''
			)
			,array(
				'type' => 'textfield'
				,'heading' => __( 'Icon before title', 'wpdance' )
				,'param_name' => 'icon_title_class'
				,'admin_label' => true
				,'value' => ''
				,'description' => __('Use icon (FontAwesome class) instead of image. Ex: fa-home', 'wpdance')
			)
			,array(
				'type' => 'textarea'
				,'heading' => __( 'Block description', 'wpdance' )
				,'param_name' => 'desc'
				,'admin_label' => true
				,'value' => ''
				,'description' => ''
			)
			,array(
				'type' => 'dropdown'
				,'heading' => __( 'Style', 'wpdance' )
				,'param_name' => 'style'
				,'admin_label' => true
				,'value' => array(
					'1'		=> '1'
					,'2'	=> '2'
					)
				,'description' => ''
			 )
			,array(
				'type' => 'textfield'
				,'heading' => __( 'Columns', 'wpdance' )
				,'param_name' => 'columns'
				,'admin_label' => true
				,'value' => '4'
				,'description' => ''
			)
			,array(
				'type' => 'textfield'
				,'heading' => __( 'Number of products', 'wpdance' )
				,'param_name' => 'per_page'
				,'admin_label' => true
				,'value' => '8'
				,'description' => ''
			)
			,array(
				'type' => 'textarea'
				,'heading' => __( 'Product Categories', 'wpdance' )
				,'param_name' => 'product_cats'
				,'admin_label' => true
				,'value' => ''
				,'description' => __('A comma separated list of product category slugs', 'wpdance')
			 )
			 ,array(
				'type' => 'dropdown'
				,'heading' => __( 'Show product image', 'wpdance' )
				,'param_name' => 'show_image'
				,'admin_label' => true
				,'value' => array(
					'Yes'		=> 1
					,'No'		=> 0
					)
				,'description' => ''
			 )
			 ,array(
				'type' => 'dropdown'
				,'heading' => __( 'Show product title', 'wpdance' )
				,'param_name' => 'show_title'
				,'admin_label' => true
				,'value' => array(
					'Yes'		=> 1
					,'No'		=> 0
					)
				,'description' => ''
			 )
			 ,array(
				'type' => 'dropdown'
				,'heading' => __( 'Show SKU', 'wpdance' )
				,'param_name' => 'show_sku'
				,'admin_label' => true
				,'value' => array(
					'No'		=> 0
					,'Yes'		=> 1
					)
				,'description' => ''
			 )
			 ,array(
				'type' => 'dropdown'
				,'heading' => __( 'Show price', 'wpdance' )
				,'param_name' => 'show_price'
				,'admin_label' => true
				,'value' => array(
					'Yes'		=> 1
					,'No'		=> 0
					)
				,'description' => ''
			 )
			 ,array(
				'type' => 'dropdown'
				,'heading' => __( 'Show short description', 'wpdance' )
				,'param_name' => 'show_short_desc'
				,'admin_label' => true
				,'value' => array(
					'Yes'		=> 1
					,'No'		=> 0
					)
				,'description' => ''
			 )
			 ,array(
				'type' => 'dropdown'
				,'heading' => __( 'Show rating', 'wpdance' )
				,'param_name' => 'show_rating'
				,'admin_label' => true
				,'value' => array(
					'Yes'		=> 1
					,'No'		=> 0
					)
				,'description' => ''
			 )
			 ,array(
				'type' => 'dropdown'
				,'heading' => __( 'Show label', 'wpdance' )
				,'param_name' => 'show_label'
				,'admin_label' => true
				,'value' => array(
					'Yes'		=> 1
					,'No'		=> 0
					)
				,'description' => ''
			 )
			 ,array(
				'type' => 'dropdown'
				,'heading' => __( 'Show label before product title', 'wpdance' )
				,'param_name' => 'show_label_title'
				,'admin_label' => true
				,'value' => array(
					'No'		=> 0
					,'Yes'		=> 1
					)
				,'description' => ''
			 )
			 ,array(
				'type' => 'dropdown'
				,'heading' => __( 'Show categories', 'wpdance' )
				,'param_name' => 'show_categories'
				,'admin_label' => true
				,'value' => array(
					'No'		=> 0
					,'Yes'		=> 1
					)
				,'description' => ''
			 )
			 ,array(
				'type' => 'dropdown'
				,'heading' => __( 'Show add to cart button', 'wpdance' )
				,'param_name' => 'show_add_to_cart'
				,'admin_label' => true
				,'value' => array(
					'Yes'		=> 1
					,'No'		=> 0
					)
				,'description' => ''
			 )
			 ,array(
				'type' => 'dropdown'
				,'heading' => __( 'Show navigation buttons', 'wpdance' )
				,'param_name' => 'show_nav'
				,'admin_label' => true
				,'value' => array(
					'Yes'		=> 1
					,'No'		=> 0
					)
				,'description' => ''
			 )
		)
	));
	
	/* Best Selling Product */
	vc_map( array(
		'name' => __( 'Best Selling Product', 'wpdance' )
		,'base' => 'best_selling_product'
		,'category' => __( 'WD Product', 'wpdance')
		,'params' => array(
			array(
				'type' => 'textfield'
				,'heading' => __( 'Block title', 'wpdance' )
				,'param_name' => 'title'
				,'admin_label' => true
				,'value' => ''
				,'description' => ''
			)
			,array(
				'type' => 'textfield'
				,'heading' => __( 'Icon before title', 'wpdance' )
				,'param_name' => 'icon_title_class'
				,'admin_label' => true
				,'value' => ''
				,'description' => __('Use icon (FontAwesome class) instead of image. Ex: fa-home', 'wpdance')
			)
			,array(
				'type' => 'textarea'
				,'heading' => __( 'Block description', 'wpdance' )
				,'param_name' => 'desc'
				,'admin_label' => true
				,'value' => ''
				,'description' => ''
			)
			,array(
				'type' => 'dropdown'
				,'heading' => __( 'Style', 'wpdance' )
				,'param_name' => 'style'
				,'admin_label' => true
				,'value' => array(
					'1'		=> '1'
					,'2'	=> '2'
					)
				,'description' => ''
			 )
			,array(
				'type' => 'textfield'
				,'heading' => __( 'Columns', 'wpdance' )
				,'param_name' => 'columns'
				,'admin_label' => true
				,'value' => '4'
				,'description' => ''
			)
			,array(
				'type' => 'textfield'
				,'heading' => __( 'Number of products', 'wpdance' )
				,'param_name' => 'per_page'
				,'admin_label' => true
				,'value' => '8'
				,'description' => ''
			)
			,array(
				'type' => 'textarea'
				,'heading' => __( 'Product Categories', 'wpdance' )
				,'param_name' => 'product_cats'
				,'admin_label' => true
				,'value' => ''
				,'description' => __('A comma separated list of product category slugs', 'wpdance')
			 )
			 ,array(
				'type' => 'dropdown'
				,'heading' => __( 'Show product image', 'wpdance' )
				,'param_name' => 'show_image'
				,'admin_label' => true
				,'value' => array(
					'Yes'		=> 1
					,'No'		=> 0
					)
				,'description' => ''
			 )
			 ,array(
				'type' => 'dropdown'
				,'heading' => __( 'Show product title', 'wpdance' )
				,'param_name' => 'show_title'
				,'admin_label' => true
				,'value' => array(
					'Yes'		=> 1
					,'No'		=> 0
					)
				,'description' => ''
			 )
			 ,array(
				'type' => 'dropdown'
				,'heading' => __( 'Show SKU', 'wpdance' )
				,'param_name' => 'show_sku'
				,'admin_label' => true
				,'value' => array(
					'No'		=> 0
					,'Yes'		=> 1
					)
				,'description' => ''
			 )
			 ,array(
				'type' => 'dropdown'
				,'heading' => __( 'Show price', 'wpdance' )
				,'param_name' => 'show_price'
				,'admin_label' => true
				,'value' => array(
					'Yes'		=> 1
					,'No'		=> 0
					)
				,'description' => ''
			 )
			 ,array(
				'type' => 'dropdown'
				,'heading' => __( 'Show short description', 'wpdance' )
				,'param_name' => 'show_short_desc'
				,'admin_label' => true
				,'value' => array(
					'Yes'		=> 1
					,'No'		=> 0
					)
				,'description' => ''
			 )
			 ,array(
				'type' => 'dropdown'
				,'heading' => __( 'Show rating', 'wpdance' )
				,'param_name' => 'show_rating'
				,'admin_label' => true
				,'value' => array(
					'Yes'		=> 1
					,'No'		=> 0
					)
				,'description' => ''
			 )
			 ,array(
				'type' => 'dropdown'
				,'heading' => __( 'Show label', 'wpdance' )
				,'param_name' => 'show_label'
				,'admin_label' => true
				,'value' => array(
					'Yes'		=> 1
					,'No'		=> 0
					)
				,'description' => ''
			 )
			 ,array(
				'type' => 'dropdown'
				,'heading' => __( 'Show label before product title', 'wpdance' )
				,'param_name' => 'show_label_title'
				,'admin_label' => true
				,'value' => array(
					'No'		=> 0
					,'Yes'		=> 1
					)
				,'description' => ''
			 )
			 ,array(
				'type' => 'dropdown'
				,'heading' => __( 'Show categories', 'wpdance' )
				,'param_name' => 'show_categories'
				,'admin_label' => true
				,'value' => array(
					'No'		=> 0
					,'Yes'		=> 1
					)
				,'description' => ''
			 )
			 ,array(
				'type' => 'dropdown'
				,'heading' => __( 'Show add to cart button', 'wpdance' )
				,'param_name' => 'show_add_to_cart'
				,'admin_label' => true
				,'value' => array(
					'Yes'		=> 1
					,'No'		=> 0
					)
				,'description' => ''
			 )
			 ,array(
				'type' => 'dropdown'
				,'heading' => __( 'Show load more button', 'wpdance' )
				,'param_name' => 'show_load_more'
				,'admin_label' => true
				,'value' => array(
					'No'		=> 0
					,'Yes'		=> 1
					)
				,'description' => ''
			 )
		)
	));
	
	/* Best Selling Product slider */
	vc_map( array(
		'name' => __( 'Best Selling Product Slider', 'wpdance' )
		,'base' => 'best_selling_product_slider'
		,'category' => __( 'WD Product', 'wpdance')
		,'params' => array(
			array(
				'type' => 'textfield'
				,'heading' => __( 'Block title', 'wpdance' )
				,'param_name' => 'title'
				,'admin_label' => true
				,'value' => ''
				,'description' => ''
			)
			,array(
				'type' => 'textfield'
				,'heading' => __( 'Icon before title', 'wpdance' )
				,'param_name' => 'icon_title_class'
				,'admin_label' => true
				,'value' => ''
				,'description' => __('Use icon (FontAwesome class) instead of image. Ex: fa-home', 'wpdance')
			)
			,array(
				'type' => 'textarea'
				,'heading' => __( 'Block description', 'wpdance' )
				,'param_name' => 'desc'
				,'admin_label' => true
				,'value' => ''
				,'description' => ''
			)
			,array(
				'type' => 'dropdown'
				,'heading' => __( 'Style', 'wpdance' )
				,'param_name' => 'style'
				,'admin_label' => true
				,'value' => array(
					'1'		=> '1'
					,'2'	=> '2'
					)
				,'description' => ''
			 )
			,array(
				'type' => 'textfield'
				,'heading' => __( 'Columns', 'wpdance' )
				,'param_name' => 'columns'
				,'admin_label' => true
				,'value' => '4'
				,'description' => ''
			)
			,array(
				'type' => 'textfield'
				,'heading' => __( 'Number of products', 'wpdance' )
				,'param_name' => 'per_page'
				,'admin_label' => true
				,'value' => '8'
				,'description' => ''
			)
			,array(
				'type' => 'textarea'
				,'heading' => __( 'Product Categories', 'wpdance' )
				,'param_name' => 'product_cats'
				,'admin_label' => true
				,'value' => ''
				,'description' => __('A comma separated list of product category slugs', 'wpdance')
			 )
			 ,array(
				'type' => 'dropdown'
				,'heading' => __( 'Show product image', 'wpdance' )
				,'param_name' => 'show_image'
				,'admin_label' => true
				,'value' => array(
					'Yes'		=> 1
					,'No'		=> 0
					)
				,'description' => ''
			 )
			 ,array(
				'type' => 'dropdown'
				,'heading' => __( 'Show product title', 'wpdance' )
				,'param_name' => 'show_title'
				,'admin_label' => true
				,'value' => array(
					'Yes'		=> 1
					,'No'		=> 0
					)
				,'description' => ''
			 )
			 ,array(
				'type' => 'dropdown'
				,'heading' => __( 'Show SKU', 'wpdance' )
				,'param_name' => 'show_sku'
				,'admin_label' => true
				,'value' => array(
					'No'		=> 0
					,'Yes'		=> 1
					)
				,'description' => ''
			 )
			 ,array(
				'type' => 'dropdown'
				,'heading' => __( 'Show price', 'wpdance' )
				,'param_name' => 'show_price'
				,'admin_label' => true
				,'value' => array(
					'Yes'		=> 1
					,'No'		=> 0
					)
				,'description' => ''
			 )
			 ,array(
				'type' => 'dropdown'
				,'heading' => __( 'Show short description', 'wpdance' )
				,'param_name' => 'show_short_desc'
				,'admin_label' => true
				,'value' => array(
					'Yes'		=> 1
					,'No'		=> 0
					)
				,'description' => ''
			 )
			 ,array(
				'type' => 'dropdown'
				,'heading' => __( 'Show rating', 'wpdance' )
				,'param_name' => 'show_rating'
				,'admin_label' => true
				,'value' => array(
					'Yes'		=> 1
					,'No'		=> 0
					)
				,'description' => ''
			 )
			 ,array(
				'type' => 'dropdown'
				,'heading' => __( 'Show label', 'wpdance' )
				,'param_name' => 'show_label'
				,'admin_label' => true
				,'value' => array(
					'Yes'		=> 1
					,'No'		=> 0
					)
				,'description' => ''
			 )
			 ,array(
				'type' => 'dropdown'
				,'heading' => __( 'Show label before product title', 'wpdance' )
				,'param_name' => 'show_label_title'
				,'admin_label' => true
				,'value' => array(
					'No'		=> 0
					,'Yes'		=> 1
					)
				,'description' => ''
			 )
			 ,array(
				'type' => 'dropdown'
				,'heading' => __( 'Show categories', 'wpdance' )
				,'param_name' => 'show_categories'
				,'admin_label' => true
				,'value' => array(
					'No'		=> 0
					,'Yes'		=> 1
					)
				,'description' => ''
			 )
			 ,array(
				'type' => 'dropdown'
				,'heading' => __( 'Show add to cart button', 'wpdance' )
				,'param_name' => 'show_add_to_cart'
				,'admin_label' => true
				,'value' => array(
					'Yes'		=> 1
					,'No'		=> 0
					)
				,'description' => ''
			 )
			 ,array(
				'type' => 'dropdown'
				,'heading' => __( 'Show navigation buttons', 'wpdance' )
				,'param_name' => 'show_nav'
				,'admin_label' => true
				,'value' => array(
					'Yes'		=> 1
					,'No'		=> 0
					)
				,'description' => ''
			 )
		)
	));
	
	
	/* Sale Product */
	vc_map( array(
		'name' => __( 'Sale Product', 'wpdance' )
		,'base' => 'sale_product'
		,'category' => __( 'WD Product', 'wpdance')
		,'params' => array(
			array(
				'type' => 'textfield'
				,'heading' => __( 'Block title', 'wpdance' )
				,'param_name' => 'title'
				,'admin_label' => true
				,'value' => ''
				,'description' => ''
			)
			,array(
				'type' => 'textfield'
				,'heading' => __( 'Icon before title', 'wpdance' )
				,'param_name' => 'icon_title_class'
				,'admin_label' => true
				,'value' => ''
				,'description' => __('Use icon (FontAwesome class) instead of image. Ex: fa-home', 'wpdance')
			)
			,array(
				'type' => 'textarea'
				,'heading' => __( 'Block description', 'wpdance' )
				,'param_name' => 'desc'
				,'admin_label' => true
				,'value' => ''
				,'description' => ''
			)
			,array(
				'type' => 'dropdown'
				,'heading' => __( 'Style', 'wpdance' )
				,'param_name' => 'style'
				,'admin_label' => true
				,'value' => array(
					'1'		=> '1'
					,'2'	=> '2'
					)
				,'description' => ''
			 )
			,array(
				'type' => 'textfield'
				,'heading' => __( 'Columns', 'wpdance' )
				,'param_name' => 'columns'
				,'admin_label' => true
				,'value' => '4'
				,'description' => ''
			)
			,array(
				'type' => 'textfield'
				,'heading' => __( 'Number of products', 'wpdance' )
				,'param_name' => 'per_page'
				,'admin_label' => true
				,'value' => '8'
				,'description' => ''
			)
			,array(
				'type' => 'textarea'
				,'heading' => __( 'Product Categories', 'wpdance' )
				,'param_name' => 'product_cats'
				,'admin_label' => true
				,'value' => ''
				,'description' => __('A comma separated list of product category slugs', 'wpdance')
			 )
			 ,array(
				'type' => 'dropdown'
				,'heading' => __( 'Show product image', 'wpdance' )
				,'param_name' => 'show_image'
				,'admin_label' => true
				,'value' => array(
					'Yes'		=> 1
					,'No'		=> 0
					)
				,'description' => ''
			 )
			 ,array(
				'type' => 'dropdown'
				,'heading' => __( 'Show product title', 'wpdance' )
				,'param_name' => 'show_title'
				,'admin_label' => true
				,'value' => array(
					'Yes'		=> 1
					,'No'		=> 0
					)
				,'description' => ''
			 )
			 ,array(
				'type' => 'dropdown'
				,'heading' => __( 'Show SKU', 'wpdance' )
				,'param_name' => 'show_sku'
				,'admin_label' => true
				,'value' => array(
					'No'		=> 0
					,'Yes'		=> 1
					)
				,'description' => ''
			 )
			 ,array(
				'type' => 'dropdown'
				,'heading' => __( 'Show price', 'wpdance' )
				,'param_name' => 'show_price'
				,'admin_label' => true
				,'value' => array(
					'Yes'		=> 1
					,'No'		=> 0
					)
				,'description' => ''
			 )
			 ,array(
				'type' => 'dropdown'
				,'heading' => __( 'Show short description', 'wpdance' )
				,'param_name' => 'show_short_desc'
				,'admin_label' => true
				,'value' => array(
					'Yes'		=> 1
					,'No'		=> 0
					)
				,'description' => ''
			 )
			 ,array(
				'type' => 'dropdown'
				,'heading' => __( 'Show rating', 'wpdance' )
				,'param_name' => 'show_rating'
				,'admin_label' => true
				,'value' => array(
					'Yes'		=> 1
					,'No'		=> 0
					)
				,'description' => ''
			 )
			 ,array(
				'type' => 'dropdown'
				,'heading' => __( 'Show label', 'wpdance' )
				,'param_name' => 'show_label'
				,'admin_label' => true
				,'value' => array(
					'Yes'		=> 1
					,'No'		=> 0
					)
				,'description' => ''
			 )
			 ,array(
				'type' => 'dropdown'
				,'heading' => __( 'Show label before product title', 'wpdance' )
				,'param_name' => 'show_label_title'
				,'admin_label' => true
				,'value' => array(
					'No'		=> 0
					,'Yes'		=> 1
					)
				,'description' => ''
			 )
			 ,array(
				'type' => 'dropdown'
				,'heading' => __( 'Show categories', 'wpdance' )
				,'param_name' => 'show_categories'
				,'admin_label' => true
				,'value' => array(
					'No'		=> 0
					,'Yes'		=> 1
					)
				,'description' => ''
			 )
			 ,array(
				'type' => 'dropdown'
				,'heading' => __( 'Show add to cart button', 'wpdance' )
				,'param_name' => 'show_add_to_cart'
				,'admin_label' => true
				,'value' => array(
					'Yes'		=> 1
					,'No'		=> 0
					)
				,'description' => ''
			 )
			 ,array(
				'type' => 'dropdown'
				,'heading' => __( 'Show load more button', 'wpdance' )
				,'param_name' => 'show_load_more'
				,'admin_label' => true
				,'value' => array(
					'No'		=> 0
					,'Yes'		=> 1
					)
				,'description' => ''
			 )
		)
	));
	
	/* Sale Product slider */
	vc_map( array(
		'name' => __( 'Sale Product Slider', 'wpdance' )
		,'base' => 'sale_product_slider'
		,'category' => __( 'WD Product', 'wpdance')
		,'params' => array(
			array(
				'type' => 'textfield'
				,'heading' => __( 'Block title', 'wpdance' )
				,'param_name' => 'title'
				,'admin_label' => true
				,'value' => ''
				,'description' => ''
			)
			,array(
				'type' => 'textfield'
				,'heading' => __( 'Icon before title', 'wpdance' )
				,'param_name' => 'icon_title_class'
				,'admin_label' => true
				,'value' => ''
				,'description' => __('Use icon (FontAwesome class) instead of image. Ex: fa-home', 'wpdance')
			)
			,array(
				'type' => 'textarea'
				,'heading' => __( 'Block description', 'wpdance' )
				,'param_name' => 'desc'
				,'admin_label' => true
				,'value' => ''
				,'description' => ''
			)
			,array(
				'type' => 'dropdown'
				,'heading' => __( 'Style', 'wpdance' )
				,'param_name' => 'style'
				,'admin_label' => true
				,'value' => array(
					'1'		=> '1'
					,'2'	=> '2'
					)
				,'description' => ''
			 )
			,array(
				'type' => 'textfield'
				,'heading' => __( 'Columns', 'wpdance' )
				,'param_name' => 'columns'
				,'admin_label' => true
				,'value' => '4'
				,'description' => ''
			)
			,array(
				'type' => 'textfield'
				,'heading' => __( 'Number of products', 'wpdance' )
				,'param_name' => 'per_page'
				,'admin_label' => true
				,'value' => '8'
				,'description' => ''
			)
			,array(
				'type' => 'textarea'
				,'heading' => __( 'Product Categories', 'wpdance' )
				,'param_name' => 'product_cats'
				,'admin_label' => true
				,'value' => ''
				,'description' => __('A comma separated list of product category slugs', 'wpdance')
			 )
			 ,array(
				'type' => 'dropdown'
				,'heading' => __( 'Show product image', 'wpdance' )
				,'param_name' => 'show_image'
				,'admin_label' => true
				,'value' => array(
					'Yes'		=> 1
					,'No'		=> 0
					)
				,'description' => ''
			 )
			 ,array(
				'type' => 'dropdown'
				,'heading' => __( 'Show product title', 'wpdance' )
				,'param_name' => 'show_title'
				,'admin_label' => true
				,'value' => array(
					'Yes'		=> 1
					,'No'		=> 0
					)
				,'description' => ''
			 )
			 ,array(
				'type' => 'dropdown'
				,'heading' => __( 'Show SKU', 'wpdance' )
				,'param_name' => 'show_sku'
				,'admin_label' => true
				,'value' => array(
					'No'		=> 0
					,'Yes'		=> 1
					)
				,'description' => ''
			 )
			 ,array(
				'type' => 'dropdown'
				,'heading' => __( 'Show price', 'wpdance' )
				,'param_name' => 'show_price'
				,'admin_label' => true
				,'value' => array(
					'Yes'		=> 1
					,'No'		=> 0
					)
				,'description' => ''
			 )
			 ,array(
				'type' => 'dropdown'
				,'heading' => __( 'Show short description', 'wpdance' )
				,'param_name' => 'show_short_desc'
				,'admin_label' => true
				,'value' => array(
					'Yes'		=> 1
					,'No'		=> 0
					)
				,'description' => ''
			 )
			 ,array(
				'type' => 'dropdown'
				,'heading' => __( 'Show rating', 'wpdance' )
				,'param_name' => 'show_rating'
				,'admin_label' => true
				,'value' => array(
					'Yes'		=> 1
					,'No'		=> 0
					)
				,'description' => ''
			 )
			 ,array(
				'type' => 'dropdown'
				,'heading' => __( 'Show label', 'wpdance' )
				,'param_name' => 'show_label'
				,'admin_label' => true
				,'value' => array(
					'Yes'		=> 1
					,'No'		=> 0
					)
				,'description' => ''
			 )
			 ,array(
				'type' => 'dropdown'
				,'heading' => __( 'Show label before product title', 'wpdance' )
				,'param_name' => 'show_label_title'
				,'admin_label' => true
				,'value' => array(
					'No'		=> 0
					,'Yes'		=> 1
					)
				,'description' => ''
			 )
			 ,array(
				'type' => 'dropdown'
				,'heading' => __( 'Show categories', 'wpdance' )
				,'param_name' => 'show_categories'
				,'admin_label' => true
				,'value' => array(
					'No'		=> 0
					,'Yes'		=> 1
					)
				,'description' => ''
			 )
			 ,array(
				'type' => 'dropdown'
				,'heading' => __( 'Show add to cart button', 'wpdance' )
				,'param_name' => 'show_add_to_cart'
				,'admin_label' => true
				,'value' => array(
					'Yes'		=> 1
					,'No'		=> 0
					)
				,'description' => ''
			 )
			 ,array(
				'type' => 'dropdown'
				,'heading' => __( 'Show navigation buttons', 'wpdance' )
				,'param_name' => 'show_nav'
				,'admin_label' => true
				,'value' => array(
					'Yes'		=> 1
					,'No'		=> 0
					)
				,'description' => ''
			 )
		)
	));
	
	/* Product Category Slider */
	vc_map( array(
		'name' => __( 'Product Category Slider', 'wpdance' )
		,'base' => 'product_categories_slider'
		,'category' => __( 'WD Product', 'wpdance')
		,'params' => array(
			array(
				'type' => 'textfield'
				,'heading' => __( 'Block title', 'wpdance' )
				,'param_name' => 'title'
				,'admin_label' => true
				,'value' => ''
				,'description' => ''
			)
			,array(
				'type' => 'textfield'
				,'heading' => __( 'Icon before title', 'wpdance' )
				,'param_name' => 'icon_title_class'
				,'admin_label' => true
				,'value' => ''
				,'description' => __('Use icon (FontAwesome class) instead of image. Ex: fa-home', 'wpdance')
			)
			,array(
				'type' => 'textarea'
				,'heading' => __( 'Block description', 'wpdance' )
				,'param_name' => 'desc'
				,'admin_label' => true
				,'value' => ''
				,'description' => ''
			)
			,array(
				'type' => 'textfield'
				,'heading' => __( 'Columns', 'wpdance' )
				,'param_name' => 'columns'
				,'admin_label' => true
				,'value' => '8'
				,'description' => ''
			)
			,array(
				'type' => 'textfield'
				,'heading' => __( 'Number of categories', 'wpdance' )
				,'param_name' => 'number'
				,'admin_label' => true
				,'value' => ''
				,'description' => 'Leave blank to show all'
			)
			,array(
				'type' => 'textarea'
				,'heading' => __( 'Product category ids', 'wpdance' )
				,'param_name' => 'ids'
				,'admin_label' => true
				,'value' => ''
				,'description' => 'A comma separated list of product category ids'
			 )
			,array(
				'type' => 'textarea'
				,'heading' => __( 'Parent Category ID', 'wpdance' )
				,'param_name' => 'parent'
				,'admin_label' => true
				,'value' => ''
				,'description' => ''
			 )
			 ,array(
				'type' => 'dropdown'
				,'heading' => __( 'Hide empty categories', 'wpdance' )
				,'param_name' => 'hide_empty'
				,'admin_label' => true
				,'value' => array(
					'No'		=> 0
					,'Yes'		=> 1
					)
				,'description' => ''
			 )
			 ,array(
				'type' => 'dropdown'
				,'heading' => __( 'Show category title', 'wpdance' )
				,'param_name' => 'show_item_title'
				,'admin_label' => true
				,'value' => array(
					'Yes'		=> 1
					,'No'		=> 0
					)
				,'description' => ''
			 )
			 ,array(
				'type' => 'dropdown'
				,'heading' => __( 'Show navigation buttons', 'wpdance' )
				,'param_name' => 'show_nav'
				,'admin_label' => true
				,'value' => array(
					'Yes'		=> 1
					,'No'		=> 0
					)
				,'description' => ''
			 )
		)
	));
	
	/* Product Categories 2 */
	vc_map( array(
		'name' => __( 'Product Categories 2', 'wpdance' )
		,'base' => 'product_categories_2'
		,'category' => __( 'WD Product', 'wpdance')
		,'params' => array(
			array(
				'type' => 'textfield'
				,'heading' => __( 'Block title', 'wpdance' )
				,'param_name' => 'title'
				,'admin_label' => true
				,'value' => ''
				,'description' => ''
			)
			,array(
				'type' => 'textfield'
				,'heading' => __( 'Icon before title', 'wpdance' )
				,'param_name' => 'icon_title_class'
				,'admin_label' => true
				,'value' => ''
				,'description' => __('Use icon (FontAwesome class) instead of image. Ex: fa-home', 'wpdance')
			)
			,array(
				'type' => 'textarea'
				,'heading' => __( 'Block description', 'wpdance' )
				,'param_name' => 'desc'
				,'admin_label' => true
				,'value' => ''
				,'description' => ''
			)
			,array(
				'type' => 'dropdown'
				,'heading' => __( 'Columns', 'wpdance' )
				,'param_name' => 'columns'
				,'admin_label' => true
				,'value' => array(
					'2'		=> '2'
					,'3'	=> '3'
					,'4'	=> '4'
					,'6'	=> '6'
					,'8'	=> '8'
				)
				,'description' => ''
			)
			,array(
				'type' => 'textfield'
				,'heading' => __( 'Number of categories', 'wpdance' )
				,'param_name' => 'number'
				,'admin_label' => true
				,'value' => ''
				,'description' => 'Leave blank to show all'
			)
			,array(
				'type' => 'textarea'
				,'heading' => __( 'Product category ids', 'wpdance' )
				,'param_name' => 'ids'
				,'admin_label' => true
				,'value' => ''
				,'description' => 'A comma separated list of product category ids'
			 )
			,array(
				'type' => 'textarea'
				,'heading' => __( 'Parent Category ID', 'wpdance' )
				,'param_name' => 'parent'
				,'admin_label' => true
				,'value' => ''
				,'description' => ''
			 )
			 ,array(
				'type' => 'dropdown'
				,'heading' => __( 'Hide empty categories', 'wpdance' )
				,'param_name' => 'hide_empty'
				,'admin_label' => true
				,'value' => array(
					'No'		=> 0
					,'Yes'		=> 1
					)
				,'description' => ''
			 )
		)
	));
	
	
	/* Product Filter By Sub Categories */
	vc_map( array(
		'name' => __( 'Product Filter By Sub Categories', 'wpdance' )
		,'base' => 'product_filter_by_sub_category'
		,'category' => __( 'WD Product', 'wpdance')
		,'params' => array(
			array(
				'type' => 'textfield'
				,'heading' => __( 'Block title', 'wpdance' )
				,'param_name' => 'title'
				,'admin_label' => true
				,'value' => ''
				,'description' => ''
			)
			,array(
				'type' => 'textfield'
				,'heading' => __( 'Icon before title', 'wpdance' )
				,'param_name' => 'icon_title_class'
				,'admin_label' => true
				,'value' => ''
				,'description' => __('Use icon (FontAwesome class) instead of image. Ex: fa-home', 'wpdance')
			)
			,array(
				'type' => 'textarea'
				,'heading' => __( 'Block description', 'wpdance' )
				,'param_name' => 'desc'
				,'admin_label' => true
				,'value' => ''
				,'description' => ''
			)
			,array(
				'type' => 'dropdown'
				,'heading' => __( 'Style', 'wpdance' )
				,'param_name' => 'style'
				,'admin_label' => true
				,'value' => array(
					'1'		=> '1'
					,'2'	=> '2'
					)
				,'description' => ''
			 )
			,array(
				'type' => 'textfield'
				,'heading' => __( 'Columns', 'wpdance' )
				,'param_name' => 'columns'
				,'admin_label' => true
				,'value' => '4'
				,'description' => ''
			)
			,array(
				'type' => 'textfield'
				,'heading' => __( 'Number of products for each sub category', 'wpdance' )
				,'param_name' => 'per_page'
				,'admin_label' => true
				,'value' => '8'
				,'description' => ''
			)
			,array(
				'type' => 'textarea'
				,'heading' => __( 'Product Categories', 'wpdance' )
				,'param_name' => 'product_cats'
				,'admin_label' => true
				,'value' => ''
				,'description' => __('A comma separated list of parent product category slugs', 'wpdance')
			 )
			 ,array(
				'type' => 'dropdown'
				,'heading' => __( 'Show product image', 'wpdance' )
				,'param_name' => 'show_image'
				,'admin_label' => true
				,'value' => array(
					'Yes'		=> 1
					,'No'		=> 0
					)
				,'description' => ''
			 )
			 ,array(
				'type' => 'dropdown'
				,'heading' => __( 'Show product title', 'wpdance' )
				,'param_name' => 'show_title'
				,'admin_label' => true
				,'value' => array(
					'Yes'		=> 1
					,'No'		=> 0
					)
				,'description' => ''
			 )
			 ,array(
				'type' => 'dropdown'
				,'heading' => __( 'Show SKU', 'wpdance' )
				,'param_name' => 'show_sku'
				,'admin_label' => true
				,'value' => array(
					'No'		=> 0
					,'Yes'		=> 1
					)
				,'description' => ''
			 )
			 ,array(
				'type' => 'dropdown'
				,'heading' => __( 'Show price', 'wpdance' )
				,'param_name' => 'show_price'
				,'admin_label' => true
				,'value' => array(
					'Yes'		=> 1
					,'No'		=> 0
					)
				,'description' => ''
			 )
			 ,array(
				'type' => 'dropdown'
				,'heading' => __( 'Show short description', 'wpdance' )
				,'param_name' => 'show_short_desc'
				,'admin_label' => true
				,'value' => array(
					'Yes'		=> 1
					,'No'		=> 0
					)
				,'description' => ''
			 )
			 ,array(
				'type' => 'dropdown'
				,'heading' => __( 'Show rating', 'wpdance' )
				,'param_name' => 'show_rating'
				,'admin_label' => true
				,'value' => array(
					'Yes'		=> 1
					,'No'		=> 0
					)
				,'description' => ''
			 )
			 ,array(
				'type' => 'dropdown'
				,'heading' => __( 'Show label', 'wpdance' )
				,'param_name' => 'show_label'
				,'admin_label' => true
				,'value' => array(
					'Yes'		=> 1
					,'No'		=> 0
					)
				,'description' => ''
			 )
			 ,array(
				'type' => 'dropdown'
				,'heading' => __( 'Show label before product title', 'wpdance' )
				,'param_name' => 'show_label_title'
				,'admin_label' => true
				,'value' => array(
					'No'		=> 0
					,'Yes'		=> 1
					)
				,'description' => ''
			 )
			 ,array(
				'type' => 'dropdown'
				,'heading' => __( 'Show categories', 'wpdance' )
				,'param_name' => 'show_categories'
				,'admin_label' => true
				,'value' => array(
					'No'		=> 0
					,'Yes'		=> 1
					)
				,'description' => ''
			 )
			 ,array(
				'type' => 'dropdown'
				,'heading' => __( 'Show add to cart button', 'wpdance' )
				,'param_name' => 'show_add_to_cart'
				,'admin_label' => true
				,'value' => array(
					'Yes'		=> 1
					,'No'		=> 0
					)
				,'description' => ''
			 )
			 ,array(
				'type' => 'dropdown'
				,'heading' => __( 'Show navigation buttons', 'wpdance' )
				,'param_name' => 'show_nav'
				,'admin_label' => true
				,'value' => array(
					'Yes'		=> 1
					,'No'		=> 0
					)
				,'description' => ''
			 )
		)
	));
	
	/* Product Tab By Category */
	vc_map( array(
		'name' => __( 'Product Tab By Category', 'wpdance' )
		,'base' => 'product_tab_by_category'
		,'category' => __( 'WD Product', 'wpdance')
		,'params' => array(
			array(
				'type' => 'textfield'
				,'heading' => __( 'Number of products', 'wpdance' )
				,'param_name' => 'per_page'
				,'admin_label' => true
				,'value' => '8'
				,'description' => ''
			)
			,array(
				'type' => 'textarea'
				,'heading' => __( 'Product Categories', 'wpdance' )
				,'param_name' => 'product_cats'
				,'admin_label' => true
				,'value' => ''
				,'description' => __('A comma separated list of parent product category slugs', 'wpdance')
			 )
			 ,array(
				'type' => 'textfield'
				,'heading' => __( 'View All button text', 'wpdance' )
				,'param_name' => 'view_all_text'
				,'admin_label' => true
				,'value' => 'view all'
				,'description' => ''
			)
			 ,array(
				'type' => 'dropdown'
				,'heading' => __( 'Show product image', 'wpdance' )
				,'param_name' => 'show_image'
				,'admin_label' => true
				,'value' => array(
					'Yes'		=> 1
					,'No'		=> 0
					)
				,'description' => ''
			 )
			 ,array(
				'type' => 'dropdown'
				,'heading' => __( 'Show product title', 'wpdance' )
				,'param_name' => 'show_title'
				,'admin_label' => true
				,'value' => array(
					'Yes'		=> 1
					,'No'		=> 0
					)
				,'description' => ''
			 )
			 ,array(
				'type' => 'dropdown'
				,'heading' => __( 'Show SKU', 'wpdance' )
				,'param_name' => 'show_sku'
				,'admin_label' => true
				,'value' => array(
					'No'		=> 0
					,'Yes'		=> 1
					)
				,'description' => ''
			 )
			 ,array(
				'type' => 'dropdown'
				,'heading' => __( 'Show price', 'wpdance' )
				,'param_name' => 'show_price'
				,'admin_label' => true
				,'value' => array(
					'Yes'		=> 1
					,'No'		=> 0
					)
				,'description' => ''
			 )
			 ,array(
				'type' => 'dropdown'
				,'heading' => __( 'Show short description', 'wpdance' )
				,'param_name' => 'show_short_desc'
				,'admin_label' => true
				,'value' => array(
					'Yes'		=> 1
					,'No'		=> 0
					)
				,'description' => ''
			 )
			 ,array(
				'type' => 'dropdown'
				,'heading' => __( 'Show rating', 'wpdance' )
				,'param_name' => 'show_rating'
				,'admin_label' => true
				,'value' => array(
					'Yes'		=> 1
					,'No'		=> 0
					)
				,'description' => ''
			 )
			 ,array(
				'type' => 'dropdown'
				,'heading' => __( 'Show label', 'wpdance' )
				,'param_name' => 'show_label'
				,'admin_label' => true
				,'value' => array(
					'Yes'		=> 1
					,'No'		=> 0
					)
				,'description' => ''
			 )
			 ,array(
				'type' => 'dropdown'
				,'heading' => __( 'Show label before product title', 'wpdance' )
				,'param_name' => 'show_label_title'
				,'admin_label' => true
				,'value' => array(
					'No'		=> 0
					,'Yes'		=> 1
					)
				,'description' => ''
			 )
			 ,array(
				'type' => 'dropdown'
				,'heading' => __( 'Show categories', 'wpdance' )
				,'param_name' => 'show_categories'
				,'admin_label' => true
				,'value' => array(
					'No'		=> 0
					,'Yes'		=> 1
					)
				,'description' => ''
			 )
			 ,array(
				'type' => 'dropdown'
				,'heading' => __( 'Show add to cart button', 'wpdance' )
				,'param_name' => 'show_add_to_cart'
				,'admin_label' => true
				,'value' => array(
					'Yes'		=> 1
					,'No'		=> 0
					)
				,'description' => ''
			 )
		)
	));
	
	/* Custom Products Category */
	vc_map( array(
		'name' => __( 'Custom Products Category', 'wpdance' )
		,'base' => 'custom_products_category'
		,'category' => __( 'WD Product', 'wpdance')
		,'params' => array(
			array(
				'type' => 'textfield'
				,'heading' => __( 'Block title', 'wpdance' )
				,'param_name' => 'title'
				,'admin_label' => true
				,'value' => ''
				,'description' => ''
			)
			,array(
				'type' => 'textfield'
				,'heading' => __( 'Icon before title', 'wpdance' )
				,'param_name' => 'icon_title_class'
				,'admin_label' => true
				,'value' => ''
				,'description' => __('Use icon (FontAwesome class) instead of image. Ex: fa-home', 'wpdance')
			)
			,array(
				'type' => 'textfield'
				,'heading' => __( 'Columns', 'wpdance' )
				,'param_name' => 'columns'
				,'admin_label' => true
				,'value' => '3'
				,'description' => 'Number of columns on the right content'
			)
			,array(
				'type' => 'textfield'
				,'heading' => __( 'Number of products for each sub category', 'wpdance' )
				,'param_name' => 'per_page'
				,'admin_label' => true
				,'value' => '10'
				,'description' => ''
			)
			,array(
				'type' => 'textarea'
				,'heading' => __( 'Product Categories', 'wpdance' )
				,'param_name' => 'product_cats'
				,'admin_label' => true
				,'value' => ''
				,'description' => __('A comma separated list of product category slugs', 'wpdance')
			 )
			 ,array(
				'type' => 'dropdown'
				,'heading' => __( 'Show product image', 'wpdance' )
				,'param_name' => 'show_thumbnail'
				,'admin_label' => true
				,'value' => array(
					'Yes'		=> 1
					,'No'		=> 0
					)
				,'description' => ''
			 )
			 ,array(
				'type' => 'dropdown'
				,'heading' => __( 'Show product title', 'wpdance' )
				,'param_name' => 'show_title'
				,'admin_label' => true
				,'value' => array(
					'Yes'		=> 1
					,'No'		=> 0
					)
				,'description' => ''
			 )
			 ,array(
				'type' => 'dropdown'
				,'heading' => __( 'Show SKU', 'wpdance' )
				,'param_name' => 'show_sku'
				,'admin_label' => true
				,'value' => array(
					'No'		=> 0
					,'Yes'		=> 1
					)
				,'description' => ''
			 )
			 ,array(
				'type' => 'dropdown'
				,'heading' => __( 'Show price', 'wpdance' )
				,'param_name' => 'show_price'
				,'admin_label' => true
				,'value' => array(
					'Yes'		=> 1
					,'No'		=> 0
					)
				,'description' => ''
			 )
			 ,array(
				'type' => 'dropdown'
				,'heading' => __( 'Show short description', 'wpdance' )
				,'param_name' => 'show_short_desc'
				,'admin_label' => true
				,'value' => array(
					'Yes'		=> 1
					,'No'		=> 0
					)
				,'description' => ''
			 )
			 ,array(
				'type' => 'dropdown'
				,'heading' => __( 'Show rating', 'wpdance' )
				,'param_name' => 'show_rating'
				,'admin_label' => true
				,'value' => array(
					'Yes'		=> 1
					,'No'		=> 0
					)
				,'description' => ''
			 )
			 ,array(
				'type' => 'dropdown'
				,'heading' => __( 'Show label', 'wpdance' )
				,'param_name' => 'show_label'
				,'admin_label' => true
				,'value' => array(
					'Yes'		=> 1
					,'No'		=> 0
					)
				,'description' => ''
			 )
			 ,array(
				'type' => 'dropdown'
				,'heading' => __( 'Show label before product title', 'wpdance' )
				,'param_name' => 'show_label_title'
				,'admin_label' => true
				,'value' => array(
					'No'		=> 0
					,'Yes'		=> 1
					)
				,'description' => ''
			 )
			 ,array(
				'type' => 'dropdown'
				,'heading' => __( 'Show categories', 'wpdance' )
				,'param_name' => 'show_categories'
				,'admin_label' => true
				,'value' => array(
					'No'		=> 0
					,'Yes'		=> 1
					)
				,'description' => ''
			 )
			 ,array(
				'type' => 'dropdown'
				,'heading' => __( 'Show add to cart button', 'wpdance' )
				,'param_name' => 'show_add_to_cart'
				,'admin_label' => true
				,'value' => array(
					'Yes'		=> 1
					,'No'		=> 0
					)
				,'description' => ''
			 )
		)
	));
	
	
	/* Individual Product */
	vc_map( array(
		'name' => __( 'Individual Product', 'wpdance' )
		,'base' => 'individual_product'
		,'category' => __( 'WD Product', 'wpdance')
		,'params' => array(
			array(
				'type' => 'textfield'
				,'heading' => __( 'Product ID', 'wpdance' )
				,'param_name' => 'id'
				,'admin_label' => true
				,'value' => ''
				,'description' => ''
			)
			,array(
				'type' => 'textfield'
				,'heading' => __( 'Product SKU', 'wpdance' )
				,'param_name' => 'sku'
				,'admin_label' => true
				,'value' => ''
				,'description' => ''
			)
			,array(
				'type' => 'dropdown'
				,'heading' => __( 'Get description from', 'wpdance' )
				,'param_name' => 'desc_from'
				,'admin_label' => true
				,'value' => array(
					'Content'				=> 'content'
					,'Short Description'	=> 'short_desc'
				)
				,'description' => ''
			)
			,array(
				'type' => 'dropdown'
				,'heading' => __( 'Show title', 'wpdance' )
				,'param_name' => 'show_title'
				,'admin_label' => true
				,'value' => array(
						'Yes'	=>	1
						,'No'	=>	0
					)
				,'description' => ''
			)
			,array(
				'type' => 'dropdown'
				,'heading' => __( 'Show description', 'wpdance' )
				,'param_name' => 'show_desc'
				,'admin_label' => true
				,'value' => array(
						'Yes'	=>	1
						,'No'	=>	0
					)
				,'description' => ''
			)
			,array(
				'type' => 'dropdown'
				,'heading' => __( 'Show SKU', 'wpdance' )
				,'param_name' => 'show_sku'
				,'admin_label' => true
				,'value' => array(
					'No'		=> 0
					,'Yes'		=> 1
					)
				,'description' => ''
			)
			,array(
				'type' => 'dropdown'
				,'heading' => __( 'Show availability', 'wpdance' )
				,'param_name' => 'show_availability'
				,'admin_label' => true
				,'value' => array(
					'No'		=> 0
					,'Yes'		=> 1
					)
				,'description' => ''
			 )
			,array(
				'type' => 'dropdown'
				,'heading' => __( 'Show price', 'wpdance' )
				,'param_name' => 'show_price'
				,'admin_label' => true
				,'value' => array(
					'Yes'		=> 1
					,'No'		=> 0
					)
				,'description' => ''
			 )
			,array(
				'type' => 'dropdown'
				,'heading' => __( 'Show add to cart button', 'wpdance' )
				,'param_name' => 'show_add_to_cart'
				,'admin_label' => true
				,'value' => array(
					'Yes'		=> 1
					,'No'		=> 0
					)
				,'description' => ''
			)
		)
	));
	
	
	/*** WD Content ***/
	
	/* Heading */
	vc_map( array(
		'name' => __( 'Heading', 'wpdance' )
		,'base' => 'heading'
		,'category' => __( 'WD Content', 'wpdance')
		,'params' => array(
			array(
				'type' => 'textfield'
				,'heading' => __( 'Title', 'wpdance' )
				,'param_name' => 'content'
				,'admin_label' => true
				,'value' => ''
				,'description' => ''
			)
			,array(
				'type' => 'dropdown'
				,'heading' => __( 'Size', 'wpdance' )
				,'param_name' => 'size'
				,'admin_label' => true
				,'value' => array(
					'1'			=> 1
					,'2'		=> 2
					,'3'		=> 3
					,'4'		=> 4
					,'5'		=> 5
					,'6'		=> 6
					)
				,'description' => ''
			 )
		)
	));
	
	/* Icon */
	vc_map( array(
		'name' => __( 'Icon', 'wpdance' )
		,'base' => 'icon'
		,'category' => __( 'WD Content', 'wpdance')
		,'params' => array(
			array(
				'type' => 'wd_icon'
				,'heading' => __( 'Icon', 'wpdance' )
				,'param_name' => 'icon'
				,'admin_label' => true
				,'value' => ''
				,'description' => ''
			)
			,array(
				'type' => 'colorpicker'
				,'heading' => __( 'Color', 'wpdance' )
				,'param_name' => 'color'
				,'admin_label' => true
				,'value' => ''
				,'description' => ''
			 )
			 ,array(
				'type' => 'textfield'
				,'heading' => __( 'Font size', 'wpdance' )
				,'param_name' => 'font_size'
				,'admin_label' => true
				,'value' => ''
				,'description' => __('Ex: 13px', 'wpdance')
			 )
			 ,array(
				'type' => 'textfield'
				,'heading' => __( 'Extra class', 'wpdance' )
				,'param_name' => 'extra_class'
				,'admin_label' => true
				,'value' => ''
				,'description' => __('Ex: fa-lg, fa-2x, fa-spin ...', 'wpdance')
			 )
		)
	));
	
	/* Button */
	vc_map( array(
		'name' => __( 'Button', 'wpdance' )
		,'base' => 'button'
		,'category' => __( 'WD Content', 'wpdance')
		,'params' => array(
			array(
				'type' => 'textfield'
				,'heading' => __( 'Link URL', 'wpdance' )
				,'param_name' => 'link'
				,'admin_label' => true
				,'value' => ''
				,'description' => ''
			)
			,array(
				'type' => 'textfield'
				,'heading' => __( 'Text', 'wpdance' )
				,'param_name' => 'content'
				,'admin_label' => true
				,'value' => 'Button'
				,'description' => ''
			)
			,array(
				'type' => 'dropdown'
				,'heading' => __( 'Size', 'wpdance' )
				,'param_name' => 'size'
				,'admin_label' => true
				,'value' => array(
						'Default'	=> 'default'
						,'Small'		=> 'small'
						,'Large'		=> 'large'
						,'Largest'		=> 'largest'
					)
				,'description' => ''
			 )
			,array(
				'type' => 'colorpicker'
				,'heading' => __( 'Text color', 'wpdance' )
				,'param_name' => 'color'
				,'admin_label' => true
				,'value' => '#ffffff'
				,'description' => ''
			 )
			 ,array(
				'type' => 'colorpicker'
				,'heading' => __( 'Background color', 'wpdance' )
				,'param_name' => 'background'
				,'admin_label' => true
				,'value' => '#f34948'
				,'description' => ''
			 )
			 ,array(
				'type' => 'colorpicker'
				,'heading' => __( 'Border color', 'wpdance' )
				,'param_name' => 'border_color'
				,'admin_label' => true
				,'value' => '#f34948'
				,'description' => ''
			 )
			 ,array(
				'type' => 'colorpicker'
				,'heading' => __( 'Background color hover', 'wpdance' )
				,'param_name' => 'background_hover'
				,'admin_label' => true
				,'value' => '#ffffff'
				,'description' => ''
			 )
			 ,array(
				'type' => 'colorpicker'
				,'heading' => __( 'Text color hover', 'wpdance' )
				,'param_name' => 'color_hover'
				,'admin_label' => true
				,'value' => '#f34948'
				,'description' => ''
			 )
			 ,array(
				'type' => 'colorpicker'
				,'heading' => __( 'Border color hover', 'wpdance' )
				,'param_name' => 'border_color_hover'
				,'admin_label' => true
				,'value' => '#f34948'
				,'description' => ''
			 )
		)
	));
	
	/* Quote */
	vc_map( array(
		'name' => __( 'Quote', 'wpdance' )
		,'base' => 'quote'
		,'category' => __( 'WD Content', 'wpdance')
		,'params' => array(
			array(
				'type' => 'textfield'
				,'heading' => __( 'Extra class', 'wpdance' )
				,'param_name' => 'class'
				,'admin_label' => true
				,'value' => ''
				,'description' => ''
			)
			,array(
				'type' => 'textarea_html'
				,'heading' => __( 'Content', 'wpdance' )
				,'param_name' => 'content'
				,'admin_label' => true
				,'value' => ''
				,'description' => ''
			 )
		)
	));
	
	/* Dropcap */
	vc_map( array(
		'name' => __( 'Dropcap', 'wpdance' )
		,'base' => 'dropcap'
		,'category' => __( 'WD Content', 'wpdance')
		,'params' => array(
			array(
				'type' => 'colorpicker'
				,'heading' => __( 'Color', 'wpdance' )
				,'param_name' => 'color'
				,'admin_label' => true
				,'value' => ''
				,'description' => ''
			)
			,array(
				'type' => 'textfield'
				,'heading' => __( 'Font size', 'wpdance' )
				,'param_name' => 'font_size'
				,'admin_label' => true
				,'value' => '60px'
				,'description' => __('Ex: 60px', 'wpdance')
			)
			,array(
				'type' => 'textarea_html'
				,'heading' => __( 'Content', 'wpdance' )
				,'param_name' => 'content'
				,'admin_label' => true
				,'value' => ''
				,'description' => ''
			 )
		)
	));
	
	/* Banner */
	vc_map( array(
		'name' => __( 'Banner', 'wpdance' )
		,'base' => 'banner'
		,'category' => __( 'WD Content', 'wpdance')
		,'params' => array(
			array(
				'type' => 'textfield'
				,'heading' => __( 'Alt image', 'wpdance' )
				,'param_name' => 'title'
				,'admin_label' => true
				,'value' => ''
				,'description' => ''
			 )
			,array(
				'type' => 'textfield'
				,'heading' => __( 'Link URL', 'wpdance' )
				,'param_name' => 'link_url'
				,'admin_label' => true
				,'value' => ''
				,'description' => ''
			 )
			 ,array(
				'type' => 'textfield'
				,'heading' => __( 'Background image', 'wpdance' )
				,'param_name' => 'bg_image'
				,'admin_label' => true
				,'value' => ''
				,'description' => __('Input image URL', 'wpdance')
			 )
			 ,array(
				'type' => 'textfield'
				,'heading' => __( 'Background color', 'wpdance' )
				,'param_name' => 'bg_color'
				,'admin_label' => true
				,'value' => 'transparent'
				,'description' => __('Ex: transparent, #ffffff', 'wpdance')
			 )
			 ,array(
				'type' => 'textfield'
				,'heading' => __( 'Background color hover', 'wpdance' )
				,'param_name' => 'bg_hover'
				,'admin_label' => true
				,'value' => 'transparent'
				,'description' => __('Ex: transparent, #ffffff', 'wpdance')
			 )
			 ,array(
				'type' => 'textfield'
				,'heading' => __( 'Background image of text', 'wpdance' )
				,'param_name' => 'bg_text'
				,'admin_label' => true
				,'value' => ''
				,'description' => __('Input image URL', 'wpdance')
			 )
			 ,array(
				'type' => 'textfield'
				,'heading' => __( 'Bottom position of text', 'wpdance' )
				,'param_name' => 'position_text_bottom'
				,'admin_label' => true
				,'value' => '30px'
				,'description' => ''
			 )
			 ,array(
				'type' => 'dropdown'
				,'heading' => __( 'Show label', 'wpdance' )
				,'param_name' => 'show_label'
				,'admin_label' => true
				,'value' => array(
						'No'	=> 'no'
						,'Yes'	=> 'yes'
					)
				,'description' => ''
			 )
			 ,array(
				'type' => 'textfield'
				,'heading' => __( 'Label text', 'wpdance' )
				,'param_name' => 'label_text'
				,'admin_label' => true
				,'value' => 'save off'
				,'description' => ''
			 )
			 ,array(
				'type' => 'textfield'
				,'heading' => __( 'Label stype', 'wpdance' )
				,'param_name' => 'label_style'
				,'admin_label' => true
				,'value' => 'big onsale two_word'
				,'description' => 'big or small, onsale or featured or new, one_word or two_word'
			 )
			 ,array(
				'type' => 'textfield'
				,'heading' => __( 'Responsive', 'wpdance' )
				,'param_name' => 'responsive'
				,'admin_label' => true
				,'value' => 'normal'
				,'description' => 'normal, much_width, max_much_width'
			 )
		)
	));
	
	/* Banner Description */
	vc_map( array(
		'name' => __( 'Banner Description', 'wpdance' )
		,'base' => 'banner_description'
		,'category' => __( 'WD Content', 'wpdance')
		,'params' => array(
			array(
				'type' => 'textfield'
				,'heading' => __( 'Link URL', 'wpdance' )
				,'param_name' => 'link_url'
				,'admin_label' => true
				,'value' => ''
				,'description' => ''
			 )
			 ,array(
				'type' => 'textfield'
				,'heading' => __( 'Background image', 'wpdance' )
				,'param_name' => 'image'
				,'admin_label' => true
				,'value' => ''
				,'description' => __('Input image URL', 'wpdance')
			 )
			,array(
				'type' => 'textfield'
				,'heading' => __( 'Title', 'wpdance' )
				,'param_name' => 'title'
				,'admin_label' => true
				,'value' => ''
				,'description' => ''
			 )
			 ,array(
				'type' => 'textfield'
				,'heading' => __( 'Description', 'wpdance' )
				,'param_name' => 'description'
				,'admin_label' => true
				,'value' => ''
				,'description' => ''
			 )
		)
	));
	
	/* Price table */
	vc_map( array(
		'name' => __( 'Price Table', 'wpdance' )
		,'base' => 'wd_ptable'
		,'category' => __( 'WD Content', 'wpdance')
		,'params' => array(
			array(
				'type' => 'textfield'
				,'heading' => __( 'Title', 'wpdance' )
				,'param_name' => 'title'
				,'admin_label' => true
				,'value' => ''
				,'description' => ''
			 )
			,array(
				'type' => 'textfield'
				,'heading' => __( 'Price', 'wpdance' )
				,'param_name' => 'price'
				,'admin_label' => true
				,'value' => '0'
				,'description' => ''
			 )
			 ,array(
				'type' => 'textfield'
				,'heading' => __( 'Currency symbol', 'wpdance' )
				,'param_name' => 'currency'
				,'admin_label' => true
				,'value' => '$'
				,'description' => ''
			 )
			 ,array(
				'type' => 'textfield'
				,'heading' => __( 'Price period', 'wpdance' )
				,'param_name' => 'price_period'
				,'admin_label' => true
				,'value' => '/mo'
				,'description' => ''
			 )
			  ,array(
				'type' => 'textfield'
				,'heading' => __( 'link URL', 'wpdance' )
				,'param_name' => 'link'
				,'admin_label' => true
				,'value' => ''
				,'description' => ''
			 )
			 ,array(
				'type' => 'dropdown'
				,'heading' => __( 'Target', 'wpdance' )
				,'param_name' => 'target'
				,'admin_label' => true
				,'value' => array(
						'Self'		=> '_self'
						,'New tab'	=> '_blank'
					)
				,'description' => ''
			 )
			 ,array(
				'type' => 'textfield'
				,'heading' => __( 'Button text', 'wpdance' )
				,'param_name' => 'button_text'
				,'admin_label' => true
				,'value' => 'Buy Now'
				,'description' => ''
			 )
			 ,array(
				'type' => 'dropdown'
				,'heading' => __( 'Active', 'wpdance' )
				,'param_name' => 'active'
				,'admin_label' => true
				,'value' => array(
						'No'		=> 'no'
						,'Yes'		=> 'yes'
					)
				,'description' => ''
			 )
			 ,array(
				'type' => 'textarea_html'
				,'heading' => __( 'Content', 'wpdance' )
				,'param_name' => 'content'
				,'admin_label' => true
				,'value' => ''
				,'description' => ''
			 )
		)
	));
	
	/* Background Video */
	vc_map( array(
		'name' => __( 'Background Video', 'wpdance' )
		,'base' => 'background_video'
		,'category' => __( 'WD Content', 'wpdance')
		,'params' => array(
			array(
				'type' => 'textfield'
				,'heading' => __( 'Video URL', 'wpdance' )
				,'param_name' => 'video_url'
				,'admin_label' => true
				,'value' => ''
				,'description' => ''
			)
			,array(
				'type' => 'textfield'
				,'heading' => __( 'Volume', 'wpdance' )
				,'param_name' => 'volume'
				,'admin_label' => true
				,'value' => '0'
				,'description' => __('Ex: 0.5', 'wpdance')
			 )
			 ,array(
				'type' => 'textfield'
				,'heading' => __( 'Height', 'wpdance' )
				,'param_name' => 'height'
				,'admin_label' => true
				,'value' => '480px'
				,'description' => __('Ex: 480px', 'wpdance')
			 )
			 ,array(
				'type' => 'textfield'
				,'heading' => __( 'Background opacity', 'wpdance' )
				,'param_name' => 'bg_opacity'
				,'admin_label' => true
				,'value' => '0.35'
				,'description' => __('Ex: 0.35', 'wpdance')
			 )
			 ,array(
				'type' => 'dropdown'
				,'heading' => __( 'Background color', 'wpdance' )
				,'param_name' => 'bg_color'
				,'admin_label' => true
				,'value' => array(
						'black'	=> 'black'
						,'white'	=> 'white'
					)
				,'description' => ''
			 )
			 ,array(
				'type' => 'dropdown'
				,'heading' => __( 'Auto play', 'wpdance' )
				,'param_name' => 'auto_play'
				,'admin_label' => true
				,'value' => array(
						'No'	=> '0'
						,'Yes'	=> '1'
					)
				,'description' => ''
			 )
			 ,array(
				'type' => 'dropdown'
				,'heading' => __( 'Loop', 'wpdance' )
				,'param_name' => 'loop'
				,'admin_label' => true
				,'value' => array(
						'Yes'	=> '1'
						,'No'	=> '0'
					)
				,'description' => ''
			 )
			 ,array(
				'type' => 'textfield'
				,'heading' => __( 'Margin top', 'wpdance' )
				,'param_name' => 'margin_top'
				,'admin_label' => true
				,'value' => '-100px'
				,'description' => __('Margin top of video. Ex: -100px', 'wpdance')
			 )
			 ,array(
				'type' => 'textfield'
				,'heading' => __( 'Not support video text', 'wpdance' )
				,'param_name' => 'not_support_txt'
				,'admin_label' => true
				,'value' => 'Your browser does not support the video tag.'
				,'description' => __('Show this message when the client browser does not support the video tag', 'wpdance')
			 )
			 ,array(
				'type' => 'textarea_html'
				,'heading' => __( 'Content', 'wpdance' )
				,'param_name' => 'content'
				,'admin_label' => true
				,'value' => ''
				,'description' => ''
			 )
		)
	));
	
	/* Children Categories */
	vc_map( array(
		'name' => __( 'Child Categories', 'wpdance' )
		,'base' => 'child_categories'
		,'category' => __( 'WD Content', 'wpdance')
		,'params' => array(
			array(
				'type' => 'textfield'
				,'heading' => __( 'Category', 'wpdance' )
				,'param_name' => 'category'
				,'admin_label' => true
				,'value' => ''
				,'description' => __('Input category ID or Slug', 'wpdance')
			 )
			 ,array(
				'type' => 'textfield'
				,'heading' => __( 'Number of sub categories', 'wpdance' )
				,'param_name' => 'limit'
				,'admin_label' => true
				,'value' => 5
				,'description' => ''
			 )
			 ,array(
				'type' => 'textfield'
				,'heading' => __( 'Taxonomy', 'wpdance' )
				,'param_name' => 'taxonomy'
				,'admin_label' => true
				,'value' => 'product_cat'
				,'description' => 'Ex: product_cat, category, ...'
			 )
			 ,array(
				'type' => 'textarea'
				,'heading' => __( 'Description', 'wpdance' )
				,'param_name' => 'desc'
				,'admin_label' => true
				,'value' => ''
				,'description' => __('Input your description or it will load description of category', 'wpdance')
			 )
			 ,array(
				'type' => 'textfield'
				,'heading' => __( 'Background color', 'wpdance' )
				,'param_name' => 'bg_color'
				,'admin_label' => true
				,'value' => 'transparent'
				,'description' => __('Ex: transparent, #ffffff', 'wpdance')
			 )
			 ,array(
				'type' => 'textfield'
				,'heading' => __( 'Background image', 'wpdance' )
				,'param_name' => 'bg_image'
				,'admin_label' => true
				,'value' => ''
				,'description' => __('Input image URL', 'wpdance')
			 )
			 ,array(
				'type' => 'colorpicker'
				,'heading' => __( 'Text color', 'wpdance' )
				,'param_name' => 'text_color'
				,'admin_label' => true
				,'value' => '#ffffff'
				,'description' => ''
			 )
			 ,array(
				'type' => 'textfield'
				,'heading' => __( 'Button text', 'wpdance' )
				,'param_name' => 'button_text'
				,'admin_label' => true
				,'value' => 'View All Categories'
				,'description' => ''
			 )
			 
		)
	));

	/* Recent Blogs */
	vc_map( array(
		'name' => __( 'Recent Blogs', 'wpdance' )
		,'base' => 'recent_blogs'
		,'category' => __( 'WD Content', 'wpdance')
		,'params' => array(
			array(
				'type' => 'textfield'
				,'heading' => __( 'Category', 'wpdance' )
				,'param_name' => 'category'
				,'admin_label' => true
				,'value' => ''
				,'description' => __('Input category slug', 'wpdance')
			 )
			 ,array(
				'type' => 'textfield'
				,'heading' => __( 'Columns', 'wpdance' )
				,'param_name' => 'columns'
				,'admin_label' => true
				,'value' => '4'
				,'description' => ''
			 )
			,array(
				'type' => 'textfield'
				,'heading' => __( 'Number of posts', 'wpdance' )
				,'param_name' => 'number_posts'
				,'admin_label' => true
				,'value' => '4'
				,'description' => ''
			 )
			 ,array(
				'type' => 'dropdown'
				,'heading' => __( 'Show title', 'wpdance' )
				,'param_name' => 'title'
				,'admin_label' => true
				,'value' => array(
					'Yes'	=> 'yes'
					,'No'	=> 'no'
					)
				,'description' => ''
			 )
			 ,array(
				'type' => 'dropdown'
				,'heading' => __( 'Show thumbnail', 'wpdance' )
				,'param_name' => 'thumbnail'
				,'admin_label' => true
				,'value' => array(
					'Yes'	=> 'yes'
					,'No'	=> 'no'
					)
				,'description' => ''
			 )
			 ,array(
				'type' => 'dropdown'
				,'heading' => __( 'Show meta', 'wpdance' )
				,'param_name' => 'meta'
				,'admin_label' => true
				,'value' => array(
					'Yes'	=> 'yes'
					,'No'	=> 'no'
					)
				,'description' => __('Author, date, comment', 'wpdance')
			 )
			 ,array(
				'type' => 'dropdown'
				,'heading' => __( 'Show excerpt', 'wpdance' )
				,'param_name' => 'excerpt'
				,'admin_label' => true
				,'value' => array(
					'Yes'	=> 'yes'
					,'No'	=> 'no'
					)
				,'description' => ''
			 )
			 ,array(
				'type' => 'dropdown'
				,'heading' => __( 'Show tag', 'wpdance' )
				,'param_name' => 'tag'
				,'admin_label' => true
				,'value' => array(
					'Yes'	=> 'yes'
					,'No'	=> 'no'
					)
				,'description' => ''
			 )
			 ,array(
				'type' => 'dropdown'
				,'heading' => __( 'Show sharing', 'wpdance' )
				,'param_name' => 'sharing'
				,'admin_label' => true
				,'value' => array(
					'Yes'	=> 'yes'
					,'No'	=> 'no'
					)
				,'description' => ''
			 )
			 ,array(
				'type' => 'textfield'
				,'heading' => __( 'Number of excerpt words', 'wpdance' )
				,'param_name' => 'excerpt_words'
				,'admin_label' => true
				,'value' => '20'
				,'description' => ''
			 )
		)
	));
	
	/* Recent Blogs Sticky */
	vc_map( array(
		'name' => __( 'Recent Blogs Sticky', 'wpdance' )
		,'base' => 'recent_blogs_sticky'
		,'category' => __( 'WD Content', 'wpdance')
		,'params' => array(
			array(
				'type' => 'textfield'
				,'heading' => __( 'Category', 'wpdance' )
				,'param_name' => 'category'
				,'admin_label' => true
				,'value' => ''
				,'description' => __('Input category slug', 'wpdance')
			 )
			,array(
				'type' => 'textfield'
				,'heading' => __( 'Number of posts', 'wpdance' )
				,'param_name' => 'number_posts'
				,'admin_label' => true
				,'value' => '5'
				,'description' => ''
			 )
			 ,array(
				'type' => 'dropdown'
				,'heading' => __( 'Layout', 'wpdance' )
				,'param_name' => 'layout_sticky'
				,'admin_label' => true
				,'value' => array(
						'Vertical'		=> 'vertical'
						,'Horizontal'	=> 'horizontal'
					)
				,'description' => ''
			 )
			 ,array(
				'type' => 'textfield'
				,'heading' => __( 'Columns', 'wpdance' )
				,'param_name' => 'columns_child'
				,'admin_label' => true
				,'value' => '1'
				,'description' => __('Number of columns for posts, it does not include the sticky post', 'wpdance')
			 )
			 
			 ,array(
				'type' => 'dropdown'
				,'heading' => __( 'Show title of sticky post', 'wpdance' )
				,'param_name' => 'title_sticky'
				,'admin_label' => true
				,'value' => array(
					'Yes'	=> '1'
					,'No'	=> '0'
					)
				,'description' => ''
			 )
			 ,array(
				'type' => 'dropdown'
				,'heading' => __( 'Show thumbnail of sticky post', 'wpdance' )
				,'param_name' => 'thumbnail_sticky'
				,'admin_label' => true
				,'value' => array(
					'Yes'	=> '1'
					,'No'	=> '0'
					)
				,'description' => ''
			 )
			 ,array(
				'type' => 'dropdown'
				,'heading' => __( 'Show meta of sticky post', 'wpdance' )
				,'param_name' => 'meta_sticky'
				,'admin_label' => true
				,'value' => array(
					'Yes'	=> '1'
					,'No'	=> '0'
					)
				,'description' => __('Author, date, comment', 'wpdance')
			 )
			 ,array(
				'type' => 'dropdown'
				,'heading' => __( 'Show excerpt of sticky post', 'wpdance' )
				,'param_name' => 'excerpt_sticky'
				,'admin_label' => true
				,'value' => array(
					'Yes'	=> '1'
					,'No'	=> '0'
					)
				,'description' => ''
			 )
			 ,array(
				'type' => 'dropdown'
				,'heading' => __( 'Show tag of sticky post', 'wpdance' )
				,'param_name' => 'tag_sticky'
				,'admin_label' => true
				,'value' => array(
					'No'	=> '0'
					,'Yes'	=> '1'
					)
				,'description' => ''
			 )
			 ,array(
				'type' => 'dropdown'
				,'heading' => __( 'Show sharing of sticky post', 'wpdance' )
				,'param_name' => 'sharing_sticky'
				,'admin_label' => true
				,'value' => array(
					'No'	=> '0'
					,'Yes'	=> '1'
					)
				,'description' => ''
			 )
			 ,array(
				'type' => 'textfield'
				,'heading' => __( 'Number of excerpt words of sticky post', 'wpdance' )
				,'param_name' => 'excerpt_words_sticky'
				,'admin_label' => true
				,'value' => '40'
				,'description' => ''
			 )
			 
			 ,array(
				'type' => 'dropdown'
				,'heading' => __( 'Show title', 'wpdance' )
				,'param_name' => 'title'
				,'admin_label' => true
				,'value' => array(
					'Yes'	=> '1'
					,'No'	=> '0'
					)
				,'description' => ''
			 )
			 ,array(
				'type' => 'dropdown'
				,'heading' => __( 'Show thumbnail', 'wpdance' )
				,'param_name' => 'thumbnail'
				,'admin_label' => true
				,'value' => array(
					'Yes'	=> '1'
					,'No'	=> '0'
					)
				,'description' => ''
			 )
			 ,array(
				'type' => 'dropdown'
				,'heading' => __( 'Show meta', 'wpdance' )
				,'param_name' => 'meta'
				,'admin_label' => true
				,'value' => array(
					'Yes'	=> '1'
					,'No'	=> '0'
					)
				,'description' => __('Author, date, comment', 'wpdance')
			 )
			 ,array(
				'type' => 'dropdown'
				,'heading' => __( 'Show excerpt', 'wpdance' )
				,'param_name' => 'excerpt'
				,'admin_label' => true
				,'value' => array(
					'Yes'	=> '1'
					,'No'	=> '0'
					)
				,'description' => ''
			 )
			 ,array(
				'type' => 'dropdown'
				,'heading' => __( 'Show tag', 'wpdance' )
				,'param_name' => 'tag'
				,'admin_label' => true
				,'value' => array(
					'No'	=> '0'
					,'Yes'	=> '1'
					)
				,'description' => ''
			 )
			 ,array(
				'type' => 'dropdown'
				,'heading' => __( 'Show sharing', 'wpdance' )
				,'param_name' => 'sharing'
				,'admin_label' => true
				,'value' => array(
					'No'	=> '0'
					,'Yes'	=> '1'
					)
				,'description' => ''
			 )
			 ,array(
				'type' => 'textfield'
				,'heading' => __( 'Number of excerpt words', 'wpdance' )
				,'param_name' => 'excerpt_words'
				,'admin_label' => true
				,'value' => '20'
				,'description' => ''
			 )
		)
	));
	
	/* Recent Blogs Video */
	vc_map( array(
		'name' => __( 'Recent Blogs Video', 'wpdance' )
		,'base' => 'recent_blogs_video'
		,'category' => __( 'WD Content', 'wpdance')
		,'params' => array(
			array(
				'type' => 'textfield'
				,'heading' => __( 'Columns', 'wpdance' )
				,'param_name' => 'right_columns'
				,'admin_label' => true
				,'value' => '2'
				,'description' => __('Number of columns on the right content', 'wpdance')
			 )
			,array(
				'type' => 'textfield'
				,'heading' => __( 'Number of posts', 'wpdance' )
				,'param_name' => 'number_posts'
				,'admin_label' => true
				,'value' => '5'
				,'description' => ''
			 )
		)
	));
	
	/* Milestone */
	vc_map( array(
		'name' => __( 'Milestone', 'wpdance' )
		,'base' => 'milestone'
		,'category' => __( 'WD Content', 'wpdance')
		,'params' => array(
			array(
				'type' => 'textfield'
				,'heading' => __( 'Number', 'wpdance' )
				,'param_name' => 'number'
				,'admin_label' => true
				,'value' => '0'
				,'description' => ''
			 )
			,array(
				'type' => 'textfield'
				,'heading' => __( 'Symbol', 'wpdance' )
				,'param_name' => 'symbol'
				,'admin_label' => true
				,'value' => '$'
				,'description' => ''
			 )
			 ,array(
				'type' => 'dropdown'
				,'heading' => __( 'Symbol Position', 'wpdance' )
				,'param_name' => 'symbol_position'
				,'admin_label' => true
				,'value' => array(
						'After'		=> 'after'
						,'Before'	=> 'before'
					)
				,'description' => ''
			 )
			 ,array(
				'type' => 'textfield'
				,'heading' => __( 'Subject', 'wpdance' )
				,'param_name' => 'subject'
				,'admin_label' => true
				,'value' => ''
				,'description' => ''
			 )
			 ,array(
				'type' => 'colorpicker'
				,'heading' => __( 'Color', 'wpdance' )
				,'param_name' => 'color'
				,'admin_label' => true
				,'value' => '#ffffff'
				,'description' => ''
			 )
			 ,array(
				'type' => 'textfield'
				,'heading' => __( 'Font size of number', 'wpdance' )
				,'param_name' => 'font_size'
				,'admin_label' => true
				,'value' => '60px'
				,'description' => ''
			 )
		)
	));
	
	/* Feature */
	$feature_options = array();
	if( post_type_exists('feature') || class_exists('Woothemes_Features') ){
		$args = array(
			'post_type'			=> 'feature'
			,'post_status'		=> 'publish'
			,'posts_per_page' 	=> -1
			);
		global $post;
		$features = new WP_Query($args);
		if( $features->have_posts() ){
			while( $features->have_posts() ){
				$features->the_post();
				$feature_options[$post->post_title] = $post->ID;
			}
		}
		wp_reset_query();
	}
	
	vc_map( array(
		'name' => __( 'Feature', 'wpdance' )
		,'base' => 'feature'
		,'category' => __( 'WD Content', 'wpdance')
		,'params' => array(
			array(
				'type' => 'dropdown'
				,'heading' => __( 'Feature ID', 'wpdance' )
				,'param_name' => 'id'
				,'admin_label' => true
				,'value' => $feature_options
				,'description' => ''
			 )
			 ,array(
				'type' => 'dropdown'
				,'heading' => __( 'Style', 'wpdance' )
				,'param_name' => 'style'
				,'admin_label' => true
				,'value' => array(
						'Style 1'	=> 'style-1'
						,'Style 2'	=> 'style-2'
						,'Style 3'	=> 'style-3'
					)
				,'description' => ''
			 )
			 ,array(
				'type' => 'dropdown'
				,'heading' => __( 'Show icon font', 'wpdance' )
				,'param_name' => 'show_icon_font'
				,'admin_label' => true
				,'value' => array(
						'No'	=> 'no'
						,'Yes'	=> 'yes'
					)
				,'description' => ''
			 )
			 ,array(
				'type' => 'textfield'
				,'heading' => __( 'Icon font', 'wpdance' )
				,'param_name' => 'class_icon_font'
				,'admin_label' => true
				,'value' => ''
				,'description' => __('Use FontAwesome. Ex: fa-thumbs-up', 'wpdance')
			 )
			 ,array(
				'type' => 'dropdown'
				,'heading' => __( 'Show feature title', 'wpdance' )
				,'param_name' => 'title'
				,'admin_label' => true
				,'value' => array(
						'Yes'	=> 'yes'
						,'No'	=> 'no'
					)
				,'description' => ''
			 )
			 ,array(
				'type' => 'dropdown'
				,'heading' => __( 'Show thumbnail', 'wpdance' )
				,'param_name' => 'thumbnail'
				,'admin_label' => true
				,'value' => array(
						'No'	=> 'no'
						,'Yes'	=> 'yes'
					)
				,'description' => ''
			 )
			 ,array(
				'type' => 'dropdown'
				,'heading' => __( 'Show excerpt', 'wpdance' )
				,'param_name' => 'excerpt'
				,'admin_label' => true
				,'value' => array(
						'Yes'	=> 'yes'
						,'No'	=> 'no'
					)
				,'description' => ''
			 )
		)
	));
	
	/* Portfolio */
	vc_map( array(
		'name' => __( 'Portfolio', 'wpdance' )
		,'base' => 'wd-portfolio'
		,'category' => __( 'WD Content', 'wpdance')
		,'params' => array(
			array(
				'type' => 'textfield'
				,'heading' => __( 'Columns', 'wpdance' )
				,'param_name' => 'columns'
				,'admin_label' => true
				,'value' => '4'
				,'description' => ''
			)
			,array(
				'type' => 'textarea'
				,'heading' => __( 'Categories', 'wpdance' )
				,'param_name' => 'portfolio_cats'
				,'admin_label' => true
				,'value' => ''
				,'description' => __('A comma separated list of portfolio category slugs', 'wpdance')
			)
			,array(
				'type' => 'dropdown'
				,'heading' => __( 'Show filter bar', 'wpdance' )
				,'param_name' => 'show_filter'
				,'admin_label' => true
				,'value' => array(
						'Yes'	=>	'yes'
						,'No'	=>	'no'
					)
				,'description' => ''
			)
			,array(
				'type' => 'dropdown'
				,'heading' => __( 'Show title', 'wpdance' )
				,'param_name' => 'show_title'
				,'admin_label' => true
				,'value' => array(
						'Yes'	=>	'yes'
						,'No'	=>	'no'
					)
				,'description' => ''
			)
			,array(
				'type' => 'dropdown'
				,'heading' => __( 'Show description', 'wpdance' )
				,'param_name' => 'show_desc'
				,'admin_label' => true
				,'value' => array(
						'Yes'	=>	'yes'
						,'No'	=>	'no'
					)
				,'description' => ''
			)
			,array(
				'type' => 'dropdown'
				,'heading' => __( 'Show paging', 'wpdance' )
				,'param_name' => 'show_paging'
				,'admin_label' => true
				,'value' => array(
						'Yes'	=>	'yes'
						,'No'	=>	'no'
					)
				,'description' => ''
			)
			,array(
				'type' => 'textfield'
				,'heading' => __( 'Number of posts per page', 'wpdance' )
				,'param_name' => 'count'
				,'admin_label' => true
				,'value' => '8'
				,'description' => __('Input -1 to show all', 'wpdance')
			)
		)
	));
	
	/* Portfolio Slider */
	vc_map( array(
		'name' => __( 'Portfolio Slider', 'wpdance' )
		,'base' => 'wd_portfolio_slider'
		,'category' => __( 'WD Content', 'wpdance')
		,'params' => array(
			array(
				'type' => 'textfield'
				,'heading' => __( 'Block title', 'wpdance' )
				,'param_name' => 'title'
				,'admin_label' => true
				,'value' => ''
				,'description' => ''
			 )
			,array(
				'type' => 'textarea'
				,'heading' => __( 'Block description', 'wpdance' )
				,'param_name' => 'desc'
				,'admin_label' => true
				,'value' => ''
				,'description' => ''
			 )
			 ,array(
				'type' => 'textarea'
				,'heading' => __( 'Categories', 'wpdance' )
				,'param_name' => 'portfolio_cats'
				,'admin_label' => true
				,'value' => ''
				,'description' => __('A comma separeted list of portfolio category slugs', 'wpdance')
			 )
			 ,array(
				'type' => 'textfield'
				,'heading' => __( 'Number of posts', 'wpdance' )
				,'param_name' => 'per_page'
				,'admin_label' => true
				,'value' => '5'
				,'description' => ''
			 )
			 ,array(
				'type' => 'dropdown'
				,'heading' => __( 'Show navigation buttons', 'wpdance' )
				,'param_name' => 'show_nav'
				,'admin_label' => true
				,'value' => array(
						'Yes'	=> 1
						,'No'	=> 0
					)
				,'description' => ''
			 )
		)
	));
	
	/* Testimonial */
	vc_map( array(
		'name' => __( 'Testimonial', 'wpdance' )
		,'base' => 'testimonial'
		,'category' => __( 'WD Content', 'wpdance')
		,'params' => array(
			array(
				'type' => 'textfield'
				,'heading' => __( 'Testimonial slug', 'wpdance' )
				,'param_name' => 'slug'
				,'admin_label' => true
				,'value' => ''
				,'description' => __('Do not input value if you want to show as a carousel slider', 'wpdance')
			 )
			,array(
				'type' => 'textfield'
				,'heading' => __( 'Testimonial id', 'wpdance' )
				,'param_name' => 'id'
				,'admin_label' => true
				,'value' => ''
				,'description' => __('Do not input value if you want to show as a carousel slider', 'wpdance')
			 )
			 ,array(
				'type' => 'textfield'
				,'heading' => __( 'Number of posts', 'wpdance' )
				,'param_name' => 'limit'
				,'admin_label' => true
				,'value' => '5'
				,'description' => ''
			 )
			 ,array(
				'type' => 'dropdown'
				,'heading' => __( 'Slider mode', 'wpdance' )
				,'param_name' => 'slider'
				,'admin_label' => true
				,'value' => array(
							'No'	=> 0
							,'Yes'	=> 1
						)
				,'description' => ''
			 )
			 ,array(
				'type' => 'textarea'
				,'heading' => __( 'Category', 'wpdance' )
				,'param_name' => 'category'
				,'admin_label' => true
				,'value' => ''
				,'description' => __('Testimonial category id or slug', 'wpdance')
			 )
		)
	));
	
	/* Team Member */
	$member_options = array();
	
	if( class_exists('WD_Team') || post_type_exists('team') ){
		global $post;
		$args = array(
				'post_type'			=> 'team'
				,'post_status'		=> 'publish'
				,'posts_per_page'	=> -1
			);
		$members = new WP_Query($args);
		if( $members->have_posts() ){
			while( $members->have_posts() ){
				$members->the_post();
				$member_options[$post->post_title] = $post->ID;
			}
		}
		wp_reset_query();
	}
	
	vc_map( array(
		'name' => __( 'Team Member', 'wpdance' )
		,'base' => 'team_member'
		,'category' => __( 'WD Content', 'wpdance')
		,'params' => array(
			array(
				'type' => 'dropdown'
				,'heading' => __( 'Member', 'wpdance' )
				,'param_name' => 'id'
				,'admin_label' => true
				,'value' => $member_options
				,'description' => ''
			)
		)
	));
	
	/* Brand Slider */
	$brand_options = array();
	
	if( class_exists('WD_Slide') || post_type_exists('slide') ){
		global $post;
		$args = array(
				'post_type'			=> 'slide'
				,'post_status'		=> 'publish'
				,'posts_per_page'	=> -1
			);
		$brands = new WP_Query($args);
		if( $brands->have_posts() ){
			while( $brands->have_posts() ){
				$brands->the_post();
				$brand_options[$post->post_title] = $post->ID;
			}
		}
		wp_reset_query();
	}
	
	vc_map( array(
		'name' => __( 'Brand Slider', 'wpdance' )
		,'base' => 'wd_slider'
		,'category' => __( 'WD Content', 'wpdance')
		,'params' => array(
			array(
				'type' => 'dropdown'
				,'heading' => __( 'Brand', 'wpdance' )
				,'param_name' => 'id'
				,'admin_label' => true
				,'value' => $brand_options
				,'description' => ''
			)
		)
	));
	
	vc_map( array(
		'name' => __( 'Google Map', 'wpdance' )
		,'base' => 'google_map'
		,'category' => __( 'WD Content', 'wpdance')
		,'params' => array(
			array(
				'type' => 'textfield'
				,'heading' => __( 'Address', 'wpdance' )
				,'param_name' => 'address'
				,'admin_label' => true
				,'value' => ''
				,'description' => ''
			)
			,array(
				'type' => 'textfield'
				,'heading' => __( 'Title', 'wpdance' )
				,'param_name' => 'title'
				,'admin_label' => true
				,'value' => ''
				,'description' => ''
			)
			,array(
				'type' => 'textfield'
				,'heading' => __( 'Height', 'wpdance' )
				,'param_name' => 'height'
				,'admin_label' => true
				,'value' => '360'
				,'description' => ''
			)
			,array(
				'type' => 'textfield'
				,'heading' => __( 'Zoom', 'wpdance' )
				,'param_name' => 'zoom'
				,'admin_label' => true
				,'value' => '16'
				,'description' => ''
			)
			,array(
				'type' => 'colorpicker'
				,'heading' => __( 'Map color', 'wpdance' )
				,'param_name' => 'map_color'
				,'admin_label' => true
				,'value' => '#00ffee'
				,'description' => ''
			)
			,array(
				'type' => 'colorpicker'
				,'heading' => __( 'Water color', 'wpdance' )
				,'param_name' => 'water_color'
				,'admin_label' => true
				,'value' => '#00ffee'
				,'description' => ''
			)
			,array(
				'type' => 'colorpicker'
				,'heading' => __( 'Road color', 'wpdance' )
				,'param_name' => 'road_color'
				,'admin_label' => true
				,'value' => '#00ffee'
				,'description' => ''
			)
		)
	));
	
}

if (!function_exists('getFontAwesomeIconArray')){
	function getFontAwesomeIconArray(){
		
		$icons = array (
			'fa-adjust' => '\f042',
			'fa-adn' => '\f170',
			'fa-align-center' => '\f037',
			'fa-align-justify' => '\f039',
			'fa-align-left' => '\f036',
			'fa-align-right' => '\f038',
			'fa-ambulance' => '\f0f9',
			'fa-anchor' => '\f13d',
			'fa-android' => '\f17b',
			'fa-angle-double-down' => '\f103',
			'fa-angle-double-left' => '\f100',
			'fa-angle-double-right' => '\f101',
			'fa-angle-double-up' => '\f102',
			'fa-angle-down' => '\f107',
			'fa-angle-left' => '\f104',
			'fa-angle-right' => '\f105',
			'fa-angle-up' => '\f106',
			'fa-apple' => '\f179',
			'fa-archive' => '\f187',
			'fa-arrow-circle-down' => '\f0ab',
			'fa-arrow-circle-left' => '\f0a8',
			'fa-arrow-circle-o-down' => '\f01a',
			'fa-arrow-circle-o-left' => '\f190',
			'fa-arrow-circle-o-right' => '\f18e',
			'fa-arrow-circle-o-up' => '\f01b',
			'fa-arrow-circle-right' => '\f0a9',
			'fa-arrow-circle-up' => '\f0aa',
			'fa-arrow-down' => '\f063',
			'fa-arrow-left' => '\f060',
			'fa-arrow-right' => '\f061',
			'fa-arrow-up' => '\f062',
			'fa-arrows' => '\f047',
			'fa-arrows-alt' => '\f0b2',
			'fa-arrows-h' => '\f07e',
			'fa-arrows-v' => '\f07d',
			'fa-asterisk' => '\f069',
			'fa-backward' => '\f04a',
			'fa-ban' => '\f05e',
			'fa-bar-chart-o' => '\f080',
			'fa-barcode' => '\f02a',
			'fa-bars' => '\f0c9',
			'fa-beer' => '\f0fc',
			'fa-bell' => '\f0f3',
			'fa-bell-o' => '\f0a2',
			'fa-bitbucket' => '\f171',
			'fa-bitbucket-square' => '\f172',
			'fa-bold' => '\f032',
			'fa-bolt' => '\f0e7',
			'fa-book' => '\f02d',
			'fa-bookmark' => '\f02e',
			'fa-bookmark-o' => '\f097',
			'fa-briefcase' => '\f0b1',
			'fa-btc' => '\f15a',
			'fa-bug' => '\f188',
			'fa-building-o' => '\f0f7',
			'fa-bullhorn' => '\f0a1',
			'fa-bullseye' => '\f140',
			'fa-calendar' => '\f073',
			'fa-calendar-o' => '\f133',
			'fa-camera' => '\f030',
			'fa-camera-retro' => '\f083',
			'fa-caret-down' => '\f0d7',
			'fa-caret-left' => '\f0d9',
			'fa-caret-right' => '\f0da',
			'fa-caret-square-o-down' => '\f150',
			'fa-caret-square-o-left' => '\f191',
			'fa-caret-square-o-right' => '\f152',
			'fa-caret-square-o-up' => '\f151',
			'fa-caret-up' => '\f0d8',
			'fa-certificate' => '\f0a3',
			'fa-chain-broken' => '\f127',
			'fa-check' => '\f00c',
			'fa-check-circle' => '\f058',
			'fa-check-circle-o' => '\f05d',
			'fa-check-square' => '\f14a',
			'fa-check-square-o' => '\f046',
			'fa-chevron-circle-down' => '\f13a',
			'fa-chevron-circle-left' => '\f137',
			'fa-chevron-circle-right' => '\f138',
			'fa-chevron-circle-up' => '\f139',
			'fa-chevron-down' => '\f078',
			'fa-chevron-left' => '\f053',
			'fa-chevron-right' => '\f054',
			'fa-chevron-up' => '\f077',
			'fa-circle' => '\f111',
			'fa-circle-o' => '\f10c',
			'fa-clipboard' => '\f0ea',
			'fa-clock-o' => '\f017',
			'fa-cloud' => '\f0c2',
			'fa-cloud-download' => '\f0ed',
			'fa-cloud-upload' => '\f0ee',
			'fa-code' => '\f121',
			'fa-code-fork' => '\f126',
			'fa-coffee' => '\f0f4',
			'fa-cog' => '\f013',
			'fa-cogs' => '\f085',
			'fa-columns' => '\f0db',
			'fa-comment' => '\f075',
			'fa-comment-o' => '\f0e5',
			'fa-comments' => '\f086',
			'fa-comments-o' => '\f0e6',
			'fa-compass' => '\f14e',
			'fa-compress' => '\f066',
			'fa-credit-card' => '\f09d',
			'fa-crop' => '\f125',
			'fa-crosshairs' => '\f05b',
			'fa-css3' => '\f13c',
			'fa-cutlery' => '\f0f5',
			'fa-desktop' => '\f108',
			'fa-dot-circle-o' => '\f192',
			'fa-download' => '\f019',
			'fa-dribbble' => '\f17d',
			'fa-dropbox' => '\f16b',
			'fa-eject' => '\f052',
			'fa-ellipsis-h' => '\f141',
			'fa-ellipsis-v' => '\f142',
			'fa-envelope' => '\f0e0',
			'fa-envelope-o' => '\f003',
			'fa-eraser' => '\f12d',
			'fa-eur' => '\f153',
			'fa-exchange' => '\f0ec',
			'fa-exclamation' => '\f12a',
			'fa-exclamation-circle' => '\f06a',
			'fa-exclamation-triangle' => '\f071',
			'fa-expand' => '\f065',
			'fa-external-link' => '\f08e',
			'fa-external-link-square' => '\f14c',
			'fa-eye' => '\f06e',
			'fa-eye-slash' => '\f070',
			'fa-facebook' => '\f09a',
			'fa-facebook-square' => '\f082',
			'fa-fast-backward' => '\f049',
			'fa-fast-forward' => '\f050',
			'fa-female' => '\f182',
			'fa-fighter-jet' => '\f0fb',
			'fa-file' => '\f15b',
			'fa-file-o' => '\f016',
			'fa-file-text' => '\f15c',
			'fa-file-text-o' => '\f0f6',
			'fa-files-o' => '\f0c5',
			'fa-film' => '\f008',
			'fa-filter' => '\f0b0',
			'fa-fire' => '\f06d',
			'fa-fire-extinguisher' => '\f134',
			'fa-flag' => '\f024',
			'fa-flag-checkered' => '\f11e',
			'fa-flag-o' => '\f11d',
			'fa-flask' => '\f0c3',
			'fa-flickr' => '\f16e',
			'fa-floppy-o' => '\f0c7',
			'fa-folder' => '\f07b',
			'fa-folder-o' => '\f114',
			'fa-folder-open' => '\f07c',
			'fa-folder-open-o' => '\f115',
			'fa-font' => '\f031',
			'fa-forward' => '\f04e',
			'fa-foursquare' => '\f180',
			'fa-frown-o' => '\f119',
			'fa-gamepad' => '\f11b',
			'fa-gavel' => '\f0e3',
			'fa-gbp' => '\f154',
			'fa-gift' => '\f06b',
			'fa-github' => '\f09b',
			'fa-github-alt' => '\f113',
			'fa-github-square' => '\f092',
			'fa-gittip' => '\f184',
			'fa-glass' => '\f000',
			'fa-globe' => '\f0ac',
			'fa-google-plus' => '\f0d5',
			'fa-google-plus-square' => '\f0d4',
			'fa-h-square' => '\f0fd',
			'fa-hand-o-down' => '\f0a7',
			'fa-hand-o-left' => '\f0a5',
			'fa-hand-o-right' => '\f0a4',
			'fa-hand-o-up' => '\f0a6',
			'fa-hdd-o' => '\f0a0',
			'fa-headphones' => '\f025',
			'fa-heart' => '\f004',
			'fa-heart-o' => '\f08a',
			'fa-home' => '\f015',
			'fa-hospital-o' => '\f0f8',
			'fa-html5' => '\f13b',
			'fa-inbox' => '\f01c',
			'fa-indent' => '\f03c',
			'fa-info' => '\f129',
			'fa-info-circle' => '\f05a',
			'fa-inr' => '\f156',
			'fa-instagram' => '\f16d',
			'fa-italic' => '\f033',
			'fa-jpy' => '\f157',
			'fa-key' => '\f084',
			'fa-keyboard-o' => '\f11c',
			'fa-krw' => '\f159',
			'fa-laptop' => '\f109',
			'fa-leaf' => '\f06c',
			'fa-lemon-o' => '\f094',
			'fa-level-down' => '\f149',
			'fa-level-up' => '\f148',
			'fa-lightbulb-o' => '\f0eb',
			'fa-link' => '\f0c1',
			'fa-linkedin' => '\f0e1',
			'fa-linkedin-square' => '\f08c',
			'fa-linux' => '\f17c',
			'fa-list' => '\f03a',
			'fa-list-alt' => '\f022',
			'fa-list-ol' => '\f0cb',
			'fa-list-ul' => '\f0ca',
			'fa-location-arrow' => '\f124',
			'fa-lock' => '\f023',
			'fa-long-arrow-down' => '\f175',
			'fa-long-arrow-left' => '\f177',
			'fa-long-arrow-right' => '\f178',
			'fa-long-arrow-up' => '\f176',
			'fa-magic' => '\f0d0',
			'fa-magnet' => '\f076',
			'fa-mail-reply-all' => '\f122',
			'fa-male' => '\f183',
			'fa-map-marker' => '\f041',
			'fa-maxcdn' => '\f136',
			'fa-medkit' => '\f0fa',
			'fa-meh-o' => '\f11a',
			'fa-microphone' => '\f130',
			'fa-microphone-slash' => '\f131',
			'fa-minus' => '\f068',
			'fa-minus-circle' => '\f056',
			'fa-minus-square' => '\f146',
			'fa-minus-square-o' => '\f147',
			'fa-mobile' => '\f10b',
			'fa-money' => '\f0d6',
			'fa-moon-o' => '\f186',
			'fa-music' => '\f001',
			'fa-outdent' => '\f03b',
			'fa-pagelines' => '\f18c',
			'fa-paperclip' => '\f0c6',
			'fa-pause' => '\f04c',
			'fa-pencil' => '\f040',
			'fa-pencil-square' => '\f14b',
			'fa-pencil-square-o' => '\f044',
			'fa-phone' => '\f095',
			'fa-phone-square' => '\f098',
			'fa-picture-o' => '\f03e',
			'fa-pinterest' => '\f0d2',
			'fa-pinterest-square' => '\f0d3',
			'fa-plane' => '\f072',
			'fa-play' => '\f04b',
			'fa-play-circle' => '\f144',
			'fa-play-circle-o' => '\f01d',
			'fa-plus' => '\f067',
			'fa-plus-circle' => '\f055',
			'fa-plus-square' => '\f0fe',
			'fa-plus-square-o' => '\f196',
			'fa-power-off' => '\f011',
			'fa-print' => '\f02f',
			'fa-puzzle-piece' => '\f12e',
			'fa-qrcode' => '\f029',
			'fa-question' => '\f128',
			'fa-question-circle' => '\f059',
			'fa-quote-left' => '\f10d',
			'fa-quote-right' => '\f10e',
			'fa-random' => '\f074',
			'fa-refresh' => '\f021',
			'fa-renren' => '\f18b',
			'fa-repeat' => '\f01e',
			'fa-reply' => '\f112',
			'fa-reply-all' => '\f122',
			'fa-retweet' => '\f079',
			'fa-road' => '\f018',
			'fa-rocket' => '\f135',
			'fa-rss' => '\f09e',
			'fa-rss-square' => '\f143',
			'fa-rub' => '\f158',
			'fa-scissors' => '\f0c4',
			'fa-search' => '\f002',
			'fa-search-minus' => '\f010',
			'fa-search-plus' => '\f00e',
			'fa-share' => '\f064',
			'fa-share-square' => '\f14d',
			'fa-share-square-o' => '\f045',
			'fa-shield' => '\f132',
			'fa-shopping-cart' => '\f07a',
			'fa-sign-in' => '\f090',
			'fa-sign-out' => '\f08b',
			'fa-signal' => '\f012',
			'fa-sitemap' => '\f0e8',
			'fa-skype' => '\f17e',
			'fa-smile-o' => '\f118',
			'fa-sort' => '\f0dc',
			'fa-sort-alpha-asc' => '\f15d',
			'fa-sort-alpha-desc' => '\f15e',
			'fa-sort-amount-asc' => '\f160',
			'fa-sort-amount-desc' => '\f161',
			'fa-sort-asc' => '\f0dd',
			'fa-sort-desc' => '\f0de',
			'fa-sort-numeric-asc' => '\f162',
			'fa-sort-numeric-desc' => '\f163',
			'fa-spinner' => '\f110',
			'fa-square' => '\f0c8',
			'fa-square-o' => '\f096', 
			'fa-stack-exchange' => '\f18d',
			'fa-stack-overflow' => '\f16c',
			'fa-star' => '\f005',
			'fa-star-half' => '\f089',
			'fa-star-half-o' => '\f123',
			'fa-star-o' => '\f006',
			'fa-step-backward' => '\f048',
			'fa-step-forward' => '\f051',
			'fa-stethoscope' => '\f0f1',
			'fa-stop' => '\f04d',
			'fa-strikethrough' => '\f0cc',
			'fa-subscript' => '\f12c',
			'fa-suitcase' => '\f0f2',
			'fa-sun-o' => '\f185',
			'fa-superscript' => '\f12b',
			'fa-table' => '\f0ce',
			'fa-tablet' => '\f10a',
			'fa-tachometer' => '\f0e4',
			'fa-tag' => '\f02b',
			'fa-tags' => '\f02c',
			'fa-tasks' => '\f0ae',
			'fa-terminal' => '\f120',
			'fa-text-height' => '\f034',
			'fa-text-width' => '\f035',
			'fa-th' => '\f00a',
			'fa-th-large' => '\f009',
			'fa-th-list' => '\f00b',
			'fa-thumb-tack' => '\f08d',
			'fa-thumbs-down' => '\f165',
			'fa-thumbs-o-down' => '\f088',
			'fa-thumbs-o-up' => '\f087',
			'fa-thumbs-up' => '\f164',
			'fa-ticket' => '\f145',
			'fa-times' => '\f00d',
			'fa-times-circle' => '\f057',
			'fa-times-circle-o' => '\f05c',
			'fa-tint' => '\f043',
			'fa-trash-o' => '\f014',
			'fa-trello' => '\f181',
			'fa-trophy' => '\f091',
			'fa-truck' => '\f0d1',
			'fa-try' => '\f195',
			'fa-tumblr' => '\f173',
			'fa-tumblr-square' => '\f174',
			'fa-twitter' => '\f099',
			'fa-twitter-square' => '\f081',
			'fa-umbrella' => '\f0e9',
			'fa-underline' => '\f0cd',
			'fa-undo' => '\f0e2',
			'fa-unlock' => '\f09c',
			'fa-unlock-alt' => '\f13e',
			'fa-upload' => '\f093',
			'fa-usd' => '\f155',
			'fa-user' => '\f007',
			'fa-user-md' => '\f0f0',
			'fa-users' => '\f0c0',
			'fa-video-camera' => '\f03d',
			'fa-vimeo-square' => '\f194',
			'fa-vk' => '\f189',
			'fa-volume-down' => '\f027',
			'fa-volume-off' => '\f026',
			'fa-volume-up' => '\f028',
			'fa-weibo' => '\f18a',
			'fa-wheelchair' => '\f193',
			'fa-windows' => '\f17a',
			'fa-wrench' => '\f0ad',
			'fa-xing' => '\f168',
			'fa-xing-square' => '\f169',
			'fa-youtube' => '\f167',
			'fa-youtube-play' => '\f16a',
			'fa-youtube-square' => '\f166',
		);

		return $icons;
	}
}

if(!function_exists('vc_icon_form_field')) {
    function vc_icon_form_field($settings, $value) {
        $settings_line = '';
        $selected = '';
		
		$fa_icons = getFontAwesomeIconArray();
		$array = array();
		foreach ($fa_icons as $key => $val) { 
			$array[$key] = $key;
		}
		
        if($value != '') {
            $array = array_diff($array, array($value));
            array_unshift($array,$value);
        }
        
        $settings_line .= '<div class="wd-icon-selector">';
        $settings_line .= '<input type="hidden" value="'.$value.'" name="'.$settings['param_name'].'" class="wd-hidden-icon wpb_vc_param_value wpb-icon-select '.$settings['param_name'].' '.$settings['type'] . '"/>';
		foreach ($array as $icon) {
			if ($value == $icon) {
				$selected = 'selected';
			}
			$settings_line .= '<span class="wd-select-icon '.$selected.'" data-icon-name='.$icon.'><i class="fa '.$icon.'"></i></span>';
			$selected = '';
		}

        $settings_line .= '<script>';
        $settings_line .= 'jQuery(".wd-select-icon").click(function(){';
        $settings_line .= 'var iconName = jQuery(this).data("icon-name");';
        $settings_line .= 'if(!jQuery(this).hasClass("selected")) {';
        $settings_line .= 'jQuery(".wd-select-icon").removeClass("selected");';
        $settings_line .= 'jQuery(this).addClass("selected");';
        $settings_line .= 'jQuery(this).parent().find(".wd-hidden-icon").val(iconName);';
        $settings_line .= '}';
        $settings_line .= '});';
        $settings_line .= '</script>';

        $settings_line .= '</div>';
        return $settings_line;
    }
}
// Add new type into VC
add_shortcode_param('wd_icon', 'vc_icon_form_field');
?>