<?php


/**
 * This is the simple "cart" header widget.
 */

if(class_exists('Woocommerce',false)) {

	class dtbaker_woocommerce_cart extends WP_Widget {


		/** constructor */
		public function __construct() {
			$widget_ops = array(
				'description' => __( 'Use this widget to display the WooCommerce cart in the header.', 'boutique-kids' )
			);

			parent::__construct( false, __( 'WooCommerce Cart (Small Header)', 'boutique-kids' ), $widget_ops );
		}


		/** @see WP_Widget::widget */
		function widget( $args, $instance ) {

			extract( $args );

			echo $before_widget;
			if(class_exists('Woocommerce',false)){
			    global $woocommerce;

                echo '<div class="cart_title"><span class="cart_icon"></span>' . sprintf(_n('%d item', '%d items', $woocommerce->cart->cart_contents_count, 'boutique-kids'), $woocommerce->cart->cart_contents_count) . '</div>';
				?>
				<div>
			        <a href="<?php echo esc_attr($woocommerce->cart->get_cart_url()); ?>"><?php echo $woocommerce->cart->get_cart_total(); ?></a>
				</div>
		    <?php }
			echo $after_widget;
		}



	} // class boutiquewidget_latest

	add_action( 'widgets_init', create_function( '', 'return register_widget("dtbaker_woocommerce_cart");' ) );

}