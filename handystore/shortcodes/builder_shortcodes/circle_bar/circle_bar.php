<?php
/**
 * @version    $Id$
 * @package    IG PageBuilder
 * @author     InnoGears Team <support@innogears.com>
 * @copyright  Copyright (C) 2012 innogears.com. All Rights Reserved.
 * @license    GNU/GPL v2 or later http://www.gnu.org/licenses/gpl-2.0.html
 *
 * Websites: http://www.innogears.com
 * Technical Support:  Feedback - http://www.innogears.com
 */

if ( ! class_exists( 'IG_Circle_Bar' ) ) :

/**
 * Create List of items element
 *
 * @package  IG PageBuilder Shortcodes
 * @since    1.0.0
 */
class IG_Circle_Bar extends IG_Pb_Shortcode_Parent {
	/**
	 * Constructor
	 *
	 * @return  void
	 */
	public function __construct() {
		parent::__construct();
	}

	/**
	 * Configure shortcode.
	 *
	 * @return  void
	 */
	public function element_config() {
		$this->config['shortcode']        = strtolower( __CLASS__ );
		$this->config['name']             = esc_html__( 'PT Circle Bar', 'plumtree' );

		// Define exception for this shortcode
		$this->config['exception'] = array(
				'default_content'  => esc_html__( 'PT Circle Bar',  'plumtree' ),
				'data-modal-title' => esc_html__( 'PT Circle Bar',  'plumtree' ),
			
				'admin_assets' => array(
					// Shortcode initialization
					'row.js',
					'ig-colorpicker.js',
				),
		);

		// Use Ajax to speed up element settings modal loading speed
		$this->config['edit_using_ajax'] = true;
	}

