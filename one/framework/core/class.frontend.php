<?php if( !defined('THB_FRAMEWORK_NAME') ) exit('No direct script access allowed.');

/**
 * Frontend class.
 *
 * This class is entitled to manage the theme frontend.
 *
 * ---
 *
 * The Happy Framework: WordPress Development Framework
 * Copyright 2014, Andrea Gandino & Simone Maranzana
 *
 * Licensed under The MIT License
 * Redistribuitions of files must retain the above copyright notice.
 *
 * @package Core
 * @author The Happy Bit <thehappybit@gmail.com>
 * @copyright Copyright 2014, Andrea Gandino & Simone Maranzana
 * @link http://
 * @since The Happy Framework v 2.0
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
if( !class_exists('THB_Frontend') ) {
	class THB_Frontend {

		/**
		 * The frontend scripts.
		 *
		 * @var array
		 **/
		private $_scripts = array(
			'header' => array(
			),
			'footer' => array(
			)
		);

		/**
		 * The frontend styles.
		 *
		 * @var array
		 **/
		private $_styles = array(
		);

		/**
		 * Constructor
		 *
		 */
		public function __construct()
		{
			// if ( is_admin() ) {
			// 	return;
			// }

			// Scripts

			add_action( 'init', array( $this, 'enqueueFrontendScripts' ) );

			// Styles

			if( file_exists(get_template_directory() . '/css/resources.css') ) {
				$this->addStyle(get_template_directory_uri() . '/css/resources.css', array(
					'name' => 'thb_resources'
				));
			}

			if( file_exists(get_template_directory() . '/css/mediaelementplayer-skin.css') ) {
				$this->addStyle(THB_THEME_CSS_URL . '/mediaelementplayer-skin.css', array(
					'name' => 'mediaelementplayer-skin'
				));
			}
		}

		/**
		 * Enqueue frontend scripts.
		 */
		public function enqueueFrontendScripts() {
			add_filter( 'thb_frontend_scripts', array( $this, 'addScripts' ) );

			if ( ! thb_compress_frontend_scripts() ) {
				$this->addScript( THB_FRONTEND_JS_URL . '/thb.toolkit.js', array(
					'name' => 'thb_toolkit'
				) );

				$this->addScript( THB_FRONTEND_JS_URL . '/frontend.js' );
				$this->addScript( THB_FRONTEND_JS_URL . '/jquery.easing.1.3.js' );
				$this->addScript( THB_FRONTEND_JS_URL . '/froogaloop.min.js' );
			}
		}

		/**
		 * Add frontend scripts to be compressed.
		 *
		 * @param array $scripts
		 */
		public function addScripts( $scripts )
		{
			$scripts[] = THB_FRONTEND_JS_PATH . '/thb.toolkit.js';
			$scripts[] = THB_FRONTEND_JS_PATH . '/frontend.js';
			$scripts[] = THB_FRONTEND_JS_PATH . '/jquery.easing.1.3.js';
			$scripts[] = THB_FRONTEND_JS_PATH . '/froogaloop.min.js';

			return $scripts;
		}

		/**
		 * Add a script to the admin interface.
		 *
		 * @see http://codex.wordpress.org/Function_Reference/wp_enqueue_script
		 * @param string $path The path to the script.
		 * @param array $options The (template, location) options of the script.
		 * @return void
		 **/
		public function addScript( $path, $options=array() )
		{
			if( empty($path) ) {
				wp_die( 'Empty script path.' );
			}

			if( !is_array($options) ) {
				wp_die( 'Script options are not in array form.' );
			}

			$scriptDefaults = array(
				'location' => 'footer',
				'templates' => array(),
				'name' => '',
				'deps' => array()
			);

			extract( wp_parse_args( $options, $scriptDefaults ) );

			if( in_array($name, $deps) ) {
				unset( $deps[array_search($name, $deps)] );
			}

			$this->_scripts[$location][] = array(
				'name' => $name,
				'path' => $path,
				'templates' => (array) $templates,
				'deps' => $deps
			);
		}

		/**
		 * Add a stylesheet to the admin interface.
		 *
		 * @param string $name The stylesheet registered name.
		 * @param array $options The template options of the style.
		 * @return void
		 **/
		public function addStyle( $path, $options=array() )
		{
			if( empty($path) ) {
				wp_die( 'Empty stylesheet path.' );
			}

			if( !is_array($options) ) {
				wp_die( 'Styles options are not in array form.' );
			}

			$styleDefaults = array(
				'templates' => array(),
				'name' => '',
				'deps' => array(),
				'media' => 'all'
			);

			extract( thb_array_asum($styleDefaults, $options) );

			if( in_array($name, $deps) ) {
				unset( $deps[array_search($name, $deps)] );
			}

			$this->_styles[] = array(
				'name' => $name,
				'path' => $path,
				'templates' => (array) $templates,
				'media' => $media,
				'deps' => $deps
			);
		}

		/**
		 * Enqueue the theme scripts.
		 *
		 * @param string $location The scripts location.
		 * @return void
		 */
		public function enqueueScripts()
		{
			global $wp_version;
			$locations = array('header', 'footer');

			$default_scripts = apply_filters( 'thb_frontend_default_scripts', array( 'jquery', 'swfobject' ) );

			foreach ( $default_scripts as $handle ) {
				wp_enqueue_script( $handle );
			}

			if ( is_singular() && get_option( 'thread_comments' ) ) { wp_enqueue_script( 'comment-reply' ); }

			foreach( $locations as $location ) {
				$in_footer = $location == 'footer';

				$i=0;
				foreach( $this->_scripts[$location] as $script ) {
					if( is_array($script) ) {
						extract($script);

						$page_id = thb_get_page_ID();

						if( empty($name) ) {
							$name = 'thb_' . $location . '_script_' . $i;
						}

						if( !empty($templates) ) {
							foreach( $templates as $template ) {
								if( thb_is_page_template($template, $page_id) ) {
									wp_enqueue_script($name, $path, $deps, $wp_version, $in_footer);
									break;
								}
							}
						}
						else {
							wp_enqueue_script($name, $path, $deps, $wp_version, $in_footer);
						}
					}

					$i++;
				}
			}

			global $wp_version;

			$thb_frontend_localized_scripts = array(
				'ajax_url'        => admin_url('admin-ajax.php'),
				'frontend_js_url' => THB_FRONTEND_JS_URL,
				'page_id'         => thb_get_page_ID(),
				'wp_version'	  => $wp_version
			);

			wp_localize_script( 'jquery', 'thb_system', apply_filters( 'thb_frontend_localized_scripts', $thb_frontend_localized_scripts ) );
		}

		/**
		 * Enqueue the theme styles.
		 *
		 * @return void
		 */
		public function enqueueStyles()
		{
			global $wp_version;

			$i=0;
			foreach( $this->_styles as $style ) {

				if( is_array($style) ) {
					extract($style);
					$page_id = thb_get_page_ID();

					if( empty($name) ) {
						$name = 'thb_style_' . $i;
					}

					if( !empty($templates) ) {
						foreach( $templates as $template ) {
							if( thb_is_page_template($template, $page_id) ) {
								wp_enqueue_style($name, $path, $deps, $wp_version, $media);
								break;
							}
						}
					}
					else {
						wp_enqueue_style($name, $path, $deps, $wp_version, $media);
					}
				}

				$i++;
			}
		}

		/**
		 * Add custom body classes.
		 *
		 * @param array $classes
		 * @return array
		 */
		public function customBodyClasses( $classes )
		{
			$classes[] = 'thb-theme';

			if( wp_is_mobile() ) {
				$classes[] = 'thb-mobile';
			} else {
				$classes[] = 'thb-desktop';
			}

			if( post_password_required() ) {
				$classes[] = 'thb-password-protected';
			}

			return $classes;
		}

		/**
		 * Add meta tags and comments to the <head> section.
		 *
		 * @return void
		 */
		public function headMeta()
		{
			echo '<!-- v: ' . THB_THEME_VERSION . ' -->';
			echo "\n";
			echo '<link rel="profile" href="http://gmpg.org/xfn/11" />';
			echo "\n";
			echo '<meta charset="' . get_bloginfo( 'charset' ) . '">';
			// echo "\n";
			// echo '<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">';
		}

		/**
		 * Meta HTTP.
		 */
		public function metaHttp()
		{
			header( 'X-UA-Compatible: IE=edge,chrome=1' );
		}

		/**
		 * Run the admin interface.
		 *
		 * @return void
		 **/
		public function run()
		{
			// Filters
			add_filter( 'body_class', array($this, 'customBodyClasses') );

			// Meta
			add_action( 'thb_head_meta', array($this, 'headMeta') );

			// Meta HTTP
			add_action( 'thb_before_doctype', array( $this, 'metaHttp' ) );

			// Scripts and styles
			add_action( 'wp_enqueue_scripts', array($this, 'enqueueStyles'), 5 );
			add_action( 'wp_enqueue_scripts', array($this, 'enqueueScripts') );
		}

	}
}