<?php

if ( !defined( "crazyblog_DIR" ) )
	die( '!!!' );

class crazyblog_Woocommerce {

	public function __construct() {
		$this->crazyblog_remove_actions();
		$this->crazyblog_add_actions();
		add_filter( 'woocommerce_checkout_fields', array( $this, 'crazyblog_custom_woocommerce_billing_fields' ) );
		add_filter( "woocommerce_checkout_fields", array( $this, 'crazyblog_woocommerce_order_billing_fields' ) );
		add_filter( "woocommerce_checkout_fields", array( $this, 'crazyblog_woocommerce_order_shipping_fields' ) );
		if ( class_exists( 'woocommerce' ) ) {
			//add_action( 'widgets_init', array( $this, 'crazyblog_override_woocommerce_widgets' ), 15 );
		}
	}

	public function crazyblog_remove_actions() {
		remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
		remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
//		remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
//		remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
//		remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );
//		remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
//		remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );
//		remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cross_sell_display', 10 );
//		remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
//		remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );
	}

	public function crazyblog_add_actions() {
		add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
		add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 11 );
//		add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 20 );
//		add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 21 );
		add_action( 'wp_enqueue_scripts', array( $this, 'crazyblog_override_woo_frontend_scripts' ) );
	}

	function crazyblog_override_woo_frontend_scripts() {
		//wp_deregister_script( 'select2' );
		//wp_enqueue_script( 'bootstrap-select', crazyblog_URI . 'assets/js/bootstrap-select.min.js', array( 'jquery', 'wc-country-select', 'wc-address-i18n' ), null, true );
	}

	public function crazyblog_woocommerce_default_address_fields( $fields ) {
		$fields['billing_country']['required'] = true;
		$fields['billing_first_name']['required'] = true;

		return $fields;
	}

	public function crazyblog_custom_woocommerce_billing_fields( $fields ) {

		$fields['billing']['billing_first_name']['placeholder'] = esc_html__( 'First Name', 'crazyblog' );
		$fields['billing']['billing_first_name']['label'] = esc_html__( 'First Name', 'crazyblog' );

		$fields['billing']['billing_country']['placeholder'] = esc_html__( 'Country', 'crazyblog' );
		$fields['billing']['billing_country']['data-check'] = 'col12';
		$fields['billing']['billing_country']['label'] = esc_html__( 'Country', 'crazyblog' );

		$fields['billing']['billing_last_name']['placeholder'] = esc_html__( 'Last Name', 'crazyblog' );
		$fields['billing']['billing_last_name']['label'] = esc_html__( 'Last Name', 'crazyblog' );

		$fields['billing']['billing_company']['placeholder'] = esc_html__( 'Company Name', 'crazyblog' );
		$fields['billing']['billing_company']['data-check'] = 'col12';
		$fields['billing']['billing_company']['label'] = esc_html__( 'Company Name', 'crazyblog' );

		$fields['billing']['billing_address_1']['placeholder'] = esc_html__( 'Address', 'crazyblog' );
		$fields['billing']['billing_address_1']['data-check'] = 'col12';
		$fields['billing']['billing_address_1']['label'] = esc_html__( 'Address', 'crazyblog' );

		$fields['billing']['billing_address_2']['placeholder'] = esc_html__( 'Apartment, suite, unit etc. (optional)', 'crazyblog' );
		$fields['billing']['billing_address_2']['data-check'] = 'col12';
		$fields['billing']['billing_address_2']['label'] = '';

		$fields['billing']['billing_city']['placeholder'] = esc_html__( 'Town / City', 'crazyblog' );
		$fields['billing']['billing_city']['data-check'] = 'col12';
		$fields['billing']['billing_city']['label'] = esc_html__( 'Town / City', 'crazyblog' );

		$fields['billing']['billing_email']['placeholder'] = esc_html__( 'Email Address', 'crazyblog' );
		$fields['billing']['billing_email']['label'] = esc_html__( 'Email Address', 'crazyblog' );

		$fields['billing']['billing_phone']['placeholder'] = esc_html__( 'Phone', 'crazyblog' );
		$fields['billing']['billing_phone']['label'] = esc_html__( 'Phone', 'crazyblog' );

		$fields['billing']['billing_postcode']['placeholder'] = esc_html__( 'Postcode / Zip', 'crazyblog' );
		$fields['billing']['billing_postcode']['label'] = esc_html__( 'Postcode / Zip', 'crazyblog' );

		$fields['billing']['billing_state']['placeholder'] = esc_html__( 'State / County', 'crazyblog' );
		$fields['billing']['billing_state']['label'] = esc_html__( 'State / County', 'crazyblog' );


		/* change shipping fields */
		$fields['shipping']['shipping_country']['placeholder'] = esc_html__( 'Country', 'crazyblog' );
		$fields['shipping']['shipping_country']['data-check'] = 'col12';
		$fields['shipping']['shipping_country']['label'] = esc_html__( 'Country', 'crazyblog' );

		$fields['shipping']['shipping_first_name']['placeholder'] = esc_html__( 'First Name', 'crazyblog' );
		$fields['shipping']['shipping_first_name']['label'] = esc_html__( 'First Name', 'crazyblog' );

		$fields['shipping']['shipping_last_name']['placeholder'] = esc_html__( 'Last Name', 'crazyblog' );
		$fields['shipping']['shipping_last_name']['label'] = esc_html__( 'Last Name', 'crazyblog' );

		$fields['shipping']['shipping_company']['placeholder'] = esc_html__( 'Company Name', 'crazyblog' );
		$fields['shipping']['shipping_company']['data-check'] = 'col12';
		$fields['shipping']['shipping_company']['label'] = esc_html__( 'Company Name', 'crazyblog' );

		$fields['shipping']['shipping_address_1']['placeholder'] = esc_html__( 'Address', 'crazyblog' );
		$fields['shipping']['shipping_address_1']['data-check'] = 'col12';
		$fields['shipping']['shipping_address_1']['label'] = esc_html__( 'Address', 'crazyblog' );

		$fields['shipping']['shipping_address_2']['placeholder'] = esc_html__( 'Apartment, suite, unit etc. (optional)', 'crazyblog' );
		$fields['shipping']['shipping_address_2']['data-check'] = 'col12';
		$fields['shipping']['shipping_address_2']['label'] = '';

		$fields['shipping']['shipping_city']['placeholder'] = esc_html__( 'Town / City', 'crazyblog' );
		$fields['shipping']['shipping_city']['data-check'] = 'col12';
		$fields['shipping']['shipping_city']['label'] = esc_html__( 'Town / City', 'crazyblog' );

		$fields['shipping']['shipping_email']['placeholder'] = esc_html__( 'Email Address', 'crazyblog' );
		$fields['shipping']['shipping_email']['label'] = esc_html__( 'Email Address', 'crazyblog' );

		$fields['shipping']['shipping_phone']['placeholder'] = esc_html__( 'Phone', 'crazyblog' );
		$fields['shipping']['shipping_phone']['label'] = esc_html__( 'Phone', 'crazyblog' );

		$fields['shipping']['shipping_postcode']['placeholder'] = esc_html__( 'Postcode / Zip', 'crazyblog' );
		$fields['shipping']['shipping_postcode']['label'] = esc_html__( 'Postcode / Zip', 'crazyblog' );

		$fields['shipping']['shipping_state']['placeholder'] = esc_html__( 'State / County', 'crazyblog' );
		$fields['shipping']['shipping_state']['label'] = esc_html__( 'State / County', 'crazyblog' );

		return $fields;
	}

	public function crazyblog_woocommerce_order_billing_fields( $fields ) {
		$order = array(
			"billing_first_name",
			"billing_last_name",
			"billing_company",
			"billing_email",
			"billing_phone",
			"billing_country",
			//"billing_state",
			"billing_address_1",
			"billing_address_2",
		);
		foreach ( $order as $field ) {
			$ordered_fields[$field] = $fields["billing"][$field];
		}

		$fields["billing"] = $ordered_fields;
		return $fields;
	}

	public function crazyblog_woocommerce_order_shipping_fields( $fields ) {
		$order = array(
			"shipping_first_name",
			"shipping_last_name",
			"shipping_company",
			"shipping_email",
			"shipping_phone",
			"shipping_country",
			//"shipping_state",
			"shipping_address_1",
			"shipping_address_2",
				//"shipping_postcode",
		);
		foreach ( $order as $field ) {
			$ordered_fields[$field] = $fields["shipping"][$field];
		}

		$fields["shipping"] = $ordered_fields;
		return $fields;
	}

	public function crazyblog_override_woocommerce_widgets() {
		if ( class_exists( 'WC_Widget_Price_Filter' ) ) {
			unregister_widget( 'WC_Widget_Price_Filter' );
			include crazyblog_ROOT . 'woocommerce/widgets/class-wc-widget-price-filter.php';
			register_widget( 'crazyblog_Widget_Price_Filter' );
		}

		if ( class_exists( 'WC_Widget_Layered_Nav' ) ) {
			unregister_widget( 'WC_Widget_Layered_Nav' );
			include crazyblog_ROOT . 'woocommerce/widgets/class-wc-widget-layered-nav.php';
			register_widget( 'crazyblog_Widget_Layered_Nav' );
		}

		if ( class_exists( 'WC_Widget_Product_Categories' ) ) {
			unregister_widget( 'WC_Widget_Product_Categories' );
			include crazyblog_ROOT . 'woocommerce/widgets/class-wc-widget-product-categories.php';
			register_widget( 'crazyblog_Widget_Product_Categories' );
		}
	}

}

new crazyblog_Woocommerce;
