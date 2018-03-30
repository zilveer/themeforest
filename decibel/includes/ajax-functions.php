<?php
/**
 * Ajax functions
 */

if ( ! function_exists( 'wolf_ajax_get_video_url_from_post_id' ) ) {
	/**
	 * Get Video URL for ajax request
	 *
	 * @access public
	 * @since 1.0.0
	 * @return void
	 */
	function wolf_ajax_get_video_url_from_post_id() {

		extract( $_POST );

		$post_id = absint( $_POST['id'] );

		echo esc_url( wolf_get_first_video_url( $post_id ) );

		exit;

	}
	add_action( 'wp_ajax_wolf_ajax_get_video_url_from_post_id', 'wolf_ajax_get_video_url_from_post_id' );
	add_action( 'wp_ajax_nopriv_wolf_ajax_get_video_url_from_post_id', 'wolf_ajax_get_video_url_from_post_id' );
}

if ( ! function_exists( 'wolf_like_ajax' ) ) {
	/**
	 * Likes
	 *
	 * Increment likes meta
	 *
	 * @access public
	 * @since 1.0.0
	 * @return void
	 */
	function wolf_like_ajax() {
		extract( $_POST );
		if ( isset( $_POST['id'] ) ){
			$id = absint( $_POST['id'] );
			$likes     = absint( get_post_meta( $id , '_wolf_likes', true ) );
			$new_likes = $likes + 1;
			update_post_meta( $id, '_wolf_likes', $new_likes );
			echo absint( $new_likes );
			exit;
		}
	}
	add_action( 'wp_ajax_wolf_like_ajax', 'wolf_like_ajax' );
	add_action( 'wp_ajax_nopriv_wolf_like_ajax', 'wolf_like_ajax' );
}

if ( ! function_exists( 'wolf_share_ajax' ) ) {
	/**
	 * Shares
	 *
	 * Increment shares meta
	 *
	 * @access public
	 * @since 1.0.0
	 * @return void
	 */
	function wolf_share_ajax() {
		extract( $_POST );
		if ( isset( $_POST['id'] ) ){
			$id = absint( $_POST['id'] );
			$shares     = absint( get_post_meta( $id , '_wolf_shares', true ) );
			$new_shares = $shares + 1;
			update_post_meta( $id, '_wolf_shares', $new_shares );
			echo absint( $new_shares );
			exit;
		}
	}
	add_action( 'wp_ajax_wolf_share_ajax', 'wolf_share_ajax' );
	add_action( 'wp_ajax_nopriv_wolf_share_ajax', 'wolf_share_ajax' );
}

if ( ! function_exists( 'wolf_view_ajax' ) ) {
	/**
	 * Views
	 *
	 * Increment views meta
	 *
	 * @access public
	 * @since 1.0.0
	 * @return void
	 */
	function wolf_view_ajax() {
		extract( $_POST );
		if ( isset( $_POST['id'] ) ){
			$id = absint( $_POST['id'] );
			$views     = absint( get_post_meta( $id , '_wolf_views', true ) );
			$new_views = $views + 1;
			update_post_meta( $id, '_wolf_views', $new_views );
			exit;
		}
	}
	add_action( 'wp_ajax_wolf_view_ajax', 'wolf_view_ajax' );
	add_action( 'wp_ajax_nopriv_wolf_view_ajax', 'wolf_view_ajax' );
}

if ( ! function_exists( 'wolf_mailchimp_ajax' ) ) {
	/**
	 *  Mailchimp subscription
	 *
	 * @access public
	 * @since 1.0.0
	 * @return void
	 */
	function wolf_mailchimp_ajax() {
		extract( $_POST );
		if ( isset( $_POST['email'] ) && isset( $_POST['list_id'] ) ) {
			$email   = $_POST['email'];
			$list_id = $_POST['list_id'];

			if ( is_email( $email ) ) {
				global $wolf_mailchimp;
				$wolf_mailchimp->subscribe( $list_id, sanitize_email( $email ) );
				_e( 'Subscription successful', 'wolf' );

			} else {
				_e( 'Please insert a valid email', 'wolf' );
			}
			exit;
		}
	}
	add_action( 'wp_ajax_wolf_mailchimp_ajax', 'wolf_mailchimp_ajax' );
	add_action( 'wp_ajax_nopriv_wolf_mailchimp_ajax', 'wolf_mailchimp_ajax' );
}

