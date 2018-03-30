<?php
/**
 * Shopping Cart Widget
 *
 * Displays shopping cart widget
 *
 * @author 		WooThemes
 * @category 	Widgets
 * @package 	WooCommerce/Widgets
 * @version 	2.0.1
 * @extends 	WC_Widget
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Custom_WC_Widget_Cart extends WC_Widget {

	/**
	 * Constructor
	 */
	public function __construct() {
		$this->widget_cssclass    = 'woocommerce widget_shopping_cart';
		$this->widget_description = __( "Display the user's Cart in the sidebar.", "homeShop" );
		$this->widget_id          = 'woocommerce_widget_cart';
		$this->widget_name        = __( 'WooCommerce Cart', 'homeshop' );
		$this->settings           = array(
			'title'  => array(
				'type'  => 'text',
				'std'   => __( 'Cart', 'homeshop' ),
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
			),
			'hide_if_empty' => array(
				'type'  => 'checkbox',
				'std'   => 0,
				'label' => __( 'Hide if cart is empty', 'homeshop' )
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

		if ( is_cart() || is_checkout() ) return;

		$title = apply_filters('widget_title', empty( $instance['title'] ) ? __( 'Cart', 'homeshop' ) : $instance['title'], $instance, $this->id_base );
		$hide_if_empty = empty( $instance['hide_if_empty'] ) ? 0 : 1;

		$color             =  $instance['color'] ;
		$icon             =  $instance['icon'] ;
		
		
		
		echo '<div class="row sidebar-box '. esc_attr($color) .'">
						
			<div class="col-lg-12 col-md-12 col-sm-12">
				
				<div class="sidebar-box-heading">
					<i class="icons '. esc_attr($icon) .'"></i>
					<h4>'. esc_html($title) .'</h4>
				</div>
				<div class="sidebar-box-content  sidebar-padding-box">';
		//echo $before_widget;

		//if ( $title ) echo $before_title . $title . $after_title;

		if ( $hide_if_empty )
			echo '<div class="hide_cart_widget_if_empty">';

		// Insert cart widget placeholder - code in woocommerce.js will update this on page load
		echo '<div class="widget_shopping_cart_content"></div>';

		if ( $hide_if_empty )
			echo '</div>';

		//echo $after_widget;
		echo '</div>
                </div>		
				</div>';

	}
}

register_widget( 'WC_Widget_Cart' );