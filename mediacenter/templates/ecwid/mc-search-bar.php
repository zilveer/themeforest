<?php
/**
 * Search Bar
 *
 * @author      Ibrahim Ibn Dawood
 * @package     Templates/Sections
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if( class_exists('EcwidSearchWidget') ) {
	the_widget( 'EcwidSearchWidget' );
}