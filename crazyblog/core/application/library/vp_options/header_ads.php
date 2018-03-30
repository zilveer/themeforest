<?php

if ( !defined( "crazyblog_DIR" ) )
	die( '!!!' );

class crazyblog_header_ads_menu {

	public $title = 'Header Ad';
	public $icon = 'fa-th-large';

	public function crazyblog_menu() {
		$return = array(
			array(
				'type' => 'textarea',
				'name' => 'hAdCode',
				'label' => esc_html__( 'Your Header AD', 'crazyblog' ),
				'description' => esc_html__( 'Paste your ad code here. Google adsense will be made responsive automatically. "Note: This will work only Header One" ', 'crazyblog' )
			),
			array(
				'name' => 'henable_d',
				'label' => esc_html__( 'Enable On Desktop', 'crazyblog' ),
				'type' => 'toggle',
			),
			array(
				'type' => 'select',
				'name' => 'hd_size',
				'label' => esc_html__( 'AdSense Size', 'crazyblog' ),
				'items' => crazyblog_adSizes(),
				'dependency' => array(
					'field' => 'henable_d',
					'function' => 'vp_dep_boolean',
				),
			),
			array(
				'name' => 'henable_tl',
				'label' => esc_html__( 'Enable On Tablet Landscape', 'crazyblog' ),
				'type' => 'toggle',
			),
			array(
				'type' => 'select',
				'name' => 'htl_size',
				'label' => esc_html__( 'AdSense Size', 'crazyblog' ),
				'items' => crazyblog_adSizes(),
				'dependency' => array(
					'field' => 'henable_tl',
					'function' => 'vp_dep_boolean',
				),
			),
			array(
				'name' => 'henable_tp',
				'label' => esc_html__( 'Enable On Tablet Portrait', 'crazyblog' ),
				'type' => 'toggle',
			),
			array(
				'type' => 'select',
				'name' => 'htp_size',
				'label' => esc_html__( 'AdSense Size', 'crazyblog' ),
				'items' => crazyblog_adSizes(),
				'dependency' => array(
					'field' => 'henable_tp',
					'function' => 'vp_dep_boolean',
				),
			),
			array(
				'name' => 'henable_p',
				'label' => esc_html__( 'Enable On Phone', 'crazyblog' ),
				'description' => esc_html__( 'Google adsense requiers that you do not use big header ads on mobiles!', 'crazyblog' ),
				'type' => 'toggle',
			),
			array(
				'type' => 'select',
				'name' => 'hp_size',
				'label' => esc_html__( 'AdSense Size', 'crazyblog' ),
				'items' => crazyblog_adSizes(),
				'dependency' => array(
					'field' => 'henable_p',
					'function' => 'vp_dep_boolean',
				),
			),
		);

		return apply_filters( 'crazyblog_vp_opt_headerAd_', $return );
	}

}
