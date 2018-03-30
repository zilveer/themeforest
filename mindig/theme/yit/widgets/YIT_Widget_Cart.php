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

	public $woo_widget_cssclass;
	public $woo_widget_description;
	public $woo_widget_idbase;
	public $woo_widget_name;

	/**
	 * constructor
	 *
	 * @access public
	 * @return void
	 */
	function __construct() {

		/* Widget variable settings. */
		$this->woo_widget_cssclass 		= 'woocommerce widget_shopping_cart widget';
		$this->woo_widget_description 	= __( "Display the user's Cart in the header of the page. Note: the widget can be used only in the header.", 'yit' );
		$this->woo_widget_idbase 		= 'yit_widget_cart';
		$this->woo_widget_name 			= __( 'YIT Cart', 'yit' );

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

		extract( $args );

        $active = (bool) !( empty( $_REQUEST['add-to-cart'] ) || ! is_numeric( $_REQUEST['add-to-cart'] ) );

        /* fix yith catalog mode */
        $ywctm_hide_cart_page = false;
        global $YITH_WC_Catalog_Mode;
        if ( isset( $YITH_WC_Catalog_Mode ) ) {
            $ywctm_hide_cart_page = method_exists( $YITH_WC_Catalog_Mode, 'check_hide_cart_checkout_pages' ) && $YITH_WC_Catalog_Mode->check_hide_cart_checkout_pages();
        }

        if( !is_shop_installed() || yit_get_option('shop-enable' ) == 'no' || ! function_exists('yit_get_current_cart_info') || $ywctm_hide_cart_page ) return;
        ?>
        <div class="yit_cart_widget widget_shopping_cart">
    		<div class="cart_label">
                <?php list( $cart_items, $cart_subtotal, $cart_icon, $cart_currency ) = yit_get_current_cart_info(); ?>
                <a href="<?php echo WC()->cart->get_cart_url(); ?>" class="cart-items" >
                    <span class="yit-mini-cart-background" style="background-image: url(<?php echo $cart_icon ?>)">
                        <span class="yit-mini-cart-icon">
                            <span class="cart-items-number"><?php echo $cart_items ?></span>
                        </span>
                    </span>

                    <span class="yit-mini-cart-subtotal">
                        <span class="cart-label_text"><?php echo yit_get_option('shop-mini-cart-label-text' ) ?></span>
                        <?php echo $cart_subtotal ?>
                    </span>
                </a>
            </div>

            <div class="cart_wrapper <?php echo $active ? ' active' : ''; ?>" style="display:<?php echo $active ? 'block' : 'none'; ?>">

                <div class="widget_shopping_cart_content group">
                    <?php if ( $active ) : ?>
                        <div class="blockUI blockOverlay" style="z-index: 1000; border: none; margin: 0px; padding: 0px; width: 100%; height: 100%; top: 0px; left: 0px; cursor: none; position: absolute; opacity: 1; background: url(<?php echo YIT_THEME_ASSETS_URL ?>/images/search.gif) 50% 50% no-repeat rgb(255, 255, 255);"></div>
                        <div class="blockUI blockMsg blockElement" style="z-index: 1011; display: none; position: absolute; left: 129px; top: 239px;"></div>

                    <?php else : ?>
                        <ul class="cart_list product_list_widget">
                            <li class="empty"><?php _e( 'No products in the cart.', 'yit' ); ?></li>
                        </ul>

                    <?php endif; ?>
                </div>

            </div>

            <script type="text/javascript">
            jQuery(document).ready(function($){
				"use strict";

                $(document).on('mouseover', '.cart_label', function(){
                    $(this).next('.cart_wrapper').fadeIn(300);
                }).on('mouseleave', '.cart_label', function(){
                    $(this).next('.cart_wrapper').fadeOut(300);
                });

                $(document)
                    .on('mouseenter', '.cart_wrapper', function(){ $(this).stop(true,true).show() })
                    .on('mouseleave', '.cart_wrapper',  function(){ $(this).fadeOut(300) });

                setTimeout(function(){ $('.cart_wrapper.active').fadeOut(300); $('.cart_wrapper').removeClass('active') }, 7000);

            });
            </script>
        </div>
		<?php
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
		?>
        <p><?php _e('Display a dropdown cart for your WooCommerce store. This widget can be used only in Header Sidebar.', 'yit') ?></p>
		<?php
	}

}