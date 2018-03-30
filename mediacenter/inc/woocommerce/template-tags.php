<?php

/**
 * Display Cart Page Title
 *
 * @return void
 */
if( ! function_exists( 'mc_display_cart_page_title' ) ) {
	function mc_display_cart_page_title() {
		?>
		<div class="section section-page-title inner-xs">
			<div class="page-header">
				<h2 class="page-title"><?php _e( 'Shopping Cart Summary', 'mediacenter' ); ?></h2>
			</div>
		</div>
		<?php
	}
}

if( ! function_exists( 'mc_my_account_page_title' ) ) {
	function mc_my_account_page_title() {
		$page_title = get_the_title();
		$dashboard_title = esc_html__( 'Dashboard', 'mediacenter' );
		?>
		<div class="woocommerce-MyAccount-navigation-title">
			<h4><?php echo apply_filters( 'mc_my_account_navigation_title', $page_title ); ?></h4>
		</div>
		<div class="woocommerce-MyAccount-content-title">
			<h2><?php echo apply_filters( 'mc_my_account_content_title', wc_page_endpoint_title( $dashboard_title ) ); ?></h2>
		</div>
		<?php
	}
}

/**
 * Displays Proceed to Checkout Action
 *
 * @return void
 */
if( ! function_exists( 'mc_proceed_to_checkout' ) ) {
	function mc_proceed_to_checkout() {
		?>
		<div class="wc-proceed-to-checkout">
			<?php do_action( 'woocommerce_proceed_to_checkout' ); ?>
		</div>
		<?php
	}
}

/**
 * Displays WooCommerce Checkout Shipping Fields title
 *
 * @return void
 */
if( ! function_exists( 'mc_checkout_shipping_fields_title' ) ) {
	function mc_checkout_shipping_fields_title() {
		if ( WC()->cart->needs_shipping_address() === true ) :
		?>
			<h3 class="shipping-details-title"><?php _e( 'Shipping Details', 'mediacenter' );?></h3>
		<?php
		endif;
	}
}

/**
 * Displays Signup Benefits after registration form
 *
 * @return void
 */
if( ! function_exists( 'mc_list_signup_benefits' ) ) {
	function mc_list_signup_benefits() {
		$benefits = apply_filters( 'mc_signup_benefits', array(
			__( 'Speed your way through the checkout', 'mediacenter' ),
			__( 'Track your orders easily', 'mediacenter' ),
			__( 'Keep a record of all your purchases', 'mediacenter' )
		) );
	?>
	<section class="section why-register inner-top-xs">
		<h2><?php echo __( 'Sign up today and you\'ll be able to :', 'mediacenter' ); ?></h2>
		<ul class="list-unstyled list-benefits">
			<?php foreach( $benefits as $benefit ) : ?>
			<li><i class="fa fa-check primary-color"></i> <?php echo $benefit; ?></li>
			<?php endforeach; ?>
		</ul>
	</section><!-- /.why-register -->
	<?php
	}
}

/**
 * Displays goto my account link
 *
 * @return void
 */
if( ! function_exists( 'mc_display_goto_my_account_link' ) ) {
	function mc_display_goto_my_account_link() {
		?>
		<a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>" class="goto-my-account-link"><i class="fa fa-arrow-left"></i>&nbsp;<?php _e( 'go to My Account page', 'mediacenter' ); ?></i>
		<?php
	}
}

/**
 * Wrapper start for customer login form
 *
 * @return void
 */
if( ! function_exists( 'mc_wrap_login_form_start' ) ) {
	function mc_wrap_login_form_start() {
		?>
		<div class="wrap-customer-login-form">
		<?php
	}
}

/**
 * Wrapper end for customer login form
 *
 * @return void
 */
if( ! function_exists( 'mc_wrap_login_form_end' ) ) {
	function mc_wrap_login_form_end() {
		?>
		</div><!-- /.wrap-customer-login-form -->
		<?php
	}
}

/**
 * Displays the mini cart of header
 *
 * @return void
 */
if( ! function_exists( 'mc_mini_cart' ) ) {
	function mc_mini_cart() {
		mc_get_template( 'shop/mc-mini-cart.php' );
	}
}

/**
 * Start of Single Product Summary Wrapper
 *
 * @return void
 */