	/**
	 * Define shortcode settings.
	 *
	 * @return  void
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
					'name'         => esc_html__( 'Percentage', 'plumtree' ),
					'id'           => 'cbar_percentage',
					'type'         => 'text_append',
					'input_type'   => 'number',
					'class'        => 'input-mini',
					'std'          => '25',
					'append'       => '%',
					'validate'     => 'number',
					'parent_class' => 'combo-item',
					'tooltip'      => esc_html__( 'Percentage', 'plumtree' )
				),
				array(
					'id'      => 'cbar_title',
					'name'    => esc_html__( 'Circle Bar Title',  'plumtree' ),
					'type'    => 'text_field',
					'class'   => 'jsn-input-xxlarge-fluid',
					'std'     => '',
					'tooltip' => esc_html__( 'Set the title',  'plumtree' )
				),
				array(
                    'name' 	  => esc_html__( 'Short Description',  'plumtree' ),
                    'id'      => 'cbar_text',
                    'type'    => 'editor',
                    'role'    => 'content',
                    'std'     => '',
                    'rows'    => 5,
                ),
			),
			'styling' => array(
				array(
					'name' => esc_html__( 'Color for Circle Bar', 'plumtree' ),
					'type' => array(
						array(
							'id'           => 'cbar_bg_value',
							'type'         => 'text_field',
							'class'        => 'input-small',
							'std'          => '#FFFFFF',
							'parent_class' => 'combo-item',
						),
						array(
							'id'           => 'cbar_bg_color',
							'type'         => 'color_picker',
							'std'          => '#ffffff',
							'parent_class' => 'combo-item',
						),
					),
					'container_class' => 'combo-group',
				),
				array(
					'name'         => esc_html__( 'Set radius for bar',  'plumtree' ),
					'id'           => 'dimension_radius',
					'type'         => 'text_append',
					'input_type'   => 'number',
					'class'        => 'input-mini',
					'std'          => '180',
					'append'       => 'px',
					'validate'     => 'number',
					'parent_class' => 'combo-item',
				),
				array(
					'name'         => esc_html__( 'Set bar width',  'plumtree' ),
					'id'           => 'bar_width',
					'type'         => 'text_append',
					'input_type'   => 'number',
					'class'        => 'input-mini',
					'std'          => '5',
					'append'       => 'px',
					'validate'     => 'number',
					'parent_class' => 'combo-item',
				),
				array(
					'name'       => esc_html__( 'Show Icon', 'plumtree' ),
					'id'         => 'show_icon',
					'type'       => 'radio',
					'std'        => 'yes',
					'options'    => array( 'yes' => esc_html__( 'Yes', 'plumtree' ), 'no' => esc_html__( 'No', 'plumtree' ) ),
					'tooltip'    => 'Show selected icon',
					'has_depend' => '1',
				),
				array(
					'name'      => esc_html__( 'Icon', 'plumtree' ),
					'id'        => 'icon',
					'type'      => 'icons',
					'std'       => '',
					'role'      => 'title_prepend',
					'title_prepend_type' => 'icon',
					'tooltip'   => esc_html__( 'Select an icon', 'plumtree' ),
					'dependency'=> array( 'show_icon', '=', 'yes' )
				),				
				array(
					'name' => esc_html__( 'Icon Color', 'plumtree' ),
					'type' => array(
						array(
							'id'           => 'icon_c_value',
							'type'         => 'text_field',
							'std'          => '#FFFFFF',
							'parent_class' => 'combo-item',
						),
						array(
							'id'           => 'icon_c_color',
							'type'         => 'color_picker',
							'std'          => '#ffffff',
							'parent_class' => 'combo-item',
						),
					),
					'tooltip'         => esc_html__( 'Set Icon Color', 'plumtree' ),
					'container_class' => 'combo-group',
					'dependency'      => array( 'show_icon', '=', 'yes' )
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
	 * Generate HTML code from shortcode content.
	 *
	 * @param   array   $atts     Shortcode attributes.
	 * @param   string  $content  Current content.
	 *
	 * @return  string
	 */
	public function element_shortcode_full( $atts = null, $content = null ) {
		$arr_params   = shortcode_atts( $this->config['params'], $atts );
		extract( $arr_params );
		$html_elements = '';
		$lazy_param = '';

		// Variables
		$container_id = uniqid('bar',false);
		$inner_content = IG_Pb_Helper_Shortcode::remove_autop( $content );
		if ( ! empty( $dimension_radius ) ) {
			$radius = $dimension_radius;
		} else {
			$radius = 180;
		}
		$rotate_angle = 'rotate('.($cbar_percentage*3.6).'deg)';
		$container_class = 'pt-radial-bar '.$css_suffix;
		if ($arr_params['lazyload'] == 'yes') {	$lazy_param = ' data-expand="-100"'; $container_class = $container_class.' lazyload'; }

		// Dynamic Styles
		$style = '<style type="text/css">
		#'.$container_id.' .pie-wrapper {
			width: '.$radius.'px;
			height: '.$radius.'px;
  		}
  		#'.$container_id.' .pie-wrapper .label {
			width: '.($radius-$bar_width*2).'px;
			height: '.($radius-$bar_width*2).'px;
			line-height: '.($radius-$bar_width*2).'px;
			top: '.$bar_width.'px;
			left: '.$bar_width.'px;
  		}
  		#'.$container_id.' .pie-wrapper .label i {
			color: '.$icon_c_color.';
  		}
  		#'.$container_id.' .pie {
  			clip: rect(0, '.$radius.'px, '.$radius.'px, '.($radius/2).'px);
  		}
	    #'.$container_id.' .pie .half-circle {
	    	border-color: '.$cbar_bg_color.';
	    	border-width: '.$bar_width.'px;
	    	clip: rect(0, '.($radius/2).'px, '.$radius.'px, 0);
	    }
	    #'.$container_id.' .pie .left-side {
			-webkit-transform: '.$rotate_angle.';
			-moz-transform: '.$rotate_angle.';
			-ms-transform: '.$rotate_angle.';
			-o-transform: '.$rotate_angle.';
			transform: '.$rotate_angle.';
	    }
	    #'.$container_id.' .bar-title {
		    border-color: '.$cbar_bg_color.';
		}
	    #'.$container_id.' .shadow {
	    	border-width: '.$bar_width.'px;
		}';
	    if ( $cbar_percentage <= 50 ) {
	    	$style .= '
				#'.$container_id.' .pie .right-side {
				    display: none;
				}';
	    } else {
	    	$style .= '
	    	#'.$container_id.' .pie {
    			clip: rect(auto, auto, auto, auto);
    		}
    		#'.$container_id.' .pie .right-side {
	    		-webkit-transform: rotate(180deg);
				-moz-transform: rotate(180deg);
				-ms-transform: rotate(180deg);
				-o-transform: rotate(180deg);
				transform: rotate(180deg);
    		}';
  		}
  		$style .= '</style>';

		$html_elements .= '<div id="'.$container_id.'" class="'.$container_class.'"'.$lazy_param.'><div class="pie-wrapper">';
		if ( $arr_params['show_icon'] == 'yes' ) {
			$html_elements .= '<span class="label"><i class='.$icon.'></i></span>';
		} else {
			$html_elements .= '<span class="label"><span class="bar-title">
								<span class="percentage">'.$cbar_percentage.'&nbsp;<span class="smaller">%</span></span>
								<h4>'.$cbar_title.'</h4>
							   </span></span>';
		}
	    $html_elements .= '<div class="pie">
	    					<div class="left-side half-circle"></div>
	    					<div class="right-side half-circle"></div>
	    				   </div>
	    				   <div class="shadow"></div>';
  		$html_elements .= '</div>';
		if ( $arr_params['show_icon'] == 'yes' ) {
			$html_elements .= '<span class="bar-title"><span class="percentage">'.$cbar_percentage.'&nbsp;<span class="smaller">%</span></span><h4>'.$cbar_title.'</h4></span>';
		}
		if ($inner_content && $inner_content!='') {
			$html_elements .= '<div class="description">'.$inner_content.'</div>';
		}
		$html_elements .= '</div>';

		return $this->element_wrapper( $style.$html_elements, $arr_params );
	}
}

endif;
