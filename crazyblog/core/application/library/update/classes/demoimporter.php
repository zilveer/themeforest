<?php

class _WST_DemoImporter {

	static $page;

	static public function _wst_init() {
		add_action( 'admin_menu', array( __CLASS__, '_wst_registerDemoPage' ) );
	}

	static public function _wst_registerDemoPage() {
		self::$page = add_theme_page( esc_html__( 'Demo\'s Importer', 'crazyblog' ), esc_html__( 'Demo\'s Importer', 'crazyblog' ), 'manage_options', 'webinane-demo-importer', array( __CLASS__, '_wst_pageContent' ) );
		add_action( 'load-' . self::$page, array( '_WST_UpdateEnqueue', '_wst_demoCss' ) );
		add_action( 'load-' . self::$page, array( '_WST_UpdateEnqueue', '_wst_demoJs' ) );
	}

	static public function _wst_pageContent() {
		include crazyblog_ROOT . 'core/application/library/update/templates/tpl-demo.php';
	}

}
