<?php

if ( !defined( "crazyblog_DIR" ) )
	die( '!!!' );

class crazyblog_after_title_menu {

	public $title = 'Article Bottom Ad';
	public $icon = 'fa-th-large';

	public function crazyblog_menu() {
		$return = array(
			array(
				'type' => 'textarea',
				'name' => 'abAdCode',
				'label' => esc_html__( 'Your Article Bottom AD', 'crazyblog' ),
				'description' => esc_html__( 'Paste your ad code here. Google adsense will be made responsive automatically.', 'crazyblog' )
			),
			array(
				'name' => 'abenable_d',
				'label' => esc_html__( 'Enable On Desktop', 'crazyblog' ),
				'type' => 'toggle',
			),
			array(
				'type' => 'select',
				'name' => 'abd_size',
				'label' => esc_html__( 'AdSense Size', 'crazyblog' ),
				'items' => crazyblog_adSizes(),
				'dependency' => array(
					'field' => 'abenable_d',
					'function' => 'vp_dep_boolean',
				),
			),
			array(
				'name' => 'abenable_tl',
				'label' => esc_html__( 'Enable On Tablet Landscape', 'crazyblog' ),
				'type' => 'toggle',
			),
			array(
				'type' => 'select',
				'name' => 'abtl_size',
				'label' => esc_html__( 'AdSense Size', 'crazyblog' ),
				'items' => crazyblog_adSizes(),
				'dependency' => array(
					'field' => 'abenable_tl',
					'function' => 'vp_dep_boolean',
				),
			),
			array(
				'name' => 'abenable_tp',
				'label' => esc_html__( 'Enable On Tablet Portrait', 'crazyblog' ),
				'type' => 'toggle',
			),
			array(
				'type' => 'select',
				'name' => 'abtp_size',
				'label' => esc_html__( 'AdSense Size', 'crazyblog' ),
				'items' => crazyblog_adSizes(),
				'dependency' => array(
					'field' => 'abenable_tp',
					'function' => 'vp_dep_boolean',
				),
			),
			array(
				'name' => 'abenable_p',
				'label' => esc_html__( 'Enable On Phone', 'crazyblog' ),
				'description' => esc_html__( 'Google adsense requiers that you do not use big header ads on mobiles!', 'crazyblog' ),
				'type' => 'toggle',
			),
			array(
				'type' => 'select',
				'name' => 'abp_size',
				'label' => esc_html__( 'AdSense Size', 'crazyblog' ),
				'items' => crazyblog_adSizes(),
				'dependency' => array(
					'field' => 'abenable_p',
					'function' => 'vp_dep_boolean',
				),
			),
		);

		return apply_filters( 'crazyblog_vp_opt_articalbottomAd_', $return );
	}

}
