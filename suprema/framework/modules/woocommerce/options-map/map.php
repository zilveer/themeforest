<?php

if ( ! function_exists('suprema_qodef_woocommerce_options_map') ) {

	/**
	 * Add Woocommerce options page
	 */
	function suprema_qodef_woocommerce_options_map() {

		suprema_qodef_add_admin_page(
			array(
				'slug' => '_woocommerce_page',
				'title' => 'Woocommerce',
				'icon' => 'fa fa-shopping-cart'
			)
		);

		/**
		 * Product List Settings
		 */
		$panel_product_list = suprema_qodef_add_admin_panel(
			array(
				'page' => '_woocommerce_page',
				'name' => 'panel_product_list',
				'title' => 'Product List'
			)
		);

		suprema_qodef_add_admin_field(array(
			'name'        	=> 'qodef_woo_products_list_full_width',
			'type'        	=> 'yesno',
			'label'       	=> 'Enable Full Width Template',
			'default_value'	=> 'no',
			'description' 	=> 'Enabling this option will enable full width template for shop page',
			'parent'      	=> $panel_product_list,
		));

		suprema_qodef_add_admin_field(array(
			'name'        	=> 'qodef_woo_product_list_columns',
			'type'        	=> 'select',
			'label'       	=> 'Product List Columns',
			'default_value'	=> 'qodef-woocommerce-columns-3',
			'description' 	=> 'Choose number of columns for product listing and related products on single product',
			'options'		=> array(
				'qodef-woocommerce-columns-3' => '3 Columns (2 with sidebar)',
				'qodef-woocommerce-columns-4' => '4 Columns (3 with sidebar)'
			),
			'parent'      	=> $panel_product_list,
		));

		suprema_qodef_add_admin_field(array(
			'name'        	=> 'qodef_woo_products_per_page',
			'type'        	=> 'text',
			'label'       	=> 'Number of products per page',
			'default_value'	=> '',
			'description' 	=> 'Set number of products on shop page',
			'parent'      	=> $panel_product_list,
			'args' 			=> array(
				'col_width' => 3
			)
		));

		suprema_qodef_add_admin_field(array(
			'name'        	=> 'qodef_products_list_title_tag',
			'type'        	=> 'select',
			'label'       	=> 'Products Title Tag',
			'default_value'	=> 'h1',
			'description' 	=> '',
			'options'		=> array(
				'h1' => 'h1',
				'h2' => 'h2',
				'h3' => 'h3',
				'h4' => 'h4',
				'h5' => 'h5',
				'h6' => 'h6',
			),
			'parent'      	=> $panel_product_list,
		));

		suprema_qodef_add_admin_field(array(
			'name'        	=> 'qodef_products_list_style',
			'type'        	=> 'select',
			'label'       	=> 'Product List Style',
			'default_value'	=> '1',
			'description' 	=> '',
			'options'		=> array(
				'standard' 	=> 'Standard',
				'simple' 	=> 'Simple',
				'boxed' 	=> 'Boxed'
			),
			'parent'      	=> $panel_product_list,
		));

		suprema_qodef_add_admin_field(array(
			'name'        	=> 'qodef_products_list_display_categories',
			'type'        	=> 'select',
			'label'       	=> 'Display Categories on Product List',
			'default_value'	=> '1',
			'description' 	=> '',
			'options'		=> array(
				'yes' 	=> 'Yes',
				'no' 	=> 'No'
			),
			'parent'      	=> $panel_product_list,
		));


		/*standard list*/

		$product_list_standard_title_text_group = suprema_qodef_add_admin_group(
			array(
				'parent'	=> $panel_product_list,
				'title'		=> 'Title Style for Standard Product List',
				'description'	=> 'Define style for standard products list title',
				'name'		=> 'product_list_standard_title_text_group'
			)
		);

		$product_list_standard_title_row = suprema_qodef_add_admin_row(
			array(
				'parent'	=> $product_list_standard_title_text_group,
				'name'		=> 'product_list_standard_title_row'
			)
		);

		suprema_qodef_add_admin_field(
			array(
				'parent'		=> $product_list_standard_title_row,
				'type'			=> 'colorsimple',
				'name'			=> 'product_list_standard_text_color',
				'default_value'	=> '',
				'label'			=> 'Text Color',
			)
		);

		suprema_qodef_add_admin_field(
			array(
				'parent'		=> $product_list_standard_title_row,
				'type'			=> 'textsimple',
				'name'			=> 'product_list_standard_text_fontsize',
				'default_value'	=> '',
				'label'			=> 'Font Size',
				'args'			=> array(
					'suffix' => 'px'
				)
			)
		);

		suprema_qodef_add_admin_field(
			array(
				'parent'		=> $product_list_standard_title_row,
				'type'			=> 'selectblanksimple',
				'name'			=> 'product_list_standard_text_texttransform',
				'default_value'	=> '',
				'label'			=> 'Text Transform',
				'options'		=> suprema_qodef_get_text_transform_array()
			)
		);

		$product_list_standard_title_row2 = suprema_qodef_add_admin_row(
			array(
				'parent'	=> $product_list_standard_title_text_group,
				'name'		=> 'product_list_standard_title_row2'
			)
		);

		suprema_qodef_add_admin_field(
			array(
				'parent'		=> $product_list_standard_title_row2,
				'type'			=> 'fontsimple',
				'name'			=> 'product_list_standard_text_google_fonts',
				'default_value'	=> '-1',
				'label'			=> 'Font Family',
			)
		);

		suprema_qodef_add_admin_field(
			array(
				'parent'		=> $product_list_standard_title_row2,
				'type'			=> 'selectblanksimple',
				'name'			=> 'product_list_standard_text_fontstyle',
				'default_value'	=> '',
				'label'			=> 'Font Style',
				'options'		=> suprema_qodef_get_font_style_array(),
			)
		);

		suprema_qodef_add_admin_field(
			array(
				'parent'		=> $product_list_standard_title_row2,
				'type'			=> 'selectblanksimple',
				'name'			=> 'product_list_standard_text_fontweight',
				'default_value'	=> '',
				'label'			=> 'Font Weight',
				'options'		=> suprema_qodef_get_font_weight_array()
			)
		);

		suprema_qodef_add_admin_field(
			array(
				'parent'		=> $product_list_standard_title_row2,
				'type'			=> 'textsimple',
				'name'			=> 'product_list_standard_text_letterspacing',
				'default_value'	=> '',
				'label'			=> 'Letter Spacing',
				'args'			=> array(
					'suffix'	=> 'px'
				)
			)
		);



		/*simple list*/

		$product_list_simple_title_text_group = suprema_qodef_add_admin_group(
			array(
				'parent'	=> $panel_product_list,
				'title'		=> 'Title Style for Simple Product List',
				'description'	=> 'Define style for simple products list title',
				'name'		=> 'product_list_simple_title_text_group'
			)
		);

		$product_list_simple_title_row = suprema_qodef_add_admin_row(
			array(
				'parent'	=> $product_list_simple_title_text_group,
				'name'		=> 'product_list_simple_title_row'
			)
		);

		suprema_qodef_add_admin_field(
			array(
				'parent'		=> $product_list_simple_title_row,
				'type'			=> 'colorsimple',
				'name'			=> 'product_list_simple_text_color',
				'default_value'	=> '',
				'label'			=> 'Text Color',
			)
		);

		suprema_qodef_add_admin_field(
			array(
				'parent'		=> $product_list_simple_title_row,
				'type'			=> 'textsimple',
				'name'			=> 'product_list_simple_text_fontsize',
				'default_value'	=> '',
				'label'			=> 'Font Size',
				'args'			=> array(
					'suffix' => 'px'
				)
			)
		);

		suprema_qodef_add_admin_field(
			array(
				'parent'		=> $product_list_simple_title_row,
				'type'			=> 'selectblanksimple',
				'name'			=> 'product_list_simple_text_texttransform',
				'default_value'	=> '',
				'label'			=> 'Text Transform',
				'options'		=> suprema_qodef_get_text_transform_array()
			)
		);

		$product_list_simple_title_row2 = suprema_qodef_add_admin_row(
			array(
				'parent'	=> $product_list_simple_title_text_group,
				'name'		=> 'product_list_simple_title_row2'
			)
		);

		suprema_qodef_add_admin_field(
			array(
				'parent'		=> $product_list_simple_title_row2,
				'type'			=> 'fontsimple',
				'name'			=> 'product_list_simple_text_google_fonts',
				'default_value'	=> '-1',
				'label'			=> 'Font Family',
			)
		);

		suprema_qodef_add_admin_field(
			array(
				'parent'		=> $product_list_simple_title_row2,
				'type'			=> 'selectblanksimple',
				'name'			=> 'product_list_simple_text_fontstyle',
				'default_value'	=> '',
				'label'			=> 'Font Style',
				'options'		=> suprema_qodef_get_font_style_array(),
			)
		);

		suprema_qodef_add_admin_field(
			array(
				'parent'		=> $product_list_simple_title_row2,
				'type'			=> 'selectblanksimple',
				'name'			=> 'product_list_simple_text_fontweight',
				'default_value'	=> '',
				'label'			=> 'Font Weight',
				'options'		=> suprema_qodef_get_font_weight_array()
			)
		);

		suprema_qodef_add_admin_field(
			array(
				'parent'		=> $product_list_simple_title_row2,
				'type'			=> 'textsimple',
				'name'			=> 'product_list_simple_text_letterspacing',
				'default_value'	=> '',
				'label'			=> 'Letter Spacing',
				'args'			=> array(
					'suffix'	=> 'px'
				)
			)
		);



		/*boxed list*/

		$product_list_boxed_title_text_group = suprema_qodef_add_admin_group(
			array(
				'parent'	=> $panel_product_list,
				'title'		=> 'Title Style for Boxed Product List',
				'description'	=> 'Define style for boxed products list title',
				'name'		=> 'product_list_boxed_title_text_group'
			)
		);

		$product_list_boxed_title_row = suprema_qodef_add_admin_row(
			array(
				'parent'	=> $product_list_boxed_title_text_group,
				'name'		=> 'product_list_boxed_title_row'
			)
		);

		suprema_qodef_add_admin_field(
			array(
				'parent'		=> $product_list_boxed_title_row,
				'type'			=> 'colorsimple',
				'name'			=> 'product_list_boxed_text_color',
				'default_value'	=> '',
				'label'			=> 'Text Color',
			)
		);

		suprema_qodef_add_admin_field(
			array(
				'parent'		=> $product_list_boxed_title_row,
				'type'			=> 'textsimple',
				'name'			=> 'product_list_boxed_text_fontsize',
				'default_value'	=> '',
				'label'			=> 'Font Size',
				'args'			=> array(
					'suffix' => 'px'
				)
			)
		);

		suprema_qodef_add_admin_field(
			array(
				'parent'		=> $product_list_boxed_title_row,
				'type'			=> 'selectblanksimple',
				'name'			=> 'product_list_boxed_text_texttransform',
				'default_value'	=> '',
				'label'			=> 'Text Transform',
				'options'		=> suprema_qodef_get_text_transform_array()
			)
		);

		$product_list_boxed_title_row2 = suprema_qodef_add_admin_row(
			array(
				'parent'	=> $product_list_boxed_title_text_group,
				'name'		=> 'product_list_boxed_title_row2'
			)
		);

		suprema_qodef_add_admin_field(
			array(
				'parent'		=> $product_list_boxed_title_row2,
				'type'			=> 'fontsimple',
				'name'			=> 'product_list_boxed_text_google_fonts',
				'default_value'	=> '-1',
				'label'			=> 'Font Family',
			)
		);

		suprema_qodef_add_admin_field(
			array(
				'parent'		=> $product_list_boxed_title_row2,
				'type'			=> 'selectblanksimple',
				'name'			=> 'product_list_boxed_text_fontstyle',
				'default_value'	=> '',
				'label'			=> 'Font Style',
				'options'		=> suprema_qodef_get_font_style_array(),
			)
		);

		suprema_qodef_add_admin_field(
			array(
				'parent'		=> $product_list_boxed_title_row2,
				'type'			=> 'selectblanksimple',
				'name'			=> 'product_list_boxed_text_fontweight',
				'default_value'	=> '',
				'label'			=> 'Font Weight',
				'options'		=> suprema_qodef_get_font_weight_array()
			)
		);

		suprema_qodef_add_admin_field(
			array(
				'parent'		=> $product_list_boxed_title_row2,
				'type'			=> 'textsimple',
				'name'			=> 'product_list_boxed_text_letterspacing',
				'default_value'	=> '',
				'label'			=> 'Letter Spacing',
				'args'			=> array(
					'suffix'	=> 'px'
				)
			)
		);




		/*masonry list*/

		$product_list_masonry_title_text_group = suprema_qodef_add_admin_group(
			array(
				'parent'	=> $panel_product_list,
				'title'		=> 'Title Style for Masonry Product List',
				'description'	=> 'Define style for masonry products list title',
				'name'		=> 'product_list_masonry_title_text_group'
			)
		);

		$product_list_masonry_title_row = suprema_qodef_add_admin_row(
			array(
				'parent'	=> $product_list_masonry_title_text_group,
				'name'		=> 'product_list_masonry_title_row'
			)
		);

		suprema_qodef_add_admin_field(
			array(
				'parent'		=> $product_list_masonry_title_row,
				'type'			=> 'colorsimple',
				'name'			=> 'product_list_masonry_text_color',
				'default_value'	=> '',
				'label'			=> 'Text Color',
			)
		);

		suprema_qodef_add_admin_field(
			array(
				'parent'		=> $product_list_masonry_title_row,
				'type'			=> 'textsimple',
				'name'			=> 'product_list_masonry_text_fontsize',
				'default_value'	=> '',
				'label'			=> 'Font Size',
				'args'			=> array(
					'suffix' => 'px'
				)
			)
		);

		suprema_qodef_add_admin_field(
			array(
				'parent'		=> $product_list_masonry_title_row,
				'type'			=> 'selectblanksimple',
				'name'			=> 'product_list_masonry_text_texttransform',
				'default_value'	=> '',
				'label'			=> 'Text Transform',
				'options'		=> suprema_qodef_get_text_transform_array()
			)
		);

		$product_list_masonry_title_row2 = suprema_qodef_add_admin_row(
			array(
				'parent'	=> $product_list_masonry_title_text_group,
				'name'		=> 'product_list_masonry_title_row2'
			)
		);

		suprema_qodef_add_admin_field(
			array(
				'parent'		=> $product_list_masonry_title_row2,
				'type'			=> 'fontsimple',
				'name'			=> 'product_list_masonry_text_google_fonts',
				'default_value'	=> '-1',
				'label'			=> 'Font Family',
			)
		);

		suprema_qodef_add_admin_field(
			array(
				'parent'		=> $product_list_masonry_title_row2,
				'type'			=> 'selectblanksimple',
				'name'			=> 'product_list_masonry_text_fontstyle',
				'default_value'	=> '',
				'label'			=> 'Font Style',
				'options'		=> suprema_qodef_get_font_style_array(),
			)
		);

		suprema_qodef_add_admin_field(
			array(
				'parent'		=> $product_list_masonry_title_row2,
				'type'			=> 'selectblanksimple',
				'name'			=> 'product_list_masonry_text_fontweight',
				'default_value'	=> '',
				'label'			=> 'Font Weight',
				'options'		=> suprema_qodef_get_font_weight_array()
			)
		);

		suprema_qodef_add_admin_field(
			array(
				'parent'		=> $product_list_masonry_title_row2,
				'type'			=> 'textsimple',
				'name'			=> 'product_list_masonry_text_letterspacing',
				'default_value'	=> '',
				'label'			=> 'Letter Spacing',
				'args'			=> array(
					'suffix'	=> 'px'
				)
			)
		);








		/**
		 * Single Product Settings
		 */
		$panel_single_product = suprema_qodef_add_admin_panel(
			array(
				'page' => '_woocommerce_page',
				'name' => 'panel_single_product',
				'title' => 'Single Product'
			)
		);

		suprema_qodef_add_admin_field(array(
			'name'        	=> 'qodef_single_product_title_tag',
			'type'        	=> 'select',
			'label'       	=> 'Single Product Title Tag',
			'default_value'	=> 'h1',
			'description' 	=> '',
			'options'		=> array(
				'h1' => 'h1',
				'h2' => 'h2',
				'h3' => 'h3',
				'h4' => 'h4',
				'h5' => 'h5',
				'h6' => 'h6',
			),
			'parent'      	=> $panel_single_product,
		));

	}

	add_action( 'suprema_qodef_options_map', 'suprema_qodef_woocommerce_options_map', 21);

}