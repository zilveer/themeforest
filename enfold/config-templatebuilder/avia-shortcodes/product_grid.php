<?php
/**
 * Post/Page Content
 *
 * Element is in Beta and by default disabled. Todo: test with layerslider elements. currently throws error bc layerslider is only included if layerslider element is detected which is not the case with the post/page element
 */

if( !class_exists( 'woocommerce' ) )
{
	add_shortcode('av_productgrid', 'avia_please_install_woo');
	return;
}

if ( !class_exists( 'avia_sc_productgrid' ) )
{
	class avia_sc_productgrid extends aviaShortcodeTemplate
	{
		/**
		 * Create the config array for the shortcode button
		 */
		function shortcode_insert_button()
		{
			$this->config['name']		= __('Product Grid', 'avia_framework' );
			$this->config['tab']		= __('Plugin Additions', 'avia_framework' );
			$this->config['icon']		= AviaBuilder::$path['imagesURL']."sc-portfolio.png";
			$this->config['order']		= 30;
			$this->config['target']		= 'avia-target-insert';
			$this->config['shortcode'] 	= 'av_productgrid';
			$this->config['tooltip'] 	= __('Display a Grid of Product Entries', 'avia_framework' );
			$this->config['drag-level'] = 3;
		}

		/**
		 * Popup Elements
		 *
		 * If this function is defined in a child class the element automatically gets an edit button, that, when pressed
		 * opens a modal window that allows to edit the element properties
		 *
		 * @return void
		 */
		function popup_elements()
		{
			$this->elements = array(

				array(
						"name" 	=> __("Which Entries?", 'avia_framework' ),
						"desc" 	=> __("Select which entries should be displayed by selecting a taxonomy", 'avia_framework' ),
						"id" 	=> "categories",
						"type" 	=> "select",
						"taxonomy" => "product_cat",
					    "subtype" => "cat",
						"multiple"	=> 6
				),

				array(
						"name" 	=> __("Columns", 'avia_framework' ),
						"desc" 	=> __("How many columns should be displayed?", 'avia_framework' ),
						"id" 	=> "columns",
						"type" 	=> "select",
						"std" 	=> "3",
						"subtype" => array(	__('2 Columns', 'avia_framework' )=>'2',
											__('3 Columns', 'avia_framework' )=>'3',
											__('4 Columns', 'avia_framework' )=>'4',
											__('5 Columns', 'avia_framework' )=>'5',
											)),
				array(
						"name" 	=> __("Entry Number", 'avia_framework' ),
						"desc" 	=> __("How many items should be displayed?", 'avia_framework' ),
						"id" 	=> "items",
						"type" 	=> "select",
						"std" 	=> "9",
						"subtype" => AviaHtmlHelper::number_array(1,100,1, array('All'=>'-1'))),

                array(
                    "name" 	=> __("Offset Number", 'avia_framework' ),
                    "desc" 	=> __("The offset determines where the query begins pulling products. Useful if you want to remove a certain number of products because you already query them with another product grid. Attention: Use this option only if the product sorting of the product grids match and do not allow the user to pick the sort order!", 'avia_framework' ),
                    "id" 	=> "offset",
                    "type" 	=> "select",
                    "std" 	=> "0",
                    "subtype" => AviaHtmlHelper::number_array(1,100,1, array(__('Deactivate offset','avia_framework')=>'0', __('Do not allow duplicate posts on the entire page (set offset automatically)', 'avia_framework' ) =>'no_duplicates'))),

				array(
						"name" 	=> __("Sorting Options", 'avia_framework' ),
						"desc" 	=> __("Here you can choose how to sort the products", 'avia_framework' ),
						"id" 	=> "sort",
						"type" 	=> "select",
						"std" 	=> "dropdown",
						"no_first"=>true,
						"subtype" => array( __('Let user pick by displaying a dropdown with sort options (default value is defined at Woocommerce -> Settings -> Catalog)', 'avia_framework' )=>'dropdown',
											__('Use defaut (defined at Woocommerce -> Settings -> Catalog) ', 'avia_framework' ) =>'0',
											__('Sort alphabetically', 'avia_framework' ) =>'title',
											__('Sort by most recent', 'avia_framework' ) =>'date',
											__('Sort by price', 'avia_framework' ) =>'price',
											__('Sort by popularity', 'avia_framework' ) =>'popularity')),

				array(
							"name" 	=> __("Pagination", 'avia_framework' ),
							"desc" 	=> __("Should a pagination be displayed?", 'avia_framework' ),
							"id" 	=> "paginate",
							"type" 	=> "select",
							"std" 	=> "yes",
							"subtype" => array(
								__('yes',  'avia_framework' ) =>'yes',
								__('no',  'avia_framework' ) =>'no')),

				);
		}

		/**
		 * Editor Element - this function defines the visual appearance of an element on the AviaBuilder Canvas
		 * Most common usage is to define some markup in the $params['innerHtml'] which is then inserted into the drag and drop container
		 * Less often used: $params['data'] to add data attributes, $params['class'] to modify the className
		 *
		 *
		 * @param array $params this array holds the default values for $content and $args.
		 * @return $params the return array usually holds an innerHtml key that holds item specific markup.
		 */
		function editor_element($params)
		{
			$params['innerHtml'] = "<img src='".$this->config['icon']."' title='".$this->config['name']."' />";
			$params['innerHtml'].= "<div class='avia-element-label'>".$this->config['name']."</div>";
			$params['content'] 	 = NULL; //remove to allow content elements
			return $params;
		}



		/**
		 * Frontend Shortcode Handler
		 *
		 * @param array $atts array of attributes
		 * @param string $content text within enclosing form of shortcode element
		 * @param string $shortcodename the shortcode found, when == callback name
		 * @return string $output returns the modified html string
		 */
		function shortcode_handler($atts, $content = "", $shortcodename = "", $meta = "")
		{
			$atts['class'] = $meta['el_class'];
			$atts['autoplay'] = "no";
			$atts['type'] = "grid";
			
			//fix for seo plugins which execute the do_shortcode() function before the WooCommerce plugin is loaded
			global $woocommerce;
			if(!is_object($woocommerce) || !is_object($woocommerce->query)) return;

			$slider = new avia_product_slider($atts);
			$slider->query_entries();
			return $slider->html();
		}
	}
}



