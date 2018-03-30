<?php

/**
 * @version	$Id$
 * @package	IG Pagebuilder
 * @author	 InnoGearsTeam <support@TI.com>
 * @copyright  Copyright (C) 2012 TI.com. All Rights Reserved.
 * @license	GNU/GPL v2 or later http://www.gnu.org/licenses/gpl-2.0.html
 *
 * Websites: http://www.TI.com
 * Technical Support:  Feedback - http://www.TI.com
 */
if ( ! class_exists( 'IG_Woo_Codes' ) ) {

	class IG_Woo_Codes extends IG_Pb_Shortcode_Parent {

		public function __construct() {
			parent::__construct();
		}

		public function element_config() {
			$this->config['shortcode'] = strtolower( __CLASS__ );
			$this->config['name'] = esc_html__( 'PT Woocommerce Shortcode', 'plumtree' );
            $this->config['edit_using_ajax'] = true;
            $this->config['exception'] = array(
				'default_content'  => esc_html__( 'Woocommerce Shortcode', 'plumtree' ),
				'data-modal-title' => esc_html__( 'Woocommerce Shortcode', 'plumtree' ),

				'admin_assets' => array(
					// Shortcode initialization
					'row.js',
					'ig-colorpicker.js',
				),

			);
		}

		public function element_items() {

			$this->items = array(
				'content' => array(
					array(
						'name'    => esc_html__( 'Element Title', 'plumtree' ),
						'id'      => 'el_title',
						'type'    => 'text_field',
						'class'   => 'jsn-input-xxlarge-fluid',
						'std'     => '',
						'role'    => 'title',
						'tooltip' => esc_html__( 'Set title for current element for identifying easily', 'plumtree' )
					),
					array(
                        'name'    => esc_html__( 'Woocommerce Shortcode', 'plumtree' ),
                        'id'      => 'woo_code_type',
                        'type'    => 'select',
                        'std'     => 'recent_products',
                        'options' => array(
                            'recent_products' => esc_html__( 'Recent Products', 'plumtree' ),
                            'featured_products' => esc_html__( 'Featured Products', 'plumtree' ),
                            'product_category' => esc_html__( 'Products by category', 'plumtree' ),
                            'sale_products' => esc_html__( 'Sale Products', 'plumtree' ),
                            'best_selling_products ' => esc_html__( 'Best Selling Products', 'plumtree' ),
                            'top_rated_products' => esc_html__( 'Top Rated Products', 'plumtree' ),
                            'product_categories' => esc_html__( 'Product Categories', 'plumtree' ),
                        ),
                        'tooltip' => esc_html__( 'Choose Woocommerce Shortcode', 'plumtree' ),
                        'has_depend' => '1',
                    ),
					array(
                        'name'    => esc_html__( 'Columns quantity', 'plumtree' ),
                        'id'      => 'cols_qty',
                        'type'    => 'select',
                        'std'     => '4',
                        'options' => array(
                            '2' => esc_html__( '2 Cols', 'plumtree' ),
                            '3' => esc_html__( '3 Cols', 'plumtree' ),
                            '4' => esc_html__( '4 Cols', 'plumtree' ),
                            '5' => esc_html__( '5 Cols', 'plumtree' ),
                            '6' => esc_html__( '6 Cols', 'plumtree' ),
                        ),
                        'tooltip' => esc_html__( 'Choose Columns Quantity', 'plumtree' ),
                    ),
					array(
                        'name'    => esc_html__( 'Orderby Parameter', 'plumtree' ),
                        'id'      => 'orderby',
                        'type'    => 'select',
                        'std'     => 'date',
                        'options' => array(
                            'date' => esc_html__( 'Date', 'plumtree' ),
                            'title' => esc_html__( 'Title', 'plumtree' ),
                            'name' => esc_html__( 'Name', 'plumtree' ),
                            'ID' => esc_html__( 'ID', 'plumtree' ),
                            'rand' => esc_html__( 'Random', 'plumtree' )
                        ),
                    ),
					array(
                        'name'    => esc_html__( 'Order Parameter', 'plumtree' ),
                        'id'      => 'order',
                        'type'    => 'select',
                        'std'     => 'ASC',
                        'options' => array(
                            'ASC' => esc_html__( 'Ascending', 'plumtree' ),
                            'DESC' => esc_html__( 'Descending', 'plumtree' ),
                        ),
                    ),
					array(
						'name'       => esc_html__( 'Number of Products/Categories to show', 'plumtree' ),
						'id'         => 'items_number',
						'type'       => 'text_append',
						'type_input' => 'number',
						'std'        => '4',
					),
                    array(
                        'name' 	  => esc_html__( 'Product Category', 'plumtree' ),
                        'tooltip' => esc_html__( 'Enter the slug of category which products you want to display', 'plumtree' ),
                        'id'      => 'product_cat',
						'type'    => 'text_field',
						'class'   => 'jsn-input-xxlarge-fluid',
                        'std'     => '',
                        'dependency' => array( 'woo_code_type', '=', 'product_category'),
                    ),
					array(
                        'name'    => esc_html__( 'Output Categories Parameter', 'plumtree' ),
                        'id'      => 'cats_output',
                        'type'    => 'select',
                        'std'     => '',
                        'options' => array(
                            'ids' => esc_html__( "Enter multiply ID's", 'plumtree' ),
                            'parent' => esc_html__( 'Enter parent ID', 'plumtree' ),
                        ),
                        'dependency' => array( 'woo_code_type', '=', 'product_categories'),
                        'has_depend' => '1',
                    ),
					array(
						'name'       => esc_html__( 'Enter Parent category ID', 'plumtree' ),
						'id'         => 'parent_cat',
						'type'       => 'text_append',
						'type_input' => 'number',
						'std'        => '',
						'dependency' => array( 'cats_output', '=', 'parent'),
					),
					array(
                        'name' 	  => esc_html__( "Enter categories ID's", 'plumtree' ),
                        'desc'    => esc_html__( 'Coma separated list of categories to display', 'plumtree' ),
                        'id'      => 'product_cat_ids',
						'type'    => 'text_field',
						'class'   => 'jsn-input-xxlarge-fluid',
                        'std'     => '',
                        'dependency' => array( 'cats_output', '=', 'ids'),
                    ),
				),

				'styling' => array(
					array(
						'name' => esc_html__( 'Use Owl Carousel?', 'plumtree' ),
						'id' => 'use_slider',
						'type' => 'radio',
						'std' => 'no',
						'options' => array( 'yes' => esc_html__( 'Yes', 'plumtree' ), 'no' => esc_html__( 'No', 'plumtree' ) ),
						'tooltip' => esc_html__( 'Show or not linked button above banner', 'plumtree' ),
						'has_depend' => '1',
					),
					array(
						'name' => esc_html__( 'Add "lazyload" to this element?', 'plumtree' ),
						'id' => 'lazyload',
						'type' => 'radio',
						'std' => 'no',
						'options' => array( 'yes' => esc_html__( 'Yes', 'plumtree' ), 'no' => esc_html__( 'No', 'plumtree' ) ),
					),
				)
			);
		}

		public function element_shortcode_full( $atts = null, $content = null ) {
			$arr_params     = shortcode_atts( $this->config['params'], $atts );
			extract( $arr_params );

			$use_slider = $arr_params['use_slider'];
			$html_output = '';
			$lazy_param = '';

			$container_class = 'pt-woo-shortcode '.$css_suffix;
			if ( $use_slider == 'yes' ) {
				$container_class = $container_class.' with-slider';
				$container_id = uniqid('owl',false);
			}
			if ($arr_params['lazyload'] == 'yes') {	$lazy_param = ' data-expand="-100"'; $container_class = $container_class.' lazyload'; }
			$container_class = ( ! empty( $container_class ) ) ? ' class="' . $container_class . '"' : '';

			$woo_shortcode = $woo_code_type;
			$woo_cols = $cols_qty;
			$woo_orderby = $orderby;
			$woo_order = $order;
			$woo_per_page = $items_number;

			if ( $cols_qty=='2' && (pt_show_layout()!='layout-one-col') ) {
				$qty_sm = $qty_xs = 1;
				$qty_md = 2;
			} elseif ( $cols_qty=='2' && (pt_show_layout()=='layout-one-col') ) {
				$qty_sm = 2;
				$qty_xs = 1;
				$qty_md = 2;
			} elseif ( $cols_qty!='2' && (pt_show_layout()!='layout-one-col') ) {
				$qty_md = 3;
				$qty_sm = 2;
				$qty_xs = 2;
			} elseif ( $cols_qty!='2' && (pt_show_layout()=='layout-one-col') ) {
				$qty_md = $cols_qty;
				$qty_sm = 3;
				$qty_xs = 1;
			}

			$html_output = "<div{$container_class} id='{$container_id}'{$lazy_param}>";
			$html_output .= "<div class='title-wrapper'><h3>{$el_title}</h3>";
			if ( $use_slider == 'yes' ) { $html_output .= "<div class='slider-navi'><span class='prev'></span><span class='next'></span></div>"; }
			$html_output .= "</div>";
			if ($woo_shortcode == 'product_category') {
				$shortcode= "[{$woo_shortcode} per_page='{$woo_per_page}' columns='{$woo_cols}' orderby='{$woo_orderby}' order='{$woo_order}' category='{$product_cat}']";
			} elseif ($woo_shortcode == 'product_categories') {
				$woo_parent_cat = ( ! empty( $parent_cat ) ) ? ' parent="' . $parent_cat . '"' : '';
				$woo_cat_ids = ( ! empty( $product_cat_ids ) ) ? ' ids="' . $product_cat_ids . '"' : '';
				$shortcode = "[{$woo_shortcode} number='{$items_number}' columns='{$woo_cols}' orderby='{$woo_orderby}' order='{$woo_order}'{$woo_parent_cat}{$woo_cat_ids}]";
			} elseif ($woo_shortcode == 'best_selling_products') {
				$shortcode = "[{$woo_shortcode} columns='{$woo_cols}' per_page='{$woo_per_page}']";
			} else {
				$shortcode = "[{$woo_shortcode} per_page='{$woo_per_page}' columns='{$woo_cols}' orderby='{$woo_orderby}' order='{$woo_order}']"; }

			$html_output .= do_shortcode($shortcode)."</div>";

			if ( $use_slider == 'yes' ) {
				$html_output.='
				<script type="text/javascript">
					(function($) {
						$(document).ready(function() {
							var owl = $("#'.$container_id.' ul.products");

							owl.owlCarousel({
							items : '.$woo_cols.',
							itemsDesktop : [1199,'.$qty_md.'],
							itemsDesktopSmall : [979,'.$qty_sm.'],
							itemsTablet: [768,'.$qty_xs.'],
							itemsMobile : [479,1],
							pagination: false,
							navigation : false,
							rewindNav : false,
							scrollPerPage : false,
							});

							// Custom Navigation Events
							$("#'.$container_id.'").find(".next").click(function(){
							owl.trigger("owl.next");
							})
							$("#'.$container_id.'").find(".prev").click(function(){
							owl.trigger("owl.prev");
							})

						});
					})(jQuery);
				</script>';
			}

			return $this->element_wrapper( $html_output, $arr_params );
		}

	}

}
