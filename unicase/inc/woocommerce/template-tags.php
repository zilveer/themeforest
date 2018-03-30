<?php
/**
 * Custom template tags used to integrate this theme with WooCommerce.
 *
 * @package unicase
 */

/**
 * Cart Link
 * Displayed a link to the cart including the number of items present and the cart total
 * @param  array $settings Settings
 * @return array           Settings
 * @since  1.0.0
 */
if ( ! function_exists( 'unicase_cart_link' ) ) {
	function unicase_cart_link() {
		?>
			<a class="cart-contents" href="<?php echo esc_url( WC()->cart->get_cart_url() ); ?>" title="<?php _e( 'View your shopping cart', 'unicase' ); ?>">
				<?php echo wp_kses_data( WC()->cart->get_cart_subtotal() ); ?> <span class="count"><?php echo wp_kses_data( sprintf( _n( '%d item', '%d items', WC()->cart->get_cart_contents_count(), 'unicase' ), WC()->cart->get_cart_contents_count() ) );?></span>
			</a>
		<?php
	}
}

/**
 * Display Product Search
 * @since  1.0.0
 * @uses  is_woocommerce_activated() check if WooCommerce is activated
 * @return void
 */

if ( ! function_exists( 'unicase_product_search' ) ) {
		function unicase_product_search() {
			if ( is_woocommerce_activated() ) { ?>
				<div class="site-search">
			}
				<?php the_widget( 'WC_Widget_Product_Search', 'title=' ); ?>
			</div>
		<?php
		}
	}
}

/**
 * Display Header Cart
 * @since  1.0.0
 * @uses  is_woocommerce_activated() check if WooCommerce is activated
 * @return void
 */
if ( ! function_exists( 'unicase_header_cart' ) ) {
	function unicase_header_cart() {
		if ( is_woocommerce_activated() ) {
			if ( is_cart() ) {
				$class = 'current-menu-item';
			} else {
				$class = '';
			}
		?>
		<ul class="site-header-cart menu">
			<li class="<?php echo esc_attr( $class ); ?>">
				<?php unicase_cart_link(); ?>
			</li>
			<?php the_widget( 'WC_Widget_Cart', 'title=' ); ?>
		</ul>
		<?php
		}
	}
}

/**
 * Sorting wrapper
 * @since   1.0.0
 * @return  void
 */
if ( ! function_exists( 'unicase_sorting_top_wrapper' ) ) {
	function unicase_sorting_top_wrapper() {
		echo '<div class="control-bar control-bar-top clearfix">';
	}
}

/**
 * Sorting wrapper
 * @since   1.0.0
 * @return  void
 */
if ( ! function_exists( 'unicase_sorting_wrapper' ) ) {
	function unicase_sorting_wrapper() {
		echo '<div class="control-bar clearfix">';
	}
}

/**
 * Sorting wrapper close
 * @since   1.0.0
 * @return  void
 */
if ( ! function_exists( 'unicase_sorting_wrapper_close' ) ) {
	function unicase_sorting_wrapper_close() {
		echo '</div>';
	}
}

/**
 * Quick View Link
 *
 * @return void
 * @since  1.0.0
 */
if ( ! function_exists( 'unicase_quick_view_link' ) ) {
	function unicase_quick_view_link() {
		if( apply_filters( 'unicase_enable_shop_quick_view', TRUE ) ) :
			?>
			<a href="<?php echo esc_url( get_permalink() ); ?>" rel="nofollow" data-product_id="<?php echo esc_attr( get_the_ID() ); ?>" class="button product_quick_view">
				<?php echo apply_filters( 'unicase_shop_quick_view_text', '<span class="fa-stack fa-lg"><i class="fa fa-circle-thin fa-stack-2x"></i><i class="fa fa-search fa-stack-1x"></i></span>' ); ?>
			</a>
			<?php
		endif;
	}
}

/**
 * Quick View Wrapper
 *
 * @return void
 * @since  1.0.0
 */
