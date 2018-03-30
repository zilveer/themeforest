<?php
defined( 'ABSPATH' ) || exit;

/* Light Meta Box - http://www.deluxeblogtips.com */

// Script version, used to add version for scripts and styles
define( 'RWMB_VER', '4.3.6' );

// Define plugin URLs, for fast enqueuing scripts and styles
if ( ! defined( 'RWMB_URL' ) ) define( 'RWMB_URL', plugin_dir_url( __FILE__ ) );
define( 'RWMB_JS_URL', trailingslashit( RWMB_URL . 'js' ) );
define( 'RWMB_CSS_URL', trailingslashit( RWMB_URL . 'css' ) );

// Plugin paths, for including files
if ( ! defined( 'RWMB_DIR' ) ) define( 'RWMB_DIR', plugin_dir_path( __FILE__ ) );
define( 'RWMB_INC_DIR', trailingslashit( RWMB_DIR . 'inc' ) );
define( 'RWMB_FIELDS_DIR', trailingslashit( RWMB_INC_DIR . 'fields' ) );

// Helper function to retrieve meta value
require_once RWMB_INC_DIR . 'helpers.php';

if ( is_admin() ) {
	foreach ( glob( RWMB_FIELDS_DIR . '*.php' ) as $file ) {
		require_once $file;
	}
	require_once RWMB_INC_DIR . 'meta-box.php';

	function rwmb_register_meta_boxes() {
		$meta_boxes = apply_filters( 'rwmb_meta_boxes', array() );
		foreach ( $meta_boxes as $meta_box ) {
			new RW_Meta_Box( $meta_box );
		}
	}
	add_action( 'admin_init', 'rwmb_register_meta_boxes' );
}
