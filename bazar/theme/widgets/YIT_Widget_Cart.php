<?php
/**
 * Shopping Cart Widget
 *
 * Displays shopping cart widget
 *
 * @author 		YIThemes
 * @extends 	WP_Widget
 */
class YIT_Widget_Cart extends WP_Widget {

	var $woo_widget_cssclass;
	var $woo_widget_description;
	var $woo_widget_idbase;
	var $woo_widget_name;

	/**
	 * constructor
	 *
	 * @access public
	 * @return void
	 */
	function __construct() {

		/* Widget variable settings. */
		$this->woo_widget_cssclass 		= 'woocommerce widget_shopping_cart';
		$this->woo_widget_description 	= __( "Display the user's Cart in the sidebar. (No checkout or cart page control)", 'yit' );
		$this->woo_widget_idbase 		= 'yit_widget_cart';
		$this->woo_widget_name 			= __( 'YIT WooCommerce Cart', 'yit' );

		/* Widget settings. */
		$widget_ops = array( 'classname' => $this->woo_widget_cssclass, 'description' => $this->woo_widget_description );

		/* Create the widget. */
		WP_Widget::__construct( 'shopping_cart', $this->woo_widget_name, $widget_ops );
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
	function widget( $args, $instance ) {
		global $woocommerce, $yit_is_header;

		extract( $args );

		//if ( is_cart() || is_checkout() ) return;

		$title = apply_filters('widget_title', empty( $instance['title'] ) ? __('Cart', 'yit') : $instance['title'], $instance, $this->id_base );
		$hide_if_empty = 0;

		echo $before_widget;

		echo "<div class=\"border-1 border\">";
		echo "<div class=\"border-2 border\">";

		if ( $title )
			echo $before_title . $title . $after_title;

		//$woocommerce->mfunc_wrapper( 'woocommerce_mini_cart()', 'woocommerce_mini_cart', array( 'list_class' => $hide_if_empty ? 'hide_cart_widget_if_empty' : '' ) );
		// Insert cart widget placeholder - code in woocommerce.js will update this on page load

		if($yit_is_header) :
			if ( sizeof( $woocommerce->cart->get_cart() ) > 0 ) : ?>
				<a href="<?php echo $woocommerce->cart->get_cart_url(); ?>" class="cart_control"><?php echo apply_filters( 'yit_view_cart_label', __('View Cart', 'yit') ); ?></a>
			<?php else: ?>
				<a href="<?php echo $woocommerce->cart->get_cart_url(); ?>" class="cart_control" style="display: none;"><?php echo apply_filters( 'yit_view_cart_label', __('View Cart', 'yit') ); ?></a>
            	<a class="cart_control cart_control_empty"><?php echo apply_filters( 'yit_widget_header_empty_cart', __('Empty Cart', 'yit') ) ?></a>
			<?php endif ?>
		<div class="cart_wrapper">
		<?php endif;

        $h =  ($hide_if_empty) ? 'hide_cart_widget_if_empty' : '';
        echo '<div class="'.$h.'">';

			echo '<div class="widget_shopping_cart_content">
					<ul class="cart_list product_list_widget">
					   <li class="empty">' . __( 'No products in the cart.', 'yit' ) . '</li>
					</ul>
				  </div>';
		echo '</div>';

		if($yit_is_header): ?>
			</div><!-- .cart_wrapper -->

			<script type="text/javascript">
			jQuery(document).ready(function($){
				$(document).on('click', '.cart_control', function(e){
					//e.preventDefault();
				});

				$(document).on('hover', '.cart_control', function(){
					$(this).next('.cart_wrapper').slideDown();
				}).on('mouseleave', '.cart_control', function(){
					$(this).next('.cart_wrapper').delay(500).slideUp();
				});


			    $(document).on('mouseenter', '.cart_wrapper', function(){ $(this).stop(true,true).show() });
                $(document).on('mouseleave', '.cart_wrapper', function(){ $(this).delay(500).slideUp() });
			});
			</script>
			<?php endif;

		echo "</div>";
		echo "</div>";
		echo $after_widget;

		if ( $hide_if_empty && sizeof( $woocommerce->cart->get_cart() ) == 0 ) {
			echo '<script>';
            echo "  jQuery('.hide_cart_widget_if_empty').closest('.widget').hide();
				jQuery('body').bind('adding_to_cart', function(){
					jQuery(this).find('.hide_cart_widget_if_empty').closest('.widget').fadeIn();
				});
				";
            echo '</script>';
		}
	}


	/**
	 * update function.
	 *
	 * @see WP_Widget->update
	 * @access public
	 * @param array $new_instance
	 * @param array $old_instance
	 * @return array
	 */
	function update( $new_instance, $old_instance ) {
		$instance['title'] = strip_tags( stripslashes( $new_instance['title'] ) );
		$instance['hide_if_empty'] = empty( $new_instance['hide_if_empty'] ) ? 0 : 1;
		return $instance;
	}


	/**
	 * form function.
	 *
	 * @see WP_Widget->form
	 * @access public
	 * @param array $instance
	 * @return void
	 */
	function form( $instance ) {
		$hide_if_empty = empty( $instance['hide_if_empty'] ) ? 0 : 1;
		?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'yit') ?></label>
		<input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id('title') ); ?>" name="<?php echo esc_attr( $this->get_field_name('title') ); ?>" value="<?php if (isset ( $instance['title'])) {echo esc_attr( $instance['title'] );} ?>" /></p>

		<p><input type="checkbox" class="checkbox" id="<?php echo esc_attr( $this->get_field_id('hide_if_empty') ); ?>" name="<?php echo esc_attr( $this->get_field_name('hide_if_empty') ); ?>"<?php checked( $hide_if_empty ); ?> />
		<label for="<?php echo $this->get_field_id('hide_if_empty'); ?>"><?php _e( 'Hide if cart is empty', 'yit' ); ?></label></p>
		<?php
	}

}