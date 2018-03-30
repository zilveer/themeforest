<?php /* Shopping Cart Widget */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class PT_Widget_Cart extends WP_Widget {

	/**
	 * constructor
	 *
	 * @access public
	 * @return void
	 */
	public function __construct() {
		parent::__construct(
	 		'woocommerce_widget_cart', // Base ID
			__('PT WooCommerce Cart', 'plumtree'), // Name
			array('description' => __( "Plum Tree special widget. Display the user's Cart in the sidebar.", 'plumtree' ),
				  'classname' => 'woocommerce widget_shopping_cart',
			)
		);
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
		global $woocommerce;

		extract( $args );

        if (handy_get_option('catalog_mode') == 'on') return;

		if ( is_cart() || is_checkout() ) return;

		$title = apply_filters('widget_title', empty( $instance['title'] ) ? __( 'Cart', 'plumtree' ) : $instance['title'], $instance, $this->id_base );

		$hide_if_empty = empty( $instance['hide_if_empty'] ) ? 0 : 1;

		echo $before_widget;

		if( handy_get_option('cart_count') == 'on' ) $cart_count = '<a class="cart-contents"><span class="count '.( (WC()->cart->cart_contents_count == 0 )? 'empty' : '' ).' ">'. WC()->cart->cart_contents_count.'</span></a>';
        else $cart_count = '';

        echo '<div class="inner-cart-content">';

        echo '<div class="wrapper">';

		echo '<div class="heading"><i class="custom-icon-basket"></i>'.$cart_count.'</div>';

		if ( $hide_if_empty )
			echo '<div class="hide_cart_widget_if_empty">';

		if (  (WC()->cart->cart_contents_count) >= 3 ) {
		?>
		<div class="cart-excerpt">
			<div class="excerpt-wrapper">
				<p class="message"><?php echo sprintf(_n('You have 1 item in your shopping cart','You have %d items in your shopping cart', $woocommerce->cart->cart_contents_count, 'plumtree'), $woocommerce->cart->cart_contents_count);?></p>
				<a class="view-cart" href="<?php echo $woocommerce->cart->get_cart_url(); ?>" title="<?php _e('View your shopping cart', 'plumtree'); ?>">
					<?php _e('Details', 'plumtree'); ?><i class="fa fa-angle-right"></i>
				</a>
				<p class="total"><?php _e('Subtotal: ', 'plumtree');?><?php echo $woocommerce->cart->get_cart_subtotal();?></p>
				<a href="<?php echo esc_url($woocommerce->cart->get_checkout_url()) ?>" class="btn btn-default" title="<?php _e( 'Checkout', 'plumtree' ) ?>"><?php _e( 'Checkout', 'plumtree' ) ?></a>
			</div>
		</div>
		<?php
		} else {
			// Insert cart widget placeholder - code in woocommerce.js will update this on page load
			echo '<div class="widget_shopping_cart_content"></div>';
		}

		if ( $hide_if_empty )
			echo '</div>';

		echo '</div></div>';
		?>

		<script type="text/javascript">
		jQuery(document).ready(function($){
			$(window).load(function(){

				var settings = {
				    interval: 100,
				    timeout: 200,
				    over: mousein_triger,
				    out: mouseout_triger
					};

				function mousein_triger(){
					var add_height = $(this).find(<?php if ((WC()->cart->cart_contents_count) >= 3) { echo "'.cart-excerpt'"; } else { echo "'.widget_shopping_cart_content'"; };?>).outerHeight();
					$(this).addClass('hovered').find('.inner-cart-content').animate({ height:58+add_height, width:244}, 300, "easeInSine");
				}
				function mouseout_triger() {
					$(this).removeClass('hovered').find('.inner-cart-content').animate({ width:73,height:56}, 300, "easeOutSine");
				}

				$('header .widget_shopping_cart').hoverIntent(settings);

			});
		});
		</script>

		<?php echo $after_widget;
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
	public function update( $new_instance, $old_instance ) {
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
	public function form( $instance ) {
		$hide_if_empty = empty( $instance['hide_if_empty'] ) ? 0 : 1;
		?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title:', 'plumtree' ) ?></label>
		<input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id('title') ); ?>" name="<?php echo esc_attr( $this->get_field_name('title') ); ?>" value="<?php if (isset ( $instance['title'])) {echo esc_attr( $instance['title'] );} ?>" /></p>

		<p><input type="checkbox" class="checkbox" id="<?php echo esc_attr( $this->get_field_id('hide_if_empty') ); ?>" name="<?php echo esc_attr( $this->get_field_name('hide_if_empty') ); ?>"<?php checked( $hide_if_empty ); ?> />
		<label for="<?php echo $this->get_field_id('hide_if_empty'); ?>"><?php _e( 'Hide if cart is empty', 'plumtree' ); ?></label></p>
		<?php
	}

}

function register_pt_widget_cart() {
    register_widget( 'PT_Widget_Cart' );
}

if (class_exists('Woocommerce'))
add_action( 'widgets_init', 'register_pt_widget_cart' );

/**
 * Adding product counter.
 */

function pt_header_add_to_cart_fragment( $fragments ) {
	global $woocommerce;

	ob_start();

	?>
    <?php if ( handy_get_option('cart_count') == 'on' ) : ?>
    <a class="cart-contents"><span class="count <?php echo ( (WC()->cart->cart_contents_count == 0 )? 'empty' : '' ); ?> "><?php echo WC()->cart->cart_contents_count ?></span></a>
	<?php endif; ?>
    <?php
	$fragments['a.cart-contents'] = ob_get_clean();
	return $fragments;
}

if (class_exists('Woocommerce'))
add_filter('add_to_cart_fragments', 'pt_header_add_to_cart_fragment');
