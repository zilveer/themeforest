<?php

if ( !defined( "crazyblog_DIR" ) )
	die( '!!!' );

class crazyblog_before_title_menu {

	public $title = 'Article Top Ad';
	public $icon = 'fa-th-large';

	public function crazyblog_menu() {
		$return = array(
			array(
				'type' => 'textarea',
				'name' => 'atAdCode',
				'label' => esc_html__( 'Your Article Top AD', 'crazyblog' ),
				'description' => esc_html__( 'Paste your ad code here. Google adsense will be made responsive automatically.', 'crazyblog' )
			),
			array(
				'name' => 'atenable_d',
				'label' => esc_html__( 'Enable On Desktop', 'crazyblog' ),
				'type' => 'toggle',
			),
			array(
				'type' => 'select',
				'name' => 'atd_size',
				'label' => esc_html__( 'AdSense Size', 'crazyblog' ),
				'items' => crazyblog_adSizes(),
				'dependency' => array(
					'field' => 'atenable_d',
					'function' => 'vp_dep_boolean',
				),
			),
			array(
				'name' => 'atenable_tl',
				'label' => esc_html__( 'Enable On Tablet Landscape', 'crazyblog' ),
				'type' => 'toggle',
			),
			array(
				'type' => 'select',
				'name' => 'attl_size',
				'label' => esc_html__( 'AdSense Size', 'crazyblog' ),
				'items' => crazyblog_adSizes(),
				'dependency' => array(
					'field' => 'atenable_tl',
					'function' => 'vp_dep_boolean',
				),
			),
			array(
				'name' => 'atenable_tp',
				'label' => esc_html__( 'Enable On Tablet Portrait', 'crazyblog' ),
				'type' => 'toggle',
			),
			array(
				'type' => 'select',
				'name' => 'attp_size',
				'label' => esc_html__( 'AdSense Size', 'crazyblog' ),
				'items' => crazyblog_adSizes(),
				'dependency' => array(
					'field' => 'atenable_tp',
					'function' => 'vp_dep_boolean',
				),
			),
			array(
				'name' => 'atenable_p',
				'label' => esc_html__( 'Enable On Phone', 'crazyblog' ),
				'description' => esc_html__( 'Google adsense requiers that you do not use big header ads on mobiles!', 'crazyblog' ),
				'type' => 'toggle',
			),
			array(
				'type' => 'select',
				'name' => 'atp_size',
				'label' => esc_html__( 'AdSense Size', 'crazyblog' ),
				'items' => crazyblog_adSizes(),
				'dependency' => array(
					'field' => 'atenable_p',
					'function' => 'vp_dep_boolean',
				),
			),
		);

		return apply_filters( 'crazyblog_vp_opt_articleTopAd_', $return );
	}

}
