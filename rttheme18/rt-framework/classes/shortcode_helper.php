<?php
#-----------------------------------------
#	RT-Theme shortcode_helper.php
#-----------------------------------------
 

class rt_shortcode_helper{

	public $shortcode_list = array();

	public function __construct()
	{
		$this->start();
	} 

	#
	#	Init
	#
	public function start() { 

			if(is_admin()){
				// add shortcode helper menu & editor button
				add_action( 'wp_before_admin_bar_render', array(&$this, "custom_toolbar") , 98 );		
				add_filter( 'tiny_mce_version', array(&$this, "refresh_editor") );
				add_filter( 'init', array(&$this, "rt_theme_shortcode_button") );
			}
	}

	#
	#	Add Toolbar Menu
	#
 
	public function custom_toolbar() {

		if ( ! class_exists("RTTheme") ){
			return;
		}
				
		global $wp_admin_bar;


		$args = array(
			'id'     => 'rt_shortcode_helper_button',
			'title'  => '<div><span class="icon-code"></span>'._x( 'Shortcodes', 'Admin Panel','rt-theme-20' ) .'</div>',		
			'group'  => false 
		);

		$wp_admin_bar->add_menu( $args ); 
	}

	#
	#	Add shortcode button to editor
	#
 
	public function rt_theme_shortcode_button() {

		if ( ! class_exists("RTTheme") ){
			return;
		}

		if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') )
			return;

		// Add only in Rich Editor mode
		if ( get_user_option('rich_editing') == 'true') {
			add_filter("mce_external_plugins", array(&$this,'rt_theme_add_shortcode_tinymce_plugin'));
			add_filter('mce_buttons', array(&$this,'rt_theme_register_shortcode_button'));
		}
	}


	#
	#	Register editor buttons
	#
 
	public function rt_theme_register_shortcode_button($buttons) {
		array_push($buttons, "", "rt_themeshortcode");
		return $buttons;
	}

	#
	#	Load the js file
	#

	public function rt_theme_add_shortcode_tinymce_plugin($plugin_array) {
		$plugin_array['rt_themeshortcode'] = RT_THEMEURI . '/rt-framework/admin/js/editor_buttons.js';
		return $plugin_array;
	}


	#
	#	Refresh the editor 
	#
	public function refresh_editor($ver) {
		$ver += 3;
		return $ver;
	}