if( ! function_exists( 'mc_product_summary_wrapper_start' ) ) {
	function mc_product_summary_wrapper_start() {
		?>
		<div class="images-and-summary-wrapper">
			<div class="images-and-summary">
		<?php
	}
}

/**
 * End of Single Product Summary Wrapper
 *
 * @return void
 */
if( ! function_exists( 'mc_product_summary_wrapper_end' ) ) {
	function mc_product_summary_wrapper_end() {
		?>
			</div><!-- /.images-and-summary -->
		</div><!-- /.images-and-summary-wrapper -->
		<?php
	}
}

/**
 * Start of wrapper for images
 *
 * @return void
 */
if( ! function_exists( 'mc_product_images_wrapper_start' ) ) {
	function mc_product_images_wrapper_start() {
		?>
		<div class="product-images">
		<?php
	}
}

/**
 * End of wrapper for images
 *
 * @return void
 */
if( ! function_exists( 'mc_product_images_wrapper_end' ) ) {
	function mc_product_images_wrapper_end() {
		?>
		</div><!-- /.product-images -->
		<?php
	}
}

/**
 * Displays WooCommerce Single Product Title
 *
 * @return void
 */
if( ! function_exists( 'mc_template_single_title' ) ) {
	function mc_template_single_title() {
		?>
		<div class="single-product-title">
			<?php woocommerce_template_single_title(); ?>
			<?php mc_template_single_brand(); ?>
		</div>
		<?php
	}
}

/**
 * Displays Product Brands
 *
 * @return void
 */
if( ! function_exists( 'mc_template_single_brand' ) ) {
	function mc_template_single_brand() {
		global $product;

		$brands = mc_get_product_brand( $product );
		$on_brand = join( ', ', $brands );
		?>
		<div class="product-brand"><?php echo $on_brand; ?></div>
		<?php
	}
}

/**
 * Output the start of page wrapper
 */
if( ! function_exists( 'mc_output_content_wrapper' ) ) {
	function mc_output_content_wrapper() {
		?>
		<div id="content" class="site-content container">
			<div class="row">
		<?php
	}
}

if( ! function_exists( 'mc_output_primary_wrapper' ) ) {
	function mc_output_primary_wrapper() {
		?>
		<div id="primary" class="content-area">
			<main id="main" class="site-main" role="main">
		<?php
	}
}

if( ! function_exists( 'mc_output_primary_wrapper_end' ) ) {
	function mc_output_primary_wrapper_end() {
		?>
			</main><!-- /.site-main -->
		</div><!-- /#content -->
		<?php
	}
}

if( ! function_exists( 'mc_output_secondary_wrapper' ) ) {
	function mc_output_secondary_wrapper() {
		?>
		<div id="sidebar" class="sidebar">
			<div id="secondary" class="secondary">
		<?php
	}
}

if( ! function_exists( 'mc_output_secondary_wrapper_end' ) ) {
	function mc_output_secondary_wrapper_end() {
		?>
			</div><!-- /.secondary -->
		</div><!-- /.sidebar -->
		<?php
	}
}

/**
 * Output the end of page wrapper
 */
if( ! function_exists( 'mc_output_content_wrapper_end' ) ) {
	function mc_output_content_wrapper_end() {
		?>
			</div><!-- /.row -->
		</div><!-- /.site-content -->
		<?php
	}
}

if( ! function_exists( 'mc_loop_product_excerpt' ) ) {
	/**
	 * Displays product item excerpt
	 *
	 * @since 2.0.0
	 * @return void
	 */
	function mc_loop_product_excerpt() {
		?>
		<div class="excerpt">
			<?php
				$post_excerpt = wp_strip_all_tags( get_the_excerpt() );

				$new_excerpt_length = absint( apply_filters( 'mc_excerpt_list_view_length', 160 ) );
				$new_excerpt = '';

				if( strlen( $post_excerpt ) < $new_excerpt_length ){
					$new_excerpt = $post_excerpt;
				}else{
					$new_excerpt = substr( $post_excerpt, 0 , $new_excerpt_length ) . '...';
				}

				echo apply_filters( 'mc_excerpt_list_view', $new_excerpt );
			?>
		</div>
		<?php
	}
}

