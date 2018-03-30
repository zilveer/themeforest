<?php
/**
 * WooCommerce - Bookings 
 */

class Listify_WooCommerce_Bookings extends Listify_Integration {

	public function __construct() {
		if ( ! class_exists( 'WP_Job_Manager_Products' ) ) {
			return;
		}

		$this->integration = 'woocommerce-bookings';

		$this->includes = array(

		);

		parent::__construct();
	}

	public function setup_actions() {
		add_action( 'widgets_init', array( $this, 'widgets_init' ) );
		add_action( 'listify_output_customizer_css', array( $this, 'booking_form_styles' ) );

		$wpjmp = WPJMP();

		remove_action( 'single_job_listing_end', array( $wpjmp->products, 'listing_display_products' ) );
	}

	/**
	 * Custom styles for the Booking form based on the Customizer settings.
	 *
	 * @since 1.7.0
	 * @return void
	 */
	public function booking_form_styles() {
        $body_text_color = listify_theme_color( 'color-body-text' );

        Listify_Customizer_CSS::add( array(
            'selectors' => array(
				'#wc-bookings-booking-form label',
				'#wc-bookings-booking-form .wc-bookings-date-picker .ui-datepicker-header',
				'#wc-bookings-booking-form .wc-bookings-date-picker .ui-datepicker td.bookable a',
				'#wc-bookings-booking-form .wc-bookings-date-picker .ui-datepicker td.bookable span'
            ),
            'declarations' => array(
                'color' => esc_attr( $body_text_color ) . ' !important'
            )
        ) );

		if ( ! in_array( get_theme_mod( 'color-scheme' ), array( 'ultra-dark' ) ) ) {
			Listify_Customizer_CSS::add( array(
				'selectors' => array(
					'.listify_widget_panel_listing_bookings .price .amount'
				),
				'declarations' => array(
					'color' => esc_attr( Listify_Customizer_CSS::darken( $body_text_color, -20 ) ) . ' !important'
				)
			) );
		}

        $primary = listify_theme_color( 'color-primary' );

        Listify_Customizer_CSS::add( array(
            'selectors' => array(
				'#wc-bookings-booking-form .wc-bookings-date-picker .ui-datepicker td.ui-datepicker-current-day a',
				'#wc-bookings-booking-form .wc-bookings-date-picker .ui-datepicker td.bookable-range .ui-state-default'
            ),
            'declarations' => array(
				'color' => '#ffffff !important',
                'background-color' => esc_attr( $primary ) . ' !important'
            )
        ) );
	}

	public function widgets_init() {
		$widgets = array(
			'job_listing-bookings.php'
		);

		foreach ( $widgets as $widget ) {
			include_once( listify_Integration::get_dir() . 'widgets/class-widget-' . $widget );
		}

		register_widget( 'Listify_Widget_Listing_Bookings' );
	}

	public function get_bookable_products( $post_id ) {
		$products = get_post_meta( $post_id, '_products', true );
		
		if ( ! $products ) {
			return;
		}

		$_products = array();

		foreach ( $products as $product ) {
			$product = get_product( $product );

			if ( ! $product ) {
				continue;
			}

			if ( ! in_array( $product->product_type, array( 'booking', 'accommodation-booking' ) ) ) {
				continue;
			}

			$_products[] = $product;
		}

		if ( empty( $_products ) ) {
			return false;
		}

		return $_products;
	}
}

$GLOBALS[ 'listify_woocommerce_bookings' ] = new Listify_WooCommerce_Bookings();
