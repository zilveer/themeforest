<?php

if ( !defined( "crazyblog_DIR" ) )
	die( '!!!' );

class crazyblog_Plugins {

	public function crazyblog_plugin_list() {

		return array(
			array(
				'name' => esc_html__( 'Visual Composer', 'crazyblog' ),
				'slug' => 'js_composer',
				'source' => '', //crazyblog_ROOT . 'core/application/library/tgm/plugins/js_composer.zip',
				'required' => true,
				'version' => '4.12',
				'force_activation' => false,
				'force_deactivation' => false,
				'external_url' => 'http://wpbakery.com/',
				'file_path' => ABSPATH . 'wp-content/plugins/js_composer/js_composer.php',
				'img_url' => crazyblog_URI . 'core/application/library/update/assets/images/vc.png',
				'bg_url' => crazyblog_URI . 'core/application/library/update/assets/images/vc-bg.jpg',
				'plugin_author' => 'Michael M',
				'plugin_desc' => esc_html__( 'Drag and drop page builder for WordPress. Take full control over your WordPress site, build any layout you can imagine &#45; no programming knowledge required.', 'crazyblog' )
			),
			array(
				'name' => esc_html__( 'Revolution Slider', 'crazyblog' ),
				'slug' => 'revslider',
				'source' => '', //crazyblog_ROOT . 'core/application/library/tgm/plugins/revslider.zip',
				'required' => true,
				'version' => '5.2.5.4',
				'force_activation' => true,
				'force_deactivation' => true,
				'external_url' => 'http://www.revolution.themepunch.com/',
				'file_path' => ABSPATH . 'wp-content/plugins/revslider.php',
				'img_url' => crazyblog_URI . 'core/application/library/update/assets/images/rev.png',
				'bg_url' => crazyblog_URI . 'core/application/library/update/assets/images/rev-bg.jpg',
				'plugin_author' => 'ThemePunch',
				'plugin_desc' => esc_html__( 'Slider Revolution - Premium responsive slider', 'crazyblog' )
			),
			array(
				'name' => esc_html__( 'CrazyBlog Custom Plugin', 'crazyblog' ),
				'slug' => 'crazyblog-custom-plugin',
				'source' => '', // crazyblog_ROOT . 'core/application/library/tgm/plugins/crazyblog-custom-plugin.zip',
				'required' => true,
				'version' => '1.0',
				'force_activation' => true,
				'force_deactivation' => true,
				'external_url' => 'http://www.wpstores.net',
				'file_path' => ABSPATH . 'wp-content/plugins/crazyblog-custom-plugin.zip',
				'img_url' => crazyblog_URI . 'core/application/library/update/assets/images/cus.png',
				'bg_url' => crazyblog_URI . 'core/application/library/update/assets/images/cus-bg.jpg',
				'plugin_author' => 'Webinane',
				'plugin_desc' => esc_html__( 'This plugin only work with Crazyblog theme.', 'crazyblog' )
			),
			array(
				'name' => esc_html__( 'WooCommerce WP', 'crazyblog' ),
				'slug' => 'woocommerce',
				'required' => false,
				'repo' => true,
				'img_url' => crazyblog_URI . 'core/application/library/update/assets/images/woo.png',
				'bg_url' => crazyblog_URI . 'core/application/library/update/assets/images/woo-bg.jpg',
				'plugin_author' => 'WooThemes',
				'plugin_desc' => esc_html__( 'An e-commerce toolkit that helps you sell anything beautifully.', 'crazyblog' )
			),
		);
	}

	public function _wst_extensionInfo() {
		return array(
			'title' => esc_html__( 'Extensions', 'crazyblog' ),
			'desc' => esc_html__( 'Custom and third party plugins you can use for free (over $1,000 in value) with updates!', 'crazyblog' )
		);
	}

}
