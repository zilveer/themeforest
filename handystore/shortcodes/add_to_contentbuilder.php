<?php

require_once(trailingslashit( get_template_directory() ).'shortcodes/builder_shortcodes/recent_posts/recent_posts.php');
require_once(trailingslashit( get_template_directory() ).'shortcodes/builder_shortcodes/carousel/carousel.php');
require_once(trailingslashit( get_template_directory() ).'shortcodes/builder_shortcodes/banner/banner.php');
require_once(trailingslashit( get_template_directory() ).'shortcodes/builder_shortcodes/woo_codes/woo_codes.php');
require_once(trailingslashit( get_template_directory() ).'shortcodes/builder_shortcodes/salesCarousel/salescarousel.php');
require_once(trailingslashit( get_template_directory() ).'shortcodes/builder_shortcodes/contact/contact.php');
require_once(trailingslashit( get_template_directory() ).'shortcodes/builder_shortcodes/testimonials/testimonials.php');
require_once(trailingslashit( get_template_directory() ).'shortcodes/builder_shortcodes/pricing/pricing.php');
require_once(trailingslashit( get_template_directory() ).'shortcodes/builder_shortcodes/circle_bar/circle_bar.php');
require_once(trailingslashit( get_template_directory() ).'shortcodes/builder_shortcodes/vendors_carousel/vendors_carousel.php');


add_action( 'ig_pb_addon', 'pt_pb_sc_init' );

function pt_pb_sc_init(){

	class PT_Shortcodes extends IG_Pb_Addon {

		public function __construct() {

			// setup information
			$this->set_provider(
				array(
					'name' => 'Themes Zone',
					'file' => __FILE__,
					'shortcode_dir' => 'builder_shortcodes',
					
				)
			);

			//$this->custom_assets();

			// call parent construct
			parent::__construct();
		}

		// regiter & enqueue custom assets
		public function custom_assets() {
			// register custom assets
			$this->set_assets_register(
				array(
					'ig-frontend-free-css' => array(
						'src' => plugins_url( 'assets/css/main.css' , dirname( __FILE__ ) ),
						'ver' => '1.0.0',
					),
					'ig-frontend-free-js' => array(
						'src' => plugins_url( 'assets/js/main.js' , dirname( __FILE__ ) ),
						'ver' => '1.0.0',
					)
				)
			);
			// enqueue assets for Admin pages
			$this->set_assets_enqueue_admin( array( 'ig-frontend-free-css' ) );
			// enqueue assets for Modal setting iframe
			$this->set_assets_enqueue_modal( array( 'ig-frontend-free-js' ) );
			// enqueue assets for Frontend
			$this->set_assets_enqueue_frontend( array( 'ig-frontend-free-css', 'ig-frontend-free-js' ) );
		}
	}
	$this_ = new PT_Shortcodes();
	
}