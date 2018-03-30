<?php

if ( ! class_exists( 'IG_Carousel' ) ) {

	class IG_Carousel extends IG_Pb_Shortcode_Parent {

		public function __construct() {
			parent::__construct();
		}

		/**
		 * DEFINE configuration information of shortcode
		 */
		public function element_config() {
			$this->config['shortcode']        = strtolower( __CLASS__ );
			$this->config['name']             = esc_html__( 'PT Carousel', 'plumtree' );
			$this->config['has_subshortcode'] = 'IG_Item_' . str_replace( 'IG_', '', __CLASS__ );
            $this->config['edit_using_ajax'] = true;
            $this->config['exception'] = array(
				'default_content'  => esc_html__( 'PT Carousel', 'plumtree' ),
				'data-modal-title' => esc_html__( 'PT Carousel', 'plumtree' ),
			
				'admin_assets' => array(
					// Shortcode initialization
					'row.js',
					'ig-colorpicker.js',
				),
			);

		}

		/**
		 * DEFINE setting options of shortcode
		 */
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
						'id'            => 'carousel_items',
						'type'          => 'group',
						'shortcode'     => ucfirst( __CLASS__ ),
						'sub_item_type' => $this->config['has_subshortcode'],
						'sub_items'     => array(
							array('std' => ''),
							array('std' => ''),
						),
					),
				),
				'styling' => array(
					array(
                        'name'    => esc_html__( 'Items per Slide', 'plumtree' ),
                        'id'      => 'per_slide',
                        'type'    => 'select',
                        'std'     => '3',
                        'options' => array(
							'1' => esc_html__( '1 item in row', 'plumtree' ),
							'2' => esc_html__( '2 items in row', 'plumtree' ),
							'3' => esc_html__( '3 items in row', 'plumtree' ),
							'6' => esc_html__( '6 items in 2 rows', 'plumtree' ),
							'n' => esc_html__( 'n items in row', 'plumtree' )                      
						),
						'has_depend' => '1',
                    ),
                    array(
                        'name'    => esc_html__( 'How many slides to show in one moment', 'plumtree' ),
                        'id'      => 'slides_qty',
                        'type'    => 'select',
                        'std'     => '4',
                        'options' => array(
                            '2' => esc_html__( '2 Slides', 'plumtree' ),
                            '3' => esc_html__( '3 Slides', 'plumtree' ),
                            '4' => esc_html__( '4 Slides', 'plumtree' ),
                            '5' => esc_html__( '5 Slides', 'plumtree' ),
                            '6 ' => esc_html__( '6 Slides', 'plumtree' ),
                        ),
                        'dependency' => array( 'per_slide', '=', 'n'),
                    ),
                    array(
                        'name'    => esc_html__( 'Animation on hover', 'plumtree' ),
                        'id'      => 'hover_animation',
                        'type'    => 'select',
                        'std'     => 'shift',
                        'options' => array(
                            'shift' => esc_html__( 'Full height shift', 'plumtree' ),
                            'fading' => esc_html__( 'Full height fading', 'plumtree' ),
                            'bottom-sliding' => esc_html__( 'Sliding from bottom', 'plumtree' ),
                            'none' => esc_html__( 'No animation', 'plumtree' ),
                        ),
                    ),
					array(
						'name'                 => esc_html__( 'Dimension', 'plumtree' ),
						'container_class'      => 'combo-group',
						'id'                   => 'dimension',
						'type'                 => 'dimension',
						'extended_ids'         => array( 'dimension_width', 'dimension_height', 'dimension_width_unit' ),
						'dimension_width'      => array( 'std' => '' ),
						'dimension_height'     => array( 'std' => '' ),
						'dimension_width_unit' => array(
							'options' => array( 'px' => 'px', '%' => '%' ),
							'std'     => 'px',
						),
                        'tooltip' => esc_html__( 'Set width and height of element',  'plumtree' ),
					),
					array(
                        'name'    => esc_html__( 'Transition Type', 'plumtree' ),
                        'id'      => 'transition_type',
                        'type'    => 'select',
                        'std'     => 'fade',
                        'options' => array(
							'fade' => esc_html__( 'Fade', 'plumtree' ),
							'backSlide' => esc_html__( 'Back Slide', 'plumtree' ),
							'goDown' => esc_html__( 'Go Down', 'plumtree' ),
							'fadeUp' => esc_html__( 'Fade Up', 'plumtree' ),                        
						),
                    ),
					array(
						'name'    => esc_html__( 'Show Page Navigation',  'plumtree' ),
						'id'      => 'show_indicator',
						'type'    => 'radio',
						'std'     => 'yes',
						'options' => array( 'yes' => esc_html__( 'Yes',  'plumtree' ), 'no' => esc_html__( 'No',  'plumtree' ) ),
                        'tooltip' => esc_html__( 'Show/hide navigation buttons under your carousel',  'plumtree' ),
					),
					array(
						'name'    => esc_html__( 'Show Arrows',  'plumtree' ),
						'id'      => 'show_arrows',
						'type'    => 'radio',
						'std'     => 'yes',
						'options' => array( 'yes' => esc_html__( 'Yes',  'plumtree' ), 'no' => esc_html__( 'No',  'plumtree' ) ),
                        'tooltip' => esc_html__( 'Show/hide arrow buttons',  'plumtree' ),
					),
					array(
						'name'       => esc_html__( 'Autoplay',  'plumtree' ),
						'id'         => 'autoplay',
						'type'       => 'radio',
						'std'        => 'no',
						'options'    => array( 'yes' => esc_html__( 'Yes',  'plumtree' ), 'no' => esc_html__( 'No',  'plumtree' ) ),
                        'tooltip' => esc_html__( 'Whether to running your carousel automatically or not',  'plumtree' ),
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

		/**
		 * DEFINE shortcode content
		 *
		 * @param type $atts
		 * @param type $content
		 */
		public function element_shortcode_full( $atts = null, $content = null ) {
			$arr_params    = shortcode_atts( $this->config['params'], $atts );
			extract( $arr_params );
			$html_output = '';
			$lazy_param = '';

			// Container Styles
			$container_class = 'pt-carousel animation-'.$hover_animation.' '.$css_suffix;
			$container_id = uniqid('owl',false);
			if ($arr_params['lazyload'] == 'yes') {	$lazy_param = ' data-expand="-100"'; $container_class = $container_class.' lazyload'; }
			$container_class = ( ! empty( $container_class ) ) ? ' class="' . $container_class . '"' : '';

			$styles        = array();
			if ( ! empty( $dimension_width ) )
				$styles[] = "width : {$dimension_width}{$dimension_width_unit};";
			if ( ! empty( $dimension_height ) )
				$styles[] = "height : {$dimension_height}px;";
			$styles = trim( implode( ' ', $styles ) );
			$styles = ! empty( $styles ) ? "style='$styles'" : '';

			// Responsive qty
			if ( $slides_qty=='2' && (pt_show_layout()!='layout-one-col') ) {
				$qty_sm = $qty_xs = 1;
				$qty_md = 2;
			} elseif ( $slides_qty=='2' && (pt_show_layout()=='layout-one-col') ) {
				$qty_sm = $qty_xs = 1;
				$qty_md = 2;
			} elseif ( $slides_qty!='2' && (pt_show_layout()!='layout-one-col') ) {
				$qty_md = 3;
				$qty_sm = 2;
				$qty_xs = 2;
			} elseif ( $slides_qty!='2' && (pt_show_layout()=='layout-one-col') ) {
				$qty_md = $slides_qty;
				$qty_sm = 2;
				$qty_xs = 1;
			}

			// Carousel Parameters
			$owlAutoPlay = 'false';
			if ( $autoplay == 'yes' )
				$owlAutoPlay = 'true';
			$owlPagination = 'false';
			if ( $show_indicator == 'yes' )
				$owlPagination = 'true';
			$owlTransition = $transition_type;
			$owlSingleItem = 'false';
			if ($per_slide!='n') {
				$owlSingleItem = 'true';
			}

			// Get Carousel Items
			$sub_shortcode = IG_Pb_Helper_Shortcode::remove_autop( $content );
			$items = explode( '<!--separate-->', $sub_shortcode );
			array_pop($items);
			$total = count($items);
			$new_items = '';
			$test = '';

			if ( $total<(int)$per_slide || (int)$per_slide==1 || $per_slide=='n' ) {
				foreach ($items as $position => $item) {
					$new_items .= '<div class="carousel-item">'.$item.'</div>';
				}
				unset($item);
			} else {
				foreach ($items as $position => $item) {
					$current_position = $position + 1;
					if ( ($current_position == 1) || ($current_position % (int)$per_slide == 1) ) {
						$new_items .= '<div class="carousel-item">'.$item;
						if ($current_position == $total) {
							$new_items .= '</div>';
						}
					} elseif ( $current_position == $total ) {
						$new_items .= $item.'</div>';
					} elseif ( $current_position % (int)$per_slide == 0 ) {
						$new_items .= $item.'</div>';
					} else {
						$new_items .= $item;
					}
				}
				unset($item);
			}

			$carousel_content = $new_items;

			// Output Carousel
			$html_output .= "<div{$container_class} id='{$container_id}'{$lazy_param}>";
			if ( $el_title && $el_title !='' ) { $html_output .= "<div class='title-wrapper'><h3>{$el_title}</h3>"; }
			if ( $show_arrows == 'yes' ) { $html_output .= "<div class='slider-navi'><span class='prev'></span><span class='next'></span></div>"; }
			if ( $el_title && $el_title !='' ) { $html_output .= "</div>"; }
			$html_output .= "<div class='carousel-container per-slide-{$per_slide}' {$styles}>";
			$html_output .= $carousel_content;
			$html_output .= "</div></div>";

			$html_output.='
				<script type="text/javascript">
					(function($) {
						$(document).ready(function() {
							var owl = $("#'.$container_id.' .carousel-container");
 
							owl.owlCarousel({
								navigation : false,
								pagination : '.$owlPagination.',
								autoPlay   : '.$owlAutoPlay.',
								slideSpeed : 300,
								paginationSpeed : 400,
								singleItem : '.$owlSingleItem.',
								transitionStyle : "'.$owlTransition.'",';
			if ($per_slide=='n') {
				$html_output.= 'items : '.$slides_qty.',
								itemsDesktop : [1199,'.$qty_md.'],
								itemsDesktopSmall : [979,'.$qty_sm.'],
								itemsTablet: [768,'.$qty_xs.'],
								itemsMobile : [479,1],';
			}
			$html_output.= '});

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