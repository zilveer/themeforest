<?php
/**
 * @version    $Id$
 * @package    IG Pagebuilder
 * @author     InnoGearsTeam <support@TI.com>
 * @copyright  Copyright (C) 2012 TI.com. All Rights Reserved.
 * @license    GNU/GPL v2 or later http://www.gnu.org/licenses/gpl-2.0.html
 *
 * Websites: http://www.TI.com
 * Technical Support:  Feedback - http://www.TI.com
 */
if ( ! class_exists( 'IG_Item_Salescarousel' ) ) {

	class IG_Item_Salescarousel extends IG_Pb_Shortcode_Child {

		public function __construct() {
			parent::__construct();
		}

		/**
		 * DEFINE configuration information of shortcode
		 */
		public function element_config() {
			$this->config['shortcode'] = strtolower( __CLASS__ );
			$this->config['exception'] = array(
				'data-modal-title' => esc_html__( 'Carousel Item', 'plumtree' )
			);
		}

		/**
		 * DEFINE setting options of shortcode
		 */
		public function element_items() {
			$this->items = array(
				'Notab' => array(
					array(
						'name'  => esc_html__( 'Heading', 'plumtree' ),
						'id'    => 'heading',
						'type'  => 'text_field',
						'class' => 'jsn-input-xxlarge-fluid',
						'role'  => 'title',
						'std'   => '',
                        'tooltip' => esc_html__( 'Set the text of your heading items', 'plumtree' ),
					),
					array(
                        'name' 	  => esc_html__( "Enter Sale Product ID", 'plumtree' ),
                        'id'      => 'product_id',
						'type'    => 'text_field',
						'class'   => 'jsn-input-xxlarge-fluid',
                        'std'     => '',
                    ),
					array(
						'name'    => esc_html__( 'Target Date', 'plumtree' ),
						'id'      => 'target_date',
						'type'    => 'text_field',
						'class'   => 'jsn-input-xxlarge-fluid',
						'std'     => '2015-12-26',
						'tooltip' => esc_html__( 'Set target date (YYYY-MM-DD) when special offer ends', 'plumtree' )
					),
					array(
						'name'    => esc_html__( 'Pre-Countdown text', 'plumtree' ),
						'id'      => 'pre_countdown_text',
						'type'    => 'text_field',
						'class'   => 'jsn-input-xxlarge-fluid',
					),

				)

			);
		}

		/**
		 * DEFINE shortcode content
		 *
		 * @param type $atts
		 * @param type $content
		 */
		public function element_shortcode_full( $atts = null, $content = null ) {
			extract( shortcode_atts( $this->config['params'], $atts ) );

			$target = explode("-", $target_date);

			if ( isset( $product_id ) ) {
				$product = new WC_Product( $product_id );
				$container_id = uniqid('countdown',false);
				$shortcode = '[add_to_cart id='.$product_id.']';

				$html_output = '<li>';
				$html_output .= '<div class="img-wrapper">
									<a href="'.$product->get_permalink().'" class="link-to-product">'
										.$product->get_image( 'shop_catalog' ).
									'</a></div>';

				$html_output .= '<div class="counter-wrapper">';

				$html_output .= '<h4>'.__('Sale!', 'plumtree').'</h4>';
				// Sale value in percents
				$percentage = round( ( ( $product->regular_price - $product->sale_price ) / $product->regular_price ) * 100 );
				$html_output .= '<span class="sale-value">-'.$percentage.'%</span>';

				$html_output .= '<div class="countdown-wrapper">';
				if ( $pre_countdown_text && $pre_countdown_text!='' ) {
					$html_output .= '<p>'.$pre_countdown_text.'</p>';
				}
				$html_output .= '<div id="'.$container_id.'"></div></div>';

				$html_output .= '<div class="price-wrapper">
									'.$shortcode.'
								</div>';

				if ( $target && $target!='' ) {
					$html_output.='
					<script type="text/javascript">
						(function($) {
							$(document).ready(function() {

								var container = $("#'.$container_id.'");
								var newDate = new Date('.$target[0].', '.$target[1].'-1, '.$target[2].');
								container.countdown({
									until: newDate,
								});
		 							
							});
						})(jQuery);
					</script>';
				}
					
				$html_output .= '</div></li>';
			}

			return $html_output;
		}

	}

}