	public function create_shortcode_array()
	{

		$this->shortcode_list = array(

			/* format

				"shortcode_name" => array(
					"name"=> '',
					"subline" => '',
					"id"=> '',
					"desc"=> '',
					"open" => '',
					"close" => '',	
					"content" => array(
									"shortcode_id" => '',
									"text" => ''
								),						
					"parameters" => array(
										array(
											"parameter_name" => '',
											"desc"=> '',
											"default_value" => '',
											"possible_values" => array(),
										),
									),
				),

			*/
 
								/*
									Group Name
								*/
								"group-1" => array(
									"group_name"=> __('Layout Elements','rt_theme_admin'),
									"group_icon"=> "icon-code-1",
								),

										/*
											Columns Holder
										*/			
										"columns" => array(

											"name"=> __('Columns','rt_theme_admin'),
											"desc"=> __('Columns holder shortcode. Column shortcode must be placed inside this shortcode.','rt_theme_admin'),
											"subline" => false,
											"open" => true,
											"close" => true,
											"content" => array(
															"shortcode_id" => 'column',
															"text" => ''
														),
											"parameters" => array()
										),

										/*
											Column
										*/			
										"column" => array(

											"name"=> __('Column','rt_theme_admin'),
											"desc"=> __('Display a column.','rt_theme_admin'),
											"subline" => true,
											"open" => true,
											"close" => true,
											"content" => array(
															"shortcode_id" => '',
															"text" => 'text'
														),
											"parameters" => array(
																array(
																	"parameter_name" => 'layout',
																	"desc"=> 'Layout',
																	"default_value" => 'one',
																	"possible_values" => array(
																							"one" => __('1:1 Full-Width Column','rt_theme_admin'),
																							"two" => __('1:2 Column','rt_theme_admin'),
																							"three" => __('1:3 Column','rt_theme_admin'),
																							"four" => __('1:4 Column','rt_theme_admin'),																
																							"five" => __('1:5 Column','rt_theme_admin'),
																							"two-three" => __('2:3 Column','rt_theme_admin'),
																							"three-four" => __('3:4 Column','rt_theme_admin'),
																							"four-five" => __('4:5 Column','rt_theme_admin'),
																						),
																),
															),				
										),

								/*
									Posts
								*/
								"group-2" => array(
									"group_name"=> __('Posts','rt_theme_admin'),
									"group_icon"=> "icon-code-1",
								),

										/*
											Blog Posts
										*/
										"blog_box" => array(
											"name"=> __('Blog Posts','rt_theme_admin'),
											"subline" => '',
											"id"=> 'blog_box',
											"desc"=> __('Displays blog posts with selected parameters','rt_theme_admin'),
											"open" => true,
											"close" => false,	
											"content" => array(
															"shortcode_id" => '',
															"text" => ''
														),						
											"parameters" => array(
																array(
																	"parameter_name" => 'list_layout',
																	"desc"=> __('Column layout for the widgets of the sidebar.','rt_theme_admin'),
																	"default_value" => 'one',
																	"possible_values" => array(
																							"one" => __('1:1 Full-Width Column','rt_theme_admin'),
																							"two" => __('1:2 Column','rt_theme_admin'),
																							"three" => __('1:3 Column','rt_theme_admin'),
																							"four" => __('1:4 Column','rt_theme_admin'),																
																							"five" => __('1:5 Column','rt_theme_admin'),																
																						),
																),
																array(
																	"parameter_name" => 'pagination',
																	"desc"=> __('Splits the list into pages.','rt_theme_admin'),
																	"default_value" => 'false',
																	"possible_values" => array(
																							"true" => __('True','rt_theme_admin'),
																							"false" => __('False','rt_theme_admin'),
																						),
																),
																array(
																	"parameter_name" => 'list_orderby',
																	"desc"=> __('Sorts the posts by this parameter','rt_theme_admin'),
																	"default_value" => 'date',
																	"possible_values" => array(
																							'author'=>__('Author','rt_theme_admin'),
																							'date'=>__('Date','rt_theme_admin'),
																							'title'=>__('Title','rt_theme_admin'),
																							'modified'=>__('Modified','rt_theme_admin'),
																							'ID'=>__('ID','rt_theme_admin'),
																							'rand'=>__('Randomized','rt_theme_admin'),
																						),
																),	
																array(
																	"parameter_name" => 'list_order',
																	"desc"=> __("Designates the ascending or descending order of the list_orderby parameter",'rt_theme_admin'),
																	"default_value" => 'DESC',
																	"possible_values" => array(
																							'ASC'=>__('Ascending','rt_theme_admin'),
																							'DESC'=>__('DESC','rt_theme_admin'), 
																						),
																),										
																array(
																	"parameter_name" => 'item_per_page',
																	"desc"=> __("Amount of post per page",'rt_theme_admin'),
																	"default_value" => '9'
																),
																array(
																	"parameter_name" => 'categories',
																	"desc"=> __("Category id's splitted by comma. Leave blank to list all categories.",'rt_theme_admin'),
																	"default_value" => ''
																),
															),
										),

										/*
											Portfolio Posts
										*/ 
										"portfolio_box" => array(
											"name"=> __('Portfolio Posts','rt_theme_admin'),
											"subline" => '',
											"id"=> 'portfolio_box',
											"desc"=> __('Displays porfolio posts with selected parameters','rt_theme_admin'),
											"open" => true,
											"close" => false,	
											"content" => array(
															"shortcode_id" => '',
															"text" => ''
														),						
											"parameters" => array(
																array(
																	"parameter_name" => 'item_width',
																	"desc"=> __('Column layout for the posts','rt_theme_admin'),
																	"default_value" => '4', 
																	"possible_values" => array(
																							"1" => __('1:1 Full-Width Column','rt_theme_admin'),
																							"2" => __('1:2 Column','rt_theme_admin'),
																							"3" => __('1:3 Column','rt_theme_admin'),
																							"4" => __('1:4 Column','rt_theme_admin'),																
																							"5" => __('1:5 Column','rt_theme_admin'),																
																						),
																),
																array(
																	"parameter_name" => 'filterable',
																	"desc"=> __('Filter navigation at the top of the posts.','rt_theme_admin'),
																	"default_value" => 'false',
																	"possible_values" => array(
																							"true" => __('True','rt_theme_admin'),
																							"false" => __('False','rt_theme_admin'),
																						),

																),
																array(
																	"parameter_name" => 'pagination',
																	"desc"=> __('Splits the list into pages.','rt_theme_admin'),
																	"default_value" => 'false',
																	"possible_values" => array(
																							"true" => __('True','rt_theme_admin'),
																							"false" => __('False','rt_theme_admin'),
																						),
																),
																array(
																	"parameter_name" => 'portf_list_orderby',
																	"desc"=> __('Sorts the posts by this parameter','rt_theme_admin'),
																	"default_value" => 'date',
																	"possible_values" => array(
																							'author'=>__('Author','rt_theme_admin'),
																							'date'=>__('Date','rt_theme_admin'),
																							'title'=>__('Title','rt_theme_admin'),
																							'modified'=>__('Modified','rt_theme_admin'),
																							'ID'=>__('ID','rt_theme_admin'),
																							'rand'=>__('Randomized','rt_theme_admin'),
																						),
																),	
																array(
																	"parameter_name" => 'portf_list_order',
																	"desc"=> __("Designates the ascending or descending order of the list_orderby parameter",'rt_theme_admin'),
																	"default_value" => 'DESC',
																	"possible_values" => array(
																							'ASC'=>__('Ascending','rt_theme_admin'),
																							'DESC'=>__('DESC','rt_theme_admin'), 
																						),
																),										
																array(
																	"parameter_name" => 'item_per_page',
																	"desc"=> __("Amount of post per page",'rt_theme_admin'),
																	"default_value" => '9'
																),
																array(
																	"parameter_name" => 'categories',
																	"desc"=> __("Category id's splitted by comma. Leave blank to list all categories.",'rt_theme_admin'),
																	"default_value" => ''
																),

																array(
																	"parameter_name" => 'display_titles',
																	"desc"=> __("Display titles",'rt_theme_admin'),
																	"default_value" => 'true'
																),

																array(
																	"parameter_name" => 'display_descriptions',
																	"desc"=> __("Display descriptions.",'rt_theme_admin'),
																	"default_value" => 'true'
																),

																array(
																	"parameter_name" => 'display_embedded_titles',
																	"desc"=> __("Display titles when mouse cursor over the image.",'rt_theme_admin'),
																	"default_value" => 'false'
																),

																


															),
										),

										/*
											Product Posts
										*/ 
										"product_box" => array(
											"name"=> __('Product Posts','rt_theme_admin'),
											"subline" => '',
											"id"=> 'product_box',
											"desc"=> __('Displays product posts with selected parameters','rt_theme_admin'),
											"open" => true,
											"close" => false,	
											"content" => array(
															"shortcode_id" => '',
															"text" => ''
														),						
											"parameters" => array(
																array(
																	"parameter_name" => 'heading',
																	"desc"=> __('Embedded Heading. Enter a title to be displayed as embedded to the grid.','rt_theme_admin'),
																	"default_value" => __('','rt_theme_admin'),
																),

																array(
																	"parameter_name" => 'item_width',
																	"desc"=> __('Column layout for the posts','rt_theme_admin'),
																	"default_value" => '4', 
																	"possible_values" => array(
																							"1" => __('1:1 Full-Width Column','rt_theme_admin'),
																							"2" => __('1:2 Column','rt_theme_admin'),
																							"3" => __('1:3 Column','rt_theme_admin'),
																							"4" => __('1:4 Column','rt_theme_admin'),																
																							"5" => __('1:5 Column','rt_theme_admin'),																
																						),
																),
																array(
																	"parameter_name" => 'pagination',
																	"desc"=> __('Splits the list into pages.','rt_theme_admin'),
																	"default_value" => 'false',
																	"possible_values" => array(
																							"true" => __('True','rt_theme_admin'),
																							"false" => __('False','rt_theme_admin'),
																						),
																),
																array(
																	"parameter_name" => 'list_orderby',
																	"desc"=> __('Sorts the posts by this parameter','rt_theme_admin'),
																	"default_value" => 'date',
																	"possible_values" => array(
																							'author'=>__('Author','rt_theme_admin'),
																							'date'=>__('Date','rt_theme_admin'),
																							'title'=>__('Title','rt_theme_admin'),
																							'modified'=>__('Modified','rt_theme_admin'),
																							'ID'=>__('ID','rt_theme_admin'),
																							'rand'=>__('Randomized','rt_theme_admin'),
																						),
																),	
																array(
																	"parameter_name" => 'list_order',
																	"desc"=> __("Designates the ascending or descending order of the list_orderby parameter",'rt_theme_admin'),
																	"default_value" => 'DESC',
																	"possible_values" => array(
																							'ASC'=>__('Ascending','rt_theme_admin'),
																							'DESC'=>__('DESC','rt_theme_admin'), 
																						),
																),										
																array(
																	"parameter_name" => 'item_per_page',
																	"desc"=> __("Amount of post per page",'rt_theme_admin'),
																	"default_value" => '9'
																),
																array(
																	"parameter_name" => 'categories',
																	"desc"=> __("Category id's splitted by comma. Leave blank to list all categories.",'rt_theme_admin'),
																	"default_value" => ''
																),
																array(
																	"parameter_name" => 'ids',
																	"desc"=> __("Product id's splitted by comma. Leave blank to list all products.",'rt_theme_admin'),
																	"default_value" => ''
																),			
							 

																array(
																	"parameter_name" => 'display_titles',
																	"desc"=> __("Display titles",'rt_theme_admin'),
																	"default_value" => 'true',
																	"possible_values" => array(
																							''=>__('leave blank for false','rt_theme_admin'),
																							'true'=>__('True','rt_theme_admin'), 
																						),
																),

																array(
																	"parameter_name" => 'display_descriptions',
																	"desc"=> __("Display descriptions.",'rt_theme_admin'),
																	"default_value" => 'true',
																	"possible_values" => array(
																							''=>__('leave blank for false','rt_theme_admin'),
																							'true'=>__('True','rt_theme_admin'), 
																						),
																),

																array(
																	"parameter_name" => 'display_price',
																	"desc"=> __("Display price",'rt_theme_admin'),
																	"default_value" => 'true',
																	"possible_values" => array(
																							''=>__('leave blank for false','rt_theme_admin'),
																							'true'=>__('True','rt_theme_admin'), 
																						),
																),

																array(
																	"parameter_name" => 'with_borders',
																	"desc"=> __("Display as a grid with borders",'rt_theme_admin'),
																	"default_value" => 'true',
																	"possible_values" => array(
																							''=>__('leave blank for false','rt_theme_admin'),
																							'true'=>__('True','rt_theme_admin'), 
																						),
																),

																array(
																	"parameter_name" => 'no_top_border',
																	"desc"=> __("Removes top borders of first row of the grid",'rt_theme_admin'),
																	"possible_values" => array(
																							''=>__('leave blank for false','rt_theme_admin'),
																							'true'=>__('True','rt_theme_admin'), 
																						),
																),

																array(
																	"parameter_name" => 'no_bottom_border',
																	"desc"=> __("Removes bottom borders of last row of the grid",'rt_theme_admin'),
																	"possible_values" => array(
																							''=>__('leave blank for false','rt_theme_admin'),
																							'true'=>__('True','rt_theme_admin'), 
																						),
																),


																array(
																	"parameter_name" => 'with_effect',
																	"desc"=> __("Hides the product info to display with mouse over effect. ",'rt_theme_admin'),
																	"possible_values" => array(
																							''=>__('leave blank for false','rt_theme_admin'),
																							'true'=>__('True','rt_theme_admin'), 
																						),
																),

															),
										),

										/*
											Product Categories
										*/ 
										"rt_product_categories" => array(
											"name"=> __('Product Categories','rt_theme_admin'),
											"subline" => '',
											"id"=> 'rt_product_categories',
											"desc"=> __('Displays product categories with selected parameters','rt_theme_admin'),
											"open" => true,
											"close" => false,	
											"content" => array(
															"shortcode_id" => '',
															"text" => ''
														),						
											"parameters" => array(
							 

																array(
																	"parameter_name" => 'id',
																	"desc"=> __("Custom HTML id paramater",'rt_theme_admin'),
																	"default_value" => ''
																),										

																array(
																	"parameter_name" => 'class',
																	"desc"=> __("Custom CSS class name",'rt_theme_admin'),
																	"default_value" => ''
																),								

																array(
																	"parameter_name" => 'item_width',
																	"desc"=> __('Column layout for the category list','rt_theme_admin'),
																	"default_value" => '4', 
																	"possible_values" => array(
																							"1" => __('1:1 Full-Width Column','rt_theme_admin'),
																							"2" => __('1:2 Column','rt_theme_admin'),
																							"3" => __('1:3 Column','rt_theme_admin'),
																							"4" => __('1:4 Column','rt_theme_admin'),																
																							"5" => __('1:5 Column','rt_theme_admin'),																
																						),
																),

																array(
																	"parameter_name" => 'orderby',
																	"desc"=> __('Sorts the categories by this parameter','rt_theme_admin'),
																	"default_value" => 'date',
																	"possible_values" => array(
																							'id'    => __('ID','rt_theme_admin'),
																							'name'  => __('Name','rt_theme_admin'),
																							'slug'  => __('Slug','rt_theme_admin'),
																							'count' => __('Count','rt_theme_admin')																
																						),
																),	
																array(
																	"parameter_name" => 'order',
																	"desc"=> __("Designates the ascending or descending order of the orderby parameter",'rt_theme_admin'),
																	"default_value" => 'DESC',
																	"possible_values" => array(
																							'asc'=>__('Ascending','rt_theme_admin'),
																							'desc'=>__('Descending','rt_theme_admin'), 
																						),
																),		

																array(
																	"parameter_name" => 'ids',
																	"desc"=> __("Product category id's splitted by comma. Leave blank to list all products categories.",'rt_theme_admin'),
																	"default_value" => ''
																),
							 
																array(
																	"parameter_name" => 'parent',
																	"desc"=> __("Parent category id. Lists only the subcategories of the parent category id",'rt_theme_admin'),
																	"default_value" => ''
																),

																array(
																	"parameter_name" => 'image_max_height',
																	"desc"=> __("Maximum image height for the category thumbnails. Leaave blank for defaults.",'rt_theme_admin'),
																	"default_value" => '',
																),

																array(
																	"parameter_name" => 'crop',
																	"desc"=> __("Crop category thumbnails. Crops the images according the 'image_max_height' value.",'rt_theme_admin'),
																	"default_value" => '',
																	"possible_values" => array(
																							''=>__('leave blank for false','rt_theme_admin'),
																							'true'=>__('True','rt_theme_admin'), 
																						),
																),

																array(
																	"parameter_name" => 'display_titles',
																	"desc"=> __("Display titles",'rt_theme_admin'),
																	"default_value" => 'true',
																	"possible_values" => array(
																							''=>__('leave blank for false','rt_theme_admin'),
																							'true'=>__('True','rt_theme_admin'), 
																						),
																),

																array(
																	"parameter_name" => 'display_descriptions',
																	"desc"=> __("Display descriptions.",'rt_theme_admin'),
																	"default_value" => 'true',
																	"possible_values" => array(
																							''=>__('leave blank for false','rt_theme_admin'),
																							'true'=>__('True','rt_theme_admin'), 
																						),
																),

																array(
																	"parameter_name" => 'display_thumbnails',
																	"desc"=> __("Display thumbnails.",'rt_theme_admin'),
																	"default_value" => 'true',
																	"possible_values" => array(
																							''=>__('leave blank for false','rt_theme_admin'),
																							'true'=>__('True','rt_theme_admin'), 
																						),
																),

															),
										),

										/*
											Woo Product Posts
										*/ 
										"woo_products" => array(
											"name"=> __('WooCommerce Products','rt_theme_admin'),
											"subline" => '',
											"id"=> 'woo_products',
											"desc"=> __('Displays woocommerce products with selected parameters','rt_theme_admin'),
											"open" => true,
											"close" => false,	
											"content" => array(
															"shortcode_id" => '',
															"text" => ''
														),						
											"parameters" => array(
																array(
																	"parameter_name" => 'heading',
																	"desc"=> __('Embedded Heading. Enter a title to be displayed as embedded to the grid.','rt_theme_admin'),
																	"default_value" => "",
																),

																array(
																	"parameter_name" => 'item_width',
																	"desc"=> __('Column layout for the posts','rt_theme_admin'),
																	"default_value" => '4', 
																	"possible_values" => array(
																							"1" => __('1:1 Full-Width Column','rt_theme_admin'),
																							"2" => __('1:2 Column','rt_theme_admin'),
																							"3" => __('1:3 Column','rt_theme_admin'),
																							"4" => __('1:4 Column','rt_theme_admin'),																
																							"5" => __('1:5 Column','rt_theme_admin'),																
																						),
																),
																array(
																	"parameter_name" => 'pagination',
																	"desc"=> __('Splits the list into pages.','rt_theme_admin'),
																	"default_value" => 'false',
																	"possible_values" => array(
																							"true" => __('True','rt_theme_admin'),
																							"false" => __('False','rt_theme_admin'),
																						),
																),
																array(
																	"parameter_name" => 'list_orderby',
																	"desc"=> __('Sorts the posts by this parameter','rt_theme_admin'),
																	"default_value" => 'date',
																	"possible_values" => array(
																							'author'=>__('Author','rt_theme_admin'),
																							'date'=>__('Date','rt_theme_admin'),
																							'title'=>__('Title','rt_theme_admin'),
																							'modified'=>__('Modified','rt_theme_admin'),
																							'ID'=>__('ID','rt_theme_admin'),
																							'rand'=>__('Randomized','rt_theme_admin'),
																						),
																),	
																array(
																	"parameter_name" => 'list_order',
																	"desc"=> __("Designates the ascending or descending order of the list_orderby parameter",'rt_theme_admin'),
																	"default_value" => 'DESC',
																	"possible_values" => array(
																							'ASC'=>__('Ascending','rt_theme_admin'),
																							'DESC'=>__('DESC','rt_theme_admin'), 
																						),
																),										
																array(
																	"parameter_name" => 'item_per_page',
																	"desc"=> __("Amount of post per page",'rt_theme_admin'),
																	"default_value" => '9'
																),
																array(
																	"parameter_name" => 'categories',
																	"desc"=> __("Category slug names splitted by comma. Leave blank to list all categories.",'rt_theme_admin'),
																	"default_value" => ''
																),
																array(
																	"parameter_name" => 'ids',
																	"desc"=> __("Product id's splitted by comma. Leave blank to list all products.",'rt_theme_admin'),
																	"default_value" => ''
																),			

																array(
																	"parameter_name" => 'no_top_border',
																	"desc"=> __("Removes top borders of first row of the grid",'rt_theme_admin'),
																	"possible_values" => array(
																							''=>__('leave blank for false','rt_theme_admin'),
																							'true'=>__('True','rt_theme_admin'), 
																						),
																),

																array(
																	"parameter_name" => 'no_bottom_border',
																	"desc"=> __("Removes bottom borders of last row of the grid",'rt_theme_admin'),
																	"possible_values" => array(
																							''=>__('leave blank for false','rt_theme_admin'),
																							'true'=>__('True','rt_theme_admin'), 
																						),
																),

																array(
																	"parameter_name" => 'with_effect',
																	"desc"=> __("Hides the product info to display with mouse over effect. ",'rt_theme_admin'),
																	"possible_values" => array(
																							''=>__('leave blank for false','rt_theme_admin'),
																							'true'=>__('True','rt_theme_admin'), 
																						),
																),

															),
										),
										/*
											Staff Posts
										*/ 

										"staff_box" => array(
											"name"=> __('Staff Posts','rt_theme_admin'),
											"subline" => '',
											"id"=> 'staff_box',
											"desc"=> __('Displays staff posts with selected parameters','rt_theme_admin'),
											"open" => true,
											"close" => false,	
											"content" => array(
															"shortcode_id" => '',
															"text" => ''
														),						
											"parameters" => array(
																array(
																	"parameter_name" => 'item_width',
																	"desc"=> __('Column layout for the posts','rt_theme_admin'),
																	"default_value" => '4', 
																	"possible_values" => array(
																							"1" => __('1:1 Full-Width Column','rt_theme_admin'),
																							"2" => __('1:2 Column','rt_theme_admin'),
																							"3" => __('1:3 Column','rt_theme_admin'),
																							"4" => __('1:4 Column','rt_theme_admin'),																
																							"5" => __('1:5 Column','rt_theme_admin'),																
																						),

																),
																array(
																	"parameter_name" => 'list_orderby',
																	"desc"=> __('Sorts the posts by this parameter','rt_theme_admin'),
																	"default_value" => 'date',
																	"possible_values" => array(
																							'author'=>__('Author','rt_theme_admin'),
																							'date'=>__('Date','rt_theme_admin'),
																							'title'=>__('Title','rt_theme_admin'),
																							'modified'=>__('Modified','rt_theme_admin'),
																							'ID'=>__('ID','rt_theme_admin'),
																							'rand'=>__('Randomized','rt_theme_admin'),
																						),
																),	
																array(
																	"parameter_name" => 'list_order',
																	"desc"=> __("Designates the ascending or descending order of the list_orderby parameter",'rt_theme_admin'),
																	"default_value" => 'DESC',
																	"possible_values" => array(
																							'ASC'=>__('Ascending','rt_theme_admin'),
																							'DESC'=>__('DESC','rt_theme_admin'), 
																						),
																),								
																array(
																	"parameter_name" => 'style',
																	"desc"=> __("Style",'rt_theme_admin'),
																	"default_value" => 'style-one',
																	"possible_values" => array(
																							"style-one" => "Style One", 
																							"style-two" => "Style Two", 									
																							"style-three" => "Style Three", 		
																						),
																),																			
																array(
																	"parameter_name" => 'ids',
																	"desc"=> __("Staff id's splitted by comma. Leave blank to list all.",'rt_theme_admin'),
																	"default_value" => ''
																),									
															),
										),

										/*
											Testimonials Posts
										*/ 

										"testimonial_box" => array(
											"name"=> __('Testimonials Posts','rt_theme_admin'),
											"subline" => '',
											"id"=> 'testimonial_box',
											"desc"=> __('Displays Testimonial posts with selected parameters','rt_theme_admin'),
											"open" => true,
											"close" => false,	
											"content" => array(
															"shortcode_id" => '',
															"text" => ''
														),						
											"parameters" => array(
																array(
																	"parameter_name" => 'item_width',
																	"desc"=> __('Column layout for the posts','rt_theme_admin'),
																	"default_value" => '4', 
																	"possible_values" => array(
																							"1" => __('1:1 Full-Width Column','rt_theme_admin'),
																							"2" => __('1:2 Column','rt_theme_admin'),
																							"3" => __('1:3 Column','rt_theme_admin'),
																							"4" => __('1:4 Column','rt_theme_admin'),																
																							"5" => __('1:5 Column','rt_theme_admin'),																
																						),

																),
																array(
																	"parameter_name" => 'list_orderby',
																	"desc"=> __('Sorts the posts by this parameter','rt_theme_admin'),
																	"default_value" => 'date',
																	"possible_values" => array(
																							'author'=>__('Author','rt_theme_admin'),
																							'date'=>__('Date','rt_theme_admin'),
																							'title'=>__('Title','rt_theme_admin'),
																							'modified'=>__('Modified','rt_theme_admin'),
																							'ID'=>__('ID','rt_theme_admin'),
																							'rand'=>__('Randomized','rt_theme_admin'),
																						),
																),	
																array(
																	"parameter_name" => 'list_order',
																	"desc"=> __("Designates the ascending or descending order of the list_orderby parameter",'rt_theme_admin'),
																	"default_value" => 'DESC',
																	"possible_values" => array(
																							'ASC'=>__('Ascending','rt_theme_admin'),
																							'DESC'=>__('DESC','rt_theme_admin'), 
																						),
																),																							
																array(
																	"parameter_name" => 'ids',
																	"desc"=> __("Testimonial id's splitted by comma. Leave blank to list all.",'rt_theme_admin'),
																	"default_value" => ''
																),		
																
																array(
																	"parameter_name" => 'item_per_page',
																	"desc"=> __("Amount of post per page",'rt_theme_admin'),
																	"default_value" => '9'
																),
																
																array(
																	"parameter_name" => 'pagination',
																	"desc"=> __('Splits the list into pages.','rt_theme_admin'),
																	"default_value" => 'false',
																	"possible_values" => array(
																							"true" => __('True','rt_theme_admin'),
																							"false" => __('False','rt_theme_admin'),
																						),
																),
															),
										),

										/*
											Product Carousel
										*/ 
										"product_carousel" => array(
											"name"=> __('Product Carousel','rt_theme_admin'),
											"subline" => '',
											"id"=> 'product_carousel',
											"desc"=> __('Displays product posts with selected parameters as a carousel','rt_theme_admin'),
											"open" => true,
											"close" => false,	
											"content" => array(
															"shortcode_id" => '',
															"text" => ''
														),						
											"parameters" => array(
																array(
																	"parameter_name" => 'heading',
																	"desc"=> __('Heading','rt_theme_admin'),
																	"default_value" => ''
																),
																array(
																	"parameter_name" => 'heading_icon',
																	"desc"=> __('Icon for heading','rt_theme_admin'),
																	"default_value" => ''
																),									
																array(
																	"parameter_name" => 'item_width',
																	"desc"=> __('Column layout for the posts','rt_theme_admin'),
																	"default_value" => '4', 
																	"possible_values" => array(
																							"1" => __('1:1 Full-Width Column','rt_theme_admin'),
																							"2" => __('1:2 Column','rt_theme_admin'),
																							"3" => __('1:3 Column','rt_theme_admin'),
																							"4" => __('1:4 Column','rt_theme_admin'),																
																							"5" => __('1:5 Column','rt_theme_admin'),																
																						),
																),
																array(
																	"parameter_name" => 'crop',
																	"desc"=> __('Crops product images to display them same height.','rt_theme_admin'),
																	"default_value" => 'true',
																	"possible_values" => array(
																							"true" => __('True','rt_theme_admin'),
																							"false" => __('False','rt_theme_admin'),
																						),
																),
																array(
																	"parameter_name" => 'style',
																	"desc"=> __('Caroulel style','rt_theme_admin'),
																	"default_value" => 'plain_carousel',
																	"possible_values" => array(
																							"plain_carousel" => __('Plain Box','rt_theme_admin'),
																							"rounded_carousel" => __('Rounded Box','rt_theme_admin'),
																						),
																),									
																array(
																	"parameter_name" => 'list_orderby',
																	"desc"=> __('Sorts the posts by this parameter','rt_theme_admin'),
																	"default_value" => 'date',
																	"possible_values" => array(
																							'author'=>__('Author','rt_theme_admin'),
																							'date'=>__('Date','rt_theme_admin'),
																							'title'=>__('Title','rt_theme_admin'),
																							'modified'=>__('Modified','rt_theme_admin'),
																							'ID'=>__('ID','rt_theme_admin'),
																							'rand'=>__('Randomized','rt_theme_admin'),
																						),
																),	
																array(
																	"parameter_name" => 'list_order',
																	"desc"=> __("Designates the ascending or descending order of the list_orderby parameter",'rt_theme_admin'),
																	"default_value" => 'DESC',
																	"possible_values" => array(
																							'ASC'=>__('Ascending','rt_theme_admin'),
																							'DESC'=>__('DESC','rt_theme_admin'), 
																						),
																),										
																array(
																	"parameter_name" => 'max_item',
																	"desc"=> __("Amount of post to display",'rt_theme_admin'),
																	"default_value" => '100'
																),
																array(
																	"parameter_name" => 'categories',
																	"desc"=> __("Category id's splitted by comma. Leave blank to list all categories.",'rt_theme_admin'),
																	"default_value" => ''
																),
																array(
																	"parameter_name" => 'ids',
																	"desc"=> __("Product id's splitted by comma. Leave blank to list all products.",'rt_theme_admin'),
																	"default_value" => ''
																),									
															),
										),



										/*
											WC Product Carousel
										*/ 
										"wcproduct_carousel" => array(
											"name"=> __('WooCommerce Product Carousel','rt_theme_admin'),
											"subline" => '',
											"id"=> 'wcproduct_carousel',
											"desc"=> __('Displays product posts with selected parameters as a carousel','rt_theme_admin'),
											"open" => true,
											"close" => false,	
											"content" => array(
															"shortcode_id" => '',
															"text" => ''
														),						
											"parameters" => array(
																array(
																	"parameter_name" => 'heading',
																	"desc"=> __('Heading','rt_theme_admin'),
																	"default_value" => ''
																),
																array(
																	"parameter_name" => 'heading_icon',
																	"desc"=> __('Icon for heading','rt_theme_admin'),
																	"default_value" => ''
																),									
																array(
																	"parameter_name" => 'item_width',
																	"desc"=> __('Column layout for the posts','rt_theme_admin'),
																	"default_value" => '4', 
																	"possible_values" => array(
																							"1" => __('1:1 Full-Width Column','rt_theme_admin'),
																							"2" => __('1:2 Column','rt_theme_admin'),
																							"3" => __('1:3 Column','rt_theme_admin'),
																							"4" => __('1:4 Column','rt_theme_admin'),																
																							"5" => __('1:5 Column','rt_theme_admin'),																
																						),
																),

																array(
																	"parameter_name" => 'style',
																	"desc"=> __('Caroulel style','rt_theme_admin'),
																	"default_value" => 'plain_carousel',
																	"possible_values" => array(
																							"plain_carousel" => __('Plain Box','rt_theme_admin'),
																							"rounded_carousel" => __('Rounded Box','rt_theme_admin'),
																						),
																),									
																array(
																	"parameter_name" => 'list_orderby',
																	"desc"=> __('Sorts the posts by this parameter','rt_theme_admin'),
																	"default_value" => 'date',
																	"possible_values" => array(
																							'author'=>__('Author','rt_theme_admin'),
																							'date'=>__('Date','rt_theme_admin'),
																							'title'=>__('Title','rt_theme_admin'),
																							'modified'=>__('Modified','rt_theme_admin'),
																							'ID'=>__('ID','rt_theme_admin'),
																							'rand'=>__('Randomized','rt_theme_admin'),
																						),
																),	
																array(
																	"parameter_name" => 'list_order',
																	"desc"=> __("Designates the ascending or descending order of the list_orderby parameter",'rt_theme_admin'),
																	"default_value" => 'DESC',
																	"possible_values" => array(
																							'ASC'=>__('Ascending','rt_theme_admin'),
																							'DESC'=>__('DESC','rt_theme_admin'), 
																						),
																),										
																array(
																	"parameter_name" => 'max_item',
																	"desc"=> __("Amount of post to display",'rt_theme_admin'),
																	"default_value" => '100'
																),
																array(
																	"parameter_name" => 'categories',
																	"desc"=> __("Category slug names splitted by comma. Leave blank to list all categories.",'rt_theme_admin'),
																	"default_value" => ''
																),
																array(
																	"parameter_name" => 'ids',
																	"desc"=> __("Product id's splitted by comma. Leave blank to list all products.",'rt_theme_admin'),
																	"default_value" => ''
																),									
															),
										),
										/*
											Portfolio Carousel
										*/ 
										"portfolio_carousel" => array(
											"name"=> __('Portfolio Carousel','rt_theme_admin'),
											"subline" => '',
											"id"=> 'product_carousel',
											"desc"=> __('Displays portfolio posts with selected parameters as a carousel','rt_theme_admin'),
											"open" => true,
											"close" => false,	
											"content" => array(
															"shortcode_id" => '',
															"text" => ''
														),						
											"parameters" => array(
																array(
																	"parameter_name" => 'heading',
																	"desc"=> __('Heading','rt_theme_admin'),
																	"default_value" => ''
																),
																array(
																	"parameter_name" => 'heading_icon',
																	"desc"=> __('Icon for heading','rt_theme_admin'),
																	"default_value" => ''
																),									
																array(
																	"parameter_name" => 'item_width',
																	"desc"=> __('Column layout for the posts','rt_theme_admin'),
																	"default_value" => '4', 
																	"possible_values" => array(
																							"1" => __('1:1 Full-Width Column','rt_theme_admin'),
																							"2" => __('1:2 Column','rt_theme_admin'),
																							"3" => __('1:3 Column','rt_theme_admin'),
																							"4" => __('1:4 Column','rt_theme_admin'),																
																							"5" => __('1:5 Column','rt_theme_admin'),																
																						),
																),
																array(
																	"parameter_name" => 'crop',
																	"desc"=> __('Crops product images to display them same height.','rt_theme_admin'),
																	"default_value" => 'true',
																	"possible_values" => array(
																							"true" => __('True','rt_theme_admin'),
																							"false" => __('False','rt_theme_admin'),
																						),
																),
																array(
																	"parameter_name" => 'display_descriptions',
																	"desc"=> __('Display post descriptions.','rt_theme_admin'),
																	"default_value" => 'true',
																	"possible_values" => array(
																							"true" => __('True','rt_theme_admin'),
																							"false" => __('False','rt_theme_admin'),
																						),
																),
																array(
																	"parameter_name" => 'display_titles',
																	"desc"=> __('Display post titles.','rt_theme_admin'),
																	"default_value" => 'true',
																	"possible_values" => array(
																							"true" => __('True','rt_theme_admin'),
																							"false" => __('False','rt_theme_admin'),
																						),

																),
																array(
																	"parameter_name" => 'style',
																	"desc"=> __('Caroulel style','rt_theme_admin'),
																	"default_value" => 'plain_carousel',
																	"possible_values" => array(
																							"plain_carousel" => __('Plain Box','rt_theme_admin'),
																							"rounded_carousel" => __('Rounded Box','rt_theme_admin'),
																						),
																),									
																array(
																	"parameter_name" => 'list_orderby',
																	"desc"=> __('Sorts the posts by this parameter','rt_theme_admin'),
																	"default_value" => 'date',
																	"possible_values" => array(
																							'author'=>__('Author','rt_theme_admin'),
																							'date'=>__('Date','rt_theme_admin'),
																							'title'=>__('Title','rt_theme_admin'),
																							'modified'=>__('Modified','rt_theme_admin'),
																							'ID'=>__('ID','rt_theme_admin'),
																							'rand'=>__('Randomized','rt_theme_admin'),
																						),
																),	
																array(
																	"parameter_name" => 'list_order',
																	"desc"=> __("Designates the ascending or descending order of the list_orderby parameter",'rt_theme_admin'),
																	"default_value" => 'DESC',
																	"possible_values" => array(
																							'ASC'=>__('Ascending','rt_theme_admin'),
																							'DESC'=>__('DESC','rt_theme_admin'), 
																						),
																),										
																array(
																	"parameter_name" => 'max_item',
																	"desc"=> __("Amount of posts to display",'rt_theme_admin'),
																	"default_value" => '100'
																),
																array(
																	"parameter_name" => 'categories',
																	"desc"=> __("Category id's splitted by comma. Leave blank to list all categories.",'rt_theme_admin'),
																	"default_value" => ''
																),
																array(
																	"parameter_name" => 'ids',
																	"desc"=> __("Product id's splitted by comma. Leave blank to list all posts.",'rt_theme_admin'),
																	"default_value" => ''
																),									
															),
										),

										/*
											Posts Carousel
										*/ 
										"blog_carousel" => array(
											"name"=> __('Blog Posts Carousel','rt_theme_admin'),
											"subline" => '',
											"id"=> 'blog_carousel',
											"desc"=> __('Displays posts with selected parameters as a carousel','rt_theme_admin'),
											"open" => true,
											"close" => false,	
											"content" => array(
															"shortcode_id" => '',
															"text" => ''
														),						
											"parameters" => array(
																array(
																	"parameter_name" => 'heading',
																	"desc"=> __('Heading','rt_theme_admin'),
																	"default_value" => ''
																),
																array(
																	"parameter_name" => 'heading_icon',
																	"desc"=> __('Icon for heading','rt_theme_admin'),
																	"default_value" => ''
																),									
																array(
																	"parameter_name" => 'item_width',
																	"desc"=> __('Column layout for the posts','rt_theme_admin'),
																	"default_value" => '4', 
																	"possible_values" => array(
																							"1" => __('1:1 Full-Width Column','rt_theme_admin'),
																							"2" => __('1:2 Column','rt_theme_admin'),
																							"3" => __('1:3 Column','rt_theme_admin'),
																							"4" => __('1:4 Column','rt_theme_admin'),																
																							"5" => __('1:5 Column','rt_theme_admin'),																
																						),
																),
																array(
																	"parameter_name" => 'crop',
																	"desc"=> __('Crops product images to display them same height.','rt_theme_admin'),
																	"default_value" => 'true',
																	"possible_values" => array(
																							"true" => __('True','rt_theme_admin'),
																							"false" => __('False','rt_theme_admin'),
																						),
																),
																array(
																	"parameter_name" => 'display_excerpts',
																	"desc"=> __('Display post excerpts.','rt_theme_admin'),
																	"default_value" => 'true',
																	"possible_values" => array(
																							"true" => __('True','rt_theme_admin'),
																							"false" => __('False','rt_theme_admin'),
																						),
																),
																array(
																	"parameter_name" => 'style',
																	"desc"=> __('Caroulel style','rt_theme_admin'),
																	"default_value" => 'plain_carousel',
																	"possible_values" => array(
																							"plain_carousel" => __('Plain Box','rt_theme_admin'),
																							"rounded_carousel" => __('Rounded Box','rt_theme_admin'),
																						),
																),									
																array(
																	"parameter_name" => 'list_orderby',
																	"desc"=> __('Sorts the posts by this parameter','rt_theme_admin'),
																	"default_value" => 'date',
																	"possible_values" => array(
																							'author'=>__('Author','rt_theme_admin'),
																							'date'=>__('Date','rt_theme_admin'),
																							'title'=>__('Title','rt_theme_admin'),
																							'modified'=>__('Modified','rt_theme_admin'),
																							'ID'=>__('ID','rt_theme_admin'),
																							'rand'=>__('Randomized','rt_theme_admin'),
																						),
																),	
																array(
																	"parameter_name" => 'list_order',
																	"desc"=> __("Designates the ascending or descending order of the list_orderby parameter",'rt_theme_admin'),
																	"default_value" => 'DESC',
																	"possible_values" => array(
																							'ASC'=>__('Ascending','rt_theme_admin'),
																							'DESC'=>__('DESC','rt_theme_admin'), 
																						),
																),										
																array(
																	"parameter_name" => 'max_item',
																	"desc"=> __("Amount of posts to display",'rt_theme_admin'),
																	"default_value" => '10'
																),
																array(
																	"parameter_name" => 'categories',
																	"desc"=> __("Category id's splitted by comma. Leave blank to list all categories.",'rt_theme_admin'),
																	"default_value" => ''
																),
																array(
																	"parameter_name" => 'ids',
																	"desc"=> __("Product id's splitted by comma. Leave blank to list all posts.",'rt_theme_admin'),
																	"default_value" => ''
																),			

																array(
																	"parameter_name" => 'limit_chars',
																	"desc"=> __("Limit the excerpt charackter size",'rt_theme_admin'),
																	"default_value" => ''
																),	

															),
										),

										/*
											Testimonials Carousel
										*/  

										"testimonial_carousel" => array(
											"name"=> __('Testimonials Carousel','rt_theme_admin'),
											"subline" => '',
											"id"=> 'testimonial_carousel',
											"desc"=> __('Displays Testimonial posts with selected parameters as a caroulel','rt_theme_admin'),
											"open" => true,
											"close" => false,	
											"content" => array(
															"shortcode_id" => '',
															"text" => ''
														),						
											"parameters" => array(
																array(
																	"parameter_name" => 'heading',
																	"desc"=> __('Heading','rt_theme_admin'),
																	"default_value" => ''
																),
																array(
																	"parameter_name" => 'heading_icon',
																	"desc"=> __('Icon for heading','rt_theme_admin'),
																	"default_value" => ''
																),											
																array(
																	"parameter_name" => 'item_width',
																	"desc"=> __('Column layout for the posts','rt_theme_admin'),
																	"default_value" => '4', 
																	"possible_values" => array(
																							"1" => __('1:1 Full-Width Column','rt_theme_admin'),
																							"2" => __('1:2 Column','rt_theme_admin'),
																							"3" => __('1:3 Column','rt_theme_admin'),
																							"4" => __('1:4 Column','rt_theme_admin'),																
																							"5" => __('1:5 Column','rt_theme_admin'),																
																						),

																),
																array(
																	"parameter_name" => 'list_orderby',
																	"desc"=> __('Sorts the posts by this parameter','rt_theme_admin'),
																	"default_value" => 'date',
																	"possible_values" => array(
																							'author'=>__('Author','rt_theme_admin'),
																							'date'=>__('Date','rt_theme_admin'),
																							'title'=>__('Title','rt_theme_admin'),
																							'modified'=>__('Modified','rt_theme_admin'),
																							'ID'=>__('ID','rt_theme_admin'),
																							'rand'=>__('Randomized','rt_theme_admin'),
																						),
																),	
																array(
																	"parameter_name" => 'list_order',
																	"desc"=> __("Designates the ascending or descending order of the list_orderby parameter",'rt_theme_admin'),
																	"default_value" => 'DESC',
																	"possible_values" => array(
																							'ASC'=>__('Ascending','rt_theme_admin'),
																							'DESC'=>__('DESC','rt_theme_admin'), 
																						),
																),	
																array(
																	"parameter_name" => 'max_item',
																	"desc"=> __("Amount of posts to display",'rt_theme_admin'),
																	"default_value" => '100'
																),																															
																array(
																	"parameter_name" => 'ids',
																	"desc"=> __("Testimonial id's splitted by comma. Leave blank to list all.",'rt_theme_admin'),
																	"default_value" => ''
																),									
															),
										),


								/*
									Images
								*/
								"group-3" => array(
									"group_name"=> __('Media & Sliders','rt_theme_admin'),
									"group_icon"=> "icon-code-1",
								),

										/*
											Photo Gallery Holder
										*/			
										"photo_gallery" => array(

											"name"=> __('Photo Gallery','rt_theme_admin'),
											"desc"=> __('Holder shortcode for photo gallery.','rt_theme_admin'),
											"subline" => false,
											"id"=> 'photo_gallery',
											"open" => true,
											"close" => true,
											"content" => array(
															"shortcode_id" => 'image',
															"text" => ''
														),
											"parameters" => array(
									
																array(
																	"parameter_name" => 'item_width',
																	"desc"=> __('Column layout','rt_theme_admin'),
																	"default_value" => '5', 
																	"possible_values" => array(
																							"1" => __('1:1 Full-Width Column','rt_theme_admin'),
																							"2" => __('1:2 Column','rt_theme_admin'),
																							"3" => __('1:3 Column','rt_theme_admin'),
																							"4" => __('1:4 Column','rt_theme_admin'),																
																							"5" => __('1:5 Column','rt_theme_admin'),																
																						),
																),
															),
										),

										/*
											Photo gallery images
										*/			
										"image" => array(

											"name"=> __('Image','rt_theme_admin'),
											"desc"=> __('Displays a gallery item.','rt_theme_admin'),
											"subline" => true,
											"id"=> 'image',
											"open" => true,
											"close" => true,
											"content" => array(
															"shortcode_id" => '',
															"text" => 'http://local-image-url'
														),
											"parameters" => array(
									
																array(
																	"parameter_name" => 'title',
																	"desc"=> 'Image title',
																	"default_value" => '',
																),						
																array(
																	"parameter_name" => 'caption',
																	"desc"=> 'Image Caption',
																	"default_value" => '',
																),															
																array(
																	"parameter_name" => 'thumb_width',
																	"desc"=> 'The thumbnail width. Do not leave blank.',
																	"default_value" => '135'
																),
																array(
																	"parameter_name" => 'thumb_height',
																	"desc"=> 'The thumbnail height. Do not leave blank.',
																	"default_value" => '135'
																),							
																array(
																	"parameter_name" => 'lightbox',
																	"desc"=> 'Opens orginal images in a lightbox window. ',
																	"default_value" => 'true',
																	"possible_values" => array(
																							"true" => __('True','rt_theme_admin'),
																							"false" => __('False','rt_theme_admin'),
																						),
																),
																array(
																	"parameter_name" => 'custom_link',
																	"desc"=> 'Custom link to the thumbnail rather than the orginal image. ',
																	"default_value" => '',
																),						
																array(
																	"parameter_name" => 'open_in_new_tab',
																	"desc"=> 'Opens the link in a new tab, if set true.',
																	"default_value" => '',
																	"possible_values" => array(
																							"true" => __('True','rt_theme_admin'),
																							"false" => __('False','rt_theme_admin'),
																						),										
																),
															),				
										),

										/*
											Auto Thumbnails & Lightboxes
										*/			
										"auto_thumb" => array(


											"name"=> __('Thumbnailer & Lightbox','rt_theme_admin'),
											"desc"=> __('Creates a thumbnail and opens the orginal image or the url in a lightbox.','rt_theme_admin'),
											"subline" => false,
											"open" => true,
											"id"=> 'auto_thumb',
											"close" => true,
											"content" => array(
															"shortcode_id" => '',
															"text" => 'http://local-image-url'
														),
											"parameters" => array(
									
																array(
																	"parameter_name" => 'width',
																	"desc"=> __('Thumbnail width','rt_theme_admin'),
																	"default_value" => '135',  
																),
																array(
																	"parameter_name" => 'height',
																	"desc"=> __('Thumbnail height','rt_theme_admin'),
																	"default_value" => '135',  
																),
																array(
																	"parameter_name" => 'link',
																	"desc"=> 'link to the thumbnail rather than the orginal image. ',
																	"default_value" => '',
																),
																array(
																	"parameter_name" => 'lightbox',
																	"desc"=> 'Disables the lightbox ',
																	"default_value" => '',
																	"possible_values" => array(
																							"true" => __('True','rt_theme_admin'),
																							"false" => __('False','rt_theme_admin'),
																						),										
																),
																array(
																	"parameter_name" => 'crop',
																	"desc"=> 'Crops the thumbnail image ',
																	"default_value" => '',
																	"possible_values" => array(
																							"true" => __('True','rt_theme_admin'),
																							"false" => __('False','rt_theme_admin'),
																						),										
																),
																array(
																	"parameter_name" => 'align',
																	"desc"=> __('Alignment','rt_theme_admin'),
																	"default_value" => '',
																	"possible_values" => array(
																							"alignleft" => __('Left Aligned','rt_theme_admin'),
																							"alignright" => __('Right Aligned','rt_theme_admin'),
																							"aligncenter" => __('Centered','rt_theme_admin'),
																						),
																),
																array(
																	"parameter_name" => 'title',
																	"desc"=> 'Image title',
																	"default_value" => '',
																),

															),
										),

										/*
											Image Slider Holder
										*/						

										"slider" => array(

											"name"=> __('Photo Slider','rt_theme_admin'),
											"desc"=> __('Holder shortcode for photo slider.','rt_theme_admin'),
											"subline" => false,
											"id"=> 'slider',
											"open" => true,
											"close" => true,
											"content" => array(
															"shortcode_id" => 'slide',
															"text" => ''
														),
											"parameters" => array(


																array(
																	"parameter_name" => 'slider_height',
																	"desc"=> 'Max height of the slider. image_crop must be true to proper result.',
																	"default_value" => '', 
																),

																array(
																	"parameter_name" => 'image_resize',
																	"desc"=> 'Resize the slider images.',
																	"default_value" => 'false',
																	"possible_values" => array(
																							"true" => __('True','rt_theme_admin'),
																							"false" => __('False','rt_theme_admin'),
																						),										
																),

																array(
																	"parameter_name" => 'image_crop',
																	"desc"=> 'Crops the slider images.',
																	"default_value" => 'false',
																	"possible_values" => array(
																							"true" => __('True','rt_theme_admin'),
																							"false" => __('False','rt_theme_admin'),
																						),										
																),


																array(
																	"parameter_name" => 'flex_slider_effect',
																	"desc"=> 'Slide effect',
																	"default_value" => 'slide',
																	"possible_values" => array(
																							"slide" => __('Slide','rt_theme_admin'),
																							"fade" => __('Fade','rt_theme_admin'),
																						),										
																),
																array(
																	"parameter_name" => 'slider_timeout',
																	"desc"=> '(second) Timeout for each slide.',
																	"default_value" => '4', 
																),

															),
										),

										/*
											Slides
										*/			
										"slide" => array(

											"name"=> __('Slide','rt_theme_admin'),
											"desc"=> __('Adds slide to the slider.','rt_theme_admin'),
											"subline" => true,
											"id"=> 'slide',
											"open" => true,
											"close" => true,
											"content" => array(
															"shortcode_id" => '',
															"text" => 'Slide Text'
														),
											"parameters" => array(
									
																array(
																	"parameter_name" => 'title',
																	"desc"=> 'Slide title',
																	"default_value" => '',
																),						
																array(
																	"parameter_name" => 'img_url',
																	"desc"=> 'Slide image url. Provide a local image url.',
																	"default_value" => '',
																),
																array(
																	"parameter_name" => 'link',
																	"desc"=> 'Link to the slide',
																	"default_value" => '',
																),
															),				
										),


										/*
											Video Embed
										*/			
										"video_embed" => array(

											"name"=> __('Video Embed','rt_theme_admin'),
											"desc"=> __('This shortcodes embeds a video from YouTube and Vimeo in a responsive layout.','rt_theme_admin'),
											"subline" => false,
											"id"=> 'video_embed',
											"open" => true,
											"close" => false,
											"content" => array(
															"shortcode_id" => '',
															"text" => ''
														),
											"parameters" => array(
									
																array(
																	"parameter_name" => 'url',
																	"desc"=> 'Video URL - The full video url that you seen your browser url bar.',
																	"default_value" => '',
																), 
															),				
										),

								/*
									Contents
								*/
								"group-4" => array(
									"group_name"=> __('Contents','rt_theme_admin'),
									"group_icon"=> "icon-code-1",
								),

										/*
											Icon Lists
										*/						

										"icon_list" => array(

											"name"=> __('Icon Lists','rt_theme_admin'),
											"desc"=> __('Holder shortcode for icon lists','rt_theme_admin'),
											"subline" => false,
											"id"=> 'icon_list',
											"open" => true,
											"close" => true,
											"content" => array(
															"shortcode_id" => 'icon_list_line',
															"text" => ''
														),
											"parameters" => array(

																array(
																	"parameter_name" => 'icon_style',
																	"desc"=> 'Icon style',
																	"default_value" => 'default',
																	"possible_values" => array( 
																							"default" => "Content Color", 
																							"colored" => "Primary Color",
																							"light" => "Light Grey",
																							"default big_icons" => "Big Icons - Content Color", 
																							"colored big_icons" => "Big Icons - Primary Color",
																							"light big_icons" => "Big Icons - Light Grey",
																							"default big_icons icon_borders" => "Big Icons - Content Color w/ Borders", 
																							"colored big_icons icon_borders" => "Big Icons - Primary Color w/ Borders",
																							"light big_icons icon_borders" => "Big Icons - Light Grey w/ Borders",	 
																						),										
																),

																array(
																	"parameter_name" => 'font_size',
																	"desc"=> 'Font size',
																	"default_value" => 'default_size',
																	"possible_values" => array(
																							"default_size" => "Same with the main content", 
																							"medium_size"  => "Medium Size",
																							"big_size"     => "Big Size",
																						),										
																), 


																array(
																	"parameter_name" => 'item_width',
																	"desc"=> 'Layout',
																	"default_value" => '1',
																	"possible_values" => array(
																							"1" => __('1:1 Full-Width Column','rt_theme_admin'),
																							"2" => __('1:2 Column','rt_theme_admin'),
																							"3" => __('1:3 Column','rt_theme_admin'),
																							"4" => __('1:4 Column','rt_theme_admin'),																
																							"5" => __('1:5 Column','rt_theme_admin'),																
																						),																					
																),									
							 


															),
										),

										/*
											Icon list line
										*/			
										"icon_list_line" => array(

											"name"=> __('List line','rt_theme_admin'),
											"desc"=> __('Adds a line to the list.','rt_theme_admin'),
											"subline" => true,
											"id"=> 'icon_list_line',
											"open" => true,
											"close" => true,
											"content" => array(
															"shortcode_id" => '',
															"text" => 'Content'
														),
											"parameters" => array(
									
																array(
																	"parameter_name" => 'icon',
																	"desc"=> 'Icon name',
																	"default_value" => '',
																),	

															),				
										),
							 
										/*
											Tabs
										*/				

										"tabs" => array(

											"name"=> __('Tabs','rt_theme_admin'),
											"desc"=> __('Holder shortcode for tabs.','rt_theme_admin'),
											"subline" => false,
											"id"=> 'tabs',
											"open" => true,
											"close" => true,
											"content" => array(
															"shortcode_id" => 'tab',
															"text" => ''
														),
											"parameters" => array(

																array(
																	"parameter_name" => 'tab{number}',
																	"desc"=> 'The tab name. Usage: tab1="" tab2="" tab3=""  ',
																	"default_value" => ''
																),

																array(
																	"parameter_name" => 'tab{number}-icon',
																	"desc"=> 'Icon name for the tab. Usage: tab1-icon="" tab2-icon="" tab3-icon=""  ',
																	"default_value" => ''
																),

																array(
																	"parameter_name" => 'tabs_style',
																	"desc"=> 'Style.',
																	"default_value" => 'tab-style-one',
																	"possible_values" => array(
																							"tab-style-one" => __('Default tab style','rt_theme_admin'),
																							"tab-style-two" => __('Second tab style','rt_theme_admin'),
																							"tab-style-three" => __('Third tab style','rt_theme_admin'),
																							"vertical_tabs" => __('Vertical Tabs','rt_theme_admin'),
																						),										
																), 

															),
										),

										/*
											tab content
										*/			
										"tab" => array(

											"name"=> __('Tab','rt_theme_admin'),
											"desc"=> __('The tab content.','rt_theme_admin'),
											"subline" => true,
											"id"=> 'tab',
											"open" => true,
											"close" => true,
											"content" => array(
															"shortcode_id" => '',
															"text" => 'Content'
														)
										),


										/*
											Accordions
										*/						

										"accordion" => array(

											"name"=> __('Accordion','rt_theme_admin'),
											"desc"=> __('Holder shortcode for accordions.','rt_theme_admin'),
											"subline" => false,
											"id"=> 'tabs',
											"open" => true,
											"close" => true,
											"content" => array(
															"shortcode_id" => 'pane',
															"text" => ''
														),
											"parameters" => array(

																array(
																	"parameter_name" => 'style',
																	"desc"=> 'Style',
																	"default_value" => 'numbered',
																	"possible_values" => array(
																							"numbered" => "Numbered",
																							"icons" => "With Icons",
																							"only_captions" => "Captions Only"
																						),										
																),

																array(
																	"parameter_name" => 'align',
																	"desc"=> __('Alignment','rt_theme_admin'),
																	"default_value" => '',
																	"possible_values" => array(
																							"left" => __('Left Aligned','rt_theme_admin'),
																							"right" => __('Right Aligned','rt_theme_admin'),
																							"full" => __('Full Width','rt_theme_admin'),
																						),
																),

																array(
																	"parameter_name" => 'first_one_open',
																	"desc"=> __('First one open','rt_theme_admin'),
																	"default_value" => 'false',
																	"possible_values" => array(
																							"true" => __('True','rt_theme_admin'),
																							"false" => __('False','rt_theme_admin')
																						),										
																),									

															),
										),


										/*
											Accordion content
										*/			
										"pane" => array(
											"name"=> __('Pane','rt_theme_admin'),
											"desc"=> __('Adds another pane to the accordion content.','rt_theme_admin'),
											"subline" => true,
											"id"=> 'pane',
											"open" => true,
											"close" => true,
											"content" => array(
															"shortcode_id" => '',
															"text" => 'Content'
														),
											"parameters" => array(

																array(
																	"parameter_name" => 'title',
																	"desc"=> 'Title',
																	"default_value" => '',
																),

																array(
																	"parameter_name" => 'icon',
																	"desc"=> __('Icon name.','rt_theme_admin'),
																	"default_value" => '',
																),

															),				
										),


										/*
											Pricing Tables
										*/						

										"pricing_table" => array(

											"name"=> __('Pricing Table','rt_theme_admin'),
											"desc"=> __('Holder shortcode for pricing table.','rt_theme_admin'),
											"subline" => false,
											"id"=> 'pricing_table',
											"open" => true,
											"close" => true,
											"content" => array(
															"shortcode_id" => 'table_column',
															"text" => ''
														),
											"parameters" => array(

																array(
																	"parameter_name" => 'style',
																	"desc"=> 'Style',
																	"default_value" => 'service',
																	"possible_values" => array(
																							"service" => "Service",
																							"compare" => "Compare",
																						),										
																),
															),
										),


										/*
											Pricing Table Columns
										*/			
										"table_column" => array(
											"name"=> __('Table Column','rt_theme_admin'),
											"desc"=> __('Adds a column to the table. Use HTML ul lists to create cells.','rt_theme_admin'),
											"subline" => true,
											"id"=> 'pane',
											"open" => true,
											"close" => true,
											"content" => array(
															"shortcode_id" => '',
															"text" => ' <code>'.htmlentities("
															<ul>
																<li>....</li>
																<li>....</li>
																<li>....</li>
															</ul>
															") .'</code>'
														),

											"parameters" => array(

																array(
																	"parameter_name" => 'caption',
																	"desc"=> 'Caption',
																	"default_value" => '',
																),

																array(
																	"parameter_name" => 'price',
																	"desc"=> 'Price',
																	"default_value" => '',
																),

																array(
																	"parameter_name" => 'info',
																	"desc"=> 'Info text',
																	"default_value" => '',
																),

																array(
																	"parameter_name" => 'style',
																	"desc"=> __('Icon name.','rt_theme_admin'),
																	"default_value" => '',
																	"possible_values" => array(
																							""   => "Default",
																							"highlight"  => "Highlighted column",
																						),		


																),

															),				
										),


										/*
											Content Box With Featured Image
										*/			

										"content_box" => array(
											"name"=> __('Content Box With Featured Image','rt_theme_admin'),
											"desc"=> __('Creates a styled content box with an image','rt_theme_admin'),
											"subline" => false,
											"id"=> 'content_box',
											"open" => true,
											"close" => true,
											"content" => array(
															"shortcode_id" => '',
															"text" => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur euismod enim a metus adipiscing aliquam. Vestibulum in vestibulum lorem.</p>'
														),

											"parameters" => array(


																array(
																	"parameter_name" => 'id',
																	"desc"=> 'Unique id',
																	"default_value" => '',
																),

																array(
																	"parameter_name" => 'title',
																	"desc"=> 'Title',
																	"default_value" => '',
																),

																array(
																	"parameter_name" => 'title_position',
																	"desc"=> 'Image Style',
																	"default_value" => '',
																	"possible_values"   => array('embedded'=>'Embedded to the featured image','before'=>'Before Featured Image','after'=>'After Featured Image'),
																	
																),

																array(
																	"parameter_name" => 'image_style',
																	"desc"=> 'Featured Image Style',
																	"default_value" => '',
																	"possible_values"   => array(
																			'0'=>__('Square standart','rt_theme_admin'),
																			'1'=>__('Rounded with pin and b/w image effect','rt_theme_admin'),
																			'2'=>__('Rounded with pin without b/w image effect','rt_theme_admin'),
																			'3'=>__('Octange with b/w image effect','rt_theme_admin'),
																			'4'=>__('Octange without b/w image effect','rt_theme_admin'),
																			),											
																),

																array(
																	"parameter_name" => 'featured_image',
																	"desc"=> 'Featured image url ( a local image url ) ',
																	"default_value" => '',
																),

																array(
																	"parameter_name" => 'icon',
																	"desc"=> 'Icon',
																	"default_value" => '',
																),

																array(
																	"parameter_name" => 'icon_style',
																	"desc"=> 'Icon Style',
																	"default_value" => '',
																	"possible_values"   => array('0'=>'No Icon','1'=>'Small Icon','2'=>'Small icon with squared background'),	
																),

																array(
																	"parameter_name" => 'text_position',
																	"desc"=> 'Text position',
																	"default_value" => '',
																	"possible_values"   => array('1'=>'Left Aligned','2'=>'Centered'),	 
																),

																array(
																	"parameter_name" => 'link',
																	"desc"=> 'Link',
																	"default_value" => '',
																),

																array(
																	"parameter_name" => 'link_text',
																	"desc"=> 'Link Text',
																	"default_value" => '',
																),

																array(
																	"parameter_name" => 'link_target',
																	"desc"=> __('Link target','rt_theme_admin'),
																	"default_value" => '_self',			
																	"possible_values" => array(
																							'_self'=>__('Same Window','rt_theme_admin'),
																							'_blank'=>__('New Window','rt_theme_admin'),
																						),														
																),		 

															),				
										),

										/*
											Content Box With Icon
										*/			


										"content_icon_box" => array(
											"name"=> __('Content Box With Icon','rt_theme_admin'),
											"desc"=> __('Creates a styled content box with an icon','rt_theme_admin'),
											"subline" => false,
											"id"=> 'content_icon_box',
											"open" => true,
											"close" => true,
											"content" => array(
															"shortcode_id" => '',
															"text" => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur euismod enim a metus adipiscing aliquam. Vestibulum in vestibulum lorem.</p>'
														),

											"parameters" => array(


																array(
																	"parameter_name" => 'id',
																	"desc"=> 'Unique id',
																	"default_value" => '',
																),

																array(
																	"parameter_name" => 'title',
																	"desc"=> 'Title',
																	"default_value" => '',
																),

																array(
																	"parameter_name" => 'title_position',
																	"desc"=> 'Image Style',
																	"default_value" => '',
																	"possible_values"   => array(
																						'embedded'=>__('Right side of the icon','rt_theme_admin'),
																						'before'=>__('Before the icon','rt_theme_admin'),
																						'after'=>__('After the icon','rt_theme_admin'), 
																						),										
																),

																array(
																	"parameter_name" => 'icon',
																	"desc"=> 'Icon',
																	"default_value" => '',
																),

																array(
																	"parameter_name" => 'icon_style',
																	"desc"=> 'Icon Style',
																	"default_value" => '',
																	"possible_values"   => array('0'=>'No Icon','1'=>'Small Icon','2'=>'Small icon with squared background','3'=>'Big Icon','4'=>'Big Icon with squared background', '5'=>'Big Icon with rounded background', '6'=>'Big Icon with rounded border', '7'=>'Big Icon with rounded border and pin'),					
																),

																array(
																	"parameter_name" => 'text_position',
																	"desc"=> 'Text position',
																	"default_value" => '',
																	"possible_values"   => array('1'=>'Left Aligned','2'=>'Centered'),	 
																),

																array(
																	"parameter_name" => 'link',
																	"desc"=> 'Link',
																	"default_value" => '',
																),

																array(
																	"parameter_name" => 'link_text',
																	"desc"=> 'Link Text',
																	"default_value" => '',
																),

																array(
																	"parameter_name" => 'link_target',
																	"desc"=> __('Link target','rt_theme_admin'),
																	"default_value" => '_self',			
																	"possible_values" => array(
																							'_self'=>__('Same Window','rt_theme_admin'),
																							'_blank'=>__('New Window','rt_theme_admin'),
																						),														
																),		 


																array(
																	"parameter_name" => 'icon_color',
																	"desc"=> 'Icon color (optional)',
																	"default_value" => '',
																),

																array(
																	"parameter_name" => 'icon_bg_color',
																	"desc"=> 'Icon background color (optional)',
																	"default_value" => '',
																),

																array(
																	"parameter_name" => 'icon_border_color',
																	"desc"=> 'Icon border color (optional)',
																	"default_value" => '',
																),
																																		
															),				
										),
							 

										/*
											Vertical Chained Icon Boxes 
										*/						

										"v_icon_boxes" => array(

											"name"=> __('Vertical Chained Icon Boxes','rt_theme_admin'),
											"desc"=> __('Holder shortcode for the content group','rt_theme_admin'),
											"subline" => false,
											"id"=> 'v_icon_boxes',
											"open" => true,
											"close" => true,
											"content" => array(
															"shortcode_id" => 'v_icon_box',
															"text" => ''
														),
											"parameters" => array(

																array(
																	"parameter_name" => 'id',
																	"desc"=> 'Unique id',
																	"default_value" => '',
																),

																array(
																	"parameter_name" => 'icon_align',
																	"desc"=> 'Icon align',
																	"default_value" => '',
																	"possible_values" => array(
																							"left" => __("Left","rt_theme_admin"),
																							"right" => __("Right","rt_theme_admin")
																							),
																),
							 
															),
										),


										/*
											Vertical Chained Icon Box
										*/			


										"v_icon_box" => array(

											"name"=> __('Box','rt_theme_admin'),
											"desc"=> __('Adds a box to the group.','rt_theme_admin'),
											"subline" => true,
											"id"=> 'v_icon_box',
											"open" => true,
											"close" => true,
											"content" => array(
															"shortcode_id" => '',
															"text" => 'Content'
														),
											"parameters" => array(
									
																array(
																	"parameter_name" => 'icon',
																	"desc"=> 'Icon name',
																	"default_value" => '',
																),	
									
																array(
																	"parameter_name" => 'title',
																	"desc"=> 'Title',
																	"default_value" => '',
																),	

																array(
																	"parameter_name" => 'link',
																	"desc"=> 'Link',
																	"default_value" => '',
																),										

																array(
																	"parameter_name" => 'link_target',
																	"desc"=> __('Link target','rt_theme_admin'),
																	"default_value" => '_self',			
																	"possible_values" => array(
																							'_self'=>__('Same Window','rt_theme_admin'),
																							'_blank'=>__('New Window','rt_theme_admin'),
																						),														
																),		
															),				
										),


										/*
											Vertical Chained Image Boxes 
										*/						

										"v_media_boxes" => array(

											"name"=> __('Vertical Chained Image Boxes','rt_theme_admin'),
											"desc"=> __('Holder shortcode for the content group','rt_theme_admin'),
											"subline" => false,
											"id"=> 'v_media_boxes',
											"open" => true,
											"close" => true,
											"content" => array(
															"shortcode_id" => 'v_media_box',
															"text" => ''
														),
											"parameters" => array(

																array(
																	"parameter_name" => 'id',
																	"desc"=> 'Unique id',
																	"default_value" => '',
																),

																array(
																	"parameter_name" => 'image_align',
																	"desc"=> 'Image align',
																	"default_value" => '',
																	"possible_values" => array(
																							"left" => __("Left","rt_theme_admin"),
																							"right" => __("Right","rt_theme_admin")
																							),
																),
							 
							 									array(
																	"parameter_name" => 'image_style',
																	"desc"=> 'Image style',
																	"default_value" => 'rounded_image',
																	"possible_values" => array(																
																							"rounded_image" => __("Rounded","rt_theme_admin"),
																							"octangle" => __("Octangle","rt_theme_admin"),
																							"square" => __("Square","rt_theme_admin"),
																							),
																),

							 									array(
																	"parameter_name" => 'bw_filter',
																	"desc"=> 'Grayscale filter',
																	"default_value" => 'false',
																	"possible_values" => array(																
																							"true" => __("Enabled","rt_theme_admin"),
																							"false" => __("Disabled","rt_theme_admin")
																							),
																),									

															),
										),


										/*
											Vertical Chained Image Box
										*/			


										"v_media_box" => array(

											"name"=> __('Box','rt_theme_admin'),
											"desc"=> __('Adds a box to the group.','rt_theme_admin'),
											"subline" => true,
											"id"=> 'v_media_box',
											"open" => true,
											"close" => true,
											"content" => array(
															"shortcode_id" => '',
															"text" => 'Content'
														),
											"parameters" => array(
									
																array(
																	"parameter_name" => 'image',
																	"desc"=> 'Image url (a local image file url)',
																	"default_value" => '',
																),	
									
																array(
																	"parameter_name" => 'title',
																	"desc"=> 'Title',
																	"default_value" => '',
																),	

																array(
																	"parameter_name" => 'link',
																	"desc"=> 'Link',
																	"default_value" => '',
																),										

																array(
																	"parameter_name" => 'link_target',
																	"desc"=> __('Link target','rt_theme_admin'),
																	"default_value" => '_self',			
																	"possible_values" => array(
																							'_self'=>__('Same Window','rt_theme_admin'),
																							'_blank'=>__('New Window','rt_theme_admin'),
																						),														
																),		
															),				
										),


										/*
											Horizontal Chained Image Boxes 
										*/						

										"h_chained_contents" => array(

											"name"=> __('Horizontal Chained Image Boxes ','rt_theme_admin'),
											"desc"=> __('Holder shortcode for the content group','rt_theme_admin'),
											"subline" => false,
											"id"=> 'h_chained_contents',
											"open" => true,
											"close" => true,
											"content" => array(
															"shortcode_id" => 'h_content',
															"text" => ''
														),
											"parameters" => array(

																array(
																	"parameter_name" => 'id',
																	"desc"=> 'Unique id',
																	"default_value" => '',
																),
							 
							 									array(
																	"parameter_name" => 'image_style',
																	"desc"=> 'Image style',
																	"default_value" => 'rounded_image',
																	"possible_values" => array(																
																							"rounded_image" => __("Rounded","rt_theme_admin"),
																							"octangle" => __("Octangle","rt_theme_admin"),
																							"square" => __("Square","rt_theme_admin"),
																							),
																),

							 									array(
																	"parameter_name" => 'bw_filter',
																	"desc"=> 'Grayscale filter',
																	"default_value" => 'false',
																	"possible_values" => array(																
																							"true" => __("Enabled","rt_theme_admin"),
																							"false" => __("Disabled","rt_theme_admin")
																							),
																),

															),
										),


										/*
											Horizontal Chained Image Box
										*/			


										"h_content" => array(

											"name"=> __('Box','rt_theme_admin'),
											"desc"=> __('Adds a box to the group.','rt_theme_admin'),
											"subline" => true,
											"id"=> 'h_content',
											"open" => true,
											"close" => true,
											"content" => array(
															"shortcode_id" => '',
															"text" => 'Content'
														),
											"parameters" => array(
									
																array(
																	"parameter_name" => 'image',
																	"desc"=> 'Image url (a local image file url)',
																	"default_value" => '',
																),	
									
																array(
																	"parameter_name" => 'title',
																	"desc"=> 'Title',
																	"default_value" => '',
																),	

																array(
																	"parameter_name" => 'link',
																	"desc"=> 'Link',
																	"default_value" => '',
																),										

																array(
																	"parameter_name" => 'link_target',
																	"desc"=> __('Link target','rt_theme_admin'),
																	"default_value" => '_self',			
																	"possible_values" => array(
																							'_self'=>__('Same Window','rt_theme_admin'),
																							'_blank'=>__('New Window','rt_theme_admin'),
																						),														
																),		
															),				
										),


								/*
									Elements
								*/
								"group-5" => array(
									"group_name"=> __('Elements','rt_theme_admin'),
									"group_icon"=> "icon-code-1",
								),


										/*
											Contact Form
										*/			
										"contact_form" => array(
											"name"=> __('Contact Form','rt_theme_admin'),
											"subline" => '',
											"id"=> 'contact_form',
											"desc"=> __('Calls the contact form','rt_theme_admin'),
											"open" => true,
											"close" => true,	
											"content" => array(
															"shortcode_id" => '',
															"text" => 'Contact form description text'
														),					
											"parameters" => array(
																array(
																	"parameter_name" => 'email',
																	"desc"=> __('The contact form will be submited to this email.','rt_theme_admin'),
																	"default_value" => '', 
																),
																array(
																	"parameter_name" => 'title',
																	"desc"=> __('Title','rt_theme_admin'),
																	"default_value" => '', 
																),																		
															),
										),


										/*
											Horizontal Line
										*/			
										"horizontal_line" => array(

											"name"=> __('Horizontal Line','rt_theme_admin'),
											"desc"=> __('Horizontal line shortcode','rt_theme_admin'),
											"subline" => false,
											"open" => true,
											"close" => false, 					
											"parameters" => array(
																array(
																	"parameter_name" => 'style',
																	"desc"=> __('Style','rt_theme_admin'),
																	"default_value" => '1',
																	"possible_values" => array(
																							"1" => __('Style 1','rt_theme_admin'),
																							"2" => __('Style 2','rt_theme_admin'),
																							"3" => __('Style 3','rt_theme_admin'),
																							"4" => __('Style 4','rt_theme_admin'),	
																							"5" => __('Style 5','rt_theme_admin'),	
																							"6" => __('Style 6','rt_theme_admin'),	
																							"7" => __('Style 7','rt_theme_admin'),	
																							"8" => __('Style 8','rt_theme_admin'),																
																						),
																),

																array(
																	"parameter_name" => 'margin_top',
																	"desc"=> __('Margin Top','rt_theme_admin'),
																	"default_value" => '0',
																	"possible_values" => array(
																							"0" => __('no margin','rt_theme_admin'),
																							"5" => __('5px','rt_theme_admin'),
																							"10" => __('10px','rt_theme_admin'),
																							"15" => __('15px','rt_theme_admin'),
																							"20" => __('20px','rt_theme_admin'),																
																							"30" => __('30px','rt_theme_admin'),																
																							"40" => __('40px','rt_theme_admin'),
																							"50" => __('50px','rt_theme_admin'),
																							"60" => __('60px','rt_theme_admin'),
																							"70" => __('70px','rt_theme_admin'),																
																							"80" => __('80px','rt_theme_admin'), 										
																						),
																),							

																array(
																	"parameter_name" => 'margin_bottom',
																	"desc"=> __('Margin Bottom','rt_theme_admin'),
																	"default_value" => '0',
																	"possible_values" => array(
																							"0" => __('no margin','rt_theme_admin'),
																							"5" => __('5px','rt_theme_admin'),
																							"10" => __('10px','rt_theme_admin'),
																							"15" => __('15px','rt_theme_admin'),
																							"20" => __('20px','rt_theme_admin'),																
																							"30" => __('30px','rt_theme_admin'),																
																							"40" => __('40px','rt_theme_admin'),
																							"50" => __('50px','rt_theme_admin'),
																							"60" => __('60px','rt_theme_admin'),
																							"70" => __('70px','rt_theme_admin'),																
																							"80" => __('80px','rt_theme_admin'), 										
																						),
																),							

															),
										),

										/*
											Pullquote
										*/			
										"pullquote" => array(

											"name"=> __('Pullquote','rt_theme_admin'),
											"desc"=> __('Pullquote shortcode','rt_theme_admin'),
											"subline" => false,
											"open" => true,
											"close" => true, 					
											"parameters" => array(
																array(
																	"parameter_name" => 'align',
																	"desc"=> __('Alignment','rt_theme_admin'),
																	"default_value" => 'left',
																	"possible_values" => array(
																							"left" => __('Left ','rt_theme_admin'),
																							"Right" => __('Right','rt_theme_admin'), 														
																						),
																),
															),
										),

										/*
											Google maps
										*/						

										"google_maps" => array(

											"name"=> __('Google Maps','rt_theme_admin'),
											"desc"=> __('Holder shortcode for google maps.','rt_theme_admin'),
											"subline" => false,
											"id"=> 'google_maps',
											"open" => true,
											"close" => true,
											"content" => array(
															"shortcode_id" => 'location',
															"text" => ''
														),
											"parameters" => array(

																array(
																	"parameter_name" => 'height',
																	"desc"=> 'Height of the map.',
																	"default_value" => '', 
																),

																array(
																	"parameter_name" => 'zoom',
																	"desc"=> 'Zoom level. Works only with single map location.',
																	"default_value" => '3', 
																),									

															),
										),

										/*
											Map Locations
										*/			
										"location" => array(

											"name"=> __('Map Location','rt_theme_admin'),
											"desc"=> __('Adds locations to the map.','rt_theme_admin'),
											"subline" => true,
											"id"=> 'location',
											"open" => true,
											"close" => true,
											"content" => array(
															"shortcode_id" => '',
															"text" => 'Location description'
														),
											"parameters" => array(
									
																array(
																	"parameter_name" => 'title',
																	"desc"=> 'Location name',
																	"default_value" => '',
																),						
																array(
																	"parameter_name" => 'lat',
																	"desc"=> 'Latitude',
																	"default_value" => '',
																),
																array(
																	"parameter_name" => 'lon',
																	"desc"=> 'Longitude',
																	"default_value" => '',
																),
															),				
										),

										/*
											Social Media Icons
										*/						
										"rt_social_media_icons" => array(

											"name"=> __('Social Media Icons','rt_theme_admin'),
											"desc"=> __('Displays the social media icons list that created by using <a href="?page=rt_social_options">Social Media Options</a> of the theme.','rt_theme_admin'),
											"subline" => false,
											"id"=> 'rt_social_media_icons',
											"open" => true,
											"close" => false,
											"content" => array(
															"shortcode_id" => '',
															"text" => ''
														)
										),


										/*
											Icons
										*/						

										"icon" => array(

											"name"=> __('Icons','rt_theme_admin'),
											"desc"=> __('Displays an icon. Click the "<span class="icon-rocket"></span>Icons" link top of the page to find an icon name. ','rt_theme_admin'),
											"subline" => false,
											"id"=> 'icon',
											"open" => true,
											"close" => false,
											"content" => array(
															"shortcode_id" => '',
															"text" => ''
														),
											"parameters" => array(

																array(
																	"parameter_name" => 'name',
																	"desc"=> 'Icon Name',
																	"default_value" => '',
																),

															),								

										),


										/*
											ToolTips
										*/						

										"tooltip" => array( 

											"name"=> __('ToolTips','rt_theme_admin'),
											"desc"=> __('Displays a tooltip text when hover the item that inside the brackets.','rt_theme_admin'),
											"subline" => false,
											"id"=> 'tooltip',
											"open" => true,
											"close" => true,
											"content" => array(
															"shortcode_id" => '',
															"text" => ''
														),
											"parameters" => array(

																array(
																	"parameter_name" => 'text',
																	"desc"=> 'ToolTip Text',
																	"default_value" => '',
																),

																array(
																	"parameter_name" => 'link',
																	"desc"=> 'Link (url)',
																	"default_value" => '',
																),

																array(
																	"parameter_name" => 'target',
																	"desc"=> __('Link Target','rt_theme_admin'),
																	"default_value" => '',
																	"possible_values" => array(
																							"_self" => __('Same Window','rt_theme_admin'),
																							"_blank" => __('New Window','rt_theme_admin'),
																						),
																),	

																array(
																	"parameter_name" => 'color',
																	"desc"=> __('ToolTip background color','rt_theme_admin'),
																	"default_value" => 'black',
																	"possible_values" => array(
																							"black" => __('Black','rt_theme_admin'),
																							"white" => __('White','rt_theme_admin'),
																							"yellow" => __('Yellow','rt_theme_admin'),
																							"green" => __('Green','rt_theme_admin'),
																							"blue" => __('Blue','rt_theme_admin'),
																						),
																),	

															),								

										),


										/*
											Info Box
										*/						

										"info_box" => array( 

											"name"=> __('Info Box','rt_theme_admin'),
											"desc"=> __('Creates an info box','rt_theme_admin'),
											"subline" => false,
											"id"=> 'info_box',
											"open" => true,
											"close" => true,
											"content" => array(
															"shortcode_id" => '',
															"text" => 'Content text'
														),
											"parameters" => array( 

																array(
																	"parameter_name" => 'style',
																	"desc"=> __('Box style','rt_theme_admin'),
																	"default_value" => 'info',
																	"possible_values" => array(
																							"info" => __('Info','rt_theme_admin'),
																							"announcement" => __('Announcement','rt_theme_admin'),
																							"ok" => __('OK','rt_theme_admin'),
																							"attention" => __('Attention','rt_theme_admin'),
																						),
																),	

															),								

										),


										/*
											Buttons
										*/			

										"button" => array(
											"name"=> __('Button','rt_theme_admin'),
											"desc"=> __('Creates button.','rt_theme_admin'),
											"subline" => false,
											"id"=> 'button',
											"open" => true,
											"close" => false,
											"content" => array(
															"shortcode_id" => '',
															"text" => ''
														),
											"parameters" => array(

																array(
																	"parameter_name" => 'id',
																	"desc"=> 'Button unique id',
																	"default_value" => '',
																),

																array(
																	"parameter_name" => 'button_text',
																	"desc"=> __('Button text','rt_theme_admin'),
																	"default_value" => '',							
																),							

																array(
																	"parameter_name" => 'button_link',
																	"desc"=> __('Button link','rt_theme_admin'),
																	"default_value" => '',							
																),							

																array(
																	"parameter_name" => 'link_open',
																	"desc"=> __('Button link','rt_theme_admin'),
																	"default_value" => '_self',			
																	"possible_values" => array(
																							'_self'=>__('Same Window','rt_theme_admin'),
																							'_blank'=>__('New Window','rt_theme_admin'),
																						),														
																),			

																array(
																	"parameter_name" => 'button_icon',
																	"desc"=> __('Button icon name','rt_theme_admin'),
																	"default_value" => '',							
																),							

																array(
																	"parameter_name" => 'button_align',
																	"desc"=> __('Alignment','rt_theme_admin'),
																	"default_value" => '',
																	"possible_values" => array(
																							"left" => __('Left Aligned','rt_theme_admin'),
																							"right" => __('Right Aligned','rt_theme_admin'),
																							"center" => __('Center Aligned','rt_theme_admin'),
																							"" => __('No alignment','rt_theme_admin'),
																						),
																),
										
																array(
																	"parameter_name" => 'button_size',
																	"desc"=> __('Button size','rt_theme_admin'),
																	"default_value" => 'small',
																	"possible_values" => array(
																							"small"   => "Small",
																							"medium"  => "Medium",
																							"big"     => "Big", 
																						),										
																),		


																array(
																	"parameter_name" => 'button_style',
																	"desc"=> __('Button style','rt_theme_admin'),
																	"default_value" => 'default',
																	"possible_values" => array(
																							"default"=> "Default",
																							"light"  => "Light",
																							"white"  => "White", 
																							"t_white"  => "Transparent White", 
																						),										
																),		

																array(
																	"parameter_name" => 'margin_top',
																	"desc"=> __('( Number ) Adds top margin to the button.','rt_theme_admin'),
																	"default_value" => '0 ',
																	"possible_values" => array(
																							"10"   => "10 pixels",
																							"20"  => "20 pixels",
																						),												
																),		


																array(
																	"parameter_name" => 'href_title',
																	"desc"=> __('HTML title attribute for the anchor link.','rt_theme_admin'),
																	"default_value" => '',
																),		

															),				
										),


										/*
											Banners
										*/			

										"banner" => array(
											"name"=> __('Banner','rt_theme_admin'),
											"desc"=> __('Creates banners.','rt_theme_admin'),
											"subline" => false,
											"id"=> 'banner_box',
											"open" => true,
											"close" => true,
											"content" => array(
															"shortcode_id" => '',
															"text" => 'Banner Text'
														),
											"parameters" => array(

																array(
																	"parameter_name" => 'id',
																	"desc"=> 'Banner unique id',
																	"default_value" => '',
																),
																array(
																	"parameter_name" => 'text_icon',
																	"desc"=> 'Icon for text',
																	"default_value" => '',
																), 

																array(
																	"parameter_name" => 'text_alignment',
																	"desc"=> 'Alignment of the banner text',
																	"default_value" => 'left',
																	"possible_values" => array(
																							"left" => __('Left aligned','rt_theme_admin'),
																							"center" => __('Center aligned','rt_theme_admin'),
																						),		
																),	

																array(
																	"parameter_name" => 'border',
																	"desc"=> 'Adds border around banner',
																	"default_value" => 'false',
																	"possible_values" => array(
																							"true" => __('True','rt_theme_admin'),
																							"false" => __('False','rt_theme_admin'),
																						),										
																), 	

																array(
																	"parameter_name" => 'gradient',
																	"desc"=> 'Adds gradient effect',
																	"default_value" => 'false',
																	"possible_values" => array(
																							"true" => __('True','rt_theme_admin'),
																							"false" => __('False','rt_theme_admin'),
																						),										
																), 	

																array(
																	"parameter_name" => 'button_text',
																	"desc"=> __('Button text','rt_theme_admin'),
																	"default_value" => '',							
																),							

																array(
																	"parameter_name" => 'button_link',
																	"desc"=> __('Button link','rt_theme_admin'),
																	"default_value" => '',							
																),							

																array(
																	"parameter_name" => 'link_target',
																	"desc"=> __('Button link target','rt_theme_admin'),
																	"default_value" => '_self',			
																	"possible_values" => array(
																							'_self'=>__('Same Window','rt_theme_admin'),
																							'_blank'=>__('New Window','rt_theme_admin'),
																						),														
																),			

																array(
																	"parameter_name" => 'button_icon',
																	"desc"=> __('Button icon name','rt_theme_admin'),
																	"default_value" => '',							
																),							
							 
										
																array(
																	"parameter_name" => 'button_size',
																	"desc"=> __('Button size','rt_theme_admin'),
																	"default_value" => 'small',
																	"possible_values" => array(
																							"small"   => "Small",
																							"medium"  => "Medium",
																							"big"     => "Big", 
																						),										
																),		 
															

															),				
										),


										/*
											Heading Bar
										*/			

										"heading_bar" => array(
											"name"=> __('Heading Bar','rt_theme_admin'),
											"desc"=> __('Creates styled heading bar','rt_theme_admin'),
											"subline" => false,
											"id"=> 'heading_bar',
											"open" => true,
											"close" => false,
											"content" => array(
															"shortcode_id" => '',
															"text" => ''
														),
											"parameters" => array(

																array(
																	"parameter_name" => 'heading',
																	"desc"=> 'Heading',
																	"default_value" => '',
																),
																array(
																	"parameter_name" => 'icon',
																	"desc"=> 'Icon',
																	"default_value" => '',
																), 

																array(
																	"parameter_name" => 'style',
																	"desc"=> __('Style','rt_theme_admin'),
																	"default_value" => '',			
																	"possible_values" => array(
																							''=>__('Style one','rt_theme_admin'),
																							'style-2'=>__('Style two','rt_theme_admin'),
																						),														
																),		
															),				
										),

										/*
											Sidebar Box
										*/			
										"sidebar_box" => array(
											"name"=> __('Sidebar Box','rt_theme_admin'),
											"subline" => '',
											"id"=> 'sidebar_box',
											"desc"=> __('Calls a sidebar location.','rt_theme_admin'),
											"open" => true,
											"close" => false,	
											"content" => array(
															"shortcode_id" => '',
															"text" => ''
														),					
											"parameters" => array(
																array(
																	"parameter_name" => 'sidebar_id',
																	"desc"=> __('Go to Theme Options -> Sidebar Creator to find the sidebar id (slug).','rt_theme_admin'),
																	"default_value" => '', 
																),
																array(
																	"parameter_name" => 'widget_box_width',
																	"desc"=> __('Column layout for the widgets of the sidebar.','rt_theme_admin'),
																	"default_value" => '4', 
																	"possible_values" => array(
																							"1" => __('1:1 Full-Width Column','rt_theme_admin'),
																							"2" => __('1:2 Column','rt_theme_admin'),
																							"3" => __('1:3 Column','rt_theme_admin'),
																							"4" => __('1:4 Column','rt_theme_admin'),																
																							"5" => __('1:5 Column','rt_theme_admin'),																
																						),
																),									
															),
										),



										/*
											Space
										*/			
										"space_box" => array(
											"name"=> __('Space','rt_theme_admin'),
											"subline" => '',
											"id"=> 'space_box',
											"desc"=> __('Puts a space.','rt_theme_admin'),
											"open" => true,
											"close" => false,	
											"content" => array(
															"shortcode_id" => '',
															"text" => ''
														),					
											"parameters" => array(
																array(
																	"parameter_name" => 'id',
																	"desc"=> __('unique id','rt_theme_admin'),
																	"default_value" => '', 
																),
																array(
																	"parameter_name" => 'height',
																	"desc"=> __('Height value (do not include px, number only)','rt_theme_admin'),
																	"default_value" => ''
																),									
															),
										),
		);

		//example shortcodes
		$this->shortcode_examples = array(
 
			 
			/*
				Columns
			*/			
			"columns" => array(
				__('Two Columns Example','rt_theme_admin') => '
				[columns]
					
					[column layout="two"]
						Lorem ipsum dolor sit amet, consectetuer adipiscing elit.
					[/column]

					[column layout="two"]
						Lorem ipsum dolor sit amet, consectetuer adipiscing elit.
					[/column]

				[/columns]
				',

				__('Three Columns Example','rt_theme_admin') => '
				[columns]

					[column layout="three"]
						Lorem ipsum dolor sit amet, consectetuer adipiscing elit.
					[/column]					

					[column layout="three"]
						Lorem ipsum dolor sit amet, consectetuer adipiscing elit.
					[/column]

					[column layout="three"]
						Lorem ipsum dolor sit amet, consectetuer adipiscing elit. 
					[/column]

				[/columns]
				',				

				),

			/*
				Columns
			*/			
			"pricing_table" => array(
				__('Pricing Table Example','rt_theme_admin') => '
				[pricing_table style="service"]
				[table_column caption="BASIC PACKAGE" price="$19" info="yearly plan"]
				<ul>
					<li>[tooltip text="Tooltip Text"]Description With Tooltip[/tooltip]</li>
					<li>10 MB Max File Size</li>
					<li>1 GHZ CPU</li>
					<li>256 MB Memory</li>
					<li>[button button_link="#" button_text="BUY NOW" button_size="medium" button_icon="icon-basket"]</li>
				</ul>
				[/table_column]

				[table_column caption="PRO PACKAGE" price="49$" info="yearly plan" style="highlight"]
				<ul>
					<li>[tooltip text="Tooltip Text"]Description With Tooltip[/tooltip]</li>
					<li>20 MB Max File Size</li>
					<li>2 GHZ CPU</li>
					<li>512 MB Memory</li>
					<li>[button button_link="#" button_text="BUY NOW" button_size="medium" button_icon="icon-basket"]</li>
				</ul>
				[/table_column]

				[table_column caption="DEVELOPER PACKAGE" price="$109" info="monthly plan"]
				<ul>
					<li>[tooltip text="Tooltip Text"]Description With Tooltip[/tooltip]</li>
					<li>200 MB Max File Size</li>
					<li>3 GHZ CPU</li>
					<li>1000 MB Memory</li>
					<li>[button button_link="#" button_text="BUY NOW" button_size="medium" button_icon="icon-basket"]</li>
				</ul>
				[/table_column]
				[/pricing_table]
				',				

				__('Compare Table Example','rt_theme_admin') => '
				[pricing_table style="compare"]
				[table_column style="features"]
				<ul>
					<li>Use Tooltips</li>
					<li>Use Icons</li>
					<li>CPU</li>
					<li>Memory</li>
				</ul>
				[/table_column]

				[table_column caption="BASIC PACKAGE" price="$19" info="yearly plan"]
				<ul>
					<li>[tooltip text="Tooltip Text"][icon name="icon-info-circled"][/tooltip]</li>
					<li>[icon name="icon-cancel"]</li>
					<li>[icon name="icon-cancel"]</li>
					<li>256 MB Memory</li>
					<li>[button button_link="#" button_text="BUY NOW" button_size="small" button_icon="icon-basket"]</li>
				</ul>
				[/table_column]

				[table_column caption="START PACKAGE" price="49$" info="yearly plan" style="highlight"]
				<ul>
					<li>[tooltip text="Tooltip Text"][icon name="icon-info-circled"][/tooltip]</li>
					<li>[icon name="icon-ok"]</li>
					<li>[icon name="icon-ok"]</li>
					<li>512 MB Memory</li>
					<li>[button button_link="#" button_text="BUY NOW" button_size="small" button_icon="icon-basket"]</li>
				</ul>
				[/table_column]

				[table_column caption="PRO PACKAGE" price="109$" info="monthly plan"]
				<ul>
					<li>[tooltip text="Tooltip Text"][icon name="icon-info-circled"][/tooltip]</li>
					<li>[icon name="icon-ok"]</li>
					<li>[icon name="icon-ok"]</li>
					<li>1000 MB Memory</li>
					<li>[button button_link="#" button_text="BUY NOW" button_size="small" button_icon="icon-basket"]</li>
				</ul>
				[/table_column]
				[/pricing_table]
				',				
				),



			/*
				Photo Gallery
			*/			
			"photo_gallery" => array(
				__('Example 1','rt_theme_admin') => '
				[photo_gallery item_width="5"]
					[image title="" caption="" thumb_width="135" thumb_height="135" lightbox="true" custom_link="" open_in_new_tab=""]http://local-image-url[/image]
					[image title="" caption="" thumb_width="135" thumb_height="135" lightbox="true" custom_link="" open_in_new_tab=""]http://local-image-url[/image]
					[image title="" caption="" thumb_width="135" thumb_height="135" lightbox="true" custom_link="" open_in_new_tab=""]http://local-image-url[/image]
				[/photo_gallery]			 
				',				

				),

			/*
				Photo slider
			*/			
			"slider" => array(
				__('Example 1','rt_theme_admin') => '
				[slider slider_height="400" image_resize="true" image_crop="true" flex_slider_effect="slide" slider_timeout="4"]
					[slide title="Slide Title" img_url="http://local-image-url" link=""]Slide Text[/slide]
					[slide title="Slide Title" img_url="http://local-image-url" link=""]Slide Text[/slide]
					[slide title="Slide Title" img_url="http://local-image-url" link=""]Slide Text[/slide]
				[/slider]
				',				

				),			


			/*
				Google Maps
			*/			
			"google_maps" => array(
				__('Example With 3 Locations','rt_theme_admin') => '
				[google_maps height="300"]
					[location title="Eifel Tower" lat="48.8582285" lon="2.2943877000000157"]Location description for Eifel Tower[/location]
					[location title="Big Ben" lat="51.5007046" lon="-0.12457480000000487"]Location description for Big Ben[/location]
					[location title="Leaning Tower of Pisa" lat="43.722952" lon="10.396596999999929"]Location description for Pisa Tower[/location]
				[/google_maps]
				',				

				),			

			/*
				Icon List
			*/			
			"icon_list" => array(
				__('Example With 3 lines','rt_theme_admin') => '
				[icon_list icon_style="default" font_size="default_size" item_width="1"]
					[icon_list_line icon="icon-star-1"]Lorem ipsum dolor sit amet, consectetuer adipiscing elit. [/icon_list_line]
					[icon_list_line icon="icon-star-empty-1"]Lorem ipsum dolor sit amet, consectetuer adipiscing elit. [/icon_list_line]
					[icon_list_line icon="icon-heart-1"]Lorem ipsum dolor sit amet, consectetuer adipiscing elit. [/icon_list_line]
				[/icon_list]
				',				

				),			

			/*
				Tabs
			*/			
			"tabs" => array(
				__('Example With 3 tabs','rt_theme_admin') => '
				[tabs tab1="Settings" tab1_icon="icon-cog" tab2="Calendar" tab2_icon="icon-calendar" tab3="Locations" tab3_icon="icon-direction"]

					[tab]
					Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.
					[/tab]

					[tab]
					Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.
					[/tab]

					[tab]
					Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.
					[/tab]

				[/tabs]
				',				

				__('Vertical Tabs Example','rt_theme_admin') => '
				[tabs tabs_style="vertical_tabs" tab1="Settings" tab1_icon="icon-cog" tab2="Calendar" tab2_icon="icon-calendar" tab3="Locations" tab3_icon="icon-direction"]

					[tab]
					Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.
					[/tab]

					[tab]
					Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.
					[/tab]

					[tab]
					Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.
					[/tab]

				[/tabs]
				',

				),		

 
			/*
				Accordions
			*/			
			"accordion" => array(
				__('Example With 3 panes','rt_theme_admin') => '

				[accordion style="icons" align="full"]

					[pane title="Pane 1 Title" icon="icon-home"]
					Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.
					[/pane]

					[pane title="Pane 2 Title" icon="icon-pin"]
					Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.
					[/pane]

					[pane title="Pane 3 Title" icon="icon-ok"]
					Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.
					[/pane]

				[/accordion]
				',				

				),		
			

			/*
				pullquote
			*/			
			"pullquote" => array(
				__('Example','rt_theme_admin') => '

				[pullquote align="left"]
					<p>
					Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.
					</p>
				[/pullquote]
				',				

				),		


			/*
				video_embed
			*/			
			"video_embed" => array(
				__('Example','rt_theme_admin') => '[video_embed url="http://www.youtube.com/watch?v=utUPth77L_o"]',				
				
				),		

			/*
				v_icon_boxes
			*/			
			"v_icon_boxes" => array(
				__('Example','rt_theme_admin') => '
				[v_icon_boxes id="" icon_align="left"]

					[v_icon_box icon="icon-rocket" title="Content Title" link="#" link_target="_self"]<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur euismod enim a metus adipiscing aliquam. Vestibulum in vestibulum lorem.</p>[/v_icon_box]

					[v_icon_box icon="icon-magic" title="Content Title" link="#" link_target="_self"]<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur euismod enim a metus adipiscing aliquam. Vestibulum in vestibulum lorem.</p>[/v_icon_box]

					[v_icon_box icon="icon-suitcase" title="Content Title" link="#" link_target="_self"]<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur euismod enim a metus adipiscing aliquam. Vestibulum in vestibulum lorem.</p>[/v_icon_box]

				[/v_icon_boxes]
				',				
				
				),		
 

 			/*
				v_media_boxes
			*/			
			"v_media_boxes" => array(
				__('Example','rt_theme_admin') => '
				[v_media_boxes id="" image_align="left" image_style="rounded_image" bw_filter="true"]

					[v_media_box image="http://local-image-url" title="Content Title" link="#" link_target="_self"]<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur euismod enim a metus adipiscing aliquam. Vestibulum in vestibulum lorem.</p>[/v_media_box]

					[v_media_box image="http://local-image-url" title="Content Title" link="#" link_target="_self"]<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur euismod enim a metus adipiscing aliquam. Vestibulum in vestibulum lorem.</p>[/v_media_box]

					[v_media_box image="http://local-image-url" title="Content Title" link="#" link_target="_self"]<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur euismod enim a metus adipiscing aliquam. Vestibulum in vestibulum lorem.</p>[/v_media_box]

				[/v_media_boxes]
				',				
				
				),		

 			/*
				h_chained_contents
			*/			
			"h_chained_contents" => array(
				__('Example','rt_theme_admin') => '
				[h_chained_contents id="" image_style="rounded_image" bw_filter="true"]

					[h_content image="http://local-image-url" title="Content Title" link="#" link_target="_self"]<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur euismod enim a metus adipiscing aliquam. Vestibulum in vestibulum lorem.</p>[/h_content]

					[h_content image="http://local-image-url" title="Content Title" link="#" link_target="_self"]<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur euismod enim a metus adipiscing aliquam. Vestibulum in vestibulum lorem.</p>[/h_content]

					[h_content image="http://local-image-url" title="Content Title" link="#" link_target="_self"]<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur euismod enim a metus adipiscing aliquam. Vestibulum in vestibulum lorem.</p>[/h_content]

				[/h_chained_contents]
				',				
				
				),	
		);

	} 



	#
	#	Shortcode Parameter Guide
	#
	
	private	function create_parameters( $parameters = array() ){
		
		$output = "";

		if( is_array( $parameters ) ){

			foreach ($parameters as $parameter ) {

				$option_list = $default_value = $possible_values = "";

				extract( $parameter );

				//parameter option list
				if( is_array( $possible_values ) ){

					foreach ($possible_values as $key => $value) {
						$option_list .=  '<span class="poptionname rt_clean_copy">'. $key .'</span>' . $value .'<br />' ;
					}

					$option_list = sprintf(' <li><span class="poptions">%1$s</span> %2$s  </li> ',  __('Options','rt_theme_admin'), $option_list );
				}

				//default value
				if( isset( $default_value ) && ! empty( $default_value ) ){

				$default_value = sprintf(' <li><span class="pdefault">%1$s</span> :  <span class="poptionname rt_clean_copy">%2$s</span>  </li> ',  __('Default Value','rt_theme_admin'), $default_value );
				}

				//paramater list
				$output .= sprintf('
									<li>
										
										<span class="pname">%1$s : </span>

											<ul>					
												<li><p class="pdesc"> %2$s </p></li>											
												%3$s
												%4$s
											</ul>

									</li>
								', 

								$parameter_name, $desc, $default_value, $option_list
							);
			}

		}

		if ( ! empty( $output ) ) {
			return '
				<h3><span class="icon-cog icon"></span>'. __('Parameters','rt_theme_admin') .'</h3>
				<ul class="parameters">'
					.$output.'
				</ul>';
		}

	}


	#
	#	Create Shortocde Format
	#
	
	private	function create_shortcode_format( $shortcode_id, $parameters ){
		
		$output = $parameters_output = "";

		//createa paramater format
		if( is_array( $parameters ) ){
			foreach ($parameters as $paramater ) {
				$parameters_output .= sprintf(' %1$s=""', $paramater["parameter_name"] ); 
			}
		}

		//the shortcode
		if( $this->shortcode_list[$shortcode_id]["close"] == false ){
			$output = sprintf('[%1$s%2$s]',$shortcode_id, $parameters_output);
		}else{
			$this->shortcode_list[$shortcode_id]["content"]["text"] = isset( $this->shortcode_list[$shortcode_id]["content"]["text"] ) ? $this->shortcode_list[$shortcode_id]["content"]["text"] : "";
			$output = sprintf('[%1$s%2$s]%3$s[/%1$s]',$shortcode_id, $parameters_output, $this->shortcode_list[$shortcode_id]["content"]["text"]);
		}
			
		return $output;

	}


	#
	#	Create Shortocde Example
	#
	
	private	function create_shortcode_example( $shortcode_id, $parameters ){
		
		$output = $parameters_output = "";

		//createa paramater format
		if( is_array( $parameters ) ){
			foreach ($parameters as $paramater ) {
				$paramater["default_value"] = isset( $paramater["default_value"] ) ? $paramater["default_value"] : "";
				$parameters_output .= sprintf(' %1$s="%2$s"', $paramater["parameter_name"], $paramater["default_value"] ); 
			}
		}

		//shortcode content
		if( $this->shortcode_list[$shortcode_id]["close"] == true ){

			$sub_shortcode_id = $this->shortcode_list[$shortcode_id]["content"]["shortcode_id"];

			if( ! empty( $sub_shortcode_id ) ) {
				$shorcode_content = $this->create_shortcode_example( $sub_shortcode_id, $this->shortcode_list[$sub_shortcode_id]["parameters"] ) ;
			}else{
				$shorcode_content = $this->shortcode_list[$shortcode_id]["content"]["text"];
			}

		}


		//the shortcode
		if( $this->shortcode_list[$shortcode_id]["close"] == false ){
			$output = sprintf('[%1$s%2$s]',$shortcode_id, $parameters_output);
		}else{
			$output = sprintf('[%1$s%2$s]%3$s[/%1$s]',$shortcode_id, $parameters_output, $shorcode_content);
		}
			
		return $output;

	}



	#
	#	Shortcode List & Helper Menu
	#
	
	public function create_shortcode_list() {   

		$this->create_shortcode_array();

		//create UI
		$output = $tab_names_output = $tab_contents_output = $group_id = $parameters = "";


		foreach ( $this->shortcode_list as $shortcode_id => $shortcode_arg  ) {		

			//group name 
			$group_name = isset( $shortcode_arg["group_name"] ) ? $shortcode_arg["group_name"] : "";

			//group id 
			$group_id = isset( $shortcode_arg["group_name"] ) ? $shortcode_id : $group_id;

			//the shortcode format
		 	$shortcode_arg["parameters"] = isset(  $shortcode_arg["parameters"] ) ?  $shortcode_arg["parameters"] : "";
			$the_shortcode_format = empty( $group_name) ? $this->create_shortcode_format( $shortcode_id, $shortcode_arg["parameters"] ) : "";

 
			if( ! isset( $shortcode_arg["subline"] ) || $shortcode_arg["subline"] == false ){
	 
				if( empty( $group_name ) ) {

						//create tab panels
						$tab_names_output .= sprintf('
								<li class="%3$s">	
									<a href="#shorcode-%2$s">
										%1$s
									</a>
								</li>
						', $shortcode_arg["name"], $shortcode_id, $group_id );				

						$this_tab_content = '';

						//this tab output format
						$this_tab_content_format = ' <h3><span class="icon-code-outline icon"></span> %1$s </h3> <p class="desc"> %2$s <span class="pformat">%5$s</span></p> %3$s %4$s ';

						//output for the main shortcode					
						$this_tab_content .= sprintf($this_tab_content_format, $shortcode_arg["name"], $shortcode_arg["desc"], $parameters, $this->create_parameters( $shortcode_arg["parameters"] ), htmlspecialchars($the_shortcode_format)  );				

						//sub shorcode 
						if( isset( $shortcode_arg["content"] ) ){
							if( ! empty( $shortcode_arg["content"]["shortcode_id"] ) ){
								$sub_shortcode_id = $shortcode_arg["content"]["shortcode_id"];			
								$sub_shortcode_parameters = isset(  $this->shortcode_list[$sub_shortcode_id]["parameters"] ) ? $this->shortcode_list[$sub_shortcode_id]["parameters"] : "";
								$the_sub_shortcode_format = $this->create_shortcode_format( $sub_shortcode_id, $sub_shortcode_parameters ) ;//the shortcode format
								$this_tab_content .= sprintf($this_tab_content_format, $this->shortcode_list[$sub_shortcode_id]["name"], $this->shortcode_list[$sub_shortcode_id]["desc"], $parameters, $this->create_parameters( $sub_shortcode_parameters ), $the_sub_shortcode_format );				

							}
						}			

						// shortcode example 
						$example_code = isset( $this->shortcode_examples[$shortcode_id] ) ? $this->shortcode_examples[$shortcode_id] : "" ;
						$example_code_output = "";

							if( ! empty( $example_code ) ){
								if( is_array( $example_code ) ){
									foreach ($example_code as $desc => $code) {			
										
										$code = preg_replace('/\t+/', '', $code);

										$example_code_output .= sprintf('
												<h3><span class="icon-info icon"></span> %1$s </h3>
												<textarea>%2$s</textarea>
												<input type="button" class="button insert_to_editor" value="insert to editor">
											', $desc, $code );
									}						
								}
							}else{						
								$example_code_output = sprintf('
									<h3><span class="icon-info icon"></span> %1$s </h3> <textarea>%2$s</textarea> <input type="button" class="button insert_to_editor"  value="insert to editor">', 
									__( 'Example', 'rt_theme_admin' ), $this->create_shortcode_example( $shortcode_id, $shortcode_arg["parameters"] ) );				
							}

						//add to the output
						$tab_contents_output .= sprintf('
								<div id="shorcode-%1$s" class="ui-tabs-panel">
									<table>
										<tr>
											<td>%2$s</td>
											<td>
												%3$s
											</td>
										</tr>
									</table>
								</div>
						', $shortcode_id, $this_tab_content,  $example_code_output);				

				}else{

					//group start
					$tab_names_output .= sprintf('
						<div class="group_name"><span class="%2$s icon"></span>%1$s</div>
					', $group_name, $shortcode_arg["group_icon"] );
 
				}
				
			}

		}


		$output  = sprintf( '

			<div id="rttheme_shortcode_helper" class="rt_modal">
				
				<div class="window_bar">
					<div class="title">'.  __( 'Theme Shortcodes', 'rt_theme_admin' ) .'</div>

					<div class="rt_modal_close rt_modal_control"><span class="icon-cancel"></span></div>
				</div>

				<div class="modal_content">

					<div class="rt_tabs vertical_tabs">
						<ul class="ui-tabs-nav">
							%1$s
						</ul>
						%2$s
					</div>

				</div>

			</div>
			', $tab_names_output, $tab_contents_output );
 
		echo $output;

	}

}

new rt_shortcode_helper;
?>