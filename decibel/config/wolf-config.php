<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * You can overwrite the constants from the define_config_constants function in the wp-wolf-framework/wolf-core.php file
 *
 * However, it is recommended to overwrite the configuration constant in a child theme functions.php file
 */

if ( ! defined( 'WOLF_ENABLE_IMPORTER' ) ) {
	define( 'WOLF_ENABLE_IMPORTER', true );
}

if ( ! defined( 'WOLF_ENABLE_OPTIONS_EXPORTER' ) ) {
	define( 'WOLF_ENABLE_OPTIONS_EXPORTER', false );
}