if ( ! function_exists( 'unicase_quick_view_wrapper' ) ) {
	function unicase_quick_view_wrapper() {
		if( apply_filters( 'unicase_enable_shop_quick_view', TRUE ) ) :
			wp_enqueue_script( 'wc-add-to-cart-variation' );
			
			$lightbox_en = 'yes' === get_option( 'woocommerce_enable_lightbox' );
			
			// if enabled load prettyPhoto csswp_enqueue_script( 'wc-add-to-cart-variation' );
			if( $lightbox_en ) {
				$assets_path = str_replace( array( 'http:', 'https:' ), '', WC()->plugin_url() ) . '/assets/';
				wp_enqueue_script( 'prettyPhoto', $assets_path . 'js/prettyPhoto/jquery.prettyPhoto.min.js', array( 'jquery' ), '3.1.5', true );
				wp_enqueue_style( 'woocommerce_prettyPhoto_css', $assets_path . 'css/prettyPhoto.css' );
			}
			?>
			<div class="quick-view-wrapper">
				<div class="modal fade modal-quick-view" id="quick-view" tabindex="-1" role="dialog" aria-hidden="true">
					<div class="modal-dialog modal-lg">
						<div class="modal-content">
							<div class="modal-body">
								<div id="modal-quick-view-ajax-content"></div>
								<a class="close-button" data-dismiss="modal" aria-label="Close"><i class="fa fa-times"></i></a>
							</div>
						</div>
					</div>
				</div>
			</div>
			<?php
		endif;
	}
}

/**
 * Quick View Display
 *
 * @since  1.0.0
 */
if( ! function_exists( 'unicase_product_quick_view' ) ) {
	function unicase_product_quick_view() {

		if( isset( $_REQUEST['product_id'] ) ) {
			$product_id = $_REQUEST['product_id'];

			unicase_get_template( 'shop/modal-quick-view.php', array( 'id' => $product_id ) );
		}
		die();
	}
}

if ( ! function_exists( 'unicase_template_loop_product_thumbnail' ) ) {
	/**
	 * Get the product thumbnail for the loop.
	 * @since 1.0.0
	 */
	function unicase_template_loop_product_thumbnail() {
		echo '<a href="' . get_permalink() . '" class="product-cover">' . woocommerce_get_product_thumbnail() . '</a>';
	}
}

if ( ! function_exists( 'unicase_product_image_action_wrapper' ) ) {
	function unicase_product_image_action_wrapper() {
		echo '<div class="product-image-actions">';
	}
}

if ( ! function_exists( 'unicase_product_image_action_wrapper_close' ) ) {
	function unicase_product_image_action_wrapper_close() {
		echo '</div><!-- /.product-image-actions -->';
	}
}

#-----------------------------------------------------------------
# Wrappers for Single Product Page
#-----------------------------------------------------------------
if( ! function_exists( 'unicase_wrap_product_images' ) ) {
	function unicase_wrap_product_images() {
		?>
		<div class="single-product-row">
			<div class="gallery-holder">
		<?php
	}
}
if( ! function_exists( 'unicase_wrap_product_detail' ) ) {
	function unicase_wrap_product_detail() {
		?>
			</div>
			<div class="content-holder">
		<?php
	}
}
if( ! function_exists( 'unicase_wrap_product_item_row' ) ) {
	function unicase_wrap_product_item_row() {
		?>
			</div>
		</div>
		<?php
	}
}

if ( ! function_exists( 'unicase_template_single_price' ) ) {

	/**
	 * Output the product price.
	 *
	 * @subpackage	Product
	 */
	function unicase_template_single_price() {
		?>
		<div class="price-container clearfix info-container m-t-20">
	       	<div class="prices">
		         <?php woocommerce_template_single_price(); ?>
		    </div>
		    <?php unicase_product_action_buttons();	?>
		</div>
		<?php
	}
}

if( ! function_exists( 'unicase_stock_html' ) ) {
	function unicase_stock_html( $stock_html ){
		if( !empty( $stock_html ) ) :
			ob_start();
			?>
			<div class="stock-container">
				<span class="label"><?php echo esc_html__( 'Availability:', 'unicase' ); ?></span>
				<?php echo wp_kses_post( $stock_html ); ?>
			</div>
			<?php
			$stock_html = ob_get_clean();
		endif;
		return $stock_html;
	}
}

