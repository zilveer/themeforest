<?php defined( 'ABSPATH' ) OR die( 'This script cannot be accessed directly.' );

/**
 * Theme's Widgets config
 *
 * @var $config array Framework-based widgets config
 *
 * @return array Changed config
 */

// Two more options for social icons widget
$config['us_socials']['params']['color']['value'] += array(
	__( 'Colored Inverted', 'us' ) => 'colored_inv',
	__( 'Desaturated Inverted', 'us' ) => 'desaturated_inv',
);

unset( $config['us_contacts'] );

return $config;
