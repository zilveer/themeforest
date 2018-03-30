<?php
/**
 * Post/Page Content
 *
 * Element is in Beta and by default disabled. Todo: test with layerslider elements. currently throws error bc layerslider is only included if layerslider element is detected which is not the case with the post/page element
 */

if( !class_exists( 'woocommerce' ) )
{
	add_shortcode('av_productslider', 'avia_please_install_woo');
	return;
}


if ( !class_exists( 'avia_sc_productslider' )  && class_exists( 'woocommerce' ) )
{
	class avia_sc_productslider extends aviaShortcodeTemplate
	{

		/**
		 * Create the config array for the shortcode button
		 */
		function shortcode_insert_button()
		{
			$this->config['name']		= __('Product Slider', 'avia_framework' );
			$this->config['tab']		= __('Plugin Additions', 'avia_framework' );
			$this->config['icon']		= AviaBuilder::$path['imagesURL']."sc-postslider.png";
			$this->config['order']		= 30;
			$this->config['target']		= 'avia-target-insert';
			$this->config['shortcode'] 	= 'av_productslider';
			$this->config['tooltip'] 	= __('Display a Slideshow of Product Entries', 'avia_framework' );
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
                    "desc" 	=> __("The offset determines where the query begins pulling products. Useful if you want to remove a certain number of products because you already query them with another product slider. Attention: Use this option only if the product sorting of the product sliders match!", 'avia_framework' ),
                    "id" 	=> "offset",
                    "type" 	=> "select",
                    "std" 	=> "0",
                    "subtype" => AviaHtmlHelper::number_array(1,100,1, array(__('Deactivate offset','avia_framework')=>'0', __('Do not allow duplicate posts on the entire page (set offset automatically)', 'avia_framework' ) =>'no_duplicates'))),


				array(
						"name" 	=> __("Sorting Options", 'avia_framework' ),
						"desc" 	=> __("Here you can choose how to sort the products", 'avia_framework' ),
						"id" 	=> "sort",
						"type" 	=> "select",
						"std" 	=> "0",
						"no_first"=>true,
						"subtype" => array( /*__('Let user pick by displaying a dropdown with sort options (default value is defined at Woocommerce -> Settings -> Catalog)', 'avia_framework' )=>'dropdown', */
											__('Use defaut (defined at Woocommerce -> Settings -> Catalog) ', 'avia_framework' ) =>'0',
											__('Sort alphabetically', 'avia_framework' ) =>'title',
											__('Sort by most recent', 'avia_framework' ) =>'date',
											__('Sort by price', 'avia_framework' ) =>'price',
											__('Sort by popularity', 'avia_framework' ) =>'popularity')),

				array(
						"name" 	=> __("Autorotation active?",'avia_framework' ),
						"desc" 	=> __("Check if the slideshow should rotate by default",'avia_framework' ),
						"id" 	=> "autoplay",
						"type" 	=> "select",
						"std" 	=> "no",
						"subtype" => array(__('Yes','avia_framework' ) =>'yes',__('No','avia_framework' ) =>'no')),

				array(
					"name" 	=> __("Slideshow autorotation duration",'avia_framework' ),
					"desc" 	=> __("Slideshow will rotate every X seconds",'avia_framework' ),
					"id" 	=> "interval",
					"type" 	=> "select",
					"std" 	=> "5",
					"required" 	=> array('autoplay','equals','yes'),
					"subtype" =>
					array('3'=>'3','4'=>'4','5'=>'5','6'=>'6','7'=>'7','8'=>'8','9'=>'9','10'=>'10','15'=>'15','20'=>'20','30'=>'30','40'=>'40','60'=>'60','100'=>'100')),


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
			
			//fix for seo plugins which execute the do_shortcode() function before the WooCommerce plugin is loaded
			global $woocommerce;
            if(!is_object($woocommerce) || !is_object($woocommerce->query)) return;
			
			$slider = new avia_product_slider($atts);
			$slider->query_entries();
			
			return $slider->html();
		}

	}
}


