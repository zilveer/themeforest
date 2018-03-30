<?php
/**
 * Integration logic for WooCommerce extensions
 *
 * @package unicase
 */

if( is_woocommerce_extension_activated( 'YITH_Woocompare' ) ) {
	
	global $yith_woocompare;

	remove_action( 'woocommerce_after_shop_loop_item', array( $yith_woocompare->obj, 'add_compare_link' ), 20 );
	remove_action( 'woocommerce_single_product_summary', array( $yith_woocompare->obj , 'add_compare_link' ), 35 );

	add_action( 'unicase_cart_buttons', array( $yith_woocompare->obj, 'add_compare_link' ), 20 );

	if ( ! function_exists( 'unicase_update_yith_compare_options' ) ) {
		function unicase_update_yith_compare_options( $options ) {

			foreach( $options['general'] as $key => $option ) {
				if( $option['id'] == 'yith_woocompare_auto_open' ) {
					$options['general'][$key]['std'] = 'no';
					$options['general'][$key]['default'] = 'no';
				}
			}

			return $options;
		}
	}

	add_filter( 'yith_woocompare_tab_options', 'unicase_update_yith_compare_options' );

	if ( ! function_exists( 'unicase_view_compare_page_url' ) ) {
		function unicase_view_compare_page_url() {
			$compare_page_URL = unicase_get_compare_page_url();
			?>
			<a href="<?php echo esc_url( $compare_page_URL ); ?>" class="view-compare-button hidden">
				<?php echo apply_filters( 'unicase_view_compare_page_label', esc_html__( 'View Comparison &rarr;', 'unicase' ) );?>
			</a>
			<?php
		}
	}

	// add_action( 'unicase_cart_buttons', 'unicase_view_compare_page_url', PHP_INT_MAX );

	if ( ! function_exists( 'unicase_woocompare_view_table_url' ) ) {
		function unicase_woocompare_view_table_url( $url ) {
			$page_url = unicase_get_compare_page_url();
			if( ! empty( $page_url ) ) {
				$url = $page_url;
			}
			return $url;
		}
	}

	add_filter( 'yith_woocompare_view_table_url', 'unicase_woocompare_view_table_url' );
}

if( is_woocommerce_extension_activated( 'YITH_WCWL' ) ) {

	global $yith_wcwl;

	if ( ! function_exists( 'unicase_modify_yith_wcwl_positions' ) ) {
		function unicase_modify_yith_wcwl_positions( $positions ) {
			
			$positions['add-to-cart'] = array(
				'hook'		=> 'unicase_cart_buttons',
				'priority'	=> 10
			);
			return $positions;

		}
	}

	add_filter( 'yith_wcwl_positions', 'unicase_modify_yith_wcwl_positions' );

	remove_action( 'wp_enqueue_scripts', array( $yith_wcwl->wcwl_init, 'enqueue_styles_and_stuffs' ) );
}