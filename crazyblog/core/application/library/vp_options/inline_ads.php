<?php

if ( !defined( "crazyblog_DIR" ) )
	die( '!!!' );

class crazyblog_inline_ads_menu {

	public $title = 'Article Inline Ad';
	public $icon = 'fa-th-large';

	public function crazyblog_menu() {
		$return = array(
			array(
				'type' => 'textarea',
				'name' => 'aiAdCode',
				'label' => esc_html__( 'Your Article Inline AD', 'crazyblog' ),
				'description' => esc_html__( 'Paste your ad code here. Google adsense will be made responsive automatically.', 'crazyblog' )
			),
			array(
				'type' => 'textbox',
				'name' => 'aiparagraph',
				'label' => esc_html__( 'After Paragraph', 'crazyblog' ),
				'description' => esc_html__( 'After how many paragraphs the ad will display. The theme will analyze the content of each post and it will inject an ad after the selected number of paragraphs', 'crazyblog' )
			),
			array(
				'type' => 'select',
				'name' => 'aipos',
				'label' => esc_html__( 'Ad Position In Content', 'crazyblog' ),
				'description' => esc_html__( 'Ad position in content. Float left, full post width or float right.', 'crazyblog' ),
				'items' => array(
					array( 'value' => 'left', 'label' => esc_html__( 'Left', 'crazyblog' ) ),
					array( 'value' => 'center', 'label' => esc_html__( 'Center', 'crazyblog' ) ),
					array( 'value' => 'right', 'label' => esc_html__( 'Right', 'crazyblog' ) ),
				)
			),
			array(
				'name' => 'aienable_d',
				'label' => esc_html__( 'Enable On Desktop', 'crazyblog' ),
				'type' => 'toggle',
			),
			array(
				'type' => 'select',
				'name' => 'aid_size',
				'label' => esc_html__( 'AdSense Size', 'crazyblog' ),
				'items' => crazyblog_adSizes(),
				'dependency' => array(
					'field' => 'aienable_d',
					'function' => 'vp_dep_boolean',
				),
			),
			array(
				'name' => 'aienable_tl',
				'label' => esc_html__( 'Enable On Tablet Landscape', 'crazyblog' ),
				'type' => 'toggle',
			),
			array(
				'type' => 'select',
				'name' => 'aitl_size',
				'label' => esc_html__( 'AdSense Size', 'crazyblog' ),
				'items' => crazyblog_adSizes(),
				'dependency' => array(
					'field' => 'aienable_tl',
					'function' => 'vp_dep_boolean',
				),
			),
			array(
				'name' => 'aienable_tp',
				'label' => esc_html__( 'Enable On Tablet Portrait', 'crazyblog' ),
				'type' => 'toggle',
			),
			array(
				'type' => 'select',
				'name' => 'aitp_size',
				'label' => esc_html__( 'AdSense Size', 'crazyblog' ),
				'items' => crazyblog_adSizes(),
				'dependency' => array(
					'field' => 'aienable_tp',
					'function' => 'vp_dep_boolean',
				),
			),
			array(
				'name' => 'aienable_p',
				'label' => esc_html__( 'Enable On Phone', 'crazyblog' ),
				'description' => esc_html__( 'Google adsense requiers that you do not use big header ads on mobiles!', 'crazyblog' ),
				'type' => 'toggle',
			),
			array(
				'type' => 'select',
				'name' => 'aip_size',
				'label' => esc_html__( 'AdSense Size', 'crazyblog' ),
				'items' => crazyblog_adSizes(),
				'dependency' => array(
					'field' => 'aienable_p',
					'function' => 'vp_dep_boolean',
				),
			),
		);

		return apply_filters( 'crazyblog_vp_opt_articleInlineAd_', $return );
	}

}
