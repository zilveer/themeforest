<?php
/**
 * Jetpack
 */

class Listify_Jetpack extends listify_Integration {

	public function __construct() {
		$this->includes = array(
			'class-jetpack-share.php'
		);

		$this->integration = 'jetpack';

		parent::__construct();
	}

	public function setup_actions() {
		add_filter( 'option_wp_mobile_disable', '__return_false' );
		add_filter( 'jetpack_get_available_modules', array( $this, 'kill_photon' ) );
	}
 
	/**
	 * Disable the Jetpack Photon Module
	 *
	 * @see https://github.com/Automattic/WP-Job-Manager/issues/576
	 *
	 * @since 1.6.0
	 * @param array $modules
	 * @param array $modules
	 */
	public function kill_photon( $modules ) {
		unset( $modules[ 'photon' ] );

		return $modules;
	}
}

$GLOBALS[ 'listify_jetpack' ] = new Listify_Jetpack();