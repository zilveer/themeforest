<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

global $vc_manager;

if ( ! $vc_manager || ! isset( $atts['type'] ) || $atts['type'] !== 'vc_default' ) {
	include 'dt_vc_row.php';
} else {
	include trailingslashit( $vc_manager->getDefaultShortcodesTemplatesDir() ) . 'vc_row.php';
}
