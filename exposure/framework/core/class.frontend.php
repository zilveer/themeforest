<?php if( !defined('THB_FRAMEWORK_NAME') ) exit('No direct script access allowed.');

/**
 * Frontend class.
 *
 * This class is entitled to manage the theme frontend.
 *
 * ---
 *
 * The Happy Framework: WordPress Development Framework
 * Copyright 2012, Andrea Gandino & Simone Maranzana
 *
 * Licensed under The MIT License
 * Redistribuitions of files must retain the above copyright notice.
 *
 * @package Core
 * @author The Happy Bit <thehappybit@gmail.com>
 * @copyright Copyright 2012, Andrea Gandino & Simone Maranzana
 * @link http://
 * @since The Happy Framework v 1.0
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
				'compressed' => array(),
				'not_compressed' => array()
			),
			'footer' => array(
				'compressed' => array(),
				'not_compressed' => array()
			)
		);

		/**
		 * The frontend styles.
		 *
		 * @var array
		 **/
		private $_styles = array(
			'compressed' => array(),
			'not_compressed' => array()
		);

		/**
		 * Constructor
		 *
		 */
		public function __construct()
		{
			// Scripts

			$this->addScript( THB_FRONTEND_JS_URL . '/thb.toolkit.js', array(
				'compress' => false,
				'name' => 'thb_toolkit'
			) );

			$this->addScript( THB_FRONTEND_JS_URL . '/frontend.js' );
			$this->addScript( THB_FRONTEND_JS_URL . '/jquery.easing.1.3.js' );
			$this->addScript( THB_FRONTEND_JS_URL . '/jquery.flexslider-min.js');
			$this->addScript( THB_FRONTEND_JS_URL . '/mediaelement-and-player.min.js');
			$this->addScript( THB_FRONTEND_JS_URL . '/froogaloop.min.js');

			// Styles

			if( file_exists(get_template_directory() . '/css/resources.css') ) {
				$this->addStyle(get_template_directory_uri() . '/css/resources.css', array(
					'name' => 'thb_resources'
				));
			}

			$this->addStyle(THB_FRONTEND_CSS_URL . '/mediaelementplayer.css', array(
				'name' => 'mediaelementplayer'
			));

			if( file_exists(get_template_directory() . '/css/mediaelementplayer-skin.css') ) {
				$this->addStyle(THB_THEME_CSS_URL . '/mediaelementplayer-skin.css', array(
					'name' => 'mediaelementplayer-skin'
				));
			}

			$this->addStyle(THB_FRONTEND_CSS_URL . '/flexslider.css', array(
				'name' => 'flexslider'
			));
		}

		/**
		 * Add a script to the admin interface.
		 *
		 * @see http://codex.wordpress.org/Function_Reference/wp_enqueue_script
		 * @param string $path The path to the script.
		 * @param array $options The (template,compress,location) options of the script.
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
				'compress' => false,
				'location' => 'footer',
				'templates' => array(),
				'name' => '',
				'deps' => array('thb_toolkit')
			);

			extract( thb_array_asum($scriptDefaults, $options) );

			if( in_array($name, $deps) ) {
				unset( $deps[array_search($name, $deps)] );
			}

			global $wp_customize;

			if( isset( $wp_customize ) ) {
				$compressed = 'not_compressed';
			}
			else {
				$compressed = $compress ? 'compressed' : 'not_compressed';
			}

			$this->_scripts[$location][$compressed][] = array(
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
		 * @param array $options The (template,compress) options of the style.
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
				'compress' => false,
				'templates' => array(),
				'name' => '',
				'deps' => array(),
				'media' => 'all'
			);

			extract( thb_array_asum($styleDefaults, $options) );

			if( in_array($name, $deps) ) {
				unset( $deps[array_search($name, $deps)] );
			}

			global $wp_customize;

			if ( isset( $wp_customize ) ) {
				$compressed = 'not_compressed';
			}
			else {
				$compressed = $compress ? 'compressed' : 'not_compressed';
			}

			$this->_styles[$compressed][] = array(
				'name' => $name,
				'path' => $path,
				'templates' => (array) $templates,
				'media' => $media,
				'deps' => $deps
			);
		}

		/**
		 * Get the theme fronted compressed scripts loaded in the $location
		 * portion of the template.
		 *
		 * @param string $location The loading location.
		 * @return array
		 */
		public function getCompressedScripts( $location='header' )
		{
			$scripts = array();

			foreach( $this->_scripts[$location]['compressed'] as $script ) {
				if( is_array($script) ) {
					extract($script);
					$page_id = isset($_GET['page_id']) ? $_GET['page_id'] : 0;

					if( !empty($templates) ) {
						foreach( $templates as $template ) {
							if( thb_check_page_template($page_id, $template) ) {
								$scripts[] = $path;
								break;
							}
						}
					}
					else {
						$scripts[] = $path;
					}
				}
			}

			return $scripts;
		}

		/**
		 * Get the theme fronted compressed styles.
		 *
		 * @return array
		 */
		public function getCompressedStyles()
		{
			$styles = array();

			foreach( $this->_styles['compressed'] as $style ) {
				if( is_array($style) ) {
					extract($style);
					$page_id = isset($_GET['page_id']) ? $_GET['page_id'] : 0;

					if( !empty($templates) ) {
						foreach( $templates as $template ) {
							if( thb_check_page_template($page_id, $template) ) {
								$styles[] = $style;
								break;
							}
						}
					}
					else {
						$styles[] = $style;
					}
				}
			}

			return $styles;
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

			wp_enqueue_script('jquery');
			wp_enqueue_script('swfobject');
			if ( is_singular() && get_option( 'thread_comments' ) ) { wp_enqueue_script( 'comment-reply' ); }

			foreach( $locations as $location ) {
				$in_footer = $location == 'footer';

				if( !empty($this->_scripts[$location]['compressed']) ) {
					$deps = array();

					foreach( $this->_scripts[$location]['compressed'] as $script ) {
						foreach( $script['deps'] as $dep ) {
							if( ! in_array($dep, $deps) && ! $this->isCompressedScript($dep) ) {
								$deps[] = $dep;
							}
						}
					}

					$src = thb_custom_resource('frontend/compressScripts') . '&location=' . $location;
					wp_enqueue_script('thb_' . $location . '_compressed_scripts', $src, $deps, $wp_version, $in_footer);
				}

				$i=0;
				foreach( $this->_scripts[$location]['not_compressed'] as $script ) {
					if( is_array($script) ) {
						extract($script);

						$page_id = thb_get_page_ID();

						if( empty($name) ) {
							$name = 'thb_' . $location . '_uncompressed_script_' . $i;
						}

						if( !empty($templates) ) {
							foreach( $templates as $template ) {
								if( thb_check_page_template($page_id, $template) ) {
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

			wp_localize_script( 'jquery', 'thb_system', array(
				'ajax_url' => admin_url('admin-ajax.php'),
				'frontend_js_url' => THB_FRONTEND_JS_URL
			) );
		}

		/**
		 * Check if a script is to be compressed.
		 *
		 * @param string $name The script name.
		 * @return boolean
		 */
		private function isCompressedScript( $name )
		{
			$locations = array('header', 'footer');

			foreach( $locations as $location ) {
				foreach( $this->_scripts[$location]['compressed'] as $script ) {
					if( $script['name'] == $name ) {
						return true;
					}
				}
			}

			return false;
		}

		/**
		 * Check if a style is to be compressed.
		 *
		 * @param string $name The style name.
		 * @return boolean
		 */
		private function isCompressedStyle( $name )
		{
			foreach( $this->_styles['compressed'] as $style ) {
				if( $style['name'] == $name ) {
					return true;
				}
			}

			return false;
		}

		/**
		 * Enqueue the theme styles.
		 *
		 * @return void
		 */
		public function enqueueStyles()
		{
			global $wp_version;

			if( !empty($this->_styles['compressed']) ) {
				$deps = array();

				foreach( $this->_styles['compressed'] as $style ) {
					foreach( $style['deps'] as $dep ) {
						if( ! in_array($dep, $deps) && ! $this->isCompressedStyle($dep) ) {
							$deps[] = $dep;
						}
					}
				}

				$src = thb_custom_resource('frontend/compressStyles');
				wp_enqueue_style('thb_compressed_styles', $src, $deps, $wp_version);
			}

			$i=0;
			foreach( $this->_styles['not_compressed'] as $style ) {

				if( is_array($style) ) {
					extract($style);
					$page_id = thb_get_page_ID();

					if( empty($name) ) {
						$name = 'thb_uncompressed_' . $i;
					}

					if( !empty($templates) ) {
						foreach( $templates as $template ) {
							if( thb_check_page_template($page_id, $template) ) {
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
			if( wp_is_mobile() ) {
				$classes[] = 'thb-mobile';
			} else {
				$classes[] = 'thb-desktop';
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
			echo '<meta charset="' . get_bloginfo( 'charset' ) . '">';
			echo '<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">';
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

			// Scripts and styles
			add_action( 'wp_enqueue_scripts', array($this, 'enqueueStyles'), 5 );
			add_action( 'wp_enqueue_scripts', array($this, 'enqueueScripts') );
		}

	}
}