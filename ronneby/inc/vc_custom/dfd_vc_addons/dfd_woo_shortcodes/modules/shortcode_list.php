<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
/*
@Module: List view
@Since: 1.0
@Package: WooComposer
*/
if(!class_exists("Dfd_Woo_Products_List")){
	class Dfd_Woo_Products_List
	{
		function __construct(){
			add_shortcode('dfd_woo_list',array($this,'woocomposer_list_shortcode'));
			add_action('init',array($this,'woocomposer_init_grid'));
		} /* end constructor */
		function woocomposer_init_grid(){
			if(function_exists('vc_map')){
				vc_map(
					array(
						'name'		=> __('Product List', 'dfd'),
						'base'		=> 'dfd_woo_list',
						'icon'		=> 'woo_list',
						'class'	   => 'woo_list',
						'category'  	=> __('WooComposer', 'dfd'),
						'description' => 'Display products in list view',
						'controls' => 'full',
						'show_settings_on_create' => true,
						'params' => array(
							array(
								'type'             => 'ult_param_heading',
								'text'             => esc_html__( 'General module settings', 'dfd' ),
								'param_name'       => 'general_heading',
								'group'            => esc_attr__( 'General', 'dfd' ),
								'class'            => '',
								'edit_field_class' => 'ult-param-heading-wrapper no-top-margin vc_column vc_col-sm-12',
							),
							array(
								'type' => 'woocomposer',
								'class' => '',
								'heading' => __('Query Builder', 'dfd'),
								'param_name' => 'shortcode',
								'value' => '',
								'module' => 'list',
								'labels' => array(
										'products_from'   => __('Display:', 'dfd'),
										'per_page'		=> __('How Many:', 'dfd'),
										'columns'		 => __('Columns:', 'dfd'),
										'order_by'		=> __('Order By:', 'dfd'),
										'order'		   => __('Display:', 'dfd'),
										'category' 		=> __('Category:', 'dfd'),
								),
								'group'            => esc_attr__( 'General', 'dfd' ),
							),
							array(
								'type'        => 'dropdown',
								'class'       => '',
								'heading'     => __( 'Subheading content', 'dfd' ),
								'param_name'  => 'subheading_content',
								'value'       => array(
									__( 'Tags', 'dfd' )       => '',
									__( 'Product subtitle', 'dfd' )       => 'subtitle',
								),
								'group'            => esc_attr__( 'General', 'dfd' ),
							),
							array(
								'type' => 'textfield',
								'heading' => __('Extra class name', 'js_composer'),
								'param_name' => 'el_class',
								'group'            => esc_attr__( 'General', 'dfd' ),
								'description' => __('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'js_composer')
							),
							array(
								'type'        => 'dropdown',
								'class'       => '',
								'heading'     => __( 'Animation', 'dfd' ),
								'param_name'  => 'module_animation',
								'value'       => dfd_module_animation_styles(),
								'group'            => esc_attr__( 'General', 'dfd' ),
							),
							array(
								'type'             => 'ult_param_heading',
								'text'             => esc_html__( 'General styling options', 'dfd' ),
								'param_name'       => 'stylle_main_heading',
								'group'            => esc_attr__( 'Style', 'dfd' ),
								'class'            => '',
								'edit_field_class' => 'ult-param-heading-wrapper no-top-margin vc_column vc_col-sm-12',
							),
							array(
								'type'        => 'dropdown',
								'class'       => '',
								'heading'     => __( 'Display style', 'dfd' ),
								'param_name'  => 'display_style',
								'value'       => array(
									__( 'Simple', 'dfd' )       => '',
									__( 'Menu mode', 'dfd' )       => 'menu-mode',
								),
								'group'            => esc_attr__( 'Style', 'dfd' ),
							),
							array(
								'type'             => 'ult_param_heading',
								'text'             => esc_html__( 'Title settings', 'dfd' ),
								'param_name'       => 'title_heading',
								'group'            => esc_attr__( 'Style', 'dfd' ),
								'class'            => '',
								'edit_field_class' => 'ult-param-heading-wrapper vc_column vc_col-sm-12',
							),
							array(
								'type'       => 'crumina_font_container',
								'heading'    => '',
								'param_name' => 'title_font_options',
								'settings'   => array(
									'fields' => array(
										//'tag' => 'div',
										'letter_spacing',
										'font_size',
										'line_height',
										'color',
										'font_style'
									),
								),
								'group'            => esc_attr__( 'Style', 'dfd' ),
							),
							array(
								'type'        => 'checkbox',
								'heading'     => esc_html__( 'Use custom font family?', 'dfd' ),
								'param_name'  => 'title_google_fonts',
								'value'       => array( esc_html__( 'Yes', 'dfd' ) => 'yes' ),
								'description' => esc_html__( 'Use font family from google.', 'dfd' ),
								'group'            => esc_attr__( 'Style', 'dfd' ),
							),
							array(
								'type'       => 'google_fonts',
								'param_name' => 'title_custom_fonts',
								'value'      => '',
								'group'            => esc_attr__( 'Style', 'dfd' ),
								'settings'   => array(
									'fields' => array(
										'font_family_description' => esc_html__( 'Select font family.', 'dfd' ),
										'font_style_description'  => esc_html__( 'Select font styling.', 'dfd' ),
									),
								),
								'dependency' => array(
									'element' => 'title_google_fonts',
									'value'   => 'yes',
								),
							),
							array(
								'type'             => 'ult_param_heading',
								'text'             => esc_html__( 'Price settings', 'dfd' ),
								'param_name'       => 'price_heading',
								'group'            => esc_attr__( 'Style', 'dfd' ),
								'class'            => '',
								'edit_field_class' => 'ult-param-heading-wrapper vc_column vc_col-sm-12',
							),
							array(
								'type'       => 'crumina_font_container',
								'heading'    => '',
								'param_name' => 'price_font_options',
								'settings'   => array(
									'fields' => array(
										//'tag' => 'div',
										'letter_spacing',
										'font_size',
										'line_height',
										'color',
										'font_style'
									),
								),
								'group'            => esc_attr__( 'Style', 'dfd' ),
							),
							array(
								'type'             => 'ult_param_heading',
								'text'             => esc_html__( 'Subtitle settings', 'dfd' ),
								'param_name'       => 'subtitle_heading',
								'group'            => esc_attr__( 'Style', 'dfd' ),
								'class'            => '',
								'edit_field_class' => 'ult-param-heading-wrapper vc_column vc_col-sm-12',
							),
							array(
								'type'       => 'crumina_font_container',
								'heading'    => '',
								'param_name' => 'subtitle_font_options',
								'settings'   => array(
									'fields' => array(
										//'tag' => 'div',
										'letter_spacing',
										'font_size',
										'line_height',
										'color',
										'font_style'
									),
								),
								'group'            => esc_attr__( 'Style', 'dfd' ),
							),
						)/* vc_map params array */
					)/* vc_map parent array */ 
				); /* vc_map call */ 
			} /* vc_map function check */
		} /* end woocomposer_init_grid */
		function woocomposer_list_shortcode($atts){
			global $woocommerce;
			$shortcode = $subtitle_font = $subtitle_color = $module_animation = $display_style = $subheading_content = '';
			$title_font_options = $title_google_fonts = $title_custom_fonts = $price_font_options = $subtitle_font_options = '';
			
			$atts = vc_map_get_attributes( 'dfd_woo_list', $atts );
			extract( $atts );
			
			$output = $on_sale = $style = $before_line = $after_line = $delim_html = '';
			if($display_style == 'menu-mode') {
				$before_line .= '<div class="clearfix dfd-list-menu-mode">';
				$after_line .= '</div>';
				$delim_html .= '';
			} else {
				$delim_html .= '-';
			}
			
			$animate = $animation_data = '';

			if ( ! ( $module_animation == '' ) ) {
				$animate        = ' cr-animate-gen';
				$animation_data = 'data-animate-type = "' . esc_attr($module_animation) . '" ';
			}
			
			$post_count = '12';
			$output .= '<div class="dfd-woocomposer_list woocommerce '.esc_attr($el_class).' '.esc_attr($animate).'" '.$animation_data.'>';
			/* $output .= do_shortcode($content); */
			$pattern = get_shortcode_regex();
			if($shortcode !== ''){
				$new_shortcode = rawurldecode( base64_decode( strip_tags( $shortcode ) ) );
			}
			preg_match_all("/".$pattern."/",$new_shortcode,$matches);
			$shortcode_str = str_replace('"','',str_replace(" ","&",trim($matches[3][0])));
			$short_atts = parse_str($shortcode_str);//explode("&",$shortcode_str);
			if(isset($matches[2][0])): $display_type = $matches[2][0]; else: $display_type = ''; endif;
			if(!isset($columns)): $columns = '4'; endif;
			if(isset($per_page)): $post_count = $per_page; endif;
			if(isset($number)): $post_count = $number; endif;
			if(!isset($order)): $order = 'ASC'; endif;
			if(!isset($orderby)): $orderby = 'date'; endif;
			if(!isset($category)): $category = ''; endif;
			if(!isset($ids)): $ids = ''; endif;
			if($ids){
				$ids = explode( ',', $ids );
				$ids = array_map( 'trim', $ids );
			}
			
			if($columns == "2") $columns = 6;
			elseif($columns == "3") $columns = 4;
			elseif($columns == "4") $columns = 3;
			$meta_query = '';
			if($display_type == "recent_products"){
				$meta_query = WC()->query->get_meta_query();
			}
			if($display_type == "featured_products"){
				$meta_query = array(
					array(
						'key' 		=> '_visibility',
						'value' 	  => array('catalog', 'visible'),
						'compare'	=> 'IN'
					),
					array(
						'key' 		=> '_featured',
						'value' 	  => 'yes'
					)
				);
			}
			if($display_type == "top_rated_products"){
				add_filter( 'posts_clauses',  array( WC()->query, 'order_by_rating_post_clauses' ) );
				$meta_query = WC()->query->get_meta_query();
			}
			$args = array(
				'post_type'			=> 'product',
				'post_status'		  => 'publish',
				'ignore_sticky_posts'  => 1,
				'posts_per_page' 	   => $post_count,
				'orderby' 			  => $orderby,
				'order' 				=> $order,
				'meta_query' 		   => $meta_query
			);
			
			if($display_type == "sale_products"){
				$product_ids_on_sale = woocommerce_get_product_ids_on_sale();
				$meta_query = array();
				$meta_query[] = $woocommerce->query->visibility_meta_query();
				$meta_query[] = $woocommerce->query->stock_status_meta_query();
				$args['meta_query'] = $meta_query;
				$args['post__in'] = $product_ids_on_sale;
			}
			
			if($display_type == "best_selling_products"){
	
				$args['meta_key'] = 'total_sales';
				$args['orderby'] = 'meta_value_num';
				$args['meta_query'] = array(
						array(
							'key' 		=> '_visibility',
							'value' 	=> array( 'catalog', 'visible' ),
							'compare' 	=> 'IN'
						)
					);
			}
			if($display_type == "product_category"){
				$args['tax_query'] = array(
					array(
						'taxonomy' 	 => 'product_cat',
						'terms' 		=> array( esc_attr( $category ) ),
						'field' 		=> 'name',
						'operator' 	 => 'IN'
					)
				);
			}
		
			if($display_type == "product_categories"){
				$args['tax_query'] = array(
					array(
						'taxonomy' 	 => 'product_cat',
						'terms' 		=> $ids,
						'field' 		=> 'term_id',
						'operator' 	 => 'IN'
					)
				);
			}
			$query = new WP_Query( $args );
			$output .= '<ul class="dfd-woo-product-list '.$order.'">';
			if($query->have_posts()):
				while ( $query->have_posts() ) : $query->the_post();
			
					$title_html = $price_html = $subtitle_html = '';
			
					$product_id = get_the_ID();
					//$post = get_post($product_id);
					$product_title = get_the_title();
					
					$product = new WC_Product( $product_id );
					//$attachment_ids = $product->get_gallery_attachment_ids();
					$price = $product->get_price_html();
					$rating = $product->get_rating_html();
					//$product_var = new WC_Product_Variable( $product_id );
					//$available_variations = $product_var->get_available_variations();
					$cat_count = sizeof( get_the_terms( $product_id, 'product_cat' ) );
					
					$title_options = _crum_parse_text_shortcode_params( $title_font_options, '', $title_google_fonts, $title_custom_fonts );
					$title_html .= '<a href="'.get_permalink($product_id).'" class="box-name" '.$title_options['style'].'><span>'.$product_title.'</span></a>';
					
					$price_options = _crum_parse_text_shortcode_params( $price_font_options, '' );
					$price_html .= '<span class="amount" '.$price_options['style'].'>'.$price.'</span>';
					
					if($subheading_content == 'subtitle') {
						$subtitle = DfdMetaBoxSettings::get('dfd_product_product_subtitle');
					} else {
						$subtitle = $product->get_categories(', ','<span class="posted_in">'._n('','',$cat_count,'woocommerce').' ','.</span>');
					}
					
					$subtitle_options = _crum_parse_text_shortcode_params( $subtitle_font_options, '' );
					$subtitle_html .= '<span class="subtitle" '.$subtitle_options['style'].'>'.$subtitle.'</span>';
				
						$output .= '<li>';
						
							$output .= $before_line;
							$output .= $title_html;
							$output .= '<span class="woo-delim">'.esc_html($delim_html).'</span>';
							$output .= $price_html;
							$output .= $after_line;
							$output .= $before_line;
							$output .= $subtitle_html;
							if($display_type == "top_rated_products"){						
								$output .= '<div>'.$rating.'</div>';
							}					
							$output .= $after_line;
					$output .= '</li>';
				endwhile;
			endif;
			$output .= "\n".'</ul>';
			$output .= "\n".'</div>';
			if($display_type == "top_rated_products"){
				remove_filter( 'posts_clauses',  array( WC()->query, 'order_by_rating_post_clauses' ) );
			}
			wp_reset_postdata();
			return $output;
		}/* end woocomposer_list_shortcode */
	}
	new Dfd_Woo_Products_List;
}
if(class_exists('WPBakeryShortCode'))
{
	class WPBakeryShortCode_dfd_woo_list extends WPBakeryShortCode {
	}
}
