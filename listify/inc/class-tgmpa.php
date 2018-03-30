<?php

class Listify_TGMPA {

	public function __construct() {
		if ( ! class_exists( 'TGM_Plugin_Activation' ) ) {
			require_once( get_template_directory() . '/inc/class-tgm-plugin-activation.php' );
		}

		add_action( 'tgmpa_register', array( $this, 'tgmpa_register' ), 20 );
	}

	public function tgmpa_register() {
		$plugins = array(
			array(
				'name'      => 'WP Job Manager',
				'slug'      => 'wp-job-manager',
				'required'  => true
			),
			array(
				'name'      => 'WooCommerce',
				'slug'      => 'woocommerce',
				'required'  => true
			),
			array(
				'name'      => 'WP Job Manager - Predefined Regions',
				'slug'      => 'wp-job-manager-locations',
				'required'  => false
			),
			array(
				'name'      => 'WP Job Manager - Contact Listing',
				'slug'      => 'wp-job-manager-contact-listing',
				'required'  => false
			),
			array(
				'name'      => 'Ninja Forms',
				'slug'      => 'ninja-forms',
				'required'  => false
			),
			array(
				'name'      => 'Nav Menu Roles',
				'slug'      => 'nav-menu-roles',
				'required'  => false
			),
		);

		$config = array(
			'id' => 'listify',
			'has_notices' => false,
			'parent_slug' => Astoundify_Setup_Guide::get_page_id(),
			'is_automatic' => true
		);

		tgmpa( $plugins, $config );
	}

}

$GLOBALS[ 'listify_tgmpa' ] = new Listify_TGMPA();
