<?php

/**
 * Imports/exports settings from WP which are not handled by default WRX Export/import (Wordpress Importer Plugin)
 */
class ctDemoExporterImporter {
	/**
	 * Export settings to file
	 */

	const EXPORT_FILE = 'F';
	/**
	 * Settings
	 * @var array
	 */

	protected $settings;
	/**
	 * @var array
	 */

	protected $replacements = array();

	/**
	 * @param $data
	 *
	 * @return string
	 */
	function compress( $data ) {
		return serialize( $data );
	}

	/**
	 * Inits object
	 */

	public function init() {
		add_action( 'wp_import_post_data_processed', array( $this, 'normalizePost' ), 10, 2 );
		add_action( 'wp_import_post_meta', array( $this, 'normalizePostMeta' ), 10, 2 );
		add_action( 'ct.options.import', array( $this, 'normalizeThemeOptions' ), 10, 1 );

		$this->configureReplacements();
	}

	protected function configureReplacements() {
		$settings = $this->getRawSettings();
		if ( ! isset( $settings['upload_dir'] ) ) {
			return;
		}

		$uploads        = $settings['upload_dir'];
		$currentUploads = wp_upload_dir();

		$fromDir = substr( $uploads['basedir'], strpos( $uploads['basedir'], 'wp-content' ) - 1 );
		$toDir   = substr( $currentUploads['basedir'], strpos( $currentUploads['basedir'], 'wp-content' ) - 1 );

		$this->replacements[ $uploads['baseurl'] ] = $currentUploads['baseurl'];
		$this->replacements[ $fromDir ]            = $toDir;
		//default path
		$this->replacements['/wp-content/uploads'] = $toDir;
	}

	/**
	 * Normalize theme options ie. change paths etc.
	 *
	 * @param $options
	 *
	 * @return mixed
	 */

	public function normalizeThemeOptions( $options ) {
		foreach ( $options as $name => $val ) {
			if ( @unserialize( $val ) === false ) {
				$postmeta[ $name ] = strtr( $val, $this->replacements );
			}
		}

		return $options;
	}

	/**
	 * Replace some data
	 *
	 * @param $postmeta
	 * @param $post
	 *
	 * @return
	 * @internal param $postdata
	 */

	public function normalizePostMeta( $postmeta, $post ) {
		foreach ( $postmeta as $index => $values ) {
			//do not modify serialized data
			if ( @unserialize( $values['value'] ) === false ) {
				$postmeta[ $index ]['value'] = strtr( $values['value'], $this->replacements );
			}
		}

		return $postmeta;
	}

	/**
	 * Replace some data
	 *
	 * @param $postdata
	 * @param $post
	 */

	public function normalizePost( $postdata, $post ) {
		if ( isset( $post['post_content'] ) ) {
			$postdata['post_content'] = strtr( $post['post_content'], $this->replacements );
		}

		return $postdata;
	}

	/**
	 * Export data
	 *
	 * @param string $format
	 * @param array $options
	 *
	 * @throws Exception
	 */
	public function export( $format = self::EXPORT_FILE, $options = array() ) {
		global $wpdb;
		$options               = array();
		$options['upload_dir'] = wp_upload_dir();
		$options['options']    = array();
		//main pages
		$options['options']['page_on_front']  = get_option( 'page_on_front' );
		$options['options']['page_for_posts'] = get_option( 'page_for_posts' );
		$options['options']['show_on_front']  = get_option( 'show_on_front' );


		$options['options']['permalink_structure'] = get_option( 'permalink_structure' );

		$widgets = $wpdb->get_results( $wpdb->prepare("SELECT option_name, option_value FROM {$wpdb->options} WHERE option_name LIKE '%s'",'widget_%'));
		foreach ( $widgets as $widget ) {
			$options['options'][ $widget->option_name ] = $this->compress( get_option( $widget->option_name ) );
		}
		$options['options']['sidebars_widgets'] = $this->compress( get_option( 'sidebars_widgets' ) );

		$current_template = get_option( 'stylesheet' );
		$menus            = get_option( "theme_mods_{$current_template}" );

		if ( ! isset( $menus['nav_menu_locations'] ) ) {
			throw new Exception( "Invalid menus. Please go to Appearance - menu and click 'save menu' to rebuild internal WP data. Once than, try again." );
		}

		$options['options']["theme_mods_{$current_template}"] = $this->compress( $menus );

		$options = $this->addDefaultPluginExportSettings( $options );

		$options = apply_filters( 'ct_import.exporter_importer.export', $options );

		$data = serialize( $options );

		//export settings to file
		if ( $format == self::EXPORT_FILE ) {
			$path = isset( $options['path'] ) ? $options['path'] : self::getWpOptionsPath();
			//WP_Filesystem();
			//global $wp_filesystem;
			//if(!$wp_filesystem->put_contents($path,$data)){
			if(!file_put_contents($path,$data)){
					throw new Exception( "Cannot save settings to: " . $path );
			}
		}
	}

