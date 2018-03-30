<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

$wolf_theme_options[] = array( 'type' => 'open' ,  'label' => __( 'Woocommerce', 'wolf'  ) );

	$wolf_theme_options[] = array(
		'label' => __( 'Woocommerce', 'wolf' ),
		'type' => 'section_open',
	);

		$wolf_theme_options[] =array(
			'label' => __( 'Woocommerce layout', 'wolf' ),
			'id' => 'woocommerce_layout',
			'type' => 'select',
			'options' => array(
				'sidebar' => __( 'Sidebar', 'wolf' ),
				'full' => __( 'Full width', 'wolf' ),
			),
		);

		$wolf_theme_options[] =array(
			'label' => __( 'Products per page', 'wolf' ),
			'id' => 'products_per_page',
			'type' => 'int',
		);

	$wolf_theme_options[] = array( 'type' => 'section_close' );


$wolf_theme_options[] = array( 'type' => 'close' );