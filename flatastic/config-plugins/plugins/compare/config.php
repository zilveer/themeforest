<?php

if (!class_exists('MAD_COMPARE_MOD')) {

	class MAD_COMPARE_MOD extends MAD_PLUGINS_CONFIG {

		public $action_recount = 'action_recount';
		public $action_recount_after_remove = 'action_recount_after_remove';
		public $cookie_name = 'yith_woocompare_list';

		public $products_list = array();

		function __construct() {

			if ( !defined('WC_VERSION') || !defined( 'YITH_WOOCOMPARE' ) ) return;

			$frontend = new YITH_Woocompare_Frontend();

			define('MAD_COMPARE_URI', MAD_BASE_URI . 'config-plugins/plugins/compare/css');

			remove_action('woocommerce_single_product_summary', array($frontend, 'add_compare_link'), 35);
			remove_action('woocommerce_after_shop_loop_item', array($frontend, 'add_compare_link'), 20);

			if ( get_option('yith_woocompare_compare_button_in_products_list') == 'yes' ) {
				add_action('product-actions-after', create_function('', 'echo do_shortcode( "[yith_compare_button container=\'\']" );') );
			}

			require( self::$pathes['PLUGINS'] . 'compare/widgets/class.yith-woocompare-widget.php' );

			add_action('widgets_init', array($this, 'compare_widgets_init'));
			add_action('wp_enqueue_scripts', array( $this, 'enqueue_scripts_and_styles' ), 1 );

			$this->products_list = isset( $_COOKIE[ $this->cookie_name ] ) ? unserialize( $_COOKIE[ $this->cookie_name ] ) : array();

			add_action( 'wp_ajax_' . $this->action_recount, array( $this, 'refresh_recount' ) );
			add_action( 'wp_ajax_nopriv_' . $this->action_recount, array( $this, 'refresh_recount' ) );

			add_action( 'wp_ajax_' . $this->action_recount_after_remove, array( $this, 'refresh_recount_after_remove' ) );
			add_action( 'wp_ajax_nopriv_' . $this->action_recount_after_remove, array( $this, 'refresh_recount_after_remove' ) );

		}

		public function compare_widgets_init() {
			unregister_widget( 'YITH_Woocompare_Widget' );
			register_widget( 'MOD_YITH_Woocompare_Widget' );
		}

		public function enqueue_scripts_and_styles() {

			$widget_css = self::assetExtendUrl('css/widget.css', basename(dirname(__FILE__)));
			$woocompare_js = self::assetExtendUrl('js/woocompare-mod.js', basename(dirname(__FILE__)));

			// widget
			if ( ! is_admin() ) {
				wp_deregister_style( 'yith-woocompare-widget' );
				wp_enqueue_style( 'yith-woocompare-widget', $widget_css );

				wp_enqueue_script( MAD_PREFIX . 'wcas_frontend', $woocompare_js, array('jquery', 'yith-woocompare-main'), '', true );
				wp_localize_script( MAD_PREFIX . 'wcas_frontend', 'yith_woocompare_mod', array(
					'action_recount' => $this->action_recount,
					'action_recount_after_remove' => $this->action_recount_after_remove,
				));
			}

		}


		public function get_products_list() {
			$products_list = isset( $_COOKIE[ $this->cookie_name ] ) ? unserialize( $_COOKIE[ $this->cookie_name ] ) : array();
			return $products_list;
		}

		public function output_count() {
			$products_list = $this->products_list;

			if (!empty($products_list) && $products_list > 0) {
				echo count($products_list);
			} else {
				echo '0';
			}
		}

		public function refresh_recount() {
			echo $this->recount();
			die();
		}

		public function recount() {
			$this->output_count();
		}

		public function refresh_recount_after_remove() {
			echo $this->recount_after_remove();
			die();
		}

		public function recount_after_remove() {

			if ( ! isset( $_REQUEST['id'] ) ) die();

			if ( $_REQUEST['id'] == 'all' ) {
				$products = $this->products_list;
				foreach ( $products as $product_id ) {
					$this->remove_product_from_compare( intval( $product_id ) );
				}
			} else {
				$this->remove_product_from_compare( intval( $_REQUEST['id'] ) );
			}

			$this->output_count();

		}

		public function remove_product_from_compare( $product_id ) {
			foreach ( $this->products_list as $k => $id ) {
				if ( $product_id == $id ) unset( $this->products_list[$k] );
			}
			setcookie( $this->cookie_name, serialize( $this->products_list ), 0, COOKIEPATH, COOKIE_DOMAIN, false, true );
		}


	}

}