<?php
/**
 * Tag Cloud Widget
 *
 * @author 		WooThemes
 * @category 	Widgets
 * @package 	WooCommerce/Widgets
 * @version 	2.1.0
 * @extends 	WC_Widget
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Custom_WC_Widget_Product_Tag_Cloud extends WC_Widget {

	/**
	 * Constructor
	 */
	public function __construct() {
		$this->widget_cssclass    = 'woocommerce widget_product_tag_cloud1';
		$this->widget_description = __( 'Your most used product tags in cloud format.', 'homeshop' );
		$this->widget_id          = 'woocommerce_product_tag_cloud1';
		$this->widget_name        = 'homeshop'.' - '.__( 'Woo Product Tags', 'homeshop' );
		$this->settings           = array(
			'title'  => array(
				'type'  => 'text',
				'std'   => __( 'Product Tags', 'homeshop' ),
				'label' => __( 'Title', 'homeshop' )
			),
		    'icon' => array(
				'type'  => 'select',
				'std'   => 'icon-folder-open-empty',
				'label' => __( 'Select Icon', 'homeshop' ),
				'options' => wm_fontello_classes(),
			),
			'color' => array(
				'type'  => 'select',
				'std'   => 'red',
				'label' => __( 'Select Color', 'homeshop' ),
				'options' => array(
					'default' => __( 'Default', 'homeshop' ),
					'red' => __( 'Red', 'homeshop' ),
					'green' => __( 'Green', 'homeshop' ),
					'blue' => __( 'Blue', 'homeshop' ),
					'orange' => __( 'Orange', 'homeshop' ),
					'purple'  => __( 'Purple', 'homeshop' )
				)
			)
		);
		parent::__construct();
	}

	/**
	 * widget function.
	 *
	 * @see WP_Widget
	 * @access public
	 * @param array $args
	 * @param array $instance
	 * @return void
	 */
	public function widget( $args, $instance ) {
		extract( $args );

		$current_taxonomy = $this->_get_current_taxonomy($instance);

		if ( empty( $instance['title'] ) ) {
			$tax   = get_taxonomy( $current_taxonomy );
			$title = apply_filters( 'widget_title', $tax->labels->name, $instance, $this->id_base );
		} else {
			$title = apply_filters( 'widget_title', $instance['title'], $instance, $this->id_base );
		}

		$color             =  $instance['color'] ;
		$icon             =  $instance['icon'] ;
		
		//echo $before_widget;
		//if ( $title ) echo $before_title . $title . $after_title;
		
		echo '<div class="row sidebar-box '. esc_attr($color) .'">
						
			<div class="col-lg-12 col-md-12 col-sm-12">
				
				<div class="sidebar-box-heading">
					<i class="icons '. esc_attr($icon) .'"></i>
					<h4>'. esc_html($title) .'</h4>
				</div>
				<div class="sidebar-box-content sidebar-padding-box">';	
		
		
		

		
		
		

		wp_tag_cloud( apply_filters( 'woocommerce_product_tag_cloud_widget_args', array( 'taxonomy' => $current_taxonomy ) ) );

		
		echo "</div></div></div>\n";
		//echo $after_widget;
		
		
	}

	/**
	 * Return the taxonomy being displayed
	 *
	 * @param  object $instance
	 * @return string
	 */
	public function _get_current_taxonomy( $instance ) {
		return 'product_tag';
	}
}
