<?php
if ( ! defined( 'PGL' ) ) {
	die( 'Direct access fobidden' );
}

class PGL_Image {
	static $init_sizes = array(
		'post-thumbnail' => array(
			'w' => 630,
			'h' => '',
			'c' => TRUE
		),
		'main-slider' => array(
			'w' => 1440,
			'h' => 600,
			'c' => TRUE
		),
		'horizontal-slider-big-thumbnail' => array(
			'w' => 460,
			'h' => 460,
			'c' => TRUE
		),
		'horizontal-slider-small-thumbnail' => array(
			'w' => 220,
			'h' => 220,
			'c' => TRUE
		),

		'widget-admin-thumbnail' => array(
			'w' => 230,
			'h' => '',
			'c' => TRUE
		),

		'blog-list-medium' => array(
			'w' => '280',
			'h' => '166',
			'c' => TRUE
		),
		'blog-list-medium-2col' => array(
			'w' => '300',
			'h' => '',
			'c' => TRUE
		),
		'blog-list-fullwidth' => array(
			'w' => 940,
			'h' => 388,
			'c' => TRUE
		),
		'blog-list-fullwidth-2col' => array(
			'w' => 460,
			'h' => 190,
			'c' => TRUE
		)
	);

	public static function init() {
		//add_action('after_setup_theme', array('PGL_Image', '__add_image_size'));
        foreach ( self::$init_sizes as $key => $size ) {
            add_image_size( _PREFIX_ . $key, $size['w'], $size['h'], $size['c'] );
        }
	}

	static function __add_image_size() {
		foreach ( self::$init_sizes as $key => $size ) {
			add_image_size( _PREFIX_ . $key, $size['w'], $size['h'], $size['c'] );
		}
	}

	/**
	 * Translate the image size name
	 * @param $name
	 *
	 * @return string
	 */
	static function _size( $name ) {
		return _PREFIX_ . $name;
	}

	/**
	 * Return information about an thumbnail size
	 * @param $name
	 *
	 * @return mixed
	 */
	static function size( $name ) {
		global $_wp_additional_image_sizes;
		if ( ! PGL_Utilities::startsWith( $name, _PREFIX_ ) ) {
			$name = self::_size( $name );
		}
        return $_wp_additional_image_sizes[$name];
	}
}