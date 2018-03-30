<?php
/**************************/
//Woo
/**************************/
$sections[] = array(
	'title'  => __( 'Shop', 'orangeidea' ),
	'icon'   => 'el-icon-fire',
	'subsection' => false,
	'fields' => array(
	
		
		$fields = array(
			'id'       => 'oi_shop_per_page',
			'type'     => 'text',
			'title'    => __('Products per page', 'redux-framework-demo'),
			'default'  => '8'
		),
		
		
		$fields =array(
			'id'       => 'oi_shop_per_row',
			'type'     => 'select',
			'compiler' => true,
			'title'    => __('Products Per Page', 'redux-framework-demo'), 
			'desc'     => __('', 'redux-framework-demo'),
			'options'  => array(
				'col-md-6 col-sm-6' => '2',
				'col-md-4 col-sm-4' => '3',
				'col-md-3 col-sm-3' => '4',
			),
			'default'  => 'col-md-3 col-sm-3',
		),
		
		$fields =array(
			'id'       => 'oi_shop_layout',
			'type'     => 'select',
			'compiler' => true,
			'title'    => __('Shop Layout', 'redux-framework-demo'), 
			'desc'     => __('', 'redux-framework-demo'),
			'options'  => array(
				'shop_full' => 'Full width',
				'shop_rs' => 'Right Sidebar',
				'shop_ls' => 'Left Sidebar',
			),
			'default'  => 'shop_full',
		),
		
		$fields = array(
			'id'       => 'oi_shop_cart',
			'type'     => 'switch', 
			'title'    => __('Show cart in header?', 'redux-framework-demo'),
			'default'  => true,
		),
		
		
		
		
		
		
	)
);

?>