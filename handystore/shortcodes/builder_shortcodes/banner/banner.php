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
if ( ! class_exists( 'IG_Banner' ) ) {

	class IG_Banner extends IG_Pb_Shortcode_Parent {

		public function __construct() {
			parent::__construct();
		}

		public function element_config() {
			$this->config['shortcode'] = strtolower( __CLASS__ );
			$this->config['name'] = esc_html__( 'PT Banner',  'plumtree' );
            $this->config['edit_using_ajax'] = true;
            $this->config['exception'] = array(

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
						'name'    => esc_html__( 'Image File', 'plumtree' ),
						'id'      => 'image_file',
						'type'    => 'select_media',
						'std'     => '',
						'class'   => 'jsn-input-large-fluid',
						'tooltip' => esc_html__( 'Choose image', 'plumtree' )
					),
					array(
						'name'    => esc_html__( 'Alt Text', 'plumtree' ),
						'id'      => 'image_alt',
						'type'    => 'text_field',
						'class'   => 'jsn-input-xxlarge-fluid',
						'std'     => '',
						'tooltip' => esc_html__( 'Set alt text for image', 'plumtree' )
					),
                    array(
                        'name'    => esc_html__( 'Banner Type', 'plumtree' ),
                        'id'      => 'banner_type',
                        'type'    => 'select',
                        'std'     => 'simple',
                        'options' => array(
                            'simple' => esc_html__( 'Simple Image', 'plumtree' ),
                            'with_html' => esc_html__( 'Image with HTML', 'plumtree' ),
                        ),
                        'has_depend' => '1',
                    ),
                    array(
                        'name' 	  => esc_html__( 'Banner Text', 'plumtree' ),
                        'desc'    => esc_html__( 'Enter some content for the banner text block', 'plumtree' ),
                        'id'      => 'banner_text',
                        'type'    => 'editor',
                        'role'    => 'content',
                        'std'     => '',
                        'rows'    => 5,
                        'dependency' => array( 'banner_type', '=', 'with_html' ),
                    ),
                    array(
						'name'       => esc_html__( 'Banner Text Position', 'plumtree' ),
						'id'         => 'banner_text_position',
						'type'       => 'radio',
						'label_type' => 'image',
						'dimension'  => array( 23, 23 ),
						'std'        => 'center center',
						'options'    => array(
							'left top'      => array( 'left top' ),
							'center top'    => array( 'center top' ),
							'right top'     => array( 'right top', 'linebreak' => true ),
							'left center'   => array( 'left center' ),
							'center center' => array( 'center center' ),
							'right center'  => array( 'right center', 'linebreak' => true ),
							'left bottom'   => array( 'left bottom' ),
							'center bottom' => array( 'center bottom' ),
							'right bottom'  => array( 'right bottom' ),
						),
						'dependency' => array( 'banner_type', '=', 'with_html' ),
					),
					array(
						'name'    => esc_html__( 'URL', 'plumtree' ),
						'id'      => 'banner_url',
						'type'    => 'text_field',
						'class'   => 'jsn-input-xxlarge-fluid',
						'std'     => 'http://',
                        'tooltip' => esc_html__( 'Url of link when click on image', 'plumtree' ),
					),
				),

				'styling' => array(
					array(
						'name' => esc_html__( 'Show "Read More" button', 'plumtree' ),
						'id' => 'banner_button',
						'type' => 'radio',
						'std' => 'no',
						'options' => array( 'yes' => esc_html__( 'Yes', 'plumtree' ), 'no' => esc_html__( 'No', 'plumtree' ) ),
						'tooltip' => esc_html__( 'Show or not linked button above banner', 'plumtree' ),
						'has_depend' => '1',
					),
					array(
						'name'    => esc_html__( 'Button Text', 'plumtree' ),
						'id'      => 'banner_button_text',
						'type'    => 'text_field',
						'class'   => 'jsn-input-xxlarge-fluid',
						'std'     => '',
						'tooltip' => esc_html__( 'Set banner button text', 'plumtree' ),
						'dependency' => array( 'banner_button', '=', 'yes'),
					),
					array(
						'name'       => esc_html__( 'Button Position', 'plumtree' ),
						'id'         => 'banner_button_position',
						'type'       => 'radio',
						'label_type' => 'image',
						'dimension'  => array( 23, 23 ),
						'std'        => 'center center',
						'options'    => array(
							'left top'      => array( 'left top' ),
							'center top'    => array( 'center top' ),
							'right top'     => array( 'right top', 'linebreak' => true ),
							'left center'   => array( 'left center' ),
							'center center' => array( 'center center' ),
							'right center'  => array( 'right center', 'linebreak' => true ),
							'left bottom'   => array( 'left bottom' ),
							'center bottom' => array( 'center bottom' ),
							'right bottom'  => array( 'right bottom' ),
						),
						'dependency' => array( 'banner_button', '=', 'yes' ),
					),
					array(
                        'name'    => esc_html__( 'Banner Hover Effect', 'plumtree' ),
                        'id'      => 'hover_type',
                        'type'    => 'select',
                        'std'     => 'lily',
                        'options' => array(
                            'lily' => 'Hover Effect Lily',
                            'sadie' => 'Hover Effect Sadie',
                            'roxy' => 'Hover Effect Roxy',
                            'bubba' => 'Hover Effect Bubba',
                            'romeo' => 'Hover Effect Romeo',
                            'oscar' => 'Hover Effect Oscar',
                            'ruby' => 'Hover Effect Ruby',
                            'milo' => 'Hover Effect Milo',
                            'dexter' => 'Hover Effect Dexter',
                        ),
                        'tooltip' => esc_html__( 'Choose hover effect for banner', 'plumtree' ),
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

			$html_output = '';
			$lazy_param = '';

			$show_banner_button = $arr_params['banner_button'];
			$container_class = 'figure banner-with-effects effect-'.$hover_type.' '.$css_suffix;
			if ( $show_banner_button == 'yes' ) { $container_class = $container_class.' with-button'; }
			$button_text = ( $banner_button_text == '' ? $banner_button_text : __('Read More', 'plumtree') );
			if ($arr_params['lazyload'] == 'yes') {	$lazy_param = ' data-expand="-100"'; $container_class = $container_class.' lazyload'; }

			$simple_class = 'figcaption';
			if ($banner_type == 'simple') {
				$simple_class .= " simple-banner";
			}

			$image_id   = IG_Pb_Helper_Functions::get_image_id( $image_file );
			$image = wp_get_attachment_image( $image_id, 'full' );
			$image_title = esc_attr( get_the_title( $image_id ) );

			// Banner output
			$html_output = "<div class='{$container_class}'{$lazy_param}>";

			if ( $show_banner_button == 'no' ) {
				$html_output.= "<a href='{$banner_url}' title='{$image_title}' rel='nofollow'>";
			}

			$html_output.= $image."<div class='{$simple_class}'>";

			if ($banner_type == 'with_html') {
				$html_output.= "<div class='banner-content {$banner_text_position}'>{$content}</div>";
			}

			$html_output.= "</div>";

			if ( $show_banner_button == 'yes' ) {
				$html_output.= "<a href='{$banner_url}' class='{$banner_button_position}' rel='nofollow'>{$banner_button_text}</a>";
			}

			if ( $show_banner_button == 'no' ) {
				$html_output.= "</a>";
			}

			$html_output.= "</div>";

			return $this->element_wrapper( $html_output, $arr_params );
		}

	}

}
