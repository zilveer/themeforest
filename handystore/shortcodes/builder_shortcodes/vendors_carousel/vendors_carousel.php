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
if ( ! class_exists( 'IG_Vendors_Carousel' ) ) {

	class IG_Vendors_Carousel extends IG_Pb_Shortcode_Parent {

		public function __construct() {
			parent::__construct();
		}

		public function element_config() {
			$this->config['shortcode'] = strtolower( __CLASS__ );
			$this->config['name'] = __( 'PT WC Vendors Carousel',  'plumtree' );
            $this->config['edit_using_ajax'] = true;
            $this->config['exception'] = array(
				'default_content'  => __( 'WC Vendors Carousel',  'plumtree' ),
				'data-modal-title' => __( 'WC Vendors Carousel',  'plumtree' ),

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
						'name'    => __( 'Element Title',  'plumtree' ),
						'id'      => 'el_title',
						'type'    => 'text_field',
						'class'   => 'jsn-input-xxlarge-fluid',
						'std'     => '',
						'role'    => 'title',
						'tooltip' => __( 'Set title for current element for identifying easily',  'plumtree' )
					),
					array(
                        'name'    	 => __( 'Columns quantity',  'plumtree' ),
                        'id'      	 => 'cols_qty',
						'type'       => 'text_append',
						'type_input' => 'number',
						'std'        => '4',
                    ),
					array(
						'name'       => __( 'Number of Vendors to show',  'plumtree' ),
						'id'         => 'items_number',
						'type'       => 'text_append',
						'type_input' => 'number',
						'std'        => '12',
					),
				),

				'styling' => array(
				)
			);
		}

		public function element_shortcode_full( $atts = null, $content = null ) {
			$arr_params     = shortcode_atts( $this->config['params'], $atts );
			extract( $arr_params );

			$html_output = '';

			$container_class = 'pt-vendors-carousel '.$css_suffix;
			$container_id = uniqid('owl',false);
			$container_class = ( ! empty( $container_class ) ) ? ' class="' . esc_attr($container_class) . '"' : '';

			if ( $cols_qty=='2' && (pt_show_layout()!='layout-one-col') ) {
				$qty_sm = $qty_xs = 1;
				$qty_md = 2;
			} elseif ( $cols_qty=='2' && (pt_show_layout()=='layout-one-col') ) {
				$qty_sm = $qty_xs = 1;
				$qty_md = 2;
			} elseif ( $cols_qty!='2' && (pt_show_layout()!='layout-one-col') ) {
				$qty_md = 3;
				$qty_sm = 2;
				$qty_xs = 2;
			} elseif ( $cols_qty!='2' && (pt_show_layout()=='layout-one-col') ) {
				$qty_md = $cols_qty;
				$qty_sm = 2;
				$qty_xs = 1;
			}

		  	// Args for vendors loop
		  	$vendor_args = array (
		  		'role' 				=> 'vendor',
		  		'meta_key' 			=> 'pv_shop_slug',
	  			'meta_value'   		=> '',
				'meta_compare' 		=> '>',
				'orderby' 			=> 'registered',
	  			'order'				=> 'ASC',
		  		'number' 			=> $items_number,
		  	);

		  	$vendor_query = New WP_User_Query( $vendor_args );

	   		$vendor_list = '';

	   		// User Loop
			if ( ! empty( $vendor_query->results ) ) {
				foreach ( $vendor_query->results as $vendor ) {
					$logo_img = '';
					if ( class_exists('WCVendors_Pro') ) {
						$shop_link = WCVendors_Pro_Vendor_Controller::get_vendor_store_url( $vendor->ID );
						$shop_name = get_user_meta( $vendor->ID, 'pv_shop_name', true );
						$store_icon_src = wp_get_attachment_image_src( get_user_meta( $vendor->ID, '_wcv_store_icon_id', true ), 'full' );
						$logo_img = '';
						if ( is_array( $store_icon_src ) ) {
							$logo_img = $store_icon_src[0];
						}
					} else {
						$shop_link = WCV_Vendors::get_vendor_shop_page($vendor->ID);
						$shop_name = $vendor->pv_shop_name;
						$vendor_id = $vendor->ID;
						$logo_img = $vendor->pv_logo_image;
					}

					if ($logo_img == '') {
						$logo_img = apply_filters( 'wcvwendors_default_vendor_logo', get_template_directory_uri() . '/images/vendor-logo.png' );
					}
			    	$vendor_list .= '<li>
			    						<div class="wrap"><img src="'.esc_url($logo_img).'" alt="'.esc_attr($shop_name).'" />
			    						<a href="'.esc_url($shop_link).'" class="button">'.__('Visit Shop', 'plumtree').'</a></div>
			    						<h4>'.esc_attr($shop_name).'</h4>
			    					</li>';
				}
			} else {
				echo 'No users found.';
			}
			wp_reset_query();

			$html_output = "<div{$container_class} id='{$container_id}'>";
			$html_output .= "<div class='title-wrapper'><h3>{$el_title}</h3>";
			$html_output .= "<div class='slider-navi'><span class='prev'></span><span class='next'></span></div>";
			$html_output .= "</div>";

	   		$html_output .= '<ul class="wcv_vendorslist">' . $vendor_list . '</ul></div>';

			$html_output.='
				<script type="text/javascript">
					(function($) {
						$(document).ready(function() {
							var owl = $("#'.$container_id.' ul.wcv_vendorslist");

							owl.owlCarousel({
							items : '.$cols_qty.',
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

			return $this->element_wrapper( $html_output, $arr_params );
		}

	}

}
