<?php

if (!class_exists('MAD_AJAX_SEARCH_MOD')) {

	class MAD_AJAX_SEARCH_MOD extends MAD_PLUGINS_CONFIG {

		function __construct() {

			if ( !defined( 'YITH_WCAS' ) ) { return; }

			if ( ! defined( 'MAD_ASSETS_IMAGES_URL' ) ) {
				define( 'MAD_ASSETS_IMAGES_URL', MAD_BASE_URI. 'images/' );
			}

			add_action('wp_enqueue_scripts', array(&$this, 'ajax_search_enqueue_styles_scripts'), 1);
		}

		public function ajax_search_enqueue_styles_scripts() {
			$basedir = basename(dirname(__FILE__));
			$frontend_css = self::assetExtendUrl('css/yith_wcas_ajax_search.css', $basedir);
			wp_deregister_style('yith_wcas_frontend');
			wp_enqueue_style( 'yith_wcas_frontend', $frontend_css );

		}

	}

}