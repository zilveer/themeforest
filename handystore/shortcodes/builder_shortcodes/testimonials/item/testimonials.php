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
if ( ! class_exists( 'IG_Item_Testimonials' ) ) {

	class IG_Item_Testimonials extends IG_Pb_Shortcode_Child {

		public function __construct() {
			parent::__construct();
		}

		/**
		 * DEFINE configuration information of shortcode
		 */
		public function element_config() {
			$this->config['shortcode'] = strtolower( __CLASS__ );
			$this->config['exception'] = array(
				'data-modal-title' => esc_html__( 'Testimonials Item', 'plumtree' )
			);
            $this->config['edit_using_ajax'] = true;
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
                        'name'    => esc_html__( 'Image File', 'plumtree' ),
                        'id'      => 'image_file',
                        'type'    => 'select_media',
                        'std'     => '',
                        'class'   => 'jsn-input-large-fluid',
                        'tooltip' => esc_html__( 'Select background image for item', 'plumtree' )
                    ),
                    array(
						'name'    => esc_html__( 'Name', 'plumtree' ),
						'id'      => 'name',
						'type'    => 'text_field',
						'class'   => 'input-sm',
					),
					array(
						'name'    => esc_html__( 'Occupation', 'plumtree' ),
						'id'      => 'occupation',
						'type'    => 'text_field',
						'class'   => 'input-sm',
					),
					array(
						'name' => esc_html__( 'Text', 'plumtree' ),
						'id'   => 'body',
						'role' => 'content',
						'type' => 'editor',
						'std'  => IG_Pb_Helper_Type::lorem_text(),
                        'tooltip' => esc_html__( 'Set content of element', 'plumtree' ),
					),
					array(
                        'name'    => esc_html__( 'Star rating', 'plumtree' ),
                        'id'      => 'rating_value',
                        'type'    => 'select',
                        'std'     => '3',
                        'options' => array(
							'1' => esc_html__( '1 Star', 'plumtree' ),
							'2' => esc_html__( '2 Stars', 'plumtree' ),
							'3' => esc_html__( '3 Stars', 'plumtree' ),
							'4' => esc_html__( '4 Stars', 'plumtree' ),
							'5' => esc_html__( '5 Stars', 'plumtree' ),
						),
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

			$html_output = '';

			// Main Elements
			$image = '';
			if ( $image_file ) {
				$image = "<img class='lazyload' data-src='{$image_file}' src='#' alt='{$name}' />";
			}
			$heading = '';
			if ( $name ) {
				$heading = "<h3>{$name}</h3>";
			}
			$sub_heading = '';
			if ( $occupation ) {
				$sub_heading = "<span>{$occupation}</span>";
			}
			$inner_content = IG_Pb_Helper_Shortcode::remove_autop( $content );

			// Shortcode output
			$html_output .= '<div class="item-wrapper">';
			$html_output .= '<div class="img-wrapper">'.$image.'</div>';
			$html_output .= '<div class="text-wrapper">'.$heading.$sub_heading.'<p><q>'.$inner_content.'</q></p></div>';
			$width = absint($rating_value*2);
			$html_output .= '<div class="star-rating"><span style="width:'.$width.'0%"></span></div>';
			$html_output .= '</div><!--separate-->';

			return $html_output;

		}

	}

}
