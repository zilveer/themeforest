<?php


if ( ! class_exists( 'IG_Pricing' ) ) {

	class IG_Pricing extends IG_Pb_Shortcode_Parent {

		public function __construct() {
			parent::__construct();
		}

		public function element_config() {
			$this->config['shortcode'] = strtolower( __CLASS__ );
			$this->config['shortcode'] = strtolower( __CLASS__ );
			$this->config['name']      = esc_html__( 'PT Pricing Table', 'plumtree' );
			$this->config['has_subshortcode'] = 'IG_Item_' . str_replace( 'IG_', '', __CLASS__ );
			$this->config['exception'] = array(
				'default_content'  => esc_html__( 'PT Pricing Table', 'plumtree' ),
				'data-modal-title' => esc_html__( 'PT Pricing Table', 'plumtree' )
			);
            $this->config['edit_using_ajax'] = true;
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
						'id'      => 'pb_title',
						'name'    => esc_html__( 'Pricing Title', 'plumtree' ),
						'type'    => 'text_field',
						'class'   => 'jsn-input-xxlarge-fluid',
						'std'     => '',
						'tooltip' => esc_html__( 'Set the title', 'plumtree' )
					),
					array(
						'id'      => 'pb_info',
						'name'    => esc_html__( 'Pricing Info', 'plumtree' ),
						'type'    => 'text_field',
						'class'   => 'jsn-input-medium-fluid',
						'std'     => '',
						'tooltip' => esc_html__( 'Set the pricing table info(short description)', 'plumtree' )
					),
					array(
						'id'      => 'pb_price',
						'name'    => esc_html__( 'Price', 'plumtree' ),
						'type'    => 'text_field',
						'class'   => 'jsn-input-small-fluid',
						'std'     => '',
						'tooltip' => esc_html__( 'Set the price', 'plumtree' )
					),
					array(
						'id'      => 'pb_currency',
						'name'    => esc_html__( 'Currency Sign', 'plumtree' ),
						'type'    => 'text_field',
						'class'   => 'jsn-input-small-fluid',
						'std'     => '',
						'tooltip' => esc_html__( 'Set the currency sign', 'plumtree' )
					),
					array(
						'id'            => 'pricing_items',
						'type'          => 'group',
						'shortcode'     => ucfirst( __CLASS__ ),
						'sub_item_type' => $this->config['has_subshortcode'],
						'sub_items'     => array(
							array('std' => ''),
							array('std' => ''),
						),
					),
					array(
						'name'    => esc_html__( 'Button Title', 'plumtree' ),
						'id'      => 'pb_button_title',
						'type'    => 'text_field',
						'class'   => 'jsn-input-xxlarge-fluid',
						'std'     => '',
						'tooltip' => esc_html__( 'Set Button Title', 'plumtree' )
					),
					array(
						'name'       => esc_html__( 'URL', 'plumtree' ),
						'id'         => 'pb_button_url',
						'type'       => 'text_field',
						'class'      => 'jsn-input-xxlarge-fluid',
						'std'        => 'http://',
						'tooltip'    => esc_html__( 'URL of button link', 'plumtree' ),
					),
				),
				'styling' => array(
					array(
						'name' => esc_html__( 'Background color for Title block', 'plumtree' ),
						'type' => array(
							array(
								'id'           => 'pb_title_bg_value',
								'type'         => 'text_field',
								'class'        => 'input-small',
								'std'          => '#FFFFFF',
								'parent_class' => 'combo-item',
							),
							array(
								'id'           => 'pb_title_bg_color',
								'type'         => 'color_picker',
								'std'          => '#ffffff',
								'parent_class' => 'combo-item',
							),
						),
						'container_class' => 'combo-group',
					),
					array(
						'name' => esc_html__( 'Background color for Description/Price block', 'plumtree' ),
						'type' => array(
							array(
								'id'           => 'pb_info_bg_value',
								'type'         => 'text_field',
								'class'        => 'input-small',
								'std'          => '#FFFFFF',
								'parent_class' => 'combo-item',
							),
							array(
								'id'           => 'pb_info_bg_color',
								'type'         => 'color_picker',
								'std'          => '#ffffff',
								'parent_class' => 'combo-item',
							),
						),
						'container_class' => 'combo-group',
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
			$html_element = '';
			$lazy_param = '';
			$arr_params   = shortcode_atts( $this->config['params'], $atts );
			extract( $arr_params );

			// Container Styles
			$container_class = 'pt-pricing-table '.$css_suffix;
			if ($arr_params['lazyload'] == 'yes') {	$lazy_param = ' data-expand="-100"'; $container_class = $container_class.' lazyload'; }
			$container_class = ( ! empty( $container_class ) ) ? ' class="' . $container_class . '"' : '';

			// Get Item Options
			$sub_shortcode = IG_Pb_Helper_Shortcode::remove_autop( $content );
			$items = explode( '<!--separate-->', $sub_shortcode );
			$new_items = '';

			if ( $items ) {
				foreach ($items as $item) {
					$new_items .= $item;
				}
			} 
			$table_content = $new_items;

			// Output Pricing Table
			$html_element .= "<div{$container_class}{$lazy_param}>";
			$html_element .= "<ul class='wrapper'>";

			if ( $pb_title && $pb_title!='' ) { 
				$html_element .= "<li class='title' style='background-color:".$pb_title_bg_color.";'><h4>".$pb_title."</h4></li>"; 
			}
			if ( $pb_price && $pb_price!='' ) { 
				$html_element .= "<li class='price' style='background-color:".$pb_info_bg_color.";'>"; 
				if ( $pb_info && $pb_info!='' ) { $html_element .= "<span class='info'>".$pb_info."</span>"; }
				if ( $pb_currency && $pb_currency!='' ) { 
					$html_element .= "<span class='currency'>".$pb_currency."</span>"; 
				} else {
					$html_element .= "<span class='currency'>$</span>";
				}
				$html_element .= "<span class='price-value'>".$pb_price."</span>";
				$html_element .= "</li>"; 
			}
			if ($table_content) {
				$html_element .= "<li><ul class='options'>".$table_content."</ul></li>";
			}
			if ( $pb_button_title && $pb_button_title!='' ) { 
				$html_element .= "<li class='button'><a rel='nofollow' href='".$pb_button_url."'>".$pb_button_title."</a></li>"; 
			}

			$html_element .= "</ul>";
			$html_element .= "</div>";
			

			return $this->element_wrapper( $html_element, $arr_params );
		}

	}

}