<?php
/**
 * Tribe Events Customizer Options
 *
 * @package Total WordPress Theme
 * @subpackage Customizer
 * @version 3.3.3
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// General
$this->sections['wpex_tribe_events'] = array(
	'title' => esc_html__( 'Tribe Events', 'total' ),
	'settings' => array(
		array(
			'id' => 'tribe_events_archive_layout',
			'default' => 'full-width',
			'control' => array (
				'label' => esc_html__( 'Archives Layout', 'total' ),
				'type' => 'select',
				'choices' => $post_layouts,
			),
		),
		array(
			'id' => 'tribe_events_single_layout',
			'default' => 'full-width',
			'control' => array (
				'label' => esc_html__( 'Single Layout', 'total' ),
				'type' => 'select',
				'choices' => $post_layouts,
			),
		),
	),
);