	/**
	 * Setup default additional options from plugins for export
	 *
	 * @param $options
	 *
	 * @return mixed
	 */

	protected function addDefaultPluginExportSettings( $options ) {
		//custom sidebars plugin
		foreach ( array( 'cs_sidebars', 'cs_modifiable' ) as $o ) {
			if ( $e = get_option( $o ) ) {
				$options['options'][ $o ] = $e;
			}
		}

		return $options;
	}

	/**
	 * Rebuild every demo file
	 */

	public function rebuild( ctImport $xmlImporter, ctNHP_Options $options ) {
		//WP_Filesystem();
		//global $wp_filesystem;
		//theme options
		//if ( $wp_filesystem->put_contents( ctImport::getThemeOptionsPath(), $options->export() ) === false ) {
		if ( file_put_contents( ctImport::getThemeOptionsPath(), $options->export() ) === false ) {
			throw new Exception( "Cannot save file to: " . ctImport::getThemeOptionsPath() );
		}
		$this->export( self::EXPORT_FILE );
		require_once ABSPATH . 'wp-admin/includes/export.php';
		flush();
		ob_start();
        //silence headers already sent error
		@export_wp( array( 'content' => 'all' ) );
		$xml = ob_get_contents();
		ob_end_clean();
		//WP_Filesystem();
		//global $wp_filesystem;
		//$wp_filesystem->put_contents( ctImport::getXmlPath(), $xml );
		file_put_contents( ctImport::getXmlPath(), $xml );

		$rev = new ctRevolutionSliderImporter();
		$rev->export();
	}

	/**
	 * Get path to exported settings
	 * @author alex
	 * @return string
	 */
	public static function getWpOptionsPath() {
		return ctImport::getDemoContentBaseDir() . '/wp_options.txt';
	}

	/**
	 * @param null $path
	 *
	 * @return array
	 */

	public function getRawSettings( $path = null ) {
		$path = $path ? $path : self::getWpOptionsPath();
		if ( ! $this->settings ) {

			if ( file_exists( $path ) ) {
				//WP_Filesystem();
				//global $wp_filesystem;
				//if ( $data = unserialize( $wp_filesystem->get_contents( $path ) ) ) {
				if ( $data = unserialize( file_get_contents( $path ) ) ) {
						$this->settings = $data;
				}
			}
		}

		return $this->settings;
	}

	/**
	 * Import settings
	 *
	 * @param array $processed_terms
	 * @param null $path
	 */
	public function import( $processed_terms, $path = null ) {

		//import wordpress options
		$path = $path ? $path : self::getWpOptionsPath();

		$current_template = get_stylesheet();

		$data = $this->getRawSettings( $path );

		if ( $data ) {
			//update wordpress options
			if ( isset( $data['options'] ) ) {
				foreach ( $data['options'] as $key => $val ) {
					$e = @unserialize( $val );
					if ( $val !== false && $e !== false ) {
						$val = $e;
					}

					//navigation - remap it
					if ( strpos( $key, "theme_mods_" ) !== false ) {

						foreach ( $val['nav_menu_locations'] as $navName => $navId ) {
							if ( isset( $processed_terms[ (int) $navId ] ) ) {
								$menuId                                = $processed_terms[ (int) $navId ];
								$val['nav_menu_locations'][ $navName ] = $menuId;
							}
						}

						$key = 'theme_mods_' . $current_template;
					}

					//remap homepage and blog list
					if ( $key == 'page_on_front' || $key == 'page_for_posts' ) {
						$found = array_search( (int) $val, $processed_terms );

						if ( $found !== false ) {
							$val = $processed_terms[ $found ];
						}
					}
					if ( is_array( $val ) ) {
						array_walk_recursive( $val, array( $this, 'replaceTokens' ) );
					} else {
						$this->replaceTokens( $val, '' );
					}

					update_option( $key, $val );
				}
			}

			do_action( 'ct_import.exporter_importer.import.post', $processed_terms );

			flush_rewrite_rules();
		}
	}

	/**
	 * Replace token
	 *
	 * @param $item
	 * @param $key
	 */

	public function replaceTokens( &$item, $key ) {
		if ( $item != '' && is_string($item)) {
			$item = strtr( $item, $this->replacements );
		}

	}
}