if ( !class_exists( 'avia_product_slider' ) )
{
	class avia_product_slider
	{
		static  $slide = 0;
		protected $atts;
		protected $entries;

		function __construct($atts = array())
		{
			
			$this->atts = shortcode_atts(array(	'type'		=> 'slider', // can also be used as grid
												'style'		=> '', //no_margin
										 		'columns' 	=> '4',
		                                 		'items' 	=> '16',
		                                 		'taxonomy'  => 'product_cat',
		                                 		'post_type' => 'product',
		                                 		'contents' 	=> 'excerpt',
		                                 		'autoplay'  => 'no',
												'animation' => 'fade',
												'paginate'	=> 'no',
												'interval'  => 5,
												'class'		=> '',
												'sort'		=> '',
                                                'offset' => 0,
                                                'link_behavior' => '',
                                                'show_images'	=> 'yes',
		                                 		'categories'=> array()
		                                 		), $atts, 'av_productslider');
		}

		public function html()
		{
			global $woocommerce, $woocommerce_loop, $avia_config;
			$output = "";

			avia_post_slider::$slide ++;
			extract($this->atts);

			$extraClass 		= 'first';
			$grid 				= 'one_third';
			$image_size 		= 'portfolio';
			$post_loop_count 	= 1;
			$loop_counter		= 1;
			$autoplay 			= $autoplay == "no" ? false : true;
			$total				= $columns % 2 ? "odd" : "even";
			$woocommerce_loop['columns'] = $columns;

			switch($columns)
			{
				case "1": $grid = 'av_fullwidth';  $image_size = 'large'; break;
				case "2": $grid = 'av_one_half';   break;
				case "3": $grid = 'av_one_third';  break;
				case "4": $grid = 'av_one_fourth'; $image_size = 'portfolio_small'; break;
				case "5": $grid = 'av_one_fifth';  $image_size = 'portfolio_small'; break;
			}


			$data = AviaHelper::create_data_string(array('autoplay'=>$autoplay, 'interval'=>$interval, 'animation' =>$animation, 'hoverpause'=>1));

				ob_start();

				if ( have_posts() ) :

				echo "<div {$data} class='template-shop avia-content-slider avia-content-{$type}-active avia-content-slider".avia_post_slider::$slide." avia-content-slider-{$total} {$class} shop_columns_{$columns}' >";

				if($sort == "dropdown") avia_woocommerce_frontend_search_params();

				echo 	"<div class='avia-content-slider-inner'>";

							if($type == 'grid') echo '<ul class="products">';

							while ( have_posts() ) : the_post();
							if($loop_counter == 1 && $type == 'slider') echo '<ul class="products slide-entry-wrap">';

								woocommerce_get_template_part( 'content', 'product' );

							$loop_counter ++;
							$post_loop_count ++;

							if($loop_counter > $columns)
							{
								$loop_counter = 1;
							}

							if($loop_counter == 1 && $type == 'slider')
							{
								echo '</ul>';
							}

							endwhile; // end of the loop.

							if($loop_counter != 1 || $type == 'grid')
							{
								echo '</ul>';
							}

				echo 	"</div>";

				if($post_loop_count -1 > $columns && $type == 'slider')
				{
					echo $this->slide_navigation_arrows();
				}

				echo "</div>";

				else :
				
					if(function_exists('woocommerce_product_subcategories')) :
					
						if ( ! woocommerce_product_subcategories( array( 'before' => '<ul class="products">', 'after' => '</ul>' ) ) ) :
	
							echo "<p>".__( 'No products found which match your selection.', 'woocommerce' )."</p>";
	
						 endif;
					endif;
				endif;

			echo '<div class="clear"></div>';

			$products = ob_get_clean();
			$output .= $products;

			if($paginate == "yes" && $avia_pagination = avia_pagination('', 'nav')) $output .= "<div class='pagination-wrap pagination-slider'>{$avia_pagination}</div>";

			wp_reset_query();
			return $output;
		}
		
		
		public function html_list()
		{
			global $woocommerce, $avia_config, $wp_query;
			$output = "";

			avia_post_slider::$slide ++;
			extract($this->atts);

			$extraClass 		= 'first';
			$grid 				= 'av_fullwidth';
			$post_loop_count 	= 0;
			$loop_counter		= 0;
			$total				= $columns % 2 ? "odd" : "even";
			$posts_per_col		= ceil($wp_query->post_count / $columns);

			switch($columns)
			{
				case "1": $grid = 'av_fullwidth';  break;
				case "2": $grid = 'av_one_half';   break;
				case "3": $grid = 'av_one_third';  break;
				case "4": $grid = 'av_one_fourth'; break;
				case "5": $grid = 'av_one_fifth';  break;
			}

				ob_start();

				if ( have_posts() ) :
				
				while ( have_posts() ) : the_post();
				
				$post_loop_count ++;
				$loop_counter ++;
				if($loop_counter === 1)
				{
					echo "<div class='{$grid} {$extraClass} flex_column av-catalogue-column'>";
					echo "<div class='av-catalogue-container av-catalogue-container-woo' >";
					echo "<ul class='av-catalogue-list'>";
					$extraClass = "";
				}
				
					global $product;
					
					$link 	= 	$product->add_to_cart_url();
					$ajax_class = 'add_to_cart_button product_type_simple';
					$text	= "";
					$title 	= 	get_the_title();
					$content = 	get_the_excerpt();
					$price = 	$product->get_price_html();
					$rel   = "";
					
					if(empty($link_behavior))
					{
						$cart_url = get_the_permalink();
						$ajax_class = "";
					}
					else
					{
						$cart_url = $product->add_to_cart_url();
						$ajax_class = $product->is_purchasable() ? "add_to_cart_button" : "";
						$rel = $product->is_purchasable() ? "rel='nofollow'" : "";
					}
					
					$image = get_the_post_thumbnail($product->id, 'square', array('class'=>"av-catalogue-image av-cart-update-image av-catalogue-image-{$show_images}"));
					
					$text .= $image;
					$text .= "<div class='av-catalogue-item-inner'>";
					$text .= "<div class='av-catalogue-title-container'><div class='av-catalogue-title av-cart-update-title'>{$title}</div><div class='av-catalogue-price av-cart-update-price'>{$price}</div></div>";
					$text .= "<div class='av-catalogue-content'>{$content}</div>";
					$text .= "</div>";
					
					echo "<li>";
					
					//coppied from templates/loop/add-to-cart.php - class and rel attr changed, as well as text
					
					echo apply_filters( 'woocommerce_loop_add_to_cart_link',
						sprintf( '<a %s href="%s" data-product_id="%s" data-product_sku="%s" class="av-catalogue-item %s product_type_%s">%s</a>',
							$rel,
							esc_url( $cart_url ),
							esc_attr( $product->id ),
							esc_attr( $product->get_sku() ),
							$ajax_class,
							esc_attr( $product->product_type ),
							$text
						),
					$product );
		
					echo "</li>";
		
				if($loop_counter == $posts_per_col || $post_loop_count == $wp_query->post_count)
				{
					echo "</ul>";
					echo "</div>";
					echo "</div>";
					$loop_counter = 0;
				}	

				endwhile; // end of the loop.
				
				endif;

			$products = ob_get_clean();
			$output .= $products;

			if($paginate == "yes" && $avia_pagination = avia_pagination('', 'nav')) $output .= "<div class='pagination-wrap pagination-slider'>{$avia_pagination}</div>";

			wp_reset_query();
			return $output;
		}

		

		protected function slide_navigation_arrows()
		{
			$html  = "";
			$html .= "<div class='avia-slideshow-arrows avia-slideshow-controls'>";
			$html .= 	"<a href='#prev' class='prev-slide' ".av_icon_string('prev_big').">".__('Previous','avia_framework' )."</a>";
			$html .= 	"<a href='#next' class='next-slide' ".av_icon_string('next_big').">".__('Next','avia_framework' )."</a>";
			$html .= "</div>";

			return $html;
		}

		//fetch new entries
		public function query_entries($params = array())
		{
			global $woocommerce, $avia_config;

			$query = array();
			if(empty($params)) $params = $this->atts;

			if(!empty($params['categories']))
			{
				//get the product categories
				$terms 	= explode(',', $params['categories']);
			}

			$page = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : get_query_var( 'page' );
			if(!$page || $params['type'] == 'slider' || $params['paginate'] == 'no') $page = 1;
			
			
			//if we find no terms for the taxonomy fetch all taxonomy terms
			if(empty($terms[0]) || is_null($terms[0]) || $terms[0] === "null")
			{
				$terms = array();
				$allTax = get_terms( $params['taxonomy']);
				foreach($allTax as $tax)
				{
					$terms[] = $tax->term_id;
				}
			}


			if($params['sort'] == 'dropdown')
			{
				$avia_config['woocommerce']['default_posts_per_page'] = $params['items'];
				$ordering 	= $woocommerce->query->get_catalog_ordering_args();
				$order 		= $ordering['order'];
				$orderBY 	= $ordering['orderby'];

				if(!empty($avia_config['shop_overview_products_overwritten']))
					$params['items'] = $avia_config['shop_overview_products'];

			}
			else
			{
				$avia_config['woocommerce']['disable_sorting_options'] = true;

				$order = "DESC";
				if(empty($params['sort']) || $params['sort'] == "0")
				{
					$ordering 	= $woocommerce->query->get_catalog_ordering_args();
					$order 		= $ordering['order'];
					$orderBY 	= $ordering['orderby'];
				}
				else
				{
					$orderBY = $params['sort'];
				}

				if(!$orderBY) $orderBY = "menu_order";

				if($orderBY == 'price' || $orderBY == 'title'){ $order = "ASC"; }
			}


            if($params['offset'] == 'no_duplicates')
            {
                $params['offset'] = 0;
                $no_duplicates = true;
            }
            
            if( $params['offset'] == 0 )
			{
				$params['offset'] = false;
			}


			// Meta query
			$meta_query = array();
			$meta_query[] = $woocommerce->query->visibility_meta_query();
		    	$meta_query[] = $woocommerce->query->stock_status_meta_query();
			$meta_query   = array_filter( $meta_query );

			$ordering_args = $woocommerce->query->get_catalog_ordering_args( $orderBY, $order );
			
			
			
			
			$query = array(
				'post_type'		=> $params['post_type'],
				'post_status' 	=> 'publish',
				'ignore_sticky_posts'	=> 1,
				'paged' 		=> $page,
                		'offset'            	=> $params['offset'],
                		'post__not_in' => (!empty($no_duplicates)) ? $avia_config['posts_on_current_page'] : array(),
                		
				'posts_per_page' 	=> $params['items'],
				'orderby' 		=> $ordering_args['orderby'],
				'order' 		=> $ordering_args['order'],
				'meta_query' 		=> $meta_query
												);
			if(!empty($terms))
			{
				$query['tax_query'] =  array( 	array( 	'taxonomy' 	=> $params['taxonomy'],
												'field' 	=> 'id',
												'terms' 	=> $terms,
												'operator' 	=> 'IN')
												);
			}


			if ( isset( $ordering_args['meta_key'] ) ) {
	 			$query['meta_key'] = $ordering_args['meta_key'];
	 		}

			$query = apply_filters('avia_product_slide_query', $query, $params);


			query_posts($query);
			
		    	remove_filter( 'posts_clauses', array( $woocommerce->query, 'order_by_popularity_post_clauses' ) );
			remove_filter( 'posts_clauses', array( $woocommerce->query, 'order_by_rating_post_clauses' ) );

		    // store the queried post ids in
            if( have_posts() )
            {
                while( have_posts() )
                {
                    the_post();
                    $avia_config['posts_on_current_page'][] = get_the_ID();
                }
            }
		}
	}
}