if( ! function_exists( 'mc_output_list_view_footer_start' ) ) {
	/**
	 * Outputs List View footer div start
	 *
	 * @return void
	 */
	function mc_output_list_view_footer_start() {
		?>
		<div class="list-view-footer">
		<?php
	}
}

if( ! function_exists( 'mc_output_list_view_footer_end' ) ) {
	/**
	 * Outputs List View footer div end
	 *
	 * @return void
	 */
	function mc_output_list_view_footer_end() {
		?>
		</div><!-- /.list-view-footer-end -->
		<?php
	}
}

if( ! function_exists( 'mc_shop_view_switcher' ) ) {
	function mc_shop_view_switcher() {
			$active_view = apply_filters( 'mc_default_view_switcher_view', 'grid' );
		?>
		<ul class="shop-view-switcher">
			<li <?php if( $active_view == 'grid' ) : ?>class="active"<?php endif; ?>>
				<a href="#grid-view" data-toggle="tab">
					<i class="fa fa-th-large"></i>
					<?php _e( 'Grid', 'mediacenter' ); ?>
				</a>
			</li>
			<li <?php if( $active_view == 'list' ) : ?>class="active"<?php endif; ?>>
				<a href="#list-view" data-toggle="tab">
					<i class="fa fa-th-list"></i>
					<?php _e( 'List', 'mediacenter' ); ?>
				</a>
			</li>
		</ul>
		<?php
	}
}

if( ! function_exists( 'woocommerce_product_loop_start' ) ) {
	function woocommerce_product_loop_start() {

		global $woocommerce_loop;

		$woocommerce_loop['loop'] = 0;

		$product_loop_id = '';

		$product_loop_classes_arr = apply_filters( 'mc_product_loop_classes', array( 'products' ) );

		// Check for number of columns

		$columns = apply_filters( 'loop_shop_columns', 4 );

		if( ! empty( $woocommerce_loop['columns'] ) ) {
			$columns = $woocommerce_loop['columns'];
		}

		$product_loop_classes_arr[] = 'columns-' . $columns;

		// Check for carousel

		if( isset( $woocommerce_loop[ 'is_carousel'] ) && $woocommerce_loop[ 'is_carousel' ] ) {
			$product_loop_classes_arr[] = 'products-carousel-' . $columns;
		}

		// Check for carousel ID

		if( isset( $woocommerce_loop[ 'carousel_id' ] ) && ! empty( $woocommerce_loop[ 'carousel_id' ] ) ) {
			$product_loop_id = 'id="' . esc_attr( $woocommerce_loop[ 'carousel_id' ] ) . '"';
		}

		// Check for hover

		$enable_hover = apply_filters( 'mc_product_loop_enable_hover', true );

		if( $enable_hover ) {
			$product_loop_classes_arr[] = 'enable-hover';
		}

		if( is_array( $product_loop_classes_arr ) ) {
			$loop_classes = implode( ' ', $product_loop_classes_arr );
		}

		?>
		<ul <?php echo $product_loop_id; ?> class="<?php echo esc_attr( $loop_classes ); ?>">
		<?php
	}
}

if( ! function_exists( 'mc_output_loop_wrapper' ) ) {
	/**
	 * Outputs woocommerce wrapper div start for products
	 *
	 * @return void
	 */
	function mc_output_loop_wrapper() {

		$loop_wrapper_classes_arr = array( 'woocommerce' );

		$active_view = apply_filters( 'mc_default_view_switcher_view', 'grid' );
		if( $active_view == 'grid' ) {
			$loop_wrapper_classes_arr[] = 'active';
		}

		$loop_wrapper_classes_arr = apply_filters( 'mc_loop_wrapper_classes', $loop_wrapper_classes_arr );

		$loop_wrapper_classes = implode( ' ', $loop_wrapper_classes_arr );

		?>
		<div id="grid-view" class="<?php echo esc_attr( $loop_wrapper_classes ); ?>">
		<?php
	}
}

if( ! function_exists( 'mc_output_loop_wrapper_end' ) ) {
	/**
	 * End of .woocommerce wrapper div
	 *
	 * @return void
	 */
	function mc_output_loop_wrapper_end() {
		?>
		</div><!-- /.woocommerce -->
		<?php
	}
}