if( ! function_exists( 'unicase_cart_shipping_calculator_wrapper_start' ) ) {
	function unicase_cart_shipping_calculator_wrapper_start() {
		?>
		<div class="cart_shipping_calculator">
			<div class="panel panel-default">
				<div class="panel-heading transparent-bg">
				    <h3 class="panel-title"><?php esc_html_e( 'Estimate shipping and tax', 'unicase' ); ?></h3>
					<p><?php esc_html_e( 'Enter your destination to get shipping and tax.', 'unicase' ); ?></p>
				</div>
				<div class="panel-body">
		<?php
	}
}

if( ! function_exists( 'unicase_cart_shipping_calculator_wrapper_end' ) ) {
	function unicase_cart_shipping_calculator_wrapper_end() {
		?>
				</div>
			</div>
		</div>
		<?php
	}
}

if( ! function_exists( 'unicase_checkout_login_message' ) ) {
	function unicase_checkout_login_message( $message ) {
		$step = '<span>1</span>';
		return $step . $message;
	}
}

if( ! function_exists( 'unicase_checkout_coupon_message' ) ) {
	function unicase_checkout_coupon_message( $message ) {
		if ( !is_user_logged_in() && 'yes' === get_option( 'woocommerce_enable_checkout_login_reminder' ) ) {
			$step = '<span>2</span>';
		} else {
			$step = '<span>1</span>';
		}

		return $step . $message;
	}
}

if( ! function_exists( 'unicase_customer_billing_wrapper_start' ) ) {
	function unicase_customer_billing_wrapper_start() {
		?>
		<div class="panel panel-default">
		<div class="panel-heading" role="tab" id="headingTwo">
			<h3 class="panel-title">
				<a data-toggle="collapse" href="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
					<?php
						if ( !is_user_logged_in() && 'yes' === get_option( 'woocommerce_enable_checkout_login_reminder' ) && WC()->cart->coupons_enabled() ) {
								?>
								<span>3</span>
								<?php
						} elseif ( is_user_logged_in() && WC()->cart->coupons_enabled() ) {
								?>
								<span>2</span>
								<?php
						} else{
							?>
							<span>1</span>
							<?php
						}
					?>
					<?php esc_html_e('Billing Information' , 'unicase'); ?></a>
			</h3>
		</div>
		<div id="collapseTwo" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingTwo">
			<div class="panel-body">
		<?php
	}
}

if( ! function_exists( 'unicase_customer_billing_wrapper_end' ) ) {
	function unicase_customer_billing_wrapper_end() {
		?>
		</div>
		</div>
		</div>
		<?php
	}
}

if( ! function_exists( 'unicase_customer_shipping_wrapper_start' ) ) {
	function unicase_customer_shipping_wrapper_start() {
		?>
		<div class="panel panel-default">
		<div class="panel-heading" role="tab" id="headingThree">
			<h3 class="panel-title">
				<a data-toggle="collapse" href="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
					<?php
						if ( !is_user_logged_in() && 'yes' === get_option( 'woocommerce_enable_checkout_login_reminder' ) && WC()->cart->coupons_enabled() ) {
								?>
								<span>4</span>
								<?php
						} elseif ( is_user_logged_in() && WC()->cart->coupons_enabled() ) {
								?>
								<span>3</span>
								<?php
						} else{
							?>
							<span>2</span>
							<?php
						}
					?>
					<?php esc_html_e('Shipping Information' , 'unicase'); ?></a>
			</h3>
		</div>
		<div id="collapseThree" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingThree">
			<div class="panel-body">
		<?php
	}
}

if( ! function_exists( 'unicase_customer_shipping_wrapper_end' ) ) {
	function unicase_customer_shipping_wrapper_end() {
		?>
		</div>
		</div>
		</div>
		<?php
	}
}

if( ! function_exists( 'unicase_review_wrapper_start' ) ) {
	function unicase_review_wrapper_start() {
		?>
		<div class="panel panel-default">
		<div class="panel-heading" role="tab" id="headingFour">
			<h3 class="panel-title">
				<a data-toggle="collapse" href="#collapseFour" aria-expanded="true" aria-controls="collapseFour">
					<?php
						if ( !is_user_logged_in() && 'yes' === get_option( 'woocommerce_enable_checkout_login_reminder' ) && WC()->cart->coupons_enabled() ) {
								?>
								<span>5</span>
								<?php
						} elseif ( is_user_logged_in() && WC()->cart->coupons_enabled() ) {
								?>
								<span>4</span>
								<?php
						} else{
							?>
							<span>3</span>
							<?php
						}
					?>
					<?php esc_html_e('Your Order' , 'unicase'); ?></a>
			</h3>
		</div>
		<div id="collapseFour" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingFour">
			<div class="panel-body">
		<?php
	}
}

