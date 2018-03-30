<?php

if ( !defined( "crazyblog_DIR" ) )
	die( '!!!' );

class crazyblog_View {

	private $_options;
	private $_custom_fonts;
	private static $_instance = null;
	private $_libraries = array();
	private $_scripts;
	private $_styles;
	private $_localize_script = array();

	function __construct() {
		add_action( 'admin_enqueue_scripts', array( __class__, "crazyblog_admin_enqueue_script" ) );
		$this->_options = (crazyblog_opt()) ? crazyblog_opt() : array();
		$this->_scripts = array(
			'df-bootstrap-min' => 'js/bootstrap.min.js',
			'df-enscroll' => 'js/enscroll-0.5.2.min.js',
			'df-init-isotope' => 'js/isotope-initialize.js',
			'df-isotope' => 'js/jquery.isotope.min.js',
			'df-poptrox' => 'js/jquery.poptrox.min.js',
			'df-scrolly' => 'js/jquery.scrolly.js',
			'df-owl' => 'js/owl.carousel.min.js',
			'df-select2' => 'js/select2.min.js',
			'df-slick' => 'js/slick.min.js',
			'df-script' => 'js/script.js',
			'df-countdown' => 'js/jquery.downCount.js',
			'df-bootstrap-number' => 'js/bootstrap-number-input.js',
			'df-userincr' => 'js/userincr.js',
			'df-magnific' => 'js/jquery.magnific-popup.min.js',
			'df-onscreen' => 'js/onscreen.js',
			'df-owl-initialization' => 'js/owl.initialization.js',
			'df-google-ad' => 'http://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js'
		);
		$this->_styles = array(
			'df-herrvon' => 'https://fonts.googleapis.com/css?family=Herr+Von+Muellerhoff',
			'df-Abril' => 'https://fonts.googleapis.com/css?family=Abril+Fatface',
			'df-bootstrap' => 'css/bootstrap.min.css',
			'df-icon' => 'css/icons.css',
			'df-fontawesome' => 'css/font-awesome.css',
			'df-select2' => 'css/select2.css',
			'magnific' => 'css/magnific-popup.css',
			'df-slick' => 'css/slick.css',
			'df-animate' => 'https://cdn.jsdelivr.net/animatecss/3.5.2/animate.min.css',
			'df-style' => 'css/style.css',
			'df-responsive' => 'css/responsive.css',
			'df-color' => 'css/color.css',
		);
		$rtl = array( 'df-rtl' => 'css/rtl.css' );
		if ( crazyblog_set( $this->_options, 'themeRtl' ) == '1' ) {
			$this->_styles = array_merge( $this->_styles, $rtl );
		}
	}