if ( class_exists( 'Woocommerce' ) ) {
	/**
	 *  Add Woocommece ajax Cart feature
	 *
	 */
	if ( ! function_exists( 'wolf_woocommerce_add_to_cart_fragment_item_count' ) ) {
		/**
		 * Ensure cart contents update when products are added to the cart via AJAX
		 * @see http://docs.woothemes.com/document/show-cart-contents-total/
		 */
		function wolf_woocommerce_add_to_cart_fragment_item_count( $fragments ) {
			global $woocommerce;

			ob_start();
			?>
			<span class="product-count"><?php echo absint( $woocommerce->cart->cart_contents_count ); ?></span>
			<?php
			$fragments['.product-count'] = ob_get_clean();

			return $fragments;

		}
		add_filter( 'add_to_cart_fragments', 'wolf_woocommerce_add_to_cart_fragment_item_count' );
	}

	if ( ! function_exists( 'wolf_woocommerce_add_to_cart_fragment_item_count_with_text' ) ) {
		/**
		 * Ensure cart contents update when products are added to the cart via AJAX
		 * @see http://docs.woothemes.com/document/show-cart-contents-total/
		 */
		function wolf_woocommerce_add_to_cart_fragment_item_count_with_text( $fragments ) {
			global $woocommerce;

			ob_start();
			?>
			<span class="panel-product-count"><?php echo sprintf(_n('%d item', '%d items', $woocommerce->cart->cart_contents_count, 'wolf'), $woocommerce->cart->cart_contents_count ); ?></span>
			<?php
			$fragments['.panel-product-count'] = ob_get_clean();

			return $fragments;

		}
		add_filter( 'add_to_cart_fragments', 'wolf_woocommerce_add_to_cart_fragment_item_count_with_text' );
	}

	if ( ! function_exists( 'wolf_woocommerce_add_to_cart_fragment_total' ) ) {
		/**
		 * Ensure cart contents update when products are added to the cart via AJAX
		 * @see http://docs.woothemes.com/document/show-cart-contents-total/
		 */
		function wolf_woocommerce_add_to_cart_fragment_total( $fragments ) {
			global $woocommerce;

			ob_start();
			?>
			<span class="panel-total"><?php _e( 'Total:', 'wolf' ); ?> <?php echo sanitize_text_field( $woocommerce->cart->get_cart_total() ); ?></span>
			<?php
			$fragments['.panel-total'] = ob_get_clean();

			return $fragments;

		}
		add_filter( 'add_to_cart_fragments', 'wolf_woocommerce_add_to_cart_fragment_total' );
	}

	if ( ! function_exists( 'wolf_update_cart_total_cookie' ) ) {
		/**
		 * Cart cookie
		 *
		 * Set cart content with cookie in case a cache plugin is used
		 */
		function wolf_update_cart_total_cookie() {
			if ( ! is_admin()  && function_exists( 'is_woocommerce' ) ) {
				global $woocommerce;

				if ( is_object( $woocommerce ) ) {
					$item_count = $woocommerce->cart->cart_contents_count;
					$cart_total = $woocommerce->cart->get_cart_total();
					setcookie( 'wolf_woocommerce_items_count', $item_count, 0, '/' );
					setcookie( 'wolf_woocommerce_cart_total', $cart_total, 0, '/' );
				}
			}
		}
		add_action( 'woocommerce_loaded', 'wolf_update_cart_total_cookie' );
	}

	if ( ! function_exists( 'wolf_update_cart_ajax' ) ) {
		/**
		 *  Update woocommerce cart
		 */
		function wolf_update_cart_ajax() {
			global $woocommerce;
			$item_count = $woocommerce->cart->cart_contents_count;
			$total = $woocommerce->cart->get_cart_total();
			$cart = array(
				'itemCount' => $item_count,
				'total' => $total,
			);
			echo json_encode( $cart );
			exit();
		}
		add_action( 'wp_ajax_wolf_update_cart_ajax', 'wolf_update_cart_ajax' );
		add_action( 'wp_ajax_nopriv_wolf_update_cart_ajax', 'wolf_update_cart_ajax' );
	}
} // end if woocommerce