if( ! function_exists( 'unicase_review_wrapper_end' ) ) {
	function unicase_review_wrapper_end() {
		?>
		</div>
		</div>
		</div>
		<?php
	}
}

if( ! function_exists( 'unicase_payment_wrapper_start' ) ) {
	function unicase_payment_wrapper_start() {
		?>
		<div class="panel panel-default">
		<div class="panel-heading" role="tab" id="headingFive">
			<h3 class="panel-title">
				<a data-toggle="collapse" href="#collapseFive" aria-expanded="true" aria-controls="collapseFive">
					<?php
						if ( !is_user_logged_in() && 'yes' === get_option( 'woocommerce_enable_checkout_login_reminder' ) && WC()->cart->coupons_enabled() ) {
								?>
								<span>6</span>
								<?php
						} elseif ( is_user_logged_in() && WC()->cart->coupons_enabled() ) {
								?>
								<span>5</span>
								<?php
						} else{
							?>
							<span>4</span>
							<?php
						}
					?>
					<?php esc_html_e('Payment' , 'unicase'); ?></a>
			</h3>
		</div>
		<div id="collapseFive" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingFive">
			<div class="panel-body">
		<?php
	}
}

if( ! function_exists( 'unicase_payment_wrapper_end' ) ) {
	function unicase_payment_wrapper_end() {
		?>
		</div>
		</div>
		</div>
		</div>
		<?php
	}
}

if( ! function_exists( 'unicase_add_animation_to_product_start' ) ) {
	function unicase_add_animation_to_product_start() {
		global $woocommerce_loop;
		$product_animation 	= apply_filters( 'unicase_product_animation', 'fadeInUp' );
		$should_delay		= apply_filters( 'unicase_should_product_animation_delay', TRUE );

		$delay_attr = '';

		if( $should_delay && !empty( $woocommerce_loop['loop'] ) && !empty( $woocommerce_loop['columns'] ) ) {
			$multiplier = ( ($woocommerce_loop['loop'] - 1 ) % $woocommerce_loop['columns'] ) + 1;
			$delay_in_seconds = ( 0.1 * $multiplier );
			$delay_attr = ' data-wow-delay="' . esc_attr ( $delay_in_seconds ) . 's"';
		}

		if( !empty( $product_animation ) ) {
			echo '<div class="product-item wow ' . esc_attr( $product_animation ) . '"' . $delay_attr . '>';
		} else {
			echo '<div class="product-item">';
		}
	}
}

if( ! function_exists( 'unicase_add_animation_to_product_end' ) ) {
	function unicase_add_animation_to_product_end() {
		echo '</div>';
	}
}

if( !function_exists( 'unicase_footer_brands_carousel' ) ) {
	function unicase_footer_brands_carousel() {
		if( apply_filters( 'unicase_enable_footer_brands_carousel', TRUE ) ) {
			$exclude_page_name = apply_filters( 'unicase_footer_brands_exclude_page', array( 'woocommerce-cart', 'woocommerce-checkout', 'woocommerce-account' ) );

			$layout_args = unicase_get_page_layout_args();
			$page_name = !empty( $layout_args['page_name'] ) ? $layout_args['page_name'] : '';

			if( !in_array( $page_name, $exclude_page_name) ) {
				$args = apply_filters( 'unicase_footer_brands_carousel_args', array(
					'title'				=> esc_html__( 'Our Brands', 'unicase' ),
					'limit'				=> 12,
					'hide_empty'    	=> TRUE,
					'orderby'			=> 'title',
					'order'				=> 'ASC',
					'include'			=> '',
					'disable_touch_drag'=> false
				) );

				echo '<div class="footer-brands-carousel">';
				unicase_brands_carousel( $args['title'], $args['limit'], $args['hide_empty'], $args['orderby'], $args['order'], $args['include'], $args['disable_touch_drag'] );
				echo '</div>';
			}
		}
	}
}
