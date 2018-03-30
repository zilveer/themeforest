<?php

class _WST_UpdateEnqueue {

	static public function _wst_pluginPage() {
		include crazyblog_ROOT . 'core/application/library/update/templates/tpl-extensions.php';
	}

	static public function _wst_css() {
		add_action( 'admin_enqueue_scripts', array( __CLASS__, '_wst_admin_css' ) );
	}

	static public function _wst_js() {
		add_action( 'admin_enqueue_scripts', array( __CLASS__, '_wst_admin_js' ) );
	}

	static public function _wst_demoCss() {
		add_action( 'admin_enqueue_scripts', array( __CLASS__, '_wst_admin_demo_css' ) );
	}

	static public function _wst_demoJs() {
		add_action( 'admin_enqueue_scripts', array( __CLASS__, '_wst_admin_demo_js' ) );
	}

	static public function _wst_admin_css() {
		$googleFonts = array(
			'Poppins' => 'Poppins:400,300,500,600,700',
			'Roboto' => 'Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic',
			'Lato' => 'Lato:400,100,100italic,300,300italic,400italic,700,700italic,900,900italic'
		);
		$styles = array(
			'extension-style' => 'css/extension-style.css',
			'extension-responsive' => 'css/extension-responsive.css'
		);
		wp_enqueue_style( 'wst_extension_google_fount', self::_wst_google_founts( $googleFonts ) );
		foreach ( $styles as $name => $style ) {
			$file = crazyblog_URI . 'core/application/library/update/assets/' . $style;
			wp_enqueue_style( 'wst-' . $name, $file, array(), '', 'all' );
		}
	}

	static public function _wst_admin_js() {
		echo '<script type="text/javascript"> var ajax_url="' . admin_url( 'admin-ajax.php' ) . '";</script>';
		echo '<script type="text/javascript"> var activeText="' . esc_html__( 'Activated', 'crazyblog' ) . '";</script>';
		$scripts = array(
			'extension_scripts' => 'js/extension_scripts.js'
		);
		foreach ( $scripts as $name => $script ) {
			$file = crazyblog_URI . 'core/application/library/update/assets/' . $script;
			wp_register_script( 'wst_' . $name, $file, array( 'jquery' ), '', true );
		}
		wp_enqueue_script( array( 'wst_extension_scripts' ) );
	}

	static public function _wst_admin_demo_css() {
		$googleFonts = array(
			'Poppins' => 'Poppins:400,300,500,600,700',
			'Roboto' => 'Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic',
			'Lato' => 'Lato:400,100,100italic,300,300italic,400italic,700,700italic,900,900italic'
		);
		$styles = array(
			'demo-style' => 'css/demo-style.css',
			'demo-responsive' => 'css/demo-responsive.css'
		);
		wp_enqueue_style( 'wst_extension_google_fount', self::_wst_google_founts( $googleFonts ) );
		foreach ( $styles as $name => $style ) {
			$file = crazyblog_URI . 'core/application/library/update/assets/' . $style;
			wp_enqueue_style( 'wst-' . $name, $file, array(), '', 'all' );
		}
	}

	static public function _wst_admin_demo_js() {
		echo '<script type="text/javascript"> var ajax_url="' . admin_url( 'admin-ajax.php' ) . '";</script>';
		$scripts = array(
			'demp_scripts' => 'js/demo_scripts.js'
		);
		foreach ( $scripts as $name => $script ) {
			$file = crazyblog_URI . 'core/application/library/update/assets/' . $script;
			wp_register_script( 'wst_' . $name, $file, array( 'jquery' ), '', true );
		}
		wp_enqueue_script( array( 'wst_demp_scripts' ) );
	}

	static public function _wst_google_founts( $fonts = array() ) {
		$fonts_url = '';
		if ( $fonts ) {
			$font_families = array();
			foreach ( $fonts as $name => $font ) {
				$string = sprintf( _x( 'on', '%s font: on or off', 'crazyblog' ), $name );
				if ( 'off' !== $string ) {
					$font_families[] = $font;
				}
			}
			$query_args = array(
				'family' => urlencode( implode( '|', $font_families ) ),
				'subset' => urlencode( 'latin,latin-ext' ),
			);
			$protocol = ( is_ssl() ) ? 'https' : 'http';
			$fonts_url = add_query_arg( $query_args, $protocol . '://fonts.googleapis.com/css' );
		}
		return esc_url_raw( $fonts_url );
	}

	static public function _wst_adminEnqueue() {
		wp_enqueue_script( 'admin-update-script', crazyblog_URI . 'core/application/library/update/assets/js/admin.js', array( 'jquery' ) );
		wp_enqueue_style( 'admin-update-style', crazyblog_URI . 'core/application/library/update/assets/css/admin.css' );
	}

}
