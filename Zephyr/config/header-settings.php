<?php defined( 'ABSPATH' ) OR die( 'This script cannot be accessed directly.' );

/**
 * Header settings (used both by core and header builder plugin).
 * Options and elements' fields are described in USOF-style format.
 *
 * @var $config array Framework-based theme options config
 *
 * @return array Changed config
 */

unset( $config['options']['global']['shadow'] );

return $config;
