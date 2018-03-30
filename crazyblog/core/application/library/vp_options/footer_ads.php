<?php

if ( !defined( "crazyblog_DIR" ) )
	die( '!!!' );

class crazyblog_footer_ads_menu {

	public $title = 'Footer Ad';
	public $icon = 'fa-th-large';

	public function crazyblog_menu() {
		$return = array(
			array(
				'type' => 'textarea',
				'name' => 'fAdCode',
				'label' => esc_html__( 'Your Footer AD', 'crazyblog' ),
				'description' => esc_html__( 'Paste your ad code here. Google adsense will be made responsive automatically.', 'crazyblog' )
			),
			array(
				'name' => 'fenable_d',
				'label' => esc_html__( 'Enable On Desktop', 'crazyblog' ),
				'type' => 'toggle',
			),
			array(
				'type' => 'select',
				'name' => 'fd_size',
				'label' => esc_html__( 'AdSense Size', 'crazyblog' ),
				'items' => crazyblog_adSizes(),
				'dependency' => array(
					'field' => 'fenable_d',
					'function' => 'vp_dep_boolean',
				),
			),
			array(
				'name' => 'fenable_tl',
				'label' => esc_html__( 'Enable On Tablet Landscape', 'crazyblog' ),
				'type' => 'toggle',
			),
			array(
				'type' => 'select',
				'name' => 'ftl_size',
				'label' => esc_html__( 'AdSense Size', 'crazyblog' ),
				'items' => crazyblog_adSizes(),
				'dependency' => array(
					'field' => 'fenable_tl',
					'function' => 'vp_dep_boolean',
				),
			),
			array(
				'name' => 'fenable_tp',
				'label' => esc_html__( 'Enable On Tablet Portrait', 'crazyblog' ),
				'type' => 'toggle',
			),
			array(
				'type' => 'select',
				'name' => 'ftp_size',
				'label' => esc_html__( 'AdSense Size', 'crazyblog' ),
				'items' => crazyblog_adSizes(),
				'dependency' => array(
					'field' => 'fenable_tp',
					'function' => 'vp_dep_boolean',
				),
			),
			array(
				'name' => 'fenable_p',
				'label' => esc_html__( 'Enable On Phone', 'crazyblog' ),
				'description' => esc_html__( 'Google adsense requiers that you do not use big header ads on mobiles!', 'crazyblog' ),
				'type' => 'toggle',
			),
			array(
				'type' => 'select',
				'name' => 'fp_size',
				'label' => esc_html__( 'AdSense Size', 'crazyblog' ),
				'items' => crazyblog_adSizes(),
				'dependency' => array(
					'field' => 'fenable_p',
					'function' => 'vp_dep_boolean',
				),
			),
		);

		return apply_filters( 'crazyblog_vp_opt_footerAd_', $return );
	}

}
