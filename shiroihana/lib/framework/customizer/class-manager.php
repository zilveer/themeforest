<?php if ( ! defined( 'ABSPATH' ) ) {
	die( 'Cheatin&#8217; uh?' );
}
/**
 * Youxi Customize Manager Base Class
 *
 * This class provides the base class for themes to extend
 *
 * @package   Youxi Themes Customizer Controls
 * @author    Mairel Theafila <maimairel@gmail.com>
 * @copyright Copyright (c) 2014-2016, Mairel Theafila
 *
 * Changelog:
 *
 * 1.0 - 05/20/2015
 * - Initial release
 */

define( 'YOUXI_CUSTOMIZER_VERSION', '1.0' );

abstract class Youxi_Customize_Manager {

	/**
	 * Theme mod prefix
	 */
	private $prefix;

	/**
	 * Constructor
	 */
	public function __construct() {
		add_action( 'customize_register', array( $this, 'pre_customize' ));
	}
	
	public function prefix() {

		if( ! empty( $this->prefix ) ) {
			return $this->prefix;
		}
		
		$theme = wp_get_theme();
		return ( $this->prefix = preg_replace( '/\W/', '_', $theme->stylesheet ) . '_settings' );
	}

	public function pre_customize( $wp_customize ) {
		require 'controls/class-code-control.php';
		require 'controls/class-gallery-control.php';
		require 'controls/class-google-font-control.php';
		require 'controls/class-multicheck-control.php';
		require 'controls/class-range-control.php';
		require 'controls/class-repeater-control.php';
		require 'controls/class-sortable-control.php';
		require 'controls/class-switch-control.php';
		require 'controls/class-webfont-control.php';

		$wp_customize->register_control_type( 'Youxi_Customize_Repeater_Control' );
	}
}