	static public function crazyblog_theme_google_fonts() {
		$fonts_url = '';

		$fonts = array(
			'Raleway' => 'Raleway:400,100,200,300,500,600,700,800,900',
			'Montserrat' => 'Montserrat:400,700',
			'Lato' => 'Lato:100,100italic,300,300italic,400,400italic,700,700italic,900,900italic',
			'Playfair' => 'Playfair+Display:400,400italic,700,700italic,900,900italic',
			'Cabin' => 'Cabin:400,400italic,500,500italic,600,600italic,700italic,700',
		);

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

	static public function static_url( $url = '' ) {
		if ( strpos( $url, 'http' ) === 0 )
			return $url;
		return crazyblog_URI . 'assets/' . ltrim( $url, '/' );
	}

	public function crazyblog_render_styles() {

		$google_theme_fonts = self::crazyblog_theme_google_fonts();
		if ( !empty( $google_theme_fonts ) ):
			wp_enqueue_style( 'crazyblog-theme-fonts', $google_theme_fonts, array(), '', 'all' );
		endif;

		$google_fonts = $this->crazyblog_heading_formating( false );
		if ( !empty( $google_fonts ) ):
			wp_enqueue_style( 'crazyblog-style-google-fonts', $google_fonts, array(), crazyblog_VERSION, 'all' );
		endif;

		if ( !empty( $this->_styles ) ) {
			foreach ( $this->_styles as $style => $item ) {
				wp_enqueue_style( 'crazyblog_' . $style, self::static_url( $item ), array(), crazyblog_VERSION, 'all' );
			}
		}
	}

	public function crazyblog_render_scripts() {
		if ( !empty( $this->_scripts ) ) {

			foreach ( $this->_scripts as $name => $item ) {
				wp_register_script( 'crazyblog_' . $name, self::static_url( $item ), array(), crazyblog_VERSION, true );
			}
			wp_enqueue_script( array( 'jquery', 'crazyblog_df-script' ) );

			if ( is_single() ) {
				wp_enqueue_script( array( 'comment-reply', 'crazyblog_df-magnific' ) );
			}


			$google_theme_fonts = $this->google_fonts( $this->_options, preg_grep( "/^(\w+)?\_font_face/", array_keys( $this->_options ) ) );
			if ( !empty( $google_theme_fonts ) ):
				wp_enqueue_style( 'crazyblog_theme-fonts', $google_theme_fonts, array(), crazyblog_VERSION, 'all' );
			endif;
		}

		if ( !empty( $this->_localize_script ) ) {
			foreach ( $this->_localize_script as $handle => $objects ) {
				foreach ( $objects as $object_name => $value ) {
					wp_localize_script( 'crazyblog_' . $handle, $object_name, $value );
				}
			}
		}
	}

	public function crazyblog_additional_head() {
		$settings = crazyblog_opt();
		$general_settings = $settings;

		$custom_script = 'if(theme_url === undefined) 
				var theme_url="' . crazyblog_URI . '";
			if(ajaxurl === undefined) 
				var ajaxurl="' . admin_url( 'admin-ajax.php' ) . '";';
		wp_add_inline_script( 'crazyblog_df-script', $custom_script );


		if ( is_single() ) {
			wp_enqueue_script( 'comment-reply' );
		}
		$this->crazyblog_heading_formating( 'false' );
	}

	public function crazyblog_color_scheme() {
		$settings = crazyblog_opt();
		$general = $settings;
		$custom_color = crazyblog_set( $general, 'custom_color_scheme' );
		$content = wp_remote_request( crazyblog_URI . 'assets/css/color.css' );
		$replace = str_replace( '#d82521', $custom_color, crazyblog_set( $content, 'body' ) );
		$replace = ( $custom_color ) ? $replace : crazyblog_set( $content, 'body' );
		return $replace;
	}

	static public function crazyblog_admin_render_styles() {
		global $post_type;
		if ( $post_type == 'crazyblog_forms' ) {
			wp_enqueue_style( 'admin-style', crazyblog_URI . 'assets/css/admin.css' );
		}
	}

	static public function crazyblog_boxed_layout() {
		$settings = crazyblog_opt();
		$opt = $settings;
		$background_style = '';
		if ( crazyblog_set( $opt, 'boxed_layout_status' ) && crazyblog_set( $opt, 'background_type' ) == 'image' ) {
			$background_style .='body{';
			$background_style .= 'background-image:url(' . crazyblog_set( $opt, 'background_image' ) . ') !important;';
			$background_style .= 'background-repeat:' . crazyblog_set( $opt, 'background_repeat' ) . ' !important;';

			$background_style .= 'background-attachment:' . crazyblog_set( $opt, 'background_attachment' ) . '  !important;';

			$background_style .= '}';
		}
		if ( crazyblog_set( $opt, 'boxed_layout_status' ) && crazyblog_set( $opt, 'background_type' ) == 'pattern' ) {
			$background_style .='body{';
			$background_style .= (crazyblog_set( $opt, 'patterns' ) != 'none') ? 'background-image:url(' . crazyblog_URI . 'core/duffers_panel/panel/public/img/patterns/' . crazyblog_set( $opt, 'patterns' ) . '.png);' : '';
			$background_style .= '}';
		}
		return $background_style;
	}

	public function library( $library, $object = true, $params = array() ) {
		if ( empty( $this->_libraries[$library] ) ) {
			if ( file_exists( crazyblog_ROOT . 'core/application/library/' . strtolower( $library ) . '.php' ) ) {
				$this->_libraries[$library] = 'crazyblog_' . $library;
				include crazyblog_ROOT . 'core/application/library/' . strtolower( $library ) . '.php';
			} else {
				return null;
			}
		}
		if ( $object ) {
			$library = 'crazyblog_' . $library;
			return (!empty( $params ) ? new $library( $params ) : new $library());
		}
	}

	public function crazyblog_enqueue_scripts( $scripts = array() ) {
		foreach ( $scripts as $script ) {
			wp_enqueue_script( 'crazyblog_' . $script );
		}
	}

	public function google_fonts( $options, $fonts = array() ) {

		if ( !$fonts || !is_array( $fonts ) )
			return '';
		$google_fonts = array();
		foreach ( $fonts as $f ) {
			$val = crazyblog_set( $options, $f );
			$style = crazyblog_set( $options, str_replace( '_font_family', '_font_style', $f ) );
			$style = ( $style ) ? ':' . $style : '';
			if ( $val )
				$google_fonts[$val] = str_replace( ' ', '+', $val . ':300,400,500,700' );
		}
		//printr($google_fonts);
		$custom_fonts = array();
		foreach ( $google_fonts as $name => $font ) {
			$string = sprintf( _x( 'on', '%s font: on or off', 'crazyblog' ), $name );
			if ( 'off' !== $string ) {
				$custom_fonts[] = $font;
			}
		}

		$query_args = array(
			'family' => urlencode( implode( '|', $custom_fonts ) ),
			'subset' => urlencode( 'latin,latin-ext' ),
		);
		$protocol = ( is_ssl() ) ? 'https' : 'http';
		if ( !empty( $custom_fonts ) ) {
			$fonts_url = add_query_arg( $query_args, $protocol . '://fonts.googleapis.com/css' );
			return esc_url_raw( $fonts_url );
		}
	}

	static public function crazyblog_admin_enqueue_script() {
		wp_enqueue_style( 'crazyblog-dashicons', crazyblog_URI . '/assets/css/dashicons.css', array(), crazyblog_VERSION, 'all' );
		wp_enqueue_script( 'df-sortable', crazyblog_URI . 'core/duffers_panel/panel/public/js/vendor/select2.sortable.js' );
		wp_enqueue_script( 'jquery-ui-sortable' );
		wp_enqueue_style( 'thickbox' );
		wp_enqueue_script( 'thickbox' );
		global $pagenow;
		wp_enqueue_style( 'crazyblog-vc-toggle', crazyblog_URI . 'assets/css/toggle.css' );
		if ( $pagenow == 'widgets.php' ) {
			wp_enqueue_script( 'crazyblog-widget', crazyblog_URI . 'assets/js/widget-script.js', null, null, true );
		}
	}

	public function crazyblog_heading_formating( $render_fonts = 'false' ) {
		$styles = crazyblog_heading_styles();
		$_font_ = array();
		if ( $render_fonts == false ) {
			$output = "\n";
			foreach ( $styles as $h => $style ):
				if ( $fn = $style['font_face'] )
					$_font_[$fn] = urlencode( $style['font_face'] ) . ':400, 300, 600, 700, 800';

				$output .= esc_html( $h ) . '{';
				$counter = 0;
				foreach ( $style as $key => $st ):
					if ( $counter == 0 ) {
						$output .= str_replace( 'font_face', 'font-family', $key ) . ':' . $st . '!important;';
					} elseif ( $counter == 1 ) {
						$output .= str_replace( 'font_', 'font-', $key ) . ':' . $st . '!important;';
					} elseif ( $counter == 2 ) {
						$output .= str_replace( 'font_', 'font-', $key ) . ':' . $st . '!important;';
					} elseif ( $counter == 4 ) {
						$output .= str_replace( 'font_', 'font-', $key ) . ':' . $st . 'px!important;';
					} elseif ( $counter == 5 ) {
						$output .= str_replace( 'line_', 'line-', $key ) . ':' . $st . 'px!important;';
					} else {
						$output .= str_replace( 'font_', '', $key ) . ':' . $st . '!important;';
					}
					$counter++;
				endforeach;
				$output .= '}' . "\n";
			endforeach;
			return $output;
		} elseif ( $render_fonts == 'true' ) {
			foreach ( $styles as $h => $style ):
				if ( $fn = $style['font_face'] ):
					$_font_[$fn] = $style['font_face'] . ':400, 300, 600, 700, 800';
				endif;
			endforeach;

			$custom_fonts = array();
			foreach ( $_font_ as $name => $font ) {
				$string = sprintf( _x( 'on', '%s font: on or off', 'crazyblog' ), $name );
				if ( 'off' !== $string ) {
					$custom_fonts[] = $font;
				}
			}
			$query_args = array(
				'family' => urlencode( implode( '|', $custom_fonts ) ),
				'subset' => urlencode( 'latin, latin-ext' ),
			);
			$protocol = ( is_ssl() ) ? 'https' : 'http';
			if ( !empty( $custom_fonts ) ) {
				$fonts_url = add_query_arg( $query_args, $protocol . '://fonts.googleapis.com/css' );
				return esc_url_raw( $fonts_url );
			}
		}
	}

	public function crazyblog_custom_styles( $replace = '' ) {

		$custom_style = crazyblog_set( $this->_options, 'header_css' );
		$custom_style .= $this->crazyblog_color_scheme();
		$custom_style .= self::crazyblog_boxed_layout();
		$custom_style .= $this->crazyblog_heading_formating( false );
		wp_add_inline_style( 'crazyblog_df-color', $custom_style );
	}

	static public function get_instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

}
